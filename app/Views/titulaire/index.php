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

<!-- Modal dedtail Titulaire -->
<style>
    p span{
        border-bottom: 1px dashed #000; 
        padding: 1px 3px; 
        margin-right:20px;
    }
</style>
<div class="modal fade" id="detailTitulaireModel" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" id="">
            <div class="card-content collpase show">
                <div class="card-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="card-title text-center">Detail Titilaire</h2>
                    <button class="btn btn-info" onclick='imprimerCarte1()'>Imprimer Carte</button>
                </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 14px !important;">
                        <input value="" type="hidden" id="detailTitulaireId" />
                        <strong>N° Fiche Medical :</strong> <span id="detailNumTitualireGenere" style="border: 1px solid #000; padding: 1px 3px; margin-right:30px">------</span>
                        <strong>N° CNAPS :</strong> <span id="detailNumCnaps" style="border: 1px solid #000; padding: 1px 3px;"></span><br><br>
                        <strong>Nom :</strong> <span id="detailNom" style="min-width: 20px;">Dupont</span>
                        <strong>Prénoms :</strong> <span id="detailPrenom">Jean</span><br><br>
                        <strong>Genre :</strong> <span id="detailGenre">Masculin</span>
                        <strong>Date de naissance :</strong> <span id="detailDateNaiss">01/01/1980</span><br><br>
                        <strong>Téléphone :</strong> <span id="detailTelephone">0123456789</span>
                        <strong>CIN :</strong> <span id="detailCin">AB123456</span><br><br>
                        <strong>Fonction :</strong> <span id="detailFonction"> Développeur Développeur  Développeur</span>
                        <strong>Adresse :</strong> <span id="detailAdresse">10 rue des Champs, 75000 P Développeuraris</span><br><br>
                        <strong>E-mail :</strong> <span id="detailEmail"></span><br><br>
                        <strong>Date d'embauche :</strong> <span id="detailDateEmbauche">01/01/2010</span>
                        <strong>Date de débauche :</strong> <span id="detailDateDebauche">01/01/2020</span><br><br>
                        <strong>Nom & Prénom Conjoint(e) :</strong> <span id="detailNomPrenomConjoint">Marie Dupont</span><br><br>
                        <strong>Date de naissance Conjoint(e) :</strong> <span id="detailDateNaissConjoint">02/02/1982</span><br><br>
                        <strong>Téléphone Conjoint(e):</strong> <span id="detailTelephoneConjoint">0987654321</span>
                        <strong>Fonction Conjoit(e):</strong> <span id="detailFonctionConjoint"></span>
                        <strong>Genre Conjoint(e) :</strong> <span id="detailGenreConjoint">Féminin</span><br><br>
                        <strong>Motif :</strong> <span id="detailMotifNonAssure">Démission</span><br><br>
                    </p>
                    <div class="row">
                        <div class="col">
                            <div class="text-center" style="border: 1px solid #000; padding: 10px;">
                                <span id="detailPhotoTitulaire">Photo AFFILIE(E)</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center" style="border: 1px solid #000; padding: 10px;">
                            <span id="detailPhotoConjoint">Photo CONJOINT(E)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal detail -->

<!-- Modal Listes Enfants -->
<div class="modal fade" id="listeEnfantModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="">
            <div class="card-content">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h1 class="card-title text-center">Listes Enfants à Charge</h1>
                    </div>
                    <div class="card-body" id="card-enfant">
                        <table id="table-enfant" class="table table-white-space table-bordered no-wrap  text-center" >
                            
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<!-- ::: Fin Modal Liste Enfant ::::::::: -->

<!-- Modal Enfant -->
<div class="heading-elements mt-0">
    <div class="modal fade" id="createEnfantModel" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
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


<script src="<?php echo base_url() ?>/assets/js/titulaire/titulaire.js"></script>