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

       Schema::create('item_sugestaos', function (Blueprint $table){

            $table->id();
            $table->foreignId('sugestao_id')->constrained('sugestaos')->onDelete('cascade');
            $table->text('descricao'); // descrição do item de sugestão
            $table->timestamps();
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    
    {
        Schema::dropIfExists('item_sugestaos');
    }

};
