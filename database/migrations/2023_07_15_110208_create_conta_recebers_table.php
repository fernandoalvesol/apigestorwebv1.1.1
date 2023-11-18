<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conta_recebers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cliente_id')->unsigned();
            $table->foreign("cliente_id")->references("id")->on("clientes");

            $table->bigInteger('forma_pagto_id')->unsigned()->nullable();
            $table->foreign("forma_pagto_id")->references("id")->on("forma_pagtos");

            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign("status_id")->references("id")->on("statuses");


            $table->string('descricao',100);

            $table->integer('num_parcela')->nullable();
            $table->integer('ult_parcela')->nullable();

            $table->date('data_emissao')->nullable();
            $table->date('data_previsao')->nullable();
            $table->date('data_vencimento');
            $table->string('origem',20)->nullable();
            $table->string('observacao',60)->nullable();
            $table->decimal('valor', 10,2)->default(0);

            $table->decimal('total_juros', 10,2)->nullable();
            $table->decimal('total_multa', 10,2)->nullable();
            $table->decimal('total_desconto', 10,2)->nullable();
            $table->decimal('total_liquido', 10,2)->nullable();
            $table->decimal('total_recebido', 10,2)->nullable();
            $table->decimal('total_restante', 10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_recebers');
    }
};
