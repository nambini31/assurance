<div class="app-content content">
    <div class="content-overlay"></div>

    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="content-overlay"></div>
            <section class="row all-contacts">
                
                <div class="col-12">
                    <h1 class="text-left" style="">Listes Examens Medicaux</h1>
                    <!-- <form action="" method="post" id="deuxDateForm">
                        <div class="card" id="">
                            <div class="row mt-1 pb-1 mx-auto" style="">
                                <div class="col-1">
                                    <label for="date_debut_promotion">Du:</label>
                                </div>
                                <div class="col-3">
                                    <input required type="date" id="dateDebutExamen" class="form-control input-sm" name="" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Début">
                                </div>

                                <div class="col-1">
                                    <label for="date_fin_promotion">Au: </label>
                                </div>
                                <div class="col-3">
                                    <input required type="date" id="dateFinExamen" class="form-control input-sm" name="" data-toggle="tooltip" data-trigger="hover" data-placement="top" data-title="Date Fin">
                                </div>

                                <div class="col-">                                
                                    <button type="submit" id="btn_recherche" class=" btn btn-sm btn-info"><i class="ft-search"></i> Deux dates</i></button>
                                </div>                                
                            </div>
                        </div>
                    </form> -->

                    <div class="card">

                        <div class="card-content">
                            <div class="card-body" id="card-examen">
                                
                                <table id="table-examen" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


</div>


<!-- modal create examen  -->
<div class="heading-elements mt-0">
    <div class="modal fade" id="createExamenModel" style="z-index: 99999999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" id="modal_content_add_examen">
                <div class="card-content collpase show">
                    <div class="card-body">

                        <form class="form" method="post" id="createExamenForm">
                            <input type="hidden" id="getRoleConncted" value="<?= $_SESSION['roleId'] ?>">
                            <input type="hidden"  name="examenId"  id="examenId">
                            <div class="form-body" >     

                                <div class="form-row">
                                    <div class="col-md-10">
                                        <img src="<?= base_url() ?>assets/img/logoOmit.png" alt="" width="100">
                                    </div>    
                                    <div class="col-md-2 text-right">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <h1  style="border: 2px solid black; padding: 10px; display: inline-block;">RAPPORT D'EXAMEN MEDICAL</h1>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-12 d-flex">
                                        <h4>Etablissement: </h4>
                                        <input name="etablissement" id="etablissement" type="text" class="form-control">
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio"  class="custom-control-input" name="genre" value="M" id="genreM">
                                            <label class="custom-control-label" for="genreM">M</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" class="custom-control-input" name="genre" value="Mme" id="genreMme">
                                            <label class="custom-control-label" for="genreMme">Mme</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" class="custom-control-input" name="genre" value="Mlle" id="genreMlle">
                                            <label class="custom-control-label" for="genreMlle">Mlle</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-3" for="nomPrenom">Nom et Prénom : </label>
                                            <div class="col-md-9">
                                                <input type="text" id="nomPrenom" class="form-control" name="nomPrenom" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                       
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="dateNaiss">Date de Naissance: </label>
                                        <div class="col-md-9">
                                            <input type="date" id="dateNaiss" class="form-control border-primary" name="dateNaiss">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="profession">Profession: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="profession" class="form-control border-primary" name="profession">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="adresse">Adresse: </label>
                                        <div class="col-md-9">
                                            <input type="text" id="adresse" class="form-control border-primary" name="adresse">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-5 label-control" for="dateExamen">EXAMEN MEDICAL effectué le: </label>
                                        <div class="col-md-7">
                                            <input type="date" id="dateExamen" class="form-control dateExamen border-primary" name="dateExamen">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="docteurExamen">par le docteur: </label>
                                        <div class="col-md-9">
                                            <!-- <input type="text" id="docteurExamen" class="form-control border-primary" name="docteurExamen"> -->

                                            <select class="selectpicker  form-control btn-sm" name="docteurExamen"  id="docteurExamen" data-live-search='true' data-size='5' title='Docteur'>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <h3>BIOMETRIE</h3>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="poids">Poids:</label>
                                        <div class="col-md-9">
                                            <input type="text" id="poids" class="form-control border-primary" name="poids">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="taille">Taille:</label>
                                        <div class="col-md-9">
                                            <input type="text" id="taille" class="form-control border-primary" name="taille">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="TAG">TAG:</label>
                                        <div class="col-md-9">
                                            <input type="text" id="TAG" class="form-control border-primary" name="TAG">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="IMC">IMC:</label>
                                        <div class="col-md-9">
                                            <input type="text" id="IMC" class="form-control border-primary" name="IMC">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="TAD">TAD:</label>
                                        <div class="col-md-9">
                                            <input type="text" id="TAD" class="form-control border-primary" name="TAD">
                                        </div>
                                    </div>
                                </div>                            
                            </div>

                            <div class="row">
                                <h3>ACUITE VISUELLE</h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-8">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>OD</th>
                                                <th>OG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Avant correction</td>
                                                <td><input type="number" name="avantCorrectionOD" id="avantCorrectionOD"> /10</td>
                                                <td><input type="number" name="avantCorrectionOG" id="avantCorrectionOG"> /10</td>
                                            </tr>
                                            <tr>
                                                <td>Après correction</td>
                                                <td><input type="number" name="apresCorrectionOD" id="apresCorrectionOD"> /10</td>
                                                <td><input type="number" name="apresCorrectionOG" id="apresCorrectionOG"> /10</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>


                            <?php 
                                // verifier si c'est Docteur
                                if ($_SESSION['roleId'] == "3" || $_SESSION['roleId'] == "5") {              
                                ?>
                            <div class="row">
                                <h3>ACUITE AUDITIVE : </h3>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" value="Bonne"  class="custom-control-input" name="acuiteAuditive" id="acuiteAuditiveBonne">
                                    <label class="custom-control-label" for="acuiteAuditiveBonne">Bonne</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" value="Mauvaise" class="custom-control-input" name="acuiteAuditive" id="acuiteAuditiveMauvaise">
                                    <label class="custom-control-label" for="acuiteAuditiveMauvaise">Mauvaise</label>
                                </div>
                                <div class="d-inline-block custom-control custom-radio mr-1">
                                    <input type="radio" value="Sourde" class="custom-control-input" name="acuiteAuditive" id="acuiteAuditiveSourde">
                                    <label class="custom-control-label" for="acuiteAuditiveSourde">Sourde</label>
                                </div>
                            </div>
                            <br> 
                            
                            <div class="row">
                                <h3>I-ANTECEDENTS</h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-10">
                                    <table class="table table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">1</td>
                                                <th rowspan="2">Antécedents médicaux :</th>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="antecedentMedicauxPersonnels">Personnels : </label>
                                                        <textarea id="antecedentMedicauxPersonnels" class="form-control" name="antecedentMedicauxPersonnels"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <div class="form-group">
                                                        <label for="antecedentMedicauxFamiliaux">Familiaux : </label>
                                                        <textarea id="antecedentMedicauxFamiliaux" class="form-control" name="antecedentMedicauxFamiliaux"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <th>Antécédents Chirurgicaux :</th>
                                                <td>
                                                    <textarea id="antecedentChirurgicaux" class="form-control" name="antecedentChirurgicaux"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <th>Antécédents Gynéco-Obstétrique :</th>
                                                <td>
                                                    <textarea id="antecedentGynecoObsetrique" class="form-control" name="antecedentGynecoObsetrique"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>II-ASPECT GENERAL</h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">4</td>
                                                <td>Aspect sain, correspondant à l'âge indiqué ?</td>
                                                <td><input type="radio" value="Oui" class="" name="aspectSainAgeIndique" id="aspectSainAgeIndique"></td>
                                                <td><input type="radio" value="Non"  class="" name="aspectSainAgeIndique" id="aspectSainAgeIndique"></td>
                                                <td rowspan="2">
                                                    <textarea id="commentairesAspectGeneral" rows="3" class="form-control" name="commentairesAspectGeneral"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Y-at-il des malformations ou des mutilation ?</td>
                                                <td><input type="radio" value="Oui" class="" name="malformationMutilations" id="malformationMutilationsOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="malformationMutilations" id="malformationMutilationsNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>III-EXAMENS ORL/OPHTAMOLOGIE </h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="4">5</td>
                                                <td>COU : Y a-t-il un goitre ?</td>
                                                <td><input type="radio" value="Oui" class="" name="goitre" id="goitreOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="goitre" id="goitreNon"></td>
                                                <td rowspan="5">
                                                    <textarea id="commentaireORL_OPHTALMOLOGIE" rows="6" class="form-control" name="commentaireORL_OPHTALMOLOGIE"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>La langue, le pharynx et les amygdales ont-ils un aspect anormal ?</td>
                                                <td><input type="radio" value="Oui" class="" name="languePharynxAmygdalesAnormale" id="languePharynxAmygdalesAnormaleOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="languePharynxAmygdalesAnormale" id="languePharynxAmygdalesAnormaleNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Y a-t-il une affection des yeux ?</td>
                                                <td><input type="radio" value="Oui" class="" name="affectionYeux" id="affectionYeuxOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="affectionYeux" id="affectionYeuxNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Y a-t-il une affection de l'appareil auditif ?</td>
                                                <td><input type="radio" value="Oui" class="" name="affectionAuditif" id="affectionAuditifOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="affectionAuditif" id="affectionAuditifNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>IV-EXAMENS STOMATOLOGIQUE </h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">6</td>
                                                <td>Existe-t-il une affection bucco-dentaire ?</td>
                                                <td><input type="radio" value="Oui" class="" name="affectionBuccoDentaire" id="affectionBuccoDentaireOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="affectionBuccoDentaire" id="affectionBuccoDentaireNon"></td>
                                                <td rowspan="2">
                                                    <textarea id="commentaireStomatologieque" rows="3" class="form-control" name="commentaireStomatologieque"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Etat dentaire :</td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>V-APPAREIL RESPIRATOIRE </h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="4">7</td>
                                                <td>Le mouvement respiratoire est-il limité, asymétrique ?</td>
                                                <td><input type="radio" value="Oui" class="" name="respiratoireLimite" id="respiratoireLimiteOui"></td>
                                                <td><input type="radio" value="Non" class="" name="respiratoireLimite" id="respiratoireLimiteNon" ></td>
                                                <td rowspan="5">
                                                    <textarea id="commentairesRespiratoire" rows="6" class="form-control" name="commentairesRespiratoire"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>La percussion montre-t-elle des matités anormales ?</td>
                                                <td><input type="radio" value="Oui" class="" name="percussionAnormales" id="percussionAnormalesOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="percussionAnormales" id="percussionAnormalesNon"></td>
                                            </tr>
                                            <tr>
                                                <td>L'auscultation donne-t-elle des résultas anormales ?</td>
                                                <td><input type="radio" value="Oui" name="ausculationAnormaux" id="ausculationAnormauxOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="ausculationAnormaux" id="ausculationAnormauxNon"></td>
                                            </tr>
                                            <tr>
                                                <td>La voix est-elle voillé ?</td>
                                                <td><input type="radio" value="Oui" class="" name="voixVoilee" id="voixVoileeOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="voixVoilee" id="voixVoileeNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>VI-APPAREIL CARDIO-VASCULAIRE </h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="4">8</td>
                                                <td>Les bruits du coeur sont-ils modifiés ? (Intensité, dédoublement, etc.)</td>
                                                <td><input type="radio" value="Oui" class="" name="bruitsCoeuModifie" id="bruitsCoeuModifieOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="bruitsCoeuModifie" id="bruitsCoeuModifieNon"></td>
                                                <td rowspan="5">
                                                    <textarea id="commentairesCardioVasculaire" rows="6" class="form-control" name="commentairesCardioVasculaire"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Entendez-vous un souffle cardiaque ?</td>
                                                <td><input type="radio" value="Oui" class="" name="souffleCardiaque" id="souffleCardiaqueOui"></td>
                                                <td><input type="radio" value="Non" class="" name="souffleCardiaque" id="souffleCardiaqueNon" ></td>
                                            </tr>
                                            <tr>
                                                <td>Les pouls des membres inferieurs sont-ils tous percus et symétriques ?</td>
                                                <td><input type="radio" value="Oui" class="" name="poulesInferieursPercus" id="poulesInferieursPercusOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="poulesInferieursPercus" id="poulesInferieursPercusNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Entendez-vous un souffle sur les trajets des artères cervicales ou fémorales ?</td>
                                                <td><input type="radio" value="Oui" class="" name="souffleArteresCervicales" id="souffleArteresCervicalesOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="souffleArteresCervicales" id="souffleArteresCervicalesNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>VII-APPAREIL DIGESTIF </h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="5">9</td>
                                                <td>La palpation de l'abdomen décèle-t-elle un état pathologique ?</td>
                                                <td><input type="radio" value="Oui" class="" name="palpationPathologique" id="palpationPathologiqueOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="palpationPathologique" id="palpationPathologiqueNon"></td>
                                                <td rowspan="6">
                                                    <textarea id="commentairesDigestif" rows="10" class="form-control" name="commentairesDigestif"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Y a-t-il une Hépatomégalie ?</td>
                                                <td><input type="radio" value="Oui" class="" name="hepatomegalie" id="hepatomegalieOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="hepatomegalie" id="hepatomegalieNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Y a-t-il une Splénomégalie ?</td>
                                                <td><input type="radio" value="Oui" class="" name="splenomegalie" id="splenomegalieOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="splenomegalie" id="splenomegalieNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Y a-t-il une Hernie ?</td>
                                                <td><input type="radio" value="Oui" class="" name="hernie" id="hernieOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="hernie" id="hernieNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Y a-t-il des hémorroïde, une notion d'hématémèse de meléna, de rectorragies ?</td>
                                                <td><input type="radio" value="Oui" class="" name="hemorroide" id="hemorroideOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="hemorroide" id="hemorroideNon"></td>
                                            </tr>
                                            <tr>
                                                <td>10</td>
                                                <td>Y a-t-il des indices d'alcoolisme, de tabagisme, d'abus de médicaments, d'usage de stupéfiants ?</td>
                                                <td><input type="radio" value="Oui" class="" name="alcoolismeTabagisme" id="alcoolismeTabagismeOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="alcoolismeTabagisme" id="alcoolismeTabagismeNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>VIII-APPAREIL GENITO-URINAIRE </h3>
                            </div>
                            
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th colspan="2"></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="8">11</td>
                                                <td colspan="2">Y a-t-il eu dans les antécédents une affection des organes génito-urinaires ?</td>
                                                <td><input type="radio" value="Oui" class="" name="antecedentsOrganesGenito" id="antecedentsOrganesGenitoOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="antecedentsOrganesGenito" id="antecedentsOrganesGenitoNon"></td>
                                                <td rowspan="5">
                                                    <textarea id="commentairesGenitoUrinaire" rows="10" class="form-control" name="commentairesGenitoUrinaire"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <i><b>Pour les personnes de sexe masculin</b></i><br>
                                                    Y a-t-il des indices d'une affection des organes génitaux ?(Testicules, épididymes, prostate)
                                                </td>
                                                <td><input type="radio" value="Oui" class="" name="indicesAffectionOrganesGenitauxM" id="indicesAffectionOrganesGenitauxMOui"></td>
                                                <td><input type="radio" value="Non" class="" name="indicesAffectionOrganesGenitauxM" id="indicesAffectionOrganesGenitauxMNon"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Y a t-il une gynécomastie ?</td>
                                                <td><input type="radio" value="Oui" class="" name="gynecomastie" id="gynecomastieOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="gynecomastie" id="gynecomastieNon"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <i><b>Pour les personnes de sexe féminin</b></i><br>
                                                    Y a t-il des indices d'une affection des organes génitaux ?
                                                </td>
                                                <td><input type="radio" value="Oui" class="" name="indicesAffectionOrganesGenitauxF" id="indicesAffectionOrganesGenitauxFOui"></td>
                                                <td><input type="radio" value="Non" class="" name="indicesAffectionOrganesGenitauxF" id="indicesAffectionOrganesGenitauxFNon"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    Y a t-il une modification anormale des seins ?
                                                </td>
                                                <td><input type="radio" value="Oui" class="" name="modificationAnormalSeins" id="modificationAnormalSeinsOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="modificationAnormalSeins" id="modificationAnormalSeinsNon"></td>
                                            </tr>  
                                            
                                            
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                                }
                            ?>

                            <?php 
                                // verifier si c'est Infirmier
                                if ($_SESSION['roleId'] == "4" || $_SESSION['roleId'] == "3" || $_SESSION['roleId'] == "5") {              
                            ?>
                            <!-- affichage pour l'infirmer -->
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table>
                                        <tr>
                                            <td colspan="5" >
                                                <h3 class="justify-content-center">EXAMEN DE L'URINE</h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>ASPECT</th> 
                                                        <th>ALBUMINE</th> 
                                                        <th>GLUCOSE</th> 
                                                        <th>PUS</th> 
                                                        <th>AUTRES ELEMENTS ANORMAUX</th> 
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" id="urineAspect" class="form-control border-primary" name="urineAspect"></td>
                                                        <td><input type="text" id="urineAlbumine" class="form-control border-primary" name="urineAlbumine"></td>
                                                        <td><input type="text" id="urineGlucose" class="form-control border-primary" name="urineGlucose"></td>
                                                        <td>
                                                            <div class="row">
                                                                <fieldset class="form-group form-group-style">
                                                                    <label for="urineLEU">LEU</label>
                                                                    <input type="text" class="form-control border-primary" id="urineLEU" name="urineLEU">
                                                                </fieldset>
                                                            </div>
                                                            <div class="row">
                                                                <fieldset class="form-group form-group-style">
                                                                    <label for="urineNIT">NIT</label>
                                                                    <input type="text" class="form-control border-primary" id="urineNIT" name="urineNIT">
                                                                </fieldset>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <fieldset class="form-group form-group-style">
                                                                        <label for="urineSG">SG</label>
                                                                        <input type="text" class="form-control border-primary" id="urineSG" name="urineSG">
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <fieldset class="form-group form-group-style">
                                                                        <label for="urinePH">PH</label>
                                                                        <input type="text" class="form-control border-primary" id="urinePH" name="urinePH">
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <fieldset class="form-group form-group-style">
                                                                        <label for="urinePRO">PRO</label>
                                                                        <input type="text" class="form-control border-primary" id="urinePRO" name="urinePRO">
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <fieldset class="form-group form-group-style">
                                                                        <label for="urineKET">KET</label>
                                                                        <input type="text" class="form-control border-primary" id="urineKET" name="urineKET">
                                                                    </fieldset>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <fieldset class="form-group form-group-style">
                                                                        <label for="urineURO">URO</label>
                                                                        <input type="text" class="form-control border-primary" id="urineURO" name="urineURO">
                                                                    </fieldset>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <br>
                            <?php
                                }
                            ?>
                            <!-- fin affichage infirmier -->
                            
                            <?php 
                                // verifier si c'est Docteur
                                if ($_SESSION['roleId'] == "3" || $_SESSION['roleId'] == "5") {              
                            ?>
                            <div class="row">
                                <h3>IX-SYSTEME NERVEUX</h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="3">12</td>
                                                <td>Y a-t-il des réflexes pupillaires, ou ostéotendineux anormaux ?</td>
                                                <td><input type="radio" value="Oui" class="" name="reflexePupillaires" id="reflexePupillairesOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="reflexePupillaires" id="reflexePupillairesNon"></td>
                                                <td rowspan="3">
                                                    <textarea id="commentairesSystemeNerveux" rows="4" class="form-control" name="commentairesSystemeNerveux"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Existe t-il des signes de dystonie neurvégétative ?</td>
                                                <td><input type="radio" value="Oui" class="" name="signesDystonie" id="signesDystonieOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="signesDystonie" id="signesDystonieNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Présence de troubles psychiques ou neurologiques ?</td>
                                                <td><input type="radio" value="Oui" class="" name="troublesPsychique" id="troublesPsychiqueOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="troublesPsychique" id="troublesPsychiqueNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>X-PEAU</h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="5">13</td>
                                                <td>Ictère ou cyanose ?</td>
                                                <td><input type="radio" value="Oui" class="" name="ictereCyanose" id="ictereCyanoseOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="ictereCyanose" id="ictereCyanoseNon"></td>
                                                <td rowspan="5">
                                                    <textarea id="commentairespeau" rows="9" class="form-control" name="commentairespeau"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Eruption, ulcération, kyste, tumeur, varices ou oedèmes ?</td>
                                                <td><input type="radio" value="Oui" class="" name="eruptionUlcerationKyste" id="eruptionUlcerationKysteOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="eruptionUlcerationKyste" id="eruptionUlcerationKysteNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Ganglions lymphatiques augmentés de volume ?</td>
                                                <td><input type="radio" value="Oui" class="" name="ganglionsLymphatiques" id="ganglionsLymphatiquesOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="ganglionsLymphatiques" id="ganglionsLymphatiquesNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Cicatrices, tatouages ?</td>
                                                <td><input type="radio" value="Oui" class="" name="cicatricesTatouages" id="cicatricesTatouagesOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="cicatricesTatouages" id="cicatricesTatouagesNon"></td>
                                            </tr>
                                            <tr>
                                                <td>Tophus, Xanthome ?</td>
                                                <td><input type="radio" value="Oui" class="" name="tophusXanthome" id="tophusXanthomeOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="tophusXanthome" id="tophusXanthomeNon"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h3>XI-SQUELETTE</h3>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                            <th>OUI</th>
                                            <th>NON</th>
                                            <th>COMMENTAIRES</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>14</td>
                                                <td>Y a-t-il une affection des os, des articulations, des disques intervertébraux ?</td>
                                                <td><input type="radio" value="Oui" class="" name="affectionOs" id="affectionOsOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="affectionOs" id="affectionOsNon"></td>
                                                <td>
                                                    <textarea id="commentairesSquelette" rows="2" class="form-control" name="commentairesSquelette"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">15</td>
                                                <td>Existe-t-il une répercussion des occupations proffessionnells ou autres sur létat de santé ?</td>
                                                <td><input type="radio" value="Oui" class="" name="repercussionProffessionelles" id="repercussionProffessionellesOui"></td>
                                                <td><input type="radio" value="Non"  class="" name="repercussionProffessionelles" id="repercussionProffessionellesNon"></td>
                                                <td>
                                                    <textarea id="commentairesRepercussionProfessionnelles" rows="2" class="form-control" name="commentairesRepercussionProfessionnelles"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">L'état de santé de la personne à examiner peut-il être considéré comme:</td>
                                                <td>
                                                    <div class="d-inline-block custom-radio mr-1">
                                                        <input type="radio" value="BON"  class="custom-control-input" name="etatSanteConsidere" id="etatSanteConsidereBon">
                                                        <label class="custom-control-label" for="etatSanteConsidereBon">BON</label>
                                                    </div>
                                                    <div class="d-inline-block custom-radio mr-1">
                                                        <input type="radio" value="MEDIOCRE" class="custom-control-input" name="etatSanteConsidere" id="etatSanteConsidereMediocre">
                                                        <label class="custom-control-label" for="etatSanteConsidereMediocre">MEDIOCRE</label>
                                                    </div>
                                                    <div class="d-inline-block custom-radio mr-1">
                                                        <input type="radio" value="DEFAVORABLE" class="custom-control-input" name="etatSanteConsidere" id="etatSanteConsidereDefavorable">
                                                        <label class="custom-control-label" for="etatSanteConsidereDefavorable">DEFAVORABLE</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <h2>REMARQUES SPECIALES ET SUGGESTIONS DU MEDECIN</h2>
                                                    <textarea id="remarquesSpeciales" rows="2" class="form-control" name="remarquesSpeciales"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br> 
                            
                            <div class="row">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered mb-0">
                                        <tr>
                                            <td width="400" class="fs-1">Signature du proposant</td>
                                            <td>
                                                <p class="fs-1">Je sousigné certifie que le signature du proposant placée ci-contre,
                                                     a été apposée après vérification de son identité.
                                                </p>
                                                <br>
                                                <p class="mb-5 fs-1">A <input type="text" class="form-control input-sm" name="villeExamen">, le <input class="form-control dateExamen input-sm" type="date" name="dateExamen"></p>
                                                <p class="fs-1">(Signature et cachet du Médcin examinateur)</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>                                
                           
                            <?php
                                }
                            ?>
                            <div class="form-actions right" >
                                <?php
                                    // $titreBoutton = "Envoyer au Docteur";
                                    // if ($_SESSION['roleId'] == "3" || $_SESSION['roleId'] == "5") {
                                    //     $titreBoutton = "Valider";
                                    // }
                                ?>
                                <button type="submit" id="btn_add_examen" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Enregister</button>
                                <!-- <button type="button" id="btn_print_examen" class="mr-1 mb-1 btn btn-sm btn-info btn-min-width"><i class="ft-check"></i> Imprimer</button> -->
                                <button type="button" data-dismiss="modal" onclick="annulerAjoutExamen()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -------------------------------------------------------- -->


<script src="<?php echo base_url() ?>/assets/js/examen/examen.js"></script>