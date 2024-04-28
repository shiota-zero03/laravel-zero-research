<?php

namespace App\Repositories;

use App\Models\ItemGroup;

class ItemGroupRepository
{
    public function getGroupNumber()
    {
        return ItemGroup::generateUniqueNumber();
    }
    public function getByUserId($id, $type)
    {
        return ItemGroup::where('user_id', $id)->where('type', $type)->first();
    }
    public function create($data)
    {
        return ItemGroup::create($data);
    }
    public function deleteByUserId($id)
    {
        return ItemGroup::where('user_id', $id)->delete();
    }
}
