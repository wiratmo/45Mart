<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberPoint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'store_id',
        'transaction_price',
        'date_at',
        'status',
        'point',
        'employee_id'
    ];

    protected $hidden = [
        'employee_id',
    ];
}
