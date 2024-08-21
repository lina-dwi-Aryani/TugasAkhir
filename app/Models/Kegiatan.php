<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'waktu',
        'peserta_terlibat',
        'uraian_kegiatan',
        'personil_terlibat',
        'foto',
    ];

    // Relasi one-to-many dengan Wilayah
    public function wilayah()
    {
        return $this->hasMany(Wilayah::class, 'kegiatan_id');
    }
}
