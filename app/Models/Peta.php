<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    use HasFactory;
    protected $table = 'peta';
    protected $fillable = ['nm_peta', 'no_peta', 'jenis_kegiatan', 'kelurahan_id', 'kecamatan_id', 'tahun_pembuatan', 'jenis_kertas', 'user_id', 'void'];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function uploadPeta()
    {
        return $this->hasMany(UploadPeta::class, 'peta_id', 'id');
    }
}
