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
        Schema::create('baobeis', function (Blueprint $table) {
            $table->id();
            $table->string('zbid');
            $table->string('jyxm');
            $table->string('sfzh');
            $table->string('jylx');
            $table->string('ssdwmc');
            $table->string('jcbh');
            $table->string('pbrq');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baobeis');
    }
};
