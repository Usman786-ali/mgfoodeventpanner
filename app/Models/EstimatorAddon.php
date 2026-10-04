<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatorAddon extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimator_type_id',
        'name',
        'price',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function type()
    {
        return $this->belongsTo(EstimatorType::class, 'estimator_type_id');
    }
}
