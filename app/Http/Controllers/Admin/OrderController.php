<?php

namespace App\Http\Controllers\Admin;

use Log;
use Exception;
use Culqi\Culqi;
use App\src\Models\Order;
use Culqi\CulqiException;
use App\src\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\src\Repositories\OrderRepository;
use App\src\Repositories\CouponRepository;
use DB;


class OrderController extends Controller
{
    private $orderRepository;
    private $couponRepository;

    public function __construct(OrderRepository $orderRepository,
                                CouponRepository $couponRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->couponRepository = $couponRepository;
    }

    public function index()
    {
        return view('admin.pages.order.index')->with([
            'orders' => $this->orderRepository->allWithEstateActive(),
        ]);
    }

    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        $coupon = $this->couponRepository->findOneBy(['code' => $order->coupon_code]);

        $discount = ($coupon != null) ? $coupon->discount : 0.0;
        $shippingCost = $order->shippingCost->cost;

        $calculateSubTotal = 0.0;
        foreach ($order->orderDetail as $detail) {
            $calculateSubTotal += ($detail->final * $detail->quantify);
        }
        $calculateTotal = (($calculateSubTotal - $discount) + $shippingCost);
        $pedido = $this->orderRepository->find($id);
        $SECRET_KEY = "sk_live_l1aJknZVIspM4R1L";
        $culqi = new Culqi(array('api_key' => $SECRET_KEY));
                if ($pedido->payment_method=='Pago Online'){
                    if ($pedido->payment_method){
                        $pedido->payment_method = 'Pago Online';
                        $transaccion= $culqi->Charges->get($pedido->culqui_order_id);
                        if ($transaccion->outcome->type == 'venta_exitosa'){
                            $estado='EXITOSA';
                        }else{
                            $estado='RECHAZADA';
                        }
                        $pedido->transaccion = array(
                            'created' => $transaccion->creation_date,
                            'marca' => $transaccion->source->iin->card_brand,
                            'tarjeta' => $transaccion->source->card_number,
                            'estado' => $estado,
                        );
                        $pedido->total =  number_format($transaccion->amount / 100, 2, '.', '');
                        }else{
                            $pedido->payment_method = 'Transferencia Bancaria';
                            $pedido->transaccion = array(
                                'created' => '',
                                'marca' => '',
                                'tarjeta' => '',
                                'estado' => '',
                            );
                        }

                    return view('admin.pages.order.show')->with([
                        'order' => $order,
                        'subtotal' => $calculateSubTotal,
                        'totalOrder' => $calculateTotal,
                        'discount' => $discount,
                        'pedido' => $pedido,
                        'shippingCost' => $shippingCost,
                        'created' => $transaccion->creation_date,
                        'marca' => $transaccion->source->iin->card_brand,
                        'tarjeta' => $transaccion->source->card_number,
                        'estado' => $estado,
                    ]);
                }else{
                    return view('admin.pages.order.show')->with([
                        'order' => $order,
                        'subtotal' => $calculateSubTotal,
                        'totalOrder' => $calculateTotal,
                        'discount' => $discount,
                        'shippingCost' => $shippingCost,
                    ]);
                }
    }

    public function destroy($id)
    {
        try {
            $order = $this->orderRepository->find($id);
            $repo = new OrderRepository($order);
            $repo->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

    public function export($id)
    {
        try {
            $order = Order::find($id);

            $coupon = $this->couponRepository->findOneBy(['code' => $order->coupon_code]);
            $discount = ($coupon != null) ? $coupon->discount : 0.0;

            Excel::create('DB_pedido_' . $order->id, function ($excel) use ($order, $discount) {

                $excel->sheet('DB_pedido_' . $order->id, function ($sheet) use ($order, $discount) {
                    $sheet->row(1, [
                        '#', 'DIRECCIÓN DE ENVIO', 'URBANIZACIÓN', 'REFERENCIA','MÉTODO DE PAGO', 'CÓDIGO', 'FECHA'
                    ]);

                    $sheet->row(2, [
                        $order->id,
                        $order->address,
                        $order->shippingCost->urbanization,
                        $order->reference,
                        $order->payment_method,
                        $order->transfer_code,
                        $order->created_at->format('d-m-Y'),
                    ]);

                    $sheet->row(4, [
                        '', 'USUARIO', 'TELEFONO', 'CORREO', 'DNI',
                    ]);

                    $sheet->row(5, [
                        '',
                        $order->user->name . ' ' . $order->user->last_name,
                        $order->user->phone,
                        $order->user->email,
                        $order->user->document,
                    ]);

                    $sheet->row(7, [
                        '', 'PRODUCTO', 'PRECIO', 'CANTIDAD', 'TOTAL'
                    ]);

                    $contador = 7;
                    $temporal = 0;
                    foreach ($order->orderDetail as $index => $detail) {
                        $contador++;
                        $sheet->row($contador, [
                            '',
                            $detail->product->name,
                            $detail->product->price,
                            $detail->quantify,
                            $detail->price * $detail->quantify,
                        ]);
                        $temporal = $contador;
                    }

                    $calculateSubTotal = 0;
                    foreach ($order->orderDetail as $detail) {
                        $calculateSubTotal += ($detail->price * $detail->quantify);
                    }

                    $shippingCost = $order->shippingCost->cost;
                    $calculateTotal = (($calculateSubTotal - $discount) + $shippingCost);

                    $sheet->row($temporal + 2, [
                        '', '', '', 'SUBTOTAL',
                        $calculateSubTotal,
                    ]);

                    $sheet->row($temporal + 3, [
                        '', '', '', 'DESCUENTO',
                        $discount,
                    ]);

                    $sheet->row($temporal + 4, [
                        '', '', '', 'COSTO DE ENVÍO',
                        $shippingCost,
                    ]);

                    $sheet->row($temporal + 5, [
                        '', '', '', 'TOTAL',
                        $calculateTotal,
                    ]);

                });
            })->export('xlsx');

        } catch (Exception $e) {
            Log::info($e->getMessage());
        }
    }

}
