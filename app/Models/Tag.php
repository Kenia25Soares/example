<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    // relacionamento com jobs
    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_tag', 'tag_id', 'job_listing_id');
    }

    // relacionamento com posts
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_listing_id');
    }
}
