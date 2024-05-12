<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">

                <div class="bug-list-sidebar-content">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Candidat</h4>
                        </div>
                        <div class="card-body">
                            <form id="ajout_candidat" class="form" method="post" action="ajout_candidat">
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            
                                            <select class="selectpicker  form-control" name="code_district" required id="code_district" data-live-search='true' data-size='5' title='District'>
                                                <!-- <option value="fd">Tahindraza nico</option> -->
                                            
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" id="editCandidatId" name="editCandidatId" hidden>
                                            <input type="text" name="numero_candidat" id="numero_candidat" class="form-control" placeholder="Numéro candidat" tabindex="1" required>
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" tabindex="1" required>
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                    </div>
                                    
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" tabindex="2" required>
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">

                                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                            <div class="form-control-position">
                                                <i class="la la-image"></i>
                                            </div>
                                            <label for="" id="label_image"></label>
                                        </fieldset>
                                    </div>
                                </div>

                                

                                <div class="form-actions">
                                    <button type="submit" id="ajouterButton" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
                                    <button type="button" onclick="Annuler_candidat()" id="annuler" class="btn btn-sm btn-outline-light btn-min-width mr-1 mb-1">Annuler</button>
                                </div>
                            </form>
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
                        <div class="row mt-1 pb-1 " style="width: 90%;margin-left: 0px">

                            <div class= "col-md-4 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="">Choix district : </label>

                                    <select class="selectpicker  form-control btn-sm" name="id_categorie" required id="id_categorie" data-live-search='true' data-size='5' title='District'>
                                        <!-- <option value="fd">Tahindraza nico</option> -->
                                    </select>
                                </div>

                                <input type="hidden" id="recherche_date_debut" class="form-control input-sm" name="" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Début de la Promotion">
                            </div>


                            

                        </div>

                    </div>
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard" id="card_candidat">
                                    <center>
                                        <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Liste des candidats</h6>
                                    </center>
                                    <table id="table_candidat" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

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

<script src="<?php echo base_url() ?>/assets/js/candidat.js"></script>