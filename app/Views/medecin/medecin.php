<div class="content-wrapper" style="padding: 0 !important;">

    <div class="sidebar-detached sidebar-right" id="hide_categ_form">
        <div class="sidebar">
            <div class="bug-list-sidebar-content">
                <div class="card">

                    <div class="card-body">
                        <form id="ajout_medecin" class="form" method="post" action="ajout_medecin">
                            <fieldset class="form-group">
                                <input type="text" id="id_medecin_id" name="id_medecin" hidden>
                                <label for="nom_medecin">Nom</label>
                                <input type="text" id="nom_medecin_id" name="nom_medecin" class="form-control input-sm" data-toggle="tooltip" data-trigger="hover" data-placement="top" placeholder="Medecin" data-title="Nom du Medecin" required>
                            </fieldset>
                            <fieldset class="form-group">

                                <label for="">Specialité </label>

                                <select class="selectpicker  form-control btn-sm" name="id_specialite" required id="id_specialite_id" data-live-search='true' data-size='5' title='specialité'>

                                </select>

                            </fieldset>
                            <fieldset class="form-group">

                                <label for="">Cabinet </label>

                                <select class="selectpicker  form-control btn-sm" name="id_cabinet" required id="id_cabinet_id" data-live-search='true' data-size='5' title='cabinet'>

                                </select>

                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" id="ajoutermedecin" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
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
                            <div class="card-body card-dashboard" id="card_medecin">

                                <table id="table_medecin" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>