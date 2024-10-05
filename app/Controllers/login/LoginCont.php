<?php

namespace App\Controllers\login;

use App\Controllers\BaseController;
use DateInterval;
use DateTime;
use Ifsnop\Mysqldump\Mysqldump;

class LoginCont extends BaseController
{
    public function index()
    {

        $this->authentifier();
    }
    public function deconnecter()
    {
        try {

            $designation = "Déconnecté";
            $dateheure = date("Y-m-d H:i:s");

            $data = [
                'designation_session' => $designation,
                'dateheure_session' => $dateheure,
                'id_user' => session()->get('id_user'),
            ];

            // $this->session_log->insert($data);


            $this->session->destroy();

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo json_encode(["id" => 0, "error" => $th->getMessage()]);
        }
    }

    public function authentifier()
    {
        try {

            if ($this->session !== null && $this->session->has('is_connected')) {

                $content = view('examen/index');
                echo view('layout', ['content' => $content]);
            } else {

                if ($_POST) {
                    $result = $this->connexion
                        ->select("role.name , utilisateur.*")
                        ->where('LOWER(prenom_user)', strtolower($_POST['prenom_user']))
                        ->join("role" , "role.roleId = utilisateur.roleId")
                        ->where('mdp_user', $_POST['mdp_user'])
                        ->where('etat', 1)
                        ->first();

                    if ($result) {

                        $_SESSION['is_connected'] = true;
                        $_SESSION['roleId'] = $result['roleId'];
                        $_SESSION['nom_user'] = $result['nom_user'];
                        $_SESSION['prenom_user'] = $result['prenom_user'];
                        $_SESSION['image_user'] = $result['image'];
                        $_SESSION['id_user'] = $result['id_user'];
                        $_SESSION['roleId'] = $result['roleId'];
                        $_SESSION['roleName'] = $result['name'];

                        if ($_SESSION['id_user']) {
                            $designation = "Connecté";
                            $dateheure = date("Y-m-d H:i:s");

                            $data = [
                                'designation_session' => $designation,
                                'dateheure_session' => $dateheure,
                                'id_user' => $_SESSION['id_user'],
                            ];

                            // $this->session_log->insert($data);
                        }

                        echo json_encode(["id" => 1]);
                        exit();
                    } else {

                        echo json_encode(["base_url" => base_url() . 'login', "id" => 2]);
                        exit();
                    }
                } else {

                    echo view('login/index');
                    exit();
                }
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function exportDatabase()
    {
        // Replace these values with your actual database details
        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'mifidy';

        // Replace this path with the desired location for the backup file
        $backupFilePath = 'uploads/backup/backup_' . date('Y-m-d_H-i-s') . '.sql';

        try {
            // Create a new instance of the Mysqldump class
            $dump = new Mysqldump("mysql:host={$dbHost};dbname={$dbName}", $dbUsername, $dbPassword);

            // Dump the database to the specified file
            $dump->start($backupFilePath);

            echo json_encode(['file' => base_url() . $backupFilePath]);
        } catch (\Exception $e) {
            echo "Error exporting database: " . $e->getMessage();
        }
    }



    public function recuperation_patient()
    {

        try {



            $url = 'http://192.168.28.193:8000/api_employe/listemploye';

            // Effectuer une requête GET à l'API
            $response = $this->clientApi->request('GET', $url);

            // Vérifier si la requête a réussi
            if ($response->getStatusCode() == 202) {
                // Récupérer le contenu de la réponse (généralement JSON)
                $data = $response->getBody();

                // Convertir les données JSON en tableau associatif
                $data = json_decode($data, true);
                
                
                foreach ($data as $value) {
                    
                    
                    $data = [
                        "nom" => $value["nom"],
                        "prenom" => $value["prenom"],
                        "numero_patient" => $value["id_employe"],
                        "adresse" => $value["adresse"],
                        "telephone" => $value["telephone"],
                        "email" => $value["email"],
                        "service" => $value["service"]["nom_service"],
                        "etat" => $value["etat_assurance"],
                        "id_membre" => $value["id_Entreprise"],
                    ];

                   
                    $verif = $this->patient->where("numero_patient", $value["id_employe"])->find();

                    if ($verif) {
                        
                        $this->patient->where("numero_patient", $value["id_employe"])->update( null ,$data);
                    }
                    else{
                        $this->patient->save($data);

                    }

                }

                echo json_encode(["status" => 200]) ;

            } else {
                // Gérer les erreurs de requête
                echo 'Erreur lors de la requête à l\'API: ' . $response->getStatusCode();
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function consultation_histo()
    {

        try {

                $datas = $this->consultation
                ->where('patient.etat', "Assure")
                ->where('patient.id_membre', 1)
                ->select("medecin.nom_medecin as medecin, CONCAT(patient.nom, ' ', patient.prenom) as nom , consultation.created_at as date , consultation.numero_patient as id_employe , consultation.motif ")
                ->join("medecin" , "medecin.id_medecin = consultation.id_medecin")
                ->join("patient" , "consultation.numero_patient = patient.numero_patient")
                ->join("membre" , "membre.id_membre = patient.id_membre")
                ->findAll();

                echo json_encode( $datas) ;

         
        } catch (\Throwable $th) {
            echo $th;
        }
    }

}
