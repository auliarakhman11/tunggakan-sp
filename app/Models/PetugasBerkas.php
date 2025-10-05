<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasBerkas extends Model
{
    use HasFactory;

    protected $table = 'petugas_berkas';
    protected $fillable = ['berkas_id', 'history_id', 'proses_id', 'petugas_id', 'user_id', 'void'];
}
