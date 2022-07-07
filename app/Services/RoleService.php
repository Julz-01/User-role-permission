<?php

namespace App\Services;

use App\Models\Roles;

class RoleService
{
    function openRoles()
    {
        $roles = Roles::where('user_id', NULL)
            ->get();

        return $roles;
    }

    function setRole($id, $user_id)
    {
        $role = Roles::find($id);
        $role->user_id = $user_id;
        $role->save();
    }

    public function roles()
    {
        $roles = Roles::all();

        return $roles;
    }

    function resetRole($oldRoleId, $roleId, $userId)
    {
        if (!empty($oldRoleId)) {
            $this->unsetRole($oldRoleId);
        }

        $role = Roles::find($roleId);
        if ($role->user_id !== $userId) {
            $role->user_id = $userId;
            $role->save();
        }
    }

    function unsetRole($id)
    {
        $role = Roles::find($id);
        $role->user_id = NULL;
        $role->save();
    }
}
