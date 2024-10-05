<?php

namespace App\Controllers\categorie;

use App\Controllers\BaseController;


class CategorieCont extends BaseController
{
    public function index(): string
    {
        $content = view('categorie/index');
        return view('layout', ['content' => $content]);
    }
    public function lien(): string
    {
        return view('categorie/index');
    }
    public function afficher_categorie()
    {
        try {
            $ctegorie = $this->categorie->where('etat', 1)->findAll();
            $th = "
                    <thead>
                      <tr>
                        <th>id</th>
                        <th>Désignation</th>";
           
                $th .= "<th>Actions</th>";
            

            $th .= " </tr></thead> ";


            $th .= "<tbody>";


            foreach ($ctegorie as $value) {
                $th .=
                    '<tr>
                        <td style="width : 20%;">' . $value["id_categorie"] . ' </td>
                        <td style="width : 100%;">' . $value["designation"] . '</td> ';

               
                    $th .= '
                        <td> <a class="info mr-1 " onclick="editCategorie(' . $value["id_categorie"] . ')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimerCategorie(' . $value["id_categorie"] . ')"><i class=" la la-trash-o"></i></a> </td> 
                        ';
                
                $th .= '</tr>';
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function ajouter_categorie()
    {
        try {

            $designation = $_POST['designation'];

            // Vérifiez si l'enregistrement existe déjà en fonction de la désignation
            $existingRecord = $this->categorie->where('designation', $designation)->where('etat', 1)->first();
            // var_dump($existingRecord); die;

            if ($existingRecord) {

                echo json_encode(['status' => 'failed']);
            } else {
                $data = [
                    'designation' => $designation,
                ];

                $this->categorie->insert($data);

                echo json_encode(['status' => 'success']);
            }
        } catch (\Throwable $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }


    public function get_categorie_details()
    {
        try {
            $id = $_POST['id'];
            $categorie = $this->categorie->find($id);
            // $categorie['categorie'] = $CategorieModel->where(['id_categorie'=>$id])->first();
            //var_dump($categorie);
            echo json_encode($categorie);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }


    public function modifier_categorie()
    {
        try {
            // Récupérez les données du formulaire
            $id = $_POST['id'];
            $designation = $_POST['designation'];

            // Vérifiez si l'ID est valide
            if (!$this->categorie->find($id)) {
                echo json_encode(['error' => 'Catégorie non trouvée']);
                return;
            }

            // Effectuez la mise à jour des données
            $data = [
                'designation' => $designation,
                // Ajoutez d'autres champs si nécessaire
            ];

            $this->categorie->update($id, $data);

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function supprimer_categorie()
    {
        try {

            $id = $_POST['id'];

            // Vérifiez si l'ID est valide
            if (!$this->categorie->find($id)) {
                echo json_encode(['error' => 'Catégorie non trouvée']);
                return;
            }

            $this->categorie->update($id, ['etat' => 0]);
            $this->article->where('id_categorie', $id)->delete();

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
}
