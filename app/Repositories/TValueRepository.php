<?php

namespace App\Repositories;

use App\Models\TValue;

class TValueRepository
{
    public function getAll()
    {
        return TValue::orderByDesc('item')->get();
    }
    public function getByItem($item)
    {
        return TValue::where('item', ($item - 1))->first();
    }
}
