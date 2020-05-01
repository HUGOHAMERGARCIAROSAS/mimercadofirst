<?php

namespace App\Http\Controllers\Web;

use App\Mail\OrderDetailReceived;
use App\src\Models\CartRule;
use App\src\Models\Coupon;
use App\src\Models\Tamanio;
use App\src\Models\Order;
use App\src\Models\OrderDetail;
use App\Http\Controllers\Controller;
use App\src\Repositories\CouponRepository;
use App\src\Repositories\OrderRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ShippingCostRepository;
use App\src\Repositories\UserRepository;
use App\src\Util\CartMessage;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Culqi\Culqi;
use Culqi\CulqiException;
use Exception;
use Illuminate\Support\Facades\DB;
use Log;
use Mail;
use Session;

class CheckoutController extends Controller
{
    private $productRepository;
    private $shippingCostRepository;
    private $orderRepository;
    private $userRepository;
    private $couponRepository;

    public function __construct(ProductRepository $productRepository,
                                ShippingCostRepository $shippingCostRepository,
                                OrderRepository $orderRepository,
                                UserRepository $userRepository,
                                CouponRepository $couponRepository)
    {
        $this->productRepository = $productRepository;
        $this->shippingCostRepository = $shippingCostRepository;
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->couponRepository = $couponRepository;
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user->hasCompleteProfile()) {
            return redirect()->route('client.complete-profile');
        }

        $cartSubTotal = Cart::subtotal();
        $costOfShipping = 0.0;

        $discount = session()->get('coupon')['discount'] ?? 0;
        $cartTotal = ($cartSubTotal - $discount);

        $minimumPurchase = (Float)CartRule::$MINIMUM_PURCHASE;
        if ($cartTotal == 0) {
            return redirect()->route('web.cart.index');
        }

        if ($cartTotal <= $minimumPurchase) {
            return redirect()->route('web.cart.index')->withErrors(['messageCart' => CartMessage::minimumAmountOfPurchase()]);
        }

        return view('web.pages.checkout.index')->with([
            'persona' => Auth::user(),
            'urbanizations' => $this->shippingCostRepository->listShippingCostWithOrder(),
            'cartSubTotal' => sprintf("%01.2f", $cartSubTotal),
            'discount' => sprintf("%01.2f", $discount),
            'cartTotal' => sprintf("%01.2f", $cartTotal),
            'costOfShipping' => sprintf("%01.2f", $costOfShipping),
        ]);
    }

    public function storeTransferencia(Request $request)
    {
        $shippingCost = $this->shippingCostRepository->find($request->input('shipping_cost'));
        $user = $this->userRepository->find(Auth::id());
        $medio_pago = "Transferencia Bancaria";
        $coupon_code = session()->get('coupon')['code'] ?? null;

        try {
            DB::beginTransaction();

            $order = $this->orderRepository->create([
                'payment_method' => $medio_pago,
                'address' => $request->input('direccion'),
                'reference' => $request->input('reference'),
                'shipping_cost_id' => $shippingCost->id,
                'user_id' => $user->id,
                'coupon_code' => $coupon_code,
            ]);

            foreach (Cart::content() as $row) {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->product_id = $row->model->id;
                $detail->final = $row->model->final;
                $detail->quantify = $row->qty;
                $detail->save();
            }

            Mail::to($user->email)->send(new OrderDetailReceived($order, $user));
            Mail::to("ventas@mimercado.delivery")->send(new OrderDetailReceived($order, $user));

            Cart::destroy();

            if (session()->has('coupon')) {
                $code = session()->get('coupon')['code'];
                $couponRepo = $this->couponRepository->findOneBy([
                    'code' => $code,
                ]);
                $couponRepo->update([
                    'state' => Coupon::ESTADO_UTILIZADO,
                ]);
                session()->forget('coupon');
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Log::debug($e->getMessage());
            return redirect()->back()->withInput();
        }

        session()->flash('success_message', true);
        session()->flash('transfer', true);

        return response()->json([
            'compraAceptada' => true,
        ]);
    }

    public function store(Request $request)
    {
        $shippingCost = $this->shippingCostRepository->find($request->input('shipping_cost'));
        $user = $this->userRepository->find(auth()->id());
        $medio_pago = "Pago Online";
        $coupon_code = session()->get('coupon')['code'] ?? null;

        $SECRET_KEY = "sk_live_l1aJknZVIspM4R1L";

        $culqi = new Culqi(array('api_key' => $SECRET_KEY));
        try {
            $cargo = $culqi->Charges->create(
                array(
                    "amount" => $request->input('monto'),
                    "capture" => true,
                    "currency_code" => "PEN",
                    "description" => "Compra - MiMercado.delivery",
                    "email" => $request->input('email'),
                    "installments" => 0,
                    "source_id" => $request->input('token')
                )
            );
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json([
                'message' => "Accion Cancelada",
                'messageErrorCulqui' => $e->getMessage()
            ]);
        }

        try {
            DB::beginTransaction();

            $order = $this->orderRepository->create([
                'payment_method' => $medio_pago,
                'address' => $request->input('direccion'),
                'reference' => $request->input('reference'),
                'shipping_cost_id' => $shippingCost->id,
                'user_id' => $user->id,
                'coupon_code' => $coupon_code,
                'culqui_order_id' => $cargo->id,
            ]);

            foreach (Cart::content() as $row) {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->product_id = $row->model->id;
                $detail->final = $row->model->final;
                $detail->quantify = $row->qty;
                $detail->save();
            }

            Mail::to($user->email)->send(new OrderDetailReceived($order, $user));
            Mail::to("ventas@mimercado.delivery")->send(new OrderDetailReceived($order, $user));

            Cart::destroy();

            if (session()->has('coupon')) {
                $code = session()->get('coupon')['code'];
                $couponRepo = $this->couponRepository->findOneBy([
                    'code' => $code,
                ]);
                $couponRepo->update([
                    'state' => Coupon::ESTADO_UTILIZADO,
                ]);
                session()->forget('coupon');
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->back()->withInput();
        }

        session()->flash('success_message', true);
        session()->flash('transfer', false);

        return response()->json([
            'compraAceptada' => true,
        ]);
    }

    public function searchUrbanizationAjax(Request $request)
    {
        $urbanizationId = $request->input('id');
        $urbanization = $this->shippingCostRepository->find($urbanizationId);
        $tax = $urbanization->cost;

        $cartSubtotal = Cart::subtotal();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $cartTotal = ($cartSubtotal - $discount) + $tax;

        try {
            $viewContainerTotalCart = view('web.pages.checkout.totalCart')
                ->with([
                    'cartSubTotal' => sprintf("%01.2f", $cartSubtotal),
                    'discount' => sprintf("%01.2f", $discount),
                    'cartTotal' => sprintf("%01.2f", $cartTotal),
                    'costOfShipping' => sprintf("%01.2f", $tax),
                ])
                ->render();
        } catch (\Throwable $e) {
            Log::debug($e->getMessage());
        }

        return response()->json([
            'viewContainerTotalCart' => $viewContainerTotalCart,
            'cartTotal' => $cartTotal,
        ]);
    }
    public function cambiar(Request $request,$id){
        $tamanio = Tamanio::findOrFail($id);
        $tamanio->nombre = $request->nombre;
        $tamanio->save();
        return back();
    }

    // test mail
//    public function testMail(Request $request)
//    {
//        $shippingCost = $this->shippingCostRepository->find($request->input('shipping_cost'));
//        $user = $this->userRepository->find(Auth::id());
//        $medio_pago = "Transferencia Bancaria";
//        $coupon_code = session()->get('coupon')['code'] ?? null;
//        try {
//            $order = new Order([
//                'payment_method' => $medio_pago,
//                'address' => $request->input('direccion'),
//                'reference' => $request->input('reference'),
//                'shipping_cost_id' => 2,
//                'user_id' => $user->id,
//                'coupon_code' => $coupon_code,
//            ]);
//            foreach (Cart::content() as $row) {
//                $detail = new OrderDetail();
//                $detail->order_id = $order->id;
//                $detail->product_id = $row->model->id;
//                $detail->final = $row->model->final;
//                $detail->quantify = $row->qty;
//            }
//            Mail::to($user->email)->send(new OrderDetailReceived($order, $user));
//        } catch (Exception $e) {
//            Log::error(self::class . ": " . $e->getMessage());
//            return redirect()->back();
//        }
//
//        return redirect()->back();
//    }

}
