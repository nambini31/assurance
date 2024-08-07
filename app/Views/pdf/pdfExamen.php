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
            .checkbox-table th {
                width: 25px;
            }
            .checkbox-table .commentaires {
                width: 40%;
            }
            .checkbox-container {
                display: flex;
                align-items: center;
                justify-content: space-around;
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
        <span style="font-size: 16px; border-bottom: 1px dashed #000;">GSM</span>
    </div>

    <div>
        <table style="margin: 10px 0px">
            <tr style="">
                <td><input type="checkbox"></td><td style="padding-right: 20px;"><span class="label">M</span></td>
                <td><input type="checkbox"></td><td style="padding-right: 20px;"><span class="label">Mlle</span></td>
                <td><input type="checkbox"></td><td style="padding-right: 40px;"><span class="label">Mme</span></td>
                <td><span class="label">Nom et Prénoms:</span></td><td style="border-bottom: 1px dashed #000;"><span>TSIATOSIKA Daolahy</span></td>
            </tr>
        </table>
        <table style="margin-bottom: 10px;">
            <tr>
                <td><span class="label" style="">Date de naissance:</span></td>
                <td style="border-bottom: 1px dashed #000;"><span>14/10/1994</span></td>
                <td style="padding-left: 30px;"><span>Profession:</span></td>
                <td style="border-bottom: 1px dashed #000;"><span>Agent de sécurité Agent de sécurité Agent de sécurité Agent de sécurité</span></td>
            </tr>
        </table>   
        <table>
            <tr>
                <td><span class="label">Examen médical effectué le: </span></td>
                <td><span style="border-bottom: 1px dashed #000;"> 07 FEV 2024</span></td>
            </tr>
        </table>     
    </div>

    <div class="section">
        
        <span class="label">Par le Docteur:</span>
        <span class="value">Biby</span>
    </div>

    <div class="section-title">BIOMÉTRIE</div>
    <div class="section">        
        <span class="label">Poids:</span> <span class="value">63 kg</span>
        <span class="label">Taille:</span> <span class="value">1.70 m</span>
        <span class="label">TAG:</span> <span class="value">10%</span>
        <span class="label">TAD:</span> <span class="value">110</span>
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
                    <td style="text-align: center;"><span class="">2</span> /10</td>
                    <td style="text-align: center;"><span>8</span> /10</td>
                </tr>
                <tr>
                    <td class="label">Après correction : </td>
                    <td style="text-align: center;"><span>2</span> /10</td>
                    <td style="text-align: center;"><span>8</span> /10</td>
                </tr>
            </tbody>
        </table>  
    </div>

    <div class="section">
        <div style="font-weight: bold; text-decoration: underline;">ACUITE AUDITIVE : </div>
        <input type="checkbox"><span class="label" style="margin-right: 2%;">Bonne</span>
        <input type="checkbox"><span class="label" style="margin-right: 2%;">Mauvaise</span>
        <input type="checkbox"><span class="label" style="margin-right: 2%;">Sourde</span>
    </div>

    <div class="section">
        <div class="section-title">I - ANTÉCÉDENTS</div>
        <div class="field">
            <span class="label">Antécédents médicaux:</span> <span class="value"></span>
        </div>
        <div class="field">
            <span class="label">Antécédents chirurgicaux:</span> <span class="value"></span>
        </div>
        <div class="field">
            <span class="label">Antécédents gynéco-obstétrique:</span> <span class="value"></span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">II - ASPECT GÉNÉRAL</div>
        <div class="checkbox-group">
            <span class="checkbox-label">Aspect sain, correspondant à l\'âge indiqué ?</span>
            <div class="checkbox-container">
                <label><input type="checkbox" checked> OUI</label>
                <label><input type="checkbox"> NON</label>
            </div>
        </div>
        <div class="checkbox-group">
            <span class="checkbox-label">Y a-t-il des malformations ou des mutilations ?</span>
            <div class="checkbox-container">
                <label><input type="checkbox"> OUI</label>
                <label><input type="checkbox" checked> NON</label>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">III - EXAMENS ORL / OPHTALMOLOGIE</div>
        <table class="checkbox-table">
            <tr>
                <th>N°</th>
                <th>Question</th>
                <th>OUI</th>
                <th>NON</th>
                <th>Commentaires</th>
            </tr>
            <tr>
                <td>5</td>
                <td>COU: Y a-t-il un goitre ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>La langue, le pharynx et les amygdales ont-ils un aspect anormal ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Y a-t-il une affection des yeux ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Y a-t-il une affection de l\'appareil auditif ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">IV - EXAMEN STOMATOLOGIQUE</div>
        <table class="checkbox-table">
            <tr>
                <td>6</td>
                <td>Existe-t-il une affection bucco-dentaire ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>État dentaire :</td>
                <td colspan="4"></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">V - APPAREIL RESPIRATOIRE</div>
        <table class="checkbox-table">
            <tr>
                <td>7</td>
                <td>Le mouvement respiratoire est-il limité, asymétrique ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>La percussion montre-t-elle des matités anormales ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>L\'auscultation donne-t-elle des résultats anormaux ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>La voix est-elle voilée ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">VI - APPAREIL CARDIO-VASCULAIRE</div>
        <table class="checkbox-table">
            <tr>
                <td>8</td>
                <td>Les bruits du cœur sont-ils modifiés ? (Intensité, dédoublement, etc.)</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Entendez-vous un souffle cardiaque ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Les pouls des membres inférieurs sont-ils tous perçus et symétriques ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Entendez-vous un souffle sur les trajets des artères cervicales ou fémorales ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">VII - APPAREIL DIGESTIF</div>
        <table class="checkbox-table">
            <tr>
                <td>9</td>
                <td>La palpation de l\'abdomen décèle-t-elle un état pathologique ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Y a-t-il une hépatomégalie ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Y a-t-il une Splénomégalie ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Y a-t-il une hernie ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Y a-t-il des hémorroïdes, une notion d\'hématémèse de mélena, de rectorragies ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
            <tr>
                <td>10</td>
                <td>Y a-t-il des indices d\'alcoolisme, de tabagisme, d\'abus de médicaments, d\'usage de stupéfiants ?</td>
                <td><input type="checkbox"></td>
                <td><input type="checkbox" checked></td>
                <td></td>
            </tr>
        </table>
    </div>

    <div class="signature">Signature du Docteur</div>

    <div class="footer">Doc Julie</div>
</body>
</html>