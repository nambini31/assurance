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

            $this->consultation->where('id_consultation', $id)->delete();

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
            ->select("medecin.nom_medecin ,membre.id_membre, patient.nom , patient.prenom, consultation.*")
            ->join("medecin" , "medecin.id_medecin = consultation.id_medecin")
            ->join("patient" , "consultation.numero_patient = patient.numero_patient")
            ->join("membre" , "membre.id_membre = patient.id_membre")
            ->where('membre.id_membre', $_POST["id_membre"] ) ;

            }

            if ($_POST["date_debut"] != "" ) {
                
                $datas = $datas
                ->where("date(consultation.created_at) >= ", $_POST["date_debut"] );

            }
            if ( $_POST["date_fin"] != "") {
                
                $datas = $datas
                ->where("date(consultation.created_at) <= ", $_POST["date_fin"] );

            }

            $datas = $datas->findAll();

            $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];


            $th = "
                    <thead>
                      <tr>
                            <th>Numero</th>
                            <th>Nom prenom</th>
                            <th>Medecin</th>
                            <th>Motif</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $value["numero_patient"] . ' </td>
                        <td style="width : 20%;">' . $value["nom"] ." ". $value["prenom"] . ' </td>
                        <td style="width : 20%;">' . $value["nom_medecin"] . '</td> 
                        <td style="width : 30%;">' . $value["motif"] . '</td> 
                        <td style="width : 10%;">' . $value["created_at"] . '</td> 

                        <td style="width : 10%;"> <a class="info mr-1" data-id_membre="'.$value["id_membre"] .'" data-id_medecin="'.$value["id_medecin"] .'" data-numero_patient = "'.$value["numero_patient"] .'"  data-motif="'.$value["motif"] .'"   id="cons_'.$value["id_consultation"] .'"  onclick="edit_consultation(' . $value["id_consultation"] . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimerconsultation(' . $value["id_consultation"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                       </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
