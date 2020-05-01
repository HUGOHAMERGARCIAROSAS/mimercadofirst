<?php

namespace App\Http\Controllers\Admin;

use App\src\Models\SliderAdvertising;
use App\src\Repositories\SliderRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Log;
use yasmuru\LaravelTinify\Facades\Tinify;

class SliderAdvertisingController extends Controller
{
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    public function create()
    {
        return view('admin.pages.slider.advertising.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'image_mobile' => 'required|image|mimes:jpeg,png,jpg',
            'image_desktop' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        try {
            \DB::beginTransaction();

            $advertising = SliderAdvertising::create($request->all());

            $path = public_path('web/' . $advertising->image_mobile);
            $result = Tinify::fromFile($path);
            $result->toFile($path);

            $path2 = public_path('web/' . $advertising->image_desktop);
            $result2 = Tinify::fromFile($path2);
            $result2->toFile($path2);

            $slider = $this->sliderRepository->create([
                'code_slider_advertising' => $advertising->id,
                'code_slider_product' => null,
                'is_advertising' => true,
                'available' => true,
                'state' => true,
            ]);

            Mensaje::flashCreateSuccessImportant();

            \DB::commit();
        } catch (Exception $e) {
            \DB::rollBack();
            Log::error(self::class . ": " . $e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('slider.index');
    }

    public function edit($id)
    {
        return view('admin.pages.slider.advertising.edit')->with([
            'sliderAdvertising' => SliderAdvertising::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $slider = SliderAdvertising::find($id);

            if ($request->hasFile('image_mobile')) {
                $slider->uploadImage(request()->file('image_mobile'), 'image_mobile');
                $path = public_path('web/' . $slider->image_mobile);
                $result = Tinify::fromFile($path);
                $result->toFile($path);
            }

            if ($request->hasFile('image_desktop')) {
                $slider->uploadImage(request()->file('image_desktop'), 'image_desktop');
                $path2 = public_path('web/' . $slider->image_desktop);
                $result2 = Tinify::fromFile($path2);
                $result2->toFile($path2);
            }

            Mensaje::flashUpdateSuccessImportant();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(self::class . ": " . $e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $sliderAdvertising = SliderAdvertising::find($id);
            $slider = $this->sliderRepository->findOneBy(['code_slider_advertising' => $sliderAdvertising->id]);

            if ($sliderAdvertising->image_mobile && $sliderAdvertising->image_desktop) {
                unlink(public_path("web/" . $sliderAdvertising->image_mobile));
                unlink(public_path("web/" . $sliderAdvertising->image_desktop));
            }

            $sliderAdvertising->delete();
            $slider->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(self::class . ": " . $e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

}
