<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidityReliabilityData extends Model
{
    use HasFactory;
    protected $table = 'validity_reliability_data';
    protected $primaryKey = 'id';
    protected $fillable = [
            'ticket_id',
            'item_id',
            'value'
    ];
}
