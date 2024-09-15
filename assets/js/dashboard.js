$(document).ready(function () {
    $('select').selectpicker('refresh');
    liste_dashboard();
    chargeDistrictTous();


});



// ***********************************liste delegue

function liste_dashboard() {

    $("#card_candidat").html('');
    $.ajax({
        beforeSend: function () {

            $("#resultat_dash").block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2" style="margin:auto , font-size : 80px !important"></div>',

                overlayCSS: {
                    backgroundColor: "black",
                    opacity: 0.1,
                    cursor: "wait",

                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: "transparent"
                }
            });

        },
        url: base + "resultat_dashboard",
        type: "POST",
        data: {
            code_district: $("#district_choix").val(),
            code_commune: $("#commune_choix").val(),
            code_fokontany: $("#fokontany_choix").val()
        },
        dataType: "json",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

            if (res.id === 1) {

                if (res.result === null) {
                    $("#id_exprime").html(0);
                    $("#id_blanc").html(0);
                    $("#id_nulle").html(0);
                    $("#id_bv").html(0);
                } else {
                    $("#id_exprime").html(res.result.somme_voix_exprimes);
                    $("#id_blanc").html(res.result.somme_voix_blanc);
                    $("#id_nulle").html(res.result.somme_voix_nulle);
                    $("#id_bv").html(res.result.nombre_bv);
                }

                res.candidat.forEach(key => {

                    var exprime = (res.result === null) ? 0 : res.result.somme_voix_exprimes;

                    let nombre = (exprime == 0) ? 0 : key.voix * 100 / exprime;

                    let nbr = parseFloat(nombre.toFixed(2));

                    var couleurs = ["warning", "success", "primary", "danger", 'secondary'];

                    // Générer un index aléatoire
                    var indexAleatoire = Math.floor(Math.random() * couleurs.length);

                    // Récupérer la couleur aléatoire
                    var couleurAleatoire = "secondary";
                    
                    var image = (key.photo == "") ? "icon.png" : key.photo;
                    
                    pourcentage = key.voix * 100 / exprime ;
                    var couleurSecond = "";
                    
                    if (pourcentage <= 25) {
                        couleur = 'bg-gradient-x-danger'; // Rouge
                        couleurSecond = "danger";
                    } else if (pourcentage <= 50) {
                        couleur = 'bg-gradient-x-warning'; // Orange
                        couleurSecond = "warning";
                    } else if (pourcentage <= 75) {
                        couleur = 'bg-gradient-x-primary'; // Bleu
                        couleurSecond = "primary";
                    } else {
                        couleur = 'bg-gradient-x-success'; // Vert
                        couleurSecond = "success";
                    }

                    var txt = `
                    
                    <div class="col-lg-4">
                    <div class="card pull-up bg-hexagons">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="media-body text-left">
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="assets/img/candidat/${image}" alt="User Image" style=" max-height: 100px; min-height: 100px; clip-path:circle();">

                                            </div>
                                            <div class="col-6 text-left">
                                                <div class="row">

                                                    <div class="col-12 text-left">
                                                        <h5 class="${couleurAleatoire}" id="Montant_total_paye">${key.nom  +' '+ key.prenom}</h5>
                                                        <hr>
                                                        <h5 class="${couleurAleatoire}" id="Montant_total_paye">N° ${ajouterZero(key.numero)}</h5>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-3 text-left">
                                                <h5 class="${couleurSecond}" id="Montant_total_paye">${nbr} %</h5>
                                                <hr>
                                                <h5 class="${couleurSecond}" style="display: flex;" id="Montant_total_paye">${key.voix} / ${exprime}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="icon-heart ${couleurAleatoire} font-large-2 float-right"></i>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                    <div class="progress-bar ${couleur}" role="progressbar" style="width: ${pourcentage}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    `;

                    $("#card_candidat").append(txt);

                });
            }
            else{
                $("#id_exprime").html(0);
                    $("#id_blanc").html(0);
                    $("#id_nulle").html(0);
                    $("#id_bv").html(0);
            }


            $("#resultat_dash").unblock();

        },
    });

}
function ajouterZero(nombre) {
    // Si le nombre est inférieur à 10, ajoute un zéro devant
    if (nombre < 10) {
        return "0" + nombre;
    } else {
        return nombre;
    }
}

// ******************************filtre en tete *****************************************/////***/*/*/*/*/*/************************


//*********chargement district */
function chargeDistrictTous() {
    $.ajax({
        url: base + 'charge_district_tous',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#district_choix").empty();
            $("#district_choix").append(data);
            $('select').selectpicker('refresh');
            

        }
    });
}

//*********chargement commune a partir de choix district */
function chargeCommuneTous() {
    $.ajax({
        url: base + 'charge_commune_tous',
        type: "POST",
        data: {
            code_district: $("#district_choix").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#commune_choix").empty();
            $("#commune_choix").append(data);
            $('select').selectpicker('refresh');

        }
    });
}
//*********chargement commune a partir de choix district */
function chargeQuartierTous() {
    $.ajax({
        url: base + 'charge_quartier_tous',
        type: "POST",
        data: {
            code_commune: $("#commune_choix").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#fokontany_choix").empty();
            $("#fokontany_choix").append(data);
            $('select').selectpicker('refresh');

        }
    });


}
function chargeQuartierVider() {
    $.ajax({
        url: base + 'charge_quartier_tous',
        type: "POST",
        data: {
            code_commune: 0
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#fokontany_choix").empty();
            $("#fokontany_choix").append(data);
            $('select').selectpicker('refresh');

        }
    });


}



// **************************evenement changemenet de filtre
$("#district_choix").on('change', function name(params) {
    chargeCommuneTous();
    chargeQuartierVider();
});
$("#commune_choix").on('change', function name(params) {
    chargeQuartierTous();
})

///******************filtre deleguer ******* */

function filtrerDelegue() {

    liste_dashboard()

}