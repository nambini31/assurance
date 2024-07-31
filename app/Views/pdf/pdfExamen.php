
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .sub-header {
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 10px;
        }
        .field {
            margin-bottom: 5px;
        }
        .label {
            display: inline-block;
            width: 180px;
            font-weight: bold;
        }
        .value {
            display: inline-block;
        }
        .checkbox-label {
            margin-right: 10px;
        }
        .signature {
            margin-top: 20px;
            text-align: right;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        .checkbox-group {
            display: inline-block;
            width: 30px;
        }
    </style>
</head>
<body>
    <div class="header">OMIT TOLIARA</div>
    <div class="sub-header">RAPPORT D\'EXAMEN MÉDICAL</div>

    <div class="section">
        <div class="field">
            <span class="label">Établissement:</span> <span class="value">__________</span>
        </div>
        <div class="field">
            <span class="label">Nom et Prénoms:</span> <span class="value">TSIATOSIKA, Daolahy</span>
        </div>
        <div class="field">
            <span class="label">Date de naissance:</span> <span class="value">14/10/1994</span>
        </div>
        <div class="field">
            <span class="label">Profession:</span> <span class="value">Agent de sécurité</span>
        </div>
        <div class="field">
            <span class="label">Adresse:</span> <span class="value">Milonjazo Betanimena</span>
        </div>
        <div class="field">
            <span class="label">Examen médical effectué le:</span> <span class="value">07 FÉV 2024</span>
        </div>
        <div class="field">
            <span class="label">Par le Docteur:</span> <span class="value">Dr. ________</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">BIOMÉTRIE</div>
        <div class="field">
            <span class="label">Poids:</span> <span class="value">63 kg</span>
        </div>
        <div class="field">
            <span class="label">Taille:</span> <span class="value">1.70 m</span>
        </div>
        <div class="field">
            <span class="label">TAG:</span> <span class="value">10%</span>
        </div>
        <div class="field">
            <span class="label">TAD:</span> <span class="value">110</span>
        </div>
        <div class="field">
            <span class="label">Acuité visuelle:</span> <span class="value">OD 6/10, OG 6/10</span>
        </div>
        <div class="field">
            <span class="label">Acuité auditive:</span> <span class="value">Bonne</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">I - ANTÉCÉDENTS</div>
        <div class="field">
            <span class="label">Antécédents médicaux:</span> <span class="value">Personnels: __________</span>
        </div>
        <div class="field">
            <span class="label">Antécédents chirurgicaux:</span> <span class="value">__________</span>
        </div>
        <div class="field">
            <span class="label">Antécédents gynéco-obstétrique:</span> <span class="value">__________</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">II - ASPECT GÉNÉRAL</div>
        <div class="field">
            <span class="checkbox-label">Aspect sain, correspondant à l\'âge indiqué ?</span>
            <div class="checkbox-group"><input type="checkbox" checked> OUI</div>
            <div class="checkbox-group"><input type="checkbox"> NON</div>
        </div>
        <div class="field">
            <span class="checkbox-label">Y a-t-il des malformations ou des mutilations ?</span>
            <div class="checkbox-group"><input type="checkbox"> OUI</div>
            <div class="checkbox-group"><input type="checkbox" checked> NON</div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">III - EXAMENS ORL / OPHTALMOLOGIE</div>
        <table>
            <tr>
                <th>5</th>
                <th>Question</th>
                <th>OUI</th>
                <th>NON</th>
                <th>Commentaires</th>
            </tr>
            <tr>
                <td>COU</td>
                <td>Y a-t-il un goitre ?</td>
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
        <table>
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
                <td colspan="3"></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">V - APPAREIL RESPIRATOIRE</div>
        <table>
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
        <table>
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
        <table>
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
