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
                        <div class="row mt-1 pb-1 " style="width: 90%;margin-left: 0px">

                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="">Choix district : </label>

                                    <select class="selectpicker  form-control btn-sm" name="id_categorie" required id="district_choix" data-live-search='true' data-size='5' title='District'>

                                    </select>
                                </div>

                            </div>


                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="">Choix Commune : </label>

                                    <select class="selectpicker  form-control btn-sm" name="id_categorie" required id="commune_choix" data-live-search='true' data-size='5' title='Commune'>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="">Choix Quartier : </label>

                                    <select class="selectpicker  form-control btn-sm" name="id_categorie" required id="fokontany_choix" data-live-search='true' data-size='5' title='Quartier'>

                                    </select>
                                </div>

                            </div>

                            <div class="col-md-1 ml-1 mr-1">

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <button style="margin-top: 4px;" type="button" id="btn_recherche" onclick="filtrerResultat()" class=" btn btn-sm btn-warning "><i class="ft ft-search"></i></button>

                                </div>


                            </div>

                        </div>

                    </div>
                    <div class="card">


                        <div class="card-content">
                            <div class="card-body" id="card_resultat">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Resultat</h6>
                                </center>
                                <table id="table_resultat" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="heading-elements mt-0">
        <div class="modal fade" id="ResultatModal" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_content_add_res">
                    <div class="card-content collpase show">
                        <div class="card-body">

                            <h3 class="modal-header entete_modal">
                                Ajout resultat
                            </h3>

                            <br>
                            <form class="form" method="post" action="ajout_resultat" id="ajout_resultat">
                                <div class="form-body">

                                    <div class="row">
                                    <input type="hidden" name="id_resultat" id="id_resultat_men_modif">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput2" class="">District</label>
                                                <select class="selectpicker  form-control btn-sm" name="code_district" required id="select_district" data-live-search='true' data-size='5' title='District'>

                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput2" class="">Bureau de vote</label>
                                                <select class="selectpicker  form-control btn-sm" name="code_bv" required id="select_bv" data-live-search='true' data-size='5' title='Bureau de vote actuel'>

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" id="id_voix_res">
                                    </div>

                                </div>

                                <div class="form-actions right">
                                    <button type="submit" id="btn_add_resultat" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Ajouter</button>
                                    <button type="button" data-dismiss="modal" onclick="annulerAjoutResultat()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>

                                    <!-- <button type="submit" class="btn btn-sm" style="background-color: #FFB73E !important; color: white;">
            <i class="ft-check"></i> Enregistrer
        </button> -->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<script src="<?php echo base_url() ?>/assets/js/resultat.js"></script>