<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'offer_price',
        'features',
        'recommended',
    ];

    protected $casts = [
    'features' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(PackageBooking::class,'package_id');
    }
}
