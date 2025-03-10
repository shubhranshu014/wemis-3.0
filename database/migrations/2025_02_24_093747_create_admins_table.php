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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('regd_address');
            $table->string('gstin_no');
            $table->string('pan_no');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('password_text');
            $table->string('contact_no')->unique();
            $table->string('gst_certificate')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('incorporation_certificate')->nullable();
            $table->string('logo');
            $table->enum('status', ['pending', 'active','inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
