<?php

namespace App\Controllers\article;

use App\Controllers\BaseController;
use Predis\Command\Redis\SAVE;

class ArticleCont extends BaseController
{
    public function index(): string
    {
        $content = view('article/index');
        return view('layout',['content' => $content]);
    }
    public function lien(): string
    {
        return view('article/index');
    }

    
    public function generation_article_dynamique()
    {
        try {

            $data = $this->article->where('etat',1)->where('id_categorie' , $_POST['id_categorie'])->findAll();

            $categorie_html = '';

            foreach ($data as  $value) {
                $selected = "";
                if ($_POST["id_article"] == $value['id_article']) {
                    $selected = "selected";
                }
                $categorie_html .= '
                    <option '.$selected.' data-prix="'.$this->formatPrixInput($value['prix_unitaire']).'" data-prixbase="'.$value['prix_unitaire'].'" data-stock="'.$value['quantite'].'" id="check'.$value['id_article'].'" value="' . $value['id_article'] . '"> '. $value['designation'] . '</option> ';
            }

            echo $categorie_html;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function ajout_article()
    {

        try {

        

                    $this->article->save($_POST);
                    echo json_encode(['status' => 'success']);
                
            
        

            
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    
    public function delete_article()
    {
        try {
            
            $this->article->update($_POST["id_article"],["etat"=> 0]);

            echo json_encode(["id" => 1]);
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    //----- affichage Article -----
    public function listes_article()
    {
        try {

            
            $data_article = $this->article
            ->select("article.*")
            ->where('article.etat',1)
            ->findAll();
            

            $th = "
                <thead>
                  <tr >
                    <th style='text-align: center;'>id</th>
                    <th style='text-align: center;'>Désignation</th>
                    <th style='text-align: center;'>Unité</th>
                    <th style='text-align: center;'>Presentation</th>
                    <th style='text-align: center;'>Quantité</th>
                    <th style='text-align: center;'>Prix unitaire</th> 
                    <th style='text-align: center;'>Date peremption</th> 
                    <th style='text-align: center;'>Etat</th> 
                    
                    " ;
                       $th .= "<th style='text-align: center;'>Actions</th>";
                    

               $th .= "</tr></thead> <tbody> ";

            foreach ($data_article as $value_ar) {

                $unite = $value_ar["unite"] == "BT"  ? ("BT/".$value_ar["presentation"]) : $value_ar["unite"] ;
                
                $class = ($value_ar["isActif"] != 1) ? ' class="leave-row" ' : '';

                $desactive = "";

                if ($value_ar["isActif"] != 1) {
                    
                    $desactive = '<a class="danger mr-1" ><i class="la la-ban"></i>périmé</a>';
                }else{
                    $desactive = '
                    <a class="success  mr-1" ><i class="la la-check-circle"></i>Actif</a>
                    ';

                }
                
                $th .= "<tr {$class}> ";

                $th .= "
                    <td style='width:10%'> ". $this->genererNumeroCarte("REF",$value_ar["id_article"]) ."</td>
                    <td style='width:20%'> ".$value_ar["designation"] ."</td>
                    <td style='width:10%'> <strong>". $unite ."</strong></td>
                    <td style='width:10%'>  <strong>".$value_ar["presentation"] ." </strong></td>
                    <td style='width:20%'> ".$value_ar["quantite"] ."</td>
                    <td style='width:20%'> <strong> ".$this->formatPrixInput($value_ar["prix_unitaire"]) ."  </strong> Ar </td>
                    <td style='width:20%'> ".$value_ar["dateperemption"] ."</td>
                    <td style='width:20%'> ".$desactive ."</td>
                ";

                $pu_tot = 0.0;




                    $th .= '<td style="width:10%">

                             <a class="primary edit mr-1" data-designation="'.$value_ar["designation"].'" data-prix_unitaire="'. $value_ar["prix_unitaire"] .'" data-quantite="'.$value_ar["quantite"].'" 
                             data-presentation="'.$value_ar["presentation"].'"  data-unite="'.$value_ar["unite"].'" data-dateperemption="'.$value_ar["dateperemption"].'"   
                             id="art_'.$value_ar["id_article"].'" onclick="edit_article('.$value_ar["id_article"].')"><i class="la la-pencil"></i></a>

                             <a class="danger delete mr-1" onclick="delete_article('.$value_ar["id_article"].')" ><i class="la la-trash-o"></i></a>

                         </td>' ;
                

                $th .= "</tr>";
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    //-----------------------------------------------------

    //------- ARTICLE DROPDOWN -------
    public function generation_dropdown_article()
    {
        try {

            $data = $this->article->where('etat',1)->findAll();

            $dropdown_article = '';

            foreach ($data as  $value) {

                $dropdown_article .= '
                    <option value="' . $value['id_article'] . '"> '. $value['designation'] . '</option> ';
            }

            echo $dropdown_article;
        } catch (\Throwable $th) {
            echo $th;
        }
    }
    // ---------------------------------------

    //----- GET INFO ARTICLE -------
    public function get_info_article()
    {
        // <strong>Prix Unitaire : </strong><td>{$this->formatPrix($prix_unitaire)} Ar</td>
        try {
            $selectedArticle = $_POST['selectedArticle'];
            $article = $this->article->find($selectedArticle);
            $prix_unitaire = $article['prix_unitaire'];
            $quantite = $article['quantite'];
            $id_categorie = $article['id_categorie'];
            $info_article = "  
                    <strong>Stock : </strong><td>{$quantite}</td> <br>
                    <div class='form-group'>
                        <label for='userinput1' class=''>Prix Unitaire</label>
                        <input class='form-control input-sm' type='text' name='prix_unitaire' id='prix_unitaire_se' value='{$this->formatPrixInput($prix_unitaire)}'>
                    </div>
                    <input type='hidden' name='stock' id='stock' value='{$quantite}'>
                    <input type='hidden' name='id_categorie' value='{$id_categorie}'>
            ";
            
            echo($info_article);

        } catch (\Throwable $th) {
            echo($th->getMessage());
        }

    }
    //----------------------------------------------------

    public function mise_a_jour_article()
    {
        return view('menuiserie/article/mise_a_jour_article');
    } 


       
}