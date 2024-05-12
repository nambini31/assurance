<?php

namespace App\Controllers\Medecin;

use App\Controllers\BaseController;

class SpecialiteCont extends BaseController
{
    public function ajout_specialite()
    {
        try {
            $id = $this->specialite->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_specialite()
    {
        try {

            $id = $_POST['id'];

            $this->specialite->where('id_specialite', $id)->delete();

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    
    public function liste_specialite()
    {
        try {
            $ctegorie = $this->specialite->where('etat', 1)->findAll();
            $th = "
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Désignation</th><th>Actions</th>
                        </tr></thead> 
                        <tbody>";


            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 20%;">' . $value["id_specialite"] . ' </td>
                        <td style="width : 100%;">' . $value["nom_specialite"] . '</td> 
                        <td> <a class="info mr-1 " id="cab_'.$value["id_specialite"] .'" data-nom_specialite="'.$value["nom_specialite"] .'" onclick="editspecialite(' . $value["id_specialite"] . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimerspecialite(' . $value["id_specialite"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
