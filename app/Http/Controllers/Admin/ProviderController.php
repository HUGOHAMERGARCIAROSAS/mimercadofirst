<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\src\Models\Product;
use App\src\Models\Order_provider;
use Illuminate\Support\Facades\Hash;
use DB;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ProductScaleRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Repositories\ProductUnitMeasureRepository;
use App\src\Repositories\SliderRepository;
use App\src\Util\Mensaje;
use Exception;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProviderController extends Controller
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

    public function index(){
        $productos = Product::all();
        $providers = Admin::where('role','provider')->get();
        return view('admin.pages.providers.index')->with(compact('providers','productos'));
    }

    public function create(){
        return view('admin.pages.providers.create');
    }

    public function store(Request $request){
        
            $usuario = new Admin($request->all());
            $usuario->password = Hash::make($request->password);
            $usuario->save();
        
            return redirect()->route('admin.providers.index');

    }
    public function asignar(){
        $productos = Product::all();
        $usuarios = Admin::findOrFail($id);
        return view('admin.pages.providers.asignar')->with(compact('productos','usuarios'));
    }

    public function guardar(Request $request){
        //dd($request->all());
        foreach ($request->masa as $item =>$value) {
            $xd = new Order_provider();
            $xd->id_provider = $request->usuarios;
            $xd->id_product = $request->masa[$item];
            $xd->save();
        }
        return redirect()->route('admin.providers.index');
        
    }


    


    public function updateCategory()
    {
        $products = $this->productRepository->listProductsInOrderDatatable();
        $users = Admin::where('role','provider')->get();

        return view('admin.pages.providers.asignar')->with(compact('users'))->with([
            'products' => $products,
            //'productScale' => $this->productScaleRepository->allWithEstateActive('id', 'ASC')->all(),
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'ASC'),
            
        ]);
    }

    public function updateCategory2(Request $request)
    {
        $productId = $request->input('id');
        $proveedorId = $request->input('proveedor_id');

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
                    'provider_id' => $proveedorId,
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

    public function productos(Request $request){
        $variable = auth()->user()->id;
        $usuarios = Admin::where('id', $variable)->first();
        $orders   = Product::where('provider_id', $variable)->get();
        //dd($orders);
        return view('admin.pages.providers.productos')->with(compact('orders'));
    }
    
    public function ver($id){
        $orders   = Product::where('provider_id', $id)->get();
        $usuarios = Admin::where('id',$id)->first();
        return view('admin.pages.providers.ver')->with(compact('orders','usuarios'));
    }
    
    
    public function updateUser(Request $request, $id)
    {
            DB::beginTransaction();
            $usuarios = Admin::findOrFail($id);
            $usuarios->codigo_proveedor = $request->codigo_proveedor;
            $usuarios->nombres = $request->nombres;
            $usuarios->apellidos = $request->apellidos;
            $usuarios->email = $request->email;
            $usuarios->save();
            
            DB::commit();
            return redirect()->route('admin.providers.index');
    }


}
