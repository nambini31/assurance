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
            echo json_encode(["status" => "success", "message" => "Ajout Réussit"]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function update_examen()
    {
        try {
            $id = $_POST['examenId'];
            $this->examen->update($id, $_POST);
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
            
            // $this->patient->update($_POST["id_examen"],["etat"=> 0]);
            $this->examen->delete($_POST["examenId"]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_examen()
    {
        try {          

            // $datas = ( $_POST["id_examen"] != ""  ) ? $this->patient->where("id_examen" , $_POST["id_examen"])->findAll() : [];
            $datas = $this->examen->findAll();

            $th = "
                <thead>
                    <th>#</th>
                    <th>Nom et prenom</th>
                    <th>Etablissement</th>
                    <th>Date Examen</th>
                    <th>Docteur</th>
                    <th>Lieu</th>
                    <th>Etat de Santé</th>
                    <th>action</th>
                </thead>
            ";

            $th .= "<tbody> ";

            $n = 1 ;

            foreach ($datas as $value_ar) {

                $btn = '                
                        <td style="width:10%">
                            <a class="primary edit mr-1" title = "Editer"
                             onclick="edit_examen('.$value_ar["ExamenId"].')"><i class="la la-edit"></i></a> 

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
                        <td style='width:20%'> ". $value_ar["villeExamen"]  ."</td>
                        <td style='width:20%'><span class='badge badge-info'> ". $value_ar["etatSanteConsidere"]  ."</td>
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
