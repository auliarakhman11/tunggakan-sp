<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetaSesuai extends Model
{
    use HasFactory;
    protected $table = 'peta_sesuai';
    protected $fillable = ['nm_peta', 'no_peta', 'lembar', 'skala', 'jenis_kegiatan', 'kecamatan', 'kelurahan', 'luas', 'tahun_pembuatan', 'jenis_kertas', 'kondisi', 'ket', 'sesuai_posisi', 'user_id', 'void'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function uploadPetaSesuai()
    {
        return $this->hasMany(UploadPetaSesuai::class, 'peta_id', 'id');
    }
}
