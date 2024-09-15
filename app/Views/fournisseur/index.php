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
                            <div class="card-body" id="card_fournisseur">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Liste des fournisseurs</h6>
                                </center>
                                <table id="tb_fournisseur" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">
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
                <div class="modal-content" id="modal_content_add_art">
                    <div class="card-content collpase show">
                        <div class="card-body">

                            <h3 class="modal-header entete_modal">
                                Nouvel Fournisseur
                            </h3>

                            <br>
                            <form class="form" method="post" action="ajout_fournisseur" id="ajout_fournisseur">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" name="id_fournisseur" id="id_fournisseur_men_modif">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput3" class="">Désignation</label>
                                                <input type="text" id="designation" required name="designation" class="form-control input-sm" placeholder="Nom fournisseur">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Email</label>
                                                <input class="form-control input-sm" name="email" required type="email" placeholder="Adresse electronique" id="email" required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Téléphone</label>
                                                <input class="form-control input-sm" name="telephone" required type="text" placeholder="Numéro téléphone" id="telephone">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Adresse</label>
                                                <input class="form-control input-sm" name="adresse" required type="text" placeholder="Adresse fournisseur" id="adresse">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-actions right" style="height: 85px;">
                                    <button type="submit" id="btn_add_fournisseur" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Ajouter</button>
                                    <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<script src="<?php echo base_url() ?>/assets/js/fournisseur/fournisseur.js"></script>