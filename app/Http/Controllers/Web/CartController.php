<?php

namespace App\Http\Controllers\Web;

use App\src\Repositories\ProductRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class CartController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $cartSubtotal = Cart::subtotal();
        $discount = session()->get('coupon')['discount'] ?? 0;
        $cartTotal = $cartSubtotal - $discount;

        return view('web.pages.cart.index')->with([
            'cartSubTotal' => $cartSubtotal,
            'discount' => $discount,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function addProduct(Request $request)
    {
        $quantityByDefault = 1;
        $productId = $request->input('productId');

        $product = $this->productRepository->find($productId);
        $cartItem = Cart::add($product->id, $product->name, $quantityByDefault, $product->final);
        $cartItem->associate($product);

        $viewShoppingCartInHeader = view('web.layouts._shoppingCartInHeader')->render();

        return response()->json([
            'viewShoppingCartInHeader' => $viewShoppingCartInHeader,
        ]);
    }

    public function addProductWithQuantify(Request $request)
    {
        $productId = $request->input('productId');
        $qty = $request->input('qty');

        $cartItem = Cart::search(function ($cartItem, $rowId) use ($productId) {
            return $cartItem->id == $productId;
        })->first();

        if (empty($cartItem)) {
            $product = $this->productRepository->find($productId);
            $cartNewItem = Cart::add($product->id, $product->name, $qty, $product->final);
            $cartNewItem->associate($product);
        } else {
            Cart::update($cartItem->rowId, $qty);
        }

        $viewCartInfo = ViewShoppingCartPartials::viewCartInfo();
        $viewCartItems = ViewShoppingCartPartials::viewCartItems();
        $viewCartCalculationDetails = ViewShoppingCartPartials::viewCartCalculationDetails();

        return response()->json([
            'cartCount' => Cart::count(),
            'viewCartInfo' => $viewCartInfo,
            'viewCartItems' => $viewCartItems,
            'viewCartCalculationDetails' => $viewCartCalculationDetails,
        ]);
    }

    public function removeProduct(Request $request)
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);

        $cartSubtotal = Cart::subtotal();
        $discount = 0.0;
        $cartTotal = $cartSubtotal;

        $viewCartInfo = ViewShoppingCartPartials::viewCartInfo();
        $viewCartItems = ViewShoppingCartPartials::viewCartItems();
        $viewCartCalculationDetails = ViewShoppingCartPartials::viewCartCalculationDetails();

        return response()->json([
            'cartCount' => Cart::count(),
            'viewCartInfo' => $viewCartInfo,
            'viewCartItems' => $viewCartItems,
            'viewCartCalculationDetails' => $viewCartCalculationDetails,
        ]);
    }

    public function removeAllProduct()
    {
        Cart::destroy();

        if (session()->has('coupon')) {
            session()->forget('coupon');
        }

        return redirect()->back();
    }

    public function removeProductInTable(Request $request)
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);

        $cartSubtotal = Cart::subtotal();
        $discount = session()->get('coupon')['discount'] ?? 0.00;
        $cartTotal = $cartSubtotal;

        return response()->json(ViewShoppingCartPartials::views($cartSubtotal, $discount, $cartTotal));
    }

    public function updateIncProduct(Request $request)
    {
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');
        $qty++;
        Cart::update($rowId, $qty);

        $cartSubtotal = Cart::subtotal();
        $discount = session()->get('coupon')['discount'] ?? 0.00;
        $cartTotal = ($cartSubtotal - $discount);

        return response()->json(ViewShoppingCartPartials::views($cartSubtotal, $discount, $cartTotal));
    }

    public function updateDecProduct(Request $request)
    {
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');
        $qty--;

        if ($qty === 0) {
            Cart::update($rowId, 1);
        } else {
            Cart::update($rowId, $qty);
        }

        $cartSubtotal = Cart::subtotal();
        $discount = session()->get('coupon')['discount'] ?? 0.00;
        $cartTotal = ($cartSubtotal - $discount);

        return response()->json(ViewShoppingCartPartials::views($cartSubtotal, $discount, $cartTotal));
    }
    
    public function updateActual(Request $request)
    {
        $rowId = $request->input('rowId');
        $qty = $request->input('qty');
  
        if ($qty == "") {
            Cart::update($rowId, 1);
        } else {
            Cart::update($rowId, $qty);
        }

        $cartSubtotal = Cart::subtotal();
        $discount = session()->get('coupon')['discount'] ?? 0.00;
        $cartTotal = ($cartSubtotal - $discount);

        return response()->json(ViewShoppingCartPartials::views($cartSubtotal, $discount, $cartTotal));
    }
    
    public function updateProduct(Request $request)
    {
        $qty = $request->input('qty');
        $rowId = $request->input('rowId');
        Cart::update($rowId, $qty);

        return response()->json(['updateCart' => true]);
    }

    public function reviewProduct(Request $request)
    {
        $productId = $request->input('productId');

        $cartItem = Cart::search(function ($cartItem, $rowId) use ($productId) {
            return $cartItem->id == $productId;
        })->first();

        $qty = (empty($cartItem)) ? 1 : $cartItem->qty;

        return response()->json([
            'qty' => $qty
        ]);
    }

}
