<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct(protected UserService $userService) {}

    public function index()
    {
        $users = $this->userService->getUsers(Auth::id());
        return response()->json($users, 200);
    }

    public function show(int $id)
    {
        return response()->json($this->userService->getUser($id), 200);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $validateData = $request->validated();

        $updatedUser = $this->userService->updateUser($validateData, $id);

        return response()->json($updatedUser, 201);
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return response()->json('Successfully deleted!', 204);
    }
}
