<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestador_id')->constrained('prestadors')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->string('arquivo_path');    // path no disk (storage)
            $table->string('mime')->nullable();
            $table->bigInteger('size')->nullable();
            $table->enum('status', ['pendente','aprovado','arquivado'])->default('pendente');
            $table->timestamp('aprovado_em')->nullable();
            $table->foreignId('aprovado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
