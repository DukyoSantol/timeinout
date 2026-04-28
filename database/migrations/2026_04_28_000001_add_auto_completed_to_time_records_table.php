<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('time_records', function (Blueprint $table) {
            $table->boolean('auto_completed')->default(false)->after('status');
        });
    }

    public function down()
    {
        Schema::table('time_records', function (Blueprint $table) {
            $table->dropColumn('auto_completed');
        });
    }
};
