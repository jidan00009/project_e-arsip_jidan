<?php namespace App\Models;

use CodeIgniter\Model;

class JenisDokumenModel extends Model
{
    protected $table = 'jenisdokumen';
    protected $primaryKey = 'id_jenis';
    protected $allowedFields = ['id_jenis', 'nama_jenis'];
}
