<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Tag;
use App\Models\Users;

class blog extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'slug',
        'blog_category_id',
        'description',
        'meta_description',
        'image',
        'author_id',
        'form-attachments',
        'top_post',
        'display_in_home',
        'image_alt',
        'is_featured',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
        //'password' => 'hashed',
        'top_post' => 'boolean',
        'display_in_home' => 'boolean',
    ];



    public function tags()
    {
        // A Blog belongs to many Tags via the 'blog_tag' pivot table
        return $this->belongsToMany(Tag::class);
    }

    public function blogcategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function author()
    {
        // 'user_id' is the foreign key on the blogs table
        return $this->belongsTo(Users::class, 'author_id');
    }

}
