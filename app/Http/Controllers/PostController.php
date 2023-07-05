<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
    public function index() {
        return view('blog-post');
    }
    /**
     * Summary of show
     * @param \App\Models\Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post) {
        //the model passed over with an id, so the function already contain the requested data
        // ddd($post->user->name);
        return view('blog-post', ['post' => $post]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        //validation
        $inputs = $request->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'nullable|file',
            'body' => 'required|min:60'
        ]);

        if ($request->post_image) {
            $inputs['post_image'] = $request->post_image->store('images');
        }
    }
}
