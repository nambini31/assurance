<?php

namespace App\Controllers\fournisseur;

use App\Controllers\BaseController;

class FournisseurCont extends BaseController
{

    public function lien(): string
    {
            return view('fournisseur/index');
        
    }

    public function index()
    {
        
            $content = view('fournisseur/index');
            return view('layout', ['content' => $content]);
       
    }


    
    

    public function generation_categorie_dynamique()
    {
        try {

            $data = $this->categorie->where('etat',1)->findAll();

            $categorie_html = '';

            foreach ($data as  $value) {

                $categorie_html .= '
                    <option value="' . $value['id_categorie'] . '"> '. $value['designation'] . '</option> ';
            }

            echo $categorie_html;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function ajout_fournisseur()
    {
        try {

            $id = $_POST['id_fournisseur'];
            $designation = $_POST['designation'];
            $email = $_POST['email'];
            $adresse = $_POST['adresse'];
            $telephone = $_POST['telephone'];

            

           
                    $this->fournisseur->save($_POST);
                    echo json_encode(['status' => 'success']);
                    
            
            // $id = $this->fournisseur->save($_POST);

            // echo json_encode(["id" => $id]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    

    public function delete_fournisseur()
    {
        try {

            
            $this->fournisseur->update($_POST["id_fournisseur"],["etat"=> 0]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_fournisseur()
    {
        try {


            $data_fournisseur = $this->fournisseur->where('etat',1)->findAll();


            $th = "
                <thead>
                  <tr >
                    <th style='text-align: center;'>id</th>
                    <th style='text-align: center;'>Désignation</th>
                    <th style='text-align: center;'>Email</th>
                    <th style='text-align: center;'>Téléphone</th>
                    <th style='text-align: center;'>Adresse</th>

                    " ;
                       $th .= "<th style='text-align: center;'>Actions</th>";

               $th .= "</tr></thead> ";

            $th .= "<tbody> ";

            foreach ($data_fournisseur as $value_ar) {

                
                $th .= "<tr> ";

                $th .= "
                    
                    <td style='width:10%'> ".$value_ar["id_fournisseur"] ."</td>
                    <td style='width:20%'> ".$value_ar["designation"] ."</td>
                    <td style='width:10%'> ".$value_ar["email"] ."</td>
                    <td style='width:10%'> ".$value_ar["telephone"] ."</td>
                    <td style='width:10%'> ".$value_ar["adresse"] ."</td>

                ";

                $pu_tot = 0.0;

                
                
                

                    $th .= '<td style="width:10%">

                             <a class="primary edit mr-1" data-id="'.$value_ar["id_fournisseur"].'" data-designation="'.$value_ar["designation"].'" 
                             data-email="'.$value_ar["email"].'" data-telephone="'.$value_ar["telephone"].'" data-adresse="'.$value_ar["adresse"].'"
                             id="art_'.$value_ar["id_fournisseur"].'" onclick="edit_fournisseur('.$value_ar["id_fournisseur"].')"><i class="la la-pencil"></i></a>

                             <a class="danger delete mr-1" onclick="delete_fournisseur('.$value_ar["id_fournisseur"].')" ><i class="la la-trash-o"></i></a>

                         </td>' ;
                

                $th .= "</tr>";
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    //----- FOURNISSEUR DROPDONW ------
    public function generation_dropdown_fournisseur(){
        try {

            $data = $this->fournisseur->where('etat',1)->findAll();

            $dropdown_fournisseur = '';

            foreach ($data as  $value) {

                $dropdown_fournisseur .= '
                    <option value="' . $value['id_fournisseur'] . '"> '. $value['designation'] . '</option> ';
            }

            echo $dropdown_fournisseur;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    //-------------------------------------------------

    public function mise_a_jour_fournisseur()
    {
        return view('menuiserie/article/mise_a_jour_article');
    }
}