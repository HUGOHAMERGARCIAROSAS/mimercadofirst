<?php

namespace App\Http\Controllers\Admin;

use App\src\Models\Category;
use App\src\Models\SliderProduct;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductRepository;
use App\src\Repositories\ProductScaleRepository;
use App\src\Repositories\ProductUnitMeasureRepository;
use App\src\Repositories\SliderRepository;
use App\src\Util\Constants;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class SliderProductController extends Controller
{
    private $sliderRepository;
    private $productRepository;
    private $productScaleRepository;
    private $categoryRepository;
    private $productUnitMeasureRepository;

    public function __construct(SliderRepository $sliderRepository,
                                ProductRepository $productRepository,
                                ProductScaleRepository $productScaleRepository,
                                CategoryRepository $categoryRepository,
                                ProductUnitMeasureRepository $productUnitMeasureRepository)
    {
        $this->sliderRepository = $sliderRepository;
        $this->productRepository = $productRepository;
        $this->productScaleRepository = $productScaleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->productUnitMeasureRepository = $productUnitMeasureRepository;
    }

    public function create()
    {
        return view('admin.pages.slider.product.create')->with([
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'productScale' => $this->productScaleRepository->all(array('*'), 'ID', 'ASC'),
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'asc'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'background' => 'required|image|mimes:jpeg,png,jpg',
            'image' => 'required|image|mimes:png',
            'name' => 'required',
            'price' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $product = $this->productRepository->create([
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $request->file('image'),
                'orden' => $this->productRepository->totalProductForCreate(),
                'product_unit_measure_id' => $request->input('product_unit_measure_id'),
                'product_scale_id' => $request->input('product_scale_id'),
                'product_sub_category_id' => $request->input('product_sub_category_id'),
            ]);

            $product->uploadImage(request()->file('image'), 'image');

            $sliderProduct = SliderProduct::create([
                'product_id' => $product->id,
                'background' => $request->file('background'),
            ]);

            $this->sliderRepository->create([
                'code_slider_advertising' => null,
                'code_slider_product' => $sliderProduct->id,
                'is_advertising' => false,
            ]);

            Mensaje::flashCreateSuccessImportant();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('slider.index');
    }

    public function edit($id)
    {
        return view('admin.pages.slider.product.edit')->with([
            'sliderProduct' => SliderProduct::find($id),
            'productUnitMeasure' => $this->productUnitMeasureRepository->all(),
            'productScale' => $this->productScaleRepository->all(array('*'), 'ID', 'ASC'),
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'asc'),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $sliderProduct = SliderProduct::find($id);
            if ($request->hasFile('background')) {
                $sliderProduct->uploadImage(request()->file('background'), 'background');
            }

            $product = $this->productRepository->find($sliderProduct->product_id);
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->product_unit_measure_id = $request->input('product_unit_measure_id');
            $product->product_scale_id = $request->input('product_scale_id');
            $product->product_sub_category_id = $request->input('product_sub_category_id');

            if ($request->hasFile('image')) {
                $product->uploadImage(request()->file('image'), 'image');
            }

            $productRepository = new ProductRepository($product);
            $productRepository->update($product->toArray());

            Mensaje::flashUpdateSuccessImportant();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $sliderProduct = SliderProduct::find($id);
            $slider = $this->sliderRepository->findOneBy(['code_slider_product' => $sliderProduct->id]);
            $product = $this->productRepository->findOneBy(['id' => $sliderProduct->product_id]);

            if ($sliderProduct->background) {
                unlink(public_path("web/" . $sliderProduct->background));
            }

            $sliderProduct->delete();
            $slider->delete();
            $product->update(['state' => Constants::ESTADO_ELIMINADO, 'orden' => null]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

    public function listCategories()
    {
        $tree = [];
        $childrenSubCategory = [];
        foreach (Category::all() as $item) {
            foreach ($item->subCategories as $sub) {
                $childrenSubCategory[] = [
                    'id' => $sub->id,
                    'text' => $sub->name,
                ];
            }

            $tree[] = [
                'id' => $item->id,
                'text' => $item->name,
                'children' => $childrenSubCategory
            ];
        }

        return $tree;
    }

}
