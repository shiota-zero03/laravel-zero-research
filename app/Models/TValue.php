<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TValue extends Model
{
    use HasFactory;
    protected $table = 't_value';
    protected $primaryKey = 'id';
    protected $fillable = [
        'item',
        't0_1',
        't0_05',
        't0_02',
        't0_01',
        't0_002',
        't0_001',
    ];
}
