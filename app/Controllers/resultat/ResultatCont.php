<?php

// namespace App\Controllers;
namespace App\Controllers\resultat;

use App\Controllers\BaseController;


class ResultatCont extends BaseController
{
    public function index()
    {

        $content = view('resultat/index');
        return view('layout', ['content' => $content]);
    }
    public function lien()
    {

        return view('resultat/index');
    }

    function ajouterZero($nombre)
    {
        // Si le nombre est inférieur à 10, ajoute un zéro devant
        if ($nombre < 10) {
            return "0" . $nombre;
        } else {
            return strval($nombre);
        }
    }

    public function listeResultat()
    {
        try {

            $code_district = $_POST['code_district'];

            $candidat = $this->candidat
                ->orderBy("numero", 'asc')
                ->where('etat', 1);

            if ($_POST['code_district'] != null || $_POST['code_district'] != "") {
                $candidat = $candidat->where("code_district", $code_district)->findAll();
            } else {
                $candidat = [];
            }


            $th = "
                <thead>
                  <tr >
                    <th style='text-align: center;'>Code</th>
                    <th style='text-align: center;'>Libelle BV</th> 
                    ";

            foreach ($candidat as $value) {

                $th .= '
                                <th style="text-align: center;">Voix ' . $this->ajouterZero($value["numero"]) . '</th>
                        ';
            }


            $th .= "
                
            <th style='text-align: center;'>Voix exprimés</th> 
            <th style='text-align: center;'>Voix Blanc</th>
            <th style='text-align: center;'>Voix Nulle</th> 
            <th style='text-align: center;'>Voix Total</th> 
                    <th style='text-align: center;'>action</th> 

                    </tr></thead> 
                    
                    ";

            if ($_POST['code_district'] != null || $_POST['code_district'] != "") {

                $datas = $this->resultat
                    ->select("resultat.id_resultat , resultat.voix_blanc , resultat.voix_total, resultat.voix_nulle  , c.LIBELLE_CV , b.CODE_BV  , b.LIBELLE_BV")
                    ->join("bv b", "b.CODE_BV = resultat.code_bv")
                    ->join("cv c", "c.CODE_CV = b.CODE_CV")
                    ->join("fokontany fk", "fk.CODE_FOKONTANY = c.CODE_FOKONTANY")
                    ->join("commune co", "fk.CODE_COMMUNE = co.CODE_COMMUNE")
                    ->join("district ds", "ds.CODE_DISTRICT = co.CODE_DISTRICT")
                    ->where("resultat.etat", 1);

                $datas->where("ds.CODE_DISTRICT", $_POST["code_district"]);

                if ($_POST["code_commune"] != "" || $_POST["code_commune"] != null) {
                    $datas->where("co.CODE_COMMUNE", $_POST["code_commune"]);
                    if ($_POST["code_fokontany"] != "" || $_POST["code_fokontany"] != null) {
                        $datas->where("fk.CODE_FOKONTANY", $_POST["code_fokontany"]);
                    }
                }

                $datas = $datas->findAll();

                $th .= "<tbody> ";

                foreach ($datas as $value_ar) {

                    $th .= "<tr> ";
                    $th .= "
                    <td style='width:10%'> " . $value_ar["CODE_BV"] . "</td>
                    <td style='width:20%'> " . $value_ar["LIBELLE_BV"] . "</td>
                     ";

                    $voixEx = 0;
                    $tab = [];

                    foreach ($candidat as $value) {

                        $vato = 0;
                        $voix = $this->voix
                            ->where('id_resultat',  $value_ar["id_resultat"])
                            ->where('numero',  $value["numero"])
                            ->first();
                        if ($voix) {
                            $voixEx += $voix["voix"];
                            $vato = $voix["voix"];
                        }
                        
                        $tab[] = ["" . trim($value["numero"]) . "" => $vato];
                        $th .= "
                                    <td style='width:10%'> " . $vato . "</td>
                                ";
                    }



                    

                    $th .= "
                    <td style='width:10%'> " . $voixEx . "</td>
                    <td style='width:10%'> " . $value_ar["voix_blanc"] . "</td>
                    <td style='width:10%'> " . $value_ar["voix_nulle"] . "</td>
                    <td style='width:10%'> " . $value_ar["voix_total"] . "</td>
                      ";

                    $th .= '<td style="width:10%">

                            <a class="primary edit mr-1" data-voix = ' . json_encode($tab) . ' data-voix_nulle = "' . $value_ar["voix_nulle"] . '" data-code_bv = "' . $value_ar["CODE_BV"] . '" data-code_district = "' . $_POST['code_district'] . '"  data-voix_blanc="' . $value_ar["voix_blanc"] . '" id="res_' . $value_ar["id_resultat"] . '"  onclick="edit_resultat(' . $value_ar["id_resultat"] . ')"><i class="la la-pencil"></i></a>
                            <a class="danger delete mr-1" onclick="delete_resultat(' . $value_ar["id_resultat"] . ')" ><i class="la la-trash-o"></i></a>

                        </td>';

                    $th .= "</tr>";
                }

                $th .= "</tbody> ";
            } else {
                $candidat = null;
            }

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function delete_resultat()
    {
        try {

            $this->resultat->update($_POST["id_resultat"], ["etat" => 0]);
            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function ajout_resultat()
    {
        try {

            if ($_POST["id_resultat"] == "" ||  $_POST["id_resultat"] == null) {

                $data = $this->resultat->where("code_bv", $_POST["code_bv"])->where("code_district", $_POST["code_district"])->where("etat", 1)->find();

                if ($data) {

                    echo json_encode(["id" => 2]);

                    return;
                }
            } else {
                $data = $this->resultat
                    ->where("id_resultat <>", $_POST["id_resultat"])
                    ->where("code_bv", $_POST["code_bv"])->where("code_district", $_POST["code_district"])->where("etat", 1)->find();

                if ($data) {

                    echo json_encode(["id" => 2]);

                    return;
                }
            }

            $resultArray = [];
            $resultResult = [];
            $voixTotal = 0;


            foreach ($_POST as $key => $value) {

                if (preg_match('/^Voix_\d+$/', $key)) {

                    $numeroVoix = substr($key, strlen('Voix_'));

                    $resultArray[$numeroVoix] = $value;
                    $voixTotal += $value;
                } else {
                    $resultResult[strtolower($key)] = $value;
                }
            }
            $resultResult["voix_total"] = $voixTotal + $_POST["Voix_blanc"] + $_POST["Voix_nulle"];

            $this->resultat->save($resultResult);
            if ($_POST["id_resultat"] == "" ||  $_POST["id_resultat"] == null) {
                $id_index = $this->resultat->insertID();
            } else {
                $id_index = $_POST["id_resultat"];
                $this->voix->where('id_resultat', $id_index)->delete();
            }

            foreach ($resultArray as $key => $value) {
                $data = [
                    'id_resultat' => $id_index,
                    'numero' => $key,
                    'voix' => $value,
                    'code_bv' => $_POST["code_bv"],
                    'code_district' => $_POST["code_district"],
                ];

                $this->voix->save($data);
            }

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_voix()
    {
        try {

            $data =  $this->candidat->where("code_district",  $_POST["code_district"])->orderBy("numero", "asc")->where("etat" , 1)->findAll();

            $district = '';

            foreach ($data as $value) {

                $num =  $this->ajouterZero($value["numero"]);

                $district .= '

                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="usernom" class="">Voix ' . $num . '</label>
                        <input type="text" name="Voix_' . $num . '" required name="nom" min="0" class="form-control input-sm "  placeholder="voix ' . $num . '">
                    </div>
                    </div>

                        
                        ';
            }
            $district .= '';

            if ($data) {
                # code...
                $district .= '
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usernom" class="">Voix Blanc</label>
                                    <input type="text" name="Voix_blanc"  required name="nom"  class="form-control input-sm basicAutoComplete" maxlength="5" placeholder="voix blanc">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usernom" class="">Voix nulle</label>
                                    <input type="text" name="Voix_nulle" required name="nom"  class="form-control input-sm basicAutoComplete" maxlength="5" placeholder="voix nulle">
                                </div>
                            </div>
    
                            ';
            }
            echo $district;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function update_histo()
    {
        $data_article = $this->article->where('etat', 1)->findAll();

        $verif = $this->index_update
            ->orderBy("fin", "desc")
            ->first();

        $id_index = 0;

        if (!$verif) {

            $all_devis = count($this->devis->findAll());
            $confirm_devis = count($this->devis->where("etat > ", 1)->findAll());

            $data_index = [
                'debut'    => $this->devis->orderBy("date_devis", "ASC")->first()["date_devis"] ?? date("Y-m-d"),
                'fin'  => date("Y-m-d"),
                'devis_tous' => $all_devis,
                'devis_confirmer' => $confirm_devis

            ];

            $this->index_update->save($data_index);

            $id_index = $this->index_update->insertID();
        } else {



            if ($verif["fin"] == date("Y-m-d")) {

                $all_devis = count($this->devis->where("date(date_devis) >=",  $verif["debut"])
                    ->where("date(date_devis) <=",  $verif["fin"])->findAll());
                $confirm_devis = count($this->devis->where("date(date_devis) >=",  $verif["debut"])
                    ->where("date(date_devis) <=",  $verif["fin"])->where("etat > ", 1)->findAll());

                $data_index = [
                    'id' => $verif["id"],
                    'devis_tous' => $all_devis,
                    'devis_confirmer' => $confirm_devis

                ];

                $id_index = $verif["id"];
                $this->index_update->save($data_index);
            } else {
                $all_devis = count($this->devis->where("date(date_devis) >=",  $verif["fin"])
                    ->where("date(date_devis) <=",  date("Y-m-d"))->findAll());
                $confirm_devis = count($this->devis->where("date(date_devis) >=",  $verif["fin"])
                    ->where("date(date_devis) <=",  date("Y-m-d"))->where("etat >", 1)->findAll());
                $data_index = [
                    'debut'    => $verif["fin"],
                    'fin'  => date("Y-m-d"),
                    'devis_tous' => $all_devis,
                    'devis_confirmer' => $confirm_devis

                ];

                $this->index_update->save($data_index);

                $id_index = $this->index_update->insertID();
            }


            $this->details_update->where("id_index", $id_index)->delete();
        }



        foreach ($data_article as $value_ar) {

            $val_categorie = $this->categorie->find($value_ar["id_categorie"])["designation"];
            $val_ouvrage = ($value_ar["id_ouvrage"] == 0) ? 'Aucun' :  $this->ouvrage->find($value_ar["id_ouvrage"])["designation"];
            $val_designation = $value_ar["designation"];
            $va_pu = $value_ar["pu"];



            $data_profil = $this->profil->where('etat', 1)->findAll();

            $val_p = [];
            $val_v = [];

            foreach ($data_profil as $value) {

                if ($value_ar["id_type_profil"] != null || $value_ar["id_type_profil"] != "") {


                    if (in_array($value["id_type_profil"], explode(",", $value_ar["id_type_profil"]))) {

                        if ($value["unite"] == "%") {
                            $val_p[] = $value["designation"] . '_' . floatval($value["sur_plus"]) . ' %';
                        } else {
                            $val_p[] = $value["designation"] . '_' . floatval($value["sur_plus"]);
                        }
                    }
                }
            }
            $val_profil = ($val_p == null) ? 'Aucun' :  implode(',', $val_p);



            $data_vitre = $this->vitre->where('etat', 1)->findAll();

            foreach ($data_vitre as $value) {

                if ($value_ar["id_type_vitre"] != null || $value_ar["id_type_vitre"] != "") {


                    if (in_array($value["id_type_vitre"], explode(",", $value_ar["id_type_vitre"]))) {

                        if ($value["unite"] == "%") {
                            $val_v[] = $value["designation"] . '_' . floatval($value["sur_plus"]) . ' %';
                        } else {
                            $val_v[] = $value["designation"] . '_' . floatval($value["sur_plus"]);
                        }
                    }
                }
            }

            $val_vitre = ($val_v == null) ? 'Aucun' :  implode(',', $val_v);

            $data = [

                'designation_categorie' => $val_categorie,
                'designation_article' => $val_designation,
                'designation_ouvrage' => $val_ouvrage,
                'pu' => $va_pu,
                'designation_profil' => $val_profil,
                'designation_vitre'    => $val_vitre,
                'id_index' => $id_index

            ];

            $this->details_update->save($data);
        }
    }


    public function delete_article()
    {
        try {

            $this->update_histo();

            $this->article->update($_POST["id_article"], ["etat" => 0]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_article()
    {
        try {

            $data_profil = $this->profil->where('etat', 1)->findAll();

            $data_vitre = $this->vitre->where('etat', 1)->findAll();

            $data_article = $this->article->where('etat', 1)->findAll();

            $count_profil =  count($this->profil->where('etat', 1)->findAll()) + 1;

            $count_vitre =  count($this->vitre->where('etat', 1)->findAll()) + 1;

            //( $this->profil->countAll() == 0 ) ? 1 :
            //(  $this->vitre->countAll() == 0 ) ? 1  :

            $th = "
                <thead>
                  <tr >
                    <th style='text-align: center;' rowspan ='2'>Catégorie</th>
                    <th style='text-align: center;' rowspan ='2'>Désignation</th>
                    <th style='text-align: center;' rowspan ='2'>Ouvrage</th> 
                    <th  style='text-align: center;' colspan='" . $count_profil . "' >Type de Profil</th>
                    <th style='text-align: center;' colspan='" . $count_vitre . "' >Type de Vitre</th>

                    ";
            if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
                $th .= "<th style='text-align: center;' rowspan ='2'>Actions</th>";
            }

            $th .= "</tr>
                  <tr>
                    
                    <th style='text-align: center;'>Blanc</th>
            ";

            foreach ($data_profil as $value) {
                $th .= '
                    <th style="text-align: center;">' . $value["designation"] . '</th>

                ';
            }

            $th .= '
                    <th>Claire</th>

                ';

            if ($data_vitre) {
                # code...
                foreach ($data_vitre as $value) {
                    $th .= '
                        <th>' . $value["designation"] . '</th>
    
                    ';
                }
            } else {
            }





            $th .= "</tr></thead> ";

            $th .= "<tbody> ";

            foreach ($data_article as $value_ar) {

                $val_ouvrage = ($value_ar["id_ouvrage"] == 0) ? '------' :  $this->ouvrage->find($value_ar["id_ouvrage"])["designation"];

                $th .= "<tr> ";

                $th .= "
                    
                    <td style='width:10%'> " . $this->categorie->find($value_ar["id_categorie"])["designation"] . "</td>
                    <td style='width:20%'> " . $value_ar["designation"] . "</td>
                    <td style='width:20%'> " . $val_ouvrage  . "</td>
                    <td style='width:20%'> " . $this->formatPrix($value_ar["pu"] ?? 0) . " Ar</td>

                ";

                $pu_tot = 0.0;

                foreach ($data_profil as $value) {



                    if ($value_ar["id_type_profil"] == null || $value_ar["id_type_profil"] == "") {

                        $th .= '<td style="width:20%">------</td>';
                    } else {

                        $signe = floatval($value["sur_plus"]) < 0 ? '- ' : '+ ';

                        if (in_array($value["id_type_profil"], explode(",", $value_ar["id_type_profil"]))) {

                            if ($value["unite"] == "%") {
                                $th .= ' <td style="width:20%">' . $signe . $this->formatPrix(floatval($value["sur_plus"]) ?? 0) . ' %</td> ';
                            } else {
                                $th .= ' <td style="width:20%">' . $signe . $this->formatPrix(floatval($value["sur_plus"]) ?? 0)  . ' Ar</td>';
                            }
                        } else {
                            $th .= '<td style="width:20%">------</td>';
                        }
                    }
                }

                $th .= '
                 <td style="width:20%"> + 0 </td>

                ';

                foreach ($data_vitre as $value) {


                    if ($value_ar["id_type_vitre"] == null || $value_ar["id_type_vitre"] == "") {

                        $th .= '<td style="width:10%">------</td>';
                    } else {

                        $signe = floatval($value["sur_plus"]) < 0 ? '- ' : '+ ';

                        if (in_array($value["id_type_vitre"], explode(",", $value_ar["id_type_vitre"]))) {

                            if ($value["unite"] == "%") {
                                $th .= ' <td style="width:10%">' . $signe . $this->formatPrix(floatval($value["sur_plus"]) ?? 0) . ' % </td> ';
                            } else {
                                $th .= ' <td style="width:10%">' . $signe . $this->formatPrix(floatval($value["sur_plus"]) ?? 0)  . ' Ar</td>';
                            }
                        } else {
                            $th .= '<td style="width:10%">------</td>';
                        }
                    }
                }



                if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
                    $th .= '<td style="width:10%">

                             <a class="primary edit mr-1" data-designation="' . $value_ar["designation"] . '" data-id_ouvrage="' . $value_ar["id_ouvrage"] . '" data-pu="' . $this->formatPrixInput($value_ar["pu"] ?? 0) . '"
                             data-id_categorie="' . $value_ar["id_categorie"] . '" data-id_type_profil="' . $value_ar["id_type_profil"] . '" data-id_type_vitre="' . $value_ar["id_type_vitre"] . '"  
                             id="art_' . $value_ar["id_article"] . '" onclick="edit_article(' . $value_ar["id_article"] . ')"><i class="la la-pencil"></i></a>

                             <a class="danger delete mr-1" onclick="delete_article(' . $value_ar["id_article"] . ')" ><i class="la la-trash-o"></i></a>

                         </td>';
                }


                $th .= "</tr>";
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function mise_a_jour_article()
    {
        return view('menuiserie/article/mise_a_jour_article');
    }
}
