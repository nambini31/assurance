<?php

namespace App\Controllers\examen;

use App\Controllers\BaseController;


class ExamenCont extends BaseController
{
    public function index()
    {       
        $content = view('examen/index');
        return view('layout',['content' => $content]);
    }
    
    public function lien()
    {
        return view('examen/index');
    }

    public function ajout_examen()
    {
        try {
            $this->examen->save($_POST);             
            $id = $this->examen->insertID();

            if ($_SESSION['roleId'] == 3) {
                $this->examen->update($id, ["etatExamen" => 1]);
            }
            echo json_encode(["status" => "success", "message" => "Ajout Réussit"]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function update_examen()
    {
        try {
            $id = $_POST['examenId'];
            $etatExamen = 0;
            if ($_SESSION['roleId'] == 3) {
                $etatExamen = 1;
            }
            $this->examen->update($id, array_merge($_POST, ['etatExamen' => $etatExamen]));
            echo json_encode(["status" => "success", "message" => "Modification Réussit"]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    public function charge_examen()
    {
        try {

            $data =  $this->membre->where("etat" ,  1 )->findAll();

            $membre = '<option value=""> </option> ';

                foreach ($data as $value) {
                    $membre .= '
                        <option value="' . $value['id_examen'] . '"> '. $value['nom_examen'] . '</option> ';
                }

            echo $membre;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    

    public function delete_examen()
    {
        try {
            
            // $this->examen->delete($_POST["examenId"]);
            $this->examen->update($_POST["examenId"],["isDeleted"=> 0]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_examen()
    {
        try {          
            $datas =$this->examen->where("etatExamen" , 0)->where("isDeleted" , 1)->findAll();
            $thValidation = "";
            if ($_SESSION['roleId'] == 3 || $_SESSION['roleId'] == 5) {
                // $datas = $this->examen->findAll();
                $datas = $this->examen
                    ->where("isDeleted" , 1)
                    ->orderBy("examenId", 'asc')
                    ->find();

                    $thValidation = "<th>Validation Docteur</th>";
            }

            $th = "
                <thead>
                    <th>#</th>
                    <th>Nom et prenom</th>
                    <th>Etablissement</th>
                    <th>Date Examen</th>
                    <th>Docteur</th>
                    <th>Etat de Santé</th>
                    ".$thValidation."
                    <th>action</th>
                </thead>
            ";

            $th .= "<tbody> ";

            $n = 1 ;

            foreach ($datas as $value_ar) {
                
                $validationDocteur = '<span class="badge badge-danger" style="cursor: pointer;" onclick="edit_examen('.$value_ar["ExamenId"].', 3)"> Enttente Dr</span>';
                if ($value_ar["etatExamen"]==1) {
                    $validationDocteur = "<span class='badge badge-success'> Terminé</span>";
                }
                $tdValidation= "";
                if ($_SESSION['roleId'] == 3  || $_SESSION['roleId'] == 5) {
                    $tdValidation = '           
                        <td style="width:20%" >'. $validationDocteur  .'</td>
                ';
                }
                $btn = '                
                        <td style="width:10%">
                            <a class="primary edit mr-1" title = "Editer"
                             onclick="edit_examen('.$value_ar["ExamenId"].', 4)"><i class="la la-edit"></i></a> 

                             <a class="danger mr-1" title = "Supprimer"
                             onclick="delete_examen('.$value_ar["ExamenId"].')"><i class="la la-trash"></i></a> 
                        </td>
                ';

                $th .= "     
                        <td style='width:10%'> ". $value_ar["ExamenId"] ."</td>
                        <td style='width:10%'> ". $value_ar["nomPrenom"] ."</td>
                        <td style='width:10%'> ". $value_ar["etablissement"] ."</td>
                        <td style='width:10%'> ". $value_ar["dateExamen"] ."</td>
                        <td style='width:20%'> ". $value_ar["docteurExamen"]  ."</td>
                        <td style='width:20%'><span class='badge badge-info'> ". $value_ar["etatSanteConsidere"]  ."</span></td>
                        $tdValidation
                        $btn
                ";        

                $th .= "</tr>";

                $n++ ;
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getExamenById(){
        $ExamenId = $_POST['ExamenId'];
        $selectedExamen = $this->examen->where("ExamenId" , $ExamenId)->find();
        echo json_encode(["data" => $selectedExamen]);
    }

}


