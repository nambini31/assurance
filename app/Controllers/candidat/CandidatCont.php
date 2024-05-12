<?php

namespace App\Controllers\candidat;


use App\Controllers\BaseController;

class CandidatCont extends BaseController
{

    public function lien(): string
    {
        if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
            return view('candidat/index');
        }
        else {
            return view('dashboard/index');
        }
        
    }

    public function page_candidat()
    {
        if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
            $content = view('candidat/index');
            return view('layout',['content' => $content]);
        }
        else{
            $content = view('dashboard/index');
        return view('layout', ['content' => $content]);
        }
        
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

    public function afficher()
    {
        
        try {
            
            

            $candidats = $this->candidat
            ->select('candidat.id_candidat, candidat.nom, candidat.prenom, candidat.numero, candidat.photo, d.LIBELLE_DISTRICT')
            ->join('district d', 'd.CODE_DISTRICT = candidat.code_district')
            ->where('candidat.code_district', $_POST['code_district'])
            ->where('candidat.etat', 1)
            ->findAll();
            
            $th = "
                <thead>
                      <tr>
                        <th>#</th>
                        <th>District</th>
                        <th>Image</th>
                        <th>Numéro</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        "
                        ;
            if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
                $th .= "<th>Actions</th>";
            }
                       
            $th .= " </tr>
                   
            </thead> ";


            $th .= "<tbody>"; $n = 0;
            foreach ($candidats as $value) {
                $n++;
                $th .=
                    '<tr>
                        <td style="width : 10%">'.$n.' </td>
                        <td style="width:20%"> '. $value["LIBELLE_DISTRICT"]  .'</td>';
                $th .= '<td>';
                if (!empty($value["photo"])) {
                    $th .= '<img src="' . base_url('assets/img/candidat/' . $value["photo"]) . '" alt="User Image" style="max-width: 50px; max-height: 50px; clip-path:circle();">';
                }
                $th .= '</td>';

                $th .='                   
                        <td style="width : 10%">'.$this->ajouterZero($value["numero"]). '</td>
                        <td style="width : 50%">'.$value["nom"]. '</td> 
                        <td style="width : 50%">'.$value["prenom"].' </td>';

                        

                    if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
                        $th .= '
                        <td> <a class="info mr-1 " onclick="editCandidats(' . $value["id_candidat"] .')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimerCandidat('. $value["id_candidat"] .')"><i class=" la la-trash-o"></i></a> </td> 
                        ';
                    } 
                    
                    
                     $th .= '</tr>' ;
               
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }

        
    }

    public function charge_district_tout()
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

    public function charge_district_touts()
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

    

    public function ajouter()
    {
        try {
        

            $image = $this->request->getFile('image');
            

            if ($image->isValid() && !$image->hasMoved() && $image->getSize() <= (25 * 1024 * 1024)) {
                // Get the current date and time
                $currentDate = date('YmdHis');
                $nom_user = $this->request->getPost('nom');
                
                // Concatenate the current date and original name
                $newName = $currentDate . '_' . $nom_user;

                // Move the image to the destination folder with the new name
                $image->move(ROOTPATH . 'assets/img/candidat', $newName);
                $data['photo'] = $newName;

                $data += [
                    'code_district' => $this->request->getPost('code_district'),
                    'numero' => $this->request->getPost('numero_candidat'),
                    'nom' => $this->request->getPost('nom'),
                    'prenom' => $this->request->getPost('prenom'),
                ];
    
                $existingRecord = $this->candidat->where('code_district', $data['code_district'])->where('numero', $data['numero'])->where('etat !=', 0)->first();
                var_dump($existingRecord);

                if ($existingRecord) {
                    echo json_encode(['status' => 'failed', 'message' => 'Candidat déjà existe.']);
                } else {
                    $this->candidat->insert($data);
                    echo json_encode(['status' => 'success', 'message' => 'Ajout succès.']);
                }
            }

            else{
                 // Set a default image when no image is uploaded
                $data = [
                    'code_district' => $this->request->getPost('code_district'),
                    'numero' => $this->request->getPost('numero_candidat'),
                    'nom' => $this->request->getPost('nom'),
                    'prenom' => $this->request->getPost('prenom'),
                    'photo' => 'icon.jpg', // Set a default image when no image is uploaded
                ];

                $existingRecord = $this->candidat->where('code_district', $data['code_district'])->where('numero', $data['numero'])->where("etat <>", 0)->first();

                if ($existingRecord) {
                    echo json_encode(['status' => 'failed', 'message' => 'Candidat déjà existe.']);
                } else {
                    $this->candidat->insert($data);
                    echo json_encode(['status' => 'success', 'message' => 'Ajout succès.']);
                }
            }
        }
        catch (\Throwable $th) {
            echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
        }
    } 
    



    public function get_candidat_details()
    {
        try {
            $id = $_POST['id'];
            $candidat = $this->candidat->find($id);
            if (!empty($candidat['photo'])) {
                $candidat['photo'] = $candidat['photo'];
            }
            echo json_encode($candidat);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function modifier()
    {
    try {
        $id = $this->request->getPost('id');
        $numero = $this->request->getPost('numero_candidat');
        $code_districts = $this->request->getPost('code_district');
            $nom = $this->request->getPost('nom');
            $prenom = $this->request->getPost('prenom');
            $label_image = $this->request->getPost('label_image');

            // Check if the ID is valid
            $existingRecord = $this->candidat->find($id);
            if (!$existingRecord) {
                echo json_encode(['error' => 'Candidat non trouvé']);
                return;
            }

            
            $image = $this->request->getFile('image');
            $image = $image ?? '';
            if ($image!='' && !$image->hasMoved() && $image->getSize() <= (25 * 1024 * 1024)) {
                
                $currentDate = date('YmdHis');
                $nom_user = $this->request->getPost('nom');
                
                $newName = $currentDate . '_' . $nom_user;

                $image->move(ROOTPATH . 'assets/img/candidat', $newName);
                $data['photo'] = $newName;


            }else {
                $data['photo'] = $label_image;
            }
            
            // var_dump($data['numero']);

            $existingRecord = $this->candidat->where('code_district', $code_districts)->where('numero', $numero)->where('id_candidat !=', $id)->where('etat !=', 0)->first();

            if ($existingRecord) {
                echo json_encode(['status' => 'failed', 'message' => 'Candidat existe déjà.']);
            } else {
                $data += [
                    'code_district' => $code_districts,
                    'numero' => $numero,
                    'nom' => $nom,
                    'prenom' => $prenom,
                ];

                

                $this->candidat->update($id, $data);
                echo json_encode(['status' => 'success', 'message' => 'Modification effectuée avec succès.']);

            }
    } catch (\Throwable $th) {
        // echo $th;
        echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
    }
      
        
}


    public function supprimer()
    {
        try {

            $id = $_POST['id'];

            // Vérifiez si l'ID est valide
            if (!$this->candidat->find($id)) {
                echo json_encode(['error' => 'Candidat non trouvée']);
                return;
            }
 
            $this->candidat->update($id, ['etat' => 0]);

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }
}