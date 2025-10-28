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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('title', 225);
            $table->text('description');
            $table->string('image', 255);
            $table->text('image_alt');
            $table->string('form_attachments', 255)->nullable();
            $table->integer('author_id');
            $table->boolean('top_post')->default(false);
            $table->boolean('display_in_home')->default(false);
            $table->timestamps();
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
