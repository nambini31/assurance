<?php

namespace App\Controllers\pf;

use App\Controllers\BaseController;

class PfCont extends BaseController
{
    public function index()
    {

        $content = view('pf/index');
        return view('layout', ['content' => $content]);
    }
    public function lien()
    {

        return view('pf/index');
    }


    public function ajout_pf()
    {
        try {

            $_POST["id_user"] = $this->session->get("id_user");
            
            $data = explode("_",$_POST["personne"]);
            $_POST["enfantId"] = $data[0];

            $_POST["typePersonne"] = $data[1];

            $this->pf->save($_POST);


            echo json_encode(["id" => 1]);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function charge_methode_contraceptive()
    {
        try {

            $data =  $this->methodePf
            ->where("etat" ,  1 )
            ->findAll();

            $membre = '';

                foreach ($data as $value) {
                    $membre .= '
                        <option value="' . $value['idmethodePf'] . '"> '. $value['methodePf'] . '</option> ';
                }

            echo $membre;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete_pf()
    {
        try {

            $id = $_POST['id_pf'];
            $this->pf->update($id, ['etat' => 0]);

            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function liste_pf()
    {
        try {
            $datas = $this->pf ;
            
            if ($_POST["id_membre"] != "" ) {
                
                $datas = $datas
    ->select("membre.id_membre , membre.nom_membre, methodePf ,
              CASE 
                  WHEN pf.Typepersonne = 'Titulaire' THEN CONCAT(titulaire.nom, ' ', titulaire.prenom)
                  WHEN pf.Typepersonne = 'Conjoint(e)' THEN titulaire.nomprenomconjoint
                  WHEN pf.Typepersonne IN ('Enfant', 'Parent') THEN CONCAT(enfant.nom, ' ', enfant.prenom)
                  ELSE 'Non spécifié'
              END AS nom,
              CASE 
                  WHEN pf.Typepersonne = 'Titulaire' THEN titulaire.fonction
                  WHEN pf.Typepersonne = 'Conjoint(e)' THEN titulaire.fonctionConjoint
                  ELSE titulaire.fonction 
              END AS fonction, 
              titulaire.adresse, 
              pf.*")
    ->where('pf.etat', 1)
    ->join("titulaire", "pf.titulaireId = titulaire.titulaireId ", "left")
    ->join("methodePf", "pf.idmethodePf = methodePf.idmethodePf ", "left")
    ->join("enfant", "enfant.enfantId = pf.enfantId AND enfant.titulaireId = titulaire.titulaireId AND pf.Typepersonne IN ('Enfant', 'Parent')", "left")
    ->join("membre", "membre.id_membre = titulaire.membreId", "left")
            ->where('membre.id_membre', $_POST["id_membre"] ) ;

            }else{


                $datas = $datas
    ->select("membre.id_membre , membre.nom_membre, methodePf ,
              CASE 
                  WHEN pf.Typepersonne = 'Titulaire' THEN CONCAT(titulaire.nom, ' ', titulaire.prenom)
                  WHEN pf.Typepersonne = 'Conjoint(e)' THEN titulaire.nomprenomconjoint
                  WHEN pf.Typepersonne IN ('Enfant', 'Parent') THEN CONCAT(enfant.nom, ' ', enfant.prenom)
                  ELSE 'Non spécifié'
              END AS nom,
              CASE 
                  WHEN pf.Typepersonne = 'Titulaire' THEN titulaire.fonction
                  WHEN pf.Typepersonne = 'Conjoint(e)' THEN titulaire.fonctionConjoint
                  ELSE titulaire.fonction 
              END AS fonction, 
              titulaire.adresse, 
              pf.*")
    ->where('pf.etat', 1)
    ->join("titulaire", "pf.titulaireId = titulaire.titulaireId ", "left")
    ->join("methodePf", "pf.idmethodePf = methodePf.idmethodePf ", "left")
    ->join("enfant", "enfant.enfantId = pf.enfantId AND enfant.titulaireId = titulaire.titulaireId AND pf.Typepersonne IN ('Enfant', 'Parent')", "left")
    ->join("membre", "membre.id_membre = titulaire.membreId", "left");

            }

            if ($_POST["date_debut"] != "" ) {
                
                $datas = $datas
                ->where("date(pf.createdAt) >= ", $_POST["date_debut"] );

            }
            if ( $_POST["date_fin"] != "") {
                
                $datas = $datas
                ->where("date(pf.createdAt) <= ", $_POST["date_fin"] );

            }

            $datas = $datas->findAll();

             // $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];
            $ctegorie =  $datas ;


            $th = "
                    <thead>
                      <tr>
                            <th>PF N°</th>
                            <th>Carte N°</th>
                            <th>Nom - Prenom</th>
                            <th>Type</th>
                            <th>Taille</th>
                            <th>Poids</th>
                            <th>Tension</th>
                            <th>Methode PF</th>
                            <th>Date Rendez-vous</th>
                            <th>Date</th>" ;
                       
                            $th .= "<th>Action</th>";

                    
                       $th .= "</tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {


                $th .=
                    '<tr>
                        <td style="width : 10%;">' .  $this->genererNumeroCarte("PF", $value["idpf"]) . ' </td>
                        <td style="width : 10%;">' .  $this->genererNumeroCarte($value["nom_membre"], $value["titulaireId"]) . ' </td>
                        <td style="width : 20%;">' . $value["nom"] .' </td>
                        <td style="width : 20%;">' . $value["typePersonne"] .' </td>
                        <td style="width : 20%;">' . $value["taille"] .' </td>
                        <td style="width : 20%;">' . $value["poids"] .' </td>
                        <td style="width : 20%;">' . $value["tension"] .' </td>
                        <td style="width : 10%;">' . $value["methodePf"] . '</td> 
                        <td style="width : 10%;">' . $value["dateRendezVous"] . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td>  
                        <td style="width : 10%;"> 
                        ' ;

                        if ($this->session->get("roleId") == "1" || $this->session->get("roleId") == "5") {
                            
                            $th .= '
                            <a class="info mr-1" 
                            id="pfF'.$value["idpf"].'"
                            data-personne='.json_encode(implode('_', [ $value["enfantId"] ,$value["typePersonne"] ])).'
                            data-taille="'. $value["taille"].'"
                            data-poids="'. $value["poids"].'"
                            data-tension="'. $value["tension"].'"
                            data-dateRendezvous="'. $value["dateRendezVous"].'"
                            
                            onclick="edit_cpn(' . $value["idpf"] . ' , ' . $value["id_membre"] . ' , ' . $value["titulaireId"] . ' , ' . $value["idmethodePf"] . ')"><i class=" la la-pencil-square-o"></i></a>
    
                            <a class="danger mr-1" onclick="supprimercpn(' . $value["idpf"] . ')"><i class=" la la-trash-o"></i></a> ' ;

                        }

                        
                       $th .= '</td> </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    
  
    
    
      
}
