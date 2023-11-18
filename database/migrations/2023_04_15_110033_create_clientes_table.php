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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->string('tipo_cliente', 1)->default('F');
            $table->string('eh_consumidor', 1)->nullable()->default('N');
            $table->string('nome_razao_social', 100);
            $table->string('nome_fantasia', 80)->nullable();
            $table->string('cpf_cnpj', 19);
            $table->string("rg_ie", 20)->nullable();
            $table->string("isento_ie_estadual", 30)->nullable();
            $table->string("tipo_contribuinte", 30)->nullable();
            $table->string("responsavel", 80)->nullable();
            $table->string("idestrangeiro", 20)->nullable();

            $table->integer('indFinal');
            $table->string('logradouro', 80);
            $table->string('numero', 10);
            $table->string('bairro', 50);
            $table->string('uf', 2);
            $table->string('complemento', 50)->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('ibge', 15)->nullable();
            $table->string('cidade',100)->nullable();
            $table->date("nascimento")->nullable();
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
        Schema::dropIfExists('clientes');
    }
};
