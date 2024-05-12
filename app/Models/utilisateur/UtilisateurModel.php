<?php

namespace App\Models\utilisateur;

use CodeIgniter\Model;

class UtilisateurModel extends Model {

    protected $table = 'utilisateur';
    protected $primaryKey = 'id_user'; // Clé primaire de votre table

    protected $allowedFields = [
        	'nom_user', 'prenom_user', 'mdp_user', 'role_user', 'etat', 'image', 
    ];
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}