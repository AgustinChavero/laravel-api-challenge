<?php

namespace App\Trait;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

trait AuthValidationTrait
{
    /**
     * Validate if the user is authenticated via JWT.
     *
     * @return \App\Models\User|string
     */
    public function validateAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return 'User not found';
            }

            return $user;
        } catch (TokenExpiredException $e) {
            return 'Token has expired';
        } catch (TokenInvalidException $e) {
            return 'Token is invalid';
        } catch (JWTException $e) {
            return 'Token is missing';
        }
    }
}
