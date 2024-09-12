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

    /** Ajouter Titulaire */
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
    /** Fin Ajout Titulaire ****************************** */

    /** Ajouter Titulaire */
    public function ajout_enfant()
    {
        try {  
           $this->enfant->save($_POST);
            echo json_encode(["success" => true ]);
        } catch (\Throwable $th) {
            echo json_encode(["success" => false, "message" => $th->getMessage()]);
        }
    }
    /** Fin Ajout Titulaire ****************************** */


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

    /** Update Enfant */
    public function update_enfant(){
        try {
            $this->enfant->update($_POST['enfantId'], $_POST);
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

    /** Delete Enfant */
    public function delete_enfant()
    {
        try {
            
            $this->enfant->update($_POST["enfantId"],["etat"=> 0]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    /************************************************************** */


    //-- get All Titulaire -----
    public function listesTitulaire()
    {
        try {
            $datas = $this->titulaire
            ->where("etat" , 1)->orderBy("titulaireId", 'desc')->findAll();
            $th = "
                <thead>
                    <th>#</th>
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
            
            
            $n=0;
            foreach ($datas as $value_ar) {
                
                //generation de numCarte
                if ($value_ar["membreId"] != null) {
                    $membreId = $value_ar["membreId"];
                    
                    $nomMembre = $this->titulaire
                        // ->select('COALESCE(membre.nom_membre, "Membre inconnu") AS nom_membre')
                        ->join('membre', 'membre.id_membre = titulaire.membreId', 'left')
                        ->where('titulaire.membreId', $membreId)
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
                        <a title="Liste Famille" class="info mr-1" onclick="listeEnfant('.$value_ar["titulaireId"].')"><i class="la la-group"></i></a> 
                        <a title="Voir détail" class="info mr-1" onclick="detailTitulaire('.$value_ar["titulaireId"].')"><i class="la la-list"></i></a> 
                        <a title="Editer" class="primary edit mr-1" onclick="editTitulaire('.$value_ar["titulaireId"].')"><i class="la la-pencil"></i></a>
                        <a title ="Supprimer" class="danger delete mr-1" onclick="deleteTitulaire('.$value_ar["titulaireId"].')" ><i class="la la-trash-o"></i></a>
                    </td>
                ';
                $textAssuree = '<span class="badge badge-success" style="font-size:13px ; cursor: pointer;" onclick="nomAssure('.$value_ar["titulaireId"].')"><i class="ft-check"></i> Assuré</span>';
                if ($value_ar["isActif"] == "0") {
                    $textAssuree = '<span class="badge badge-danger" style="font-size:14px ; cursor: pointer;" onclick="assure('.$value_ar["titulaireId"].')" ><i class="la la-ban"></i> Non Assuré</span>';
                }
                $n++;
                $th .= "                    
                    <td style='width:10%'> ". $n ."</td>
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

    /** Listes des enfats d'un titulaire */
    public function listeEnfant(){
        $TitulaireId = $_POST['titulaireId'];
        $datas = $this->enfant->where("etat" , 1)->where("titulaireId" , $TitulaireId)->orderBy("enfantId", 'desc')->findAll();
 
        $th = "
            <thead>
                <th>#</th>
                <th>Nom et Prénom</th>
                <th>Fonction</th>
                <th>Genre</th>
                <th>Date Naiss</th>
                <th>Lien</th>
                <th>Motif</th>
                <th>Status</th>
                <th>action</th>
            </thead>
        ";
        $th .= "<tbody> ";
        
        
        $n=0;
        foreach ($datas as $value_ar) {

            $btn = '                
                <td style="width:10%">
                    <a title="Editer" class="primary edit mr-1" onclick="editerEnfant('.$value_ar["enfantId"].','.$value_ar["titulaireId"].')"><i class="la la-pencil"></i></a>
                    <a title ="Supprimer" class="danger delete mr-1" onclick="deleteEnfant('.$value_ar["enfantId"].','.$value_ar["titulaireId"].')" ><i class="la la-trash-o"></i></a>
                </td>
            ';
            $textAssuree = '<span class="badge badge-success" style="font-size:13px ; cursor: pointer;" onclick="nomAssureEnfant('.$value_ar["enfantId"].','.$value_ar["titulaireId"].')"><i class="ft-check"></i> Assuré</span>';
            if ($value_ar["isActif"] == "0") {
                $textAssuree = '<span class="badge badge-danger" style="font-size:14px ; cursor: pointer;" onclick="assureEnfant('.$value_ar["enfantId"].','.$value_ar["titulaireId"].')" ><i class="la la-ban"></i> Non Assuré</span>';
            }
            $n++;
            $th .= "<tr>
                <td style=''> ". $n ."</td>
                <td style=''> ". $value_ar["nom"] ." ". $value_ar["prenom"] ."</td>
                <td style=''> ". $value_ar["fonction"]  ."</td>
                <td style=''> ". $value_ar["genre"]  ."</td>
                <td style=''> ". $value_ar["dateNaiss"]  ."</td>
                <td style=''> ". $value_ar["typeEnfant"]  ."</td>
                <td style='width: 10px !important;'> ". $value_ar["motif"]  ."</td>
                <td style=''> ". $textAssuree  ."</td>
                $btn
            ";    
            $th .= "</tr>";
        }
        $th .= "</tbody> ";
        echo $th;
    }
    /******************************************************* */

    //***** get By Id *****/
    public function getTitulaireById(){
        $TitulaireId = $_POST['titulaireId'];
        // var_dump($selectedData[0]['membreId']); die;

        //generation de numCarte
        $selectedData = $this->titulaire->where("titulaireId" , $TitulaireId)->findAll();
        if ($selectedData[0]["membreId"] != "") {
            $membreId = $selectedData[0]["membreId"];
            $nomMembre = $this->titulaire
                        ->join('membre', 'membre.id_membre = titulaire.membreId', 'left')
                        ->where('titulaire.membreId', $membreId)
                        ->get()
                        ->getRow()
                        ->nom_membre;

            $numCartGenere = $this->genererNumeroCarte($nomMembre, $TitulaireId);
        }
        
        $photo = 'Pas de Photo';
        if (!empty($selectedData[0]["photo"])) {
            $photo = '<img src="' . base_url('assets/img/titulaire/' . $selectedData[0]["photo"]) . '" alt="User Image" style="width: 100%; height: auto; border-radius: 10px;">';
        }
        $selectedData["detailPhotoTitulaire"] = $photo;

        echo json_encode(["data" => $selectedData]);
    }
    /** ********************************/ 

    //** GEt Enfant By Id *****/
    public function getEnfantById(){
        $enfantId = $_POST['enfantId'];
        // var_dump($selectedData[0]['membreId']); die;

        //generation de numCarte
        $selectedData = $this->enfant->where("enfantId" , $enfantId)->find();        

        echo json_encode(["data" => $selectedData]);
    }
    /** ********************************/

    /****** Mettre non assuré */
    public function toNonAssure()
    {
        try { 
            $motif = "Non assuré de raison : ".$_POST["motifNonAssure"];
            $this->titulaire->update($_POST["titulaireId"], ["isActif"=> 0 , "motifNonAssure"=> $motif]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    /***************************************** */

    /****** Mettre non assuré  Enfant */
    public function toNonAssureEnfant()
    {
        try { 
            $motif = "Non assuré de raison : ".$_POST["motifNonAssureEnfant"];
            $this->enfant->update($_POST["enfantId"], ["isActif"=> 0 , "motif"=> $motif]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    /***************************************** */

    /****** Mettre non assuré */
    public function toAssure()
    {
        try {    
            $motif = "Redivient assuré de raison : ".$_POST["motifNonAssure"];
            $this->titulaire->update($_POST["titulaireId"], ["isActif"=> 1 , "motifNonAssure"=> $motif]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    /***************************************** */

    /****** Mettre non assuré Enfant */
    public function toAssureEnfant()
    {
        try {                                                
            $motif = "Redivient assuré de raison : ".$_POST["motifAssureEnfant"];
            $this->enfant->update($_POST["enfantId"], ["isActif"=> 1 , "motif"=> $motif]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    /***************************************** */


    function genererNumeroCarte($nomMembre, $numeroCarte) {
        // Garder les trois premières lettres du nom en majuscules
        $prefixe = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $nomMembre), 0, 3));
        
        // Concaténer avec le numéro de carte (en s'assurant qu'il ait toujours deux chiffres)
        $numeroCarte = str_pad($numeroCarte, 2, '0', STR_PAD_LEFT);
        
        // Générer le numéro de carte complet
        $numCarte = $prefixe.'-'.$numeroCarte;
        
        return $numCarte;
    }


    /** Imprimer carte */
    public function imprimerCarte1(){
        try {
            // Initialisation de mPDF
            $this->pdf->SetMargins(0, 0, 8, 0);
        
            $titulaireId= $_POST['titulaireId'];
            
            $selectedData = $this->titulaire->find($titulaireId);            

            // Génération du contenu HTML selectedExamen
            // var_dump($selectedData); die;
            $html = view('pdf/carteAffiliation/carteOmit', ["selectedData" => $selectedData]);
        
            // Configuration d'erreur
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        
            // Limite de mémoire
            ini_set('memory_limit', '256M');
        
            // Ajout du contenu HTML à mPDF
            $this->pdf->WriteHTML($html);
        
            // Définition du nom du fichier PDF
            $pdfFileName = 'Carte1_' . $selectedData['titulaireId'] .'_'.date("dmYhi"). '.pdf';
            $pdfFilePath = 'public/uploads/examen/' . $pdfFileName;
        
            // Vérification des permissions du dossier
            if (!is_writable(dirname($pdfFilePath))) {
                throw new \Exception('Le dossier n\'est pas accessible en écriture : ' . dirname($pdfFilePath));
            }
        
            // Enregistrement du fichier PDF
            $this->pdf->Output($pdfFilePath, "F");
        
            // Réponse JSON avec le chemin du fichier
            echo json_encode(['file' => base_url() . $pdfFilePath]);
        } catch (\Throwable $th) {
            // Gestion des exceptions
            echo 'Erreur: ' . $th->getMessage();
            error_log($th->getMessage()); // Enregistrer l'erreur dans les logs
        }        
    }

    /** Imprimer carte 2 */
    public function imprimerCarte2(){
        try {
            // Initialisation de mPDF
            $this->pdf->SetMargins(0, 0, 8, 0);
        
            $titulaireId= $_POST['titulaireId'];
            $selectedData = $this->titulaire->find($titulaireId);            

            // Génération du contenu HTML selectedExamen
            // var_dump($selectedData); die;
            $html = view('pdf/carteAffiliation/carteOmitVerso', ["selectedData" => $selectedData]);
        
            // Configuration d'erreur
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        
            // Limite de mémoire
            ini_set('memory_limit', '256M');
        
            // Ajout du contenu HTML à mPDF
            $this->pdf->WriteHTML($html);
        
            // Définition du nom du fichier PDF
            $pdfFileName = 'Carte2_' . $selectedData['titulaireId'] .'_'.date("dmYhi"). '.pdf';
            $pdfFilePath = 'public/uploads/examen/' . $pdfFileName;
        
            // Vérification des permissions du dossier
            if (!is_writable(dirname($pdfFilePath))) {
                throw new \Exception('Le dossier n\'est pas accessible en écriture : ' . dirname($pdfFilePath));
            }
        
            // Enregistrement du fichier PDF
            $this->pdf->Output($pdfFilePath, "F");
        
            // Réponse JSON avec le chemin du fichier
            echo json_encode(['file' => base_url() . $pdfFilePath]);
        } catch (\Throwable $th) {
            // Gestion des exceptions
            echo 'Erreur: ' . $th->getMessage();
            error_log($th->getMessage()); // Enregistrer l'erreur dans les logs
        }        
    }
}
