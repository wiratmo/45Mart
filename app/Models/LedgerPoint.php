<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LedgerPoint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'ref_id',
        'current',
        'add',
        'final',
    ];

    public function scopeGetLastPoint(Builder $query, $id):void
    {
        $query->where('user_id', $id)
            ->orderByDesc('created_at')
            ->limit(1);
    }
}
