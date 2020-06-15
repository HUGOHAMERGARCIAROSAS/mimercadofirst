<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCuponRequest;
use App\src\Repositories\CouponRepository;
use App\src\Repositories\ProductoRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\src\Models\Departamento;
use App\src\Models\Provincia;
use App\src\Models\Distrito;
use App\src\Models\Coupon;
use App\Http\Controllers\Controller;
use Exception;
use Log;
use DB;

class CouponController extends Controller
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index()
    {
        $departamentos = Departamento::all();
        $provincias = Provincia::where('idDepa',15)->get();
        $distritos = Distrito::where('idProv',127)->get();

        $variable = auth()->user()->id;
        $coupons = Coupon::where('proveedor_id', $variable)->get(); 
        return view('admin.pages.coupon.index')->with([
            'coupons' => $coupons,
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
        ]);
    }

    public function getProvincias($departamento_id){
        return DB::table('ubdepartamento')
            ->join('ubprovincia', 'ubdepartamento.idDepa', '=', 'ubprovincia.idDepa')
            ->select('ubprovincia.idProv', 'ubprovincia.provincia')->where('ubprovincia.idDepa',$departamento_id)
            ->get();
    }

    public function getDistritos($provincia_id){
        return DB::table('ubprovincia')
            ->join('ubdistrito', 'ubprovincia.idProv', '=', 'ubdistrito.idProv')
            ->select('ubdistrito.idDist', 'ubdistrito.distrito')->where('ubdistrito.idProv',$provincia_id)
            ->get();
    }

    public function store(CreateCuponRequest $request)
    {
        try {
            $this->couponRepository->create($request->only('proveedor_id','code', 'discount'));

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('coupons.index');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        try {
            $coupon = $this->couponRepository->find($id);
            $couponRepository = new CouponRepository($coupon);
            $couponRepository->delete();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }
}
