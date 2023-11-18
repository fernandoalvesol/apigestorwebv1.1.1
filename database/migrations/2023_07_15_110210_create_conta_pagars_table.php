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
        Schema::create('conta_pagars', function (Blueprint $table) {
            $table->id();

            $table->string('descricao',60)->nullable();

            $table->BigInteger('fornecedor_id')->unsigned();
            $table->foreign("fornecedor_id")->references("id")->on("fornecedors");

            $table->bigInteger('plano_conta_id')->nullable()->unsigned();
            $table->foreign('plano_conta_id')->references('id')->on('plano_contas');

            $table->bigInteger('centro_custo_id')->nullable()->unsigned();
            $table->foreign('centro_custo_id')->references('id')->on('centro_custos');

            $table->BigInteger('status_id')->unsigned();
            $table->foreign("status_id")->references("id")->on("statuses");


            $table->integer('num_parcela')->nullable();
            $table->integer('ult_parcela')->nullable();

            $table->date('data_emissao')->nullable();
            $table->date('data_vencimento');
            $table->string('origem',20)->nullable();
            $table->string('observacao',90)->nullable();
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
        Schema::dropIfExists('conta_pagars');
    }
};
