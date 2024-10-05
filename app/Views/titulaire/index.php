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
                                    <label for="">Choix Membres : </label>

                                    <select class="selectpicker  form-control btn-sm" name="id_membre" required id="membre_choix" data-live-search='true' data-size='5' title='Membre social'>

                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card">
                        

                        <div class="card-content">
                            <div class="card-body" id="card-titulaire">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Listes Titulaires</h6>
                                </center>
                                <table id="table-titulaire" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


</div>


<!-- modal create titulaire  -->
<div class="heading-elements mt-0">
    <div class="modal fade" id="createTitulaireModel" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal_content_add_titulaire">
                <div class="card-content collpase show">
                    <div class="card-body">

                        <h3 class="modal-header entete_modal">
                        </h3>
                        <form class="form" method="post" id="createTitulaireForm">
                            <input type="hidden"  name="titulaireId"  id="titulaireId" value="0">
                            <div class="form-body">     

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="membreId" class="col-form-label">Membre</label>
                                        <select name="membreId" id="membreId" class="selectpicker form-control" data-live-search='true' required>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="numCnaps" class="col-form-label">Num Cnaps</label>
                                        <input name="numCnaps" id="numCnaps" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Genre</label>
                                        <select name="genre" id="genre" type="text" class="form-control input-sm">
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Date de Naissance</label>
                                        <input name="dateNaiss" id="dateNaiss" type="date" class="form-control input-sm">
                                    </div>
                                </div>   

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="nom" class="col-form-label">Nom</label>
                                        <input name="nom" id="nom" type="text" class="form-control input-sm" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="prenom" class="col-form-label">Prénom</label>
                                        <input name="prenom" id="prenom" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="cin" class="col-form-label">CIN</label>
                                        <input name="cin" id="cin" type="number" class="form-control input-sm" required>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Adresse</label>
                                        <input name="adresse" id="adresse" type="text" class="form-control input-sm" required>
                                    </div>
                                </div> 
                                
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Télephone</label>
                                        <input name="telephone" id="telephone" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="prenom" class="col-form-label">Fonction</label>
                                        <input name="fonction" id="fonction" type="text" class="form-control input-sm" required>
                                    </div>

                                    <div class="form-group col-md-3"> 
                                        <label class="col-form-label">Date Embauche</label>
                                        <input name="dateEmbauche" id="dateEmbauche" type="date" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Date Débauche</label>
                                        <input name="dateDebauche" id="dateDebauche" type="date" class="form-control input-sm">
                                    </div>
                                </div> 
                                
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Photo</label>
                                        <input name="photo" id="photo" type="file" class="form-control input-sm">
                                        <label for="" id="labelImageTitulaire"></label>
                                        <input type="hidden" name="labelImageTitulaireIn" id="labelImageTitulaireIn" />
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="prenom" class="col-form-label">Email</label>
                                        <input name="email" id="email" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Nom et Prénom Conjoint(e)</label>
                                        <input name="nomPrenomConjoint" id="nomPrenomConjoint" type="text" class="form-control input-sm">
                                    </div>
                                    
                                </div> 

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Date Naiss Conjoint(e)</label>
                                        <input name="dateNaissConjoint" id="dateNaissConjoint" type="date" class="form-control input-sm">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Télephone Conjoint(e)</label>
                                        <input name="telephoneConjoint" id="telephoneConjoint" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Fonction Conjoint(e)</label>
                                        <input name="fonctionConjoint" id="fonctionConjoint" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="prenom" class="col-form-label">Genre Conjoint(e)</label>
                                        <select name="genreConjoint" id="genreConjoint" type="text" class="form-control ">
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>

                            <div class="form-actions right" >
                                <button type="submit" id="btn_add_titualire" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Enregistrer</button>
                                <button type="button" data-dismiss="modal" onclick="annulerAjoutTitulaire()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------------------------------- -->


<!-- Modal Enfant -->
<div class="heading-elements mt-0">
    <div class="modal fade" id="createEnfantModel" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" id="modal_content_add_enfant">
                <div class="card-content collpase show">
                    <div class="card-body">

                        <h3 class="modal-header entete_modal">
                        </h3>
                        <form class="form" method="post" id="createEnfantForm">
                            <input type="hidden"  name="enfantId"  id="enfantId" value="0">
                            <input type="hidden"  name="titulaireId"  id="titulaireIdEnfant" value="0">
                            <div class="form-body"> 

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nom" class="col-form-label">Nom</label>
                                        <input name="nom" id="nomEnfant" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="prenomEnfant" class="col-form-label">Prénom</label>
                                        <input name="prenom" id="prenomEnfant" type="text" class="form-control input-sm">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fonctionEnfant" class="col-form-label">Fonction</label>
                                        <input name="fonction" id="fonctionEnfant" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Genre</label>
                                        <select name="genre" id="genreEnfant" type="text" class="form-control input-sm">
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Date de Naissance</label>
                                        <input name="dateNaiss" id="dateNaissEnfant" type="date" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="col-form-label">Lien Familiale</label>
                                        <select name="typeEnfant" id="typeEnfant" type="text" class="form-control input-sm">
                                            <option value="Enfant">Enfant</option>
                                            <option value="Parent">Parent</option>
                                        </select>
                                    </div>
                                </div>                                 
                            </div>

                            <div class="form-actions right" >
                                <button type="submit" id="btn_add_enfant" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Enregistrer</button>
                                <button type="button" data-dismiss="modal" onclick="annulerAjoutTitulaire()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ::::::::::::::::::::::::::::::::::::::::: -->

<!-- Affiche detail global -->
<div class="modal fade" id="detailGlobal" style="z-index: 99999999 ; margin-top: 1% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
        <div class="modal-content" id="ListesLabocontent"  style = "box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )" >
            <div class="card-content collpase show">
                <div class="card-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="card" style="box-shadow: none;">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-underline">                            
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21" href="#tabIcon21" aria-expanded="false"><i class="ft-layers"></i> Detail Titulaire</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22" href="#tabIcon22" aria-expanded="false"><i class="ft-layers"></i> Gérer Enfants à charge</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="tab-content">     
                            <div class="tab-pane active" id="tabIcon21" aria-expanded="true" aria-labelledby="baseIcon-tab21">
                                <?= view("titulaire/detailTitulaire.php") ?>
                            </div>
                            <div role="tab-panel" class="tab-pane"  id="tabIcon22" aria-expanded="true" aria-labelledby="baseIcon-tab22">
                                <?= view("titulaire/enfantTitulaire.php") ?>
                            </div>                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<!-- ::::::::::::::::::::::::::::::::::::::::::: -->


<script src="<?php echo base_url() ?>/assets/js/titulaire/titulaire.js"></script>