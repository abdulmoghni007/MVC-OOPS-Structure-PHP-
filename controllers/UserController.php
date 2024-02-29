<?php

namespace App\controllers;

use App\Services\UserService;

class UserController extends Controller
{
    public function login()
    {
        try {
            return UserService::login();
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
    public function register()
    {
        try {
            return UserService::register();
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }

    public function deleteUsers()
    {
        try {
            return UserService::deleteUser();
        } catch (\Exception $e) {
            return response(["message" => $e->getMessage()], 500);
        }
    }
}
