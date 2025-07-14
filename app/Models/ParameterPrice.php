<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\parameter;

class ParameterPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'parameter',
        'test_duration',
        'price',
        'lab_type',
        'parameter_id',
    ];

    public function parameter()
    {
        return $this->belongsTo(parameter::class);
    }
}
