<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marchendise extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'date_start',
        'date_end',
        'quota',
        'point',
        'employee_id'
    ];

    protected $hidden = [
        'employee_id'
    ];
}
