<?php

namespace App\Controllers\gestion;

use App\Controllers\BaseController;

class MethodePfCont extends BaseController
{
    public function ajout_methodePf()
    {
        try {
            $id = $this->methodePf->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_methodePf()
    {
        try {

            $id = $_POST['id'];

            $this->methodePf->update($id , ["etat" => 0]);

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    
    public function liste_methodePf()
    {
        try {
            $ctegorie = $this->methodePf->where('etat', 1)->findAll();
            $th = "
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Methodes</th><th>Actions</th>
                        </tr></thead> 
                        <tbody>";


            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 20%;">' . $value["idmethodePf"] . ' </td>
                        <td style="width : 100%;">' . $value["methodePf"] . '</td> 
                        <td> <a class="info mr-1 " 
                        id="methodepf_'. $value["idmethodePf"] .'" 
                        data-methodnom="'.$value["methodePf"] .'" 
                        onclick="editmethodePf(' . $value["idmethodePf"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="danger mr-1" onclick="supprimermethodePf(' . $value["idmethodePf"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
