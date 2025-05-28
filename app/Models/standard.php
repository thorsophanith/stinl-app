<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\parameter;
use App\Models\standard_parameter;

class standard extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'codex',
        'name_en',
        'name_kh',
    ];

    public function parameters(): BelongsToMany
    {
        return $this->belongsToMany(parameter::class, 'standard_parameters');
    }
}
