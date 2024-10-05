<?php

// namespace App\Controllers;
namespace App\Controllers\membre;

use App\Controllers\BaseController;


class MembreCont extends BaseController
{
    public function index()
    {
        if (in_array($_SESSION['roleId'], ["5" , "1"])){

            $content = view('membre/index');
            return view('layout',['content' => $content]);
            
        }else{
            echo view('Access/index');
                    exit();
        }
           
   
      
    }
    public function lien()
    {
   
        return view('membre/index');
         
    }

    public function ajout_membre()
    {
        try {

            $id = $this->membre->save($_POST);

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    

    public function delete_membre()
    {
        try {
            
            $this->membre->update($_POST["id_membre"],["etat"=> 0]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function bloque_membre()
    {
        try {
            
            $this->membre->update($_POST["id_membre"],["ispaye"=> 0 , "motifBloque"=> $_POST["motif_membre"]]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function debloque_membre()
    {
        try {
            
            $this->membre->update($_POST["id_membre"],["ispaye"=> 1]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function infos_membre()
    {
        try {
            
           $data = $this->membre->find($_POST["id_membre"]);


            echo json_encode($data);

        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_membre()
    {
        try {

            $datas = $this->membre
            ->where("etat" , 1)->findAll();

            $th = "
            <thead>
            <th>#</th>
            <th>Designation</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Description</th>
            <th>status</th>
            <th>action</th>
                </thead>
            ";

            $th .= "<tbody> ";

            $n = 1 ;

            foreach ($datas as $value_ar) {

            $class = ($value_ar["ispaye"] == false) ? ' class="leave-row" ' : '';

                $desactive = "";

                if ($value_ar["ispaye"] == true) {
                    
                    $desactive = '<a class="danger delete mr-1" onclick="bloque_membre('.$value_ar["id_membre"].')" ><i class="la la-ban"></i></a>';
                }else{
                    $desactive = '
                    <a class="success delete mr-1" onclick="debloque_membre('.$value_ar["id_membre"].')" ><i class="la la-check-circle"></i></a>
                    <a class="primary details mr-1" onclick="infos_membre('.$value_ar["id_membre"].')" ><i class="la la-info"></i></a>
                    ';

                }
 
                $btn = '
                
                        <td style="width:10%">

                             <a class="primary edit mr-1" 
                             data-nom_membre="'.$value_ar["nom_membre"].'"  
                             data-description ="'.$value_ar["description"].'"
                             data-contact_membre ="'.$value_ar["contact_membre"].'" 
                             data-email_membre ="'.$value_ar["email_membre"].'" 
                             id="mem_'.$value_ar["id_membre"].'" 
                             onclick="edit_membre('.$value_ar["id_membre"].')"><i class="la la-pencil-square-o"></i></a>
                             
                             <a class="danger delete mr-1" onclick="delete_membre('.$value_ar["id_membre"].')" ><i class="la la-trash-o"></i></a>

                         </td>

                ';



                $th .= "<tr ".$class.">
                    
                    <td style='width:10%'> ". $value_ar["id_membre"] ."</td>
                    <td style='width:10%'> ". $value_ar["nom_membre"] ."</td>
                    <td style='width:20%'> ". $value_ar["contact_membre"]  ."</td>
                    <td style='width:20%'> ". $value_ar["email_membre"]  ."</td>
                    <td style='width:20%'> ". $value_ar["description"]  ."</td>
                    <td style='width:10%'> $desactive  </td>
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
