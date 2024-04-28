<?php

namespace App\Repositories;

use App\Models\TicketData;

class TicketDataRepository
{
    public function getTicketNumber()
    {
        return TicketData::generateUniqueNumber();
    }
    public function getByUserId($id, $type)
    {
        return TicketData::where('user_id', $id)->where('type', $type)->first();
    }
    public function create($data)
    {
        return TicketData::create($data);
    }
    public function deleteByUserId($id, $type)
    {
        return TicketData::where('user_id', $id)->where('type', $type)->delete();
    }
}
