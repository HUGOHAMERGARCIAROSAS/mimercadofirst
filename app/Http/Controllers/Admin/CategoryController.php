<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\ProductSubCategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Util\Mensaje;
use App\src\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Exception;
use Log;

class CategoryController extends Controller
{
    private $categoryRepository;
    private $subCategoryRepository;
    private $productSubCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                SubCategoryRepository $subCategoryRepository,
                                ProductSubCategoryRepository $productSubCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->productSubCategoryRepository = $productSubCategoryRepository;
    }

    public function index()
    {
        $variable = auth()->user()->id;
        $categories = Category::where('proveedor_id', $variable)->get();
        //$subcategories = $this->subCategoryRepository->allWithEstateActive('id', 'ASC');

        return view('admin.pages.category.index')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $name = trim($request->input('name'));
        if ($request->file('image')) {
            $file = $request->file('image');
            $nombre = 'categoria_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/movil/img/categoria/';
            $file->move($path, $nombre);
            $imagen = $nombre;
        }
        try {
            $variable = auth()->user()->id;
            $this->categoryRepository->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'imagen' => $imagen,
                'proveedor_id'=> $variable,
            ]);

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('categories.index');
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
            $category->name = $request->name;
            $pathToYourFile = public_path().'/movil/img/categoria/'.$category->imagen;

            if ($request->file('image')) {

                if(file_exists($pathToYourFile)) { 
                    unlink($pathToYourFile);  
                } 

                $file = $request->file('image');
                $nombre = 'category_'.time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/movil/img/categoria/';
                $file->move($path, $nombre);

                $category->imagen = $nombre;
            }
            $category->save();
           // DB::commit();
            return redirect()->back();
        
        /*$name = trim($request->input('name'));

        try {
            $category = $this->categoryRepository->find($id);
            $repo = new CategoryRepository($category);
            $repo->update([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('categories.index');*/
    }

    public function search(Request $request)
    {
        $categoryId = $request->input('category_id');
        $modal = $request->input('modal');

        $categories = $this->categoryRepository->allWithEstateActive('id', 'ASC');
        $subcategories = [];

        if (empty($categoryId)) {
            $viewTableSubCategories = view('admin.pages.category._tbody_categories')
                ->with([
                    'categories' => $categories,
                ])
                ->render();
        } else {
            $subcategories = $this->subCategoryRepository->searchSubCategories($categoryId);
            $viewTableSubCategories = view('admin.pages.category._tbody_subCategories')
                ->with([
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    'categoryId' => $categoryId,
                ])
                ->render();
        }

        $viewSelectSubCategories = view('admin.pages.category._select_subCategories')
            ->with([
                'subcategories' => $subcategories,
                'modal' => $modal,
            ])
            ->render();

        return response()->json([
            'viewSubCategories' => $viewTableSubCategories,
            'viewSelectSubCategories' => $viewSelectSubCategories,
        ]);
    }


    public function searchSubCategories(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subCategoryId = $request->input('sub_category_id');

        if (!$subCategoryId) {
            $subcategories = $this->subCategoryRepository->searchSubCategories($categoryId);
            $viewTableSubCategories = view('admin.pages.category._tbody_subCategories')
                ->with([
                    'categories' => $this->categoryRepository->allWithEstateActive('id', 'ASC'),
                    'subcategories' => $subcategories,
                    'categoryId' => $categoryId,
                ])
                ->render();
        } else {
            $subcategories = $this->productSubCategoryRepository->searchSubCategories($subCategoryId);
            $viewTableSubCategories = view('admin.pages.category._tbody_subCategories2')
                ->with([
                    'categories' => $this->categoryRepository->allWithEstateActive('id', 'ASC'),
                    'subcategories' => $subcategories,
                    'categoryId' => $categoryId,
                ])
                ->render();
        }

        return response()->json([
            'viewSubCategories2' => $viewTableSubCategories,
        ]);
    }


    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
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

    public function updateInTable(CategoryUpdateRequest $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');
        $id = $request->input('id');

        try {
            $product = $this->categoryRepository->find($id);
            $repo = new CategoryRepository($product);
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
