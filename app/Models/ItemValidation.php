<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemValidation extends Model
{
    use HasFactory;
    protected $table = 'item_validations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'group_id',
        'item_name',
        'qualification',
    ];
}
