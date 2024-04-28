<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;

use App\Repositories\ItemValidationRepository;

class FirstValidityReliabilityImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $ticketId, $item_data;

    public function __construct($ticketId, $item_data)
    {
        $this->ticketId = $ticketId;
        $this->item_data = $item_data;
    }

    public function model(array $row)
    {
        if (count($row)-1 !== $this->item_data->count()) {
            throw new \Exception("The total of your excel columns is not the same as the total of items (item: ".$this->item_data->count().", your excel column: ".(count($row)-1).")");
        }

        $columnToItemIdMap = [];
        for($i = 0; $i < $this->item_data->count(); $i++){
            $columnToItemIdMap[$i+1] = $this->item_data[$i]->id;
        }
        $values = array_slice(array_values($row),1);

        foreach ($values as $index => $value) {
            $itemId = $columnToItemIdMap[$index + 1] ?? null;
            if ($itemId) {
                \App\Models\ValidityReliabilityData::create([
                    'ticket_id' => $this->ticketId,
                    'item_id' => $itemId,
                    'value' => $value
                ]);
            }
        }
        return null;
    }
}
