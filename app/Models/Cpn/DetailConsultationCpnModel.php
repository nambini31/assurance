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
        "idcpn",  "num", "tagd", "poids", "taille", "alboedemes", "vedese", "cpnconjonctive", "saignement", "hauteuruterine", "largue", "ddr", "dpa", "hu", "maf", "omi", "vat", "spi", "bdcf", "rechercheActive", "presentation", "refeaccouche", "serologierdr", "serologievidal", "asaurine", "groupage", "hiv", "fcv", "bw", "toxoplasmose", "rubuole", "tpha", "nfs", "feracfolique", "dateRendevous", "createdAt" , "isLabo" , "isEchographie"
    ];


    // Dates
    protected $useTimestamps = true;
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
