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
        Schema::create('recebimentos', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('conta_receber_id')->unsigned();
            $table->foreign('conta_receber_id')->references('id')->on('conta_recebers');

            $table->bigInteger('conta_corrente_id')->nullable()->unsigned();
            $table->foreign('conta_corrente_id')->references('id')->on('conta_correntes');

            $table->bigInteger('plano_conta_id')->nullable()->unsigned();
            $table->foreign('plano_conta_id')->references('id')->on('plano_contas');

            $table->string('descricao_recebimento',60)->nullable();

            $table->BigInteger('status_id')->unsigned()->default(1);
            $table->foreign("status_id")->references("id")->on("statuses");

            $table->BigInteger('forma_pagto_id')->unsigned()->nullable();
            $table->foreign("forma_pagto_id")->references("id")->on("forma_pagtos");

            $table->date('data_recebimento')->nullable();
            $table->integer('documento')->nullable();
            $table->decimal('valor_original',10,2)->nullable()->default(0);
            $table->decimal('valor_recebido', 10,2)->default(0);
            $table->decimal('juros',10,2)->nullable()->default(0);
            $table->decimal('multa',10,2)->nullable()->default(0);
            $table->string('observacao',90)->nullable();
            $table->decimal('desconto',10,2)->nullable();
            $table->string('origem',40)->nullable();
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
        Schema::dropIfExists('recebimentos');
    }
};
