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
        Schema::create('kiosk_participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('kiosk_id');
            $table->foreign('kiosk_id')->references('id')->on('kiosks')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('account_no');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kiosk_participants');
    }
};
