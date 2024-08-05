<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Auth::user()->posts;
        return view('Posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        //dd($request->all());

        Post::create($request->all());
        return redirect()->route('posts.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
        if (Auth::id() != $post->user_id) {
            abort(403);
        }
        return view('Posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function test()
    {
        $counts = Post::groupBy('user_id')->select('user_id', DB::raw('count(*) as count'))->get();
        dd($counts);
    }
}

