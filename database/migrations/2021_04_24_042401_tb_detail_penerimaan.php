<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbDetailPenerimaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_penerimaan', function (Blueprint $table) {
            $table->bigIncrements('id_detail_penerimaan');
            $table->string('kode_penerimaan');
            $table->double('berat');
            $table->double('potongan');
            $table->float('potongan_zak');
            $table->double('berat_total');
            $table->double('bayar');
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
