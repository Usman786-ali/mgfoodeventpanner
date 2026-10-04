<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatorType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'base_price',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function packages()
    {
        return $this->hasMany(EstimatorPackage::class)->orderBy('order');
    }

    public function addons()
    {
        return $this->hasMany(EstimatorAddon::class)->orderBy('order');
    }
}
