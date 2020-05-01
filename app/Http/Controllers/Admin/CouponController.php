<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCuponRequest;
use App\src\Repositories\CouponRepository;
use App\src\Repositories\ProductoRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class CouponController extends Controller
{
    private $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index()
    {
        return view('admin.pages.coupon.index')->with([
            'coupons' => $this->couponRepository->all(),
        ]);
    }

    public function store(CreateCuponRequest $request)
    {
        try {
            $this->couponRepository->create($request->only('code', 'discount'));

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
