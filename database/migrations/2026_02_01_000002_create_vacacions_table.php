<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('vacacion', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100)->unique(); // Title
            $table->text('descripcion'); // Description
            $table->decimal('precio', 8, 2); // Price
            $table->foreignId('idtipo'); // Type
            $table->string('pais', 100); // Country
            $table->timestamps();
            
            $table->foreign('idtipo')->references('id')->on('tipo')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('vacacion');
    }
};