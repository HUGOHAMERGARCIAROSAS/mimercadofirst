<?php

namespace App\Providers;

use App\src\Models\Category;
use App\src\Models\SubCategory;
use App\src\Repositories\SubCategoryRepository;
use Illuminate\Support\ServiceProvider;
use Session;

class CarritoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $subCategoryRepository = new SubCategoryRepository(new SubCategory());

        view()->composer("*", function ($view) use ($subCategoryRepository) {

            $cart = Session::get('coupon');
            $descuento = 0;
            $total = 0;
            $codigo = 0;

            $categoryLimpieza = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_LIMPIEZA);
            $categoryAbarrotes = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_ABARROTES);
            $categoryCuidadoPersonal = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_CUIDADO_PERSONAL);
            $categoryFrutas = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_FRUTAS);
            $categoryLicores = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_BEBIDAS_LICORES);
            $categoryMascotas = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_MASCOTAS);
            $categoryBabys = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_BABYS);
            $categoryOtros = $subCategoryRepository->searchSubCategories(Category::$CATEGORY_OTROS);

            $view->with([
                'cart' => $cart,
                'descuento' => $descuento,
                'total' => $total,
                'codigo' => $codigo,
                'isValidate' => false,
                'categoryLimpieza' => $categoryLimpieza,
                'categoryAbarrotes' => $categoryAbarrotes,
                'categoryCuidadoPersonal' => $categoryCuidadoPersonal,
                'categoryLicores' => $categoryLicores,
                'categoryMascotas' => $categoryMascotas,
                'categoryFrutas' => $categoryFrutas,
                'categoryBabys' => $categoryBabys,
                'categoryOtros' => $categoryOtros,
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
