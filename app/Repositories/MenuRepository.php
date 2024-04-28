<?php

namespace App\Repositories;

use App\Models\MenuAccess;

class MenuRepository
{
    public function getAll()
    {
        return MenuAccess::orderByDesc('id')->get();
    }
    public function getById($id)
    {
        return MenuAccess::findOrFail($id);
    }
    public function createData(array $data)
    {
        return MenuAccess::firstOrCreate($data);
    }
    public function updateData(array $data, $id)
    {
        return MenuAccess::findOrFail($id)->update($data);
    }
    public function deleteData($id)
    {
        return MenuAccess::findOrFail($id)->delete();
    }
}
