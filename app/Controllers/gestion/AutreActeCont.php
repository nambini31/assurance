<?php

namespace App\Controllers\gestion;

use App\Controllers\BaseController;

class AutreActeCont extends BaseController
{
    public function ajout_autreActe()
    {
        try {
            $id = $this->autreActe->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_autreActe()
    {
        try {

            $id = $_POST['id'];

            $this->autreActe->update($id , ["etat" => 0]);

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    
    public function liste_autreActe()
    {
        try {
            $ctegorie = $this->autreActe->where('etat', 1)->findAll();
            $th = "
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Administration</th><th>Actions</th>
                        </tr></thead> 
                        <tbody>";


            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 20%;">' . $value["idautreActe"] . ' </td>
                        <td style="width : 100%;">' . $value["autreActe"] . '</td> 
                        <td> <a class="info mr-1 " 
                        id="autreActe_'. $value["idautreActe"] .'" 
                        data-methodnom="'.$value["autreActe"] .'" 
                        onclick="editautreActe(' . $value["idautreActe"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="danger mr-1" onclick="supprimerautreActe(' . $value["idautreActe"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
