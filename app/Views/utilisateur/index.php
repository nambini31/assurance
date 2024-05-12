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
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" id="editUserId" name="editUserId" hidden>
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
                                </div>

                                <div class="form-group text-center">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="Admin" value="admin">
                                        <label class="form-check-label" for="male">Admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="role" id="Simple" value="simple">
                                        <label class="form-check-label" for="female">Simple</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" tabindex="5" required>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmer le Mot de passe" tabindex="6" data-validation-matches-match="password" data-validation-matches-message="Password & Confirm Password must be the same." required>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                            <div class="help-block font-small-3"></div>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row">
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