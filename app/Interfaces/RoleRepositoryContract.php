<?php

namespace App\Interfaces;

interface RoleRepositoryContract 
{
    public function all();

    public function store(array|object $data);

    public function findById(int $id);

    public function update(int $id, array|object $data);

    public function delete(int $id);

    public function openRoles();
}
