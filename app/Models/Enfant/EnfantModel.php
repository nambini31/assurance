<?php

namespace App\Models\Enfant;
use CodeIgniter\Model;

class EnfantModel extends Model
{
    // Nom de la table associée au modèle
    protected $table = 'enfant';

    // Clé primaire de la table
    protected $primaryKey = 'enfantId';

    // Les champs qui peuvent être insérés ou mis à jour
    protected $allowedFields = [
        'titulaireId',
        'nom',
        'prenom',
        'fonction',
        'genre',
        'dateNaiss',
        'typeEnfant',
        'motif',
        'isActif',
        'etat',
        'createdAt',
        'updatedAt'
    ];

    // Les champs qui seront automatiquement remplis avec la date/heure de création et de mise à jour
    protected $useTimestamps = true;

    // Format de date pour les champs createdAt et updatedAt
    protected $dateFormat = 'datetime';

    // Les champs qui seront automatiquement remplis lors de la création et de la mise à jour
    protected $createdField  = 'createdAt';
    protected $updatedField  = 'updatedAt';
    
}