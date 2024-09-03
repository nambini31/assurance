<?php

namespace App\Controllers\analyse;

use App\Controllers\BaseController;

class Type_analyseCont extends BaseController
{
    public function ajout_type_analyse()
    {
        try {
            $id = $this->type_analyse->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_type_analyse()
    {
        try {

            $id = $_POST['id'];

            $this->type_analyse->where('id_type_analyse', $id)->delete();

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    
    public function liste_type_analyse()
    {
        try {
            $ctegorie = $this->type_analyse->where('etat', 1)->findAll();
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
                        <td style="width : 20%;">' . $value["id_type_analyse"] . ' </td>
                        <td style="width : 100%;">' . $value["nom_type_analyse"] . '</td> 
                        <td> <a class="info mr-1 " id="cab_'.$value["id_type_analyse"] .'" data-nom_type_analyse="'.$value["nom_type_analyse"] .'" onclick="edittype_analyse(' . $value["id_type_analyse"] . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimertype_analyse(' . $value["id_type_analyse"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
