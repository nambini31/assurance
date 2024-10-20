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
    protected $allowedFields    = ['dateEnvoie', 'dateValidation', 'idenvoie_labo', 'idType', 'Source' , "resultatTelechargeable",
     'typeEnvoie' , "id_user" , "natureExamen" , "id_user_valid" , "rc"  , "resultats" , "etat" , "typeDestinataire", "docteurEchographie", "typeEchographie" , 
    "indication", "techniques", "qualiteExamen", "autre", "conclusion", "positionUterus", "contourUterus", 
    "moyenneUterus", "endometreUterus", "ligneVacuiteUterus", "dimensionUterus", "contourOvaireDroite", "contourOvaireGauche",
     "tailleOvaireDroite", "tailleOvaireGauche", "culSacDouglas", "vessie", "appendice", "dimensionAspectMasse", "echoStructureMasse",
      "contourMasse", "siegeMasse", "dimensionAspectGanglion", "echoStructureGanglion", "contourGanglion", "siegeGanglion", "glandeThyroide",
       "dimensionLobeDroite", "dimensionLobeGauche", "echoStructureLobeDroite", "echoStructureLobeGauche", "volumeLobeDroite", "contourLobeDroite",
        "dimensionIsthme", "echoStructureIsthme", "contourIsthme", "ganglionIsthme", "integriteParoiCarotide", "epaisseurParoiCarotide",
         "permeabiliteCarotide", "integriteParoiJuducaire", "epaisseurParoiJuducaire", "permeabiliteJuducaire", "foieContourAdboPelvienne",
          "tailleAdboPelvienne", "echoStructureAdboPelvienne", "troncPortAdboPelvienne", "veineHepatiqueAbdominale", "vesiculeBiliaireVoieBiliaireAbdominale",
           "contenuVoieBiliaireAbdominale", "paroiVoieBiliaireAbdominale", "intrahepatiqueVoieBiliaireAbdominale", "extrahepatiqueVoieBiliaireAbdominale", 
           "contourAortePancreasAbdominale", "tailleAortePancreasAbdominale", "echoStructureAortePancreasAbdominale", "canalWirsungAortePancreasAbdominale", 
           "rateContourAorteEstomacAbdominale", "echoStructureAorteEstomacAbdominale", "flecheSpleniqueAorteEstomacAbdominale", "reinsContourAorteEstomacAbdominale",
            "echoStructureDiffCortioSinusaleAorteEstomacAbdominale", "dilatationPyeloCalicielleAorteEstomacAbdominale", "lithiaseAorteEstomacAbdominale", 
            "ansesDigestiveAbdominale", "veineHepatiqueAdboPelvienne", "vesiculeBiliaireVoieBiliaire", "contenuVoieBiliaire", "paroiVoieBiliaire", 
            "intrahepatiqueVoieBiliaire", "extrahepatiqueVoieBiliaire", "contourAortePancreas", "tailleAortePancreas", "echoStructureAortePancreas", 
            "canalWirsungAortePancreas", "rateContourAorteEstomac", "echoStructureAorteEstomac", "flecheSpleniqueAorteEstomac", "reinsContourAorteEstomac", 
            "echoStructureDiffCortioSinusaleAorteEstomac", "dilatationPyeloCalicielleAorteEstomac", "lithiaseAorteEstomac", "qualiteExamenSondeAbdominale", 
            "positionUterusSondeAbdominale", "contourUterusSondeAbdominale", "myometreUterusSondeAbdominale", "endometreUterusSondeAbdominale",
             "dimensionUterusSondeAbdominale", "ligneVacuiteSondeAbdominale", "culSacDouglasOvaire", "vessieOvaires", "appendiceOvaires", 
             "foieContourAbdominale", "tailleAbdominale", "echoStructureAbdominale", "troncPortAbdominale", "ansesDigestivesAbdoPelvienne",
              "foetusObstericalePrimo", "cardiaqueFoetaleObstericalePrimo", "rythmeObstericalePrimo", "frequenceObstericalePrimo", "mouvementFoetauxObstericalePrimo", 
              "vesiculeVitellineObstericalePrimo", "biometrieObstericalePrimo", "crlObstericalePrimo", "dimensionSacObstericalePrimo", "normaPourSA1ObstericalePrimo", 
              "normaPourSA2ObstericalePrimo", "normaPourJRS1ObstericalePrimo", "normaPourJRS2ObstericalePrimo", "placentaObstericalePrimo", "positionObstericalePrimo",
               "echoStructureObstericalePrimo", "gradeObstericalePrimo", "DPAObstericalePrimo", "foetusObstericaleSecondTertio", "acFoetaleObstericaleSecondTertio",
                "rythmeObstericaleSecondTertio", "frequenceObstericaleSecondTertio", "mouvementFoetauxObstericaleSecondTertio", "presentationObstericaleSecondTertio",
                 "BIPObstericaleSecondTertio", "BIPSAObstericaleSecondTertio", "BIPJRSObstericaleSecondTertio", "CAObstericaleSecondTertio", "CASAObstericaleSecondTertio",
                  "CAJRSObstericaleSecondTertio", "FLObstericaleSecondTertio", "FLSAObstericaleSecondTertio", "FLJRSObstericaleSecondTertio", "CoeurObstericaleSecondTertio",
                   "segmentMembreObstericaleSecondTertio", "placentaObstericaleSecondTertio", "echoStructureObstericaleSecondTertio", "gradeObstericaleSecondTertio",
                    "artereObstericaleSecondTertio", "veineObstericaleSecondTertio", "sexeObstericaleSecondTertio", "DPAObstericaleSecondTertio"];

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
