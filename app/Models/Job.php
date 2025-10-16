<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model{
    use HasFactory;
    protected $table = 'job_listings';

    //  protected $guarded = []; // isso desativa os recursos e cria um job com qualquer valor
     protected $fillable = ['title', 'salary', 'employer_id'];  // Esses 2 pode ser atribuido em massa

      // Relação com Employer (muitos jobs pertencem a um employer)
    public function employer()  //Crio aqui uma função
    {
        return $this->belongsTo(Employer::class);
    }

     // Relação com User (caso um user crie o job)
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     // Relação muitos-para-muitos com Tags
    public function tags()
{
    return $this->belongsToMany(Tag::class, 'job_tag', 'job_listing_id', 'tag_id');
}
}

