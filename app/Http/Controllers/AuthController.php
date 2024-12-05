<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Trait\AuthValidationTrait;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Mail\VerifyEmail;
use App\Http\Services\MailService;

class AuthController extends Controller
{
    use AuthValidationTrait;

    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 2;

        $user = User::create($data);
        $this->mailService->successMail($user->email, $user->name);

        return response()->json([
            'message' => 'User registered successfully, please verify your email',
            'data' => $user
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth('api')->attempt($request->validated())) {
            return response()->json(['error' => 'No autorizado'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user(),
        ], 200);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $user = $this->validateAuthenticatedUser();

        if (is_string($user)) {
            return response()->json([
                'status' => false,
                'message' => $user,
            ], 404);
        }

        $token = JWTAuth::fromUser($user);
        $this->mailService->sendResetPasswordMail($user->email, $user->name, $token);

        return response()->json([
            'status' => true,
            'message' => 'Password reset email sent successfully',
        ], 200);
    }

    public function modify(Request $request)
    {
        $user = JWTAuth::setToken($request->input('token'))->authenticate();

        $user->password = Hash::make($request->input('password'));
        $user->save();

        JWTAuth::invalidate($request->input('token'));

        return response()->json([
            'status' => true,
            'message' => 'Password updated successfully',
        ], 200);
    }

    public function logout()
    {
        $authResponse = $this->validateAuthenticatedUser();

        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }

        $token = JWTAuth::getToken();
        if (empty($token)) {
            return response()->json(['error' => 'No token provided'], 400);
        }

        JWTAuth::invalidate($token);

        return response()->json(['message' => 'The user has successfully logged out'], 200);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}
