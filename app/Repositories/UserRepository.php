<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getByRole($role)
    {
        return User::orderByDesc('id')->where('role', $role)->get();
    }
    public function getById($id)
    {
        return User::findOrFail($id);
    }
    public function createData(array $data)
    {
        return User::firstOrCreate($data);
    }
    public function updateData(array $data, $id)
    {
        return User::findOrFail($id)->update($data);
    }
    public function deleteData($id)
    {
        return User::findOrFail($id)->delete();
    }
}
