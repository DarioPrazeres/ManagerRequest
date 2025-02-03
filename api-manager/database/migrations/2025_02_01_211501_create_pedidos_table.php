<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();

            $table->decimal('total', 8, 2)->default(0.00);
            $table->enum('status', ['Novo', 'Em Revisão', 'Alterações Solicitadas', 'Aprovado', 'Rejeitado'])->default('Novo');
            $table->datetime('dataCriacao')->nullable(); 
            $table->datetime('dataAtualizacao')->nullable();

            $table->unsignedBigInteger('solicitante_id');
            $table->unsignedBigInteger('grupo_id');

            $table->timestamps();

            $table->foreign('solicitante_id')
                  ->references('id')
                  ->on('solicitantes')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  

            $table->foreign('grupo_id')
                  ->references('id')
                  ->on('grupos')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');  
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}

