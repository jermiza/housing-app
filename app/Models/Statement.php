<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'price',
        'active',
        'address',
        'currency',
        'floors',
        'user_id',
        'property_type_id',
    ];

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    /**
     * Scope By Active Status.
     *
     * @param    $builder: query builder.
     * @return query builder.
     */
    public function scopeIsActive($builder, $active = true)
    {
        return $builder->where('active', $active);
    }

    /**
     * add filtering.
     *
     * @param    $builder: query builder.
     * @param    $filters: array of filters.
     * @return query builder.
     */
    public function scopeFilter($builder, $filters = [])
    {
        $builder
            ->when(isset($filters['keyword']), function ($query) use ($filters) {
                $query->where('title', 'LIKE', "%{$filters['keyword']}%")
                    ->orWhere('desc', 'LIKE', "%{$filters['keyword']}%");
            })->when(isset($filters['type']), function ($query) use ($filters) {
                $query->where('property_type_id', $filters['type']);
            })->when(isset($filters['start_price']), function ($query) use ($filters) {
                $query->where('price', '>=', $filters['start_price']);
            })->when(isset($filters['end_price']), function ($query) use ($filters) {
                $query->where('price', '<=', $filters['end_price']);
            });

        return $builder;
    }
}
