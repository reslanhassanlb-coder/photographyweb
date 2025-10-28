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
        Schema::create('visitor_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('visitor_uuid')->nullable()->index();
            $table->string('provider')->nullable();
            $table->string('social_id')->nullable()->index();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('password')->nullable();
            $table->string('avatar')->nullable();
            $table->string('gender')->nullable();
            $table->string('locale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_profiles');
    }
};
