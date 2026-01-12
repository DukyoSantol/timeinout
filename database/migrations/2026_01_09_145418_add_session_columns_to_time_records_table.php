<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('time_records', function (Blueprint $table) {

            // Make existing columns nullable
            $table->dateTime('time_in')->nullable()->change();
            $table->dateTime('time_out')->nullable()->change();

            // Add missing columns only if they don't exist
            if (!Schema::hasColumn('time_records', 'morning_time_out')) {
                $table->time('morning_time_out')->nullable();
            }

            if (!Schema::hasColumn('time_records', 'afternoon_time_in')) {
                $table->time('afternoon_time_in')->nullable();
            }

            if (!Schema::hasColumn('time_records', 'afternoon_time_out')) {
                $table->time('afternoon_time_out')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            if (Schema::hasColumn('time_records', 'morning_time_out')) {
                $table->dropColumn('morning_time_out');
            }
            if (Schema::hasColumn('time_records', 'afternoon_time_in')) {
                $table->dropColumn('afternoon_time_in');
            }
            if (Schema::hasColumn('time_records', 'afternoon_time_out')) {
                $table->dropColumn('afternoon_time_out');
            }
        });
    }
};
