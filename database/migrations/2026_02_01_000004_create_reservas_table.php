<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser');
            $table->foreignId('idvacacion');
            // timestamps not requested but good practice. Prompt didn't list timestamps for RESERVA so I omit them.
            
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idvacacion')->references('id')->on('vacacion')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('reserva');
    }
};
