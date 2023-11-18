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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->Biginteger('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->BigInteger('categoria_id')->nullable()->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->string('nome', 100);
            $table->string('gtin', 20)->nullable();
            $table->string('sku', 80)->nullable();
            $table->string('imagem', 100)->nullable();
            $table->string('origem', 10);

            $table->string('codigo_barra', 60)->nullable();
            $table->string('unidade', 20);
            $table->string('usa_grade', 1)->default('N');

            $table->decimal('preco_venda', 10,2);
            $table->decimal('preco_custo', 10,2)->nullable()->default(0);
            $table->decimal('margem_lucro', 10,2)->nullable()->default(0);

            $table->decimal('estoque_minimo', 10,2)->nullable()->default(0);
            $table->decimal('estoque_maximo', 10,2)->nullable()->default(0);
            $table->decimal('estoque_inicial', 10,2)->nullable()->default(0);
            $table->integer('estoque_atual')->nullable()->default(0);


            $table->string('ncm', 13);
            $table->string('cest', 7)->nullable();
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
        Schema::dropIfExists('produtos');
    }
};
