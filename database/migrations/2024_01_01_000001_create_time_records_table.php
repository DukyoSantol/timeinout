<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('time_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('full_name');
            $table->string('position');
            $table->string('division');
            $table->dateTime('time_in');
            $table->dateTime('time_out')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('total_hours', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('time_records');
    }
};
