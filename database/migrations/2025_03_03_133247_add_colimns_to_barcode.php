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
        Schema::table('bar_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('tac_id')->nullable()->after('part_id');
            $table->foreign('tac_id')->references('id')->on('tacs')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('cop_id')->nullable()->after('tac_id');
            $table->foreign('cop_id')->references('id')->on('cops')->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedBigInteger('testingAgency')->nullable()->after('cop_id');
            $table->foreign('testingAgency')->references('id')->on('testing_agencies')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('=bar_codes', function (Blueprint $table) {
            //
        });
    }
};
