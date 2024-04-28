<?php

namespace App\Repositories;

use App\Models\ItemValidation;
use App\Repositories\ItemGroupRepository;
class ItemValidationRepository
{
    public function __construct()
    {
        $this->ticket = new ItemGroupRepository();
    }
    public function getByTicketId($id)
    {
        return ItemValidation::where('group_id', $id)->get();
    }
    public function getDataOrderByLastNumber($id)
    {
        return ItemValidation::orderByDesc('qualification')->where('group_id', $id)->first();
    }
    public function create(array $data)
    {
        return ItemValidation::create($data);
    }
    public function insert(array $data)
    {
        return ItemValidation::insert($data);
    }
    public function deleteData($id)
    {
        return ItemValidation::find($id)->delete();
    }
}
