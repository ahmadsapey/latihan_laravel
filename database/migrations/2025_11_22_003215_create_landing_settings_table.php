<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('landing_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('Unique key, contoh: hero_title, site_title');
            $table->longText('value')->nullable()->comment('Value bisa text atau JSON string untuk multi-field');
            $table->string('type')->default('text')->comment('text,image,url,json');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_settings');
    }
};