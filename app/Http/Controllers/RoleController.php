<?php

namespace App\Http\Controllers;

use App\Interfaces\RoleRepositoryContract;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepositoryContract $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        return response()->json(['roles' => $this->roleRepository->all()], 200);
    }

    public function store(RoleRequest $request)
    {
        return response()->json(['data' => $this->roleRepository->store($request)], 201);
    }

    public function update($id, RoleRequest $request)
    {
        return response()->json(['data' => $this->roleRepository->update($id, $request)], 200);
    }

    public function delete($id)
    {
        return response()->json(['data' => $this->roleRepository->delete($id)], 200);
    }

    public function openRoles()
    {
        return response()->json(['roles' => $this->roleRepository->openRoles()], 200);
    }
}
