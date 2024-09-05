<?php

namespace App\Controllers\consultation;

use App\Controllers\BaseController;

class ConsultationCont extends BaseController
{
    public function index()
    {

        $content = view('consultation/index');
        return view('layout', ['content' => $content]);
    }
    public function lien()
    {

        return view('consultation/index');
    }


    public function ajout_consultation()
    {
        try {

            

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
    public function delete_detailconsul()
    {
        try {

            $id = $_POST['id'];
            $this->detailconsultation->update($id, ['etat' => 0]);

            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
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

            $data =  $this->detailconsultation->find( $_POST["id"]);

            echo json_encode($data);
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

    public function add_Examen()
    {
        try {
            $_POST["natureExamen"] = implode(",",$_POST["nature"]);
            $_POST["isFinished"] = 2;
            $_POST["dateParametre"] = date("Y-m-d H:i:s");
            $data =  $this->detailconsultation->update( $_POST["idDetails"] , $_POST);

            echo json_encode($data);

        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_titulaire()
    {
        try {

            $data =  $this->titulaire
            ->select(" titulaire.titulaireId , CONCAT(titulaire.nom, ' ', titulaire.prenom) AS full_name, 
                    CONCAT(UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS code")
            ->where("titulaire.etat", '1')
            ->where("titulaire.isActif", '1')
            ->where("titulaire.membreId", $_POST["id_membre"])
            ->join("membre", "membre.id_membre = titulaire.membreId")
            ->findAll();

            $cabinet = '';
                foreach ($data as $value) {
                    $cabinet .= '
                        <option value="' . $value['titulaireId'] . '"> '. $value['code'] ." ". $value['full_name'] . '</option> ';
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

            if ($this->session->get("roleId") == "2") {
                
                $data =  $this->analyse
                ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                ->where("analyse.etat" ,  '1' )->like("role_user" , "2")->groupBy("id_type_analyse")
                ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse");
                $data = $data->findAll();

                foreach ($data as $value) {
                    $datas =  $this->analyse
                    ->where("etat" ,  '1' )
                    ->where("type_analyse" ,  $value["id_type_analyse"] )
                    ->like("role_user" , "2")
                    ->findAll();

                    $patient .= "<optgroup label= '{$value['nom_type_analyse']}'>";

                    
                    foreach ($datas as $values) {
                        $patient .= '
                        <option value="' . $values['type_analyse'] . '"> '. $values['analyse'] . '</option> ';
                    }
                    
                    $patient .= `</optgroup>`;
                }

            }elseif ($this->session->get("roleId") == "3") {
                $data =  $this->analyse
                ->select("type_analyse.nom_type_analyse , type_analyse.id_type_analyse")
                ->where("analyse.etat" ,  '1' )->like("role_user" , "3")
                ->join("type_analyse", "type_analyse.id_type_analyse = analyse.type_analyse")
                ->groupBy("id_type_analyse");
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
                ->join("enfant", "enfant.titulaireId = titulaire.titulaireId");
                $data = $data->findAll();

                // 0 : enfant , 1 : parent , 2 : titulaire , 3 : conjoint
                foreach ($data as $value) {
                    $patient .= "<optgroup label= 'Titulaire'>";

                    $patient .= '<option value="' . $value['titulaireId'] . '_Titulaire">'. $value['nom_titulaire'] . '</option> ';
                    $patient .= `</optgroup>`;

                    $patient .= "<optgroup label= 'Conjoint'>";

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
            ->select(" membre.id_membre , CONCAT(UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS code , titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
            ->join("utilisateur" , "utilisateur.id_user = consultation.docteurId")
            ->join("titulaire" , "consultation.titulaireId = titulaire.titulaireId")
            ->join("typeconsultation" , "consultation.typeConsultationId = typeconsultation.idtypeconsultation")
            ->join("membre" , "membre.id_membre = titulaire.membreId")
            ->where('membre.id_membre', $_POST["id_membre"] ) ;

            }else{


                $datas =  $datas
            ->where('consultation.etat', 1)
            ->select(" membre.id_membre , CONCAT(UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS code ,titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
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
                            <th>Etat</th> " ;
                       
                            $th .= "<th>Action</th>";

                    
                       $th .= "</tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {

                if ( $value["isFinished"] == 0 ) {
                    $etat = "En attente parametre";
                }
                else if(  $value["isFinished"] == 2){
                    
                    $etat = "En attente labo";
    
                }
                else if(  $value["isFinished"] == 1){
                    
                    $etat = "En attente docteur";
    
                }
                else if(  $value["isFinished"] == 3){
                    
                    $etat = "En attente pharmacie";
    
                }
                else if(  $value["isFinished"] == 4){
                    
                    $etat = "Termine";
    
                }

                $count = $this->detailconsultation
                ->where('detailconsultation.consultationId', $value["consultationId"])
                ->where('detailconsultation.titulaireId', $value["titulaireId"])
                ->where("etat" , 1)
                ->countAllResults();

                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $value["code"] . ' </td>
                        <td style="width : 20%;">' . $value["nom"] ." ". $value["prenom"] . ' </td>
                        <td style="width : 20%;">' . $value["nom_user"] ." ". $value["prenom_user"] . ' </td>
                        <td style="width : 15%;">' . $value["designtypeconsultation"] . ' </td>
                        <td style="width : 10%;">' . $count . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 
                        <td style="width : 10%;">' . $etat . '</td>  
                        <td style="width : 10%;"> 
                            <a class="info mr-1"  onclick="liste_patient( ' . $value["consultationId"] . ' ,' . $value["isFinished"] . ')"><i class=" la la-list"></i></a>' ;

                        if ($this->session->get("roleId") == "1" || $this->session->get("roleId") == "5") {
                            
                            $th .= '
                            <a class="info mr-1"  onclick="edit_consultation(' . $value["consultationId"] . ' , ' . $value["id_membre"] . ' , ' . $value["titulaireId"] . ' , ' . $value["docteurId"] . ' , ' . $value["typeConsultationId"] . ')"><i class=" la la-pencil-square-o"></i></a>
    
                            <a class="danger mr-1" onclick="supprimerconsultation(' . $value["consultationId"] . ')"><i class=" la la-trash-o"></i></a> ' ;

                        }

                        
                       $th .= '</td> </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function verifConsultation($idConsultation)
    {
        $datas = $this->detailconsultation
            ->where('detailconsultation.consultationId', $idConsultation )
            ->findAll();

            $arr = [];

            foreach ($datas as $value) {
                
                $arr = $value["isFinished"] ; 
            }

            if (array_key_exists( 0 , $arr)) {
                $this->consultation->update($idConsultation, ['isFinished' => 0]);
            }
            else if( array_key_exists( 2 , $arr) ){
                
                $this->consultation->update($idConsultation, ['isFinished' => 2]);

            }
            else if( array_key_exists( 1 , $arr) ){
                
                $this->consultation->update($idConsultation, ['isFinished' => 1]);

            }
            else if( array_key_exists( 3 , $arr) ){
                
                $this->consultation->update($idConsultation, ['isFinished' => 3]);

            }
            else if( array_key_exists( 4 , $arr) ){
                
                $this->consultation->update($idConsultation, ['isFinished' => 4]);

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

            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Nom - Prenom</th>
                            <th>Genre</th>
                            <th>Type</th>
                            <th>Motif</th>
                            <th>Creation</th>
                            <th>Parametrage</th>
                            <th>Labo</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";
            $i = 1 ;
            foreach ($datas as $value) {

                if ($value["isFinished"] == '0') {
                    
                    $etat = 'En attente paramétre';
                    
                }else if($value["isFinished"] == '1'){
                    
                   
                    $etat = 'En attente docteur';
                    
            
                }else if($value["isFinished"] == '2'){
                    
                    $etat = 'En attente labo';
                    
                }else{
                    $etat = 'En attente pharmacie';
                }

                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $i . ' </td>
                        <td style="width : 20%;">' . $value["nom"]. ' </td>
                        <td style="width : 10%;">' . $value["genre"] . ' </td>
                        <td style="width : 15%;">' . $value["TypepersonneMalade"] . ' </td>
                        <td style="width : 20%;">' . $value["motif"] . ' </td>
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 
                        <td style="width : 10%;">' . $value["dateParametre"] . '</td> 
                        <td style="width : 10%;">' . $value["dateLaboratoire"] . '</td> 
                        <td style="width : 10%;">' . $etat . '</td> 
                        <td style="width : 10%;"> 

                        <a class="info mr-1" onclick="edit_patient(' . $value["detailConsultationId"] . ')"><i class=" la la-pencil-square-o"></i></a>
                        <a class="info mr-1"  onclick="parametre(' . $value["detailConsultationId"] . ')"><i class=" la la-cog"></i></a>
                        <a class="info mr-1" id="nat'.$value["detailConsultationId"].'" data-motif= "'.$value["motif"].'" data-personne='.json_encode(implode('_', [ $value["idPersonneMalade"] ,$value["TypepersonneMalade"] ])).' data-nature='.json_encode(explode(',', $value["natureExamen"])).'  onclick="laboratoire(' . $value["detailConsultationId"] . ')"><i class=" la la-microscope"></i></a>
                        <a class="danger mr-1" onclick="delete_detailvisite(' . $value["detailConsultationId"] . ')"><i class=" la la-trash-o"></i></a> 
                        </td> 
                       </tr>';
            $i++;
            }

            $th .= "</tbody> ";


            $data =  $this->consultation
            ->select("consultation.* ,CONCAT('Carte N° : ',UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS num_carte , CONCAT('Docteur : ',utilisateur.nom_user , ' ', utilisateur.prenom_user , ' ( ' , typeMedecin.name , ' )') AS doc_full_name")
            ->join("titulaire", "consultation.titulaireId = titulaire.titulaireId")
            ->join("membre", "membre.id_membre = titulaire.membreId")
            ->join("utilisateur", "consultation.docteurId = utilisateur.id_user")
            ->join("typeMedecin", "typeMedecin.idTypeMedecin = utilisateur.idTypeMedecin")
            ->where("consultation.consultationId" , $_POST["idconsultation"])
            ->first();



            $response = [
                'table' => $th,
                'docteur' => $data["doc_full_name"],
                'num_carte' => $data["num_carte"],
                'titulaireId' => $data["titulaireId"]
            ];
            
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
