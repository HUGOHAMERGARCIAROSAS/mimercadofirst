<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryCreateRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\SubCategoryRepository;
use App\src\Util\Mensaje;
use Exception;
use Illuminate\Support\Str;
use Log;
use Illuminate\Http\Request;
use App\src\Models\SubCategory;

class SubCategoryController extends Controller
{
    private $categoryRepository;
    private $subCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository,
                                SubCategoryRepository $subCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function store(SubCategoryCreateRequest $request)
    {
        $name = trim($request->input('name'));
        $categoryId = trim($request->input('category_id'));
        
        if ($request->file('image')) {
            $file = $request->file('image');
            $nombre = 'sub_categoria_'.time() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/movil/img/subcategoria/';
            $file->move($path, $nombre);
            $imagen = $nombre;
        }
        try {
            $this->subCategoryRepository->create([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => $categoryId,
                'imagen' => $imagen,
                
            ]);

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('categories_prov.index');
    }

    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
            $subcategory->name = $request->name;
            $pathToYourFile = public_path().'/movil/img/subcategoria/'.$subcategory->imagen;

            if ($request->file('image')) {

                /*if(file_exists($pathToYourFile) ||null ) { 
                    unlink($pathToYourFile);  
                }*/

                $file = $request->file('image');
                $nombre = 'subcategory_'.time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/movil/img/subcategoria/';
                $file->move($path, $nombre);

                $subcategory->imagen = $nombre;
            }
            $subcategory->save();
           // DB::commit();
            return redirect()->back();
        /*try {
            DB::beginTransaction();
            $subcategoria = SubCategory::findOrFail($id);
            $subcategoria->name = $request->name;
            $subcategoria->slug = Str::slug($request->name);
            $subcategoria->category_id = $request->category_id;
            $pathToYourFile = public_path().'/movil/img/subcategoria/'.$subcategoria->imagen;
        

            if ($request->file('image')) {

                if(file_exists($pathToYourFile)) { 
                    unlink($pathToYourFile);  
                } 

                $file = $request->file('image');
                $nombre = 'sub_categoria_'.time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/movil/img/subcategoria/';
                $file->move($path, $nombre);

                $subcategoria->imagen = $nombre;
            }
            $subcategoria->save();
            DB::commit();
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }*/
        /*$name = trim($request->input('name'));
        $categoryId = $request->input('category_id');
        $subcategoria = $this->subCategoryRepository->find($id);
        
        $pathToYourFile = public_path().'/movil/img/subcategoria/'.$subcategoria->imagen;
        

            if ($request->file('image')) {

                if(file_exists($pathToYourFile)) { 
                    unlink($pathToYourFile);  
                } 

                $file = $request->file('image');
                $nombre = 'sub_categoria_'.time() . '.' . $file->getClientOriginalExtension();
                $path = public_path() . '/movil/img/subcategoria/';
                $file->move($path, $nombre);

                $imagen = $nombre;
            }

        try {
            $productSubCategory = $this->subCategoryRepository->find($id);
            $repo = new SubCategoryRepository($productSubCategory);
            $repo->update([
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => $categoryId,
                'imagen' => $imagen,
            ]);

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back()->withInput();
        }*/

        
    }

    public function destroy($id)
    {
        $delete = false;

        try {
            $productSubCategory = $this->subCategoryRepository->find($id);
            $repo = new SubCategoryRepository($productSubCategory);

            if (!$repo->hasProductSubCategories()){
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

    public function updateInTable(SubCategoryUpdateRequest $request)
    {
        $value = $request->input('value');
        $column = $request->input('column');
        $id = $request->input('id');

        try {
            $product = $this->subCategoryRepository->find($id);
            $repo = new SubCategoryRepository($product);
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
