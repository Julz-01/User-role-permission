<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryContract;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return response()->json(['users' => $this->userRepository->all()], 200);
    }

    public function store(UserRequest $request)
    {
        return response()->json(['data' => $this->userRepository->store($request)], 201);
    }

    public function findById($id)
    {
        return response()->json(['user' => $this->userRepository->findById($id)], 200);
    }

    public function update($id, Request $request)
    {
        return response()->json(['data' => $this->userRepository->update($id, $request)], 200);
    }

    public function delete($id)
    {
        return response()->json(['data' => $this->userRepository->delete($id)], 200);
    }
}
