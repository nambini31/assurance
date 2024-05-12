<?php

// namespace App\Controllers;
namespace App\Controllers\dashboard;

use App\Controllers\BaseController;
use DateTime;


class DashboardCont extends BaseController
{
    public function index()
    {

        $content = view('dashboard/index');
        return view('layout', ['content' => $content]);
    }
    public function lien()
    {

        return view('dashboard/index');
    }

    public function resultat_dashboard()
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

            if ($_POST['code_district'] != null || $_POST['code_district'] != "") {

                $datas = $this->resultat
                    ->select("COUNT(distinct b.CODE_BV) AS nombre_bv,
                SUM(resultat.voix_blanc) AS somme_voix_blanc,
                SUM(resultat.voix_nulle) AS somme_voix_nulle,
                SUM(resultat.voix_total) AS somme_voix_total,
                SUM(resultat.voix_total)  - (SUM(resultat.voix_blanc) + SUM(resultat.voix_nulle)) AS somme_voix_exprimes")
                    ->join("bv b", "b.CODE_BV = resultat.code_bv")
                    ->join("cv c", "c.CODE_CV = b.CODE_CV")
                    ->join("fokontany fk", "fk.CODE_FOKONTANY = c.CODE_FOKONTANY")
                    ->join("commune co", "fk.CODE_COMMUNE = co.CODE_COMMUNE")
                    ->join("district ds", "ds.CODE_DISTRICT = co.CODE_DISTRICT")
                    ->where("resultat.etat", 1)
                    ->where("ds.CODE_DISTRICT",$_POST['code_district'] )
                    ->groupBy("co.CODE_DISTRICT");   

                if ($_POST["code_commune"] != "" || $_POST["code_commune"] != null) {
                    $datas->where("co.CODE_COMMUNE", $_POST["code_commune"])
                    ->groupBy("co.CODE_COMMUNE");
                    if ($_POST["code_fokontany"] != "" || $_POST["code_fokontany"] != null) {
                        $datas->where("fk.CODE_FOKONTANY", $_POST["code_fokontany"])->groupBy("fk.CODE_FOKONTANY");
                    }
                }

                $datas = $datas->first();

                $candidat = $this->candidat
                ->orderBy("numero", 'asc')
                ->where('etat', 1)
                ->where("code_district", $_POST['code_district'])->findAll();


                $arrayCandidates = [];

                foreach ($candidat as $value) {


                    $datas_voix = $this->voix
                    ->select(" SUM(voix) AS voix")
                    ->join("bv b", "b.CODE_BV = voix.code_bv")
                    ->join("cv c", "c.CODE_CV = b.CODE_CV")
                    ->join("resultat res", "res.id_resultat = voix.id_resultat")
                    ->join("fokontany fk", "fk.CODE_FOKONTANY = c.CODE_FOKONTANY")
                    ->join("commune co", "fk.CODE_COMMUNE = co.CODE_COMMUNE")
                    ->join("district ds", "ds.CODE_DISTRICT = co.CODE_DISTRICT")
                    ->where("numero", $value['numero'])
                    ->where("ds.CODE_DISTRICT",$_POST['code_district'] )
                    ->where("res.etat", 1 )
                    ->orderBy("SUM(voix.voix)", 'desc' )

                    ->groupBy("co.CODE_DISTRICT ");   

                    if ($_POST["code_commune"] != "" || $_POST["code_commune"] != null) {
                        $datas_voix->where("co.CODE_COMMUNE", $_POST["code_commune"])
                        ->groupBy("co.CODE_COMMUNE");
                        if ($_POST["code_fokontany"] != "" || $_POST["code_fokontany"] != null) {
                            $datas_voix->where("fk.CODE_FOKONTANY", $_POST["code_fokontany"])->groupBy("fk.CODE_FOKONTANY");
                        }
                    }

                    $datas_voix = $datas_voix->groupBy("numero")->first();

                    $nbr = 0 ;

                    if ($datas_voix) {
                        $nbr = $datas_voix["voix"] ;
                    }
                    
                    $arrayCandidates [] = ["voix" =>  $nbr , "numero" => $value["numero"] , "nom" => strtoupper($value["nom"] ) , "prenom" => ucfirst($value["prenom"]) , "photo" => $value["photo"]];

                    
                }

                usort($arrayCandidates, function($a, $b) {
                    return $b['voix'] - $a['voix'];
                });

                echo json_encode(['id'=> 1 , 'result'=> $datas,'candidat'=> $arrayCandidates]);

            } else {
                echo json_encode(['id'=> 0]);
            }
        } catch (\Throwable $th) {
            echo json_encode(['id'=> 2]);
        }
    }

    
}
