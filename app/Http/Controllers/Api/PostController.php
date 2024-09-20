<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->postService->getAllPosts();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $post = $this->postService->createPost($request->all());
            return response()->json($post, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $post = $this->postService->getPostById($id);
            return response()->json($post, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $post = $this->postService->updatePost($request->all(), $id);
            return response()->json($post, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->postService->deletePost($id);
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }
}
