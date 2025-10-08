<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50,000'
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$10,000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$40,000'
            ]
        ];
    }

    public static function find(int $id): array  //espero que array seja retornado
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);

        // Aqui se colocar id que não tem, vai a page not found
        if (! $job) {
            abort(404); //Usamos a função auxiliar abort
        }

        return $job;
    }
}