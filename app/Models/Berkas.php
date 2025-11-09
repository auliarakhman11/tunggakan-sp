<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $fillable = ['proses_id', 'no_berkas', 'tahun', 'nm_pemohon', 'jenis_kegiatan', 'kelurahan', 'tgl', 'void', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function proses()
    {
        return $this->belongsTo(Proses::class, 'proses_id', 'id');
    }

    public function petugasBerkas()
    {
        return $this->hasMany(PetugasBerkas::class, 'berkas_id', 'id');
    }
}
