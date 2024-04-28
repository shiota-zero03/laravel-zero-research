<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SUSImport implements WithMultipleSheets
{
    private $ticketId;

    public function __construct($ticketId)
    {
        $this->ticketId = $ticketId;
    }
    public function sheets(): array
    {
        return [
            0 => new FirstSheetSUSImport($this->ticketId),
        ];
    }
}
