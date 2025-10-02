<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';
    protected $fillable = ['berkas_id', 'proses_id', 'tgl', 'user_id'];

    public function berkas()
    {
        return $this->belongsTo(Berkas::class, 'berkas_id', 'id');
    }
}
