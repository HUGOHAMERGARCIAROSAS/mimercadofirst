<?php

namespace App\Exports;

use App\src\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsExport implements FromView
{
    public function view(): View
    {
        return view('admin.pages.product.export', [
            'productos' => Product::all()
        ]);
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    /*public function collection()
    {
        return Product::all();
    }*/
}
