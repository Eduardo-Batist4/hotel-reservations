<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        $user = $this->userService->findUser($validateData['email']);

        if(!$user || ! Hash::check($validateData['password'], $user->password)) {
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getUsers();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->userService->getUser($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $updatedUser = $this->userService->updateUser($validateData, $id);

        return response()->json($updatedUser, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userService->deleteUser($id);
    }
}
