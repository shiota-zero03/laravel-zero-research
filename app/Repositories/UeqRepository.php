<?php

namespace App\Repositories;

use App\Models\UeqData;
use App\Repositories\TicketDataRepository;
class UeqRepository
{
    public function __construct()
    {
        $this->ticket = new TicketDataRepository();
    }
    public function getByTicketId($id)
    {
        return UeqData::where('ticket_id', $id)->get();
    }
    public function getAverageByTicketIdAndType($id, $type)
    {
        return UeqData::where('ticket_id', $id)->average($type);
    }
    public function create(array $data)
    {
        return UeqData::create($data);
    }
    public function insert(array $data)
    {
        return UeqData::insert($data);
    }
}
