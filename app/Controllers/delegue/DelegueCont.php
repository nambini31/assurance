<?php

// namespace App\Controllers;
namespace App\Controllers\delegue;

use App\Controllers\BaseController;


class DelegueCont extends BaseController
{
    public function index()
    {
       
            $content = view('delegue/index');
            return view('layout',['content' => $content]);
   
      
    }
    public function lien()
    {
   
        return view('delegue/index');
         
    }

    public function listeArticle()
    {
        var_dump($_POST);
    }

    public function charge_province()
    {
        try {

            $data =  $this->faritany->findAll();

            $province = '';

                foreach ($data as $value) {
                    $province .= '
                        <option value="' . $value['CODE_FARITANY'] . '"> '. $value['LIBELLE_FARITANY'] . '</option> ';
                }

            echo $province;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_district_tous()
    {
        try {

            $data =  $this->district->findAll();

            $district = '';
            $district .= '
            <option value=""></option> ';
                foreach ($data as $value) {
                    $district .= '
                        <option value="' . $value['CODE_DISTRICT'] . '"> '. $value['LIBELLE_DISTRICT'] . '</option> ';
                }

            echo $district;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_region()
    {
        try {

            $data =  $this->region->where("CODE_FARITANY" ,  $_POST["code_faritany"] )->findAll();

            $region = '';

                foreach ($data as $value) {
                    $region .= '
                        <option value="' . $value['CODE_REGION'] . '"> '. $value['LIBELLE_REGION'] . '</option> ';
                }

            echo $region;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_commune_tous()
    {
        try {

            $data =  $this->commune->where("CODE_DISTRICT" ,  $_POST["code_district"] )->findAll();

            $commune = '';
            $commune .= '
            <option value=""></option> ';
                foreach ($data as $value) {
                    $commune .= '
                        <option value="' . $value['CODE_COMMUNE'] . '"> '. $value['LIBELLE_COMMUNE'] . '</option> ';
                }

            echo $commune;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_quartier_tous()
    {
        try {

            $data =  $this->fokontany->where("CODE_COMMUNE" ,  $_POST["code_commune"] )->findAll();

            $fokontany = '';
            $fokontany .= '
            <option value=""></option> ';
                foreach ($data as $value) {
                    $fokontany .= '
                        <option value="' . $value['CODE_FOKONTANY'] . '"> '. $value['LIBELLE_FOKONTANY'] . '</option> ';
                }

            echo $fokontany;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_district()
    {
        try {

            $data =  $this->district->where("CODE_REGION" ,  $_POST["code_region"] )->findAll();

            $district = '';

                foreach ($data as $value) {
                    $district .= '
                        <option value="' . $value['CODE_DISTRICT'] . '"> '. $value['LIBELLE_DISTRICT'] . '</option> ';
                }

            echo $district;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function charge_bv()
    {
        try {

            $datas = $this->bv
            ->select(" bv.CODE_BV ,  bv.LIBELLE_BV ")
            ->join("cv c" , "c.CODE_CV = bv.CODE_CV")
            ->join("fokontany fk" , "fk.CODE_FOKONTANY = c.CODE_FOKONTANY")
            ->join("commune co" , "fk.CODE_COMMUNE = co.CODE_COMMUNE")
            ->join("district ds" , "ds.CODE_DISTRICT = co.CODE_DISTRICT")
            ->where("ds.CODE_DISTRICT", $_POST["code_district"] )
            ->findAll();

            $bv = '';

                foreach ($datas as $value) {
                    $bv .= '
                        <option value="' . $value['CODE_BV'] . '"> '. $value['LIBELLE_BV'] . ' - ' . $value['CODE_BV'] . '</option> ';
                }

            echo $bv;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function autocomplete()
	{
        $data = [];
        try {
		$code_faritany = $_POST["code_faritany"];
		$code_region = $_POST["code_region"];
		$table = "r" . $code_region;

		$keyword = $_POST["query"];

        $datas = $this->$table
        ->select("$table.CINELECT , $table.NOMELECT , COALESCE($table.PRENOMELECT, '') AS PRENOMELECT , c.LIBELLE_CV , b.LIBELLE_BV , fk.LIBELLE_FOKONTANY , co.LIBELLE_COMMUNE , ds.CODE_DISTRICT ,ds.LIBELLE_DISTRICT , rg.LIBELLE_REGION , fr.LIBELLE_FARITANY")
        ->like("$table.CINELECT", $keyword )
        ->where("fr.CODE_FARITANY", $code_faritany )
        ->where("rg.CODE_REGION", $code_region )
        ->join("bv b" , "b.CODE_BV = $table.CODE_BV")
        ->join("cv c" , "c.CODE_CV = b.CODE_CV")
        ->join("fokontany fk" , "fk.CODE_FOKONTANY = c.CODE_FOKONTANY")
        ->join("commune co" , "fk.CODE_COMMUNE = co.CODE_COMMUNE")
        ->join("district ds" , "ds.CODE_DISTRICT = co.CODE_DISTRICT")
        ->join("region rg" , "rg.CODE_REGION = ds.CODE_REGION")
        ->join("faritany fr" , "fr.CODE_FARITANY = rg.CODE_FARITANY")
        ->first();

        if ($datas) {
            
            $data = ["LIBELLE_CV"=> $datas["LIBELLE_CV"] , "CINELECT"=> $datas["CINELECT"] , "NOMELECT"=> $datas["NOMELECT"]  , "LIBELLE_BV"=> $datas["LIBELLE_BV"] , "LIBELLE_FOKONTANY"=> $datas["LIBELLE_FOKONTANY"] ,
            "LIBELLE_COMMUNE"=> $datas["LIBELLE_COMMUNE"] , "LIBELLE_DISTRICT"=>  $datas["LIBELLE_DISTRICT"], "LIBELLE_REGION"=> $datas["LIBELLE_REGION"] 
            ,"LIBELLE_FARITANY"=>  $datas["LIBELLE_FARITANY"] , "PRENOMELECT"=>  $datas["PRENOMELECT"] , "CODE_DISTRICT"=>  $datas["CODE_DISTRICT"] ] ;
        }

        } catch (\Throwable $th) {
            //throw $th;
        }
		
		
		echo json_encode($data);

	}


    public function ajout_delegue()
    {
        try {

            if ($_POST["id_delegue"] == "" ||  $_POST["id_delegue"] == null) {

                $data = $this->delegues->where("code_bv",$_POST["code_bv"])->where("code_district",$_POST["code_district"])->where("etat" , 1)->find();

                if ($data) {
                    
                    echo json_encode(["id" => 2]);

                    return;
                }

            }else{
                $data = $this->delegues
                ->where("id_delegue <>" , $_POST["id_delegue"] )
                ->where("code_bv",$_POST["code_bv"])->where("code_district",$_POST["code_district"])->where("etat" , 1)->find();

                if ($data) {
                    
                    echo json_encode(["id" => 2]);

                    return;
                }
            }

            $id = $this->delegues->save($_POST);

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    

    public function delete_delegue()
    {
        try {
            
            $this->delegues->update($_POST["id_delegue"],["etat"=> 0]);


            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    public function listes_delegue()
    {
        try {

            $datas = $this->delegues
            ->select("delegues.id_delegue , delegues.nom , delegues.contact, c.LIBELLE_CV  , , b.CODE_BV  , b.LIBELLE_BV , fk.LIBELLE_FOKONTANY , co.LIBELLE_COMMUNE , ds.CODE_DISTRICT ,ds.LIBELLE_DISTRICT , rg.LIBELLE_REGION , rg.CODE_REGION  ,  fr.CODE_FARITANY, fr.LIBELLE_FARITANY")
            ->join("bv b" , "b.CODE_BV = delegues.code_bv")
            ->join("cv c" , "c.CODE_CV = b.CODE_CV")
            ->join("fokontany fk" , "fk.CODE_FOKONTANY = c.CODE_FOKONTANY")
            ->join("commune co" , "fk.CODE_COMMUNE = co.CODE_COMMUNE")
            ->join("district ds" , "ds.CODE_DISTRICT = co.CODE_DISTRICT")
            ->join("region rg" , "rg.CODE_REGION = ds.CODE_REGION")
            ->join("faritany fr" , "fr.CODE_FARITANY = rg.CODE_FARITANY")
            ->where("delegues.etat" , 1) ;

            if ( $_POST["code_district"] != "" || $_POST["code_district"] != null ){
                $datas->where("ds.CODE_DISTRICT" , $_POST["code_district"]);
                if ( $_POST["code_commune"] != "" || $_POST["code_commune"] != null ){
                    $datas->where("co.CODE_COMMUNE" , $_POST["code_commune"]);
                    if ($_POST["code_fokontany"] != "" || $_POST["code_fokontany"] != null ){
                        $datas->where("fk.CODE_FOKONTANY" , $_POST["code_fokontany"]);
                    }
                }
            }

            $datas = $datas->findAll();

            $th = "";


            $th .= "
            <thead>
            <th>#</th>
            <th>Nom prenom</th>
            <th>Contact</th>
            <th>District</th>
            <th>Commune</th>
            <th>quartier</th>
            <th>Bureau vote</th>
            <th>action</th>
                </thead>
            ";

            $th .= "<tbody> ";

            $n = 1 ;

            foreach ($datas as $value_ar) {

               

                $th .= "<tr> ";
                $nom = $value_ar["nom"];

                $btn = '
                
                <td style="width:10%">

                             <a class="primary edit mr-1" data-nom="'.$nom.'" data-code_faritany="'.$value_ar["CODE_FARITANY"].'" data-code_region="'.$value_ar["CODE_REGION"].'" data-code_bv="'.$value_ar["CODE_BV"].'" data-code_district="'.$value_ar["CODE_DISTRICT"].'"
                             data-contact="'.$value_ar["contact"].'" id="del_'.$value_ar["id_delegue"].'" onclick="edit_delegue('.$value_ar["id_delegue"].')"><i class="la la-pencil-square-o"></i></a>

                             <a class="danger delete mr-1" onclick="delete_delegue('.$value_ar["id_delegue"].')" ><i class="la la-trash-o"></i></a>

                         </td>

                ';


                $th .= "
                    
                    <td style='width:10%'> ". $n ."</td>
                    <td style='width:20%'> ". $nom ."</td>
                    <td style='width:20%'> ". $value_ar["contact"]  ."</td>
                    <td style='width:20%'> ". $value_ar["LIBELLE_DISTRICT"]  ."</td>
                    <td style='width:20%'> ". $value_ar["LIBELLE_COMMUNE"]  ."</td>
                    <td style='width:20%'> ". $value_ar["LIBELLE_FOKONTANY"]  ."</td>
                    <td style='width:20%'> ". $value_ar["LIBELLE_BV"]  ."</td>
                    $btn

                ";        

                $th .= "</tr>";

                $n++ ;
            }


            

            


            

           
            // $th .= "</tr></thead> ";

            

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
