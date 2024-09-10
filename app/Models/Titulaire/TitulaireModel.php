<?php 

namespace App\Models\Titulaire;

use CodeIgniter\Model;

class TitulaireModel extends Model
{
    protected $table = 'titulaire';
    protected $primaryKey = 'titulaireId';
    protected $allowedFields = [
        'membreId', 
        'numCarte', 
        'numCnaps',
        'nom', 
        'prenom', 
        'genre', 
        'dateNaiss', 
        'telephone', 
        'cin', 
        'fonction', 
        'adresse', 
        'dateEmbauche', 
        'dateDebauche', 
        'photo', 
        'isActif', 
        'etat', 
        'email', 
        'nomPrenomConjoint', 
        'dateNaissConjoint', 
        'telephoneConjoint', 
        'genreConjoint', 
        'fonctionConjoint',
        'motifNonAssure'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'createdAt';
    protected $updatedField = 'updatedAt';
}