<?php

namespace App\Controllers\consultation;

use App\Controllers\BaseController;

class ConsultationCont extends BaseController
{
    public function index()
    {
        if (in_array($_SESSION['roleId'], ["5" , "3" , "4" , "1" , "2" , "6" , "8" , "9"])){

            $content = view('consultation/index');
            return view('layout', ['content' => $content]);
        }else{
            echo view('Access/index');
                    exit();
        }

       
    }
    public function lien()
    {
        return view('consultation/index');
    }


    public function ajout_consultation()
    {
        try {

            
            $_POST["id_user"] = $this->session->get("id_user");

            $this->consultation->save($_POST);
            
            // Vérification si l'ID est présent dans $_POST (mise à jour)
            if (isset($_POST['consultationId']) && $_POST['consultationId'] != "" ) {
                $consultationId = $_POST['consultationId']; // ID de la consultation mise à jour
            } else {
                // Sinon, c'est une nouvelle insertion, on récupère l'ID inséré
                $consultationId = $this->consultation->insertID();

            }

            $consul = $this->consultation->find( $consultationId);


            echo json_encode($consul);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function ajout_patient()
    {
        try {

            
            $data = explode("_",$_POST["personne"]);
            $_POST["idPersonneMalade"] = $data[0];
            $_POST["TypepersonneMalade"] = $data[1];

            $this->detailconsultation->save($_POST);

            echo json_encode(["id" => 1]);

        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function delete_consultation()
    {
        try {

            $id = $_POST['id_consultation'];
            $this->consultation->update($id, ['etat' => 0]);

            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    public function envoyer_docteur()
    {
        try {

            $id = $_POST['id_consultation'];

            if ($_POST["isFinished"] == 0) {
                $this->consultation->update($id, ['isFinished' => 1]);
                $this->detailconsultation->where("consultationId" , $id)->update(null, ['isFinished' => 1]);
            }
            else if ($_POST["isFinished"] == 1) {

                $data = $this->detailconsultation->where("consultationId" , $id)->where('isFinished' , 2)->findAll();

                if ($data) {
                    
                    $this->consultation->update($id, ['isFinished' => 2]);
                    $this->detailconsultation->where("consultationId" , $id)->where("isPharmacie" , 1)->update(null, ['isFinished' => 2]);
                    
                }else{
                    
                    $this->consultation->update($id, ['isFinished' => 3]);
                    $this->detailconsultation->where("consultationId" , $id)->where("isFinished" , 1)->update(null, ['isFinished' => 3]);
                }


            }
            else if ($_POST["isFinished"] == 2) {
                $this->consultation->update($id, ['isFinished' => 3]);
                $this->detailconsultation->where("consultationId" , $id)->update(null, ['isFinished' => 3]);
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    public function delete_labo()
    {
        try {

            $this->envoieLbo->update($_POST['id_labo'], ['etat' => 0]);
            $this->detailconsultation->update( $_POST['iddetail'] , ["isLabo" => 0]);

            
            $id = $_POST['id'];

            $this->verif_visite($id) ;
            

            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            var_dump($th);die;
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
    public function delete_detailconsul()
    {
        try {

            $id = $_POST['id'];
            $this->detailconsultation->update($id, ['etat' => 0]);

            $id1 = $_POST["idConsul"] ;

            $this->verif_visite($id1) ;
            

            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            var_dump($th);die;
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function charge_type_analyse()
    {
        try {

            $data =  $this->type_analyse->where("etat" ,  1 )->findAll();

            $specialite = '';

                foreach ($data as $value) {
                    $specialite .= '
                        <option value="' . $value['id_specialite'] . '"> '. $value['nom_specialite'] . '</option> ';
                }

            echo $specialite;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function affiche_parametre()
    {
        try {

            $value =  $this->detailconsultation->find( $_POST["id"]);

            $th = "";

                $th =
                    '
                    <div class="row">
                        <div class="col-md-6">
                                    <table id="table_parametre_vrai1" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto; margin:auto">
                                    <thead> 
                                    <tr>
                                    <th>.</th>
                                    <td>.</td>
                                </tr> <thead>
                                    
                                    <tbody> 
                                    <tr>
                                    <th style="min-width: 100px !important; width: 100%">Temperature ( °C )</th>
                                    <td style="min-width: 100px !important; width: 100%"><input type="text" value="'.$value["temperature"].'" class="form-control input-sm"  name="temperature" id="temperature"></td>
                                </tr>
                                <tr>
                                    <th>Tension</th>
                                    <td><input type="text" value="'.$value["tension"].'" class="form-control input-sm"  name="tension" id="tension"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>Taille ( Mètre ) </th>
                                    <td><input type="text" value="'.$value["taille"].'" class="form-control input-sm"  name="taille" id="taille"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>Frequence Respiratoire</th>
                                    <td><input type="text" value="'.$value["frequenceRespiratoire"].'" class="form-control input-sm"  name="frequenceRespiratoire" id="frequenceRespiratoire"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>Frequence Cardiaque</th>
                                    <td><input type="text" value="'.$value["frequenceCardiaque"].'" class="form-control input-sm"  name="frequenceCardiaque" id="frequenceCardiaque"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>Etat Conscience</th>
                                    <td><input type="text" value="'.$value["etatConscience"].'" class="form-control input-sm"  name="etatConscience" id="etatConscience"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>SF</th>
                                    <td><input type="text" value="'.$value["sf"].'" class="form-control input-sm"  name="sf" id="sf"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>Bilan Hydrique</th>
                                    <td><input type="text" value="'.$value["bilanHydrique"].'" class="form-control input-sm"  name="bilanHydrique" id="bilanHydrique"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>Pupille</th>
                                    <td><input type="text" value="'.$value["pupille"].'" class="form-control input-sm"  name="pupille" id="pupille"> </td>
                                    
                                </tr>
                                </tbody>


                                

                                    </table></div>

                                    <div class="col-md-6">
                    
                                <table id="table_parametre_vrai2" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto; margin:auto">
                                <thead> 
                                <tr>
                                <th>.</th>
                                <td>.</td>
                            </tr> <thead>
                                
                                <tbody> 
                                <tr>
                                <th style="min-width: 100px !important; width: 100%">Peek Flow</th>
                                <td style="min-width: 100px !important; width: 100%"><input type="text" value="'.$value["peekFlow"].'" class="form-control input-sm"  name="peekFlow" id="peekFlow"> </td>
                                
                            </tr>
                            <tr>
                                <th>Glicemie</th>
                                <td ><input type="text" value="'.$value["glicemie"].'" class="form-control input-sm"  name="glicemie" id="glicemie"> </td>
                                
                            </tr>
                            <tr>
                                <th>Conjonctives</th>
                                <td><input type="text" value="'.$value["conjonctives"].'" class="form-control input-sm"  name="conjonctives" id="conjonctives"> </td>
                                
                            </tr>
                            <tr>
                                <th>Perimetre Bras</th>
                                <td><input type="text" value="'.$value["perimetreBras"].'" class="form-control input-sm"  name="perimetreBras" id="perimetreBras"> </td>
                                
                            </tr>
                            <tr>
                                <th>Perimetre Crane</th>
                                <td><input type="text" value="'.$value["perimetreCrane"].'" class="form-control input-sm"  name="perimetreCrane" id="perimetreCrane"> </td>
                                
                            </tr>
                            <tr>
                                <th>GCS</th>
                                <td><input type="text" value="'.$value["gcs"].'" class="form-control input-sm"  name="gcs" id="gcs"> </td>
                                
                            </tr>
                            <tr>
                                <th>EVS</th>
                                <td><input type="text" value="'.$value["evs"].'" class="form-control input-sm"  name="evs" id="evs"> </td>
                                
                            </tr>
                            <tr>
                                <th>Diurese</th>
                                <td><input type="text" value="'.$value["diurese"].'" class="form-control input-sm"  name="diurese" id="diurese"> </td>
                                
                            </tr>
                            <tr>
                                <th>Douleur</th>
                                <td><input type="text" value="'.$value["douleur"].'" class="form-control input-sm"  name="douleur" id="douleur"> </td>
                                
                            </tr>
                            <tr>
                                <th>Poids ( KG )</th>
                                <td><input type="text" value="'.$value["poids"].'" class="form-control input-sm"  name="poids" id="poids"></td>
                                

                                </tr>
                            </tbody>
                                </table>
                    
                    </div>
                                
                    </div>
                 ';


            echo json_encode(["table"=> $th]);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function affiche_clinique()
    {
        try {

            $value =  $this->detailconsultation->find( $_POST["id"]);

            $th = "";

                $th =
                    '  <thead> 
                                            <tr>
                                                <th style="width: 100em !important; min-width: 300px !important;">Histoire de la maladie</th>
                                                <th style="width: 100em !important; min-width: 300px !important;">Chirurgies</th>
                                            </tr> 
                                                
                                        <thead>
                                    
                                        <tbody> 
                                   
                                <tr>
                                    <td><textarea name="histoMaladie"  class="form-control input-sm" cols="5" rows="5" placeholder="Histoire de la maladie">'.$value["histoMaladie"].'</textarea>
                                    </td>
                                    <td><textarea name="chirurgie"  class="form-control input-sm" cols="5" rows="5" placeholder="Chirurgies">'.$value["chirurgie"].'</textarea>
                                    </td>
                                    
                                </tr>

                                <tr>
                                <th >Examen cliniques</th>
                                <th >Alergies</th>
                                
                                </tr>
                                <tr>
                                    <td ><textarea name="examClinique"  class="form-control input-sm" cols="5" rows="5" placeholder="Examen cliniques">'.$value["examClinique"].'</textarea>
                                    </td>
                                    <td><textarea name="alergie"  class="form-control input-sm" cols="5" rows="5" placeholder="Alergies">'.$value["alergie"].'</textarea>
                                    </td>
                                    
                                </tr>
                                
                                </tbody>
                   
                 ';


            echo json_encode(["table"=> $th]);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getSpecialiteMedecin()
    {
        try {

            $data =  $this->typeMedecin->findAll();

            $type = '';
                foreach ($data as $value) {
                    $type .= '
                        <option value="' . $value['idTypeMedecin'] . '"> '. $value['name'] . '</option> ';
                }
            echo $type;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getDocteurSelonType(){
        try {

            $data =  $this->utilisateur
            ->where("idTypeMedecin", $_POST["id"])
            ->where("etat", 1)
            ->findAll();

            $listeDocteur = '';
            foreach ($data as $value) {
                $listeDocteur .= '
                    <option value="' . $value['id_user'] .'"> '. $value['nom_user'] .' '. $value['prenom_user'] . '</option> ';
            }
            echo $listeDocteur;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function add_parametre()
    {
        try {
            $_POST["dateParametre"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update( $_POST["idDetailsCons"] , $_POST);

            echo json_encode($data);

        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function add_clinique()
    {
        try {
            $_POST["dateDocteur"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update( $_POST["idDetailsCons"] , $_POST);

            echo json_encode($data);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function add_Examen()
    {
        try {
            $date = date("Y-m-d H:i:s") ;
            $_POST["natureExamen"] = implode(",",$_POST["nature"]);
            $_POST["dateParametre"] = $date;
            $_POST["isLabo"] = 1;
            $data =  $this->detailconsultation->update( $_POST["idDetails"] , $_POST);

            $envoie = [

                "Source" => $this->session->get("roleName"),
                "dateEnvoie" => $date,
                "typeEnvoie" => "visite",
                "idType" => $_POST["idDetails"],
                "id_user" => $this->session->get("id_user"),
                "natureExamen" =>$_POST["natureExamen"],
                "rc" =>$_POST["rc"],
                "resultats" =>$_POST["resultats"],
                "idenvoie_labo" =>$_POST["idenvoie_labo"]

            ];

            $this->envoieLbo->save($envoie);

            $data =  $this->consultation->update($_POST["idConsPour"] , ["isLabo" => 1]);

            echo json_encode($data);

        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_titulaire()
    {
        try {

            $data =  $this->titulaire
            ->select(" titulaire.titulaireId , CONCAT(titulaire.nom, ' ', titulaire.prenom) AS full_name, membre.nom_membre")
            ->where("titulaire.etat", '1')
            ->where("titulaire.isActif", '1')
            ->where("titulaire.membreId", $_POST["id_membre"])
            ->join("membre", "membre.id_membre = titulaire.membreId")
            ->findAll();

            $cabinet = '';
                foreach ($data as $value) {
                    $cabinet .= '
                        <option value="' . $value['titulaireId'] . '"> '. $this->genererNumeroCarte($value["nom_membre"], $value["titulaireId"])  ." ". $value['full_name'] . '</option> ';
                }

            echo $cabinet;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function charge_analyse()
    {
        try {
            $patient = '';

            if ($this->session->get("roleId") == "3") {
                
                $data =  $this->analyse
                ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                ->where("analyse.etat" ,  '1' )->like("role_user" , "3")->groupBy("id_type_analyse")
                ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse");
                $data = $data->findAll();

                foreach ($data as $value) {
                    $datas =  $this->analyse
                    ->where("etat" ,  '1' )
                    ->where("type_analyse" ,  $value["id_type_analyse"] )
                    ->like("role_user" , "3")
                    ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";

                    
                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['type_analyse'] . '"> '. $values['analyse'] . '</option> ';
                    }
                    
                    $patient .= `</optgroup>`;
                }

            }elseif ($this->session->get("roleId") == "4") {
                $data =  $this->analyse
                ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                ->where("analyse.etat" ,  '1' )->like("role_user" , "4")
                ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse")
                ->groupBy("id_type_analyse");
                $data = $data->findAll();

                
                foreach ($data as $value) {
                    $datas =  $this->analyse
                    ->where("etat" ,  '1' )
                    ->where("type_analyse" ,  $value["id_type_analyse"] )
                    ->like("role_user" , "4")
                    ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";

                    
                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['type_analyse'] . '"> '. $values['analyse'] . '</option> ';
                    }
                    
                    $patient .= `</optgroup>`;
                }
            
            }elseif ($this->session->get("roleId") == "8") {
                $data =  $this->analyse
                ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                ->where("analyse.etat" ,  '1' )->like("role_user" , "8")
                ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse")
                ->groupBy("id_type_analyse");
                $data = $data->findAll();

                
                foreach ($data as $value) {
                    $datas =  $this->analyse
                    ->where("etat" ,  '1' )
                    ->where("type_analyse" ,  $value["id_type_analyse"] )
                    ->like("role_user" , "8")
                    ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";

                    
                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['type_analyse'] . '"> '. $values['analyse'] . '</option> ';
                    }
                    
                    $patient .= `</optgroup>`;
                }
            }
            elseif ($this->session->get("roleId") == "5") {
                $data =  $this->type_analyse
                ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                ->where("etat" ,  '1' )->groupBy("id_type_analyse");
                $data = $data->findAll();

                foreach ($data as $value) {
                    $datas =  $this->analyse
                    ->where("etat" ,  '1' )
                    ->where("type_analyse" ,  $value["id_type_analyse"] )
                    ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";

                    
                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['id_analyse'] . '"> '. $values['analyse'] . '</option> ';
                    }
                    
                    $patient .= `</optgroup>`;
                }

            }
            

            
        
            echo $patient;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_personne_malade()
    {
        try {
            $patient = '';


                $data =  $this->titulaire
                ->select("CONCAT(titulaire.nom,' ' ,titulaire.prenom) as nom_titulaire , titulaire.titulaireId , nomPrenomConjoint , CONCAT(enfant.nom , ' ' ,enfant.prenom) as nom_enfant , enfant.typeEnfant , enfant.enfantId")
                ->where("titulaire.titulaireId" , $_POST["id"]) 
                ->join("enfant", "enfant.titulaireId = titulaire.titulaireId" , "left");
                $data = $data->findAll();

                // 0 : enfant , 1 : parent , 2 : titulaire , 3 : conjoint
                foreach ($data as $value) {
                    $patient .= "<optgroup label= 'Titulaire'>";

                    $patient .= '<option value="' . $value['titulaireId'] . '_Titulaire">'. $value['nom_titulaire'] . '</option> ';
                    $patient .= `</optgroup>`;

                    $patient .= "<optgroup label= 'Conjoint(e)'>";

                    $patient .= '<option value="' . $value['titulaireId'] . '_Conjoint(e)">'. $value['nomPrenomConjoint'] . '</option> ';
                    $patient .= `</optgroup>`;
                    break ;
                }

                $patient .= "<optgroup label= 'Enfant'>";

                foreach ($data as $value) {

                    if ($value["typeEnfant"] == "0") {
                        
                        $patient .= '<option value="' . $value['enfantId'] . '_Enfant">'. $value['nom_enfant'] . '</option> ';
                    }
                    
                }

                $patient .= `</optgroup>`;

                $patient .= "<optgroup label= 'Parent'>";

                foreach ($data as $value) {

                    if ($value["typeEnfant"] == "1") {
                        
                        $patient .= '<option value="' . $value['enfantId'] . '_Parent">'. $value['nom_enfant'] . '</option> ';
                    }
                    
                }

                $patient .= `</optgroup>`;

        
            echo $patient;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function liste_consultation()
    {
        try {
            $datas = $this->consultation ;
            
            if ($_POST["id_membre"] != "" ) {
                
                $datas =  $datas
            ->where('consultation.etat', 1)
            ->select(" membre.id_membre , membre.nom_membre , titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
            ->join("utilisateur" , "utilisateur.id_user = consultation.docteurId")
            ->join("titulaire" , "consultation.titulaireId = titulaire.titulaireId")
            ->join("typeconsultation" , "consultation.typeConsultationId = typeconsultation.idtypeconsultation")
            ->join("membre" , "membre.id_membre = titulaire.membreId")
            ->where('membre.id_membre', $_POST["id_membre"] ) ;

            }else{


                $datas =  $datas
            ->where('consultation.etat', 1)
            ->select(" membre.id_membre , membre.nom_membre , CONCAT(UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS code ,titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
            ->join("utilisateur" , "utilisateur.id_user = consultation.docteurId")
            ->join("titulaire" , "consultation.titulaireId = titulaire.titulaireId")
            ->join("typeconsultation" , "consultation.typeConsultationId = typeconsultation.idtypeconsultation")
            ->join("membre" , "membre.id_membre = titulaire.membreId") ;

            }

            if ($_POST["date_debut"] != "" ) {
                
                $datas = $datas
                ->where("date(consultation.createdAt) >= ", $_POST["date_debut"] );

            }
            if ( $_POST["date_fin"] != "") {
                
                $datas = $datas
                ->where("date(consultation.createdAt) <= ", $_POST["date_fin"] );

            }

            $datas = $datas->findAll();

             // $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];
            $ctegorie =  $datas ;


            $th = "
                    <thead>
                      <tr>
                            <th>Carte N°</th>
                            <th>Titulaire</th>
                            <th>Docteur</th>
                            <th>Type</th>
                            <th>Nbr Patient</th>
                            <th>Date</th>
                            <th>user</th>
                            <th>Etat</th> " ;
                       
                            $th .= "<th>Action</th>";

                    
                       $th .= "</tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {


                if (in_array($_SESSION['roleId'], ["6"])) {
                    
                    if($value["isLabo"] != '1'){
                    
                        continue ;
                        
                    
                    }

                }

                if (in_array($_SESSION['roleId'], ["3" , "4"])) {
                    
                    if($value["isFinished"] != '0'){
                    
                        continue ;
                        
                    
                    }

                }

                if (in_array($_SESSION['roleId'], ["8"])) {
                    
                    if($value["isFinished"] != '1'){
                    
                        continue ;
                        
                    
                    }

                }

                if (in_array($_SESSION['roleId'], ["9"])) {
                    
                    if($value["isFinished"] != '2'){
                    
                        continue ;
                        
                    
                    }

                }


                $action = '' ;

                if ( in_array($_SESSION['roleId'], ["1" , "5" , "2"])) {
                
                    $action .= '
                    <a class="info mr-1"  onclick="edit_consultation(' . $value["consultationId"] . ' , ' . $value["id_membre"] . ' , ' . $value["titulaireId"] . ' , ' . $value["docteurId"] . ' , ' . $value["typeConsultationId"] . ')"><i class=" la la-pencil-square-o"></i></a>

                    <a class="danger mr-1" onclick="supprimerconsultation(' . $value["consultationId"] . ')"><i class=" la la-trash-o"></i></a> ' ;

                    if (in_array($_SESSION['roleId'], ["1", "2"])) {
                        
                        if ($value["isFinished"] == 0 && ( $value["isLabo"] == 0 || $value["isLabo"] == "" )) {
                            $action = $action;
                        }
                        else{
                            $action = "";
                        }
    
                    }
                   
                }

                if ( $value["isFinished"] == 0 ) {

                    $etat = "En attente parametre";

                    if ($value["isLabo"] == 1) {

                        $etat = "En attente d'analyse ( Param )";

                    }
                    

                }
                else if(  $value["isFinished"] == 1){
                    
                    $etat = "En attente docteur";

                    if ($value["isLabo"] == 1) {

                        $etat = "En attente d'analyse ( Doc )";

                    }

    
                }
                else if(  $value["isFinished"] == 2){
                    
                    $etat = "En attente pharmacie";

                    if ($value["isLabo"] == 1) {

                        $etat = "En attente d'analyse ( pharm )";

                    }

    
                }
                
                else if(  $value["isFinished"] == 3){
                    
                    $etat = "Termine";
    
                }

                $count = $this->detailconsultation
                ->where('detailconsultation.consultationId', $value["consultationId"])
                ->where('detailconsultation.titulaireId', $value["titulaireId"])
                ->where("etat" , 1)
                ->countAllResults();

                $datas =  $this->consultation
            ->select("utilisateur.nom_user , utilisateur.prenom_user")
            ->join("utilisateur" , "utilisateur.id_user = consultation.id_user" , "left")
            ->where('consultationId', $value["consultationId"] )->first() ;



                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $this->genererNumeroCarte($value["nom_membre"], $value["titulaireId"]) . ' </td>
                        <td style="width : 20%;">' . $value["nom"] ." ". $value["prenom"] . ' </td>
                        <td style="width : 20%;">' . $value["nom_user"] ." ". $value["prenom_user"] . ' </td>
                        <td style="width : 15%;">' . $value["designtypeconsultation"] . ' </td>
                        <td style="width : 10%;">' . $count . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 
                        <td style="width : 10%;">' . $datas["nom_user"] ." ". $datas["prenom_user"] . '</td>  
                        <td style="width : 10%;">' . $etat . '</td>  
                        <td style="width : 10%;"> 
                            <a class="info mr-1"  onclick="liste_patient( ' . $value["consultationId"] . ' ,' . $value["isFinished"] . ')"><i class=" la la-list"></i></a> '.$action ;
                        
                       $th .= '</td> </tr>';
            }

            $th .= "</tbody> ";

            $response = [
                'roleId' => $this->session->get("roleId"),
                'table' => $th,

            ];
            
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    

    public function listes_patient_malade()
    {
        try {

            
            $datas = $this->detailconsultation
            ->select("
            case 
            when detailconsultation.TypepersonneMalade = 'Titulaire' then CONCAT(titulaire.nom, ' ', titulaire.prenom)
            when detailconsultation.TypepersonneMalade = 'Conjoint(e)' then titulaire.nomprenomconjoint
            ELSE CONCAT(enfant.nom, ' ', enfant.prenom)
            END AS nom ,

            case 
            when detailconsultation.TypepersonneMalade = 'Titulaire' then titulaire.genre
            when detailconsultation.TypepersonneMalade = 'Conjoint(e)' then titulaire.genreconjoint
            ELSE enfant.genre
            END AS genre 
            
            , detailconsultation.*")
            ->join("titulaire", "titulaire.titulaireId = detailconsultation.idPersonneMalade", "left")
            ->join("enfant", "enfant.enfantId = detailconsultation.idPersonneMalade", "left")
            ->join("consultation" ,"detailconsultation.titulaireId = consultation.titulaireId")
            ->where('detailconsultation.consultationId', $_POST["idconsultation"] )
            ->where('consultation.consultationId', $_POST["idconsultation"] )
            ->where("detailconsultation.etat" , 1)
            ->findAll();

            $doc = "";
            if (in_array($_SESSION['roleId'], ["5", "8" , "9"])){

                $doc = "<th>Parametrage</th><th>Docteur</th>" ;

            }

          
            if (in_array($_SESSION['roleId'], ["1","2", "3", "4"])){

                $doc = "<th>Parametrage</th>" ;

            }

            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Nom - Prenom</th>
                            <th>Genre</th>
                            <th>Type</th>
                            <th>Motif</th>
                            <th>Creation</th>
                            {$doc}
                            <th>Etat</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";
            $i = 1 ;
            foreach ($datas as $value) {

                if (in_array($_SESSION['roleId'], ["6"])) {
                    
                    if($value["isLabo"] != '1'){
                    
                        $i ++ ;
                        continue ;
                        
                    
                    }

                }

                if (in_array($_SESSION['roleId'], ["8"])) {
                    
                    if($value["isFinished"] != '1'){
                    
                        $i ++ ;
                        continue ;
                        
                    
                    }

                }

                if (in_array($_SESSION['roleId'], ["3" , "4"])) {
                    
                    if($value["isFinished"] != '0'){
                    
                        $i ++ ;
                        continue ;
                        
                    
                    }

                }

                if (in_array($_SESSION['roleId'], ["9"])) {
                    
                    if($value["isFinished"] != '2'){
                    
                        $i ++ ;
                        continue ;
                        
                    
                    }

                }


                if ($value["isFinished"] == '0') {
                    
                    $etat = 'En attente paramétre';
                    
                    if($value["isLabo"] == '1'){
                        
                        
                        $etat = "En attente d'analyse";
                        
                    
                    }
                    
                }else if($value["isFinished"] == '1'){
                    
                   
                    $etat = 'En attente docteur';

                    if ($value["isLabo"] == 1) {

                        $etat = "En attente d'analyse";

                    }
                    if ($value["isPharmacie"] == 1) {

                        $etat = "En attente pharmacie";

                    }
                    
            
                }
                else if($value["isFinished"] == '2'){
                    
                   
                    $etat = 'En attente pharmacie';

                    if ($value["isLabo"] == 1) {

                        $etat = "En attente d'analyse";

                    }
                    
            
                }
                else if($value["isFinished"] == '3'){
                    
                    $etat = "Termine";
                    
                }else{
                    $etat = 'En attente pharmacie';
                }
                

                $param = '';
                $detail = '<a class="success mr-1"  onclick="affichage_demande(' . $value["detailConsultationId"] . ')"><i class=" la la-list"></i></a>';
                $medic = '<a class="danger mr-1" onclick="medic_docteur(' . $value["detailConsultationId"] . ')" ><i class="las la-briefcase-medical la-2x"></i></a>';
                $print = '<a class="danger mr-1"  "><i class="las la-print la-2x"></i></a>';
                $labo = '<a class="info mr-1"   onclick="laboratoire(' . $value["detailConsultationId"] . ',' . $value["isFinished"] . ')"><i class=" la la-microscope"></i></a>';
                $delEdit = '<a class="info mr-1" id="nat'.$value["detailConsultationId"].'" data-motif= "'.$value["motif"].'" data-personne='.json_encode(implode('_', [ $value["idPersonneMalade"] ,$value["TypepersonneMalade"] ])).' onclick="edit_patient(' . $value["detailConsultationId"] . ')"><i class=" la la-pencil-square-o"></i></a>
                <a class="danger mr-1" onclick="delete_detailvisite(' . $value["detailConsultationId"] . ')"><i class=" la la-trash-o"></i></a> ' ;

                
                $action = '';
               

                if (in_array($_SESSION['roleId'], ["1" , "2"])) {
                    
                    if ($value["isFinished"] == 0) {

                        if ($value["dateParametre"] == "" ) {
                        
                            $action .= $detail.$delEdit ;
                            
                        }
                        
                    }


                }
                else if (in_array($_SESSION['roleId'], ["3" , "4" , "8" , "6" , "9"])){
                        
                        $action .= $detail ;
                    
                }
                
                else{

                    
                    $action .= $detail.$delEdit ;

                    if ($value["isFinished"] == 3) {

                        $action .= "" ;
                        
                    }

                }

                $doc = "";
                if (in_array($_SESSION['roleId'], ["5", "8" , "9"])){

                    $doc = '
                        <td style="width : 10%;">' . $value["dateParametre"] . '</td> 
                        <td style="width : 10%;">' . $value["dateDocteur"] . '</td> 
                    ' ;

                }

            
                if (in_array($_SESSION['roleId'], ["1","2", "3", "4"])){

                    $doc = '
                        <td style="width : 10%;">' . $value["dateParametre"] . '</td> 
                        
                    ' ;

                }


                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $i . ' </td>
                        <td style="width : 20%;">' . $value["nom"]. ' </td>
                        <td style="width : 10%;">' . $value["genre"] . ' </td>
                        <td style="width : 15%;">' . $value["TypepersonneMalade"] . ' </td>
                        <td style="width : 20%;">' . $value["motif"] . ' </td>
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 
                        '.$doc .'
                        <td style="width : 10%;">' . $etat . '</td> 
                        <td style="width : 10%;"> '.$action.'
                        </td> 
                       </tr>';
                $i++;
            }

            $th .= "</tbody> ";


            $data =  $this->consultation
            ->select("consultation.* , membre.nom_membre , CONCAT('Docteur : ',utilisateur.nom_user , ' ', utilisateur.prenom_user , ' ( ' , typeMedecin.name , ' )') AS doc_full_name")
            ->join("titulaire", "consultation.titulaireId = titulaire.titulaireId")
            ->join("membre", "membre.id_membre = titulaire.membreId")
            ->join("utilisateur", "consultation.docteurId = utilisateur.id_user")
            ->join("typeMedecin", "typeMedecin.idTypeMedecin = utilisateur.idTypeMedecin")
            ->where("consultation.consultationId" , $_POST["idconsultation"])
            ->first();



            $response = [
                'roleId' => $this->session->get("roleId"),
                'isFinished' => $data["isFinished"],
                'isPharmacie' => $data["isPharmacie"],
                'isLabo' => $data["isLabo"],
                'table' => $th,
                'docteur' => $data["doc_full_name"],
                'num_carte' => "Carte N° : " . $this->genererNumeroCarte( $data["nom_membre"] , $data["titulaireId"])  ,
                'titulaireId' => $data["titulaireId"]
            ];
            
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function downloadFile()
{
    $fileName = $this->request->getPost('fileName');

    $filePath = 'assets/img/labo/' . $fileName;

    if (file_exists($filePath)) {
        header('Content-Type: ' . mime_content_type($filePath));
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    readfile($filePath);

        exit; // Terminer le script après avoir envoyé le fichier
    } else {
        return $this->response->setJSON(['error' => 'File not found']);
    }
}
    public function listes_envoie_labo()
    {
        try {

            
            $datas = $this->envoieLbo
            ->select("dateEnvoie , dateValidation , Source , resultats , rc , natureExamen , idenvoie_labo , typeEnvoie,idType , resultatTelechargeable")
            ->where("etat" , 1)
            ->where("idType" , $_POST["idType"]);

            if ($_POST["type"] == "visite") {
                
                $datas =  $datas->where("typeEnvoie" , "visite");
            }
            else{
                $datas = $datas->where("typeEnvoie" , "cpn");

            }
            
            $datas = $datas->findAll();


            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Nature</th>
                            <th>Resultats</th>
                            <th>R.C</th>
                            <th>Date envoie</th>
                            <th>Date validation</th>
                            <th>Source</th>
                            <th>Analyse</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";
            $i = 1 ;
            foreach ($datas as $value) {

                $natureExamen = $value["natureExamen"];
                if (strpos($natureExamen, ',') !== false) {
                    // Si plusieurs valeurs sont présentes, on les sépare avec explode
                    $ids = explode(',', $natureExamen);
                } else {
                    // Si une seule valeur est présente, on la place dans un tableau
                    $ids = [$natureExamen];
                }

              $analyses = $this->analyse
               ->select('analyse')
               ->whereIn('id_analyse', $ids)->findAll();
               
               $analysesArray = array_column($analyses, 'analyse');
                $analysesString = implode(', ', $analysesArray);
                $validerLabo = '';
                $demande = '';
                $delEdit = '';
                

                if ($value["dateValidation"] == "" ) {
                        
                    $demande = '<a class="danger mr-1" >En attente</a>' ;
                    $delEdit = '<a class="info mr-1" id="labedit'.$value["idenvoie_labo"].'" data-nature= '.json_encode(explode(',', $value["natureExamen"])).' data-resultats= "'.$value["resultats"].'" data-rc= "'.$value["rc"].'" onclick="edit_laboratoire(' . $value["idenvoie_labo"] . ')"><i class=" la la-pencil-square-o"></i></a>
                    <a class="danger mr-1" onclick="delete_labo(' . $value["idenvoie_labo"] . ')"><i class=" la la-trash-o"></i></a> ' ;

                    if (in_array($_SESSION['roleId'], ["5", "6"])){

                      
                        $validerLabo = '<a class="success mr-1" data-typeenvoie = "'. $value["typeEnvoie"] .'" id="labovalider'. $value["idenvoie_labo"] .'" onclick="valider_demande(' . $value["idenvoie_labo"] . ',' . $value["idType"] . ') "><i class=" la la-check-circle"></i>Valider</a>';
                       
                    }
                    
                }else {

                    $filePath = 'assets/img/labo/' . $value["resultatTelechargeable"];
                    if ($value["resultatTelechargeable"] != "") {
                        $demande = '<a class="success mr-1" data-file = "'.$value['resultatTelechargeable'].'" id="idlabed'.$value["idenvoie_labo"].'" onclick="downloadFile('.$value["idenvoie_labo"].')"><i class="la la-download"></i>Télécharger</a>';
                    } else {
                        $demande = '<a class="danger mr-1" >Fichier non disponible</a>';
                    }

                    $validerLabo = '';
                    if (in_array($_SESSION['roleId'], ["5"])){

                        $delEdit = '<a class="info mr-1" id="labedit'.$value["idenvoie_labo"].'" data-nature= '.json_encode(explode(',', $value["natureExamen"])).' data-resultats= "'.$value["resultats"].'" data-rc= "'.$value["rc"].'" onclick="edit_labo(' . $value["idenvoie_labo"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="danger mr-1" onclick="delete_labo(' . $value["idenvoie_labo"] . ')"><i class=" la la-trash-o"></i></a> ' ;
    
        
                    }

                }

                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $i . ' </td>
                        <td style="width : 10%;">' . $analysesString . ' </td>
                        <td style="width : 10%;">' . $value["resultats"] . ' </td>
                        <td style="width : 10%;">' . $value["rc"] . ' </td>
                        <td style="width : 20%;">' . $value["dateEnvoie"]. ' </td>
                        <td style="width : 10%;">' . $value["dateValidation"] . ' </td>
                        <td style="width : 10%;">' . $value["Source"] . '</td> 
                        <td style="width : 10%;">'. $demande .'</td> 
                        <td style="width : 10%;">'. $validerLabo.$delEdit .'</td> 

                        </td> 
                       </tr>';
                $i++;
            }

            $th .= "</tbody> ";

            if (in_array($_SESSION['roleId'], ["5", "3" , "4" , "8"])){

                      
                $hide = '';
                
            }
            else{
                
                $hide = ' hidden';
            }

            $response = [
                "hide" => $hide ,
                'table' => $th,

            ];
            
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_medic()
    {
        try {

            
            $datas = $this->liste_medic->where("etat" , 1);
            
            $datas = $datas->findAll();


            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Nature</th>
                            <th>Resultats</th>
                            <th>R.C</th>
                            <th>Date envoie</th>
                            <th>Date validation</th>
                            <th>Source</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";
            $i = 1 ;
            foreach ($datas as $value) {


                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $i . ' </td>
                        <td style="width : 10%;">' . $analysesString . ' </td>
                        <td style="width : 10%;">' . $value["resultats"] . ' </td>
                        <td style="width : 10%;">' . $value["rc"] . ' </td>
                        <td style="width : 20%;">' . $value["dateEnvoie"]. ' </td>
                        <td style="width : 10%;">' . $value["dateValidation"] . ' </td>
                        <td style="width : 10%;">' . $value["Source"] . '</td> 
                        <td style="width : 10%;">'. $demande .'</td> 
                        <td style="width : 10%;">'. $validerLabo .'</td> 

                        </td> 
                       </tr>';
                $i++;
            }

            $th .= "</tbody> ";

            $response = [

                'table' => $th,

            ];
            
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function valider_envoie_labo()
{
    try {
        $date = date("Y-m-d H:i:s");

        // Initialiser les données à mettre à jour
        $envoie = [
            "dateValidation" => $date,
            "id_user_valid" => $this->session->get("id_user"),
        ];

        // Définir le chemin du répertoire de destination
        $uploadDir = 'assets/img/labo/';

        // Vérifier si le répertoire existe, sinon le créer
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new \Exception("Erreur lors de la création du répertoire.");
            }
        }

        // Vérifier si un fichier a été envoyé
        if (isset($_FILES['fichierAnalyse']) && $_FILES['fichierAnalyse']['error'] == 0) {
            // Récupérer l'extension du fichier
            $fileExtension = pathinfo($_FILES['fichierAnalyse']['name'], PATHINFO_EXTENSION);

            // Générer un nom de fichier avec le format labo + date + _ + idEnvoie
            $newFileName = 'labo_' . date("Ymd_His") . '_' . $_POST["idenvoie_labo"] . '.' . $fileExtension;

            // Déplacer le fichier vers le répertoire cible avec le nouveau nom
            $filePath = $uploadDir . $newFileName;

            if (move_uploaded_file($_FILES['fichierAnalyse']['tmp_name'], $filePath)) {
                // Ajouter le chemin du fichier à l'array $envoie
                $envoie['resultatTelechargeable'] = $newFileName; // Mettre le nom dans la colonne resultatTelechargeable
            } else {
                // Gérer l'erreur si le fichier ne peut pas être déplacé
                throw new \Exception("Erreur lors du déplacement du fichier.");
            }
        }

        // Mettre à jour la table envoie_labo avec les informations du fichier et autres données
        $this->envoieLbo->update($_POST["idenvoie_labo"], $envoie);

        // Traitement selon le type d'envoi
        if ($_POST["type"] == "visite") {
            $this->detailconsultation->update($_POST["idType"], ["isLabo" => 2]);
            $data = $this->detailconsultation->select("consultationId,isLabo")
                ->where("consultationId", $_POST["idConsult"])
                ->findAll();

            $this->verif_visite($_POST["idConsult"]);
        } else {
            $this->detailconsultationcpn->update($_POST["idType"], ["isLabo" => 2]);
            $data = $this->detailconsultationcpn->select("idcpn,isLabo")
                ->where("idcpn", $_POST["idCpn"])
                ->findAll();

            $isLaboPresent = false;
            foreach ($data as $row) {
                if ($row['isLabo'] == 1) {
                    $isLaboPresent = true;
                    break;
                }
            }

            if (!$isLaboPresent) {
                $this->cpn->update($_POST["idCpn"], ["isLabo" => 0]);
            }
        }

        echo json_encode(["id" => 1]);
    } catch (\Throwable $th) {
        echo json_encode(["error" => $th->getMessage()]);
    }
}


    public function verif_visite($idConsul)
    {

        $datas =  $this->envoieLbo
        ->select("idType")
        ->where("detailconsultation.consultationId" , $idConsul)
        ->where("envoie_labo.typeEnvoie" , 'visite')
        ->where('envoie_labo.etat' , 1)
        ->where('envoie_labo.dateValidation IS NULL')
        ->join("detailconsultation" , "envoie_labo.idType = detailconsultation.detailconsultationId")
        ->groupBy("envoie_labo.idType")
        ->findAll();
        
        $isLaboPresent = false;
        
        foreach ($datas as $row) {
            
            $isLaboPresent = true;
            $this->detailconsultation->update( $row['idType'] , ["isLabo" => 1]);
            
        }

        if ($isLaboPresent) {
            
            
        }else{
            
            $this->consultation->update( $idConsul , ["isLabo" => 0]);

        }


      
    }
}
