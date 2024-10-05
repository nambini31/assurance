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
                            <div class="card-body" id="card_article_menuiserie">
                            <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Liste d'Articles</h6>
                                </center>
                                <table id="users-contacts" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">
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
                                Nouvel Article
                            </h3>

                            <br>
                            <form class="form" method="post" action="ajout_article" id="ajout_article">
                                <div class="form-body">

                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" id="id_article" name="id_article">
                                                <label for="userinput1" class="">Fournisseur</label>
                                                <select class="selectpicker  form-control btn-sm" name="id_fournisseur" required id="id_fournisseur" data-live-search='true' data-size='5' title='Fournisseur'>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput3" class="">Désignation</label>
                                                <input type="text" id="designation" required name="designation" class="form-control input-sm" placeholder="Désignation">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Unité</label>
                                                <select class="selectpicker  form-control btn-sm" name="unite" required id="unite" data-live-search='true' data-size='5' title='Unité'>
                                                    <option value="BT">Boite</option>
                                                    <option value="Flacon">Flacon</option>
                                                    <option value="Tube">Tube</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Presentation</label>
                                                <input class="form-control input-sm" name="presentation" required type="text" placeholder="Presentation" id="presentation">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Prix Unitaire</label>
                                                <input class="form-control input-sm" name="prix_unitaire" required type="text" placeholder="Prix Unitaire ( Ariary )" id="prix_unitaire">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1" class="">Date peremption</label>
                                                <input class="form-control input-sm" name="dateperemption" required type="datetime-local" placeholder="Date peremptiom" id="dateperemption">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-actions right" style="height: 50px;">
                                    <button type="submit" id="btn_add_article" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Ajouter</button>
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


<script src="<?php echo base_url() ?>/assets/js/article/article.js"></script>