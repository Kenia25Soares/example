<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  use HasFactory;
  protected $table = 'post_listings';
   protected $fillable = ['title', 'body'];

  public function tags()
  {
       // relacionamento many-to-many com a tabela pivot post_tag
      return $this->belongsToMany(Tag::class, 'post_tag', 'post_listing_id', 'tag_id');
  }
}
