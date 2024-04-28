<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAccess extends Model
{
    use HasFactory;
    protected $table = 'menu_accesses';
    protected $primaryKey = 'id';
    protected $fillable = ['menu_name','document','status'];
}
