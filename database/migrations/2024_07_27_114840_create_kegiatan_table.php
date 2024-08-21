<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanTable extends Migration
{
    public function up()
    {
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('peserta_terlibat');
            $table->text('uraian_kegiatan');
            $table->integer('personil_terlibat');
            $table->string('foto');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('kegiatan');
    }
}
