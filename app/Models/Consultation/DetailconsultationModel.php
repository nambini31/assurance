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
        "motif"	, "TypepersonneMalade" , "idPersonneMalade" , "bilanHydrique"	, "etat" ,	"consultationId", "frequenceRespiratoire", "frequenceCardiaque", "etatConscience", "sf", "pupille", "peekFlow", "glicemie", "conjonctives", "perimetreBras", "perimetreCrane", "gcs", "evs", "diurese" ,
        "isFinished" , "dateParametre" ,	"dateDocteur"	, "temperature" , "titulaireId" , "isPharmacie" , "histoMaladie", "examClinique", "chirurgie", "alergie"
        	, "tension" ,	"poids" , "taille" , "isLabo" , 	"douleur" ,	"descriptionDouleur" // ispharmacie tsy misy satria mandiny validation doc vo pharmacie rozy iaby
    ];

    // Dates
    protected $useTimestamps = true;
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
