<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Kolom inti
            $table->string('title');
            $table->date('date');
            $table->string('picture_upload')->nullable();   // path atau URL gambar
            $table->string('picture_alt')->nullable();
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->longText('content');

            // ENUM status
            $table->enum('status', ['draft', 'published'])->default('draft');

            // Metadata SEO / tagging
            $table->string('tag')->nullable();       // contoh: "laravel,php"
            $table->string('keywords')->nullable();  // contoh: "tuts,blog,framework"

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
