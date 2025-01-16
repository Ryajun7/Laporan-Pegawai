<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('NIP', 20);
            $table->string('Nama');
            $table->string('Jabatan');
            $table->text('Catatan');
            $table->date('Tanggal');
            $table->string('Status')->default('Pending');
            $table->timestamps();

            $table->foreign('NIP')->references('NIP')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
