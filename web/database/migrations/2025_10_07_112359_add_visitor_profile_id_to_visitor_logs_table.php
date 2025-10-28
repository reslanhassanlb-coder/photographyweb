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
       Schema::table('visitor_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('visitor_profile_id')->nullable()->after('id');
            $table->foreign('visitor_profile_id')->references('id')->on('visitor_profiles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
             $table->dropForeign(['visitor_profile_id']);
            $table->dropColumn('visitor_profile_id');
        });
    }
};
