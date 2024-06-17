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
        Schema::create('irregularSesDatas', function (Blueprint $table) {
            $table->id();
            $table->date('ses_date')->comment('日付');
            $table->string('company_name')->comment('会社名');
            $table->string('personnel_name')->comment('要員名');
            $table->integer('type')->comment('入金種別');
            $table->integer('amount')->comment('金額');
            $table->string('bank')->comment('出金銀行');
            $table->integer('ses_data_id')->nullable()->comment('SESデータID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irregularSesDatas');
    }
};
