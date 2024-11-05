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
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('telefone', 15);
            $table->integer('idade');
            $table->string('cep', 9);
            $table->string('rua', 255);
            $table->string('numero', 10);
            $table->string('complemento', 255)->nullable();
            $table->string('cidade', 100);
            $table->string('estado', 2);
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};


