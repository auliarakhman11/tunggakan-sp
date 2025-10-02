<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $fillable = ['proses_id', 'petugas_id', 'no_berkas', 'tahun', 'kelurahan', 'tgl', 'void', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
