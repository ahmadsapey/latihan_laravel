<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // add alamat column
            if (!Schema::hasColumn('mahasiswa', 'alamat')) {
                $table->string('alamat')->nullable()->after('nama');
            }

            // add new numeric kelas_id column
            if (!Schema::hasColumn('mahasiswa', 'kelas_id_new')) {
                $table->unsignedBigInteger('kelas_id_new')->nullable()->after('alamat');
            }
        });

        // migrate existing numeric kelas_id values into kelas_id_new
        // this will copy values that are purely numeric
        DB::statement("UPDATE mahasiswa SET kelas_id_new = CAST(kelas_id AS UNSIGNED) WHERE kelas_id REGEXP '^[0-9]+$'");

        Schema::table('mahasiswa', function (Blueprint $table) {
            // drop old kelas_id if exists
            if (Schema::hasColumn('mahasiswa', 'kelas_id')) {
                $table->dropColumn('kelas_id');
            }
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            // rename kelas_id_new to kelas_id
            if (Schema::hasColumn('mahasiswa', 'kelas_id_new') && !Schema::hasColumn('mahasiswa', 'kelas_id')) {
                $table->renameColumn('kelas_id_new', 'kelas_id');
            }

            // add foreign key to kelas table
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // drop foreign key if exists
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $doctrineTable = $sm->listTableDetails('mahasiswa');
            if ($doctrineTable->hasForeignKey('mahasiswa_kelas_id_foreign')) {
                $table->dropForeign('mahasiswa_kelas_id_foreign');
            }
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            if (Schema::hasColumn('mahasiswa', 'kelas_id')) {
                $table->unsignedBigInteger('kelas_id_old')->nullable()->after('alamat');
                // move back numeric ids
                DB::statement("UPDATE mahasiswa SET kelas_id_old = kelas_id");
                $table->dropForeign(['kelas_id']);
                $table->dropColumn('kelas_id');
                $table->renameColumn('kelas_id_old', 'kelas_id');
            }

            if (Schema::hasColumn('mahasiswa', 'alamat')) {
                $table->dropColumn('alamat');
            }
        });
    }
};
