<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color' 
    ];

    /**
     * Get the default pending status (first status)
     */
    public function scopeDefault($query)
    {
        return $query->where('name', 'Pending');
    }
}