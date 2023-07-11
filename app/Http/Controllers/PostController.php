<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

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
        Gate::authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request) {
        Gate::authorize('create', Post::class);

        $inputs = $request->validate([
            'title' => 'required',
            'post_image' => 'nullable|file',
            'body' => 'required'
        ]);

        if ($request->post_image) {
            $inputs['post_image'] = $request->post_image->store('images');
        }

        Auth()->user()->posts()->create($inputs);

        $request->session()->flash('create', 'Post ' . $inputs['title'] . ' was created!');

        return redirect()->route('post.list');
    }

    public function list() {

        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post) {
        Gate::authorize('view', $post);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request) {

        Gate::authorize('update', $post);

        $inputs = $request->validate([
            'title' => 'required',
            'post_image' => 'nullable|file',
            'body' => 'required'
        ]);

        if ($request->post_image) {
            $inputs['post_image'] = $request->post_image->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];


        try {
            // auth()->user()->posts()->save($post);
            // i believe this is better
            $post->update($inputs);
            $request->session()->flash('update_success', 'Update was succesfull');
        } catch (Exception $e) {
            $request->session()->flash('update_fail', 'Post not updated! ' . $e->getMessage());
        }

        return redirect()->route('post.list');
    }

    public function destroy(Post $post, Request $request) {
        Gate::authorize('delete', $post);
        $post->delete();
        $request->session()->flash('delete', 'Post was deleted!');

        return back();
    }
}
