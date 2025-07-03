<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\standard_parameter;
use App\Models\standard;

class parameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en', 'name_kh', 'formular', 'criteria_operator',
        'criteria_value1', 'criteria_value2', 'unit', 'LOQ', 'method'
    ];

    public function standards(): BelongsToMany
    {
        return $this->belongsToMany(standard::class, 'standard_parameters');
    }
}
