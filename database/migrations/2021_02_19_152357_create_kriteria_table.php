<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kriteria', function (Blueprint $table) {
            $table->string('kode_kriteria', 16)->primary();
            $table->string('nama_kriteria')->nullable();
            $table->double('bobot')->nullable();
            $table->double('range1')->nullable();
            $table->double('range2')->nullable();
            $table->string('atribut', 16)->nullable();
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
        Schema::dropIfExists('tb_kriteria');
    }
}
