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
        Schema::create('operational', function (Blueprint $table) {
            $table->id();
            $table->double("saldo_awal", 15, 2);
            $table->double("sisa_saldo", 15, 2);
            $table->longText("keterangan")->nullable();
            $table->timestamps();
        });

        Schema::create('detail_operational', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("operational_id");
            $table->double("saldo", 15, 2);
            $table->longText("keterangan")->nullable();
            $table->foreign('operational_id')->references('id')->on('operational')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_operational');
        Schema::dropIfExists('operational');
    }
};
