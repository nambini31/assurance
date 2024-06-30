<?php

namespace App\Models\login;
use CodeIgniter\Model;

class LoginModel extends Model {

    protected $table = 'utilisateur';
    protected $primaryKey = 'id_user';

    protected $allowedFields = [
        'nom_user',
        'prenom_user',
        'mdp_user',
        'roleId',

    ];

}




