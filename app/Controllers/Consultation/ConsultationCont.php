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
            $id = $this->consultation->save($_POST);
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

    public function charge_specialite()
    {
        try {

            $data =  $this->specialite->where("etat" ,  1 )->findAll();

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
    public function charge_cabinet()
    {
        try {

            $data =  $this->cabinet->where("etat" ,  1 )->findAll();

            $cabinet = '';
                foreach ($data as $value) {
                    $cabinet .= '
                        <option value="' . $value['id_cabinet'] . '"> '. $value['nom_cabinet'] . '</option> ';
                }

            echo $cabinet;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function charge_patient()
    {
        try {

            $data =  $this->patient->where("etat" ,  'Assure' )->where("id_membre" , $_POST["id_membre"])->findAll();

            $patient = '';

                foreach ($data as $value) {
                    $patient .= '
                        <option value="' . $value['numero_patient'] . '"> '. $value['nom'] ." ". $value['prenom'] . '</option> ';
                }
            

            echo $patient;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_medecin()
    {
        try {

            $data =  $this->medecin->where("etat" ,  1 )->findAll();

            $medecin = '';

                foreach ($data as $value) {
                    $medecin .= '
                        <option value="' . $value['id_medecin'] . '"> '. $value['nom_medecin'] . '</option> ';
                }

            echo $medecin;
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
            ->select("titulaire.nom,titulaire.prenom,typeconsultation.designtypeconsultation,utilisateur.nom_user , utilisateur.prenom_user, consultation.*")
            ->join("utilisateur" , "utilisateur.id_user = consultation.docteurId")
            ->join("titulaire" , "consultation.titulaireId = titulaire.titulaireId")
            ->join("typeconsultation" , "consultation.typeConsultationId = typeconsultation.idtypeconsultation")
            ->join("membre" , "membre.id_membre = titulaire.membreId")
            ->where('membre.id_membre', $_POST["id_membre"] ) ;

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

            $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];


            $th = "
                    <thead>
                      <tr>
                            <th>Carte N°</th>
                            <th>Titulaire</th>
                            <th>Docteur</th>
                            <th>Type</th>
                            <th>Nbr Patient</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $value["consultationId"] . ' </td>
                        <td style="width : 20%;">' . $value["nom"] ." ". $value["prenom"] . ' </td>
                        <td style="width : 20%;">' . $value["nom_user"] ." ". $value["prenom_user"] . ' </td>
                        <td style="width : 15%;">' . $value["designtypeconsultation"] . ' </td>
                        <td style="width : 10%;">' . 5 . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 

                        <td style="width : 10%;"> 
                        <a class="info mr-1"  onclick="liste_patient( ' . $value["consultationId"] . ' ,' . $value["isFinished"] . ')"><i class=" la la-list"></i></a>
                        <a class="info mr-1"  onclick="edit_consultation(' . 1 . ')"><i class=" la la-pencil"></i></a>

                        <a class="danger mr-1" onclick="supprimerconsultation(' . $value["consultationId"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
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
            ->join("titulaire", "titulaire.titulaireId = detailconsultation.titulaireId", "left")
            ->join("enfant", "enfant.enfantId = detailconsultation.enfantId", "left")
            ->where('detailconsultation.consultationId', $_POST["idconsultation"] )
            ->findAll();

            var_dump($datas); die;

            $th = "
                    <thead>
                      <tr>
                            <th>#</th>
                            <th>Nom - prenoddm</th>
                            <th>Genre</th>
                            <th>Nbr Patient</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $value["consultationId"] . ' </td>
                        <td style="width : 20%;">' . $value["nom"] ." ". $value["prenom"] . ' </td>
                        <td style="width : 20%;">' . $value["nom_user"] ." ". $value["prenom_user"] . ' </td>
                        <td style="width : 15%;">' . $value["designtypeconsultation"] . ' </td>
                        <td style="width : 10%;">' . 5 . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td> 

                        <td style="width : 10%;"> <a class="info mr-1"  onclick="edit_consultation(' . 1 . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimerconsultation(' . $value["consultationId"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
