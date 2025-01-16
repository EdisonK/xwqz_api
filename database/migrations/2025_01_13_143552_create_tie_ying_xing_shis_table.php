<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tie_ying_xing_shis', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_id');
            $table->string('vehicle_type');
            $table->string('rq');
            $table->string('client_name');
            $table->string('vehicle_name');
            $table->string('dur');
            $table->string('begin_time');
            $table->string('count');
            $table->string('distance');
            $table->string('end_time');
            $table->string('max_speed');
            $table->string('min_speed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tie_ying_xing_shis');
    }
};
