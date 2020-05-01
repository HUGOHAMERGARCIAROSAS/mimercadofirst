<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\src\Models\Banner;
use App\src\Repositories\BannerRepository;
use App\src\Util\Constants;
use App\src\Util\Mensaje;
use Exception;
use Illuminate\Http\Request;
use Log;

class BannerController extends Controller
{
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        $banners = $this->bannerRepository->all();

        return view('admin.pages.banner.index')->with([
            'banners' => $banners,
        ]);
    }

    public function create()
    {
        return view('admin.pages.banner.create');
    }

    public function store(Request $request)
    {
        try {
            $banner = $this->bannerRepository->create($request->all());

            $banner->compressImage($request->hasFile('image'));

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput($request);
        }

        return redirect()->route('banners.index');
    }

    public function edit(Banner $banner)
    {
        try {
            $banners = $this->bannerRepository->all();
            foreach ($banners as $item) {
                $item->state_image = Constants::ESTADO_BANNER_INHABILITADO;
                $item->update();
            }

            $banner->state_image = Constants::ESTADO_BANNER_HABILITADO;
            $banner->update();

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('banners.index');
    }

    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

}
