<?php

namespace App\Http\Controllers\Web;

use App\src\Models\Product2;
use App\src\Models\Recipe;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\RecipeRepository;
use App\src\Util\Constants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class RecipeController extends Controller
{
    private $recipesRepository;
    private $categoryRepository;

    public function __construct(RecipeRepository $recipesRepository,
                                CategoryRepository $categoryRepository)
    {
        $this->recipesRepository = $recipesRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $recipes = Recipe::orderBy('id', 'DESC')
            ->paginate(6);

        return view('web.pages.recipes.index')->with([
            'recipes' => $recipes,
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'ASC'),
        ]);
    }

    public function detail(Recipe $recipe)
    {
        $lastRecipes = Recipe::orderBy('id','DESC')
            ->take(5)
            ->get();

        return view('web.pages.recipes.detalle')->with([
            'recipe' => $recipe,
            'lastRecipes' => $lastRecipes,
            'categories' => $this->categoryRepository->allWithEstateActive('id', 'ASC'),
        ]);
    }
}
