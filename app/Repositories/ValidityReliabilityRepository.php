<?php

namespace App\Repositories;

use App\Models\ValidityReliabilityData;
use App\Repositories\TicketDataRepository;

class ValidityReliabilityRepository
{
    public function __construct()
    {
        $this->ticket = new TicketDataRepository();
    }
    public function getByTicketId($id)
    {
        return ValidityReliabilityData::where('ticket_id', $id)->get();
    }
    public function getByItemId($id)
    {
        return ValidityReliabilityData::where('item_id', $id)->get();
    }
    public function getByItemAndTicketId($ticket_id, $item_id)
    {
        return ValidityReliabilityData::where('ticket_id', $ticket_id)->where('item_id', $item_id)->get();
    }
    public function getAverageByTicketIdAndType($id, $type)
    {
        return ValidityReliabilityData::where('ticket_id', $id)->average($type);
    }
    public function create(array $data)
    {
        return ValidityReliabilityData::create($data);
    }
    public function insert(array $data)
    {
        return ValidityReliabilityData::insert($data);
    }
    public function deleteByItemId($id)
    {
        return ValidityReliabilityData::where('item_id', $id)->delete();
    }
}
