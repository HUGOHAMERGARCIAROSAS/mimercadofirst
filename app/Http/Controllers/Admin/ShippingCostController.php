<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\src\Repositories\ShippingCostRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\src\Models\Departamento;
use App\src\Models\Provincia;
use App\src\Models\Distrito;
use Exception;
use Log;

class ShippingCostController extends Controller
{
    private $shippingCostRepository;

    public function __construct(ShippingCostRepository $shippingCostRepository)
    {
        $this->shippingCostRepository = $shippingCostRepository;
    }

    public function index()
    {
        $departamentos = Departamento::all();
        $provincias = Provincia::where('idDepa',15)->get();
        $distritos = Distrito::where('idProv',127)->get();
        return view('admin.pages.shipping_cost.index')->with([
            'costs' => $this->shippingCostRepository->listShippingCostWithOrder(),
            'departamentos' => $departamentos,
            'provincias' => $provincias,
            'distritos' => $distritos,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->shippingCostRepository->create($request->only('distrito_id', 'cost','zona'));

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('shipping-cost.index');
    }

    public function update(Request $request, $id)
    {
        try {
            $cost = $this->shippingCostRepository->find($id);
            $shippingCostRepository = new ShippingCostRepository($cost);
            $shippingCostRepository->update($request->only('distrito_id', 'cost','zona'));

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('shipping-cost.index');
    }

    public function destroy($id)
    {
        try {
            $shippingCost = $this->shippingCostRepository->find($id);
            $shippingCostRepository = new ShippingCostRepository($shippingCost);
            $shippingCostRepository->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

    public function updateOrder(Request $request)
    {
        $position = $request->input('position');
        $id = $request->input('id');

        try {
            $costWithPosition = $this->shippingCostRepository->findOneBy([
                'order' => $position
            ]);

            if (!empty($costWithPosition)) {
                $costRepository = new ShippingCostRepository($costWithPosition);
                $costRepository->update([
                    'order' => null
                ]);
            }

            $cost = $this->shippingCostRepository->find($id);
            $repo = new ShippingCostRepository($cost);
            $repo->update([
                'order' => $position
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json([
            'view_tbody_products' => true,
            'message' => __('message.update_order')
        ]);
    }

    public function updateInTable(Request $request)
    {
        $this->validate($request, [
            'cost' => 'required|numeric'
        ], [], [
            'cost' => 'Tarifario',
        ]);

        $value = $request->input('value');
        $column = $request->input('column');
        $id = $request->input('id');

        try {
            $product = $this->shippingCostRepository->find($id);
            $repo = new ShippingCostRepository($product);
            $repo->updateItemInTable($column, $value);
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

}
