<?php

namespace App\Models\Consultation;

use CodeIgniter\Model;

class DetailconsultationModel extends Model
{
    protected $table            = 'detailconsultation';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "motif"	, "typePersonneMalade" , "idPersonneMalade"	, "etat" ,	
        "isFinished" , "dateParametre" ,	"dateDocteur"	, "temperature"
        	, "tension" ,	"poids" ,	"douleur" ,	"descriptionDouleur"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
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
