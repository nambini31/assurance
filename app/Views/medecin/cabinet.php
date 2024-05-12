<div class="content-wrapper" style="padding: 0 !important;">

    <div class="sidebar-detached sidebar-right" >
        <div class="sidebar">
            <div class="bug-list-sidebar-content">
                <div class="card">
                    
                    <div class="card-body">
                        <form id="ajout_cabinet" method="post" action="ajouter_cabinet">
                            <fieldset class="form-group">
                                <input type="hidden" id="id_cabinet" name="id_cabinet" >
                                <label for="nom_cabinet">Designation</label>
                                <input type="text" id="nom_cabinet" name="nom_cabinet" class="form-control" placeholder="Cabinet" data-title="Nom du Cabinet" required>
                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" id="ajoutercab" class="btn btn-sm btn-warning btn-min-width mr-1 mb-1">Ajouter</button>
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
                            <div class="card-body card-dashboard" id="card_cabinet">

                                <table id="table_cabinet" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>