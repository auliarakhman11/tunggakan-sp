<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $fillable = ['berkas_id', 'proses_id', 'tgl', 'user_id', 'void', 'kembali'];

    public function berkas()
    {
        return $this->belongsTo(Berkas::class, 'berkas_id', 'id');
    }

    public function proses()
    {
        return $this->belongsTo(Proses::class,'proses_id','id');
    }

    public function petugasBerkas()
    {
        return $this->hasMany(PetugasBerkas::class, 'history_id', 'id');
    }
}
