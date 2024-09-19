<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="content-overlay"></div>

            <section class="row all-contacts">
                <div class="col-12">
                    <div class="card">
                        <div class="row mt-1 pb-1 " style="width: 90%;margin-left: 0px">

                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="">Choix Membres : </label>

                                    <select class="selectpicker  form-control btn-sm" name="id_membre" required id="membre_choix" data-live-search='true' data-size='5' title='Membre social'>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="datedeb">Date debut : </label>
                                    <input type="date" class="form-control input-sm" name="" id="date_debut">
                                </div>

                            </div>
                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="datefin">Date fin : </label>
                                    <input type="date" class="form-control input-sm" name="" id="date_fin">
                                </div>

                            </div>
                            <div class="col-md-1 ml-1 mr-1">

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <button style="margin-top: 4px;" type="button" id="btn_recherche" onclick="filtrerVisite()" class=" btn btn-sm btn-warning "><i class="ft ft-search"></i></button>

                                </div>


                            </div>



                        </div>

                    </div>
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body" id="card_consultation">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Listes</h6>
                                </center>
                                <table id="table_consultation" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="heading-elements mt-0">
        <div class="modal fade" id="AddpatientMalade" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_content_patient" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modal_pat">
                                Ajout patient 
                            </h3>

                            <br>
                            <form class="form" method="post" id="ajout_patient">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="titulaireId" id="id_patient">
                                            <input type="hidden" name="consultationId" id="id_concult">
                                            <input type="hidden" name="detailConsultationId" id="id_detail_consultattion">
                                            <div class="form-group">
                                                <label for="type_personne_select" class="">Choix Patient Malade</label>
                                                <select class="selectpicker  form-control btn-sm" name = 'personne'  required id="personne_select" data-live-search='true' data-size='5' title='Choix patient'>

                                                </select>
                                            </div>
                                        </div>
                                      
                                    </div>

                                   
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="motif" class="">Motif</label>
                                                <textarea name="motif" required id="motif_persMalade" class="form-control input-sm" cols="2" rows="2"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    
  
                                </div>

                                <div class="form-actions right" >
                                    <button type="submit" id="btn_add_patient" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Ajouter</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddConsultation" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" id="modal_Consultation">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h4 class="modal-header entete_modal1">
                                Carte N° : OMI-205
                            </h4>
                            <input type="hidden" id="titulaire_id">
                            <br>
                            <table id="table_patient" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                
                            </table>
                            <h6 class="entete_docteur">
                                Docteur : Dr. TAHINDRAZA Nico ( Dr Generaliste )

                            </h6>
                            <form method="post">
                                <div class="form-actions right" id="hideValidParamDoc" >
                                    <button type="button" id="btn_add_patie" onclick="envoyer_doc()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Valider</button>
                                </div>
                               
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ListesLabo" style="z-index: 99999999 ; margin-top: 1% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
                <div class="modal-content" id="ListesLabocontent"  style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )" >
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            
                    <div class="card" style="box-shadow: none;">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-underline">
                                    
                                    <?php 
                                    if (in_array($_SESSION['roleId'], ["3" , "4" , "8" , "5"])) {              
                                        ?>
                                        <li class="nav-item">
                                        <a class="nav-link active" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21" href="#tabIcon21" aria-expanded="true"><i class="la la-tag"></i>Paramètres</a>
                                    </li>
                                        <?php 
                                                }
                                        ?>
                                        <?php 
                                    if (in_array($_SESSION['roleId'], ["8" , "5"])) {              
                                        ?>
                                         <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab23" data-toggle="tab" aria-controls="tabIcon23" href="#tabIcon23" aria-expanded="false"><i class="ft-layers"></i> Examen clinique</a>
                                    </li>
                                         <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab24" data-toggle="tab" aria-controls="tabIcon4" href="#tabIcon24" aria-expanded="false"><i class="ft-layers"></i> Autres actes</a>
                                    </li>
                                        
                                        <?php 
                                                }
                                        ?>

                                    <?php 
                                    if (in_array($_SESSION['roleId'], ["8" , "5" , "6"])) {              
                                        ?>
                                         <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22" href="#tabIcon22" aria-expanded="false"><i class="ft-layers"></i> Examens paracliniques</a>
                                    </li>
                                        <?php 
                                                }
                                        ?>

                                        <?php 
                                    if (in_array($_SESSION['roleId'], ["8" , "9" , "5"])) {              
                                        ?>
                                         <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab25" data-toggle="tab" aria-controls="tabIcon25" href="#tabIcon25" aria-expanded="false"><i class="ft-layers"></i> Prescriptions</a>
                                    </li>
                                         
                                        <?php 
                                                }
                                        ?>
                                        <?php 
                                    if (in_array($_SESSION['roleId'], ["8" , "5"])) {              
                                        ?>
                                         <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab26" data-toggle="tab" aria-controls="tabIcon26" href="#tabIcon26" aria-expanded="false"><i class="ft-layers"></i> Conclusions</a>
                                    </li>
                                         
                                        <?php 
                                                }
                                        ?>
                                        <?php 
                                    if (in_array($_SESSION['roleId'], ["8" , "5"])) {              
                                        ?>
                                         <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab27" data-toggle="tab" aria-controls="tabIcon27" href="#tabIcon27" aria-expanded="false"><i class="ft-layers"></i> Antecedents</a>
                                    </li>
                                         
                                        <?php 
                                                }
                                        ?>
                                   
                                    
                                
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="tab-content">

                            
                        <?php 
                                    if (in_array($_SESSION['roleId'], ["8" , "5"])) {              
                                        ?>
                                        <div class="tab-pane"  id="tabIcon23" aria-expanded="true" aria-labelledby="baseIcon-tab23">
                                <?= view("Consultation/clinique.php") ?>
                            </div>
                                         
                                        <?php 
                                                }
                                    
                                                if (in_array($_SESSION['roleId'], ["8" , "5" , "6"])) {   

                                                    ?>
  
                                    <div role="tab-panel" class="tab-pane"  id="tabIcon22" aria-expanded="true" aria-labelledby="baseIcon-tab22">
                                        <?= view("Consultation/demande.php") ?>
                                    </div>
                                         
                                        <?php  
                                                    
                                                }
                                                ?>

                                                 <?php 
                    
                                    
                                                if (in_array($_SESSION['roleId'], ["8" , "5" , "3" , "4"])) {   

                                                    ?>
                                        <div class="tab-pane active" id="tabIcon21" aria-expanded="true" aria-labelledby="baseIcon-tab21">
                                            <?= view("Consultation/parametre.php") ?>
                                        </div>
                                         
                                        <?php  
                                                    
                                                }
                                                ?>



                            
                        </div>
                    </div>
               
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deletepatient" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                            <div class="card-body" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
   
                            
                            
                                    <div class="card-header">
                                            <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                                    </div>
                           
                                
                                    <p>Voulez-vous supprimer ce patient  ?</p>
                    
                                        <button type="button" onclick="delete_detail()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                                        <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                    
                    
                                
                            
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deletelabo" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                            <div class="card-body" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
   
                            
                            
                                    <div class="card-header">
                                            <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                                    </div>
                           
                                
                                    <p>Voulez-vous supprimer cette demmande d'examen  ?</p>
                    
                                        <button type="button" onclick="delete_laboExam()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                                        <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                    
                    
                                
                            
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="valideLabo" style="z-index: 99999999; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                <div class="card-content collapse show">
                    <div class="card-body" style="text-align: center;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>

                        <div class="card-header">
                            <i class="la la-check-circle success" style='font-size:50px'></i>
                        </div>

                        <p>Veuillez sélectionner le resultat d'analyse pour confirmer cette demande ?</p>

                        <!-- Ajout de l'input file avec un label -->
                        <form id="form_analyse">
                            <div class="form-group">
                                <!-- Label pour l'input file -->
                                <table id="" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                 <tr>
                                    <td style="text-align:center"><input type="file" id="fichierAnalyse" name="fichierAnalyse" class="form-control-file" required></td>
                                 </tr></table>
                            </div>
                            <!-- Bouton de confirmation -->
                            <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width">
                                <i class="ft-check"></i> Oui
                            </button>
                            <!-- Bouton d'annulation -->
                            <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width">
                                <i class="ft-x"></i> Annuler
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="valideParametre" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                            <div class="card-body" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
   
                            
                            
                                    <div class="card-header">
                                            <i class="la la-check-circle success" style='font-size:50px'></i>
                                    </div>
                           
                                
                                    <p>Souhaitez-vous valider le paramétrage et envoyer le patient au docteur ?</p>
                    
                                        <button type="button" onclick="confirmer_anvoie_doc()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                                        <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                    
                    
                                
                            
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteconsultation" style="z-index: 99999999 " tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                            <div class="card-body" style="text-align: center;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
   
                            
                            
                                    <div class="card-header">
                                            <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                                    </div>
                           
                                
                                    <p>Voulez-vous confirmer cette suppression  ?</p>
                    
                                        <button type="button" onclick="delete_consultation()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                                        <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                    
                    
                                
                            
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddParametre" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_parametre" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modal">
                                Parametrage
                            </h3>

                            <br>
                            
                            <form method="POST" id="add_parametre" >
                                <table id="table_parametre" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                 <tr>
                                    <th>Temperature</th>
                                    <input type="hidden" name="idDetailsCons" id="idDetailsCons">
                                    <td><input type="text" class="form-control input-sm" required name="temperature" id="temperature"></td>
                                    <td style="text-align:center"><strong><span id="temperature1"> </span> °C</strong></td>
                                 </tr>
                                 <tr>
                                    <th>Tension</th>
                                    <td><input type="text" class="form-control input-sm" required name="tension" id="tension"> </td>
                                    <td><span id="tension1"> </span></td>
                                 </tr>
                                 <tr>
                                    <th>Taille</th>
                                    <td><input type="text" class="form-control input-sm" required name="taille" id="taille"> </td>
                                    <td style="text-align:center"><Strong><span id="taille1"> </span> Mètre</Strong></td>
                                 </tr>
                                 <tr>
                                    <th>Poids</th>
                                    <td><input type="text" class="form-control input-sm" required name="poids" id="poids"></td>
                                    <td style="text-align:center"><Strong><span id="poids1"> </span> KG</Strong></td>

                                 </tr>
                                </table>

                                <?php 
                                        //verifier si c'est superAdmin
                                        if (!in_array($_SESSION['roleId'], ["6" , "3"])) {              
                                        ?>
                                        <div class="form-actions right" id="hideValidParam" >

                                                        
                                            <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Valider</button>


                                            </div>
                                        <?php 
                                                }
                                        ?>
                               
                                    
                              
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddDocteur" style="z-index: 99999999 ; margin-top: 1% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" id="modal_docteur" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modal">
                                Parametrage
                            </h3>

                            <br>
                            
                            <form method="POST" >
                                <table id="table_parametre" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                    <tr>
                                        <th>Description Douleur</th>
                                    </tr>
                                    <tr>
                                        <th><textarea name="" id="" class="form-control input-sm" cols="30" rows="3"></textarea></th>
                                    </tr>
                                    
                                </table>       
                                
                                
                                <table id="table_parametre" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                    <tr>
                                        <th>Liste medicaments</th>
                                    </tr>
                                    <tr>
                                    <table id="table_parametre" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                     <thead>

                                         <tr>
                                            <th style="text-align:left; width:5%">Id</th>
                                            <th style="text-align:left; width:50%">Medicament</th>
                                            <th style="text-align:left; width:5%">Qte</th>
                                            <th style="text-align:left; width:30%">Utilisation</th>
                                            
                                         </tr>
                                     </thead>
                                     <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Medicament</td>
                                            <td>5</td>
                                            <td>Mihina Maray midy</td>
                                        </tr>
                                     </tbody>
                                     
                                    </table>  
                                    </tr>
                                        
                              
                                </table>   

                             
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddLaboratoire" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_laboratoire" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modal">
                                DEMANDE D'EXAMEN
                            </h3>

                            <br>
                            
                            <form method="post" id="add_examen">
                                
                                <input type="hidden" name="idConsPour" id="idConsPour">
                                <input type="hidden" name="idenvoie_labo" id="idenvoielabo">
                                <input type="hidden" name="idDetails" id="idDetails">

                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="analyse_select" class="">Nature de l'examen</label>
                                            <select class="selectpicker  form-control btn-sm" name = 'nature[]'  required id="analyse_select" multiple data-live-search='true' data-size='5' title='analyse' data-selected-text-format="count > 3"
                                            data-count-selected-text="{0} Nature selected">
                                                           
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="resultats" class="">Resultats</label>
                                            <input type="text" class="form-control input-sm" name="resultats" id="resultats">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="rc" class="">R.C</label>
                                            <input type="text" class="form-control input-sm" name="rc"  id="rc">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="type_personne_select" class="">Destinataire</label>
                                            <select class="selectpicker  form-control btn-sm"  required id="type_personne_select" data-live-search='true' data-size='5' title='type destinataire'>
                                                            <option value="Titulaire" selected >Laboratoire</option>
                                                        </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="form-actions right" id="hideValidLabo">
                                    <button type="submit"  class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Envoyé au laboratoire</button>
                                </div>

                                
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddVisites" style="z-index: 99999999 ; margin-top: 0% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content" id="modal_visites" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modalVIS">
                                Ajout visite
                            </h3>

                            <br>
                            
                            <form method="post" id="add_consultation">
                            <div class="form-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="consultationId" id="id_consultation">
                                        <div class="form-group">
                                            <label for="type_personne_select" class="">Choix Membre</label>
                                            <select class="selectpicker  form-control btn-sm" name = 'membre_select'  required id="membre_select" data-live-search='true' data-size='5' title='Choix membre'>
                                                
                                            </select>
                                        </div>
                                    </div>
                                
                                </div>
                                <div class="row">
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="patient_select" class="">Choix Titulaire ( N° Carte )</label>
                                            <select class="selectpicker  form-control btn-sm" name = "titulaireId" required id="titulaire_select" data-live-search='true' data-size='5' title='Choix titulaire'>

                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="patient_select" class="">Specialité Docteur</label>
                                            <select class="selectpicker  form-control btn-sm" name = "typeConsultationId" required id="specialite_docteur" data-live-search='true' data-size='5' title='Specialité docteur'>

                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="patient_select" class="">Choix Docteur</label>
                                            <select class="selectpicker  form-control btn-sm" name = "docteurId" required id="choix_docteur" data-live-search='true' data-size='5' title='Choix docteur'>

                                            </select>
                                        </div>
                                    </div>

                                </div>


                                </div>
                                <div class="form-actions right" >
                                    <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width">Suivant <i class="ft-arrow-right"></i></button>

                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>


<script src="<?php echo base_url() ?>/assets/js/consultation/consultation.js"></script>
