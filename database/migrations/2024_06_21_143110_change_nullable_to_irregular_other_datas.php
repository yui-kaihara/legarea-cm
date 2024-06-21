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
        Schema::table('irregularOtherDatas', function (Blueprint $table) {
            $table->integer('summary_id')->nullable()->change();
            $table->integer('amount')->nullable()->change();
            $table->integer('type')->nullable()->change();
            $table->string('bank')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('irregularOtherDatas', function (Blueprint $table) {
            $table->integer('summary_id')->nullable(false)->change();
            $table->integer('amount')->nullable(false)->change();
            $table->integer('type')->nullable(false)->change();
            $table->string('bank')->nullable(false)->change();
        });
    }
};
