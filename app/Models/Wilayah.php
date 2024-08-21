<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $fillable = [
        'kegiatan_id',
        'nama_kabupaten',
        'nama_kecamatan',
        'nama_kelurahan',
        'rt',
        'rw',
    ];

    // Relasi belongsTo dengan Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
