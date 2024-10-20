<?php

namespace App\Models\Consultation;

use CodeIgniter\Model;

class ConsultationModel extends Model
{
    protected $table            = 'consultation';
    protected $primaryKey       = 'consultationId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["titulaireId" , "docteurId" , "typeConsultationId" , "etat" , "isFinished" , "id_user" , "isLabo" , "isEchographie" ]; // ispharmacie tsy misy satria mandiny validation doc vo pharmacie rozy iaby

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';

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
