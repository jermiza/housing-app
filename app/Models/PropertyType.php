<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyType extends Model
{
    protected $fillable = [
        'name',
        'active',
        'statement_id',
    ];

    public $timestamps = false;

    public function statement(): HasMany
    {
        return $this->hasMany(Statement::class);
    }
}
