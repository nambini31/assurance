<?php

namespace App\Models\article;

use CodeIgniter\Model;

class ArticleModel extends Model {

    protected $table = 'article';
    protected $primaryKey = 'id_article'; // Clé primaire de votre table

    protected $allowedFields = [
        'designation' ,	'prix_unitaire',	'quantite' ,	'id_fournisseur' ,	'etat' , "unite" , "presentation" , "dateperemption"
    ];

}