<?php

namespace App\Http\Controllers\Admin;

use App\src\Repositories\TipRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Log;

class TipController extends Controller
{
    private $tipRepository;

    public function __construct(TipRepository $tipRepository)
    {
        $this->tipRepository = $tipRepository;
    }

    public function index()
    {
        return view('admin.pages.tip_tabla.index')->with([
            'tips' => $this->tipRepository->all(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.tip_tabla.create');
    }

    public function store(Request $request)
    {
        try {

            $tip = $this->tipRepository->create($request->only('title', 'description', 'image'));

            $tip->compressImage($request->hasFile('image'));

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('tips.index');
    }

    public function edit($id)
    {
        return view('admin.pages.tip_tabla.edit')->with([
            'tip' => $this->tipRepository->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $tip = $this->tipRepository->find($id);
            $tip->title = $request->input('title');
            $tip->description = $request->input('description');

            if ($request->hasFile('image')) {
                $tip->uploadImage(request()->file('image'), 'image');
            }

            $tip->compressImage($request->hasFile('image'));

            $tipRepository = new TipRepository($tip);
            $tipRepository->update($tip->toArray());

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back();
        }

        return redirect()->route('tips.index');
    }

    public function destroy($id)
    {
        try {
            $tip = $this->tipRepository->find($id);
            $tipRepository = new TipRepository($tip);
            $tipRepository->delete();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }
}
