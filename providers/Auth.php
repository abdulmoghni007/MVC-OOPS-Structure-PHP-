<?php

namespace App\Providers;

class Auth
{
    private $user;
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function user()
    {
        return $this->user;
    }
}
