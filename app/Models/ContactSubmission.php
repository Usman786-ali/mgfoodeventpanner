<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'event_type',
        'event_date',
        'budget',
        'message',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
