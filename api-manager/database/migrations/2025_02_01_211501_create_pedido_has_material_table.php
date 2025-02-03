<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoHasMaterialTable extends Migration
{
    public function up()
    {
        Schema::create('pedido_has_material', function (Blueprint $table) {
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('material_id');
            $table->integer('quantidade');
            $table->decimal('subtotal', 8, 2);

            // Foreign key constraints
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedido_has_material');
    }
}
