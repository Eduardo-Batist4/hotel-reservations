<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function __construct(protected UserService $userService) {}

    public function login(LoginUserRequest $request)
    {
        $validateData = $request->validated();

        $user = $this->userService->findUser($validateData['email']);

        if (!$user || ! Hash::check($validateData['password'], $user->password)) {
            return response()->json([
                'error' => 'The provied credentials are incorrect.',
            ], 400);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Succesfully Login!',
            'token' => $token
        ], 201);
    }

    public function register(RegisterUserRequest $request)
    {
        $validateData = $request->validated();

        $user = $this->userService->createUser($validateData);

        return response()->json([
            'message' => 'Successfully user created!',
            'user' => $user
        ], 201);
    }
}
