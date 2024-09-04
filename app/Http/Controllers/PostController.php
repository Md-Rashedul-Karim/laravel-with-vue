<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __invoke(Request $request){
        return view('layouts.app');
    }
    public function index() {
        $posts =  Post::all();
        return response()->json([
            'status' => 200,
            'msg'=>"success",
            'data' => $posts
        ]);
    }

    public function store(Request $request) {
        Post::create($request->all());
    }

    public function show($id) {
        return Post::find($id);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);
        $post->update($request->all());
    }

    public function destroy($id) {
        Post::find($id)->delete();
    }
}
