<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\src\Repositories\BannerRepository;
use App\src\Repositories\CommentRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Repositories\SliderRepository;
use App\src\Util\Constants;
use Illuminate\Http\Request;
use Exception;

class WebController extends Controller
{
    private $productRepository;
    private $commentRepository;
    private $sliderRepository;
    private $bannerRepository;
    private $productSubCategoryRepository;

    public function __construct(ProductRepository $productRepository,
                                CommentRepository $commentRepository,
                                SliderRepository $sliderRepository,
                                BannerRepository $bannerRepository,
                                SubCategoryRepository $productSubCategoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->commentRepository = $commentRepository;
        $this->sliderRepository = $sliderRepository;
        $this->bannerRepository = $bannerRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
    }

    public function index()
    {
        $lastProducts = $this->productRepository->productsWithProductToday('');
        $products = $this->productRepository->listProductsInOrderWeb()->all();

        $sliders = $this->sliderRepository->allAvailable();

        $comments = $this->commentRepository->all();

        $banner = $this->bannerRepository->findOneBy([
            'state_image' => Constants::ESTADO_HABILITADO,
        ]);

        return view('web.pages.home.index')->with([
            'lastProducts' => $lastProducts,
            'products' => $this->productRepository->paginateArrayResults($products, 16),
            'sliders' => $sliders,
            'comments' => $comments,
            'banner' => $banner,
        ]);
    }

    public function listSliders()
    {
        return ['sliders' => $this->sliderRepository->allAvailable()];
    }

    public function search()
    {
        $name = request()->input('q');

        if (request()->has('q') && request()->input('q') != '') {
            $products = $this->productRepository->searchProduct($name);
        } else {
            $products = $this->productRepository->listProductsInOrderWeb();
        }

        return view('web.pages.home.search')->with([
            'name' => $name,
            'products' => $this->productRepository->paginateArrayResults($products->all(), 16),
        ]);
    }


}
