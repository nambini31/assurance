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
                                        <select name="membreId" id="membreId" class="selectpicker form-control" data-live-search='true'>
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
                                        <input name="nom" id="nom" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="prenom" class="col-form-label">Prénom</label>
                                        <input name="prenom" id="prenom" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="cin" class="col-form-label">CIN</label>
                                        <input name="cin" id="cin" type="number" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Adresse</label>
                                        <input name="adresse" id="adresse" type="text" class="form-control input-sm">
                                    </div>
                                </div> 
                                
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="col-form-label">Télephone</label>
                                        <input name="telephone" id="telephone" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="prenom" class="col-form-label">Fonction</label>
                                        <input name="fonction" id="fonction" type="text" class="form-control input-sm">
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
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">Date Naiss Conjoint(e)</label>
                                        <input name="dateNaissConjoint" id="dateNaissConjoint" type="date" class="form-control input-sm">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="col-form-label">Télephone Conjoint(e)</label>
                                        <input name="telephoneConjoint" id="telephoneConjoint" type="text" class="form-control input-sm">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="prenom" class="col-form-label">Genre Conjoint(e)</label>
                                        <select name="genreConjoint" id="genreConjoint" type="text" class="form-control ">
                                            <option value="homme">Homme</option>
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


<script src="<?php echo base_url() ?>/assets/js/titulaire/titulaire.js"></script>