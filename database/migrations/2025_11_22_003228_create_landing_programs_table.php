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
        Schema::create('landing_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable()->comment('opsional: nama file/icon class atau url');
            $table->integer('position')->default(0)->index();
            $table->boolean('status')->default(true)->index();
            $table->timestamps();
            $table->softDeletes(); // optional: enable soft delete
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_programs');
    }
};