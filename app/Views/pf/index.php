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
                            <div class="card-body" id="card_pf">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Listes</h6>
                                </center>
                                <table id="table_pf" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="heading-elements mt-0">
        
        
        
        <div class="modal fade" id="deletePf" style="z-index: 99999999 ;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
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
                           
                                
                                    <p>Voulez-vous supprimer ce patient  PF ?</p>
                    
                                        <button type="button" onclick="delete_pf()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                                        <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                    
                    
                                
                            
                          

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddVisites" style="z-index: 99999999 ; margin-top: 0% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content" id="modal_visites" style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                            <h3 class="modal-header entete_modalVIS">
                                Ajout PF
                            </h3>

                            <br>
                            
                            <form method="post" id="add_pf">
                            <div class="form-body">
                                <input type="hidden" name="idpf" id="id_cpnfirt">
                                <div class="flowscroll">
                                    <table class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto !important;">
                                                        
                                                        <tr>
                                                            <td style="text-align:left ; text-wrap: wrap;">Choix Membre</th>
                                                            <td><select class="selectpicker  form-control btn-sm" name = 'membre_select'  required id="membre_select" data-live-search='true' data-size='5' title='Choix membre'>
                                                    
                                                                </select>
                                                            </td>
                        
                                                         </tr> 
                                                     
                                                     <tr>
                                                        <td style="text-align:left">Choix Titulaire ( N° Carte )</th>
                                                        <td><select class="selectpicker  form-control btn-sm" name = "titulaireId" required id="titulaire_select" data-live-search='true' data-size='5' title='Choix titulaire'>
    
                                                        </select></td>
                    
                                                     </tr>
                                                     <tr>
                                                        <td style="text-align:left">Choix Patient PF</th>
                                                        <td><select class="selectpicker  form-control btn-sm" name = 'personne'  required id="personne_selectpf" data-live-search='true' data-size='5' title='Choix patient'>
    
                                                        </select></td>
                    
                                                     </tr>
                                                     <tr>
                                                        <td style="text-align:left">Choix Methodes PF</th>
                                                        <td><select class="selectpicker  form-control btn-sm" name = 'idmethodePf'  required id="idmethodepf" data-live-search='true' data-size='5' title='Choix methode'>
    
                                                            </select></td>
                    
                                                     </tr>
                                                     <tr>
                                                        <td style="text-align:left">Taille</th>
                                                        <td><input type="text" class="form-control input-sm" required name="taille" id="taille"></td>
                    
                                                     </tr>
                                                     <tr>
                                                        <td style="text-align:left">Poids</th>
                                                        <td><input type="text" class="form-control input-sm" required name="poids" id="poids" ></td>
                    
                                                     </tr>
                                                     <tr>
                                                        <td style="text-align:left">Tension</th>
                                                        <td><input type="text" class="form-control input-sm" required name="tension" id="tension"></td>
                    
                                                     </tr>
                                                     <tr>
                                                        <td style="text-align:left">Date rendez-vous</th>
                                                        <td><input type="date" class="form-control input-sm" required name="dateRendezVous" ></td>
                    
                                                     </tr>
                                                  
                                                    </table>
                                    
                                </div>
  
                                <div class="form-actions right" >
                                    <button type="submit" id="btn_add_cpn_first" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width">Ajouter</button>

                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>


<script src="<?php echo base_url() ?>/assets/js/pf/pf.js"></script>