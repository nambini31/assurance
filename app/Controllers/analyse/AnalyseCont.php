<?php

namespace App\Controllers\analyse;

use App\Controllers\BaseController;

class AnalyseCont extends BaseController
{
    public function index()
    {

        $content = view('analyse/index');
        return view('layout', ['content' => $content]);
    }

    public function lien()
    {

        return view('analyse/index');
    }


    public function ajout_analyse()
    {
        try {
            $_POST["role_user"] = implode(",",$_POST["user_role_non_formate"]);
            $this->analyse->save($_POST);

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function supprimer_analyse()
    {
        try {

            $id = $_POST['id'];

            $this->analyse->where('id_analyse', $id)->delete();

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function charge_type_analyse()
    {
        try {

            $data =  $this->type_analyse->where("etat" ,  1 )->findAll();

            $specialite = '';

                foreach ($data as $value) {
                    $specialite .= '
                        <option value="' . $value['id_type_analyse'] . '"> '. $value['nom_type_analyse'] . '</option> ';
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
    public function liste_analyse()
    {
        try {
            $ctegorie = $this->analyse
            ->where('analyse.etat', 1)
            ->select("type_analyse.nom_type_analyse, analyse.analyse , id_analyse , analyse.role_user , type_analyse.id_type_analyse")
            ->join("type_analyse" , "type_analyse.id_type_analyse = analyse.type_analyse")
            ->findAll();

            $th = "
                    <thead>
                      <tr>
                        <th>id</th>
                            <th>Nom analyse</th>
                            <th>type analyse</th>
                            <th>Utilisateur access</th>
                            <th>Actions</th>
                        </tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {

                $role = "" ;

                if ($value["role_user"] == "2,3" || $value["role_user"] == "3,2" ) {
                    $role = "Parametre et Docteur" ;
                    $roleAttr = json_encode(explode(',', $value["role_user"]))  ;
                }
                elseif ($value["role_user"] == "2") {
                    # code...
                    $roleAttr = json_encode([$value["role_user"]])  ;
                    $role = "Parametre" ;
                }
                elseif ($value["role_user"] == "3") {
                    # code...
                    $roleAttr = json_encode([$value["role_user"]])  ;
                    $role = "Docteur" ;
                }

                $th .=
                    '<tr>
                        <td style="width : 20%;">' . $value["id_analyse"] . ' </td>
                        <td style="width : 50%;">' . $value["analyse"] . ' </td>
                        <td style="width : 40%;">' . $value["nom_type_analyse"] . '</td> 
                        <td style="width : 40%;">' . $role . '</td> 
                        <td> <a class="info mr-1"   id="med_'.$value["id_analyse"] .'" data-role_user='. htmlspecialchars($roleAttr) .'  data-nom_analyse="'.$value["analyse"] .'" data-id_type_analyse="'.$value["id_type_analyse"] .'" onclick="editanalyse(' . $value["id_analyse"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="danger mr-1" onclick="supprimeranalyse(' . $value["id_analyse"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }
        
            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

}
