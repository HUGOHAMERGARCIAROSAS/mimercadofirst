<?php

namespace App\Http\Controllers\Admin;

use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ProductScaleRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Repositories\ProductUnitMeasureRepository;
use App\src\Repositories\SliderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Exception;
use Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    private $productRepository;
    private $categoryRepository;
    private $subCategoryRepository;
    private $productSubCategoryRepository;
    private $productScaleRepository;
    private $sliderRepository;
    private $productUnitMeasureRepository;

    public function __construct(ProductRepository $productRepository,
                                CategoryRepository $categoryRepository,
                                SubCategoryRepository $subCategoryRepository,
                                ProductSubCategoryRepository $productSubCategoryRepository,
                                ProductScaleRepository $productScaleRepository,
                                SliderRepository $sliderRepository,
                                ProductUnitMeasureRepository $productUnitMeasureRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
        $this->productScaleRepository = $productScaleRepository;
        $this->sliderRepository = $sliderRepository;
        $this->productUnitMeasureRepository = $productUnitMeasureRepository;
    }

    public function index()
    {
        return view('admin.import.index');
    }

    public function loadExcel(Request $request)
    {
        $excelProducts = "public/admin/excel/load_data_mi_mercado.xlsx";

        Excel::load($excelProducts, function ($reader) {
            try {
                DB::beginTransaction();

                set_time_limit(0);

                $reader->each(function ($row) {
                    $this->productRepository->create([
                        'orden' => $row->orden,
                        'image' => $row->image,
                        'product_sub_category_id' => $row->product_sub_category_id,
                        'name' => $row->name,
                        'description' => $row->description,
                        'price' => $row->price,
                        'product_unit_measure_id' => $row->product_unit_measure_id,
                        'product_scale_id' => $row->product_scale_id,
                        'product_today' => $row->product_today,
                        'disponible' => $row->disponible,
                    ]);
                });

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                Log::error($e->getMessage());
            }
        });

        return ["exit"];
    }

}
