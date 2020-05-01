<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\src\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        if (!session()->has('success_message')) {
            return redirect('/');
        }

        $transfer = session()->get('transfer');
        $lastProducts = $this->productRepository->productsWithProductToday('');

        return view('web.pages.pedido.confirmacion')->with([
            'isTransfer' => $transfer,
            'lastProducts' => $lastProducts,
        ]);
    }
}
