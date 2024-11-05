<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contatos', function (Blueprint $table) {
            $table->string('name', 20)->change();
            $table->string('telefone', 15)->nullable();  
            $table->integer('idade')->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('rua', 255)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 255)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('contatos', function (Blueprint $table) {
            $table->dropColumn(['name', 'telefone', 'idade', 'cep', 'rua', 'numero', 'complemento', 'cidade', 'estado']);
        });
    }
};

