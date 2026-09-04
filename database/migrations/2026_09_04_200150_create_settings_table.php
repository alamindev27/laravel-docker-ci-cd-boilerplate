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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // সেটিংসের ইউনিক নাম (যেমন: site_name)
            $table->text('value')->nullable(); // সেটিংসের ভ্যালু
            $table->string('type')->default('text'); // ডেটার ধরন (text, file, boolean ইত্যাদি)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
