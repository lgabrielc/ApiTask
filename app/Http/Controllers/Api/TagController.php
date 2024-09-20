<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return response()->json($tags, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tag = $this->tagService->createTag($request->all());
            return response()->json($tag, 201);
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
            $tag = $this->tagService->getTagById($id);
            return response()->json($tag, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $tag = $this->tagService->updateTag($request->all(), $id);
            return response()->json($tag, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json(['message' => 'Tag not found'], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->tagService->deleteTag($id);
            return response()->json(['message' => 'Tag deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json(['message' => 'Tag not found'], 404);
        }
    }
}
