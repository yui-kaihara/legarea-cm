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
        Schema::create('irregularOtherDatas', function (Blueprint $table) {
            $table->id();
            $table->date('date')->comment('日付');
            $table->integer('summary_id')->comment('摘要ID');
            $table->integer('amount')->comment('金額');
            $table->integer('type')->comment('入金種別');
            $table->string('bank')->comment('入出金銀行');
            $table->integer('other_data_id')->nullable()->comment('その他データID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irregularOtherDatas');
    }
};
