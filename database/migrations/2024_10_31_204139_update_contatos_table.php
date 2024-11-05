<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contatos', function (Blueprint $table) {
            if (!Schema::hasColumn('contatos', 'name')) {
                $table->string('name', 20)->change();
            }
            if (!Schema::hasColumn('contatos', 'telefone')) {
                $table->string('telefone', 15)->nullable();
            }
            if (!Schema::hasColumn('contatos', 'idade')) {
                $table->integer('idade')->nullable();
            }
            if (!Schema::hasColumn('contatos', 'cep')) {
                $table->string('cep', 9)->nullable();
            }
            if (!Schema::hasColumn('contatos', 'rua')) {
                $table->string('rua', 255)->nullable();
            }
            if (!Schema::hasColumn('contatos', 'numero')) {
                $table->string('numero', 10)->nullable();
            }
            if (!Schema::hasColumn('contatos', 'complemento')) {
                $table->string('complemento', 255)->nullable();
            }
            if (!Schema::hasColumn('contatos', 'cidade')) {
                $table->string('cidade', 100)->nullable();
            }
            if (!Schema::hasColumn('contatos', 'estado')) {
                $table->string('estado', 2)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('contatos', function (Blueprint $table) {
            if (Schema::hasColumn('contatos', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('contatos', 'telefone')) {
                $table->dropColumn('telefone');
            }
            if (Schema::hasColumn('contatos', 'idade')) {
                $table->dropColumn('idade');
            }
            if (Schema::hasColumn('contatos', 'cep')) {
                $table->dropColumn('cep');
            }
            if (Schema::hasColumn('contatos', 'rua')) {
                $table->dropColumn('rua');
            }
            if (Schema::hasColumn('contatos', 'numero')) {
                $table->dropColumn('numero');
            }
            if (Schema::hasColumn('contatos', 'complemento')) {
                $table->dropColumn('complemento');
            }
            if (Schema::hasColumn('contatos', 'cidade')) {
                $table->dropColumn('cidade');
            }
            if (Schema::hasColumn('contatos', 'estado')) {
                $table->dropColumn('estado');
            }
        });
    }
};
