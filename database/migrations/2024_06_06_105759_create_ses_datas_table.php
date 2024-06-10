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
        Schema::create('sesDatas', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->comment('会社名');
            $table->string('case_name')->comment('案件名');
            $table->string('personnel_name')->comment('要員名');
            $table->integer('deposit_amount')->nullable()->comment('入金金額');
            $table->integer('payment_site')->nullable()->comment('支払いサイト');
            $table->integer('deposit_irregular')->nullable()->comment('入金日が土日祝の場合');
            $table->string('deposit_bank')->nullable()->comment('入金銀行');
            $table->integer('withdrawal_amount')->nullable()->comment('出金金額');
            $table->integer('withdrawal_date')->nullable()->comment('出金日');
            $table->integer('withdrawal_irregular')->nullable()->comment('出金日が土日祝の場合');
            $table->string('withdrawal_bank')->nullable()->comment('出金銀行');
            $table->date('admission_date')->comment('入場日');
            $table->date('exit_date')->nullable()->comment('退場日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesDatas');
    }
};
