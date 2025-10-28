<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class PackageBooking extends Model
{
    use HasFactory;

    public const STATUS_PENDING   = 'pending';
    public const STATUS_APPROVED  = 'approved';
    public const STATUS_REJECTED  = 'rejected';

    protected $fillable = [
        'visitor_uuid',
        'user_email',
        'package_id',
        'event_type',
        'date',
        'address',
        'note',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function visitor()
    {
        return $this->belongsTo(VisitorProfile::class, 'user_email', 'email');
    }

    protected function statusClass(): Attribute
    {
        return new Attribute(
            get: function () {
                // 1. Check for final states (Approved/Rejected)
                if ($this->status === self::STATUS_APPROVED) {
                    return 'status-approved';
                }

                if ($this->status === self::STATUS_REJECTED) {
                    return 'status-rejected';
                }

                // 2. If status is PENDING, check the date context
                if ($this->status === self::STATUS_PENDING) {
                    if (Carbon::parse($this->date)->isPast()) {
                        // Pending and date is past? This might mean it was missed/ignored.
                        return 'status-missed';
                    }
                    // Default for Pending and upcoming
                    return 'status-pending';
                }

                // Fallback for unknown status
                return 'status-default';
            },
        );
    }

}
