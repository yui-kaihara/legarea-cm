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
        Schema::table('shopDatas', function (Blueprint $table) {
            $table->integer('sales1')->nullable()->change();
            $table->integer('sales2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopDatas', function (Blueprint $table) {
            $table->integer('sales1')->nullable(false)->change();
            $table->integer('sales2')->nullable(false)->change();
        });
    }
};
