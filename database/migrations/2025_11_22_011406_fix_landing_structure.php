<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Fix landing_settings
        Schema::table('landing_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('landing_settings', 'status')) {
                $table->boolean('status')->default(1)->after('type')->index();
            }
        });

        // Fix landing_programs
        Schema::table('landing_programs', function (Blueprint $table) {
            if (!Schema::hasColumn('landing_programs', 'image')) {
                $table->string('image')->nullable()->after('description');
            }

            if (!Schema::hasColumn('landing_programs', 'status')) {
                $table->boolean('status')->default(1)->after('position')->index();
            }

            if (!Schema::hasColumn('landing_programs', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        // Fix landing_nav_items
        Schema::table('landing_nav_links', function (Blueprint $table) {
            if (!Schema::hasColumn('landing_nav_links', 'status')) {
                $table->boolean('status')->default(1)->after('url')->index();
            }
        });

        // Fix landing_footer_links
        Schema::table('landing_footer_links', function (Blueprint $table) {
            if (!Schema::hasColumn('landing_footer_links', 'status')) {
                $table->boolean('status')->default(1)->after('url')->index();
            }
        });
    }

    public function down(): void
    {
        // Optional rollback
        Schema::table('landing_settings', function (Blueprint $table) {
            if (Schema::hasColumn('landing_settings', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('landing_programs', function (Blueprint $table) {
            if (Schema::hasColumn('landing_programs', 'image')) {
                $table->dropColumn('image');
            }

            if (Schema::hasColumn('landing_programs', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('landing_programs', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });

        Schema::table('landing_nav_links', function (Blueprint $table) {
            if (Schema::hasColumn('landing_nav_links', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('landing_footer_links', function (Blueprint $table) {
            if (Schema::hasColumn('landing_footer_links', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};