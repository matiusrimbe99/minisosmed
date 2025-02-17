<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    public function index() {
        $posts = Post::with(['user','comments','likes'])->get();
        return response()->json([
            'success' => true,
            'data' => $posts
        ]);
    }
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'post_content' => 'required|string|max:255',
            'image_url' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $post = Post::create([
            'user_id' => $user->id,
            'post_content' => $request->post_content,
            'image_url' => $request->image_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully!',
            'data' => $post
        ], 201);
    }

    public function show($id) {
        $post = Post::find($id);
        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'post_content' => 'required|string|max:255',
            'image_url' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $post = Post::find($id);
        $post->update([
            'post_content' => $request->post_content,
            'image_url' => $request->image_url,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully!',
            'data' => $post
        ]);
    }

    public function destroy($id) {
        Post::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully!',
        ]);
    }
}
