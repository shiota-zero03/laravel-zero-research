<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UEQImport implements WithMultipleSheets
{
    private $ticketId;

    public function __construct($ticketId)
    {
        $this->ticketId = $ticketId;
    }
    public function sheets(): array
    {
        return [
            0 => new FirstSheetUEQImport($this->ticketId),
        ];
    }
}
