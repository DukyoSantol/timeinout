<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTimeInColumnInTimeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            // Make the 'time_in' column nullable, or set a default value
            $table->time('time_in')->nullable()->change(); // This allows NULL values
            // OR, to set a default value
            // $table->time('time_in')->default('00:00:00')->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            // Revert the 'time_in' column back to NOT NULL
            $table->time('time_in')->nullable(false)->change();
            // OR, to revert the default value
            // $table->time('time_in')->default(null)->change();
        });
    }
}
