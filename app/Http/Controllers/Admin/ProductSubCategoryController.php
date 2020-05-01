<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSubCategoryCreateRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Util\Mensaje;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Log;

class ProductSubCategoryController extends Controller
{
    private $categoryRepository;
    private $productSubCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                ProductSubCategoryRepository $productSubCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
    }

    public function store(ProductSubCategoryCreateRequest $request)
    {
        $name = trim($request->input('name'));
        $subCategoryId = $request->input('sub_category_id');

        try {
            $this->productSubCategoryRepository->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'sub_category_id' => $subCategoryId,
            ]);

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('categories.index');
    }

    public function update(SubCategoryUpdateRequest $request, $id)
    {
        $name = trim($request->input('name'));
        $subCategoryId = $request->input('sub_category_id');

        try {
            $productSubCategory = $this->productSubCategoryRepository->find($id);
            $repo = new ProductSubCategoryRepository($productSubCategory);
            $repo->update([
                'name' => $name,
                'slug' => Str::slug($name),
                'sub_category_id' => $subCategoryId,
            ]);

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        $delete = false;

        try {
            $productSubCategory = $this->productSubCategoryRepository->find($id);
            $repo = new ProductSubCategoryRepository($productSubCategory);

            if (!$repo->hasProducts()){
                $repo->delete();
                $delete = true;
            }

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => $delete]);
    }

    public function changeOrder(Request $request)
    {
//        $position = $request->input('position');
//        $id = $request->input('id');
//
//        try {
//            $category = $this->categoryRepository->changeOrder($id, $position);
//        } catch (Exception $e) {
//            Log::error($e->getMessage());
//        }
//
//        return response()->json([
//            'message' => __('message.update_order'),
//        ]);
    }

    public function updateInTable(SubCategoryUpdateRequest $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');
        $id = $request->input('id');

        try {
            $product = $this->productSubCategoryRepository->find($id);
            $repo = new ProductSubCategoryRepository($product);
            $repo->updateItemInTable($column, $value);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'type' => 'error',
                'message' => __('message.update_error')
            ]);
        }

        return response()->json([
            'type' => 'success',
            'message' => __('message.update_success')
        ]);
    }
}
