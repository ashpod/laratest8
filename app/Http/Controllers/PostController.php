<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()) {
            return view('post.create');
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->title) && !empty($request->name)) {
            $post = [
                'title' => $request->title,
                'name' => $request->name,
                'created_at' => NOW(3),
                'user_id' => Auth::user()->id,
            ];
            $save = Post::insert($post);

            return redirect('/');
        } else {
            $errors = 'Поля необходимо заполнить';

            return redirect('post/create')->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        $post = Post::find($id);
/*         $comments=Comment::all()->where('post_id', $id); */
        if ($post) {
            return view('posts.showpost', [
                'post' => $post,
/*                 'comments' => $comments, */
            ]);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()) {
            $data['post'] = Post::find($id);
            if (!empty($data['post']->user_id)) {
                if ($data['post']->user_id == Auth::user()->id) {

                    return view('post.create', $data);
//        $this->authorize('edit', $ads);
                } else {
                    abort(404);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data['post'] = Post::find($id);
        if ($data['post']->user_id == Auth::user()->id) {
            $post = [
                'title' => 'required',
                'name' => 'required',
                'user_id' => Auth::user()->id,
            ];

            Post::find($id)->update($request->all());
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $article = Post::find($id);
        if ($post && ($post->user_id == $request->user()->id)) {
            $post->delete();
        }
        return redirect('/');
    }
}
