<html lang="fr">
    <style type="text/css">
        /* @media print{ */
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }

            /* header */
            .header {
                display: flex;
                align-items: center;
                position: relative;
            }
            .header img{
                position: absolute;
                left: 0;
            }
            .header h1 {
                flex: 1;
                text-align: center;
                border: 2px solid black;
                padding: 20px;
            }
            /* fin header */

            .section {
                display: flex;
                align-items: center;
            }
            
            .section-title {
                font-weight: bold;
                text-decoration: underline;
                margin-top: 20px;
            }
            .field {
                display: flex;
                margin-bottom: 5px;
            }
            .label {
                font-weight: inherit;
            }
            .value {
                display: inline-block;
                width: calc(100% - 180px);
                border-bottom: 1px dashed #000;
                flex: 1;
                margin: 0% 2%;
                text-align: left;
            }
            .checkbox-group {
                display: flex;
                align-items: center;
                margin-bottom: 5px;
            }
            .checkbox-label {
                margin-right: 10px;
            }
            .signature {
                margin-top: 30px;
                text-align: right;
            }
            .footer {
                margin-top: 40px;
                text-align: center;
            }
            .checkbox-table, .checkbox-table th, .checkbox-table td {
                border: 1px solid #000;
                border-collapse: collapse;
            }
            .checkbox-table th, .checkbox-table td {
                padding: 5px;
            }
            
            .question {
                width: 330px;
            }
            .comms {
                width: 250px;
            }
            
            .checkbox-table .commentaires {
                width: 40%;
            }
            .checkbox-container {
                display: flex;
                align-items: center;
                justify-content: space-around;
            }

            .autreAnormaux {
                border-bottom: 1px dashed #000;
            }
        /* } */
    </style>
<body>
    <div class="header">
        <img src="<?= base_url() ?>assets/img/logoOmit.png" alt="" width="150">
        <h1>RAPPORT D'EXAMEN MEDICAL</h1>
    </div>
    
    <div class="section">
        <span style="font-weight: bold ; font-size: 16px; text-transform: uppercase; text-decoration: underline;">Établissement :</span>
        <span style="font-size: 16px; border-bottom: 1px dashed #000;"><?= $selectedExamen['etablissement'] ?></span>
    </div>

    <div>
        <table style="margin: 10px 0px">
            <tr style="">
                <td><input type="checkbox" <?php if ($selectedExamen['genre'] == 'M') echo 'checked="checked"'; ?> ></td><td style="padding-right: 20px;"><span class="label">M</span></td>
                <td><input type="checkbox" <?php if ($selectedExamen['genre'] == 'Mlle') echo 'checked="checked"'; ?> ></td><td style="padding-right: 20px;"><span class="label">Mlle</span></td>
                <td><input type="checkbox" <?php if ($selectedExamen['genre'] == 'Mme') echo 'checked="checked"'; ?> ></td><td style="padding-right: 40px;"><span class="label">Mme</span></td>
                <td><span class="label">Nom et Prénoms :</span></td><td style="border-bottom: 1px dashed #000;"><span><?= $selectedExamen['nomPrenom'] ?></span></td>
            </tr>
        </table>
        <table style="margin-bottom: 10px;">
            <tr>
                <td><span class="label" style="">Date de naissance :</span></td>
                <td style="border-bottom: 1px dashed #000;"><span><?= strftime('%d/%m/%Y', strtotime($selectedExamen['dateNaiss'])) ?></span></td>
                <td style="padding-left: 30px;"><span>Profession :</span></td>
                <td style="border-bottom: 1px dashed #000;"><span><?= $selectedExamen['profession'] ?></span></td>
            </tr>
        </table>   
        <table>
            <tr>
                <td><span class="label">Examen médical effectué le : </span></td>
                <td style="padding-right: 30px;"><span style="border-bottom: 1px dashed #000;"><?= strftime('%d/%m/%Y', strtotime($selectedExamen['dateExamen'])) ?></span></td>
                <td><span class="label">Par le Docteur:</span></td>
                <td><span class="value"><?= $selectedExamen['docteurExamen'] ?></span></td>
        </table>  
        <table>
            <tr></tr>
        </table>   
    </div>

    <div class="section-title">BIOMÉTRIE</div>
    <div class="">     
        <table>
            <tr>
                <td><span class="label">Poids:</span></td>
                <td style="padding-right: 30px;"><span class="value"><?= $selectedExamen['poids'] ?></span></td>
                <td><span class="label">Taille:</span></td>
                <td style="padding-right: 30px;"><span class="value"><?= $selectedExamen['taille'] ?></span></td>
                <td><span class="label">TAG:</span></td>
                <td style="padding-right: 30px;"><span class="value"><?= $selectedExamen['TAG'] ?></span></td>
                <td><span class="label">IMC:</span></td>
                <td style="padding-right: 30px;"><span class="value"><?= $selectedExamen['IMC'] ?></span></td>
                <td><span class="label">TAD:</span></td>
                <td><span class="value"><?= $selectedExamen['TAD'] ?></span></td>
            </tr>
        </table>   
    </div>

    <div class="section-title">ACUITE VISUELLE</div>
    <div class="section">    
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th></th>
                    <th width="100">OD</th>
                    <th width="100">OG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label">Avant correction : </td>
                    <td style="text-align: center;"><span class=""><?= $selectedExamen['avantCorrectionOD'] ?></span> /10</td>
                    <td style="text-align: center;"><span><?= $selectedExamen['avantCorrectionOG'] ?></span> /10</td>
                </tr>
                <tr>
                    <td class="label">Après correction : </td>
                    <td style="text-align: center;"><span><?= $selectedExamen['apresCorrectionOD'] ?></span> /10</td>
                    <td style="text-align: center;"><span><?= $selectedExamen['apresCorrectionOG'] ?></span> /10</td>
                </tr>
            </tbody>
        </table>  
    </div>

    <div class="section-title">ACUITE AUDITIVE :</div>
    <div class="">
        <table>
            <tr>
                <td><input type="checkbox" <?php if ($selectedExamen['acuiteAuditive'] == 'Bonne') echo 'checked="checked"'; ?> ></td>
                <td style="padding-right: 20px;"><span class="label">Bonne</span></td>
                <td><input type="checkbox" <?php if ($selectedExamen['acuiteAuditive'] == 'Mauvaise') echo 'checked="checked"'; ?> ></td>
                <td style="padding-right: 20px;"><span class="label">Mauvaise</span></td>
                <td><input type="checkbox" <?php if ($selectedExamen['acuiteAuditive'] == 'Sourde') echo 'checked="checked"'; ?> ></td>
                <td style="padding-right: 20px;"><span class="label">Sourde</span></td>
            </tr>
        </table>
    </div>

    <div class="section-title">I - ANTÉCÉDENTS</div>
    <div class="">
        <table class="checkbox-table">
            <tr>
                <td rowspan="2">1</td>
                <td rowspan="2" style="width: 400px;">Antécedents médicaux :</td>
                <td style="width: 250px;">
                    <div class="form-group">
                        <label for="antecedentMedicauxPersonnels">Personnels : </label>
                        <span><?= $selectedExamen['antecedentMedicauxPersonnels'] ?></span>
                    </div>
                </td>
            </tr>
            <tr>

                <td>
                    <div class="form-group">
                        <label for="antecedentMedicauxFamiliaux">Familiaux : </label>
                        <span><?= $selectedExamen['antecedentMedicauxFamiliaux'] ?></span>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Antécédents Chirurgicaux :</td>
                <td>
                    <span><?= $selectedExamen['antecedentChirurgicaux'] ?></span>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Antécédents Gynéco-Obstétrique :</td>
                <td>
                    <span><?= $selectedExamen['antecedentGynecoObsetrique'] ?></span>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">II - ASPECT GÉNÉRAL</div>
    <div class="">
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="2">4</td>
                <td>Aspect sain, correspondant à l'âge indiqué ?</td>
                <td><input type="checkbox" <?php if ($selectedExamen['aspectSainAgeIndique'] == 'Oui') echo 'checked="checked"'; ?> ></td>
                <td><input type="checkbox" <?php if ($selectedExamen['aspectSainAgeIndique'] == 'Non') echo 'checked="checked"'; ?> ></td>
                <td rowspan="2"><?= $selectedExamen['commentairesAspectGeneral'] ?></td>
            </tr>
            <tr>
                <td>Y-at-il des malformations ou des mutilation ?</td>
                <td><input type="checkbox" <?php if ($selectedExamen['malformationMutilations'] == 'Oui') echo 'checked="checked"'; ?> ></td>
                <td><input type="checkbox" <?php if ($selectedExamen['malformationMutilations'] == 'Non') echo 'checked="checked"'; ?> ></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">III - EXAMENS ORL / OPHTALMOLOGIE</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">Commentaires</th>
            </tr>
            <tr>
                <td rowspan="4">5</td>
                <td>COU: Y a-t-il un goitre ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['goitre']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['goitre']== 'Non') echo 'checked="checked"'?>></td>
                <td rowspan="5"><?= $selectedExamen['commentaireORL_OPHTALMOLOGIE'] ?></td>
            </tr>
            <tr>
                <td>La langue, le pharynx et les amygdales ont-ils un aspect anormal ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['languePharynxAmygdalesAnormale']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['languePharynxAmygdalesAnormale']== 'Non') echo 'checked="checked"'?>></td>
            </tr>
            <tr>
                <td>Y a-t-il une affection des yeux ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionYeux']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionYeux']== 'Non') echo 'checked="checked"'?>></td>                
            </tr>
            <tr>
                <td>Y a-t-il une affection de l'appareil auditif ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionAuditif']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionAuditif']== 'Non') echo 'checked="checked"'?>></td>
            </tr>
        </table>
    </div>

    <div class="section-title">IV - EXAMENS STOMATOLOGIQUE</div>
    <div class="">
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="2">6</td>
                <td>Existe-t-il une affection bucco-dentaire ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionBuccoDentaire']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionBuccoDentaire']== 'Non') echo 'checked="checked"'?>></td>
                <td rowspan="2">
                    <?= $selectedExamen['commentaireStomatologieque'] ?>
                </td>
            </tr>
            <tr>
                <td>Etat dentaire :</td>
                <td colspan="2"></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">V - APPAREIL RESPIRATOIRE</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="4">7</td>
                <td>Le mouvement respiratoire est-il limité, asymétrique ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['respiratoireLimite']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['respiratoireLimite']== 'Non') echo 'checked="checked"'?>></td>                
                <td rowspan="5"><?= $selectedExamen['commentairesRespiratoire'] ?></td>
            </tr>
            <tr>
                <td>La percussion montre-t-elle des matités anormales ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['percussionAnormales']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['percussionAnormales']== 'Non') echo 'checked="checked"'?>></td>                                
            </tr>
            <tr>
                <td>L'auscultation donne-t-elle des résultas anormales ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['ausculationAnormaux']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['ausculationAnormaux']== 'Non') echo 'checked="checked"'?>></td>                              
            </tr>
            <tr>
                <td>La voix est-elle voillé ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['voixVoilee']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['voixVoilee']== 'Non') echo 'checked="checked"'?>></td>                                         
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">VI - APPAREIL CARDIO-VASCULAIRE</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="4">8</td>
                <td>Les bruits du coeur sont-ils modifiés ? (Intensité, dédoublement, etc.)</td>
                <td><input type="checkbox" <?php if($selectedExamen['bruitsCoeuModifie']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['bruitsCoeuModifie']== 'Non') echo 'checked="checked"'?>></td>                                                    
                <td rowspan="5"><?= $selectedExamen['commentairesCardioVasculaire'] ?></td>
            </tr>
            <tr>
                <td>Entendez-vous un souffle cardiaque ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['souffleCardiaque']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['souffleCardiaque']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
            <tr>
                <td>Les pouls des membres inferieurs sont-ils tous percus et symétriques ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['souffleCardiaque']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['souffleCardiaque']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
            <tr>
                <td>Entendez-vous un souffle sur les trajets des artères cervicales ou fémorales ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['souffleArteresCervicales']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['souffleArteresCervicales']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
        </table>
    </div>

    <div class="">
        <div class="section-title">VII - APPAREIL DIGESTIF</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="5">9</td>
                <td>La palpation de l'abdomen décèle-t-elle un état pathologique ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['palpationPathologique']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['palpationPathologique']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                <td rowspan="6"><?= $selectedExamen['commentairesDigestif'] ?></td>
            </tr>
            <tr>
                <td>Y a-t-il une Hépatomégalie ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['hepatomegalie']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['hepatomegalie']== 'Non') echo 'checked="checked"'?>></td>                                                                                   
            </tr>
            <tr>
                <td>Y a-t-il une Splénomégalie ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['splenomegalie']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['splenomegalie']== 'Non') echo 'checked="checked"'?>></td>
            </tr>
            <tr>
                <td>Y a-t-il une Hernie ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['hernie']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['hernie']== 'Non') echo 'checked="checked"'?>></td>
            </tr>
            <tr>
                <td>Y a-t-il des hémorroïde, une notion d'hématémèse de meléna, de rectorragies ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['hemorroide']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['hemorroide']== 'Non') echo 'checked="checked"'?>></td>
           </tr>
            <tr>
                <td>10</td>
                <td>Y a-t-il des indices d'alcoolisme, de tabagisme, d'abus de médicaments, d'usage de stupéfiants ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['alcoolismeTabagisme']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['alcoolismeTabagisme']== 'Non') echo 'checked="checked"'?>></td>
           </tr>
        </table>
    </div>

    <div class="row">
        <div class="section-title">VIII-APPAREIL GENITO-URINAIRE</div>    
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th colspan="2" class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
                <tr>
                    <td rowspan="8">11</td>
                    <td colspan="2">Y a-t-il eu dans les antécédents une affection des organes génito-urinaires ?</td>
                    <td><input type="checkbox" <?php if($selectedExamen['antecedentsOrganesGenito']== 'Oui') echo 'checked="checked"'?> ></td>
                    <td><input type="checkbox" <?php if($selectedExamen['antecedentsOrganesGenito']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                    <td rowspan="5"><?= $selectedExamen['commentairesGenitoUrinaire'] ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <i><b>Pour les personnes de sexe masculin</b></i><br>
                        Y a-t-il des indices d'une affection des organes génitaux ?(Testicules, épididymes, prostate)
                    </td>
                    <td><input type="checkbox" <?php if($selectedExamen['indicesAffectionOrganesGenitauxM']== 'Oui') echo 'checked="checked"'?> ></td>
                    <td><input type="checkbox" <?php if($selectedExamen['indicesAffectionOrganesGenitauxM']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                </tr>
                <tr>
                    <td colspan="2">Y a t-il une gynécomastie ?</td>
                    <td><input type="checkbox" <?php if($selectedExamen['gynecomastie']== 'Oui') echo 'checked="checked"'?> ></td>
                    <td><input type="checkbox" <?php if($selectedExamen['gynecomastie']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                </tr>
                <tr>
                    <td colspan="2">
                        <i><b>Pour les personnes de sexe féminin</b></i><br>
                        Y a t-il des indices d'une affection des organes génitaux ?
                    </td>
                    <td><input type="checkbox" <?php if($selectedExamen['indicesAffectionOrganesGenitauxF']== 'Oui') echo 'checked="checked"'?> ></td>
                    <td><input type="checkbox" <?php if($selectedExamen['indicesAffectionOrganesGenitauxF']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                </tr>
                <tr>
                    <td colspan="2">
                        Y a t-il une modification anormale des seins ?
                    </td>
                    <td><input type="checkbox" <?php if($selectedExamen['modificationAnormalSeins']== 'Oui') echo 'checked="checked"'?> ></td>
                    <td><input type="checkbox" <?php if($selectedExamen['modificationAnormalSeins']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                </tr>  
        </table>
    </div>

    <div class="row">
        <div class="checkbox-table">
            <table>
                <tr>
                    <td colspan="5">
                        <h3 class="justify-content-center">EXAMEN DE L'URINE</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="5">
                        <table class="">
                            <tr>
                                <th>ASPECT</th> 
                                <th>ALBUMINE</th> 
                                <th>GLUCOSE</th> 
                                <th style="width: 120px">PUS</th> 
                                <th style="width: 350px">AUTRES ELEMENTS ANORMAUX</th> 
                            </tr>
                            <tr>
                                <td><?= $selectedExamen['urineAspect'] ?></td>
                                <td><?= $selectedExamen['urineAlbumine'] ?></td>
                                <td><?= $selectedExamen['urineGlucose'] ?></td>
                                <td>
                                    <span class="label">LEU : </span><span><?= $selectedExamen['urineLEU'] ?></span><br>                               
                                    <span class="label">NIT : </span><span><?= $selectedExamen['urineNIT'] ?></span>                                     
                                </td>
                                <td style="font-size: 15px;">
                                    <span class="label">SG : </span><span class="autreAnormaux"><?= $selectedExamen['urineSG']?></span>
                                    <span class="label"> ; PH : </span><span class="autreAnormaux"><?= $selectedExamen['urinePH'] ?></span> ; <br><br>                                                                             
                                    <span class="label">PRO : </span><span class="autreAnormaux"><?= $selectedExamen['urinePRO'] ?></span>                                                            
                                    <span class="label"> ; KET : </span><span class="autreAnormaux"><?= $selectedExamen['urineKET'] ?></span> ; <br><br>                                                                             
                                    <span class="label">URO : </span><span class="autreAnormaux"><?= $selectedExamen['urineURO'] ?></span>                                         
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

    </div>

    <div class="row">
        <div class="section-title">IX-SYSTEME NERVEUX</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="3">12</td>
                <td>Y a-t-il des réflexes pupillaires, ou ostéotendineux anormaux ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['reflexePupillaires']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['reflexePupillaires']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                <td rowspan="3"><?= $selectedExamen['commentairesSystemeNerveux'] ?></td>
            </tr>
            <tr>
                <td>Existe t-il des signes de dystonie neurvégétative ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['signesDystonie']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['signesDystonie']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
            <tr>
                <td>Présence de troubles psychiques ou neurologiques ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['troublesPsychique']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['troublesPsychique']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
        </table>
    </div>

    <div class="row">
        <div class="section-title">X-PEAU</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td rowspan="5">13</td>
                <td>Ictère ou cyanose ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['ictereCyanose']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['ictereCyanose']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                <td rowspan="5"><?= $selectedExamen['commentairespeau'] ?> </td>
            </tr>
            <tr>
                <td>Eruption, ulcération, kyste, tumeur, varices ou oedèmes ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['eruptionUlcerationKyste']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['eruptionUlcerationKyste']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
            <tr>
                <td>Ganglions lymphatiques augmentés de volume ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['ganglionsLymphatiques']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['ganglionsLymphatiques']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
            <tr>
                <td>Cicatrices, tatouages ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['cicatricesTatouages']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['cicatricesTatouages']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
            <tr>
                <td>Tophus, Xanthome ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['tophusXanthome']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['tophusXanthome']== 'Non') echo 'checked="checked"'?>></td>                                                                    
            </tr>
        </table>
    </div>

    <div class="row">
        <div class="section-title">XI-SQUELETTE</div>
        <table class="checkbox-table">
            <tr>
                <th></th>
                <th class="question"></th>
                <th>OUI</th>
                <th>NON</th>
                <th class="comms">COMMENTAIRES</th>
            </tr>
            <tr>
                <td>14</td>
                <td>Y a-t-il une affection des os, des articulations, des disques intervertébraux ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionOs']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['affectionOs']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                <td><?= $selectedExamen['commentairesSquelette'] ?> </td>
            </tr>
            <tr>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td rowspan="2">15</td>
                <td>Existe-t-il une répercussion des occupations proffessionnells ou autres sur létat de santé ?</td>
                <td><input type="checkbox" <?php if($selectedExamen['repercussionProffessionelles']== 'Oui') echo 'checked="checked"'?> ></td>
                <td><input type="checkbox" <?php if($selectedExamen['repercussionProffessionelles']== 'Non') echo 'checked="checked"'?>></td>                                                                    
                <td> <?= $selectedExamen['commentairesRepercussionProfessionnelles'] ?></td>
            </tr>
            <tr>
                <td colspan="3">L'état de santé de la personne à examiner peut-il être considéré comme:</td>
                <td>
                    <input type="checkbox"  <?php if ($selectedExamen['etatSanteConsidere'] == 'BON') echo 'checked="checked"'; ?>>
                    <span class="custom-control-label" for="">BON  -  </span>

                    <input type="checkbox"  <?php if ($selectedExamen['etatSanteConsidere'] == 'MEDIOCRE') echo 'checked="checked"'; ?>>
                    <label class="custom-control-label" for="etatSanteConsidereMediocre">MEDIOCRE  -  </label>
                
                    <input type="checkbox"  <?php if ($selectedExamen['etatSanteConsidere'] == 'DEFAVORABLE') echo 'checked="checked"'; ?>>
                    <label class="custom-control-label" for="etatSanteConsidereDefavorable">DEFAVORABLE</label>
                </td>
            </tr>
            <tr>
                <td colspan="5"  style="text-align: center;">
                    <h2>REMARQUES SPECIALES ET SUGGESTIONS DU MEDECIN</h2><br>
                    <span><?= $selectedExamen['remarquesSpeciales'] ?></span>
                </td>
            </tr>
        </table>        
    </div>

    <div class="row">
        <table class="checkbox-table">
            <tr style="text-align: start;">
                <td colspan="2" rowspan="2" width="200">Signature du proposant</td>
            </tr>
            <tr>
                <td>
                    <p>Je sousigné certifie que le signature du proposant placée ci-contre,
                            a été apposée après vérification de son identité.
                    </p>
                    <br><br><br><br><br><br><br><br><br>
                    <p>A <span><?= $selectedExamen['villeExamen'] ?></span>, le <?= strftime('%d/%m/%Y', strtotime($selectedExamen['dateExamen'])) ?></p><br>
                    <p>(Signature et cachet du Médcin examinateur)</p>
                </td>
            </tr>
        </table>
    </div>
    
</body>
</html>