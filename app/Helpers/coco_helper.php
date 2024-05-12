<?php 

helper(['db']);

function toolGetInfoArticle($id_article) {
    try {
        //code...
        $db = \Config\Database::connect();
        $builder = $db->table('article');
        
        $builder->where('id_arcticle', $id_article);
        $query = $builder->get();
        
        if ($query->getNumRows() > 0) {
            return $query->getRowArray();
        } else {
            return null;
        }
    } catch (\Throwable $th) {
        echo $th;
    }
    
}