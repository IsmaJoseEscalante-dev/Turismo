<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use PHPUnit\Framework\Constraint\Count;

class CommentController extends Controller
{
    public function comments($id)
    {
        return Comment::where('tour_id', $id)->where('status', 'si')->orderByDesc('created_at')->get();
    }

    public function index()
    {
        $comments = Comment::where('read', 'si')->paginate(6);
        return view('admin.comments.index', compact('comments'));
    }

    public function unread()
    {
        $comments = Comment::where('read', 'no')->paginate(3);
        return view('admin.comments.unread', compact('comments'));
    }

    public function commentCount()
    {
        return Comment::where('read', 'no')->count();
    }

    public function store(StoreRequest $request)
    {
        return Comment::create($request->validated());
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }

    public function publish($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update([
            'status' => 'si',
            'read' => 'si',
        ]);
        return redirect()->route('comments.index');
    }

    public function ignore($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update([
            'read' => 'si',
        ]);
        return back();
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }
}
