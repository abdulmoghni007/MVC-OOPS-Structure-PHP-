<?php

use App\Controllers\PostController;
use App\Controllers\UserController;
use App\Providers\Router;

Router::post('/login', [UserController::class, 'login']);

Router::post('/register', [UserController::class, 'register']);
Router::post('/createPost', [PostController::class, 'create'], true);
Router::post('/deleteUser', [UserController::class, 'deleteUsers'],true);
