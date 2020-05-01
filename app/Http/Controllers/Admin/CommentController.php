<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\src\Repositories\CommentRepository;
use App\src\Util\Mensaje;
use Illuminate\Http\Request;
use Exception;
use Log;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $comments = $this->commentRepository->all();

        return view('admin.pages.comment.index')->with([
            'comments' => $comments,
        ]);
    }

    public function create()
    {
        return view('admin.pages.comment.create');
    }

    public function store(Request $request)
    {
        try {
            $comment = $this->commentRepository->create($request->all());

            $comment->compressImage($request->hasFile('image'));

            Mensaje::flashCreateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashCreateErrorImportant();
            return redirect()->back()->withInput($request);
        }

        return redirect()->route('comments.index');
    }

    public function edit($id)
    {
        return view('admin.pages.comment.edit')->with([
            'comment' => $this->commentRepository->find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $comment = $this->commentRepository->find($id);
            $comment->user = $request->input('user');
            $comment->comment = $request->input('comment');

            if ($request->hasFile('image')) {
                $comment->uploadImage(request()->file('image'), 'image');
            }

            $comment->compressImage($request->hasFile('image'));

            $commentRepository = new CommentRepository($comment);
            $commentRepository->update($comment->toArray());

            Mensaje::flashUpdateSuccessImportant();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            Mensaje::flashUpdateErrorImportant();
            return redirect()->back()->withInput();
        }

        return redirect()->route('comments.index');
    }

    public function destroy($id)
    {
        try {
            $comment = $this->commentRepository->find($id);
            $commentRepository = new CommentRepository($comment);
            $commentRepository->delete();
        } catch (Exception $e) {
            Log::debug($e->getMessage());
            return response()->json(['isDeleted' => false]);
        }

        return response()->json(['isDeleted' => true]);
    }

}
