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
        Schema::create('desenvolvedors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nivelId')->unsigned();
            $table->string('nome');
            $table->char('sexo');
            $table->date('datanascimento');
            $table->integer('idade');
            $table->string('hobby');
            $table->timestamps();
            $table->foreign('nivelId')->references('id')->on('nivels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desenvolvedors');
    }
};
