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
        Schema::create('otherDatas', function (Blueprint $table) {
            $table->id();
            $table->integer('summary_id')->comment('摘要ID');
            $table->integer('amount')->comment('金額');
            $table->integer('type')->comment('入金種別');
            $table->integer('date')->comment('入出金日');
            $table->integer('irregular')->comment('入出金日が土日祝の場合');
            $table->integer('startMonth')->comment('開始月');
            $table->string('bank')->comment('入出金銀行');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otherDatas');
    }
};
