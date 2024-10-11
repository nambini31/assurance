
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte d'affiliation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
        }
        .cartes-wrapper {
            width: 100%;
            table-layout: fixed;  /* Forcer la largeur fixe des colonnes */
            border-collapse: collapse;
        }
        .carte-container1 {
            width: 50%;
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
        }
        .carte-container2 {
            width: 50%;
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
        }
        .carte-header {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }
        td {
            padding: 5px;
        }
        .photo-section {
            text-align: center;
            border: 1px solid #000;
            height: 120px;
            vertical-align: middle;
        }
        .photo-section img {
            width: 100px;
            height: auto;
            border-radius: 50%;
        }
        .child-section td, .child-section th {
            text-align: center;
            border: 1px solid #000;
        }
    </style>
</head>
<body>

    <table class="cartes-wrapper">
        <tr>
            <!-- Première carte -->
            <td class="carte-container1">
                <div class="carte-header">
                    <p>B.P. 187 &nbsp;&nbsp;&nbsp; OMIT &nbsp;&nbsp;&nbsp; Tél : 94 920 30</p>
                    <p>CARTE D'AFFILIATION</p>
                </div>

                <table>
                    <tr>
                        <td style="padding-top: 5px;
                        padding-bottom: 5px;">N° CNAPS :</td>
                        <td style="border: 1px solid #000;" id="carteNumCnaps"><?= $selectedData[0]['numCnaps'] ?></td>nom
                        <td style="padding-left: 20px;">N° Fiche Médicale :</td>
                        <td style="border: 1px solid #000;" id="carteCarte"><?= $selectedData['numCartGenere'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="carte-header">Affilié(e)</td>
                    </tr>
                </table>

                <table class="carte-body">
                    <tr>
                        <td>Nom : <span id="carteNom"><?= $selectedData[0]['nom'] ?></span></td>            
                    </tr>
                    <tr>
                        <td>Prénoms : <span id="cartePrenom"><?= $selectedData[0]['prenom'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Emploi : <span id="carteEmploi"><?= $selectedData[0]['fonction'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Employeur : <span id="carteEmployeur"><?= $selectedData['nomMembre'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Adresse : <span id="carteAdresse"><?= $selectedData[0]['adresse'] ?></span></td>
                    </tr>
                    <tr>
                        <td>Nom & Prénoms conjoint(e) : <span id="carteNomConjoint"><?= $selectedData[0]['nomPrenomConjoint'] ?></span></td>
                    </tr>
                </table>

                <table style="table-layout: fixed">
                    <tr>
                        <td style="width:180px">Photo Affilié(e)</td>
                        <td style="width:180px">Photo Conjoint(e)</td>
                    </tr>
                    <tr>
                        <td class="photo-section">
                            <span id="cartePhotoAffile"><?= $selectedData['detailPhotoTitulaire']?></span>
                        </td>
                        <td class="photo-section">
                            Photo CONJOINT(E)<br>
                            <span id="cartePhotoConjoint"><img src="[PhotoConjoint]" alt="Photo Conjoint(e)"></span>
                        </td>
                    </tr>
                </table>
            </td>

            <!-- Deuxième carte -->
            <td class="carte-container2">
                <div class="carte-header">
                    ENFANTS A CHARGE (CNaPS)
                    <?= $enfantList?>
                </div>
            
                <table class="child-section">
                    <tr>
                        <th>Nom & Prénoms</th>
                        <th>Année</th>
                        <th>Nom & Prénoms</th>
                        <th>Année</th>
                    </tr>
                    <tr>
                        <td>1. [NomPrenom1]</td>
                        <td>[Annee1]</td>
                        <td>6. [NomPrenom6]</td>
                        <td>[Annee6]</td>
                    </tr>
                    <tr>
                        <td>2. [NomPrenom2]</td>
                        <td>[Annee2]</td>
                        <td>7. [NomPrenom7]</td>
                        <td>[Annee7]</td>
                    </tr>
                    <tr>
                        <td>3. [NomPrenom3]</td>
                        <td>[Annee3]</td>
                        <td>8. [NomPrenom8]</td>
                        <td>[Annee8]</td>
                    </tr>
                    <tr>
                        <td>4. [NomPrenom4]</td>
                        <td>[Annee4]</td>
                        <td>9. [NomPrenom9]</td>
                        <td>[Annee9]</td>
                    </tr>
                    <tr>
                        <td>5. [NomPrenom5]</td>
                        <td>[Annee5]</td>
                        <td>10. [NomPrenom10]</td>
                        <td>[Annee10]</td>
                    </tr>
                </table>
            
                <div class="carte-header" style="margin-top: 20px;">
                    VALIDATION (CHAQUE TRIMESTRE)
                </div>
            
                <table class="validation-section">
                    <tr>
                        <th>Année</th>
                        <td>2023</td>
                    </tr>
                    <tr>
                        <th>1er TRIM</th>
                        <td class="checked">X</td>
                    </tr>
                    <tr>
                        <th>2e TRIM</th>
                        <td class="checked">X</td>
                    </tr>
                    <tr>
                        <th>3e TRIM</th>
                        <td class="checked">X</td>
                    </tr>
                    <tr>
                        <th>4e TRIM</th>
                        <td>X</td>
                    </tr>
                </table>
            
                <div style="text-align: right; margin-top: 20px;">
                    <strong>AFFILIE(E)</strong>: [NomAffilie] <br>
                    <strong>DATE</strong>: 06 Juin 2023
                </div>
            
                <div style="text-align: right; margin-top: 10px;">
                    <strong>OMIT</strong>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
