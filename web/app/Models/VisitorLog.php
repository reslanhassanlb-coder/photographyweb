<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorLog extends Model
{
    use HasFactory;

     protected $fillable = [
        'visitor_uuid',
        'page_url',
        'time_spent',
        'visited_at',
        'ip',
        'country',
        'city',
        'region',
        'device',
        'browser',
        'os',
        'referrer',
        ];

    public $timestamps = true;

}
