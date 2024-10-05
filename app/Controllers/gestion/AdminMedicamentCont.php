<?php

namespace App\Controllers\gestion;

use App\Controllers\BaseController;

class AdminMedicamentCont extends BaseController
{
    public function ajout_adminMedicament()
    {
        try {
            $id = $this->adminMedicament->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_adminMedicament()
    {
        try {

            $id = $_POST['id'];

            $this->adminMedicament->update($id , ["etat" => 0]);

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    
    public function liste_adminMedicament()
    {
        try {
            $ctegorie = $this->adminMedicament->where('etat', 1)->findAll();
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
                        <td style="width : 20%;">' . $value["idadminMedicament"] . ' </td>
                        <td style="width : 100%;">' . $value["adminMedicament"] . '</td> 
                        <td> <a class="info mr-1 " 
                        id="adminMedicament_'. $value["idadminMedicament"] .'" 
                        data-methodnom="'.$value["adminMedicament"] .'" 
                        onclick="editadminMedicament(' . $value["idadminMedicament"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="danger mr-1" onclick="supprimeradminMedicament(' . $value["idadminMedicament"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
