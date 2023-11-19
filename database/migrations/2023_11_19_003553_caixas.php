<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('caixas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao', 150);
            $table->string('operacao', 100);
            $table->string('escritorio');
            $table->date('data');
            $table->decimal('preco', 10, 2);
            $table->enum('tipo', [1,2]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('caixas');
    }
};
