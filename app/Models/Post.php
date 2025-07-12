<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'picture_upload',
        'picture_alt',
        'category_id',
        'slug',
        'content',
        'status',
        'tag',
        'keywords',
    ];

    /* ----------------------------------
     |  Relationships
     |----------------------------------*/
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /* ----------------------------------
     |  Accessors & Mutators (Opsional)
     |----------------------------------*/
    /**
     * Set slug otomatis saat title di‑set (jika belum ada).
     */
    protected static function booted()
    {
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
