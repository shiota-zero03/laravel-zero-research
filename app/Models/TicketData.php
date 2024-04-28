<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketData extends Model
{
    use HasFactory;
    protected $table = 'ticket_data';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ticket_number',
        'user_id',
        'type',
    ];

    public static function generateUniqueNumber()
    {
        $existingTransactionNumbers = TicketData::pluck('ticket_number')->toArray();

        do {
            $characters = '0123456789';
            $randomString = '';
            $length = 8;

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $newTransactionNumber = $randomString;
        } while (in_array($newTransactionNumber, $existingTransactionNumbers));

        return $newTransactionNumber;
    }
}
