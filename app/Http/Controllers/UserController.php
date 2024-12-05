<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Trait\AuthValidationTrait;

class UserController extends Controller
{
    use AuthValidationTrait;

    public function getUserWithPosts($userId)
    {
        $authResponse = $this->validateAuthenticatedUser();
        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        $searchedUser = User::with(['posts', 'sharedPosts', 'favoritedPosts'])->find($userId);
        if (!$searchedUser) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $searchedUser,
        ], 200);
    }
}
