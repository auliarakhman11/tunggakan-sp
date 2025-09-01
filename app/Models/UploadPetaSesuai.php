<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadPetaSesuai extends Model
{
    use HasFactory;
    protected $table = 'upload_peta_sesuai';
    protected $fillable = ['peta_id', 'nm_uplaod', 'file_name', 'jenis_file', 'sesuai_posisi'];

    public function peta()
    {
        return $this->belongsTo(PetaSesuai::class, 'peta_id', 'id');
    }
}
