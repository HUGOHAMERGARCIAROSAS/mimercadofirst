<?php

namespace App\Http\Controllers\Movil;
use App\src\Models\Category;
use App\src\Models\Subcategory;
use App\src\Models\Product;
use App\src\Models\ProductSubCategory;
use App\src\Models\ProductUnitMeasure;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\src\Models\Order;
use App\src\Models\OrderDetail;
use App\src\Models\ShippingCost;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    //
    public function loginFacebook(Request $request){
        try {
            DB::beginTransaction();
            
            $data = $request->json()->all();
            
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->provider = 'facebook';
            $user->provider_id = $data['provider_id'];
            $user->save();
            
            DB::commit();
            return response()->json($user);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function pedidoTransferencia(Request $request){
        try {
            DB::beginTransaction();

            $data = $request->json()->all();

            $order = new Order();
            $order->user_id = $data['user_id'];
            $order->address = $data['address'];
                $user = User::find($order->user_id);
                //return response()->json($user);
                if($user->phone == null){
                    $user->phone = $data['phone'];
                    $user->save();
                }
            $order->shipping_cost_id = $data['shipping_cost_id'];
            $order->reference = $data['reference'];
            $order->payment_method = $data['payment_method'];
            $order->save();
            $carrito = $data['carrito'];
            //$cont = count($carrito);
            //return response()->json($carrito);
            if (count($carrito) > 0) {
                foreach ($carrito as  $value) {
                    $detalle = new OrderDetail();
                    $detalle->order_id = $order->id;
                    $dd = $value['id'];
                    //return response()->json($dd);
                    $detalle->product_id = json_decode($value['id'],true);
                    $detalle->price = $value['price'];
                    $detalle->quantify = $value['cantidad'];
                    $detalle->save();
                }
            }
            DB::commit();
            return response()->json('true');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    
    
    public function urbanizaciones(){
        $zonas = ShippingCost::where('state',1)->orderBy('id','desc')->get();
        return response()->json($zonas);
    }
    public function pedidos($id){
        $orders = Order::where('user_id', $id)->get();
        
        return response()->json($orders);
    } 
    public function monto($order_id){
        $monto = 0;
        $order_detail = OrderDetail::where('order_id', $order_id)->get();
        foreach($order_detail as $item){
          $monto += $item->price * $item->quantify;
        }
        return response()->json($monto);
    }

    public function datosFormulario($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function auth($email , $password){
        $user = User::where('email',$email)->first();
        if ($user != null) {
            if (Hash::check($password  , $user->password)) {
                $id = $user->id;
                return response()->json($id);
            }else{
                return response()->json('error');
            }
        }
        
        
    }

    public function categorias(){
        $categorias = Category::orderBy('id','desc')->get();
        return response()->json($categorias);
    }

    public function subcategorias($id){
        $subcategorias = Subcategory::where('category_id',$id)->orderBy('id','asc')->get();
        return response()->json($subcategorias);
    }
    public function medida($id){
        $medida = ProductUnitMeasure::findOrFail($id);
        return response()->json($medida);
    }
    public function productos($id){
        $aux = ProductSubCategory::where('sub_category_id',$id)->orderBy('id','desc')->get();
        $aux2 = Product::where('disponible','si')->get();
        $c = 0;
        $a = count($aux);
        $b = count($aux2);

        for ($i=0; $i < $a; $i++) { 
            for ($j=0; $j < $b ; $j++) { 
                if($aux2[$j]->product_sub_category_id == $aux[$i]->id ){
                    $productos[$c] = $aux2[$j];
                    $c = $c + 1;
                }
            }
        }
        return response()->json($productos);
    }
    public function productoDetalle($id){
        $producto = Product::findOrFail($id);
        return response()->json($producto);
    }

    public function allProductos(){
        $productos = Product::where('disponible','si')->get();
        return response()->json($productos);
    }
    public function ofertas(){
        $productos = Product::where('product_today',1)->get();
        return response()->json($productos);
    }
}
