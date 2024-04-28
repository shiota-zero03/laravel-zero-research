<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemGroup extends Model
{
    use HasFactory;
    protected $table = 'item_groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'item_number',
        'user_id',
        'type',
    ];

    public static function generateUniqueNumber()
    {
        $existingTransactionNumbers = ItemGroup::pluck('item_number')->toArray();

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
