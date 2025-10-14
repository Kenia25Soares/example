<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model{
    use HasFactory;
    protected $table = 'job_listings';

    // protected $guarded = []; // isso desativa os recursos e cria um job com qualquer valor
    protected $fillable = ['title', 'salary', 'employer_id'];  // Esses 2 pode ser atribuido em massa

    public function employer()  //Crio aqui uma função
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
{
    return $this->belongsToMany(Tag::class, 'job_tag', 'job_listing_id', 'tag_id');
}
}

