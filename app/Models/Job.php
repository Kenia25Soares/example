<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model{
    use HasFactory;
    protected $table = 'job_listings';
    protected $fillable = ['title', 'salary', 'employer_id'];  // Esses 2 pode ser atribuido em massa

    public function employer()  //Crio aqui uma função
    {
        return $this->belongsTo(Employer::class, 'employer_id', 'id');
    }
}

