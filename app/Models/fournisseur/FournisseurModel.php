<?php

namespace App\Models\fournisseur;

use CodeIgniter\Model;

class FournisseurModel extends Model {

    protected $table = 'fournisseur';
    protected $primaryKey = 'id_fournisseur'; // Clé primaire de votre table

    protected $allowedFields = [
        'designation'	,'email' ,	'telephone' ,	'adresse', 'etat',
    ];

}