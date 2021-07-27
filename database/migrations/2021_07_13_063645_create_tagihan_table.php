<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id');
            $table->foreignId('petugas_id')->nullable();
            $table->foreignId('buku_tahun_id');
            $table->integer('bulan');
            $table->integer('meter_lalu')->default(0);
            $table->integer('meter_sekarang')->default(0);
            $table->integer('jumlah_meter')->default(0);
            $table->integer('bayar')->default(0);
            $table->tinyInteger('status')
                ->default(1)
                ->comment('1: belum data, 2: belum bayar, 3: sebagian, 4: lunas');
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
        Schema::dropIfExists('tagihan');
    }
}
