<?php

// namespace App\Controllers;
namespace App\Controllers\Titulaire;

use App\Controllers\BaseController;


class TitulaireCont extends BaseController
{
    public function index()
    {
        $content = view('titulaire/index');
        return view('layout',['content' => $content]);
    }

    public function lien()
    {
        return view('titulaire/index');         
    }

    public function ajout_titulaire()
    {
        try {
            // Vérifiez si le fichier a été téléchargé sans erreur
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {

                $currentDate = date('YmdHis');
                $nom = $_POST['nom'];
                $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $namePhoto = $nom.'_'.$currentDate.'.'.$extension;

                // Définissez le chemin de destination
                $uploadDir = ROOTPATH . 'assets/img/titulaire/';
                $uploadFile = $uploadDir . $namePhoto;

                // Déplacez le fichier vers le répertoire de destination
                move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile);
                    
                $_POST['photo'] = $namePhoto;
                // $data['image'] = $namePhoto;

                // Définissez le chemin de destination
                // $uploadDir = 'uploads/';
                // $uploadFile = $uploadDir . basename($_FILES['photo']['name']);

                // Déplacez le fichier vers le répertoire de destination
                // if (!move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
                //     throw new Exception('Erreur lors du téléchargement du fichier.');
                // }

                // Ajoutez le chemin du fichier photo aux données POST
            }
            //  else {
            //     throw new Exception('Veuillez sélectionner un fichier.');
            // }
            
            $id = $this->titulaire->save($_POST);
            echo json_encode(["success" => true ]);
        } catch (\Throwable $th) {
            echo json_encode(["success" => false, "message" => $th->getMessage()]);
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

    //-- get All Titulaire -----
    public function listesTitulaire()
    {
        try {
            $datas = $this->titulaire
            ->where("etat" , 1)->findAll();
            $th = "
                <thead>
                    <th>Num Carte</th>
                    <th>Nom et Prénom</th>
                    <th>Genre</th>
                    <th>Telephone</th>
                    <th>Etat</th>
                    <th>action</th>
                </thead>
            ";
            $th .= "<tbody> ";

            foreach ($datas as $value_ar) {
                $btn = '                
                    <td style="width:10%">
                        <a class="primary edit mr-1" data-nom="'.$value_ar["nom"].'" 
                        id="titulaire_'.$value_ar["titulaireId"].'" onclick="editTitulaire('.$value_ar["titulaireId"].')"><i class="la la-pencil"></i></a>
                        <a class="danger delete mr-1" onclick="deleteTitulaire('.$value_ar["titulaireId"].')" ><i class="la la-trash-o"></i></a>
                    </td>
                ';
                $th .= "                    
                    <td style='width:10%'> ". $value_ar["numCarte"] ."</td>
                    <td style='width:10%'> ". $value_ar["nom"] ." ". $value_ar["prenom"] ."</td>
                    <td style='width:20%'> ". $value_ar["genre"]  ."</td>
                    <td style='width:20%'> ". $value_ar["telephone"]  ."</td>
                    <td style='width:20%'> ". $value_ar["isActif"]  ."</td>
                    $btn
                ";    
                $th .= "</tr>";
            }
            $th .= "</tbody> ";
            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    //-----------------------------------------------
}
