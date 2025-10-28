<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VisitorProfile extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'visitor_uuid',
        'provider',
        'social_id',
        'name',
        'phone',
        'email',
        'password',
        'avatar',
        'gender',
        'locale',
    ];

    protected $hidden = ['password'];

    public function logs()
    {
        return $this->hasMany(PackageBooking::class, 'user_email', 'email');
    }
}
