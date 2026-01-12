<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            $table->time('morning_time_out')->nullable(); // add the column
        });
    }

    public function down(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            $table->dropColumn('morning_time_out'); // remove on rollback
        });
    }
};
