<?php

namespace App\Http\Controllers\Admin;

use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ProductScaleRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Repositories\ProductUnitMeasureRepository;
use App\src\Repositories\SliderRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\src\Models\Product;
use App\Admin;
use Exception;
use DB;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProviderProductoController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $subCategoryRepository;
    private $productSubCategoryRepository;
    private $productScaleRepository;
    private $sliderRepository;
    private $productUnitMeasureRepository;

    public function __construct(ProductRepository $productRepository,
                                CategoryRepository $categoryRepository,
                                SubCategoryRepository $subCategoryRepository,
                                ProductSubCategoryRepository $productSubCategoryRepository,
                                ProductScaleRepository $productScaleRepository,
                                SliderRepository $sliderRepository,
                                ProductUnitMeasureRepository $productUnitMeasureRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
        $this->productScaleRepository = $productScaleRepository;
        $this->sliderRepository = $sliderRepository;
        $this->productUnitMeasureRepository = $productUnitMeasureRepository;
    }

  

    public function listProductsDataTable()
    {
        //$product = $this->productRepository->listProductsInOrderDatatable();
        //            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
        $variable = auth()->user()->id;
        $usuarios = Admin::where('id', $variable)->first();
        $product = Product::with(['productUnitMeasure', 'productScale'])
            ->where('state', '1')->where('provider_id', $variable);

        return Datatables::eloquent($product)
            ->addColumn('image', function ($row) {
                return ['image' => assetImage($row->image)];
            })
            ->addColumn('actions', function ($row) {
                $editUrl = route('products.edit', $row->id);
                $deleteUrl = route('products.destroy', $row->id);
                $id = $row->id;
                return ([
                    'editUrl' => $editUrl,
                    'deleteUrl' => $deleteUrl,
                    'id' => $id,
                    'total' => $this->productRepository->totalProducts(),
                ]);
            })
            ->toJson();
    }

    public function update_disponible(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $product->disponible = $request->disponible;
            $product->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return json_encode(false);
        }
        return json_encode(true);
    }




    public function updateProductWithAjax(Request $request)
    {
        $productId = $request->input('pk');
        $value = $request->input('value');
        $column = $request->input('name');

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'product_unit_measure_id' => 'required',
            'product_scale_id' => 'required',
            'product_today' => 'required',
            'disponible' => 'required'
        ]);

        try {
            $product = $this->productRepository->find($request->input('productId'));
            $repo = new ProductRepository($product);
            $repo->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'product_unit_measure_id' => $request->input('product_unit_measure_id'),
                'product_scale_id' => $request->input('product_scale_id'),
                'product_today' => $request->input('product_today'),
                'disponible' => $request->input('disponible'),
                'porcentaje' => $request->input('porcentaje'),
                'final' => $request->input('final'),
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => "error",
                'type' => "error",
            ]);
        }

        return response()->json([
            'message' => "Se ha actualizado con exito.",
            'type' => "success",
            $request->all()
        ]);
    }
    
    public function destroy($id)
    {
        try {
            $provi = Admin::find($id);
            $provi->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }
}
