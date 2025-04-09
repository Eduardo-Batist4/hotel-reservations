<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'amenities',
    ];

    public function rooms() {
        return $this->hasMany(Room::class);
    }

    public function scopeLocation($query, $location)
    {
        return $query->where('location', 'like', '%' . $location . '%');
    }

    public function scopeAmenities($query, $amenities)
    {
        return $query->where('amenities', 'like', '%' . $amenities . '%');
    }
}
