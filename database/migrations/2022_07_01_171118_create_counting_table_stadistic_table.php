<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountingTableStadisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counting_table_stadistics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pk1_1400')->default(0);
            $table->integer('pk2_1400')->default(0);
            $table->integer('pk3_1400')->default(0);
            $table->integer('bj1_1400')->default(0);
            $table->integer('bj2_1400')->default(0);
            $table->integer('bj3_1400')->default(0);
            $table->integer('ra1_1400')->default(0);
            $table->integer('ra2_1400')->default(0);
            $table->integer('ra3_1400')->default(0);
            $table->integer('ra4_1400')->default(0);
            $table->integer('pb1_1400')->default(0);
            $table->integer('pb2_1400')->default(0);
            $table->integer('pb3_1400')->default(0);
            $table->integer('pb4_1400')->default(0);
            $table->integer('pb5_1400')->default(0);
            
            $table->integer('pk1_1500')->default(0);
            $table->integer('pk2_1500')->default(0);
            $table->integer('pk3_1500')->default(0);
            $table->integer('bj1_1500')->default(0);
            $table->integer('bj2_1500')->default(0);
            $table->integer('bj3_1500')->default(0);
            $table->integer('ra1_1500')->default(0);
            $table->integer('ra2_1500')->default(0);
            $table->integer('ra3_1500')->default(0);
            $table->integer('ra4_1500')->default(0);
            $table->integer('pb1_1500')->default(0);
            $table->integer('pb2_1500')->default(0);
            $table->integer('pb3_1500')->default(0);
            $table->integer('pb4_1500')->default(0);
            $table->integer('pb5_1500')->default(0);

            $table->integer('pk1_1600')->default(0);
            $table->integer('pk2_1600')->default(0);
            $table->integer('pk3_1600')->default(0);
            $table->integer('bj1_1600')->default(0);
            $table->integer('bj2_1600')->default(0);
            $table->integer('bj3_1600')->default(0);
            $table->integer('ra1_1600')->default(0);
            $table->integer('ra2_1600')->default(0);
            $table->integer('ra3_1600')->default(0);
            $table->integer('ra4_1600')->default(0);
            $table->integer('pb1_1600')->default(0);
            $table->integer('pb2_1600')->default(0);
            $table->integer('pb3_1600')->default(0);
            $table->integer('pb4_1600')->default(0);
            $table->integer('pb5_1600')->default(0);

            $table->integer('pk1_1700')->default(0);
            $table->integer('pk2_1700')->default(0);
            $table->integer('pk3_1700')->default(0);
            $table->integer('bj1_1700')->default(0);
            $table->integer('bj2_1700')->default(0);
            $table->integer('bj3_1700')->default(0);
            $table->integer('ra1_1700')->default(0);
            $table->integer('ra2_1700')->default(0);
            $table->integer('ra3_1700')->default(0);
            $table->integer('ra4_1700')->default(0);
            $table->integer('pb1_1700')->default(0);
            $table->integer('pb2_1700')->default(0);
            $table->integer('pb3_1700')->default(0);
            $table->integer('pb4_1700')->default(0);
            $table->integer('pb5_1700')->default(0);

            $table->integer('pk1_1800')->default(0);
            $table->integer('pk2_1800')->default(0);
            $table->integer('pk3_1800')->default(0);
            $table->integer('bj1_1800')->default(0);
            $table->integer('bj2_1800')->default(0);
            $table->integer('bj3_1800')->default(0);
            $table->integer('ra1_1800')->default(0);
            $table->integer('ra2_1800')->default(0);
            $table->integer('ra3_1800')->default(0);
            $table->integer('ra4_1800')->default(0);
            $table->integer('pb1_1800')->default(0);
            $table->integer('pb2_1800')->default(0);
            $table->integer('pb3_1800')->default(0);
            $table->integer('pb4_1800')->default(0);
            $table->integer('pb5_1800')->default(0);

            $table->integer('pk1_1900')->default(0);
            $table->integer('pk2_1900')->default(0);
            $table->integer('pk3_1900')->default(0);
            $table->integer('bj1_1900')->default(0);
            $table->integer('bj2_1900')->default(0);
            $table->integer('bj3_1900')->default(0);
            $table->integer('ra1_1900')->default(0);
            $table->integer('ra2_1900')->default(0);
            $table->integer('ra3_1900')->default(0);
            $table->integer('ra4_1900')->default(0);
            $table->integer('pb1_1900')->default(0);
            $table->integer('pb2_1900')->default(0);
            $table->integer('pb3_1900')->default(0);
            $table->integer('pb4_1900')->default(0);
            $table->integer('pb5_1900')->default(0);

            $table->integer('pk1_2000')->default(0);
            $table->integer('pk2_2000')->default(0);
            $table->integer('pk3_2000')->default(0);
            $table->integer('bj1_2000')->default(0);
            $table->integer('bj2_2000')->default(0);
            $table->integer('bj3_2000')->default(0);
            $table->integer('ra1_2000')->default(0);
            $table->integer('ra2_2000')->default(0);
            $table->integer('ra3_2000')->default(0);
            $table->integer('ra4_2000')->default(0);
            $table->integer('pb1_2000')->default(0);
            $table->integer('pb2_2000')->default(0);
            $table->integer('pb3_2000')->default(0);
            $table->integer('pb4_2000')->default(0);
            $table->integer('pb5_2000')->default(0);

            $table->integer('pk1_2100')->default(0);
            $table->integer('pk2_2100')->default(0);
            $table->integer('pk3_2100')->default(0);
            $table->integer('bj1_2100')->default(0);
            $table->integer('bj2_2100')->default(0);
            $table->integer('bj3_2100')->default(0);
            $table->integer('ra1_2100')->default(0);
            $table->integer('ra2_2100')->default(0);
            $table->integer('ra3_2100')->default(0);
            $table->integer('ra4_2100')->default(0);
            $table->integer('pb1_2100')->default(0);
            $table->integer('pb2_2100')->default(0);
            $table->integer('pb3_2100')->default(0);
            $table->integer('pb4_2100')->default(0);
            $table->integer('pb5_2100')->default(0);

            $table->integer('pk1_2200')->default(0);
            $table->integer('pk2_2200')->default(0);
            $table->integer('pk3_2200')->default(0);
            $table->integer('bj1_2200')->default(0);
            $table->integer('bj2_2200')->default(0);
            $table->integer('bj3_2200')->default(0);
            $table->integer('ra1_2200')->default(0);
            $table->integer('ra2_2200')->default(0);
            $table->integer('ra3_2200')->default(0);
            $table->integer('ra4_2200')->default(0);
            $table->integer('pb1_2200')->default(0);
            $table->integer('pb2_2200')->default(0);
            $table->integer('pb3_2200')->default(0);
            $table->integer('pb4_2200')->default(0);
            $table->integer('pb5_2200')->default(0);

            $table->integer('pk1_2300')->default(0);
            $table->integer('pk2_2300')->default(0);
            $table->integer('pk3_2300')->default(0);
            $table->integer('bj1_2300')->default(0);
            $table->integer('bj2_2300')->default(0);
            $table->integer('bj3_2300')->default(0);
            $table->integer('ra1_2300')->default(0);
            $table->integer('ra2_2300')->default(0);
            $table->integer('ra3_2300')->default(0);
            $table->integer('ra4_2300')->default(0);
            $table->integer('pb1_2300')->default(0);
            $table->integer('pb2_2300')->default(0);
            $table->integer('pb3_2300')->default(0);
            $table->integer('pb4_2300')->default(0);
            $table->integer('pb5_2300')->default(0);

            $table->integer('pk1_0000')->default(0);
            $table->integer('pk2_0000')->default(0);
            $table->integer('pk3_0000')->default(0);
            $table->integer('bj1_0000')->default(0);
            $table->integer('bj2_0000')->default(0);
            $table->integer('bj3_0000')->default(0);
            $table->integer('ra1_0000')->default(0);
            $table->integer('ra2_0000')->default(0);
            $table->integer('ra3_0000')->default(0);
            $table->integer('ra4_0000')->default(0);
            $table->integer('pb1_0000')->default(0);
            $table->integer('pb2_0000')->default(0);
            $table->integer('pb3_0000')->default(0);
            $table->integer('pb4_0000')->default(0);
            $table->integer('pb5_0000')->default(0);

            $table->integer('pk1_0100')->default(0);
            $table->integer('pk2_0100')->default(0);
            $table->integer('pk3_0100')->default(0);
            $table->integer('bj1_0100')->default(0);
            $table->integer('bj2_0100')->default(0);
            $table->integer('bj3_0100')->default(0);
            $table->integer('ra1_0100')->default(0);
            $table->integer('ra2_0100')->default(0);
            $table->integer('ra3_0100')->default(0);
            $table->integer('ra4_0100')->default(0);
            $table->integer('pb1_0100')->default(0);
            $table->integer('pb2_0100')->default(0);
            $table->integer('pb3_0100')->default(0);
            $table->integer('pb4_0100')->default(0);
            $table->integer('pb5_0100')->default(0);

            $table->integer('pk1_0200')->default(0);
            $table->integer('pk2_0200')->default(0);
            $table->integer('pk3_0200')->default(0);
            $table->integer('bj1_0200')->default(0);
            $table->integer('bj2_0200')->default(0);
            $table->integer('bj3_0200')->default(0);
            $table->integer('ra1_0200')->default(0);
            $table->integer('ra2_0200')->default(0);
            $table->integer('ra3_0200')->default(0);
            $table->integer('ra4_0200')->default(0);
            $table->integer('pb1_0200')->default(0);
            $table->integer('pb2_0200')->default(0);
            $table->integer('pb3_0200')->default(0);
            $table->integer('pb4_0200')->default(0);
            $table->integer('pb5_0200')->default(0);

            $table->integer('pk1_0300')->default(0);
            $table->integer('pk2_0300')->default(0);
            $table->integer('pk3_0300')->default(0);
            $table->integer('bj1_0300')->default(0);
            $table->integer('bj2_0300')->default(0);
            $table->integer('bj3_0300')->default(0);
            $table->integer('ra1_0300')->default(0);
            $table->integer('ra2_0300')->default(0);
            $table->integer('ra3_0300')->default(0);
            $table->integer('ra4_0300')->default(0);
            $table->integer('pb1_0300')->default(0);
            $table->integer('pb2_0300')->default(0);
            $table->integer('pb3_0300')->default(0);
            $table->integer('pb4_0300')->default(0);
            $table->integer('pb5_0300')->default(0);

            $table->integer('pk1_0400')->default(0);
            $table->integer('pk2_0400')->default(0);
            $table->integer('pk3_0400')->default(0);
            $table->integer('bj1_0400')->default(0);
            $table->integer('bj2_0400')->default(0);
            $table->integer('bj3_0400')->default(0);
            $table->integer('ra1_0400')->default(0);
            $table->integer('ra2_0400')->default(0);
            $table->integer('ra3_0400')->default(0);
            $table->integer('ra4_0400')->default(0);
            $table->integer('pb1_0400')->default(0);
            $table->integer('pb2_0400')->default(0);
            $table->integer('pb3_0400')->default(0);
            $table->integer('pb4_0400')->default(0);
            $table->integer('pb5_0400')->default(0);

            $table->integer('pk1_0500')->default(0);
            $table->integer('pk2_0500')->default(0);
            $table->integer('pk3_0500')->default(0);
            $table->integer('bj1_0500')->default(0);
            $table->integer('bj2_0500')->default(0);
            $table->integer('bj3_0500')->default(0);
            $table->integer('ra1_0500')->default(0);
            $table->integer('ra2_0500')->default(0);
            $table->integer('ra3_0500')->default(0);
            $table->integer('ra4_0500')->default(0);
            $table->integer('pb1_0500')->default(0);
            $table->integer('pb2_0500')->default(0);
            $table->integer('pb3_0500')->default(0);
            $table->integer('pb4_0500')->default(0);
            $table->integer('pb5_0500')->default(0);

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
        Schema::dropIfExists('counting_table_stadistics');
    }
}
