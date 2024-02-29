<?php

namespace App\Services;

class UserService
{
    public static function login()
    {
        self::validateFormData();
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = "SELECT id FROM users WHERE username = :username AND password = :password";
        $user = DB->first($query, ["username" => $username, "password" => $password]);
        if (!$user) {
            return response(["message" => "Username or Password incorrect"], 400);
        }
        $token = self::generateToken();
        $query = "UPDATE users SET token = :token WHERE id = :id";
        DB->update($query, ["token" => $token, "id" => $user["id"]]);
        return response(["message" => "Login Success", "token" => $token], 200);
    }

    public static function register()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query = "SELECT id FROM users WHERE username = :username ";
        $user = DB->first($query, ["username" => $username]);
        if ($user) {
            return response(["message" => "User already Existed"], 400);
        }
        $query = "INSERT INTO users (username, password)
VALUES (:username, :password)";
        $user = DB->insert($query, ["username" => $username, "password" => $password]);
        return response(["message" => "Register Successful"], 200);


    }

    public static function deleteUser()
    {
        $username = $_POST['username'];
        $query = "SELECT id FROM users WHERE username = :username";
        $user = DB->delete($query, ["username" => $username]);
        if ($user) {
            $query = "DELETE FROM users WHERE username = :username ";
            $user = DB->delete($query, ["username" => $username]);
            if ($user) {
                return response(["message" => "User Deleted Successfully"], 200);
            }
            return response(["message" => "User not Deleted"], 400);
        }
            return response(["message" => "User not found"], 400);


        }
        public
        static function generateToken()
        {
            $token = bin2hex(random_bytes(32));
            $query = "SELECT id FROM users WHERE token = :token";
            $user = DB->first($query, ["token" => $token]);
            if ($user) {
                return self::generateToken();
            }
            return $token;
        }

        public
        static function validateToken()
        {
            $token = $_POST['token'];
            $query = "SELECT * FROM users WHERE token = :token";
            $user = DB->first($query, ["token" => $token]);
            if (!$user) {
                return response(["message" => "Token is invalid"], 400);
            }
            Auth->setUser($user);
        }

        public
        static function validateFormData()
        {
            if (!isset($_POST['username']) || !isset($_POST['password'])) {
                response(["message" => "Username & Password is required"], 400);
            }
        }
    }
