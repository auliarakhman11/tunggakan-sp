<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadCatatan extends Model
{
    use HasFactory;

    protected $table = 'upload_catatan';
    protected $fillable = ['catatan_id', 'nm_uplaod', 'file_name', 'jenis_file'];

    public function catatan()
    {
        return $this->belongsTo(Catatan::class, 'catatan_id', 'id');
    }
}
