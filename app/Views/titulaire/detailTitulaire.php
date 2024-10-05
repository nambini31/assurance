<!-- Modal dedtail Titulaire -->
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        font-size: 14px;
    }
    th, td {
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    td {
        vertical-align: top;
    }
</style>

<div class="card-content collpase show">
    <div class="card-title">
        <button class="btn btn-info" onclick='imprimerCarte1()'>Imprimer Carte</button>
        <button class="btn btn-info" onclick='imprimerCarte2()'>Imprimer Carte Verso</button>
    </div>
    <div class="card-body" id="detailGlobal">
        <input value="" type="hidden" id="detailTitulaireId" />

        <table>
            <tr>
                <td><strong>N° Fiche Medical :</strong> <span id="detailNumTitualireGenere">------</span></td>
                <td><strong>N° CNAPS :</strong> <span id="detailNumCnaps"></span></td>
            </tr>
            <tr>
                <td><strong>Nom :</strong> <span id="detailNom">Dupont</span></td>
                <td><strong>Prénoms :</strong> <span id="detailPrenom">Jean</span></td>
            </tr>
            <tr>
                <td><strong>Genre :</strong> <span id="detailGenre">Masculin</span></td>
                <td><strong>Date de naissance :</strong> <span id="detailDateNaiss">01/01/1980</span></td>
            </tr>
            <tr>
                <td><strong>Téléphone :</strong> <span id="detailTelephone">0123456789</span></td>
                <td><strong>CIN :</strong> <span id="detailCin">AB123456</span></td>
            </tr>
            <tr>
                <td><strong>Fonction :</strong> <span id="detailFonction">Développeur</span></td>
                <td><strong>Adresse :</strong> <span id="detailAdresse">10 rue des Champs, 75000 Paris</span></td>
            </tr>
            <tr>
                <td><strong>E-mail :</strong> <span id="detailEmail">jean.dupont@example.com</span></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>Date d'embauche :</strong> <span id="detailDateEmbauche">01/01/2010</span></td>
                <td><strong>Date de débauche :</strong> <span id="detailDateDebauche">01/01/2020</span></td>
            </tr>
            <tr>
                <td><strong>Nom & Prénom Conjoint(e) :</strong> <span id="detailNomPrenomConjoint">Marie Dupont</span></td>
                <td><strong>Date de naissance Conjoint(e) :</strong> <span id="detailDateNaissConjoint">02/02/1982</span></td>
            </tr>
            <tr>
                <td><strong>Téléphone Conjoint(e) :</strong> <span id="detailTelephoneConjoint">0987654321</span></td>
                <td><strong>Fonction Conjoint(e) :</strong> <span id="detailFonctionConjoint"></span></td>
            </tr>
            <tr>
                <td><strong>Genre Conjoint(e) :</strong> <span id="detailGenreConjoint">Féminin</span></td>
                <td><strong>Motif :</strong> <span id="detailMotifNonAssure">Démission</span></td>
            </tr>
        </table>

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
<!-- Fin Modal detail -->