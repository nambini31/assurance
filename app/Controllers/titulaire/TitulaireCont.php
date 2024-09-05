<?php

// namespace App\Controllers;
namespace App\Controllers\Titulaire;

use App\Models\Membre\MembreModel;
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
            }
            
            $id = $this->titulaire->save($_POST);
            echo json_encode(["success" => true ]);
        } catch (\Throwable $th) {
            echo json_encode(["success" => false, "message" => $th->getMessage()]);
        }
    }


    /** update */
    public function update_titulaire(){
        try {
            // var_dump($_POST); die;
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
            } else {
                $_POST['photo'] = $_POST['photo']; 
            }
            $this->titulaire->update($_POST['titulaireId'], $_POST);
            // $id = $this->titulaire->save($_POST);
            echo json_encode(["success" => true ]);
        } catch (\Throwable $th) {
            echo json_encode(["success" => false, "message" => $th->getMessage()]);
        }
    }
    /*********************************** */
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
    
    

    public function delete_titulaire()
    {
        try {
            
            $this->titulaire->update($_POST["titulaireId"],["etat"=> 0]);
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
                    <th>Photo</th>
                    <th>Num Carte</th>
                    <th>Nom et Prénom</th>
                    <th>Genre</th>
                    <th>Telephone</th>
                    <th>Status</th>
                    <th>action</th>
                </thead>
            ";
            $th .= "<tbody> ";
            

            foreach ($datas as $value_ar) {

                //generation de numCarte
                if ($value_ar["membreId"] != null) {
                    $membreId = $value_ar["membreId"];
                    // $data = $this->membre->find($membreId);      
                    // $nomMembre = $this->membre->where('id_membre', $membreId)->value('nom_membre');

                    $nomMembre = $this->membre
                    ->select('nom_membre')
                    ->where('id_membre', $membreId)
                    ->get()
                    ->getRow()
                    ->nom_membre;

                    $numCart = $value_ar["titulaireId"];
                    $numCartGenere = $this->genererNumeroCarte($nomMembre, $numCart);
                }

                //affichage photo
                if (!empty($value_ar["photo"])) {
                    $photo = '<img src="' . base_url('assets/img/titulaire/' . $value_ar["photo"]) . '" alt="User Image" style="width: 60px; height: auto; clip-path:circle();">';
                }else {
                    $photo = 'Pas de Photo';
                }

                $btn = '                
                    <td style="width:10%">
                        <a class="primary edit mr-1" data-nom="'.$value_ar["nom"].'" 
                        id="titulaire_'.$value_ar["titulaireId"].'" onclick="editTitulaire('.$value_ar["titulaireId"].')"><i class="la la-pencil-square-o"></i></a>
                        <a class="danger delete mr-1" onclick="deleteTitulaire('.$value_ar["titulaireId"].')" ><i class="la la-trash-o"></i></a>
                    </td>
                ';
                $textAssuree = '<span class="badge badge-success" style="font-size:13px">Assuré</span>';
                if ($value_ar["isActif"] == "0") {
                    $textAssuree = '<span class="badge badge-danger" style="font-size:14px" >Non Assuré</span>';
                }
                $th .= "                    
                    <td style='width:10%'> ". $photo ."</td>
                    <td style='width:10%'> ". $numCartGenere ."</td>
                    <td style='width:20%'> ". $value_ar["nom"] ." ". $value_ar["prenom"] ."</td>
                    <td style='width:5%'> ". $value_ar["genre"]  ."</td>
                    <td style='width:10%'> ". $value_ar["telephone"]  ."</td>
                    <td style='width:10%'> ". $textAssuree  ."</td>
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

    //***** get By Id *****/
    public function getTitulaireById(){
        $TitulaireId = $_POST['titulaireId'];
        // $TitulaireId = 13;
        $selectedData = $this->titulaire->where("titulaireId" , $TitulaireId)->find();
        echo json_encode(["data" => $selectedData]);
    }
    /** ********************************/


    function genererNumeroCarte($nomMembre, $numeroCarte) {
        // Garder les trois premières lettres du nom en majuscules
        $prefixe = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $nomMembre), 0, 3));
        
        // Concaténer avec le numéro de carte (en s'assurant qu'il ait toujours deux chiffres)
        $numeroCarte = str_pad($numeroCarte, 2, '0', STR_PAD_LEFT);
        
        // Générer le numéro de carte complet
        $numCarte = $prefixe.'-'.$numeroCarte;
        
        return $numCarte;
    }
}
