<?php

// namespace App\Controllers;
namespace App\Controllers\patient;

use App\Controllers\BaseController;


class PatientCont extends BaseController
{
    public function index()
    {
       
            $content = view('patient/index');
            return view('layout',['content' => $content]);
   
      
    }
    public function lien()
    {
   
        return view('patient/index');
         
    }

    public function ajout_patient()
    {
        try {

            $id = $this->patient->save($_POST);

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_membre()
    {
        try {

            $data =  $this->membre->where("etat" ,  1 )->findAll();

            $membre = '<option value=""> </option> ';

                foreach ($data as $value) {
                    $membre .= '
                        <option value="' . $value['id_membre'] . '"> '. $value['nom_membre'] . '</option> ';
                }

            echo $membre;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    

    public function delete_patient()
    {
        try {
            
            $this->patient->update($_POST["id_patient"],["etat"=> 0]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_patient()
    {
        try {
            

            // $datas = ( $_POST["id_membre"] != ""  ) ? $this->patient->where("id_membre" , $_POST["id_membre"])->findAll() : [];
            $datas = [];


            $th = "
                <thead>
                <th>#</th>
                <th>Nom prenom</th>
                <th>Contact</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Service</th>
                <th>Sexe</th>
                <th>Etat</th>
                <th>action</th>
                </thead>
            ";

            $th .= "<tbody> ";

            $n = 1 ;

            foreach ($datas as $value_ar) {

                $ass = ($value_ar["etat"] == "Assure" ) ? "<span class ='text-success'>Assuré</span>" : "<span class ='text-danger'>Non assuré</span>" ;

                $btn = '
                
                        <td style="width:10%">

                             <a class="primary edit mr-1" title = "detail consultaion"
                             onclick="edit_membre('.$value_ar["id_membre"].')"><i class="la la-list"></i></a>
                             

                         </td>

                ';

                $th .= "
                    
                        <td style='width:10%'> ". $value_ar["numero_patient"] ."</td>
                        <td style='width:10%'> ". $value_ar["nom"] . " " .   $value_ar["prenom"] ."</td>
                        <td style='width:20%'> ". $value_ar["telephone"]  ."</td>
                        <td style='width:20%'> ". $value_ar["adresse"]  ."</td>
                        <td style='width:20%'> ". $value_ar["email"]  ."</td>
                        <td style='width:20%'> ". $value_ar["service"]  ."</td>
                        <td style='width:10%'> ". $value_ar["sexe"]  ."</td>
                        <td style='width:10%'> ". $ass  ."</td>
                         
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

}
