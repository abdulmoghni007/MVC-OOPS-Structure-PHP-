<?php

namespace App\Services;

class PostService
{
    public static function createPost()
    {
        return response(["message" => "Post created successfully", "user_id" => Auth->user()["id"]], 201);
    }

    public static function handleFormData()
    {
        if (!isset($_POST["title"]) || !isset($_POST["content"])) {
            return response(["message" => "Title and Content is required"], 400);
        }
    }
}
