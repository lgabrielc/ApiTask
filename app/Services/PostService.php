<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PostService
{

    public function getAllPosts()
    {
        return Post::all();
    }
    public function createPost($data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|min:3|max:30',
            'content' => 'required|string|min:10|max:200',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $post = Post::create($data);
        return $post;
    }
    public function getPostById($id)
    {
        return  Post::findOrFail($id);
    }
    public function updatePost($data, $id)
    {
        $post = Post::findOrFail($id);

        $validator = Validator::make($data, [
            'title' => 'required|string|min:3|max:30',
            'content' => 'required|string|min:10|max:200',
        ]);
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $post->update($data);
        return $post;
    }
    public function deletePost($id)
    {
        return Post::findOrFail($id)->delete();
    }
}
