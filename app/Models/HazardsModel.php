<?php

namespace App\Models;

use CodeIgniter\Model;

class HazardsModel extends Model
{ 
    protected $table = 'hazards';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = false;   

    protected $allowedFields = ['id','tgl_lapor', 'nama', 'nip', 'section', 'lokasi', 'jenis_bahaya', 'uraian_bahaya','penyebab','tindakan_perbaikan','status','foto','id_user'];
}