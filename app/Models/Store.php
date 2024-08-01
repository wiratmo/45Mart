<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'stores';
    protected $fillable = [
        'category_id',
        'name',
        'floor_position',
        'store_position',
        'employee_id'
    ];

    protected $hidden = [
        'employee_id'
    ];
}
