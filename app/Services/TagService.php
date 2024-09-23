<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TagService
{
    public function getAllTags()
    {
        return Tag::all();
    }
    public function createTag($data)
    {
        $tag = Tag::create($data);
        return $tag;
    }
    public function getTagById($id)
    {
        return Tag::findOrFail($id);
    }
    public function updateTag($data, $id)
    {
        $tag = Tag::findOrFail($id);

        $validator = Validator::make($data, [
            'name' => 'required|string|min:2',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $tag->update($data);

        return $tag;
    }
    public function deleteTag($id)
    {
        return Tag::findOrFail($id)->delete();
    }
}
