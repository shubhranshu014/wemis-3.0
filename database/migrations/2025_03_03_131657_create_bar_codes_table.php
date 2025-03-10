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
        Schema::create('bar_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mfg_id');
            $table->foreign('mfg_id')->references('id')->on('manufacturers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('element_id');
            $table->foreign('element_id')->references('id')->on('elements')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->nullable()->references('id')->on('element_types')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id')->nullable()->references('id')->on('model_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('part_id');
            $table->foreign('part_id')->nullable()->references('id')->on('part_nos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('serialNumber');
            $table->string('barcodeNo');
            $table->string('IMEINO');
            $table->string('BatchNo');
            $table->enum('is_renew', ['0', '1']);
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_codes');
    }
};
