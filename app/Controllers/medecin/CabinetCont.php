<?php

namespace App\Controllers\Medecin;

use App\Controllers\BaseController;

class CabinetCont extends BaseController
{
    public function ajout_cabinet()
    {
        try {
            $id = $this->cabinet->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_cabinet()
    {
        try {

            $id = $_POST['id'];

            $this->cabinet->where('id_cabinet', $id)->delete();

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    
    public function liste_cabinet()
    {
        try {
            $ctegorie = $this->cabinet->where('etat', 1)->findAll();
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
                        <td style="width : 20%;">' . $value["id_cabinet"] . ' </td>
                        <td style="width : 100%;">' . $value["nom_cabinet"] . '</td> 
                        <td> <a class="info mr-1 " id="cab_'.$value["id_cabinet"] .'" data-nom_cabinet="'.$value["nom_cabinet"] .'" onclick="editcabinet(' . $value["id_cabinet"] . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimercabinet(' . $value["id_cabinet"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
