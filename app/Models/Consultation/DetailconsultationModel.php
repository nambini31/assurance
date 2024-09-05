<?php

namespace App\Models\Consultation;

use CodeIgniter\Model;

class DetailconsultationModel extends Model
{
    protected $table            = 'detailconsultation';
    protected $primaryKey       = 'detailConsultationId';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        "motif"	, "TypepersonneMalade" , "idPersonneMalade"	, "etat" ,	"consultationId",
        "isFinished" , "dateParametre" ,	"dateDocteur"	, "temperature" , "titulaireId"
        	, "tension" ,	"poids" , "taille" , "dateLaboratoire" , "natureExamen" , "rc"  , "resultats",	"douleur" ,	"descriptionDouleur"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
    protected $deletedField  = 'deletedAt';

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
