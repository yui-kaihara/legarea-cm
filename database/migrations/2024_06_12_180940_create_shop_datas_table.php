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
        Schema::create('shopDatas', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('日付');
            $table->integer('sales1')->comment('売上1');
            $table->integer('sales2')->comment('売上2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopDatas');
    }
};
