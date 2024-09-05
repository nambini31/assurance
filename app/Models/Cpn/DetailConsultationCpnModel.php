<?php

namespace App\Models\Cpn;

use CodeIgniter\Model;

class DetailConsultationCpnModel extends Model
{
    
    protected $table      = 'detailconsultationcpn';
    protected $primaryKey = 'idconsultationcpn';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'idcpn', 'ta', 'albOedemes', 'ictereConjonctive', 'saignement', 'ferAcFolique' , 'albendazole',
        'hauteurUterine', 'bdfc', 'presentation', 'referenceAccouchement', 'prisedepoids', 'vih' , 'bw' ,
        'vat', 'spi' , 'etat' , 'rechercheActive' , 'dateRendevous' , 'num'
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
