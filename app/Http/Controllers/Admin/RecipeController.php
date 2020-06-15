<?php

namespace App\Http\Controllers\Admin;

use App\src\Repositories\RecipeRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\src\Models\Recipe;
use Exception;
use Log;

class RecipeController extends Controller
{
    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function index()
    {
        $variable = auth()->user()->id;
        $recipes = Recipe::where('proveedor_id', $variable)->get();
        return view('admin.pages.recipe.index')->with([
            'recipes' => $recipes
        ]);
    }

    public function create()
    {
        return view('admin.pages.recipe.create');
    }

    public function store(Request $request)
    {
        try {
            $recipe = $this->recipeRepository->create($request->all());

           // $recipe->compressImage($request->hasFile('image'));

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('recipes.index');
    }

    public function edit($id)
    {
        return view('admin.pages.recipe.edit')->with([
            'recipe' => $this->recipeRepository->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $recipe = $this->recipeRepository->find($id);
            $recipe->title = $request->input('title');
            $recipe->description = $request->input('description');

            if ($request->hasFile('image')) {
                $recipe->uploadImage(request()->file('image'), 'image');
            }

            //$recipe->compressImage($request->hasFile('image'));

            $recipeRepository = new RecipeRepository($recipe);
            $recipeRepository->update($recipe->toArray());

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('recipes.index');
    }

    public function destroy($id)
    {
        try {
            $recipe = $this->recipeRepository->find($id);
            $recipeRepository = new RecipeRepository($recipe);
            $recipeRepository->delete();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }
}
