<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\src\Repositories\StoreImageRepository;
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
        $storeImage = $this->storeImageRepository->all();

        return view('web.pages.store_image.index')->with([
            'images' => $this->storeImageRepository->all(),
        ]);
    }

}
