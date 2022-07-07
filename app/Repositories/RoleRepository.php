<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryContract;
use App\Models\Roles;
use App\Services\RoleService;

class RoleRepository implements RoleRepositoryContract
{
    protected $model;

    public function __construct(Roles $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function store(array|object $data)
    {
        $role = $this->model->create([
            'role_name' => $data->role_name,
            'description' => $data->description
        ]);

        return $role;
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function update(int $id, array|object $data)
    {
        $role = $this->findById($id);
        $role->role_name = $data->role_name;
        $role->description = $data->description;
        $role->save();

        return $role;
    }

    public function delete(int $id)
    {
        $role = $this->findById($id);
        $role->delete();
    }

    public function openRoles()
    {
        return (new RoleService())->openRoles();
    }
}
