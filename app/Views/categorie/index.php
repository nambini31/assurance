<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">
               
                    <div class="sidebar-detached sidebar-right" id="hide_categ_form">
                        <div class="sidebar">
                            <div class="bug-list-sidebar-content">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Catégorie</h4>
                                    </div>
                                    <div class="card-body">
                                        <form id="ajout_categorie" class="form" method="post" action="ajouter_categorie">
                                            <fieldset class="form-group">
                                                <input type="text" id="editCategoryId" name="editCategoryId" hidden>
                                                <input type="text" id="designation" name="designation" class="form-control input-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" placeholder="Catégorie" data-title="Nom du catégorie" required>
                                            </fieldset>
                                            <div class="form-actions">
                                                <button type="submit" id="ajouterButton" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
                                                <button type="button" onclick="Annuler()" id="annuler" class="btn btn-sm btn-outline-light btn-min-width mr-1 mb-1">Annuler</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
              
            </div>
        </div>

        <div class="content-detached content-left">
            <div class="content-body">
                <section class="row all-contacts">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard" id="card_categorie">

                                    <table id="table_categorie" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url() ?>/assets/js/categorie.js"></script>
