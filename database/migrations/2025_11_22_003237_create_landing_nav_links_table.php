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
        Schema::create('landing_nav_links', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url')->nullable()->comment('relative anchor (#program) atau full url');
            $table->integer('position')->default(0)->index();
            $table->boolean('status')->default(true)->index();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_nav_links');
    }
};