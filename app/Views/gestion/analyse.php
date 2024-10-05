<div class="content-wrapper" style="padding: 0 !important;">

    <div class="sidebar-detached sidebar-right" id="hide_categ_form">
        <div class="sidebar">
            <div class="bug-list-sidebar-content">
                <div class="card">

                    <div class="card-body">
                        <form id="ajout_analyse" class="form" method="post" action="ajout_analyse">
                            <fieldset class="form-group">

                                <label for="">Role Utilisateur</label>

                                <select class="selectpicker  form-control btn-sm" name="user_role_non_formate[]" id="role_user" required  multiple data-live-search='true' data-size='5' title='Role utilisateur'>
                                        <option value="3">Parametre Admin</option>
                                        <option value="4">Parametre Simple</option>
                                        <option value="8">Docteur</option>
                                </select>

                            </fieldset>
                            <fieldset class="form-group">

                                <label for="">Type d'analyse </label>

                                <select class="selectpicker  form-control btn-sm" name="type_analyse" id="id_type_analyse_id" required  data-live-search='true' data-size='5' title="Type d'analyse">

                                </select>

                            </fieldset>
                            <fieldset class="form-group">
                                <input type="text" id="id_analyse_id" name="id_analyse" hidden>
                                <label for="nom_analyse">Analyse</label>
                                <input type="text" id="nom_analyse_id" name="analyse" class="form-control input-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" placeholder="Nom d'analyse" data-title="Nom d'analyse" required>
                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" id="ajouteranalyse" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
                                <button type="button" onclick="Annuler()" id="annuler" class="btn btn-sm btn-outline-light btn-min-width mr-1 mb-1">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-detached content-center">
        <div class="content-body">
            <section class="row all-contacts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard" id="card_analyse">

                                <table id="table_analyse" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>