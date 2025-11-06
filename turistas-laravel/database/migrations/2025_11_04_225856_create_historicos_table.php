<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historicos', function (Blueprint $table) {
            $table->id();

            $table->integer('n_turistas');

            // armazenar todos os parâmetros usados (json)
            $table->json('data');

            // sugestão (Pico/Medio/Baixo)
            $table->string('nome_sugestao');

            // array com os textos dos itens de sugestão
            $table->json('tipos_sugestoes');

            // ligações: user que fez a previsão e provincia relacionada (nullable por segurança)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('provincia_id')->nullable()->constrained('provincias')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historicos');
    }
};
