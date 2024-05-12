<div class="app-content content">




    <div class="content-wrapper" id="id_dash_reload">
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
                        <button style="margin-top: 4px;" type="button" id="btn_recherche" onclick="filtrerDelegue()" class=" btn btn-sm btn-warning "><i class="ft ft-search"></i></button>

                    </div>


                </div>

            </div>

        </div>
        <div class="content-body" id="resultat_dash">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up bg-hexagons">
                        <div class="card-content">
                            <div class="card-body bg-hexagons">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <div class="row">
                                            <div class="col-3">

                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="success" id="id_exprime">0</h3>
                                            </div>

                                        </div>
                                        <h6>Voix exprimés</h6>
                                    </div>
                                    <div>
                                        <i class="icon-user-follow success font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up bg-hexagons">
                        <div class="card-content">
                            <div class="card-body bg-hexagons">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <div class="row">
                                            <div class="col-3">

                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="info" id="id_blanc">0</h3>
                                            </div>
                                        </div>
                                        <h6>Voix blancs</h6>
                                    </div>
                                    <div>
                                        <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-info" id="Pourcentage_devis_confirme" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up bg-hexagons">
                        <div class="card-content">
                            <div class="card-body bg-hexagons">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <div class="row">
                                            <div class="col-3">

                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="danger" id="id_nulle">0</h3>
                                            </div>
                                        </div>
                                        <h6>Voix nulle</h6>
                                    </div>
                                    <div>
                                        <i class="icon-pie-chart danger font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-danger" id="nb_prog_commande" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up bg-hexagons">
                        <div class="card-content">
                            <div class="card-body bg-hexagons">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <div class="row">
                                            <div class="col-3">

                                            </div>
                                            <div class="col-9 text-right">
                                                <h3 class="warning" id="id_bv">0</h3>
                                            </div>
                                        </div>
                                        <h6>Bueau de vote</h6>
                                    </div>
                                    <div>
                                        <i class="icon-heart warning font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ eCommerce statistic -->
<hr>
            <!-- Card bar-chart -->
            <div class="row" style="margin-bottom: 40px;" id="card_candidat">

                

            </div>



        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>/assets/js/dashboard.js"></script> 