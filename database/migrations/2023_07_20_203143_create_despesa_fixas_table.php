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
        Schema::create('despesa_fixas', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('plano_conta_id')->nullable()->unsigned();
            $table->foreign('plano_conta_id')->references('id')->on('plano_contas');

            $table->bigInteger('fornecedor_id')->nullable()->unsigned();
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors');

            $table->bigInteger('centro_custo_id')->nullable()->unsigned();
            $table->foreign('centro_custo_id')->references('id')->on('centro_custos');

            $table->bigInteger('conta_corrente_id')->nullable()->unsigned();
            $table->foreign('conta_corrente_id')->references('id')->on('conta_correntes');

            $table->bigInteger('forma_pagto_id')->nullable()->unsigned();
            $table->foreign('forma_pagto_id')->references('id')->on('forma_pagtos');

            $table->string('descricao',60)->nullable();
            $table->date('vigencia_inicial')->nullable();
            $table->date('vigencia_final')->nullable();
            $table->integer('dia_vencimento');
            $table->decimal('valor', 10,2)->default(0);

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
        Schema::dropIfExists('despesa_fixas');
    }
};
