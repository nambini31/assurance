<?php

namespace App\Models\Labo;

use CodeIgniter\Model;

class EnvoieLaboModel extends Model
{
    protected $table            = 'envoie_labo';
    protected $primaryKey       = 'idenvoie_labo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dateEnvoie', 'dateValidation', 'idenvoie_labo', 'idType', 'Source' , "resultatTelechargeable", 'typeEnvoie' , "id_user" , "natureExamen" , "id_user_valid" , "rc"  , "resultats" , "etat"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dateEnvoie';

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
