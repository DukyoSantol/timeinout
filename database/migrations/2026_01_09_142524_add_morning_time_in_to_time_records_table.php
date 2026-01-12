<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMorningTimeInToTimeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            // Adding the 'morning_time_in' column
            $table->time('morning_time_in')->nullable(); // Adjust data type if necessary
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('time_records', function (Blueprint $table) {
            // Dropping the 'morning_time_in' column if rolled back
            $table->dropColumn('morning_time_in');
        });
    }
}
