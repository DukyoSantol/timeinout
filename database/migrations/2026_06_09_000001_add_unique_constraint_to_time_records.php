<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement('
            DELETE t1 FROM time_records t1
            INNER JOIN time_records t2
            WHERE t1.id < t2.id
            AND t1.user_id = t2.user_id
            AND DATE(t1.created_at) = DATE(t2.created_at)
        ');

        Schema::table('time_records', function (Blueprint $table) {
            $table->date('record_date')->nullable()->after('user_id');
        });

        DB::statement('UPDATE time_records SET record_date = DATE(created_at) WHERE record_date IS NULL');

        Schema::table('time_records', function (Blueprint $table) {
            $table->unique(['user_id', 'record_date'], 'time_records_user_id_date_unique');
        });
    }

    public function down()
    {
        Schema::table('time_records', function (Blueprint $table) {
            $table->dropUnique('time_records_user_id_date_unique');
            $table->dropColumn('record_date');
        });
    }
};
