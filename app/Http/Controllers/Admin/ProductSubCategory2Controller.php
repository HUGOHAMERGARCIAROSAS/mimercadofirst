<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSubCategory2CreateRequest;
use App\Http\Requests\ProductSubCategoryUpdateRequest;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductSubCategory2Repository;
use App\src\Util\Mensaje;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Log;

class ProductSubCategory2Controller extends Controller
{
    private $categoryRepository;
    private $productSubCategory2Repository;

    public function __construct(CategoryRepository $categoryRepository,
                                ProductSubCategory2Repository $productSubCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productSubCategory2Repository = $productSubCategoryRepository;
    }

    public function store(ProductSubCategory2CreateRequest $request)
    {
        $name = trim($request->input('name'));
        $categoryId = $request->input('category_id');
        $productSubCategoryId = $request->input('product_sub_category_id');

        try {
            $this->productSubCategory2Repository->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'product_sub_category_id' => $productSubCategoryId,
            ]);

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('categories.index');
    }

    public function update(ProductSubCategoryUpdateRequest $request, $id)
    {
        $name = trim($request->input('name'));
        $categoryId = $request->input('category_id');
        $productSubCategoryId = $request->input('product_sub_category_id');

        try {
            $productSubCategory = $this->productSubCategory2Repository->find($id);
            $repo = new ProductSubCategory2Repository($productSubCategory);
            $repo->update([
                'name' => $name,
                'slug' => Str::slug($name),
                'product_sub_category_id' => $productSubCategoryId,
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
        try {
            $productSubCategory = $this->productSubCategory2Repository->find($id);
            $repo = new ProductSubCategory2Repository($productSubCategory);
            $repo->delete();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

    public function changeOrder(Request $request)
    {
        $position = $request->input('position');
        $id = $request->input('id');

        try {
            $category = $this->categoryRepository->changeOrder($id, $position);
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        return response()->json([
            'message' => __('message.update_order'),
        ]);
    }

    public function updateInTable(ProductSubCategoryUpdateRequest $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');
        $id = $request->input('id');

        try {
            $product = $this->productSubCategory2Repository->find($id);
            $repo = new ProductSubCategory2Repository($product);
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
