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
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kiosk_participant_id');
            $table->foreign('kiosk_participant_id')->references('id')->on('kiosk_participants')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->float('monthly_revenue');
            $table->float('cost_of_goods_sold');
            $table->float('profit');
            $table->enum('status', ['Active', 'Warning']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
