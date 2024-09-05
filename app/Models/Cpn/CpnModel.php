<?php

namespace App\Models\Cpn;

use CodeIgniter\Model;

class CpnModel extends Model
{
    protected $table      = 'cpn';
    protected $primaryKey = 'idcpn';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'mariee', 'titulaireId', 'typePersonne', 'dateAccouchement', 'ageinf16', 
        'agesup35', 'taille', 'tension', 'parite', 'cesarienne', 
        'mortne', 'drepanocytose', 'vat1', 'vat2', 'vat3', 
        'vat4', 'vat5' , 'etat' , 'isFinished'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
