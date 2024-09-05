<?php

namespace App\Controllers\cpn;

use App\Controllers\BaseController;

class CpnCont extends BaseController
{
    public function index()
    {

        $content = view('cpn/index');
        return view('layout', ['content' => $content]);
    }
    public function lien()
    {

        return view('cpn/index');
    }


    public function ajout_cpn()
    {
        try {

            

            $this->cpn->save($_POST);
            
            // Vérification si l'ID est présent dans $_POST (mise à jour)
            if (isset($_POST['cpnId']) && $_POST['cpnId'] != "" ) {
                $cpnId = $_POST['cpnId']; // ID de la cpn mise à jour
            } else {
                // Sinon, c'est une nouvelle insertion, on récupère l'ID inséré
                $cpnId = $this->cpn->insertID();

            }

            $consul = $this->cpn->find( $cpnId);


            echo json_encode($consul);

        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function add_detailcpn()
    {
        try {

            $this->detailconsultationcpn->save($_POST);

            echo json_encode(["id" => 1]);

        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function delete_cpn()
    {
        try {

            $id = $_POST['id_cpn'];
            $this->cpn->update($id, ['etat' => 0]);

            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function delete_detailcpn()
    {
        try {

            $id = $_POST['id'];
            
            $this->detailconsultationcpn->update($id, ['etat' => 0]);

            echo json_encode(['id' => 1]);

        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function affiche_parametre()
    {
        try {

            $data =  $this->detailcpn->find( $_POST["id"]);

            echo json_encode($data);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function add_parametre()
    {
        try {
            $_POST["dateParametre"] = date("Y-m-d H:i:s");
            $data =  $this->detailcpn->update( $_POST["idDetailsCons"] , $_POST);

            echo json_encode($data);

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


    public function liste_cpn()
    {
        try {
            $datas = $this->cpn ;
            
            if ($_POST["id_membre"] != "" ) {
                
                $datas =  $datas
            ->where('cpn.etat', 1)
            ->select("membre.id_membre , CONCAT('CPN -', ' ', cpn.idcpn) as cpn,
            case 
            when cpn.Typepersonne = 'Titulaire' then CONCAT(titulaire.nom, ' ', titulaire.prenom)
            when cpn.Typepersonne = 'Conjoint(e)' then titulaire.nomprenomconjoint
            ELSE CONCAT(enfant.nom, ' ', enfant.prenom)
            END AS nom , CONCAT('UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS num ,

            case 
            when cpn.Typepersonne = 'Titulaire' then titulaire.fonction
            when cpn.Typepersonne = 'Conjoint(e)' then titulaire.fonctionConjoint
            ELSE titulaire.fonction END AS fonction , titulaire.adresse , cpn.* ")
            ->join("titulaire" , "cpn.titulaireId = titulaire.titulaireId")
            ->join("enfant", "enfant.enfantId = cpn.titulaire", "left")
            ->join("membre" , "membre.id_membre = titulaire.membreId")
            ->where('membre.id_membre', $_POST["id_membre"] ) ;

            }else{


                $datas =  $datas
                ->select("membre.id_membre , CONCAT('CPN -', ' ', cpn.idcpn) as cpn , case 
                when cpn.Typepersonne= 'Titulaire' then CONCAT(titulaire.nom, ' ', titulaire.prenom)
                when cpn.Typepersonne= 'Conjoint(e)' then titulaire.nomprenomconjoint
                ELSE CONCAT(enfant.nom, ' ', enfant.prenom)
                END AS nom , CONCAT(UPPER(LEFT(membre.nom_membre, 3)), '-', titulaire.titulaireId) AS num,
    
                case 
                when cpn.Typepersonne= 'Titulaire' then titulaire.fonction
                when cpn.Typepersonne= 'Conjoint(e)' then titulaire.fonctionConjoint
                ELSE titulaire.fonction END AS fonction , titulaire.adresse , cpn.* ")
                ->where('cpn.etat', 1)
                ->join("titulaire" , "cpn.titulaireId = titulaire.titulaireId")
                ->join("enfant", "enfant.enfantId = cpn.titulaireId", "left")
                ->join("membre" , "membre.id_membre = titulaire.membreId");

            }

            if ($_POST["date_debut"] != "" ) {
                
                $datas = $datas
                ->where("date(cpn.createdAt) >= ", $_POST["date_debut"] );

            }
            if ( $_POST["date_fin"] != "") {
                
                $datas = $datas
                ->where("date(cpn.createdAt) <= ", $_POST["date_fin"] );

            }

            $datas = $datas->findAll();

             // $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];
            $ctegorie =  $datas ;


            $th = "
                    <thead>
                      <tr>
                            <th>CPN N°</th>
                            <th>Carte N°</th>
                            <th>Nom - Prenom</th>
                            <th>Fonction</th>
                            <th>Adresse</th>
                            <th>Marié(e)</th>
                            <th>Date Presumee</th>
                            <th>Date</th>
                            <th>Etat</th> " ;
                       
                            $th .= "<th>Action</th>";

                    
                       $th .= "</tr></thead> 
                        <tbody>";

            foreach ($ctegorie as $value) {

                if ( $value["isFinished"] == 0 ) {
                    $etat = "En cours";
                }
                else {
                    
                    $etat = "Terminé";
    
                }
                if ( $value["mariee"]) {
                    $marie = "Non";
                }
                else {
                    
                    $marie = "Oui";
    
                }


                $th .=
                    '<tr>
                        <td style="width : 10%;">' . $value["cpn"] . ' </td>
                        <td style="width : 10%;">' . $value["num"] . ' </td>
                        <td style="width : 20%;">' . $value["nom"] .' </td>
                        <td style="width : 20%;">' . $value["fonction"] .' </td>
                        <td style="width : 20%;">' . $value["adresse"] .' </td>
                        <td style="width : 10%;">' . $marie. ' </td>
                        <td style="width : 10%;">' . $value["dateAccouchement"] . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td>  
                        <td style="width : 10%;">' . $etat . '</td>  
                        <td style="width : 10%;"> 
                            <a class="info mr-1"  onclick="liste_descendant( ' . $value["idcpn"] . ')"><i class=" las la-clipboard-list la-2x"></i></a>' ;

                        if ($this->session->get("roleId") == "1" || $this->session->get("roleId") == "5") {
                            
                            $th .= '
                            <a class="info mr-1"  onclick="consult_cpn(' . $value["idcpn"] . ')"><i class=" las la-stethoscope la-2x"></i></a>
                            <a class="info mr-1"  onclick="edit_cpn(' . $value["idcpn"] . ')"><i class=" la la-pencil-square-o"></i></a>
    
                            <a class="danger mr-1" onclick="supprimercpn(' . $value["idcpn"] . ')"><i class=" la la-trash-o"></i></a> ' ;

                        }

                        
                       $th .= '</td> </tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    
    public function listes_details_consult()
    {
        try {
            // Récupération des données correspondant à la consultation prénatale
            $datas = $this->detailconsultationcpn
                ->where('idcpn', $_POST["idcpn"])
                ->where('etat', "1")
                ->orderBy('num', 'ASC')  // Assurer que les consultations sont triées dans le bon ordre (1ère, 2ème, etc.)
                ->findAll();
        
            // Initialisation de chaque ligne du tableau avec la première colonne (les libellés des éléments de surveillance)
            $rows = [
                'Action' => "<tr><th style='text-align : left ; width : 10%'>Action</th>",
                'ta' => "<tr><th style='text-align : left ; width : 10%'>T.A</th>",
                'albOedemes' => "<tr><th style='text-align : left ; width : 10%'>ALB/Oedèmes</th>",
                'prisedepoids' => "<tr><th style='text-align : left ; width : 10%'>Prise de poids</th>",
                'ictereConjonctive' => "<tr><th style='text-align : left ; width : 10%'>Ictère (Conjonctives)</th>",
                'saignement' => "<tr><th style='text-align : left ; width : 10%'>Saignement</th>",
                'hauteurUterine' => "<tr><th style='text-align : left ; width : 10%'>Hauteur Utérine</th>",
                'bdfc' => "<tr><th style='text-align : left ; width : 10%'>BDFC</th>",
                'presentation' => "<tr><th style='text-align : left ; width : 10%'>Présentation</th>",
                'referenceAccouchement' => "<tr><th style='text-align : left ; width : 10%'>Référence pour accouchement</th>",
                'vat' => "<tr><th style='text-align : left ; width : 10%'>VAT</th>",
                'spi' => "<tr><th style='text-align : left ; width : 10%'>SPI</th>",
                'ferAcFolique' => "<tr><th style='text-align : left ; width : 10%'>Fer/Acide folique</th>",
                'albendazole' => "<tr><th style='text-align : left ; width : 10%'>Albendazole</th>",
                'vih' => "<tr><th style='text-align : left ; width : 10%'>VIH</th>",
                'bw' => "<tr><th style='text-align : left ; width : 10%'>BW</th>",
                'rechercheActive' => "<tr><th style='text-align : left ; width : 10%'>Recherche active</th>",
                'dateRendevous' => "<tr><th style='text-align : left ; width : 10%'>Date de rendez-vous</th>"
            ];
        
            // Tableau pour stocker les consultations par leur numéro
            $consultations = [];
        
            // Ajouter les consultations récupérées dans le tableau avec leur num comme clé
            foreach ($datas as $row) {
                $consultations[$row['num']] = $row;
            }
        
            // Construction des colonnes pour chaque consultation (1ère à 8ème)
            for ($i = 1; $i <= 8; $i++) {
                if (isset($consultations[$i])) {
                    $row = $consultations[$i];
                    $th = '
                    <a class="info mr-1"  id = "detailcpn' . $row["idconsultationcpn"] . '"
                    onclick="edit_detailcpn(' . $row["idconsultationcpn"] . ')" 
                    data-ta="' . $row["ta"] . '" 
                    data-num="' . $row["num"] . '" 
                    data-alboedemes="' . $row["albOedemes"] . '" 
                    data-prisedepoids="' . $row["prisedepoids"] . '" 
                    data-ictereconjonctive="' . $row["ictereConjonctive"] . '" 
                    data-saignement="' . $row["saignement"] . '" 
                    data-hauteuruterine="' . $row["hauteurUterine"] . '" 
                    data-bdfc="' . $row["bdfc"] . '" 
                    data-presentation="' . $row["presentation"] . '" 
                    data-referenceaccouchement="' . $row["referenceAccouchement"] . '" 
                    data-vat="' . $row["vat"] . '" 
                    data-spi="' . $row["spi"] . '" 
                    data-feracfolique="' . $row["ferAcFolique"] . '" 
                    data-albendazole="' . $row["albendazole"] . '" 
                    data-vih="' . $row["vih"] . '" 
                    data-bw="' . $row["bw"] . '" 
                    data-rechercheactive="' . $row["rechercheActive"] . '" data-daterendevous="' . $row["dateRendevous"] . '">
                    <i class="la la-pencil-square-o"></i>
                </a>
                        <a class="danger mr-1" onclick="delete_detailcpn(' . $row["idconsultationcpn"] . ')"><i class="la la-trash-o"></i></a>';
                    
                    $rows['Action'] .= "<td>{$th}</td>";
                    $rows['ta'] .= "<td>{$row['ta']}</td>";
                    $rows['albOedemes'] .= "<td>{$row['albOedemes']}</td>";
                    $rows['prisedepoids'] .= "<td>{$row['prisedepoids']}</td>";
                    $rows['ictereConjonctive'] .= "<td>{$row['ictereConjonctive']}</td>";
                    $rows['saignement'] .= "<td>{$row['saignement']}</td>";
                    $rows['hauteurUterine'] .= "<td>{$row['hauteurUterine']}</td>";
                    $rows['bdfc'] .= "<td>{$row['bdfc']}</td>";
                    $rows['presentation'] .= "<td>{$row['presentation']}</td>";
                    $rows['referenceAccouchement'] .= "<td>{$row['referenceAccouchement']}</td>";
                    $rows['vat'] .= "<td>{$row['vat']}</td>";
                    $rows['spi'] .= "<td>{$row['spi']}</td>";
                    $rows['ferAcFolique'] .= "<td>{$row['ferAcFolique']}</td>";
                    $rows['albendazole'] .= "<td>{$row['albendazole']}</td>";
                    $rows['vih'] .= "<td>{$row['vih']}</td>";
                    $rows['bw'] .= "<td>{$row['bw']}</td>";
                    $rows['rechercheActive'] .= "<td>{$row['rechercheActive']}</td>";
                    $rows['dateRendevous'] .= "<td>{$row['dateRendevous']}</td>";
                } else {
                    // Si la consultation pour ce numéro n'existe pas, ajouter une cellule vide
                    $rows['Action'] .= "<td></td>";
                    $rows['ta'] .= "<td></td>";
                    $rows['albOedemes'] .= "<td></td>";
                    $rows['prisedepoids'] .= "<td></td>";
                    $rows['ictereConjonctive'] .= "<td></td>";
                    $rows['saignement'] .= "<td></td>";
                    $rows['hauteurUterine'] .= "<td></td>";
                    $rows['bdfc'] .= "<td></td>";
                    $rows['presentation'] .= "<td></td>";
                    $rows['referenceAccouchement'] .= "<td></td>";
                    $rows['vat'] .= "<td></td>";
                    $rows['spi'] .= "<td></td>";
                    $rows['ferAcFolique'] .= "<td></td>";
                    $rows['albendazole'] .= "<td></td>";
                    $rows['vih'] .= "<td></td>";
                    $rows['bw'] .= "<td></td>";
                    $rows['rechercheActive'] .= "<td></td>";
                    $rows['dateRendevous'] .= "<td></td>";
                }
            }
        
            // Fermeture de chaque ligne
            foreach ($rows as &$row) {
                $row .= "</tr>";
            }
        
            // Construction finale du tableau
            $th = "
                <thead>
                    <tr>
                        <th style='text-align : left'>Éléments de Surveillance</th>
                        <th>1<sup>ère</sup></th>
                        <th>2<sup>ème</sup></th>
                        <th>3<sup>ème</sup></th>
                        <th>4<sup>ème</sup></th>
                        <th>5<sup>ème</sup></th>
                        <th>6<sup>ème</sup></th>
                        <th>7<sup>ème</sup></th>
                        <th>8<sup>ème</sup></th>
                    </tr>
                </thead>
                <tbody>
                    {$rows['Action']}
                    {$rows['ta']}
                    {$rows['albOedemes']}
                    {$rows['prisedepoids']}
                    {$rows['ictereConjonctive']}
                    {$rows['saignement']}
                    {$rows['hauteurUterine']}
                    {$rows['bdfc']}
                    {$rows['presentation']}
                    {$rows['referenceAccouchement']}
                    {$rows['vat']}
                    {$rows['spi']}
                    {$rows['ferAcFolique']}
                    {$rows['albendazole']}
                    {$rows['vih']}
                    {$rows['bw']}
                    {$rows['rechercheActive']}
                    {$rows['dateRendevous']}
                </tbody>";

                $datas =  $this->cpn->select("CONCAT('CPN -', ' ', cpn.idcpn) as cpn ")
                ->where('idcpn', $_POST["idcpn"] )->first() ;

                $data =  $this->detailconsultationcpn->select("num")
                ->where('idcpn', $_POST["idcpn"] )
                ->where('etat' , 1)
                ->findAll() ;

                if (empty($data)) {
                    // Si $datas est vide, créer un tableau vide
                    $nums = [];
                } else {
                    // Si $datas n'est pas vide, extraire les valeurs de 'num' et les stocker dans un autre tableau
                    $nums = array_column($data, 'num');
                }


            $response = [
                'nums' => $nums ,
                'table' => $th ,
                'num_cpn' => $datas["cpn"]
            ];

        
            // Envoi du tableau en JSON pour être traité par le DataTable
            echo json_encode($response);
        
        } catch (\Throwable $th) {
            echo $th;
        }
        
    }
    
    
      
}
