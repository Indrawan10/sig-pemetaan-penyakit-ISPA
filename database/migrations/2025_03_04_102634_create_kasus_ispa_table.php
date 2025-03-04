<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kasus_ispa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemetaan_ispa_id')->constrained('pemetaan_ispas')->onDelete('cascade');
            $table->string('nama_penyakit');
            $table->string('umur');
            $table->integer('jumlah_laki_laki');
            $table->integer('jumlah_perempuan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kasus_ispa');
    }
};
