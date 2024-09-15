<div class="content-wrapper" style="padding: 0 !important;">

    <div class="sidebar-detached sidebar-right" id="hide_categ_form">
        <div class="sidebar">
            <div class="bug-list-sidebar-content">
                <div class="card">
                
                    <div class="card-body">
                        <form id="ajout_methodePf" class="form" method="post" action="ajout_methodePf">
                            <fieldset class="form-group">
                                <input type="text" id="id_methodePf" name="idmethodePf" hidden>
                                <label for="nom_methodePf">Methodes</label>
                                <input type="text" id="nom_methodePf" name="methodePf" class="form-control" data-toggle="tooltip" data-trigger="hover" data-placement="top" placeholder="Methodes" data-title="Nom de methode contraceptive" required>
                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" id="ajoutermethodePf" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
                                <button type="button" onclick="AnnulermethodePf()" id="annuler" class="btn btn-sm btn-outline-light btn-min-width mr-1 mb-1">Annuler</button>
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
                            <div class="card-body card-dashboard" id="card_methodePf">

                                <table id="table_methodePf" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>