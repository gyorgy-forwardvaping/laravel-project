<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller {
    public function create(Post $post, Request $request) {
        //logged in user

        $inputs = $request->validate([
            'comment' => 'required'
        ]);

        $inputs['status'] = 1;
        // $inputs['user_id'] = auth()->user()->id;
        $inputs['post_id'] = $post->id;

        Auth()->user()->comments()->create($inputs);
        $request->session()->flash('comment-add', 'Your comment was posted. As soon as an administrator check it, will live!');
        return back();
    }

    public function list() {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment, Request $request) {
        $comment->status = 2;
        $comment->update();
        $request->session()->flash('comment-approve', 'comment approved, and now live!');
        return back();
    }

    public function disapprove(Comment $comment, Request $request) {
        $comment->status = 0;
        $comment->update();
        $request->session()->flash('comment-disapprove', 'comment Disapproved, It will not be visible on the visitor side!');
        return back();
    }
}
