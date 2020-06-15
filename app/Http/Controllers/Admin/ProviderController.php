<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use App\src\Models\Product;
use App\src\Models\Category_prov;
use App\src\Models\Order;
use App\src\Models\Order_provider;
use Illuminate\Support\Facades\Hash;
use App\src\Models\Category;
use Illuminate\Support\Str;
use DB;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ProductScaleRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Repositories\ProductUnitMeasureRepository;
use App\src\Repositories\SliderRepository;
use App\src\Util\Mensaje;
use App\src\Models\Departamento;
use App\src\Models\Provincia;
use App\src\Models\Distrito;
use Exception;
use Log;
use App\src\Repositories\OrderRepository;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ProviderController extends Controller
{

    private $productRepository;
    private $categoryRepository;
    private $subCategoryRepository;
    private $orderRepository;
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
                                OrderRepository $orderRepository,
                                ProductUnitMeasureRepository $productUnitMeasureRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
        $this->productScaleRepository = $productScaleRepository;
        $this->orderRepository = $orderRepository;
        $this->sliderRepository = $sliderRepository;
        $this->productUnitMeasureRepository = $productUnitMeasureRepository;
    }

    public function index(){
        $productos = Product::all();
        $providers = Admin::where('role','provider')->get();
        return view('admin.pages.providers.index')->with(compact('providers','productos'));
    }

    public function create(){
        $departamentos = Departamento::all();
        $provincias = Provincia::where('idDepa',15)->get();
        $distritos = Distrito::where('idProv',127)->get();
        $categorias_proveedor = Category_prov::all();
        return view('admin.pages.providers.create')->with(compact('categorias_proveedor', 'departamentos', 'provincias', 'distritos'));
    }

    public function store(Request $request){
        
            $usuario = new Admin($request->all());
            $usuario->password = Hash::make($request->pass);
            if ($request->file('image')) {
                $file = $request->file('image');
                $name = 'logo_proveedor_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/logo_proveedor/';
                $file->move($path, $name);
                $usuario->image = $name;
            }
            $usuario->save();
        
            return redirect()->route('admin.providers.index')->with('mensaje', 'PROVEEDOR REGISTRADO CORRECTAMENTE');

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


    public function pedidos()
    {   $variable = auth()->user()->id;
        //$proveedor_id = Admin::where('id', $variable)->first();
        $xd = DB::table('order')
        ->join('order_detail', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'order_detail.product_id', '=' , 'product.id')
        ->select('order.*')
        ->where('product.provider_id',$variable)
        ->where('order.state', 1)
        ->distinct()
        ->get();
       
        if (!empty($xd)){
            $orders = [];
        }
        foreach ($xd as $key) {
            $orders[] = Order::where('id', $key->id)->first();
           
        }
        //dd($orders);
        return view('admin.pages.providers.pedidos')->with([
            'orders' => $orders,
        ]);
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
        $products   = Product::where('provider_id', $id)->get();
        $usuarios = Admin::where('id',$id)->first();
        
        
        return view('admin.pages.providers.ver')->with(compact('products','usuarios'));
    }

    public function createProduct($id)
    {
        $totalProducts = $this->productRepository->totalProductForCreate();
        $variable = $id;
        $proveedor_id = $id;
        $proveedor =  Admin::where('id',$id)->first();
        $categories = Category::where('proveedor_id', $variable)->get();
        return view('admin.pages.providers.create_producto')->with([
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'productScale' => $this->productScaleRepository->all(null, 'id', 'ASC'),
            'categories' => $categories,
            'totalProducts' => $totalProducts,
            'proveedor_id' => $proveedor_id,
            'proveedor' => $proveedor,
        ]);
    }

    public function categoryVer($id)
    {

        $categories = Category::where('proveedor_id', $id)->get();
        //$subcategories = $this->subCategoryRepository->allWithEstateActive('id', 'ASC');
        $proveedor = Admin::where('id',$id)->first();
        return view('admin.pages.providers.category')->with([
            'categories' => $categories,
            'proveedor' => $proveedor,
        ]);
    }

    public function store_category(Request $request)
    {
        $name = trim($request->input('name'));
        $proveedor_id = $request->proveedor_id;
        if ($request->file('image')) {
            $file = $request->file('image');
            $nombre = 'categoria_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/movil/img/categoria/';
            $file->move($path, $nombre);
            $imagen = $nombre;
        }
        try {
            $this->categoryRepository->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'imagen' => $imagen,
                'proveedor_id'=> $proveedor_id,
            ]);

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }


    public function listProductsDataTable($xd)
    {
    
        $variable = $xd;
        
        $usuarios = Admin::where('id', $variable)->first();
//        $product = $this->productRepository->listProductsInOrderDatatable();
        //            ->orderByRaw('ISNULL(product.orden), product.orden ASC')
        $product = Product::with(['productUnitMeasure', 'productScale'])
            ->where('state', '1')->where('provider_id',$variable);

        return Datatables::eloquent($product)
            ->addColumn('image', function ($row) {
                return ['image' => assetImage($row->image)];
            })
            ->addColumn('actions', function ($row) {
                $editUrl = route('products.edit', $row->id);
                $deleteUrl = route('products.destroy', $row->id);
                $galeryUrl = route('productos.galeria', $row->id);
                $id = $row->id;
                return ([
                    'editUrl' => $editUrl,
                    'deleteUrl' => $deleteUrl,
                    'galeryUrl' => $galeryUrl,
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
    
    public function edit($id){
        $departamentos = Departamento::all();
        $provincias = Provincia::where('idDepa',15)->get();
        $distritos = Distrito::where('idProv',127)->get();
        $categorias_proveedor = Category_prov::all();
        $usuarios = Admin::findOrFail($id);
        return view('admin.pages.providers.edit')->with(compact('usuarios','categorias_proveedor','departamentos', 'provincias','distritos'));
    }
    
    public function updateUser(Request $request, $id)
    {
            
            $usuarios = Admin::findOrFail($id);
            //$usuarios->codigo_proveedor = $request->codigo_proveedor;
            $usuarios->distrito_id = $request->distrito_id;
            $usuarios->ruc = $request->ruc;
            $usuarios->razon_social = $request->razon_social;
            $usuarios->propietario = $request->propietario;
            $usuarios->dni = $request->dni;
            $usuarios->correo = $request->correo;
            $usuarios->telefono = $request->telefono;
            $usuarios->sub_category_id = $request->sub_category_id;
            $usuarios->email = $request->email;
            $usuarios->monto_extra = $request->monto_extra;
            $usuarios->pass = $request->pass;
            $usuarios->password = bcrypt($request->pass);
            //$pathToYourFile = public_path().'/logo_proveedor/'.$usuarios->image;
            
            if ($request->file('image')) {
                $file = $request->file('image');
                $name = 'logo_proveeedor_' . time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/logo_proveedor/';
                $file->move($path, $name);
                $usuarios->image = $name;
            }
            $usuarios->save();
        
            return redirect()->route('admin.providers.index');
    }

    public function updateVisibilidad($id){
        $provider = Admin::findOrFail($id);
       if ($provider->pasarela_active == 0) {
           $provider->pasarela_active = 1;
       }
       else {
           $provider->pasarela_active = 0;
       }
       $provider->save();
      
       return json_encode($provider->pasarela_active);
   }


}
