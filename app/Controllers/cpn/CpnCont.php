<?php

namespace App\Controllers\cpn;

use App\Controllers\BaseController;

class CpnCont extends BaseController
{
    public function index()
    {

        if (in_array($_SESSION['roleId'], ["5", "3", "4", "6", "9" , "10"])) {

            $content = view('cpn/index');
            return view('layout', ['content' => $content]);
        } else {
            echo view('Access/index');
            exit();
        }
    }
    public function lien()
    {

        return view('cpn/index');
    }


    public function ajout_cpn()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();
            $db->transComplete();

            $_POST["id_user"] = $this->session->get("id_user");

            $data = explode("_", $_POST["personne"]);
            $_POST["enfantId"] = $data[0];

            $_POST["typePersonne"] = $data[1];

            $this->cpn->save($_POST);


             // Valider la transaction
             $db->transComplete();

             // Vérifier si la transaction s'est bien déroulée
             if ($db->transStatus() === FALSE) {
                 throw new \Exception('Erreur dans la transaction.');
             }
             echo json_encode(['id' => 1]);
         } catch (\Throwable $th) {
             // En cas d'erreur, faire un rollback
             $db->transRollback();
 
             echo  $th;
         }
    }

    public function add_detailcpn()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $this->detailconsultationcpn->save($_POST);

            $this->verif_CPN($_POST["idcpn"], $db);

            // Valider la transaction
            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Erreur dans la transaction.');
            }
            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            // En cas d'erreur, faire un rollback
            $db->transRollback();

            echo  $th;
        }
    }


    public function delete_cpn()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $id = $_POST['id_cpn'];
            $this->cpn->update($id, ['etat' => 0]);

            $this->verif_CPN($id, $db);

            // Valider la transaction
            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Erreur dans la transaction.');
            }
            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            // En cas d'erreur, faire un rollback
            $db->transRollback();

            echo  $th;
        }
    }

    public function delete_detailcpn()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();


            $id = $_POST['id'];

            $this->detailconsultationcpn->update($id, ['etat' => 0]);

            $data = $this->detailconsultationcpn->select("idcpn")->find($id);

            $this->verif_CPN($data["idcpn"], $db);


            // Valider la transaction
            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Erreur dans la transaction.');
            }
            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
            // En cas d'erreur, faire un rollback
            $db->transRollback();

            echo  $th;
        }
    }


    public function add_cpnParam()
    {
        $db = \Config\Database::connect();  // Connexion à la base de données

        try {
            // Démarrer la transaction
            $db->transStart();

            $data =  $this->cpn->update($_POST["idcpn"], $_POST);


            // Valider la transaction
            $db->transComplete();

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Erreur dans la transaction.');
            }
            echo json_encode($data);
        } catch (\Throwable $th) {
            // En cas d'erreur, faire un rollback
            $db->transRollback();

            echo  $th;
        }
    }

    public function add_Examen_cpn()
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
                "typeEnvoie" => "cpn",
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
            $this->detailconsultationcpn->update($_POST["idDetails"], $_POST);


            $envoie["rc"] = $_POST["rc"];
            $envoie["resultats"] = $_POST["resultats"];

            // Sauvegarder l'envoi au laboratoire


            $this->envoieLbo->save($envoie);

            $this->verif_CPN($_POST["idConsPour"], $db);



            echo json_encode(['success' => true, 'message' => 'Examen ajouté avec succès.']);
        } catch (\Throwable $th) {
            // En cas d'erreur, faire un rollback
            $db->transRollback();

            echo  $th;
        }
    }


    public function liste_cpn()
    {
        try {
            $datas = $this->cpn;

            if ($_POST["id_membre"] != "") {

                $datas = $datas
                    ->select("membre.id_membre , membre.nom_membre, 
              CASE 
                  WHEN cpn.Typepersonne = 'Titulaire' THEN CONCAT(titulaire.nom, ' ', titulaire.prenom)
                  WHEN cpn.Typepersonne = 'Conjoint(e)' THEN titulaire.nomprenomconjoint
                  WHEN cpn.Typepersonne IN ('Enfant', 'Parent') THEN CONCAT(enfant.nom, ' ', enfant.prenom)
                  ELSE 'Non spécifié'
              END AS nom,
              CASE 
                  WHEN cpn.Typepersonne = 'Titulaire' THEN titulaire.fonction
                  WHEN cpn.Typepersonne = 'Conjoint(e)' THEN titulaire.fonctionConjoint
                  ELSE titulaire.fonction 
              END AS fonction, 
              titulaire.adresse, 
              cpn.*")
                    ->where('cpn.etat', 1)
                    ->join("titulaire", "cpn.titulaireId = titulaire.titulaireId ", "left")
                    ->join("enfant", "enfant.enfantId = cpn.enfantId AND enfant.titulaireId = titulaire.titulaireId AND cpn.Typepersonne IN ('Enfant', 'Parent')", "left")
                    ->join("membre", "membre.id_membre = titulaire.membreId", "left")
                    ->where('membre.id_membre', $_POST["id_membre"]);
            } else {


                $datas = $datas
                    ->select("membre.id_membre , membre.nom_membre, 
              CASE 
                  WHEN cpn.Typepersonne = 'Titulaire' THEN CONCAT(titulaire.nom, ' ', titulaire.prenom)
                  WHEN cpn.Typepersonne = 'Conjoint(e)' THEN titulaire.nomprenomconjoint
                  WHEN cpn.Typepersonne IN ('Enfant', 'Parent') THEN CONCAT(enfant.nom, ' ', enfant.prenom)
                  ELSE 'Non spécifié'
              END AS nom,
              CASE 
                  WHEN cpn.Typepersonne = 'Titulaire' THEN titulaire.fonction
                  WHEN cpn.Typepersonne = 'Conjoint(e)' THEN titulaire.fonctionConjoint
                  ELSE titulaire.fonction 
              END AS fonction, 
              titulaire.adresse, 
              cpn.*")
                    ->where('cpn.etat', 1)
                    ->join("titulaire", "cpn.titulaireId = titulaire.titulaireId ", "left")
                    ->join("enfant", "enfant.enfantId = cpn.enfantId AND enfant.titulaireId = titulaire.titulaireId AND cpn.Typepersonne IN ('Enfant', 'Parent')", "left")
                    ->join("membre", "membre.id_membre = titulaire.membreId", "left");
            }

            if ($_POST["date_debut"] != "") {

                $datas = $datas
                    ->where("date(cpn.createdAt) >= ", $_POST["date_debut"]);
            }
            if ($_POST["date_fin"] != "") {

                $datas = $datas
                    ->where("date(cpn.createdAt) <= ", $_POST["date_fin"]);
            }

            $datas = $datas->findAll();

            // $ctegorie = ( $_POST["id_membre"] != ""  ) ? $datas : [];
            $ctegorie =  $datas;


            $th = "
                    <thead>
                      <tr>
                            <th>CPN N°</th>
                            <th>Carte N°</th>
                            <th>Nom - Prenom</th>
                            <th>Type</th>
                            <th>Fonction</th>
                            <th>Adresse</th>
                            <th>Marié(e)</th>
                            <th>Date Presumee</th>
                            <th>Date</th>
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

                


                if ($value["isFinished"] == 0) {

                    $etat = "En cours";

                    if ($value["isLabo"] == 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'analyse && Echographie";
                    }
                    if ($value["isLabo"] == 1 && $value["isEchographie"] != 1) {

                        $etat = "En attente d'analyse";
                    }
                    if ($value["isLabo"] != 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'echographie";
                    }

                } else { // pour 3 termine

                    $etat = "Terminé";

                    if ($value["isLabo"] == 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'analyse && Echographie";
                    }
                    if ($value["isLabo"] == 1 && $value["isEchographie"] != 1) {

                        $etat = "En attente d'analyse";
                    }
                    if ($value["isLabo"] != 1 && $value["isEchographie"] == 1) {

                        $etat = "En attente d'echographie";
                    }
                }

                if ($value["mariee"]) {
                    $marie = "Oui";
                } else {

                    $marie = "Non";
                }


                $th .=
                    '<tr>
                        <td style="width : 10%;">' .  $this->genererNumeroCarte("CPN", $value["idcpn"]) . ' </td>
                        <td style="width : 10%;">' .  $this->genererNumeroCarte($value["nom_membre"], $value["titulaireId"]) . ' </td>
                        <td style="width : 20%;">' . $value["nom"] . ' </td>
                        <td style="width : 20%;">' . $value["typePersonne"] . ' </td>
                        <td style="width : 20%;">' . $value["fonction"] . ' </td>
                        <td style="width : 20%;">' . $value["adresse"] . ' </td>
                        <td style="width : 10%;">' . $marie . ' </td>
                        <td style="width : 10%;">' . $value["dateAccouchement"] . '</td> 
                        <td style="width : 10%;">' . $value["createdAt"] . '</td>  
                        <td style="width : 10%;">' . $etat . '</td>  
                        <td style="width : 10%;"> 

                        <a class="info mr-1" 
                        id="cpnpere' . $value["idcpn"] . '" 
                        data-idcpn="' . $value["idcpn"] . '" 
                        data-dateaccouchement="' . $value["dateAccouchement"] . '"
                        data-ageinf16="' . $value["ageinf16"] . '" 
                        data-agesup35="' . $value["agesup35"] . '"
                        data-taille="' . $value["taille"] . '"
                        data-tension="' . $value["tension"] . '"
                        data-parite="' . $value["parite"] . '"
                        data-cesarienne="' . $value["cesarienne"] . '"
                        data-mortne="' . $value["mortne"] . '"
                        data-drepanocytose="' . $value["drepanocytose"] . '"
                        data-vat1="' . $value["vat1"] . '"
                        data-vat2="' . $value["vat2"] . '"
                        data-vat3="' . $value["vat3"] . '"
                        data-vat4="' . $value["vat4"] . '"
                        data-vat5="' . $value["vat5"] . '"
                        onclick="details_cpn( ' . $value["idcpn"] . ' ,' . $value["isFinished"] . ')"><i class=" la la-list"></i></a>';

                if ($this->session->get("roleId") == "3" || $this->session->get("roleId") == "4" || $this->session->get("roleId") == "5") {


                    if ($this->session->get("roleId") == "3" || $this->session->get("roleId") == "4") {
                        $sumNum = $this->detailconsultationcpn
                            ->select('SUM(num) as total_num')
                            ->where('idcpn', $value["idcpn"])
                            ->first();  // Utilisation de .first() pour récupérer la première ligne

                        // Vérifier si la somme est égale à 36
                        if ($sumNum['total_num'] > 0) {
                        } else {
                            $th .= '
                                    <a class="info mr-1" 
                                    id="cpnF' . $value["idcpn"] . '"
                                    data-personne=' . json_encode(implode('_', [$value["enfantId"], $value["typePersonne"]])) . '
                                    data-mariee="' . $value["mariee"] . '"
                                    onclick="edit_cpn(' . $value["idcpn"] . ' , ' . $value["id_membre"] . ' , ' . $value["titulaireId"] . ')"><i class=" la la-pencil-square-o"></i></a>
            
                                    <a class="danger mr-1" onclick="supprimercpn(' . $value["idcpn"] . ')"><i class=" la la-trash-o"></i></a> ';
                        }
                    } else {
                        $th .= '
                                <a class="info mr-1" 
                                id="cpnF' . $value["idcpn"] . '"
                                data-personne=' . json_encode(implode('_', [$value["enfantId"], $value["typePersonne"]])) . '
                                data-mariee="' . $value["mariee"] . '"
                                onclick="edit_cpn(' . $value["idcpn"] . ' , ' . $value["id_membre"] . ' , ' . $value["titulaireId"] . ')"><i class=" la la-pencil-square-o"></i></a>
        
                                <a class="danger mr-1" onclick="supprimercpn(' . $value["idcpn"] . ')"><i class=" la la-trash-o"></i></a> ';
                    }
                }


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
                'Demande' => "<tr><th style='text-align : left ; width : 10%'>Demande d'analyse</th>",
                'ta' => "<tr><th style='text-align : left ; width : 10%'>T.A</th>",
                'albOedemes' => "<tr><th style='text-align : left ; width : 10%'>ALB/Oedèmes</th>",
                'prisedepoids' => "<tr><th style='text-align : left ; width : 10%'>Prise de poids</th>",
                'ictereConjonctive' => "<tr><th style='text-align : left ; width : 10%'>Ictère (Conjonctives)</th>",
                'saignement' => "<tr><th style='text-align : left ; width : 10%'>Saignement</th>",
                'hauteurUterine' => "<tr><th style='text-align : left ; width : 10%'>Hauteur Utérine</th>",
                'bdfc' => "<tr><th style='text-align : left ; width : 10%'>BDFC</th>",
                'presentation' => "<tr><th style='text-align : left ; width : 10%'>Présentation</th>",
                'referenceAccouchement' => "<tr><th style='text-align : left ; width : 10%'>Référence pour accouchement</th>",
                'vat' => "<tr><th style='text-align : left ; width : 10%'>TD</th>",
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
                    $th = '<a class="info mr-1"  id = "detailcpn' . $row["idconsultationcpn"] . '"
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

                     if ($row["isLabo"] == 1 && $row["isEchographie"] == 1) {

                        $th = "En attente d'analyse && Echographie";
                        $td = '<a class="success mr-1" onclick="affichage_demande(' . $row["idconsultationcpn"] . ')">Analyse</a>';
                    }
                    else if ($row["isLabo"] == 1 && $row["isEchographie"] != 1) {

                        $th = "En attente d'analyse";
                        $td = '<a class="success mr-1" onclick="affichage_demande(' . $row["idconsultationcpn"] . ')">Analyse</a>';
                    }
                    else if ($row["isLabo"] != 1 && $row["isEchographie"] == 1) {

                        $th = "En attente d'echographie";
                        $td = '<a class="success mr-1" onclick="affichage_demande(' . $row["idconsultationcpn"] . ')">Analyse</a>';
                    }

                    else {
                        if (in_array($_SESSION['roleId'], ["6" , "10"])) {

                            $th = "";
                        }
                        $td = '<a class="success mr-1" onclick="affichage_demande(' . $row["idconsultationcpn"] . ')">Analyse</a>';
                    }

                    $rows['Action'] .= "<td>{$th}</td>";
                    $rows['Demande'] .= "<td>{$td}</td>";
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
                    $rows['Demande'] .= "<td></td>";
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


            $action = $rows['Action'];


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
                    {$action}
                    {$rows['Demande']}
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


            $data =  $this->detailconsultationcpn->select("num")
                ->where('idcpn', $_POST["idcpn"])
                ->where('etat', 1)
                ->findAll();

            if (empty($data)) {
                // Si $datas est vide, créer un tableau vide
                $nums = [];
            } else {
                // Si $datas n'est pas vide, extraire les valeurs de 'num' et les stocker dans un autre tableau
                $nums = array_column($data, 'num');
            }


            $response = [
                'roleId' => $this->session->get("roleId"),
                'nums' => $nums,
                'table' => $th,
                'num_cpn' =>  $this->genererNumeroCarte("CPN", $_POST["idcpn"])
            ];


            // Envoi du tableau en JSON pour être traité par le DataTable
            echo json_encode($response);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
