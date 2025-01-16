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
//          path: '/home',
//                            name: 'home',
//                            label: '首页',
//                            icon: 'house',
//                            url: 'Home'
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('name')->nullable();
            $table->string('label');
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->integer('pid')->default(0);
            $table->integer('status')->default(1)->comment('状态：0禁用，1启用');
            $table->integer('level')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
