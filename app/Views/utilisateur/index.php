<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
    
        <div class="sidebar-detached sidebar-right">
            <div class="sidebar">

                <div class="bug-list-sidebar-content">
                    
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Utilisateur</h4>
                        </div>
                        <div class="card-body">
                            <form id="ajout_utilisateur" class="form" method="post" action="ajout_utilisateur">
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">
                                            <input type="text" id="editUserId" name="editUserId" hidden>
                                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" tabindex="1" required>
                                            <div class="form-control-position">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">
                                            <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" tabindex="2" required>
                                            <div class="form-control-position">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" tabindex="5" required>
                                            
                                        </fieldset>
                                    </div>

                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmer le Mot de passe" tabindex="6" data-validation-matches-match="password" data-validation-matches-message="Password & Confirm Password must be the same." required>
                                            <div class="form-control-position">
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">
                                        <select class="selectpicker  form-control btn-sm" name="roleId"  required id="select_role" data-live-search='true' data-size='5' title='Role utilisateur'>
                                                
                                        </select>
                                            
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">
                                        <div id="typeMedecin"></div>
                                            
                                        </fieldset>
                                    </div>
                                    
                                </div>

                               
                                <div class="row">
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative ">

                                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                            <div class="form-control-position">
                                                <i class="la la-image"></i>
                                            </div>
                                            <label for="" id="label_imagetxt"></label>
                                            <input type="hidden" name="label_image" id="label_image" />

                                        </fieldset>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" id="ajouterButton" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
                                    <button type="button" onclick="Annuler_users()" id="annuler" class="btn btn-sm btn-outline-light btn-min-width mr-1 mb-1">Annuler</button>
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
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard" id="card_utilisateur">
                                    <center>
                                        <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Liste des utilisateurs</h6>
                                    </center>
                                    <table id="table_user" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

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

<script src="<?php echo base_url() ?>/assets/js/utilisateur/utilisateur.js"></script>