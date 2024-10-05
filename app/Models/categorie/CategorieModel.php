<?php

namespace App\Models\categorie;

use CodeIgniter\Model;

class CategorieModel extends Model {

    protected $table = 'categorie';
    protected $primaryKey = 'id_categorie'; // Clé primaire de votre table

    protected $allowedFields = [
        'designation'	,'etat'
    ];

}