<?php

namespace App\Http\Traits;

use Tymon\JWTAuth\Facades\JWTAuth;

trait LenguagueTrait
{
    public function getAuthenticatedUserCode()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return null;
        }

        return $user->code;
    }
}
