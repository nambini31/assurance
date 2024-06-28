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


                        <div class="card-content">
                            <div class="card-body" id="card_membre">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Listes</h6>
                                </center>
                                <table id="table_membre" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">
                                    
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="heading-elements mt-0">
        <div class="modal fade" id="AddContactModal" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_content_add_membre">
                    <div class="card-content collpase show">
                        <div class="card-body">

                            <h3 class="modal-header entete_modal">
                                Ajout Membre
                            </h3>

                            <br>
                            <form class="form" method="post" action="ajout_membre" id="ajout_membre">
                                <div class="form-body">

                                    
                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="usercontact" class="">Designation</label>
                                                <input type="text" id="usercontact" required  name="nom_membre" class="form-control input-sm" placeholder="Desgnation">
                                                <input type="hidden"  name="id_membre"  id="id_membre_men_modif">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="usercontact" class="">Telephone</label>
                                                <input type="text" id="usercontact"  name="contact_membre" class="form-control input-sm" placeholder="Telephone">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="usercontact" class="">Email</label>
                                                <input type="text" id="usercontact"  name="email_membre" class="form-control input-sm" placeholder="Email">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="usercontact" class="">Email</label>
                                                <textarea name="description" id="describe_membre"  class="form-control input-sm" cols="5" rows="10" placeholder="Description"></textarea>
                                                
                                            </div>
                                        </div>

                                    </div>
                                    
                                
                                </div>

                                <div class="form-actions right" >
                                    <button type="submit" id="btn_add_membre" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Ajouter</button>
                                    <button type="button" data-dismiss="modal" onclick="annulerAjoutmembre()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>

                                    <!-- <button type="submit" class="btn btn-sm" style="background-color: #FFB73E !important; color: white;">
                                        <i class="ft-check"></i> Enregistrer
                                    </button> -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<script src="<?php echo base_url() ?>/assets/js/membre/membre.js"></script>