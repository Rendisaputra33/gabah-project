<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Penerimaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penerimaan', function (Blueprint $table) {
            $table->bigIncrements('id_penerimaan');
            $table->string('kode_penerimaan');
            $table->string('nama_gabah');
            $table->date('tanggal');
            $table->double('berat_koto');
            $table->double('total_potongan');
            $table->float('total_pot_zak');
            $table->double('total_berat');
            $table->double('total_bayar');
            $table->timestamp('tgl_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
