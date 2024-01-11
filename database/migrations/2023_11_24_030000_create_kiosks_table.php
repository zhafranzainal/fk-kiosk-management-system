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
        Schema::create('kiosks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('business_type_id');
            $table->foreign('business_type_id')->references('id')->on('business_types')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('name');
            $table->string('location');
            $table->enum('suggested_action', ['No Action', 'Terminate', 'Suspend', 'Reassign'])->default('No Action');
            $table->string('comment')->nullable();
            $table->enum('status', ['Inactive', 'Active', 'Warning', 'Repair'])->default('Inactive');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kiosks');
    }
};
