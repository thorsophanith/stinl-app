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
    public function standards(): BelongsToMany
    {
        return $this->belongsToMany(standard::class, 'standard_parameters');
    }
}
