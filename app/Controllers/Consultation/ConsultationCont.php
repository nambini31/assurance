<?php

namespace App\Controllers\consultation;

use App\Controllers\BaseController;

class ConsultationCont extends BaseController
{
    public function index()
    {
        if (in_array($_SESSION['roleId'], ["5", "3", "4", "1", "2", "6", "8", "9", "10"])) {

            $content = view('consultation/index');
            return view('layout', ['content' => $content]);
        } else {
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
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();


            $_POST["id_user"] = $this->session->get("id_user");

            //si dentiste



            if (isset($_POST['consultationId']) && $_POST['consultationId'] != "") {

                $consultationId = $_POST['consultationId'];


                $consul = $this->consultation->find($consultationId);

                if ($_POST["typeConsultationId"] == 2) {

                    if ($consul["isFinished"] == 0) {

                        $_POST["isFinished"] = 1;
                        $this->consultation->save($_POST);
                        $this->detailconsultation->where("consultationId", $consultationId)->update(null, ["isFinished" => 1]);
                    } else {
                        $this->consultation->save($_POST);
                    }
                } else {


                    $this->consultation->save($_POST);
                }
            } else {

                if ($_POST["typeConsultationId"] == 2) {

                    $_POST["isFinished"] = 1;
                }
                $this->consultation->save($_POST);

                $consultationId = $this->consultation->insertID();
            }


            $consul = $this->consultation->find($consultationId);

            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($consul);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }

    public function ajout_patient()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();


            $data = explode("_", $_POST["personne"]);
            $_POST["idPersonneMalade"] = $data[0];
            $_POST["TypepersonneMalade"] = $data[1];

            $consul = $this->consultation->find($_POST["consultationId"]);

            if ($consul["typeConsultationId"] == 2) {

                if ($consul["isFinished"] == 1) {
                    $_POST["isFinished"] = 1;
                }
            }

            if ($_POST["detailConsultationId"] == "") {

                if ($consul["isFinished"] == 1) {
                    $_POST["isFinished"] = 1;
                }
            }

            $this->detailconsultation->save($_POST);
            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function delete_consultation()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();


            $id = $_POST['id_consultation'];
            $this->consultation->update($id, ['etat' => 0]);

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function envoyer_docteur()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();


            $id = $_POST['id_consultation'];

            if ($_POST["isFinished"] == 0) {
                $this->consultation->update($id, ['isFinished' => 1]);
                $this->detailconsultation->where("consultationId", $id)->update(null, ['isFinished' => 1]);
            } else if ($_POST["isFinished"] == 1) {

                $data = $this->detailconsultation->where("consultationId", $id)->where('isPharmacie', 1)->findAll();

                if ($data) {

                    $this->consultation->update($id, ['isFinished' => 2]);
                    $this->detailconsultation->where("consultationId", $id)->where("isPharmacie", 1)->update(null, ['isFinished' => 2]);
                    $this->detailconsultation->where("consultationId", $id)->where("isPharmacie", 0)->update(null, ['isFinished' => 3]);
                } else {

                    $this->consultation->update($id, ['isFinished' => 3]);
                    $this->detailconsultation->where("consultationId", $id)->update(null, ['isFinished' => 3]);
                }
            } else if ($_POST["isFinished"] == 2) {
                $this->consultation->update($id, ['isFinished' => 3]);
                $this->detailconsultation->where("consultationId", $id)->update(null, ['isFinished' => 3]);
            }

            // Valider la transaction
            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function delete_labo()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();


            $this->envoieLbo->update($_POST['id_labo'], ['etat' => 0]);

            if ($_POST["type"] == "cpn") {


                if ($_POST["typeDestinataire"] == "Echographie") {

                    $this->detailconsultationcpn->update($_POST["iddetail"], ["isEchographie" => 0]);
                } else {

                    $this->detailconsultationcpn->update($_POST["iddetail"], ["isLabo" => 0]);
                }


                $id = $_POST['id'];

                $this->verif_CPN($id, $db);
            } else {

                if ($_POST["typeDestinataire"] == "Echographie") {

                    $this->detailconsultation->update($_POST["iddetail"], ["isEchographie" => 0]);
                } else {

                    $this->detailconsultation->update($_POST["iddetail"], ["isLabo" => 0]);
                }

                $id = $_POST['id'];

                $this->verif_visite($id, $db);
            }






            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {

            $db->transRollback();

            echo $th;
        }
    }
    public function delete_detail_medicament()
    {

        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $this->detailMedicament->update($_POST['id'], ['etat' => 0]);

            $data = $this->detailMedicament->where("detailconsultationId", $_POST["iddetail"])
                ->where('etat', 1)
                ->findAll();


            if ($data) {

                $this->detailconsultation->update($_POST["iddetail"], ['isPharmacie' => 1]);
            } else {

                $this->detailconsultation->update($_POST["iddetail"], ['isPharmacie' => 0]);
            }

            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function delete_detailconsul()
    {

        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $id = $_POST['id'];
            $this->detailconsultation->update($id, ['etat' => 0]);

            $id1 = $_POST["idConsul"];

            $this->verif_visite($id1, $db);

            $db->transComplete();
            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function annuler_acte()
    {

        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $id = $_POST['iddetail'];
            
            $this->detailconsultation->update($id, ['diagnostique' => "" , "idAutreActe"=>"" , "idDocSoin"=>""]);

            $this->soinindex->where("idDetailConsultattion" , $id)->delete(null);

            $db->transComplete();

            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }

    public function charge_type_analyse()
    {
        try {

            $data =  $this->type_analyse->where("etat",  1)->findAll();

            $specialite = '';

            foreach ($data as $value) {
                $specialite .= '
                        <option value="' . $value['id_specialite'] . '"> ' . $value['nom_specialite'] . '</option> ';
            }

            echo $specialite;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_laboratoire_echographie()
    {
        try {

            $data = "";

            if ($_POST["type"] == "Laboratoire") {
                # code...


                $data = " <div class='row'>
                                    
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label for='analyse_select' class=''>Nature de l'examen</label>
                        <select class='selectpicker  form-control btn-sm' name = 'nature[]'  required id='analyse_select' multiple data-live-search='true' data-size='5' title='analyse' data-selected-text-format='count > 3'
                        data-count-selected-text='{0} Nature selected'>
                                       
                        </select>
                    </div>
                </div>
            </div>
           
            
            ";
            }
            if ($_POST["type"] == "Echographie") {



                $data = "<div class='row'>
                                
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for='type_personne_select'>Type echographie ( Nature de l'examen )</label>
                                                <select class='selectpicker  form-control btn-sm' name='typeEchographie' required id='typeEchographie' data-live-search='true' data-size='5' title='type destinataire'>
                                                    <option value='pelvienne' selected >PELVIENNE</option>
                                                    <option value='cervicale' selected >CERVICALE</option>
                                                    <option value='thiroidienne' selected >THIROIDIENNE</option>
                                                    <option value='abdominale' selected >ABDOMINALE</option>
                                                    <option value='abdominalePelvienne' selected >ABDOMINALE PELVIENNE</option>
                                                    <option value='obstetricalePrimo' selected >OBSTETRICALE( 1er TRIMESTRE )</option>
                                                    <option value='obstetricaleSecondo' selected >OBSTETRICALE( 2eme TRIMESTRE )</option>
                                                    <option value='obstetricaleTertio' selected >OBSTETRICALE( 3eme TRIMESTRE )</option>
                                                </select>
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                        
                            <div class='col-md-12'>
                                <div class='form-group'>
                                    <label for='docteurEchographie'>Docteur destinataire</label>
                                                <select class='selectpicker  form-control btn-sm' name='docteurEchographie' required id='docteurEchographie' data-live-search='true' data-size='5' title='Docteur'>

                                                </select>
                                </div>
                            </div>
                        </div>
        
        ";
            }

            echo $data;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function affiche_conclusion()
    {
        try {

            $value =  $this->detailconsultation->find($_POST["id"]);

            $th = "";

            $th =
                '
                    <div class="row">
                        <div class="col-md-6">
                        <form method="POST" id="add_ceritificat" >
                        <input type="hidden" name="idDetailsCons" class="idDetailsCons">
                        <div class="flowscroll">

                        <table id="table_ceritificat_vrai1" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto; margin:auto">
                        <thead> 
                        <tr>
                        <th style="min-width: 100px !important; width: 100% !important">CERTIFICATION MEDICALE</th>
                    </tr> </thead>
                        
                        <tbody> 
                        
                    <tr>
                        <td style="min-width: 120px !important; width: 100%"><textarea name="ceritificationmedicale" required  class="form-control input-sm" cols="30" rows="7" placeholder="Certification">' . $value["ceritificationmedicale"] . '</textarea></td>
                        
                    </tr>
                    <tr>
                        <td>
                        <button style="width: 100%;" type="submit" class="btn btn-sm btn-warning btn-min-width"><i class="la la-envelope"></i> Enregistrer et Envoyer par email</button>
                    </tr>
                      
                    </tbody>


                    

                        </table>
                        </div>
                                   
                                    </form>
                            </div>

                        <div class="col-md-6">
                        <div class="flowscroll">
                        <form method="POST" id="add_repos" >
                        <input type="hidden" name="idDetailsCons" class="idDetailsCons">
                                
                        <table id="table_reposer_vrai2" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto; margin:auto">
                                <thead> 
                                <tr>
                                   <th colspan="2">REPOS MEDICALE</th>
                                </tr> 
                            </thead>
                                
                                <tbody> 
                                <tr>
                                <th>Nombre des jours</th>
                                <th style="min-width: 100px !important; width: 100% !important"><input style="min-width: 100px !important; width: 100% !important" type="text" value="' . $value["nbrrepos"] . '" required class="form-control input-sm"  name="nbrrepos" id="nbrrepos"> </th>
                                
                                </tr>
                            <tr>
                                <th>DIAGNOSTIQUE</th>
                                <td ><textarea name="diagrepos"  class="form-control input-sm" required cols="5" rows="5" placeholder="Diagnostique">' . $value["diagrepos"] . '</textarea></td>
                                
                            </tr>
                                <tr>
                                    <td colspan="2">
                        <button style="width: 100%;" type="submit" class="btn btn-sm btn-warning btn-min-width"><i class="la la-envelope"></i> Enregistrer et Envoyer par email</button>
                                    
                                    </td>

                                </tr>
                            
                            </tbody>
                                </table>
                                </form>
                        </div>
                        
                    
                    </div>
                                
                    </div>
                 ';


            echo json_encode(["table" => $th, "roleId" =>  $this->session->get("roleId")]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function affiche_parametre()
    {
        try {

            $value =  $this->detailconsultation->find($_POST["id"]);

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
                                    <th>TEMPERATURE</th>
                                    <td style="min-width: 100px !important; width: 100%"><input type="text" value="' . $value["temperature"] . '" class="form-control input-sm"  name="temperature" id="temperature"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>TENSION ARTERIELLE</th>
                                    <td><input type="text" value="' . $value["tension"] . '" class="form-control input-sm"  name="tension" id="tension"> </td>
                                    
                                </tr>
                                
                                <tr>
                                    <th>SPO2</th>
                                    <td><input type="text" value="' . $value["spo2"] . '" class="form-control input-sm"  name="spo2" id="spo2"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>FREQUENCE RESPIRATOIRE</th>
                                    <td><input type="text" value="' . $value["frequenceRespiratoire"] . '" class="form-control input-sm"  name="frequenceRespiratoire" id="frequenceRespiratoire"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>FREQUENCE CARDIAQUE</th>
                                    <td><input type="text" value="' . $value["frequenceCardiaque"] . '" class="form-control input-sm"  name="frequenceCardiaque" id="frequenceCardiaque"> </td>
                                    
                                </tr>
                                <tr>
                                    <th>ETAT CONSCIENCE</th>
                                    <td><input type="text" value="' . $value["etatConscience"] . '" class="form-control input-sm"  name="etatConscience" id="etatConscience"> </td>
                                    
                                </tr>
                                
                               
                                </tbody>


                                

                                    </table>
                            </div>

                        <div class="col-md-6">
                    
                                <table id="table_parametre_vrai2" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto; margin:auto">
                                <thead> 
                                <tr>
                                <th>.</th>
                                <td>.</td>
                            </tr> <thead>
                                
                                <tbody> 
                                <tr>
                                <th >SF</th>
                                <td style="min-width: 100px !important; width: 100%"><input type="text" value="' . $value["sf"] . '" class="form-control input-sm"  name="sf" id="sf"> </td>
                                
                            </tr>
                            <tr>
                                <th>PERIMETRE BRAS</th>
                                <td><input type="text" value="' . $value["perimetreBras"] . '" class="form-control input-sm"  name="perimetreBras" id="perimetreBras"> </td>
                                
                            </tr>
                            <tr>
                                <th>PERIMETRE CRANE</th>
                                <td><input type="text" value="' . $value["perimetreCrane"] . '" class="form-control input-sm"  name="perimetreCrane" id="perimetreCrane"> </td>
                                
                            </tr>
                            
                            <tr>
                                <th>POIDS ( KG )</th>
                                <td><input type="text" value="' . $value["poids"] . '" class="form-control input-sm"  name="poids" id="poids"></td>
                                

                                </tr>

                                <tr>
                                    <th>TAILLE ( Cm ) </th>
                                <td><input type="text" value="' . $value["taille"] . '" class="form-control input-sm"  name="taille" id="taille"> </td>
                                    
                                </tr>

                                <tr>
                                <th>POIDS / TAILLE</th>
                                <td><input type="text" value="' . $value["poidstaille"] . '" class="form-control input-sm"  name="poidstaille" id="poidstaille"> </td>
                                

                                </tr>
                            </tbody>
                                </table>
                    
                    </div>
                                
                    </div>
                 ';


            echo json_encode(["table" => $th, "roleId" =>  $this->session->get("roleId")]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function affiche_clinique()
    {
        try {

            $value =  $this->detailconsultation->find($_POST["id"]);

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
                                    <td><textarea name="histoMaladie"  class="form-control input-sm" cols="5" rows="5" placeholder="Histoire de la maladie">' . $value["histoMaladie"] . '</textarea>
                                    </td>
                                    <td><textarea name="chirurgie"  class="form-control input-sm" cols="5" rows="5" placeholder="Chirurgies">' . $value["chirurgie"] . '</textarea>
                                    </td>
                                    
                                </tr>

                                <tr>
                                <th >Examen cliniques</th>
                                <th >Alergies</th>
                                
                                </tr>
                                <tr>
                                    <td ><textarea name="examClinique"  class="form-control input-sm" cols="5" rows="5" placeholder="Examen cliniques">' . $value["examClinique"] . '</textarea>
                                    </td>
                                    <td><textarea name="alergie"  class="form-control input-sm" cols="5" rows="5" placeholder="Alergies">' . $value["alergie"] . '</textarea>
                                    </td>
                                    
                                </tr>
                                
                                </tbody>
                   
                 ';


            echo json_encode(["table" => $th]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function affiche_autreacte()
    {
        try {

            $data =  $this->detailconsultation->find($_POST["id"]);

            $natureExamen = $data["idAutreActe"];
            $ids = [];

            if (strpos($natureExamen, ',') !== false) {
                // Si plusieurs valeurs sont présentes, on les sépare avec explode
                $ids = explode(',', $natureExamen);
            } else {
                // Si une seule valeur est présente, on la place dans un tableau
                $ids = [$natureExamen];
            }

            $autreacte = $this->autreActe
                ->select('idautreActe,autreActe')
                ->where('etat', 1)->findAll();

            $patient = '<select class="selectpicker  form-control btn-sm" name="idAutreActe[]" required id="idAutreActe" data-live-search="true" multiple data-size="5" title="Types d\'actes">
                ';


            foreach ($autreacte as $values) {
                $selected = "";
                if (in_array($values["idautreActe"], $ids)) {
                    $selected = "selected";
                }
                $patient .= '<option value="' . $values['idautreActe'] . '" ' . $selected . ' > ' . $values['autreActe'] . '</option> ';
            }

            $patient .= `</select>`;

            $datas =  $this->utilisateur
                ->where("roleId", 11)
                ->where("etat", 1)
                ->findAll();

            $listeDocteur = '';
            foreach ($datas as $value) {
            }

            $listeDocteur = '<select class="selectpicker  form-control btn-sm" name="idDocSoin" required id="idDocSoin" data-live-search="true" data-size="5" title="Docteur">
                ';


            foreach ($datas as $values) {
                $selected = "";
                if ($data["idDocSoin"]== $values["id_user"] ) {
                    $selected = "selected";
                }
                $listeDocteur .= '
                <option value="' . $values['id_user'] . '" ' . $selected . ' > ' . $values['nom_user'] . ' ' . $values['prenom_user'] . '</option> ';
            }

            $listeDocteur .= `</select>`;


            $th = "";

            $th =
                '                      
                
                        <thead> 
                            <tr>

                            <th style="width: 100em !important; min-width: 300px !important;">TYPES D\'ACTES</th>
                            <th style="width: 100em !important; min-width: 300px !important;">DESTINATEUR ( SOINS )</th>
                            </tr>        
                        </thead>
                    
                        <tbody> 
                    
                            <tr>
                               
                                <td style="width: 100em !important; min-width: 300px !important;">
                                    ' . $patient . '
                                </td>
                                <td style="width: 100em !important; min-width: 300px !important;">
                                    ' . $listeDocteur . '
                                </td>
                            </tr> 

                            <tr>
                                <td colspan="2" style="width: 100em !important; min-width: 300px !important;">DIAGNISTIQUE PRELIMINAIRE</td>
                            </tr> 
                            
                            <tr>
                                <td colspan="2" style="width: 100em !important; min-width: 300px !important;">
                                    
                                    <textarea name="diagnostique" class="form-control input-sm" cols="5" rows="5" placeholder="DIAGNISTIQUE">' . $data["diagnostique"] . '</textarea>

                                </td>
                            </tr> 
                
                            </tbody>
                 ';


            echo json_encode(["table" => $th]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function affiche_antecedent()
    {
        try {

            $value =  $this->detailconsultation->find($_POST["id"]);

            $th = "";

            $th =
                '  <thead> 
                                            <tr>
                                                <th style="width: 100em !important; min-width: 300px !important;">MEDICAUX</th>
                                                <th style="width: 100em !important; min-width: 300px !important;">CHIRURGICAUX</th>
                                            </tr> 
                                                
                                        <thead>
                                    
                                        <tbody> 
                                   
                                <tr>
                                    <td><textarea name="medicaux"  class="form-control input-sm" cols="5" rows="5" placeholder="Médicaux">' . $value["medicaux"] . '</textarea>
                                    </td>
                                    <td><textarea name="chirurgicauxant"  class="form-control input-sm" cols="5" rows="5" placeholder="Chirurgicaux">' . $value["chirurgicauxant"] . '</textarea>
                                    </td>
                                    
                                </tr>

                                <tr>
                                <th >ALLERGIES</th>
                                <th >AUTRE</th>
                                
                                </tr>
                                <tr>
                                    <td ><textarea name="allergiieant"  class="form-control input-sm" cols="5" rows="5" placeholder="Alergies">' . $value["allergiieant"] . '</textarea>
                                    </td>
                                    <td><textarea name="autreant"  class="form-control input-sm" cols="5" rows="5" placeholder="Autre">' . $value["autreant"] . '</textarea>
                                    </td>
                                    
                                </tr>
                                
                                </tbody>
                   
                 ';


            echo json_encode(["table" => $th]);
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
                        <option value="' . $value['idTypeMedecin'] . '"> ' . $value['name'] . '</option> ';
            }
            echo $type;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getDocteurSelonType()
    {
        try {

            $data =  $this->utilisateur
                ->where("idTypeMedecin", $_POST["id"])
                ->where("etat", 1)
                ->findAll();

            $listeDocteur = '';
            foreach ($data as $value) {
                $listeDocteur .= '
                    <option value="' . $value['id_user'] . '"> ' . $value['nom_user'] . ' ' . $value['prenom_user'] . '</option> ';
            }
            echo $listeDocteur;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function add_parametre()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $_POST["dateParametre"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update($_POST["idDetailsCons"], $_POST);

            $db->transComplete();
            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }

    public function add_clinique()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();
            $_POST["dateDocteur"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update($_POST["idDetailsCons"], $_POST);

            $db->transComplete();
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function add_autreacte()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();
            $_POST["dateDocteur"] = date("Y-m-d H:i:s");
            $_POST["idAutreActe"] = implode(",", $_POST["idAutreActe"]);

            
            $data =  $this->detailconsultation->update($_POST["idDetailsCons"], $_POST);
            
            $data = $this->soinindex->where("idDetailConsultattion" , $_POST["idDetailsCons"] )->first();

            
            if (!$data) {
                
                $this->soinindex->save(["idDetailConsultattion" => $_POST["idDetailsCons"]]);

            }

            $db->transComplete();
            
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function add_antecedent()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {

            $db->transStart();
            $_POST["dateDocteur"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update($_POST["idDetailsCons"], $_POST);

            $db->transComplete();
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function add_repos()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();
            $_POST["dateDocteur"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update($_POST["idDetailsCons"], $_POST);
            $db->transComplete();

            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }
    public function add_ceritificat()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();
            $_POST["dateDocteur"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update($_POST["idDetailsCons"], $_POST);

            $db->transComplete();
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }

    public function add_Examen()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $date = date("Y-m-d H:i:s");
            $_POST["dateParametre"] = $date;

            // Préparer les données pour l'envoi au laboratoire
            $envoie = [
                "Source" => $this->session->get("roleName"),
                "dateEnvoie" => $date,
                "typeEnvoie" => "visite",
                "idType" => $_POST["idDetails"],
                "id_user" => $this->session->get("id_user"),
                "typeDestinataire" => $_POST["type_destinataire"],
                "idenvoie_labo" => $_POST["idenvoie_labo"]
            ];

            // Mettre à jour la consultation avec le statut isLabo = 1 ou isEcho
            if ($_POST["type_destinataire"] == "Laboratoire") {

                $_POST["natureExamen"] = implode(",", $_POST["nature"]);
                $_POST["isLabo"] = 1;
                $envoie["natureExamen"] = $_POST["natureExamen"];
            } else {
                $_POST["isEchographie"] = 1;
                $envoie["typeEchographie"] = $_POST["typeEchographie"];
                $envoie["docteurEchographie"] = $_POST["docteurEchographie"];
            }


            // Mettre à jour les détails de consultation
            $this->detailconsultation->update($_POST["idDetails"], $_POST);


            $envoie["rc"] = $_POST["rc"];
            $envoie["resultats"] = $_POST["resultats"];

            // Sauvegarder l'envoi au laboratoire


            $this->envoieLbo->save($envoie);

            $this->verif_visite($_POST["idConsPour"], $db);



            echo json_encode(['success' => true, 'message' => 'Examen ajouté avec succès.']);
        } catch (\Throwable $th) {
            // En cas d'erreur, faire un rollback
            $db->transRollback();

            echo  $th;
        }
    }

    public function add_medicament()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $data =  $this->article
                ->where("id_article", $_POST['medicamentId'])
                ->first();

            $id = 0;

            $mess = [];

            if ($data["etat"] == 1) {

                if ($data["isActif"] == 1) {

                    if ($_POST["detailMedicamentId"] != "") {
                        $qte = $data["quantite"] + $_POST["ancienQte"];
                    } else {
                        # code...
                        $qte = $data["quantite"];
                    }

                    if ($_POST["qte"] > $qte) {

                        $id = "Stock epuisé";
                        $data = ["message" => $id, "id" => 0];
                    } else {
                        $this->detailMedicament->save($_POST);
                        $this->detailconsultation->update($_POST["detailconsultationId"], ["isPharmacie" => 1]);
                        $data = ["message" => "ok", "id" => 1];
                    }
                } else {
                    $id = "Medicament perimé";
                    $data = ["message" => $id, "id" => 2];
                }
            } else {
                $id = "Medicament dejà supprimé";
                $data = ["message" => $id, "id" => 3];
            }


            $db->transComplete();


            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode($data);
        } catch (\Throwable $th) {
            $db->transRollback();

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
                        <option value="' . $value['titulaireId'] . '"> ' . $this->genererNumeroCarte($value["nom_membre"], $value["titulaireId"])  . " " . $value['full_name'] . '</option> ';
            }

            echo $cabinet;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_doc_echographie()
    {
        try {

            $data =  $this->utilisateur
                ->where("roleId", 10)
                ->where("etat", 1)
                ->findAll();

            $listeDocteur = '';
            foreach ($data as $value) {
                $listeDocteur .= '
                    <option value="' . $value['id_user'] . '"> ' . $value['nom_user'] . ' ' . $value['prenom_user'] . '</option> ';
            }
            echo $listeDocteur;
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
                    ->where("analyse.etat",  '1')->like("role_user", "3")->groupBy("id_type_analyse")
                    ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse");
                $data = $data->findAll();

                foreach ($data as $value) {
                    $datas =  $this->analyse
                        ->where("etat",  '1')
                        ->where("type_analyse",  $value["id_type_analyse"])
                        ->like("role_user", "3")
                        ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";


                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['id_analyse'] . '"> ' . $values['analyse'] . '</option> ';
                    }

                    $patient .= `</optgroup>`;
                }
            } elseif ($this->session->get("roleId") == "4") {
                $data =  $this->analyse
                    ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                    ->where("analyse.etat",  '1')->like("role_user", "4")
                    ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse")
                    ->groupBy("id_type_analyse");
                $data = $data->findAll();


                foreach ($data as $value) {
                    $datas =  $this->analyse
                        ->where("etat",  '1')
                        ->where("type_analyse",  $value["id_type_analyse"])
                        ->like("role_user", "4")
                        ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";


                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['id_analyse'] . '"> ' . $values['analyse'] . '</option> ';
                    }

                    $patient .= `</optgroup>`;
                }
            } elseif ($this->session->get("roleId") == "8") {
                $data =  $this->analyse
                    ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                    ->where("analyse.etat",  '1')->like("role_user", "8")
                    ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse")
                    ->groupBy("id_type_analyse");
                $data = $data->findAll();


                foreach ($data as $value) {
                    $datas =  $this->analyse
                        ->where("etat",  '1')
                        ->where("type_analyse",  $value["id_type_analyse"])
                        ->like("role_user", "8")
                        ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";


                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['id_analyse'] . '"> ' . $values['analyse'] . '</option> ';
                    }

                    $patient .= `</optgroup>`;
                }
            } elseif ($this->session->get("roleId") == "5") {
                $data =  $this->type_analyse
                    ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                    ->where("etat",  '1')->groupBy("id_type_analyse");
                $data = $data->findAll();

                foreach ($data as $value) {
                    $datas =  $this->analyse
                        ->where("etat",  '1')
                        ->where("type_analyse",  $value["id_type_analyse"])
                        ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";


                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['id_analyse'] . '"> ' . $values['analyse'] . '</option> ';
                    }

                    $patient .= `</optgroup>`;
                }
            }




            echo $patient;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_medicament()
    {
        try {
            $patient = '';



            foreach ([["val" => "Tube"], ["val" => "Flacon"], ["val" => "BT"]] as $value) {
                $data =  $this->article
                    ->where("isActif", 1)
                    ->where("etat", 1)
                    ->where("unite", $value['val'])
                    ->findAll();

                $patient .= "<optgroup label= '{$value['val']}'>";



                foreach ($data as $values) {

                    $qte = $values['quantite'];

                    if ($_POST["medicament_select"] != "") {

                        $qte = $values['quantite'] + $_POST["qte"];
                    }

                    $color = ($values['quantite'] <= 10) ? 'red' : 'black';
                    $patient .= '
                        <option style="color:' . $color . ' !important;" value="' . $values['id_article'] . '" data-qte-max="' . $qte . '">
                            ' . $this->genererNumeroCarte("MED", $values["id_article"]) . " - " . $values['designation'] .
                        '  ( ' . $qte . ' )
                        </option>';
                }



                $patient .= `</optgroup>`;
            }

            echo $patient;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_administration()
    {
        try {
            $patient = '';

            $data =  $this->adminMedicament
                ->where("etat", 1)
                ->findAll();

            foreach ($data as $values) {
                $patient .= '
                        <option value="' . $values['idadminMedicament'] . '">
                            ' . $values['adminMedicament'] . '
                        </option>';
            }



            $patient .= `</optgroup>`;

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
                ->where("titulaire.titulaireId", $_POST["id"])
                ->join("enfant", "enfant.titulaireId = titulaire.titulaireId", "left");
            $data = $data->findAll();

            // 0 : enfant , 1 : parent , 2 : titulaire , 3 : conjoint
            foreach ($data as $value) {
                $patient .= "<optgroup label= 'Titulaire'>";

                $patient .= '<option value="' . $value['titulaireId'] . '_Titulaire">' . $value['nom_titulaire'] . '</option> ';
                $patient .= `</optgroup>`;

                $patient .= "<optgroup label= 'Conjoint(e)'>";

                $patient .= '<option value="' . $value['titulaireId'] . '_Conjoint(e)">' . $value['nomPrenomConjoint'] . '</option> ';
                $patient .= `</optgroup>`;
                break;
            }

            $patient .= "<optgroup label= 'Enfant'>";

            foreach ($data as $value) {

                if ($value["typeEnfant"] == "0") {

                    $patient .= '<option value="' . $value['enfantId'] . '_Enfant">' . $value['nom_enfant'] . '</option> ';
                }
            }

            $patient .= `</optgroup>`;

            $patient .= "<optgroup label= 'Parent'>";

            foreach ($data as $value) {

                if ($value["typeEnfant"] == "1") {

                    $patient .= '<option value="' . $value['enfantId'] . '_Parent">' . $value['nom_enfant'] . '</option> ';
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
            $datas = $this->consultation;

            if ($_POST["id_membre"] != "") {

                $datas =  $datas
                    ->where('consultation.etat', 1)
                    ->select(" membre.id_membre , membre.nom_membre , titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
                    ->join("utilisateur", "utilisateur.id_user = consultation.docteurId")
                    ->join("titulaire", "consultation.titulaireId = titulaire.titulaireId")
                    ->join("typeconsultation", "consultation.typeConsultationId = typeconsultation.idtypeconsultation")
                    ->join("membre", "membre.id_membre = titulaire.membreId")
                    ->where('membre.id_membre', $_POST["id_membre"]);

                if (in_array($_SESSION['roleId'], ["8"])) {

                    $datas = $datas
                        ->where("docteurId", $_SESSION['id_user']);
                }
            } else {


                $datas =  $datas
                    ->where('consultation.etat', 1)
                    ->select(" membre.id_membre , membre.nom_membre , CONCAT(UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS code ,titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
                    ->join("utilisateur", "utilisateur.id_user = consultation.docteurId")
                    ->join("titulaire", "consultation.titulaireId = titulaire.titulaireId")
                    ->join("typeconsultation", "consultation.typeConsultationId = typeconsultation.idtypeconsultation")
                    ->join("membre", "membre.id_membre = titulaire.membreId");

                if (in_array($_SESSION['roleId'], ["8"])) {

                    $datas = $datas
                        ->where("docteurId", $_SESSION['id_user']);
                }
            }

            if ($_POST["date_debut"] != "") {

                $datas = $datas
                    ->where("date(consultation.createdAt) >= ", $_POST["date_debut"]);
            }
            if ($_POST["date_fin"] != "") {

                $datas = $datas
                    ->where("date(consultation.createdAt) <= ", $_POST["date_fin"]);
            }

            $datas = $datas->findAll();

            // $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];
            $ctegorie =  $datas;


            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Carte N°</th>
                            <th>Titulaire</th>
                            <th>Docteur</th>
                            <th>Type</th>
                            <th>Nbr Patient</th>
                            <th>Date</th>
                            <th>user</th>
                            <th>Etat</th> ";

            $th .= "<th>Action</th>";


            $th .= "</tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {


                if (in_array($_SESSION['roleId'], ["6"])) {

                    if ($value["isLabo"] != '1') {

                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["10"])) {

                    if ($value["isEchographie"] != '1') {

                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["3", "4"])) {

                    if ($value["isFinished"] != '0') {

                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["8"])) {

                    if ($value["isFinished"] != '1') {

                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["9"])) {

                    if ($value["isFinished"] != '2') {

                        continue;
                    }
                }


                $action = '';

                if (in_array($_SESSION['roleId'], ["1", "5", "2"])) {

                    $action .= '
                    <a class="info mr-1"  onclick="edit_consultation(' . $value["consultationId"] . ' , ' . $value["id_membre"] . ' , ' . $value["titulaireId"] . ' , ' . $value["docteurId"] . ' , ' . $value["typeConsultationId"] . ')"><i class=" la la-pencil-square-o"></i></a>

                    <a class="danger mr-1" onclick="supprimerconsultation(' . $value["consultationId"] . ')"><i class=" la la-trash-o"></i></a> ';

                    if (in_array($_SESSION['roleId'], ["1", "2"])) {

                        if ($value["typeConsultationId"] == 2) {

                            if ($value["isFinished"] == 1 && ($value["isLabo"] == 0 || $value["isLabo"] == "")) {
                                $action = $action;
                            } else {
                                $action = "";
                            }
                        } else {
                            if ($value["isFinished"] == 0 && ($value["isLabo"] == 0 || $value["isLabo"] == "")) {
                                $action = $action;
                            } else {
                                $action = "";
                            }
                        }
                    }
                }

                if ($value["isFinished"] == 0) {

                    $etat = "En attente parametre";

                    if ($value["isLabo"] == 1) {

                        $etat = "En attente d'analyse ( Param )";
                    }
                } else if ($value["isFinished"] == 1) {

                    $etat = "En attente docteur";

                    if ($value["isLabo"] == 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'analyse && Echographie";
                    }
                    if ($value["isLabo"] == 1 && $value["isEchographie"] != 1) {

                        $etat = "En attente d'analyse";
                    }
                    if ($value["isLabo"] != 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'echographie";
                    }
                } else if ($value["isFinished"] == 2) {

                    $etat = "En attente pharmacie";
                } else if ($value["isFinished"] == 3) {

                    $etat = "Termine";
                }

                $count = $this->detailconsultation
                    ->where('detailconsultation.consultationId', $value["consultationId"])
                    ->where('detailconsultation.titulaireId', $value["titulaireId"])
                    ->where("etat", 1)
                    ->countAllResults();

                $datas =  $this->consultation
                    ->select("utilisateur.nom_user , utilisateur.prenom_user")
                    ->join("utilisateur", "utilisateur.id_user = consultation.id_user", "left")
                    ->where('consultationId', $value["consultationId"])->first();



                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $value["consultationId"] . '</td> 
                        <td style="width : 10%;">' . $this->genererNumeroCarte($value["nom_membre"], $value["titulaireId"]) . ' </td>
                        <td style="width : 20%;">' . $value["nom"] . " " . $value["prenom"] . ' </td>
                        <td style="width : 20%;">' . $value["nom_user"] . " " . $value["prenom_user"] . ' </td>
                        <td style="width : 15%;">' . $value["designtypeconsultation"] . ' </td>
                        <td style="width : 10%;">' . $count . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 
                        <td style="width : 10%;">' . $datas["nom_user"] . " " . $datas["prenom_user"] . '</td>  
                        <td style="width : 10%;">' . $etat . '</td>  
                        <td style="width : 10%;"> 
                            <a class="info mr-1"  onclick="liste_patient( ' . $value["consultationId"] . ' ,' . $value["isFinished"] . ')"><i class=" la la-list"></i></a> ' . $action;

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
            
            , detailconsultation.* , consultation.typeConsultationId ")
                ->join("titulaire", "titulaire.titulaireId = detailconsultation.idPersonneMalade", "left")
                ->join("enfant", "enfant.enfantId = detailconsultation.idPersonneMalade", "left")
                ->join("consultation", "detailconsultation.titulaireId = consultation.titulaireId")
                ->where('detailconsultation.consultationId', $_POST["idconsultation"])
                ->where('consultation.consultationId', $_POST["idconsultation"])
                ->where("detailconsultation.etat", 1)
                ->findAll();

            $doc = "";
            if (in_array($_SESSION['roleId'], ["5", "8", "9"])) {

                $doc = "<th>Parametrage</th><th>Docteur</th>";
            }


            if (in_array($_SESSION['roleId'], ["1", "2", "3", "4"])) {

                $doc = "<th>Parametrage</th>";
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
            $i = 1;
            foreach ($datas as $value) {

                if (in_array($_SESSION['roleId'], ["6"])) {

                    if ($value["isLabo"] != '1') {

                        $i++;
                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["10"])) {

                    if ($value["isEchographie"] != '1') {

                        $i++;
                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["8"])) {

                    if ($value["isFinished"] != '1') {

                        $i++;
                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["3", "4"])) {

                    if ($value["isFinished"] != '0') {

                        $i++;
                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["9"])) {

                    if ($value["isFinished"] != '2') {

                        $i++;
                        continue;
                    }
                }


                if ($value["isFinished"] == '0') {

                    $etat = 'En attente paramétre';

                    if ($value["isLabo"] == '1') {


                        $etat = "En attente d'analyse";
                    }
                } else if ($value["isFinished"] == '1') {


                    $etat = 'En attente docteur';

                    if ($value["isLabo"] == 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'analyse && Echographie";
                    }
                    if ($value["isLabo"] == 1 && $value["isEchographie"] != 1) {

                        $etat = "En attente d'analyse";
                    }
                    if ($value["isLabo"] != 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'echographie";
                    }
                } else if ($value["isFinished"] == '2') {


                    $etat = 'En attente pharmacie';
                } else if ($value["isFinished"] == '3') {

                    $etat = "Termine";
                }


                $param = '';
                $detail = '<a class="success mr-1"  onclick="affichage_demande(' . $value["detailConsultationId"] . ' , ' . $_SESSION['roleId'] . ')"><i class=" la la-list"></i></a>';
                $medic = '<a class="danger mr-1" onclick="medic_docteur(' . $value["detailConsultationId"] . ')" ><i class="las la-briefcase-medical la-2x"></i></a>';
                $print = '<a class="danger mr-1"  "><i class="las la-print la-2x"></i></a>';
                $labo = '<a class="info mr-1"   onclick="laboratoire(' . $value["detailConsultationId"] . ',' . $value["isFinished"] . ')"><i class=" la la-microscope"></i></a>';
                $delEdit = '<a class="info mr-1" id="nat' . $value["detailConsultationId"] . '" data-motif= "' . $value["motif"] . '" data-personne=' . json_encode(implode('_', [$value["idPersonneMalade"], $value["TypepersonneMalade"]])) . ' onclick="edit_patient(' . $value["detailConsultationId"] . ')"><i class=" la la-pencil-square-o"></i></a>
                <a class="danger mr-1" onclick="delete_detailvisite(' . $value["detailConsultationId"] . ')"><i class=" la la-trash-o"></i></a> ';


                $action = '';


                if (in_array($_SESSION['roleId'], ["1", "2"])) {


                    if ($value["typeConsultationId"] == 2) {

                        if ($value["isFinished"] == 1 && ($value["isLabo"] == 0 || $value["isLabo"] == "") && ($value["isPharmacie"] == 0 || $value["isPharmacie"] == "")) {
                            $action .= $delEdit;
                        } else {
                            $action = "";
                        }
                    } else {
                        if ($value["isFinished"] == 0 && ($value["isLabo"] == 0 || $value["isLabo"] == "") && ($value["isPharmacie"] == 0 || $value["isPharmacie"] == "")) {
                            $action .= $delEdit;
                        } else {
                            $action = "";
                        }
                    }
                } else if (in_array($_SESSION['roleId'], ["3", "4", "8", "6", "9"])) {

                    $action .= $detail;
                } else {


                    $action .= $detail . $delEdit;

                    if ($value["isFinished"] == 3) {

                        $action .= "";
                    }
                }

                $doc = "";
                if (in_array($_SESSION['roleId'], ["5", "8", "9"])) {

                    $doc = '
                        <td style="width : 10%;">' . $value["dateParametre"] . '</td> 
                        <td style="width : 10%;">' . $value["dateDocteur"] . '</td> 
                    ';
                }


                if (in_array($_SESSION['roleId'], ["1", "2", "3", "4"])) {

                    $doc = '
                        <td style="width : 10%;">' . $value["dateParametre"] . '</td> 
                        
                    ';
                }


                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $i . ' </td>
                        <td style="width : 20%;">' . $value["nom"] . ' </td>
                        <td style="width : 10%;">' . $value["genre"] . ' </td>
                        <td style="width : 15%;">' . $value["TypepersonneMalade"] . ' </td>
                        <td style="width : 20%;">' . $value["motif"] . ' </td>
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 
                        ' . $doc . '
                        <td style="width : 10%;">' . $etat . '</td> 
                        <td style="width : 10%;"> ' . $action . '
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
                ->where("consultation.consultationId", $_POST["idconsultation"])
                ->first();



            $response = [
                'roleId' => $this->session->get("roleId"),
                'isFinished' => $data["isFinished"],
                'typeConsultationId' => $data["typeConsultationId"],
                'isEchographie' => $data["isEchographie"],
                'isLabo' => $data["isLabo"],
                'table' => $th,
                'docteur' => $data["doc_full_name"],
                'num_carte' => "Carte N° : " . $this->genererNumeroCarte($data["nom_membre"], $data["titulaireId"]),
                'titulaireId' => $data["titulaireId"]
            ];

            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function downloadFile()
    {
        $fileName = $_POST["fileName"];

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
                ->select("dateEnvoie , id_user ,typeDestinataire , docteurEchographie, typeEchographie , dateValidation , Source , resultats , rc , natureExamen , idenvoie_labo , typeEnvoie,idType , resultatTelechargeable")
                ->where("etat", 1)
                ->where("idType", $_POST["idType"]);

            if ($_POST["type"] == "visite") {

                $datas =  $datas->where("typeEnvoie", "visite");
            } else {
                $datas = $datas->where("typeEnvoie", "cpn");
            }

            $datas = $datas->findAll();


            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Nature/Echographie</th>
                            <th>Resultats</th>
                            <th>R.C</th>
                            <th>Date envoie</th>
                            <th>Date validation</th>
                            <th>Prescripteur</th>
                            <th>échographiste</th>
                            <th>Analyse</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";
            $i = 1;
            foreach ($datas as $value) {

                if (in_array($_SESSION['roleId'], ["6"])) {

                    if ($value["typeDestinataire"] != 'Laboratoire') {

                        continue;
                    }
                }

                if (in_array($_SESSION['roleId'], ["10"])) {

                    if ($value["typeDestinataire"] == 'Laboratoire') {

                        continue;
                    }
                }


                if ($value["typeDestinataire"] != "Laboratoire") {


                    $analysesString = $value["typeEchographie"];
                } else {
                    # code...
                    $natureExamen = $value["natureExamen"];
                    if (strpos($natureExamen, ',') !== false) {
                        // Si plusieurs valeurs sont présentes, on les sépare avec explode
                        $ids = explode(',', $natureExamen);
                    } else {
                        // Si une seule valeur est présente, on la place dans un tableau
                        $ids = [$natureExamen];
                    }



                    //var_dump($ids) ; die;

                    $analyses = $this->analyse
                        ->select('analyse')
                        ->whereIn('id_analyse', $ids)->findAll();


                    $analysesArray = array_column($analyses, 'analyse');
                    $analysesString = implode(', ', $analysesArray);
                }

                $validerLabo = '';
                $demande = '';
                $delEdit = '<a class="info mr-1" id="labedit' . $value["idenvoie_labo"] . '" data-docteurechographie = "' . $value["docteurEchographie"] . '" data-typeechographie = "' . $value["typeEchographie"] . '" data-typedestinataire = "' . $value["typeDestinataire"] . '" data-nature= ' . json_encode(explode(',', $value["natureExamen"])) . ' data-resultats= "' . $value["resultats"] . '" data-rc= "' . $value["rc"] . '" onclick="edit_laboratoire(' . $value["idenvoie_labo"] . ')"><i class=" la la-pencil-square-o"></i></a>
                <a class="danger mr-1" onclick="delete_labo(' . $value["idenvoie_labo"] . ')"><i class=" la la-trash-o"></i></a> ';


                if ($value["dateValidation"] == "") {

                    $demande = '<a class="danger mr-1" >En attente</a>';

                    $delEdit = $delEdit;


                    if (in_array($_SESSION['roleId'], ["6", "10"])) {

                        if (in_array($_SESSION['roleId'], ["5"])) {

                            $delEdit = $delEdit;
                        } else {

                            $delEdit = "";
                        }
                        $validerLabo = '<a class="success mr-1" data-typeenvoie = "' . $value["typeEnvoie"] . '" id="labovalider' . $value["idenvoie_labo"] . '" onclick="valider_demande(' . $value["idenvoie_labo"] . ',' . $value["idType"] . ') "><i class=" la la-check-circle"></i>Valider</a>';
                    }
                } else {

                    $filePath = 'assets/img/labo/' . $value["resultatTelechargeable"];
                    if ($value["resultatTelechargeable"] != "") {
                        $demande = '<a class="success mr-1" data-file = "' . $value['resultatTelechargeable'] . '" id="idlabed' . $value["idenvoie_labo"] . '" onclick="downloadFile(' . $value["idenvoie_labo"] . ')"><i class="la la-download"></i>Télécharger</a>';
                    } else {
                        $demande = '<a class="danger mr-1" >Fichier non disponible</a>';
                    }

                    $validerLabo = '';
                    if (in_array($_SESSION['roleId'], ["5"])) {

                        $delEdit = $delEdit;
                    }
                }

                $user = $this->utilisateur->select("CONCAT(nom_user, ' ', prenom_user) AS full_name")->find($value["id_user"]);
                $user1 = $this->utilisateur->select("CONCAT(nom_user, ' ', prenom_user) AS full_name")->find($value["docteurEchographie"] ?? 0);


                $fullname = $user ? $user['full_name'] : '';
                $fullname1 = $user1 ? $user1['full_name'] : '';

                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $i . ' </td>
                        <td style="width : 10%;">' . $value["typeDestinataire"] . ' </td>
                        <td style="width : 10%;">' . $analysesString . ' </td>
                        <td style="width : 10%;">' . $value["resultats"] . ' </td>
                        <td style="width : 10%;">' . $value["rc"] . ' </td>
                        <td style="width : 20%;">' . $value["dateEnvoie"] . ' </td>
                        <td style="width : 10%;">' . $value["dateValidation"] . ' </td>
                        <td style="width : 10%;">' . $fullname . '</td> 
                        <td style="width : 10%;">' . $fullname1 . '</td> 
                        <td style="width : 10%;">' . $demande . '</td> 
                        <td style="width : 10%;">' . $validerLabo . $delEdit . '</td> 

                        </td> 
                       </tr>';
                $i++;
            }

            $th .= "</tbody> ";

            if (in_array($_SESSION['roleId'], ["5", "3", "4", "8"])) {


                $hide = '';
            } else {

                $hide = ' hidden';
            }

            $response = [
                "hide" => $hide,
                'table' => $th,

            ];

            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_medicament()
    {
        try {


            $datas = $this->detailMedicament
                ->select("detailMedicament.* , article.designation ,  article.id_article , article.dateperemption , adminmedicament.adminMedicament")
                ->join("article", "article.id_article = detailMedicament.medicamentId", "left")
                ->join("adminmedicament", "adminmedicament.idAdminMedicament = detailMedicament.idAdministration", "left")
                ->where("detailMedicament.etat", 1)
                ->where("detailconsultationId", $_POST["id"]);

            $datas = $datas->findAll();


            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Designation</th>
                            <th>Administration</th>
                            <th>Qte</th>
                            <th>Date peremption</th>
                            <th>Mode de prise</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";

            $medicsuperieurzero = 0;

            foreach ($datas as $value) {
                $medicsuperieurzero = 1;

                $delEdit = '';


                if (in_array($_SESSION['roleId'], ["8", "5"])) {

                    $delEdit = '<a class="info mr-1" id="medicedit' . $value["detailMedicamentId"] . '" data-modePrise= ' . $value["modePrise"] . ' data-idadministration= "' . $value["idAdministration"] . '" data-durrejours= "' . $value["durreJours"] . '" data-qte= "' . $value["qte"] . '" data-medicamentId= "' . $value["medicamentId"] . '" onclick="edit_medic(' . $value["detailMedicamentId"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="danger mr-1" onclick="delete_medic(' . $value["detailMedicamentId"] . ')"><i class=" la la-trash-o"></i></a> ';
                }


                $th .=
                    '<tr>
                        <td style="width : 10%;">' .  $this->genererNumeroCarte("MED", $value["id_article"]) . ' </td>
                        <td style="width : 10%;">' . $value["designation"]  . ' </td>
                        <td style="width : 10%;">' . $value["adminMedicament"]  . ' </td>
                        <td style="width : 10%;">' . $value["qte"] . ' </td>
                        <td style="width : 10%;">' . $value["dateperemption"] . ' </td>
                        <td style="width : 20%;">' . $value["modePrise"] . ' </td>
                        <td style="width : 10%;">' . $delEdit . '</td> 

                        </td> 
                       </tr>';
            }

            $th .= "</tbody> ";



            $response = [
                "roleId" => $_SESSION['roleId'],
                'table' => $th,
                'ishide' => $medicsuperieurzero,

            ];

            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function valider_envoie_labo()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

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

                if ($_POST["typeDestinataire"] == "Echographie") {
                    $this->detailconsultation->update($_POST["idType"], ["isEchographie" => 2]);
                } else {
                    $this->detailconsultation->update($_POST["idType"], ["isLabo" => 2]);
                }



                $this->verif_visite($_POST["idConsult"], $db);
            } else {

                if ($_POST["typeDestinataire"] == "Echographie") {
                    $this->detailconsultationcpn->update($_POST["idType"], ["isEchographie" => 2]);
                } else {
                    $this->detailconsultationcpn->update($_POST["idType"], ["isLabo" => 2]);
                }

                $this->verif_CPN($_POST["idConsult"], $db);
            }

            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
               throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
            }


            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            $db->transRollback();

            echo $th;
        }
    }


    public function verif_visite($idConsul, $db)
    {



        $datas = $this->detailconsultation
            ->where("detailconsultation.consultationId", $idConsul)
            ->where('etat', 1)
            ->findAll();


        $isLaboPresent = false;
        $isEchoPresent = false;


        foreach ($datas as $rows) {


            $data = $this->envoieLbo
                ->select("envoie_labo.idType , envoie_labo.typeDestinataire")
                ->where("idType", $rows["detailConsultationId"])
                ->where("envoie_labo.typeEnvoie", 'visite')
                ->where('envoie_labo.etat', 1)
                ->findAll();

            // Initialiser des variables de vérification
            $laboratoireExiste = false;
            $echographieExiste = false;

            foreach ($data as $row) {
                if ($row['typeDestinataire'] === 'Laboratoire') {
                    $laboratoireExiste = true;
                }
                if ($row['typeDestinataire'] === 'Echographie') {
                    $echographieExiste = true;
                }
            }

            // Vérification des trois cas
            if ($laboratoireExiste && $echographieExiste) {
                $this->detailconsultation->update($rows['detailConsultationId'], ["isLabo" => 1, "isEchographie" => 1]);
                $isLaboPresent = $isLaboPresent || true;
                $isEchoPresent = $isEchoPresent || true;
            } elseif ($laboratoireExiste && !$echographieExiste) {
                $this->detailconsultation->update($rows['detailConsultationId'], ["isLabo" => 1, "isEchographie" => 0]);
                $isLaboPresent = $isLaboPresent || true;
                $isEchoPresent = $isEchoPresent || false;
            } elseif ($echographieExiste && !$laboratoireExiste) {
                $this->detailconsultation->update($rows['detailConsultationId'], ["isEchographie" => 1, "isLabo" => 0]);
                $isEchoPresent = $isEchoPresent || true;
                $isLaboPresent = $isLaboPresent || false;
            }
        }

        if (!$isLaboPresent) {
            $this->consultation->update($idConsul, ["isLabo" => 0]);
        } else {

            $this->consultation->update($idConsul, ["isLabo" => 1]);
        }
        if (!$isEchoPresent) {
            $this->consultation->update($idConsul, ["isEchographie" => 0]);
        } else {

            $this->consultation->update($idConsul, ["isEchographie" => 1]);
        }


        // Valider la transaction
        $db->transComplete();

        // Vérifier si la transaction s'est bien déroulée
        if ($db->transStatus() === FALSE) {
           throw new \Exception('Erreur dans la transaction. Détails : ' . json_encode($db->error()));
        }
    }
}
