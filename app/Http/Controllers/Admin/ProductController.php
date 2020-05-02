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
use App\src\Models\ProductUnitMeasure;
use App\src\Models\ProductSubCategory;

use Exception;
use DB;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\ProductsExport;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
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

    public function index(Request $request)
    {
        return view('admin.pages.product.index');
    }

    public function listProductsDataTable()
    {
//        $product = $this->productRepository->listProductsInOrderDatatable();
        //            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
        $product = Product::with(['productUnitMeasure', 'productScale'])
            ->where('state', '1');

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

    public function listProductsDataTableCategory()
    {
        $product = $this->productRepository->listProductsInOrderDatatable();

        return Datatables::of($product)
            ->addColumn('image', function ($row) {
                return ['image' => assetImage($row->image)];
            })
            ->addColumn('category', function ($row) {
                return $row->productSubCategory->subCategory->category->name;
            })
            ->addColumn('subcategory', function ($row) {
                return $row->productSubCategory->subCategory->name;
            })
            ->addColumn('productSubcategory', function ($row) {
                return $row->productSubCategory->name;
            })
            ->make(true);
    }

    public function create()
    {
        $totalProducts = $this->productRepository->totalProductForCreate();

        return view('admin.pages.product.create')->with([
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'productScale' => $this->productScaleRepository->all(null, 'id', 'ASC'),
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'asc'),
            'totalProducts' => $totalProducts,
        ]);
    }

    public function store(Request $request)
    {
        $order = $request->input('orden');
        try {
            DB::beginTransaction();

//            $this->productRepository->organizeProductsByDefault();

            $this->productRepository->organizeProductsInCreate($order);

            $product = $this->productRepository->create($request->all());

            $product->uploadImage(request()->file('image'), 'image');

            $product->compressImage($request->hasFile('image'));

            DB::commit();
            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.pages.product.edit')->with([
            'product' => $this->productRepository->find($id),
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'productScale' => $this->productScaleRepository->all(null, 'id', 'ASC'),
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'asc'),
            'totalProducts' => $this->productRepository->totalProducts(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $requestOrder = $request->input('orden');

        try {
            DB::beginTransaction();

            $product = $this->productRepository->find($id);
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->porcentaje = $request->input('porcentaje');
            $product->final = $request->input('final');
            $product->provider_id = $request->input('provider_id');
            $product->description = $request->input('description');
            $product->product_unit_measure_id = $request->input('product_unit_measure_id');
            $product->product_scale_id = $request->input('product_scale_id');
            $product->product_sub_category_id = $request->input('product_sub_category_id');

            $rangoMaximo = $this->productRepository->totalProducts();
            if ($requestOrder > $rangoMaximo) {
                Mensaje::flashMessageWarningImportant("El número de orden supera el rango. Ingrese valores que se encuentren en el rango proporcionado.");
                return redirect()->back();
            } else if ($requestOrder != $product->orden) {
                $this->productRepository->organizeProductsInUpdate($requestOrder, $product->orden);
                $product->orden = $requestOrder;
            }

            if ($request->hasFile('image')) {
                $product->uploadImage(request()->file('image'), 'image');
            }

            $product->compressImage($request->hasFile('image'));

            $productRepository = new ProductRepository($product);
            $productRepository->update($product->toArray());

            DB::commit();
            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('products.index');
    }

    public function existSlider(Request $request)
    {
        $product = $request->input('productId');
        $slider = $this->sliderRepository->findOneBy([
            'product_id' => $product
        ]);

        $exist = ($slider == null) ? false : true;

        return response()->json([
            'exist' => $exist,
        ]);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $product = $this->productRepository->find($id);

            $this->productRepository->organizeProductsInDelete($product->orden);

            $productRepository = new ProductRepository($product);
            $productRepository->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

    public function updateOrder(Request $request)
    {
        $newPosition = $request->input('position');
        $id = $request->input('id');

        $rangoMaximo = $this->productRepository->totalProducts();
        if ($newPosition > $rangoMaximo) {
            return response()->json([
                'type' => "error",
                'message' => "El valor ingresado no se encuentra en el rango.",
            ]);
        }

        try {

            DB::beginTransaction();

            $product = $this->productRepository->find($id);

            $this->productRepository->organizeProductsInUpdate($newPosition, $product->orden);

            $productRepo = new ProductRepository($product);
            $productRepo->update([
                'orden' => $newPosition
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }

        return response()->json([
            'type' => "success",
            'message' => __('message.product_update_order')
        ]);
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

    public function update_product_today(Request $request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $product->product_today = $request->product_today;
            $product->save();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return json_encode(false);
        }
        return json_encode(true);
    }

    public function updateProductScale(Request $request)
    {
        $productId = $request->input('productId');
        $productScaleId = $request->input('productScaleId');

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("product_scale_id", $productScaleId);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }
    public function updateProductOrden(Request $request)
    {
        $productId = $request->input('productId');
        $orden = $request->input('orden');

        if (!is_numeric($orden)) {
            return response()->json(false);
        }

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("orden", $orden);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }
    public function updateProductUnitMeasure(Request $request)
    {
        $productId = $request->input('productId');
        $productUnitMeasureId = $request->input('productUnitMeasureId');
        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("product_unit_measure_id", $productUnitMeasureId);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }
        return response()->json(true);
    }

    public function updateProductPrice(Request $request)
    {
        $productId = $request->input('productId');
        $price = $request->input('price');

        if (!is_numeric($price)) {
            return response()->json(false);
        }

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("price", $price);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function updateProductPorcentaje(Request $request)
    {
        $productId = $request->input('productId');
        $porcentaje = $request->input('porcentaje');

        if (!is_numeric($porcentaje)) {
            return response()->json(false);
        }

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("porcentaje", $porcentaje);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function updateProductMonto(Request $request)
    {
        $productId = $request->input('productId');
        $monto = $request->input('monto');

        if (!is_numeric($monto)) {
            return response()->json(false);
        }

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("monto", $monto);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }
    public function updateProductProvider(Request $request)
    {
        $productId = $request->input('productId');
        $provider_id = $request->input('provider_id');

        if (!is_numeric($provider_id)) {
            return response()->json(false);
        }

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("provider_id", $provider_id);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }
    public function updateProductFinal(Request $request)
    {
        $productId = $request->input('productId');
        $final = $request->input('final')+input('porcentaje');
        $porcentaje = $request->input('porcentaje');
        $price = $request->input('price');
        
        if (!is_numeric($final)) {
            return response()->json(false);
        }

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex("final", $final);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function updateCategory()
    {
        $products = $this->productRepository->listProductsInOrderDatatable();

        return view('admin.pages.product.index_update_category')->with([
            'products' => $products,
            'productScale' => $this->productScaleRepository->all(),
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'ASC'),
        ]);
    }

    public function updateCategory2(Request $request)
    {
        $productId = $request->input('id');
        $categoryId = $request->input('category_id');
        $subCategoryId = $request->input('sub_category_id');
        $productSubCategoryId = $request->input('product_sub_category_id');

        if (empty($productId)) {
            Mensaje::flashMessageWarningImportant("Seleccione un producto para actualizar su categoria.");
            return redirect()->back();
        }

        try {
            DB::beginTransaction();

            $productsSelected = count($productId);

            for ($i = 0; $i < $productsSelected; $i++) {
                $product = $this->productRepository->find($productId[$i]);
                $repo = new ProductRepository($product);
                $repo->update([
                    'product_sub_category_id' => $productSubCategoryId,
                ]);
            }

            DB::commit();

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->withInput();
        }

        return $this->updateCategory();
    }

    public function updateInIndex(Request $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');
        $productId = $request->input('productId');

        try {
            $product = $this->productRepository->find($productId);
            $repo = new ProductRepository($product);
            $repo->updateItemInIndex($column, $value);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'type' => 'error',
                'message' => __('message.update_error')
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => __('message.update_success')
        ]);
    }

    public function searchSubCategoryAjax(Request $request)
    {
        $categoryId = $request->input('categoryId');

        $subcategories = $this->subCategoryRepository->searchSubCategories($categoryId);

        $viewSelectSubCategories = view('admin.pages.product._select_subCategories')
            ->with([
                'subcategories' => $subcategories,
            ])
            ->render();

        return response()->json([
            'viewSubCategories' => $viewSelectSubCategories,
        ]);
    }

    public function searchSubCategory2Ajax(Request $request)
    {
        $subCategoryId = $request->input('subCategoryId');

        $subcategories = $this->productSubCategoryRepository->searchSubCategories($subCategoryId);

        $viewSelectSubCategories = view('admin.pages.product._select_subCategories')
            ->with([
                'subcategories' => $subcategories,
            ])
            ->render();

        return response()->json([
            'viewSubCategories' => $viewSelectSubCategories,
        ]);
    }

    public function exportProduct()
    {   
        /*$productos = Product::all();
        return view('admin.pages.product.export', [
            'productos' => Product::all()
        ]);*/
        return Excel::download(new ProductsExport, 'MiMercadoDelivery.xlsx');
   }

    public function updateProductWithAjax(Request $request)
    {
        $productId = $request->input('pk');
        $value = $request->input('value');
        $column = $request->input('name');
        

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'orden' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'product_unit_measure_id' => 'required',
            'product_scale_id' => 'required',
            'product_today' => 'required',
            'disponible' => 'required',
            'porcentaje'=>'required',
            'monto'=>'required',
            'final'=>'required'
        ]);

        try {
            $product = $this->productRepository->find($request->input('productId'));
            $repo = new ProductRepository($product);
            $repo->update([
                'name' => $request->input('name'),
                'orden' => $request->input('orden'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'product_unit_measure_id' => $request->input('product_unit_measure_id'),
                'product_scale_id' => $request->input('product_scale_id'),
                'product_today' => $request->input('product_today'),
                'disponible' => $request->input('disponible'),
                'porcentaje' => $request->input('porcentaje'),
                'monto' => $request->input('monto'),
                'final' => $request->input('price')+$request->input('porcentaje')*$request->input('price')+$request->input('monto'),
                'provider_id' => $request->input('provider_id'),
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

    public function importarExcel(Request $request){
       
         /** El método load permite cargar el archivo definido como primer parámetro */
        \Excel::load($request->excel, function($reader) {
            $excel = $reader->get();

            $reader->each(function ($value) {
                $busqueda_productos = Product::where('id',$value->ID)->first();
                if(!isset($busqueda_productos)){
                $productos = Product::orderBy('orden','desc')->get();
                $aux = $productos[0]->orden +1;
                $producto = new Product();
                $producto->orden = $aux;
                $producto->disponible = 'NO';
                $producto->product_today = 0;
                $producto->name = $value['Nombre'];
               // $producto->slug = $value['slug'];
                $producto->price = $value['Precio'];
                $producto->porcentaje = $value['Porcentaje'];
                $producto->monto = $value['Monto'];
                $producto->final = $value['Precio_Final'];
                $producto->state = 1;
                $producto->description = $value['Descripcion'];
                
                $busqueda_escala = ProductUnitMeasure::where('name',$value['Escala'])->where('abrv',$value['Unidades'])->first();
                
                $producto->product_scale_id = 1 ;
                
                $producto->product_unit_measure_id = $busqueda_escala->id;
                
                $producto->product_sub_category_id = $value['Sub_Categoria_2'];
                //$producto->image = 'img/product/'.$value['imagen'];
                $producto->save();
                }
                else{
                    $busqueda_productos->orden = $aux;
                $busqueda_productos->disponible = 'NO';
                $busqueda_productos->product_today = 0;
                $busqueda_productos->name = $value['Nombre'];
               // $producto->slug = $value['slug'];
                $busqueda_productos->price = $value['Precio'];
                $busqueda_productos->porcentaje = $value['Porcentaje'];
                $busqueda_productos->monto = $value['Monto'];
                $busqueda_productos->final = $value['Precio_Final'];
                $busqueda_productos->state = 1;
                $busqueda_productos->description = $value['Descripcion'];
                
                $busqueda_escala = ProductUnitMeasure::where('name',$value['Escala'])->where('abrv',$value['Unidades'])->first();
                
                $busqueda_productos->product_scale_id = 1 ;
                
                $busqueda_productos->product_unit_measure_id = $busqueda_escala->id;
                
                $busqueda_subcategoria = ProductSubCategory::where('id',$value['Sub_Categoria_2'])->first();
                $busqueda_subcategoria->sub_category_id = $value['Sub_Categoria_1'];
                $busqueda_subcategoria->save();
                
                $busqueda_productos->product_sub_category_id = $value['Sub_Categoria_2'];
                //$producto->image = 'img/product/'.$value['imagen'];
                $busqueda_productos->save();
                }
               
            });
           
        });
        return back();
        

    }
}
