<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RValue extends Model
{
    use HasFactory;
    protected $table = 'r_values';
    protected $primaryKey = 'id';
    protected $fillable = [
        'item',
        'r_01',
        'r_005',
        'r_002',
        'r_001',
        'r_0001',
    ];
}
