<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGruposTable extends Migration
{
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 45);
            $table->decimal('saldoPermitido', 8, 2);
            $table->unsignedBigInteger('aprovador_id')->nullable();
            $table->timestamps();

            // Foreign key constraint for 'aprovador_id' (Usuario)
            $table->foreign('aprovador_id')->references('id')->on('usuarios')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
