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
        Schema::create('plano_contas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pai_id')->nullable();
            $table->foreign('pai_id')->references('id')->on('plano_contas')->onDelete('cascade');

            $table->string('codigo',90)->unique();

            $table->string('conta',100);
            $table->string('alias',60)->nullable();
            $table->enum('tipo', ['A', 'S']);
            $table->string('natureza',1)->nullable();
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
        Schema::dropIfExists('plano_contas');
    }
};
