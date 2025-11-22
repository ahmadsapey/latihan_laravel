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
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            // Tambahkan kolom-kolom yang diperlukan untuk step3, step4
            if (!Schema::hasColumn('ekyc_registrations', 'asal_sd')) {
                $table->string('asal_sd')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'asal_smp')) {
                $table->string('asal_smp')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'asal_sma')) {
                $table->string('asal_sma')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'alamatDomisili')) {
                $table->text('alamatDomisili')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'provinsi')) {
                $table->string('provinsi')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'kota')) {
                $table->string('kota')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'kecamatan')) {
                $table->string('kecamatan')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'kode_pos')) {
                $table->string('kode_pos')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'nama_ibu_kandung')) {
                $table->string('nama_ibu_kandung')->nullable();
            }
            if (!Schema::hasColumn('ekyc_registrations', 'referensi_sumber')) {
                $table->string('referensi_sumber')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->dropColumnIfExists('asal_sd');
            $table->dropColumnIfExists('asal_smp');
            $table->dropColumnIfExists('asal_sma');
            $table->dropColumnIfExists('alamatDomisili');
            $table->dropColumnIfExists('provinsi');
            $table->dropColumnIfExists('kota');
            $table->dropColumnIfExists('kecamatan');
            $table->dropColumnIfExists('kode_pos');
            $table->dropColumnIfExists('nama_ibu_kandung');
            $table->dropColumnIfExists('referensi_sumber');
        });
    }
};
