<?php

// namespace App\Controllers;
namespace App\Controllers\membre;

use App\Controllers\BaseController;


class MembreCont extends BaseController
{
    public function index()
    {
       
            $content = view('membre/index');
            return view('layout',['content' => $content]);
   
      
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
            <th>action</th>
                </thead>
            ";

            $th .= "<tbody> ";

            $n = 1 ;

            foreach ($datas as $value_ar) {

                $btn = '
                
                        <td style="width:10%">

                             <a class="primary edit mr-1" data-nom_membre="'.$value_ar["nom_membre"].'" 
                             data-contact_membre ="'.$value_ar["contact_membre"].'" id="mem_'.$value_ar["id_membre"].'" onclick="edit_membre('.$value_ar["id_membre"].')"><i class="la la-pencil"></i></a>
                             <a class="danger delete mr-1" onclick="delete_membre('.$value_ar["id_membre"].')" ><i class="la la-trash-o"></i></a>

                         </td>

                ';


                $th .= "
                    
                    <td style='width:10%'> ". $value_ar["id_membre"] ."</td>
                    <td style='width:10%'> ". $value_ar["nom_membre"] ."</td>
                    <td style='width:20%'> ". $value_ar["contact_membre"]  ."</td>
                    <td style='width:20%'> ". $value_ar["email_membre"]  ."</td>
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
