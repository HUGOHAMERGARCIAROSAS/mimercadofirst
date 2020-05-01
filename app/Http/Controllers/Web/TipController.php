<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\src\Models\Tip;
use App\src\Repositories\CategoryRepository;
use App\src\Repositories\TipRepository;
use Exception;

class TipController extends Controller
{
    private $tipRepository;
    private $categoryRepository;

    public function __construct(TipRepository $tipRepository, CategoryRepository $categoryRepository
    )
    {
        $this->tipRepository = $tipRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $tips = $this->tipRepository->listTips()->all();

        return view('web.pages.tips.index')->with([
            'tips' => $this->tipRepository->paginateArrayResults($tips, 6),
            'categories' => $this->categoryRepository->allWithEstateActive('id','ASC'),
        ]);
    }

    public function detail(Tip $tip)
    {
        $lastTips = Tip::orderBy('id', 'DESC')
            ->take(5)
            ->get();

        return view('web.pages.tips.detalle')->with([
            'tip' => $tip,
            'lastTips' => $lastTips,
            'categories' => $this->categoryRepository->allWithEstateActive('id','ASC'),
        ]);
    }

}
