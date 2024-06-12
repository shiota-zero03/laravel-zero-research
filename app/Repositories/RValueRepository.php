<?php

namespace App\Repositories;

use App\Models\RValue;

class RValueRepository
{
    public function getAll()
    {
        return RValue::orderByDesc('item')->get();
    }
    public function getByItem($item)
    {
        return RValue::where('item', ($item - 2))->first();
    }
}
