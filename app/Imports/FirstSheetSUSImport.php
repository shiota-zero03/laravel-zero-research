<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Repositories\SusRepository;
use App\Repositories\TicketDataRepository;

class FirstSheetSUSImport implements ToModel, WithStartRow
{
    private $ticketId;
    public function __construct($ticketId)
    {
        $this->sus = new SusRepository();
        $this->ticket = new TicketDataRepository();
        $this->ticketId = $ticketId;
    }
    public function model(array $row)
    {
        return $this->sus->create([
            'ticket_id' => $this->ticketId,
            'q1' => $row[1],
            'q2' => $row[2],
            'q3' => $row[3],
            'q4' => $row[4],
            'q5' => $row[5],
            'q6' => $row[6],
            'q7' => $row[7],
            'q8' => $row[8],
            'q9' => $row[9],
            'q10' => $row[10],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
