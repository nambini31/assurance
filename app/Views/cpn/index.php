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
                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="datedeb">Date debut : </label>
                                    <input type="date" class="form-control input-sm" name="" id="date_debut">
                                </div>

                            </div>
                            <div class="col-md-3 ml-1 mr-1">
                                <div class="form-group">
                                    <label for="datefin">Date fin : </label>
                                    <input type="date" class="form-control input-sm" name="" id="date_fin">
                                </div>

                            </div>
                            <div class="col-md-1 ml-1 mr-1">

                                <div class="form-group">
                                    <label for=""></label><br>
                                    <button style="margin-top: 4px;" type="button" id="btn_recherche" onclick="filtrerVisite()" class=" btn btn-sm btn-warning "><i class="ft ft-search"></i></button>

                                </div>


                            </div>



                        </div>

                    </div>
                    <div class="card">

                        <div class="card-content">
                            <div class="card-body" id="card_cpn">
                                <center>
                                    <h6 class="text-center" style="font-size: 14px; margin-bottom: -25px;">Listes</h6>
                                </center>
                                <table id="table_cpn" class="table table-white-space table-bordered no-wrap  text-center" style="width: 100% !important; overflow: auto !important; display: block !important;">

                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="heading-elements mt-0">


        <div class="modal fade" id="AddConsultCpn" style="z-index: 99999999; margin-top: 2% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content" id="modal_ConsultCpn" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h3 class="modal-header entete_modal_patpo">
                                Ajout consultation
                            </h3>

                            <br>

                            <form method="POST" id="add_consultcpn">
                                <input type="hidden" name="idconsultationcpn" id="idDetailsCons">
                                <input type="hidden" name="idcpn" id="idcpnCons">

                                <div class="row">
                                    <div class="col-xl-6">

                                        <table id="table_parametre_1" class="table table-white-space table-bordered table-sm no-wrap text-center" style="width: 100% !important; overflow: auto;">
                                            <tr>
                                                <th colspan="2" style="text-align:left; min-width: 130px;">ELEMENTS DE SURVEILLANCE</th>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">N° Consultation</th>
                                                <td><select class="selectpicker  form-control btn-sm" name='num' id="numCons" required data-live-search='true' data-size='5' title='N°'>
                                                        <option value="1">1<sup>ère</sup></option>
                                                        <option value="2">2<sup>ème</sup></option>
                                                        <option value="3">3<sup>ème</sup></option>
                                                        <option value="4">4<sup>ème</sup></option>
                                                        <option value="5">5<sup>ème</sup></option>
                                                        <option value="6">6<sup>ème</sup></option>
                                                        <option value="7">7<sup>ème</sup></option>
                                                        <option value="8">8<sup>ème</sup></option>
                                                    </select></td>

                                            </tr>
                                            <tr>
                                                <td style="text-align:left">T/A (G/D)</td>
                                                <td><input type="text" class="form-control input-sm" name="tagd"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Taille</td>
                                                <td><input type="text" class="form-control input-sm" name="taille"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Poids</td>
                                                <td><input type="text" class="form-control input-sm" name="poids"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">ALB/OEDEMES</td>
                                                <td><input type="text" class="form-control input-sm" name="alboedemes"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Védèse</td>
                                                <td><input type="text" class="form-control input-sm" name="vedese"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">CPN Conjonctives</td>
                                                <td><input type="text" class="form-control input-sm" name="cpnconjonctive"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Saignement</td>
                                                <td><input type="text" class="form-control input-sm" name="saignement"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Hauteur Utérine</td>
                                                <td><input type="text" class="form-control input-sm" name="hauteuruterine"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Largeur</td>
                                                <td><input type="text" class="form-control input-sm" name="largue"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">DDR</td>
                                                <td><input type="text" class="form-control input-sm" name="ddr"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">DPA</td>
                                                <td><input type="text" class="form-control input-sm" name="dpa"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">HU</td>
                                                <td><input type="text" class="form-control input-sm" name="hu"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">MAF</td>
                                                <td><input type="text" class="form-control input-sm" name="maf"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">OMI</td>
                                                <td><input type="text" class="form-control input-sm" name="omi"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">VAT</td>
                                                <td><input type="text" class="form-control input-sm" name="vat"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">SPI</td>
                                                <td><input type="text" class="form-control input-sm" name="spi"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">B.D.C.F</td>
                                                <td><input type="text" class="form-control input-sm" name="bdcf"></td>
                                            </tr>
                                        </table>

                                    </div>

                                    <div class="col-xl-6">

                                        <table id="table_parametre" class="table table-white-space table-bordered table-sm no-wrap text-center" style="width: 100% !important; overflow: auto;">
                                            <tr>
                                                <th colspan="2" style="text-align:left; min-width: 130px;">ELEMENTS DE SURVEILLANCE</th>
                                            </tr>
                                            
                                           
                                            <tr>
                                                <td style="text-align:left">Présentation</td>
                                                <td><input type="text" class="form-control input-sm" name="presentation"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Recherche active</td>
                                                <td><input type="text" class="form-control input-sm" name="rechercheActive"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Référence pour Accouchement</td>
                                                <td><input type="text" class="form-control input-sm" name="refeaccouche"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Sérologie RDR</td>
                                                <td><input type="text" class="form-control input-sm" name="serologierdr"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Sérologie VIDAL</td>
                                                <td><input type="text" class="form-control input-sm" name="serologievidal"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">A.S.A d’Urine</td>
                                                <td><input type="text" class="form-control input-sm" name="asaurine"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Groupage</td>
                                                <td><input type="text" class="form-control input-sm" name="groupage"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">HIV</td>
                                                <td><input type="text" class="form-control input-sm" name="hiv"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">FCV</td>
                                                <td><input type="text" class="form-control input-sm" name="fcv"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">BW</td>
                                                <td><input type="text" class="form-control input-sm" name="bw"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Toxoplasmose</td>
                                                <td><input type="text" class="form-control input-sm" name="toxoplasmose"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Rubuole</td>
                                                <td><input type="text" class="form-control input-sm" name="rubuole"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">TPHA</td>
                                                <td><input type="text" class="form-control input-sm" name="tpha"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">NFS</td>
                                                <td><input type="text" class="form-control input-sm" name="nfs"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Fér Ac/folique</td>
                                                <td><input type="text" class="form-control input-sm" name="feracfolique"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Albendazole</td>
                                                <td><input type="text" class="form-control input-sm" name="albendazole"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left">Date RDV</td>
                                                <td><input type="date" class="form-control input-sm" name="dateRendevous"></td>
                                            </tr>
                                            
                                        </table>

                                    </div>
                                </div>








                                <div class="form-actions right">
                                    <button type="submit" id="btn_add_detail_cpn" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Ajouter</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ListesLabo" style="z-index: 99999999 ; margin-top: 1% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="width: 80%;">
                <div class="modal-content" id="ListesLabocontent" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-header entete_modal2" style="position: absolute;top: 15px; border: none; z-index: 10;">
                                CPN N° : OMI-205
                            </h4>
                            <div class="card" style="box-shadow: none;">
                                <div class="card-content">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs nav-underline">

                                            <li class="nav-item">
                                                <a class="nav-link" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21" href="#tabIcon21" aria-expanded="false"><i class="ft-layers"></i> ANTECEDENTS ( D.D.R )</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22" href="#tabIcon22" aria-expanded="false"><i class="ft-layers"></i> CONSULTATIONS</a>
                                            </li>




                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="tab-content">



                                    <div class="tab-pane active" id="tabIcon21" aria-expanded="true" aria-labelledby="baseIcon-tab21">
                                        <?= view("cpn/parametre.php") ?>
                                    </div>
                                    <div role="tab-panel" class="tab-pane" id="tabIcon22" aria-expanded="true" aria-labelledby="baseIcon-tab22">
                                        <?= view("cpn/consultcpn.php") ?>
                                    </div>

                                </div>
                            </div>



                        </div>
                        <div style="text-align: right;">
                            <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Fermer</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ListesDemande" style="z-index: 99999999 ; margin-top: 2% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document" style="width: 80%;">
                <div class="modal-content" id="ListesLabocontent1" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body" id="">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            <h3 class="modal-header entete_modal">
                                EXAMEN PARACLINIQUES
                            </h3>

                            <table id="table_demande" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deletelabo" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>



                            <div class="card-header">
                                <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                            </div>


                            <p>Voulez-vous supprimer cette demmande d'examen ?</p>

                            <button type="button" onclick="delete_laboExam()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                            <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>






                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="AddLaboratoire" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modal_laboratoire" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h3 class="modal-header entete_modal">
                                DEMANDE D'EXAMEN
                            </h3>

                            <br>

                            <form method="post" id="add_examen">

                                <input type="hidden" name="idConsPour" id="idConsPour">
                                <input type="hidden" name="idenvoie_labo" id="idenvoielabo">
                                <input type="hidden" name="idDetails" id="idDetails">

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="type_destinataire" class="">Type destinataire</label>
                                            <select class="selectpicker  form-control btn-sm" name="type_destinataire" required id="type_destinataire" data-live-search='true' data-size='5' title='type destinataire'>
                                                <option value="Laboratoire" selected>Laboratoire</option>
                                                <option value="Echographie" selected>Echographie</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>



                                <div id="placeEchoLabo"></div>

                                <div class='row'>

                                    <div class='col-md-12'>
                                        <div class='form-group'>
                                            <label for='resultats' class=''>Resultats</label>
                                            <input type='text' class='form-control input-sm' name='resultats' id='resultats'>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>

                                    <div class='col-md-12'>
                                        <div class='form-group'>
                                            <label for='rc' class=''>R.C</label>
                                            <input type='text' class='form-control input-sm' name='rc' id='rc'>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-actions right" id="hideValidLabo">
                                    <button type="submit" id="submitEchoLabo" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width">Envoyer</button>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="deleteConsultation" style="z-index: 99999999 ; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>



                            <div class="card-header">
                                <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                            </div>


                            <p>Voulez-vous confirmer cette suppression</p>

                            <button type="button" onclick="delete_detail()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                            <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>






                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="valideLabo" style="z-index: 99999999; margin-top: 3% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collapse show">
                        <div class="card-body" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>

                            <div class="card-header">
                                <i class="la la-check-circle success" style='font-size:50px'></i>
                            </div>

                            <p>Veuillez sélectionner le resultat d'analyse pour confirmer cette demande ?</p>

                            <!-- Ajout de l'input file avec un label -->
                            <form id="form_analyse">
                                <div class="form-group">
                                    <!-- Label pour l'input file -->
                                    <table id="" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                        <tr>
                                            <td style="text-align:center"><input type="file" id="fichierAnalyse" name="fichierAnalyse" class="form-control-file" required></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Bouton de confirmation -->
                                <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width">
                                    <i class="ft-check"></i> Oui
                                </button>
                                <!-- Bouton d'annulation -->
                                <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width">
                                    <i class="ft-x"></i> Annuler
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteCpn" style="z-index: 99999999 ;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body" style="text-align: center;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>



                            <div class="card-header">
                                <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                            </div>


                            <p>Voulez-vous supprimer ce patient CPN ?</p>

                            <button type="button" onclick="delete_cpn()" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                            <button type="button" data-dismiss="modal" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>






                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AddVisites" style="z-index: 99999999 ; margin-top: 0% !important" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content" id="modal_visites" style="box-shadow: 0px 19px 38px 10px rgb(0 0 0 / 30% )">
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h3 class="modal-header entete_modalVIS">
                                Ajout visite
                            </h3>

                            <br>

                            <form method="post" id="add_consultation">
                                <div class="form-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="hidden" name="idcpn" id="id_cpnfirt">
                                            <div class="form-group">
                                                <label for="type_personne_select" class="">Choix Membre</label>
                                                <select class="selectpicker  form-control btn-sm" name='membre_select' required id="membre_select" data-live-search='true' data-size='5' title='Choix membre'>

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="patient_select" class="">Choix Carte ( N° Carte )</label>
                                                <select class="selectpicker  form-control btn-sm" name="titulaireId" required id="titulaire_select" data-live-search='true' data-size='5' title='Choix titulaire'>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="personne_selectcpn" class="">Choix Patient CPN</label>
                                                <select class="selectpicker  form-control btn-sm" name='personne' required id="personne_selectcpn" data-live-search='true' data-size='5' title='Choix patient'>

                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="patient_select">Marié(e) </label>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" value="1" name="mariee" id="oui" required> <label for="oui"> OUI </label>&nbsp;&nbsp;
                                                <input type="radio" value="0" name="mariee" id="non"> <label for="non"> NON </label>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <div class="form-actions right">
                                    <button type="submit" id="btn_add_cpn_first" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width">Ajouter</button>


                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>


<script src="<?php echo base_url() ?>/assets/js/cpn/cpn.js"></script>