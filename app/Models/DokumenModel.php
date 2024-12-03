<?php

namespace App\Models;

use CodeIgniter\Model;

class DokumenModel extends Model
{
    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = [
        'id_dokumen', 'nama_dokumen', 'id_user','id_jenis', 'id_kategori', 'tahun', 
        'file', 'filesize', 'keterangan', 'waktu_upload', 'waktu_update'
    ];

    // Metode untuk mengambil detail dokumen berdasarkan ID
    public function getDocumentById($docId)
    {
        return $this->where('id_dokumen', $docId)->first();
    }
}
