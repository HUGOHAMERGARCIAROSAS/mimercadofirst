<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\src\Models\StoreImage;
use App\src\Repositories\StoreImageRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use Exception;
use Log;

class StoreImageController extends Controller
{
    private $storeImageRepository;

    public function __construct(StoreImageRepository $storeImageRepository)
    {
        $this->storeImageRepository = $storeImageRepository;
    }

    public function index()
    {
        return view('admin.pages.store_image.index')->with([
            'images' => $this->storeImageRepository->all(),
        ]);
    }

//    public function create()
//    {
//        return view('admin.pages.store_image.create');
//    }

//    public function edit($id)
//    {
//        try {
//            $storeImage = $this->storeImageRepository->find($id);
//
//            $storeImages = $this->storeImageRepository->all();
//            foreach ($storeImages as $item) {
//                $item->state_image = Constants::ESTADO_INHABILITADO;
//                $item->update();
//            }
//
//            $storeImage->state_image = Constants::ESTADO_HABILITADO;
//            $storeImage->update();
//
//            Mensaje::flashUpdateSuccessImportant();
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//            Mensaje::flashUpdateErrorImportant();
//            return redirect()->back();
//        }
//
//        return redirect()->route('store-image.index');
//    }

    public function store(Request $request)
    {
        try {
            $storeImage = $this->storeImageRepository->create($request->all());

            $storeImage->compressImage($request->hasFile('image'));
            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('store-image.index');
    }

    public function destroy($id)
    {
        try {
            $storeImage = $this->storeImageRepository->find($id);

            if ($this->removeImage($storeImage->image)) {
                $repo = new StoreImageRepository($storeImage);
                $repo->delete();
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

    private function removeImage($image)
    {
        return unlink(public_path('web/' . $image));
    }
}
