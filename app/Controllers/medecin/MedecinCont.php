<?php

namespace App\Controllers\medecin;

use App\Controllers\BaseController;

class MedecinCont extends BaseController
{
    public function index()
    {

        $content = view('medecin/index');
        return view('layout', ['content' => $content]);
    }

    public function lien()
    {

        return view('medecin/index');
    }


    public function ajout_medecin()
    {
        try {
            $id = $this->medecin->save($_POST);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_medecin()
    {
        try {

            $id = $_POST['id'];

            $this->medecin->where('id_medecin', $id)->delete();

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function charge_specialite()
    {
        try {

            $data =  $this->specialite->where("etat" ,  1 )->findAll();

            $specialite = '';

                foreach ($data as $value) {
                    $specialite .= '
                        <option value="' . $value['id_specialite'] . '"> '. $value['nom_specialite'] . '</option> ';
                }

            echo $specialite;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_cabinet()
    {
        try {

            $data =  $this->cabinet->where("etat" ,  1 )->findAll();

            $cabinet = '';
                foreach ($data as $value) {
                    $cabinet .= '
                        <option value="' . $value['id_cabinet'] . '"> '. $value['nom_cabinet'] . '</option> ';
                }

            echo $cabinet;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function liste_medecin()
    {
        try {
            $ctegorie = $this->medecin
            ->where('medecin.etat', 1)
            ->select("specialite.nom_specialite , cabinet.nom_cabinet , medecin.nom_medecin , id_medecin , medecin.id_cabinet , specialite.id_specialite")
            ->join("specialite" , "specialite.id_specialite = medecin.id_specialite")
            ->join("cabinet" , "cabinet.id_cabinet = medecin.id_cabinet")
            ->findAll();

            $th = "
                    <thead>
                      <tr>
                        <th>id</th>
                            <th>Nom medecin</th>
                            <th>Specialité</th>
                            <th>Cabinet</th>
                            <th>Actions</th>
                        </tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 20%;">' . $value["id_medecin"] . ' </td>
                        <td style="width : 50%;">' . $value["nom_medecin"] . ' </td>
                        <td style="width : 40%;">' . $value["nom_specialite"] . '</td> 
                        <td style="width : 40%;">' . $value["nom_cabinet"] . '</td> 
                        <td> <a class="info mr-1"   id="med_'.$value["id_medecin"] .'" data-id_cabinet="'.$value["id_cabinet"] .'" data-nom_medecin="'.$value["nom_medecin"] .'" data-id_specialite="'.$value["id_specialite"] .'" onclick="editmedecin(' . $value["id_medecin"] . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimermedecin(' . $value["id_medecin"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
