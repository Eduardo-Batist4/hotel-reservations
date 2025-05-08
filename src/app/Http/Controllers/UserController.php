<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(protected UserService $userService) {}

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ]);

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

    public function index()
    {
        $users = $this->userService->getUsers(Auth::id());
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'role' => 'sometimes|in:admin,customer',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8'
        ]);

        $user = $this->userService->createUser($validateData);

        return response()->json($user, 201);
    }

    public function show(int $id)
    {
        return response()->json($this->userService->getUser($id), 200);
    }

    public function update(Request $request, int $id)
    {
        $validateData = $request->validate([
            'name' => 'sometimes|string|min:3|max:255',
            'email' => 'sometimes|string|email'
        ]);

        $updatedUser = $this->userService->updateUser($validateData, $id);

        return response()->json($updatedUser, 201);
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return response()->json('Successfully deleted!', 204);
    }
}
