<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Renomeia a tabela existente "posts" para "post_listings"
        Schema::rename('posts', 'post_listings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Caso queira reverter a mudança
        Schema::rename('post_listings', 'posts');
    }
};
