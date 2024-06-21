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
        Schema::table('irregularSesDatas', function (Blueprint $table) {
            $table->string('company_name')->nullable()->change();
            $table->string('personnel_name')->nullable()->change();
            $table->integer('type')->nullable()->change();
            $table->integer('amount')->nullable()->change();
            $table->string('bank')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('irregularSesDatas', function (Blueprint $table) {
            $table->string('company_name')->nullable(false)->change();
            $table->string('personnel_name')->nullable(false)->change();
            $table->integer('type')->nullable(false)->change();
            $table->integer('amount')->nullable(false)->change();
            $table->string('bank')->nullable(false)->change();
        });
    }
};
