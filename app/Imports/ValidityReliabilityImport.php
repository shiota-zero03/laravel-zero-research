<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ValidityReliabilityImport implements WithMultipleSheets
{
    private $ticketId, $item_data;

    public function __construct($ticketId, $item_data)
    {
        $this->ticketId = $ticketId;
        $this->item_data = $item_data;
    }
    public function sheets(): array
    {
        return [
            0 => new FirstValidityReliabilityImport($this->ticketId, $this->item_data),
        ];
    }
}

