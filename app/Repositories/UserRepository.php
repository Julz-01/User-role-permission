<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryContract;
use App\Models\User;
use App\Services\RoleService;

class UserRepository implements UserRepositoryContract
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('role')->get();
    }

    public function store(array|object $data)
    {
        $user = $this->model->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);

        if (!empty($data->role)) {
            (new RoleService())->setRole($data->role, $user->id);
        }

        return $user;
    }

    public function findById(int $id)
    {
        return $this->model->with('role')->find($id);
    }

    public function update(int $id, array|object $data)
    {
        $user = $this->findById($id);
        $user->name = $data->name;
        $user->save();

        $oldRoleId = $user->role->id ?? NULL;

        if (!empty($data->role)) {
            (new RoleService())->resetRole($oldRoleId, $data->role, $user->id);
        }

        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->findById($id);
        $roleId = $user->role->id ?? NULL;

        if (!empty($roleId)) {
            (new RoleService())->unsetRole($roleId);
        }

        $user->delete();

        return $user;
    }
}
