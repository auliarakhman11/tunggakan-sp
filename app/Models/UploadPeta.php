<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPeta extends Model
{
    use HasFactory;

    protected $table = 'upload_peta';
    protected $fillable = ['peta_id', 'nm_uplaod', 'file_name', 'jenis_file', 'sesuai_posisi'];

    public function peta()
    {
        return $this->belongsTo(Peta::class, 'peta_id', 'id');
    }
}
