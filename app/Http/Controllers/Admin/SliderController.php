<?php

namespace App\Http\Controllers\Admin;

use App\src\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class SliderController extends Controller
{
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function index()
    {
        return view('admin.pages.slider.index')->with([
            'sliders' => $this->sliderRepository->all(),
        ]);
    }

//    public function destroy($id)
//    {
//        try {
//            DB::beginTransaction();
//
//            $slider = $this->sliderRepository->find($id);
//            $repo = new SliderRepository($slider);
//            $repo->update([
//                'state' => Constants::ESTADO_ELIMINADO
//            ]);
//
//            $product = $this->productRepository->find($slider->product_id);
//            $repoProduct = new ProductRepository($product);
//            $repoProduct->update([
//                'state' => Constants::ESTADO_ELIMINADO
//            ]);
//
//            DB::commit();
//        } catch (Exception $e) {
//            DB::rollBack();
//            Log::error($e->getMessage());
//            return response()->json(['isDeleted' => false]);
//        }
//
//        return response()->json(['isDeleted' => true]);
//    }

    public function updateAvailable(Request $request)
    {
        $sliderId = $request->input('id');
        $value = $request->input('value');

        try {
            $slider = $this->sliderRepository->find($sliderId);
            $repo = new SliderRepository($slider);
            $repo->update([
                'available' => $value,
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'type' => 'error',
                'message' => __('message.update_error')
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => __('message.product_update_available')
        ]);
    }

}
