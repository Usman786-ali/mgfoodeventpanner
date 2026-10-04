<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatorPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'estimator_type_id',
        'name',
        'description',
        'price',
        'per_head',
        'order',
    ];

    protected $casts = [
        'per_head' => 'boolean',
    ];

    public function type()
    {
        return $this->belongsTo(EstimatorType::class, 'estimator_type_id');
    }
}
