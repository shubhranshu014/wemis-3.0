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
        Schema::create('map_devices', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            // $table->string('email');
           
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('password');
            $table->string('passwordText');
            $table->string('customer_mobile')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_devices');
    }
};
