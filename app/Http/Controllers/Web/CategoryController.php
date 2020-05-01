<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use Exception;
use Log;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $subCategoryRepository;
    private $productSubCategoryRepository;
    private $productRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                SubCategoryRepository $subCategoryRepository,
                                ProductSubCategoryRepository $productSubCategoryRepository,
                                ProductRepository $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
        $this->productRepository = $productRepository;
    }

    public function searchProductsInProductSubCategory($slugCategory, $slugSubcategory, $slugProductSubCategory)
    {
        $category = $this->categoryRepository->findOneBy([
            'slug' => $slugCategory,
        ]);

        $subCategory = $this->subCategoryRepository->findOneBy([
            'slug' => $slugSubcategory,
        ]);

        $productSubCategory = $this->productSubCategoryRepository->findOneBy([
            'slug' => $slugProductSubCategory
        ]);

        if (empty($category) or empty($subCategory) or empty($productSubCategory)) {
            return view('web.pages.home.search')->with([
                'name' => "",
                'products' => $this->productRepository->paginateArrayResults([], 16),
            ]);
        }

        $products = $this->productRepository->listProductsInOrderWebByProductSubCategory($productSubCategory->id);

        return view('web.pages.category.search-products')->with([
            'title' => $category->name,
            'products' => $this->productRepository->paginateArrayResults($products->all(), 12),
            'category' => $category,
            'subCategory' => $subCategory,
        ]);
    }

    public function searchProductsInSubCategory($slugCategory, $slugSubcategory)
    {
        $category = $this->categoryRepository->findOneBy([
            'slug' => $slugCategory,
        ]);

        $subCategory = $this->subCategoryRepository->findOneBy([
            'slug' => $slugSubcategory,
        ]);

        if (empty($category) or empty($subCategory)) {
            return view('web.pages.home.search')->with([
                'name' => "",
                'products' => $this->productRepository->paginateArrayResults([], 16),
            ]);
        }

        $products = $this->productRepository->listProductsInOrderWebBySubCategory($subCategory->id);

        return view('web.pages.category.search-products')->with([
            'title' => $subCategory->name,
            'products' => $this->productRepository->paginateArrayResults($products->all(), 12),
            'category' => $category,
            'subCategory' => $subCategory,
        ]);
    }

    public function searchProductsInCategory($slugCategory)
    {
        $category = $this->categoryRepository->findOneBy([
            'slug' => $slugCategory,
        ]);

        if (empty($category)) {
            return view('web.pages.home.search')->with([
                'name' => "",
                'products' => $this->productRepository->paginateArrayResults([], 16),
            ]);
        }

        $products = $this->productRepository->listProductsInOrderWebByCategory($category->id);

        return view('web.pages.category.search-products')->with([
            'title' => $category->name,
            'products' => $this->productRepository->paginateArrayResults($products->all(), 12),
            'category' => $category,
            'subCategory' => null,
        ]);
    }

}
