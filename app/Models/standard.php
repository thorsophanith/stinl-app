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

    protected $fillable = ['code', 'cs', 'codex', 'name_en', 'name_kh', 'lab_type'];
    protected $casts = [
        'cs' => 'string', // Ensures 'cs' is always treated as a string
    ];

    public function parameters(): BelongsToMany
    {
        return $this->belongsToMany(parameter::class, 'standard_parameters');
    }
}
