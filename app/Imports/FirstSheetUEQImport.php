<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use App\Repositories\UeqRepository;
use App\Repositories\TicketDataRepository;

class FirstSheetUEQImport implements ToModel, WithStartRow
{
    private $ticketId;
    private $targetSheet = false;
    public function __construct($ticketId)
    {
        $this->ueq = new UeqRepository();
        $this->ticket = new TicketDataRepository();
        $this->ticketId = $ticketId;
    }
    public function model(array $row)
    {
            return $this->ueq->create([
                'ticket_id' => $this->ticketId,
                'q1' => $this->positiveUEQ($row[1]),
                'q2' => $this->positiveUEQ($row[2]),
                'q3' => $this->negativeUEQ($row[3]),
                'q4' => $this->negativeUEQ($row[4]),
                'q5' => $this->negativeUEQ($row[5]),
                'q6' => $this->positiveUEQ($row[6]),
                'q7' => $this->positiveUEQ($row[7]),
                'q8' => $this->positiveUEQ($row[8]),
                'q9' => $this->negativeUEQ($row[9]),
                'q10' => $this->negativeUEQ($row[10]),
                'q11' => $this->positiveUEQ($row[11]),
                'q12' => $this->negativeUEQ($row[12]),
                'q13' => $this->positiveUEQ($row[13]),
                'q14' => $this->positiveUEQ($row[14]),
                'q15' => $this->positiveUEQ($row[15]),
                'q16' => $this->positiveUEQ($row[16]),
                'q17' => $this->negativeUEQ($row[17]),
                'q18' => $this->negativeUEQ($row[18]),
                'q19' => $this->negativeUEQ($row[19]),
                'q20' => $this->positiveUEQ($row[20]),
                'q21' => $this->negativeUEQ($row[21]),
                'q22' => $this->positiveUEQ($row[22]),
                'q23' => $this->negativeUEQ($row[23]),
                'q24' => $this->negativeUEQ($row[24]),
                'q25' => $this->negativeUEQ($row[25]),
                'q26' => $this->positiveUEQ($row[26]),

                'attractiveness' => (( $this->positiveUEQ($row[1]) + $this->negativeUEQ($row[12]) + $this->positiveUEQ($row[14]) + $this->positiveUEQ($row[16]) + $this->negativeUEQ($row[24]) + $this->negativeUEQ($row[25]) )/6),
                'perspicuity' => (( $this->positiveUEQ($row[2]) + $this->negativeUEQ($row[4]) + $this->positiveUEQ($row[13]) + $this->negativeUEQ($row[21]) )/4),
                'efficiency' => (( $this->negativeUEQ($row[9]) + $this->positiveUEQ($row[20]) + $this->positiveUEQ($row[22]) + $this->negativeUEQ($row[23]) )/4),
                'dependability' => (( $this->positiveUEQ($row[8]) + $this->positiveUEQ($row[11]) + $this->negativeUEQ($row[17]) + $this->negativeUEQ($row[19]) )/4),
                'stimulation' => (( $this->negativeUEQ($row[5]) + $this->positiveUEQ($row[6]) + $this->positiveUEQ($row[7]) + $this->negativeUEQ($row[18]) )/4),
                'novelty' => (( $this->negativeUEQ($row[3]) + $this->negativeUEQ($row[10]) + $this->positiveUEQ($row[15]) + $this->positiveUEQ($row[26]) )/4),
            ]);
    }
    public function startRow(): int
    {
        return 2;
    }
    private function positiveUEQ($value) {
        return (intval($value) - 4);
    }
    private function negativeUEQ($value) {
        return (4 - intval($value));
    }
}
