<?php

namespace App\Controllers\utilisateur;

use App\Controllers\BaseController;
use App\Models\utilisateur\UtilisateurModel;

class UtilisateurCont extends BaseController
{

    public function lien(): string
    {
        if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
            return view('utilisateur/index');
        }
        else {
            return view('dashboard/index');
        }
        
    }

    public function page_utilisateur()
    {
        if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
            $content = view('utilisateur/index');
            return view('layout',['content' => $content]);
        }
        else{
            $content = view('dashboard/index');
        return view('layout', ['content' => $content]);
        }
        
    }

    public function afficher()
    {
        // try {
        //     $utilisateurs = $this->utilisateur->findAll();

        //     $data['utilisateur'] = $utilisateurs;

        //     echo json_encode($data);
        // } catch (\Throwable $th) {
        //     echo $th;
        // }

        try {
            // $utilisateurs = $this->utilisateur->findAll();
            $utilisateurs = $this->utilisateur->where('etat', 1)->findAll();
            $th = "
                <thead>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mot de passe</th>
                        <th>Rôle</th>
                        "
                        ;
            if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
                $th .= "<th>Actions</th>";
            }
                       
            $th .= " </tr>
                   
            </thead> ";


            $th .= "<tbody>"; $n = 0;
            foreach ($utilisateurs as $value) {
                $n++;
                $th .=
                    '<tr>
                        <td style="width : 10%">'.$n.' </td>';
                $th .= '<td>';
                if (!empty($value["image"])) {
                    $th .= '<img src="' . base_url('assets/img/user/' . $value["image"]) . '" alt="User Image" style="max-width: 50px; max-height: 50px; clip-path:circle();">';
                }
                $th .= '</td>';

                $th .='                   
                        <td style="width : 50%">'.$value["nom_user"]. '</td> 
                        <td style="width : 50%">'.$value["prenom_user"].' </td>
                        <td style="width : 50%">'.$value["mdp_user"]. '</td> 
                        <td style="width : 50%">'.$value["role_user"].' </td>' ;

                        

                    if ($this->session->has('is_connected') && $this->session->get("role_user") == "admin") {
                        $th .= '
                        <td> <a class="info mr-1 " onclick="editUsers(' . $value["id_user"] .')"><i class=" la la-pencil"></i></a>
                        <a class="danger mr-1" onclick="supprimerUser('. $value["id_user"] .')"><i class=" la la-trash-o"></i></a> </td> 
                        ';
                    } 
                    
                    
                     $th .= '</tr>' ;
               
            }

            $th .= "</tbody> ";

            echo $th;
        } catch (\Throwable $th) {
            echo $th;
        }

        // try {
        //     $user_Model = new UtilisateurModel();
        //     $list_user = $user_Model->findAll();

        //     $data['user'] = $list_user;

        //     // Return data as JSON
        //     return $this->response->setJSON($data);
        // } catch (\Throwable $th) {
        //     // Handle exceptions appropriately
        //     return $this->response->setStatusCode(500)->setJSON(['error' => $th->getMessage()]);
        // }
    }

    // public function ajouter()
    // {

    //     try {

    //         // if (!empty($_FILES['image']['name'])) {
    //         //     $config['upload_path']   = '/assets/img/user/'; // Specify your upload directory
    //         //     $config['allowed_types'] = 'gif|jpg|jpeg|png';
    //         //     $config['max_size']      = 2048; // 2MB max size (adjust as needed)
    
    //         //     $this->load->library('upload', $config);
    
    //         //     if (!$this->upload->do_upload('image')) {
    //         //         echo json_encode(['status' => 'error', 'message' => $this->upload->display_errors()]);
    //         //         return;
    //         //     }
    
    //         //     $imageData = $this->upload->data();
    //         //     $data['image'] = $imageData['file_name'];
    //         // }

    //         // Récupérez les valeurs de la requête POST
    //         $nom_user = $_POST['nom'];
    //         $prenom_user = $_POST['prenom'];
    //         $mdp_user = $_POST['password'];
    //         $role_user = $_POST['role'];
    
    //         // Vérifiez si l'enregistrement existe déjà en fonction de la désignation
    //         $existingRecord = $this->utilisateur->where('nom_user', $nom_user)->where('prenom_user', $prenom_user)->where('role_user', $role_user)->first();
    
    //         if ($existingRecord) {
    //             echo json_encode(['status' => 'failed', 'message' => 'Utilisateur déjà existe.']);
    //         } else {
    //             $data = [
    //                 'nom_user' => $nom_user,
    //                 'prenom_user' => $prenom_user,
    //                 'mdp_user' => $mdp_user,
    //                 'role_user' => $role_user,
                    
    //             ];
    
    //             $this->utilisateur->insert($data);
    
    //             echo json_encode(['status' => 'success', 'message' => 'Ajout succès.']);
    //         }
    //     } catch (\Throwable $th) {
    //         echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
    //     }
    // }

    public function ajouter()
{
    try {
        // $validationRules = [
        //     'nom' => 'required',
        //     'prenom' => 'required',
        //     'password' => 'required',
        //     'role' => 'required',
        //     'image' => 'uploaded[image]|max_size[image,2048]|is_image[image]',
        // ];

        // if ($this->validate($validationRules)) {

            $password = $this->request->getPost('password');
            $confimPassword = $this->request->getPost('password_confirmation');

        // Check if the password length is less than 8 characters
        if (strlen($password) < 4 ) {
            echo json_encode(['status' => 'fail', 'message' => 'Le mot de passe doit contenir au moins 8 caractères.']);
            
        }
        else {

            if ($password!=$confimPassword) {
                echo json_encode(['status' => 'fail_p', 'message' => 'La confirmation du mot de passe est différent au mot de passe saisi.']);
            }
            else{

            $image = $this->request->getFile('image');
            

            if ($image->isValid() && !$image->hasMoved() && $image->getSize() <= (25 * 1024 * 1024)) {
                // Get the current date and time
                $currentDate = date('YmdHis');
                $nom_user = $this->request->getPost('nom');
                
                // Concatenate the current date and original name
                $newName = $currentDate . '_' . $nom_user;

                // Move the image to the destination folder with the new name
                $image->move(ROOTPATH . 'assets/img/user', $newName);
                $data['image'] = $newName;

                $data += [
                    'nom_user' => $this->request->getPost('nom'),
                    'prenom_user' => $this->request->getPost('prenom'),
                    'mdp_user' => $this->request->getPost('password'),
                    'role_user' => $this->request->getPost('role'),
                ];
    
                $existingRecord = $this->utilisateur->where('nom_user', $data['nom_user'])->where('prenom_user', $data['prenom_user'])->where('role_user', $data['role_user'])->where('etat !=', 0)->first();
    
                if ($existingRecord) {
                    echo json_encode(['status' => 'failed', 'message' => 'Utilisateur déjà existe.']);
                } else {
                    $this->utilisateur->insert($data);
                    echo json_encode(['status' => 'success', 'message' => 'Ajout succès.']);
                }
            }

            else{
                 // Set a default image when no image is uploaded
                $data = [
                    'nom_user' => $this->request->getPost('nom'),
                    'prenom_user' => $this->request->getPost('prenom'),
                    'mdp_user' => $this->request->getPost('password'),
                    'role_user' => $this->request->getPost('role'),
                    'image' => 'icon.jpg', // Set a default image when no image is uploaded
                ];

                $existingRecord = $this->utilisateur->where('nom_user', $data['nom_user'])->where('prenom_user', $data['prenom_user'])->where('role_user', $data['role_user'])->where("etat <>", 0)->first();

                if ($existingRecord) {
                    echo json_encode(['status' => 'failed', 'message' => 'Utilisateur déjà existe.']);
                } else {
                    $this->utilisateur->insert($data);
                    echo json_encode(['status' => 'success', 'message' => 'Ajout succès.']);
                }
            }
        }
        }
        // else {
        //     echo json_encode(['status' => 'error', 'message' => $this->validator->getErrors()]);
        // }
    } catch (\Throwable $th) {
        echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
    }
}


    public function get_user_details()
    {
        try {
            $id = $_POST['id'];
            $user = $this->utilisateur->find($id);
            if (!empty($user['image'])) {
                // Assuming image_path is the column in the database where the image path is stored
                // $user['image'] = base_url('assets/img/user/' . $user['image']);
                $user['image'] = $user['image'];
            }
            echo json_encode($user);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

    public function modifier()
{
    try {
        $id = $this->request->getPost('id');
            $nom_user = $this->request->getPost('nom');
            $prenom_user = $this->request->getPost('prenom');
            $mdp_user = $this->request->getPost('password');
            $role_user = $this->request->getPost('role');
            $label_image = $this->request->getPost('label_image');

            // Check if the ID is valid
            $existingRecord = $this->utilisateur->find($id);
            if (!$existingRecord) {
                echo json_encode(['error' => 'Utilisateur non trouvé']);
                return;
            }

            
            $image = $this->request->getFile('image');
            $image = $image ?? '';
            // var_dump($image); die;
            if ($image!='' && !$image->hasMoved() && $image->getSize() <= (25 * 1024 * 1024)) {
                // $newName = $image->getRandomName();
                // $image->move(ROOTPATH . 'assets/img/user', $newName);
                // $data['image'] = $newName;

                $currentDate = date('YmdHis');
                $nom_user = $this->request->getPost('nom');
                
                $newName = $currentDate . '_' . $nom_user;

                $image->move(ROOTPATH . 'assets/img/user', $newName);
                $data['image'] = $newName;


            }else {
                $data['image'] = $label_image;
            }
            

            $existingRecord = $this->utilisateur->where('nom_user', $nom_user)->where('prenom_user', $prenom_user)->where('role_user', $role_user)->where('id_user !=', $id)->where('etat !=', 0)->first();

            if ($existingRecord) {
                echo json_encode(['status' => 'failed', 'message' => 'Utilisateur existe déjà.']);
            } else {
                $data += [
                    'nom_user' => $nom_user,
                    'prenom_user' => $prenom_user,
                    'mdp_user' => $mdp_user,
                    'role_user' => $role_user,
                ];

                if ($this->utilisateur->update($id, $data)) {
                    if ($id == $_SESSION['id_user'] ) {                        
                        echo json_encode(['status' => 'success',
                            'message' => 'Mise à jour réussie.',
                            'deconnecter' => true]);
                    } else {
                        echo json_encode(['status' => 'success',
                            'message' => 'Mise à jour réussie.',
                            'deconnecter' => false]);
                    }
                };

            }
    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(['status' => 'error', 'message' => $th->getMessage()]);
    }
      
        
}


    public function supprimer()
    {
        try {

            $id = $_POST['id'];

            // Vérifiez si l'ID est valide
            if (!$this->utilisateur->find($id)) {
                echo json_encode(['error' => 'Utilisateur non trouvée']);
                return;
            }

            // Effectuez la suppression
            // $this->utilisateur->delete($id);

            $this->utilisateur->update($id, ['etat' => 0]);

            echo json_encode(['status' => 'success']);
        } catch (\Throwable $th) {
            echo json_encode(['error' => $th->getMessage()]);
        }
    }

}