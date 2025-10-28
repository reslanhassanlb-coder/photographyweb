<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    /**
     * Get all blog posts that use this tag.
     */
    public function blogs()
    {
        // Define the Many-to-Many inverse relationship
        return $this->belongsToMany(Blog::class);
    }
}
