<?php

namespace App\Repositories;

use App\Models\SusData;
use App\Repositories\TicketDataRepository;
class SusRepository
{
    public function __construct()
    {
        $this->ticket = new TicketDataRepository();
    }
    public function getByTicketId($id)
    {
        return SusData::where('ticket_id', $id)->get();
    }
    public function create(array $data)
    {
        return SusData::create($data);
    }
    public function insert(array $data)
    {
        return SusData::insert($data);
    }
}
