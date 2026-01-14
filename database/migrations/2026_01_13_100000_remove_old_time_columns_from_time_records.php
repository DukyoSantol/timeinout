<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('time_records', function (Blueprint $table) {
            // Remove old time_in and time_out columns
            if (Schema::hasColumn('time_records', 'time_in')) {
                $table->dropColumn('time_in');
            }
            if (Schema::hasColumn('time_records', 'time_out')) {
                $table->dropColumn('time_out');
            }
        });
    }

    public function down()
    {
        Schema::table('time_records', function (Blueprint $table) {
            // Add back the old columns if we need to rollback
            $table->dateTime('time_in')->nullable();
            $table->dateTime('time_out')->nullable();
        });
    }
};
