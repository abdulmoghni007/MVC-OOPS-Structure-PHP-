<?php

namespace App\controllers;

use App\Services\PostService;

class PostController
{
    public function create()
    {
        return PostService::createPost();
    }
}
