<?php
namespace App\Support;

use Illuminate\Support\Facades\Auth;

class AuthSupport
{
    static public function authID(): int
    {
        return Auth::user()->id;
    }
}