<?php

namespace App\Controllers\cpn;

use App\Controllers\BaseController;

class CpnCont extends BaseController
{
    public function index()
    {

        if (in_array($_SESSION['roleId'], ["5", "3", "4", "6", "9", "10"])) {

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

            // Vérifier si la transaction s'est bien déroulée
            if ($db->transStatus() === FALSE) {
                throw new \Exception('Erreur dans la transaction.');
            }
            echo json_encode(['id' => 1]);
        } catch (\Throwable $th) {
           
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
                'tagd' => "<tr><th style='text-align: left; width: 10%;'>Tagd</th>",
                'poids' => "<tr><th style='text-align: left; width: 10%;'>Poids</th>",
                'taille' => "<tr><th style='text-align: left; width: 10%;'>Taille</th>",
                'alboedemes' => "<tr><th style='text-align: left; width: 10%;'>ALB/Oedèmes</th>",
                'vedese' => "<tr><th style='text-align: left; width: 10%;'>Vedese</th>",
                'cpnconjonctive' => "<tr><th style='text-align: left; width: 10%;'>CPN Conjonctive</th>",
                'saignement' => "<tr><th style='text-align: left; width: 10%;'>Saignement</th>",
                'hauteuruterine' => "<tr><th style='text-align: left; width: 10%;'>Hauteur Utérine</th>",
                'largue' => "<tr><th style='text-align: left; width: 10%;'>Largue</th>",
                'ddr' => "<tr><th style='text-align: left; width: 10%;'>DDR</th>",
                'dpa' => "<tr><th style='text-align: left; width: 10%;'>DPA</th>",
                'hu' => "<tr><th style='text-align: left; width: 10%;'>HU</th>",
                'maf' => "<tr><th style='text-align: left; width: 10%;'>MAF</th>",
                'omi' => "<tr><th style='text-align: left; width: 10%;'>OMI</th>",
                'vat' => "<tr><th style='text-align: left; width: 10%;'>VAT</th>",
                'spi' => "<tr><th style='text-align: left; width: 10%;'>SPI</th>",
                'bdcf' => "<tr><th style='text-align: left; width: 10%;'>BDFC</th>",
                'rechercheActive' => "<tr><th style='text-align: left; width: 10%;'>Recherche Active</th>",
                'presentation' => "<tr><th style='text-align: left; width: 10%;'>Présentation</th>",
                'refeaccouche' => "<tr><th style='text-align: left; width: 10%;'>Réf. Accouchement</th>",
                'serologierdr' => "<tr><th style='text-align: left; width: 10%;'>Sérologie RDR</th>",
                'serologievidal' => "<tr><th style='text-align: left; width: 10%;'>Sérologie Vidal</th>",
                'asaurine' => "<tr><th style='text-align: left; width: 10%;'>ASA Urine</th>",
                'groupage' => "<tr><th style='text-align: left; width: 10%;'>Groupage</th>",
                'hiv' => "<tr><th style='text-align: left; width: 10%;'>HIV</th>",
                'fcv' => "<tr><th style='text-align: left; width: 10%;'>FCV</th>",
                'bw' => "<tr><th style='text-align: left; width: 10%;'>BW</th>",
                'toxoplasmose' => "<tr><th style='text-align: left; width: 10%;'>Toxoplasmose</th>",
                'rubuole' => "<tr><th style='text-align: left; width: 10%;'>Rubéole</th>",
                'tpha' => "<tr><th style='text-align: left; width: 10%;'>TPHA</th>",
                'nfs' => "<tr><th style='text-align: left; width: 10%;'>NFS</th>",
                'feracfolique' => "<tr><th style='text-align: left; width: 10%;'>Fer Ac. Folique</th>",
                'dateRendevous' => "<tr><th style='text-align: left; width: 10%;'>Date de Rendez-vous</th>",
                'createdAt' => "<tr><th style='text-align: left; width: 10%;'>Date</th>"
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
                    data-tagd="' . $row["tagd"] . '" 
                    data-poids="' . $row["poids"] . '" 
                    data-taille="' . $row["taille"] . '" 
                    data-alboedemes="' . $row["alboedemes"] . '" 
                    data-vedese="' . $row["vedese"] . '" 
                    data-cpnconjonctive="' . $row["cpnconjonctive"] . '" 
                    data-saignement="' . $row["saignement"] . '" 
                    data-hauteuruterine="' . $row["hauteuruterine"] . '" 
                    data-largue="' . $row["largue"] . '" 
                    data-ddr="' . $row["ddr"] . '" 
                    data-dpa="' . $row["dpa"] . '" 
                    data-hu="' . $row["hu"] . '" 
                    data-maf="' . $row["maf"] . '" 
                    data-omi="' . $row["omi"] . '" 
                    data-vat="' . $row["vat"] . '" 
                    data-spi="' . $row["spi"] . '" 
                    data-bdcf="' . $row["bdcf"] . '" 
                    data-rechercheActive="' . $row["rechercheActive"] . '" 
                    data-presentation="' . $row["presentation"] . '" 
                    data-refeaccouche="' . $row["refeaccouche"] . '" 
                    data-serologierdr="' . $row["serologierdr"] . '" 
                    data-serologievidal="' . $row["serologievidal"] . '" 
                    data-asaurine="' . $row["asaurine"] . '" 
                    data-groupage="' . $row["groupage"] . '" 
                    data-hiv="' . $row["hiv"] . '" 
                    data-fcv="' . $row["fcv"] . '" 
                    data-bw="' . $row["bw"] . '" 
                    data-toxoplasmose="' . $row["toxoplasmose"] . '" 
                    data-rubuole="' . $row["rubuole"] . '" 
                    data-tpha="' . $row["tpha"] . '" 
                    data-nfs="' . $row["nfs"] . '" 
                    data-feracfolique="' . $row["feracfolique"] . '" 
                    data-dateRendevous="' . $row["dateRendevous"] . '"
                    data-createdAt="' . $row["createdAt"] . '"
                    data-num="' . $row["num"] . '">
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

                    // Remplissage des données dans le tableau
                    $rows['Action'] .= "<td>{$th}</td>";
                    $rows['Demande'] .= "<td>{$td}</td>";
                    $rows['tagd'] .= "<td>{$row['tagd']}</td>";
                    $rows['poids'] .= "<td>{$row['poids']}</td>";
                    $rows['taille'] .= "<td>{$row['taille']}</td>";
                    $rows['alboedemes'] .= "<td>{$row['alboedemes']}</td>";
                    $rows['vedese'] .= "<td>{$row['vedese']}</td>";
                    $rows['cpnconjonctive'] .= "<td>{$row['cpnconjonctive']}</td>";
                    $rows['saignement'] .= "<td>{$row['saignement']}</td>";
                    $rows['hauteuruterine'] .= "<td>{$row['hauteuruterine']}</td>";
                    $rows['largue'] .= "<td>{$row['largue']}</td>";
                    $rows['ddr'] .= "<td>{$row['ddr']}</td>";
                    $rows['dpa'] .= "<td>{$row['dpa']}</td>";
                    $rows['hu'] .= "<td>{$row['hu']}</td>";
                    $rows['maf'] .= "<td>{$row['maf']}</td>";
                    $rows['omi'] .= "<td>{$row['omi']}</td>";
                    $rows['vat'] .= "<td>{$row['vat']}</td>";
                    $rows['spi'] .= "<td>{$row['spi']}</td>";
                    $rows['bdcf'] .= "<td>{$row['bdcf']}</td>";
                    $rows['rechercheActive'] .= "<td>{$row['rechercheActive']}</td>";
                    $rows['presentation'] .= "<td>{$row['presentation']}</td>";
                    $rows['refeaccouche'] .= "<td>{$row['refeaccouche']}</td>";
                    $rows['serologierdr'] .= "<td>{$row['serologierdr']}</td>";
                    $rows['serologievidal'] .= "<td>{$row['serologievidal']}</td>";
                    $rows['asaurine'] .= "<td>{$row['asaurine']}</td>";
                    $rows['groupage'] .= "<td>{$row['groupage']}</td>";
                    $rows['hiv'] .= "<td>{$row['hiv']}</td>";
                    $rows['fcv'] .= "<td>{$row['fcv']}</td>";
                    $rows['bw'] .= "<td>{$row['bw']}</td>";
                    $rows['toxoplasmose'] .= "<td>{$row['toxoplasmose']}</td>";
                    $rows['rubuole'] .= "<td>{$row['rubuole']}</td>";
                    $rows['tpha'] .= "<td>{$row['tpha']}</td>";
                    $rows['nfs'] .= "<td>{$row['nfs']}</td>";
                    $rows['feracfolique'] .= "<td>{$row['feracfolique']}</td>";
                    $rows['dateRendevous'] .= "<td>{$row['dateRendevous']}</td>";
                    $rows['createdAt'] .= "<td>{$row['createdAt']}</td>";
                } else {
                    // Si la consultation pour ce numéro n'existe pas, ajouter une cellule vide pour chaque colonne
                    $rows['Action'] .= "<td></td>";
                    $rows['Demande'] .= "<td></td>";
                    $rows['tagd'] .= "<td></td>";
                    $rows['poids'] .= "<td></td>";
                    $rows['taille'] .= "<td></td>";
                    $rows['alboedemes'] .= "<td></td>";
                    $rows['vedese'] .= "<td></td>";
                    $rows['cpnconjonctive'] .= "<td></td>";
                    $rows['saignement'] .= "<td></td>";
                    $rows['hauteuruterine'] .= "<td></td>";
                    $rows['largue'] .= "<td></td>";
                    $rows['ddr'] .= "<td></td>";
                    $rows['dpa'] .= "<td></td>";
                    $rows['hu'] .= "<td></td>";
                    $rows['maf'] .= "<td></td>";
                    $rows['omi'] .= "<td></td>";
                    $rows['vat'] .= "<td></td>";
                    $rows['spi'] .= "<td></td>";
                    $rows['bdcf'] .= "<td></td>";
                    $rows['rechercheActive'] .= "<td></td>";
                    $rows['presentation'] .= "<td></td>";
                    $rows['refeaccouche'] .= "<td></td>";
                    $rows['serologierdr'] .= "<td></td>";
                    $rows['serologievidal'] .= "<td></td>";
                    $rows['asaurine'] .= "<td></td>";
                    $rows['groupage'] .= "<td></td>";
                    $rows['hiv'] .= "<td></td>";
                    $rows['fcv'] .= "<td></td>";
                    $rows['bw'] .= "<td></td>";
                    $rows['toxoplasmose'] .= "<td></td>";
                    $rows['rubuole'] .= "<td></td>";
                    $rows['tpha'] .= "<td></td>";
                    $rows['nfs'] .= "<td></td>";
                    $rows['feracfolique'] .= "<td></td>";
                    $rows['dateRendevous'] .= "<td></td>";
                    $rows['createdAt'] .= "<td></td>";
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
                    {$rows['createdAt']}
                    {$rows['tagd']}
                    {$rows['poids']}
                    {$rows['taille']}
                    {$rows['alboedemes']}
                    {$rows['vedese']}
                    {$rows['cpnconjonctive']}
                    {$rows['saignement']}
                    {$rows['hauteuruterine']}
                    {$rows['largue']}
                    {$rows['ddr']}
                    {$rows['dpa']}
                    {$rows['hu']}
                    {$rows['maf']}
                    {$rows['omi']}
                    {$rows['vat']}
                    {$rows['spi']}
                    {$rows['bdcf']}
                    {$rows['rechercheActive']}
                    {$rows['presentation']}
                    {$rows['refeaccouche']}
                    {$rows['serologierdr']}
                    {$rows['serologievidal']}
                    {$rows['asaurine']}
                    {$rows['groupage']}
                    {$rows['hiv']}
                    {$rows['fcv']}
                    {$rows['bw']}
                    {$rows['toxoplasmose']}
                    {$rows['rubuole']}
                    {$rows['tpha']}
                    {$rows['nfs']}
                    {$rows['feracfolique']}
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
