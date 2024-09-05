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
                                                <label for="type_personne_select" class="">Choix Personne Malade</label>
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
                            <form action="">
                            <div class="form-actions right" >
                                    <button type="submit" id="btn_add_patie" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Valider</button>

                                </div>
                            </form>

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
                           
                                
                                    <p>Voulez-vous supprimer cette consultation  ?</p>
                    
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
                                <div class="form-actions right" >
                                    <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Valider</button>

                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddLaboratoire" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
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
                                <div class="flowscroll">

                                    <table id="table_parametre" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                     <tr>
                                        <input type="hidden" name="idDetails" id="idDetails">
                                        <th style="text-align:left; width:5%">Temperature</th>
                                        <td><input disabled type="text" class="form-control input-sm"  id="temperature2"></td>
                                        <td style="text-align:center"><strong>°C</strong></td>
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">Tension</th>
                                        <td><input disabled type="text" class="form-control input-sm"  id="tension2"> </td>
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">Taille</th>
                                        <td><input disabled type="text" class="form-control input-sm"  id="taille2"> </td>
                                        <td style="text-align:center"><Strong>Mètre</Strong></td>
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">Poids</th>
                                        <td><input disabled type="text" class="form-control input-sm"  id="poids2"></td>
                                        <td style="text-align:center; width:3%"><Strong>KG</Strong></td>
    
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">Nature de l'examen</th>
                                        <td colspan="2"><select class="selectpicker  form-control btn-sm" name = 'nature[]'  required id="analyse_select" multiple data-live-search='true' data-size='5' title='analyse' data-selected-text-format="count > 3"
                                        data-count-selected-text="{0} Nature selected">
                                                       
                                                    </select></td>
    
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">Resultats</th>
                                        <td colspan="2"><input type="text" class="form-control input-sm" name="resultats" id="resultats"></td>
                                        
    
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">R.C</th>
                                        <td colspan="2"><input type="text" class="form-control input-sm" name="rc"  id="rc"></td>
                                        
    
                                     </tr>
                                     <tr>
                                        <th style="text-align:left; width:5%">Destinataire</th>
                                        <td colspan="2"><select class="selectpicker  form-control btn-sm"  required id="type_personne_select" data-live-search='true' data-size='5' title='type destinataire'>
                                                        <option value="Titulaire" selected >Laboratoire</option>
                                                    </select></td>
    
                                     </tr>
                                    </table>
                                </div>
                                <div class="form-actions right" >
                                    <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Envoyé au laboratoire</button>

                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddVisites" style="z-index: 99999999 ; margin-top: 0% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" id="modal_visites" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modal">
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