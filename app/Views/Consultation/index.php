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
        <div class="modal fade" id="AddpatientMalade" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_content_patient">
                    <div class="card-content collpase show">
                        <div class="card-body">

                            <h3 class="modal-header entete_modal">
                                Ajout Consultation 
                            </h3>

                            <br>
                            <form class="form" method="post" action="ajout_consultation" id="ajout_consultation">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="id_consultation" id="id_consultation_men_modif">
                                            <div class="form-group">
                                                <label for="type_personne_select" class="">Type patient</label>
                                                <select class="selectpicker  form-control btn-sm" name = 'id_membre'  required id="type_personne_select" data-live-search='true' data-size='5' title='type patient'>
                                                    <option value="Titulaire">Titulaire</option>
                                                    <option value="Conjoint">Conjoint</option>
                                                    <option value="Enfant">Enfant</option>
                                                </select>
                                            </div>
                                        </div>
                                      
                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="patient_select" class="">Patient</label>
                                                <select class="selectpicker  form-control btn-sm" name = "numero_patient" required id="patient_select" data-live-search='true' data-size='5' title='Patient'>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                   
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="motif" class="">Motif</label>
                                                <textarea name="motif" required id="motif" class="form-control input-sm" cols="2" rows="2"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    
  
                                </div>

                                <div class="form-actions right" >
                                    <button type="submit" id="btn_add_patient" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Ajouter</button>
                                    <button type="button" data-dismiss="modal" onclick="annulerPatientMalade()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>

                                    
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

                            <h3 class="modal-header entete_modal">
                                Liste des patients 
                            </h3>

                            <br>
                            <table id="table_patient" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                
                            </table>
                            <form action="">
                            <div class="form-actions right" >
                                    <button type="submit" id="btn_add_consultation" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Valider</button>
                                    <button type="button" data-dismiss="modal" onclick="annulerConsultation()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>

                                    
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