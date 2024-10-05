$(document).ready(function () {
    $('select').selectpicker('refresh');


    liste_resultat();
    chargeDistrictTous();

    $("#usercin").on('paste', function () {
        $(this).typeahead('open');
    });


    //*********fonctionnaliter utile pour plutart */
    $('#usercin').typeahead({
        minLength: 11,
        source: function (query, result) {

            if (query.length > 11) {
                $.ajax({
                    beforeSend: function name(params) {
                        $('#modal_content_add_delegue').block({
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
                    url: base + 'autocomplete',
                    method: "POST",
                    data: { query: query, code_faritany: $("#select_province").val(), code_region: $("#select_region").val() },
                    dataType: "json",

                    error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {

                        if (data.CINELECT) {
                            $('#select_district').selectpicker('val', data.CODE_DISTRICT);
                            $('#usernom').val(data.NOMELECT + " " + data.PRENOMELECT);
                            chargeBV(data.CODE_DISTRICT)
                            $('#info_plus_delegue').empty();
                            let txt = `<hr><p>Commune : ${data.LIBELLE_COMMUNE}</p> <p>Quartier : ${data.LIBELLE_FOKONTANY}</p> <p>Centre Vote : ${data.LIBELLE_CV}</p><hr>`;
                            $('#info_plus_delegue').html(txt);

                        } else {
                            alertCustom("danger", 'ft-x', "Cin introuvable dans cette region");
                        }
                        $('#modal_content_add_delegue').unblock();


                    }
                })
            }
            else {
                $('#select_district').selectpicker('val', []);
                $('#select_bv').selectpicker('val', []);
                $('#usercontact').val('');
                $('#usernom').val('');
                $('#info_plus_delegue').empty();
            }

        },

    });

});

/***********************regex pour nombre seulement */

function nombreOnly() {


    var numberPattern = /^\d*$/;

    $('input[name^="Voix_"]').on('input', function () {

        if (!numberPattern.test($(this).val())) {

            var cursorPosition = this.selectionStart;

            $(this).val(function (_, value) {
                return value.replace(/\D/g, '');
            });

          
            this.setSelectionRange(cursorPosition, cursorPosition);

            alert('Seuls les nombres sont autorisés dans ce champ.');
        }
    });


}

//*****************************chargement province**************** */
function chargeVoix() {
    $.ajax({
        url: base + 'charge_voix',
        type: "POST",
        data: {
            code_district: $("#select_district").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#id_voix_res").empty();
            $("#id_voix_res").append(data);

            if (id_bv != 0) {

                $('input[name="Voix_nulle"]').val(voix_nulle);
                $('input[name="Voix_blanc"]').val(voix_blanc);

                tab.forEach(element => {
                    Object.entries(element).forEach(([cle, valeur]) => {
                        $('input[name="Voix_' + ajouterZero(cle) + '"]').val(valeur);

                    });
                });
            }
            nombreOnly();

            $("#modal_content_add_res").unblock();
        }
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


//*********************chargement tous region  choisit dans une faritany choisit
function chargeRegion() {

    $.ajax({
        url: base + 'charge_region',
        type: "POST",
        data: {
            code_faritany: $("#select_province").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#select_region").empty();
            $("#select_region").append(data);

            $('select').selectpicker('refresh');
            if (id_region !== 0) {
                $('#select_region').val(id_region).selectpicker('refresh');
                chargeDistrict();
            }

        }
    });


}
//***************************chargement tous district  choisit dans une region
function chargeDistrict() {

    $.ajax({
        url: base + 'charge_district',
        type: "POST",
        data: {
            code_region: $("#select_region").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#select_district").empty();
            $("#select_district").append(data);

            $('select').selectpicker('refresh');
            if (id_district !== 0) {
                $('#select_district').val(id_district).selectpicker('refresh');
                chargeBV();
            }

        }
    });


}
//**************************chargement tous bureau de vote choisit dans un district
function chargeBV() {

    $.ajax({
        url: base + 'charge_bv',
        type: "POST",
        data: {
            code_district: $("#select_district").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#select_bv").empty();
            $("#select_bv").append(data);
            $('select').selectpicker('refresh');
            if (id_bv !== 0) {
                $('#select_bv').val(id_bv).selectpicker('refresh');

            }

        }
    });


}


// **************************evenement changemenet

$("#select_district").on('change', function name(params) {
    chargeBV();
    chargeVoix();
});



// ***********************************liste delegue

function liste_resultat() {


    $.ajax({
        beforeSend: function () {

            $("#card_resultat").block({
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
        url: base + "listeResultat",
        type: "POST",
        data: {
            code_district: $("#district_choix").val(),
            code_commune: $("#commune_choix").val(),
            code_fokontany: $("#fokontany_choix").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            if ($.fn.DataTable.isDataTable("#table_resultat")) {
                $("#table_resultat").DataTable().destroy();
            } else {
            }
            $('#table_resultat').empty();
            $("#table_resultat").append(res);

            $('#table_resultat').DataTable({
                destroy: true,
                ordering: true,
                order: [[0, "desc"]],
                responsive: true,
                info: false,
                paging: true,
                deferRender: true,
                pageLength: 7,
                "initComplete": function (settings, json) {
                    $('div.dataTables_wrapper div.dataTables_filter input').attr('placeholder', 'Recherche').css("font-size", "7px");
                },
                language: {
                    "search": "",
                    "zeroRecords": "Aucun enregistrements",
                    paginate: {
                        previous: "Précédent",
                        next: "Suivant",
                    },
                }
                ,



                dom: "Bfrtip",
                buttons: [

                    {
                        extend: "excelHtml5",
                        title: "Liste resultat",
                        className: "btn btn-sm btn-success",
                        text: 'Excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }

                    },


                    {
                        className: "btn btn-sm btn-warning btn-min-width ",
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {

                            $('.entete_modal').text("Ajout resultat ");
                            $('#btn_add_resultat').text("Ajouter");

                            $("#ResultatModal").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                            );
                            annulerAjoutResultat();


                        },
                    },
                ],
            });
            $("#card_resultat").unblock();

        },
    });

}


// **************************ajout delegue 
$("#ajout_resultat").off("submit").on("submit", function (e) {
    e.preventDefault();

    if ($('#id_voix_res').children().length > 0) {
        let data = new FormData(this);

        $.ajax({
            beforeSend: function () {
                $("#modal_content_add_res").block({
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
            url: base + "ajout_resultat",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            dataType: "JSON",
            data: data,
            error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

                if ($('#btn_add_resultat').text() === "Modifier") {
                    if (res.id == 1) {
                        alertCustom("success", "ft-check", "Modification effectué avec succée");
                        annulerAjoutResultat();
                        liste_resultat();
                        $("#ResultatModal").modal("hide");
                    } else if (res.id == 2) {
                        alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                    } else {
                        alertCustom("danger", "ft-x", "Ajout non effectué");

                    }


                } else {

                    if (res.id == 1) {

                        $('#ajout_resultat input[name^="Voix_"]').each(function () {
                            $(this).val('');
                        });

                        annulerAjoutResultat();
                        liste_resultat();
                        alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    } else if (res.id == 2) {
                        alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                    } else {
                        alertCustom("danger", "ft-x", "Ajout non effectué");

                    }

                }


                $("#modal_content_add_res").unblock();



            },
        });
    } else {
        alertCustom("danger", "ft-x", "Aucune candidat inscrit");
    }


});

function annulerAjoutResultat() {
    $("#id_resultat_men_modif").val("");
    $('input[name^="Voix_"]').val('');
    id_bv = 0;
    chargeVoix();

}

function close_del_resultat() {
    $("#card_resultat").unblock();
}

// *************************dialogue suppression deleate
function delete_resultat(id) {


    $("#card_resultat").block({
        message: `
          
          
          <div class="card" style="max-width:400px ; ">
          <div class="card-header" style="max-width:400px ;">
                   <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
          </div>
          <div class="card-content">
              <div class="card-body">
                  <p>Voulez-vous supprimer ce resultat  ?</p>
  
                      <button type="button" onclick="delete_resultat_from_dialog(`+ id + `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                      <button type="button" onclick="close_del_resultat()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
  
  
              </div>
          </div>
          </div>
        
  
  
          `,

        overlayCSS: {
            backgroundColor: 'black',
            opacity: 0.1,
            cursor: "wait",

        },
        css: {
            border: 0,
            padding: 0,
            backgroundColor: "transparent"
        }
    });


}


// **************************suppression apres boite dialogue de suppression
function delete_resultat_from_dialog(id) {



    $("#card_resultat").unblock();

    $.ajax({
        beforeSend: function () {

            $("#card_resultat").block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2" style="margin:auto"></div>',

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
        url: base + "delete_resultat",
        type: "POST",
        dataType: "JSON",
        data: { id_resultat: id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

            $("#card_resultat").unblock();

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            liste_resultat();

        },
    });

}

// *****************modification delegue

var id_faritany = 0;
var id_region = 0;
var id_district = 0;
var id_bv = 0;
var voix_nulle = 0;
var voix_blanc = 0;
var tab;

function edit_resultat(id) {

    $("#modal_content_add_res").block({
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


    $('.entete_modal').text("Modification resultat");
    $('#btn_add_resultat').text("Modifier");
    $("#ResultatModal").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    voix_nulle = $('#res_' + id).data('voix_nulle');
    voix_blanc = $('#res_' + id).data('voix_blanc');
    var code_district = $('#res_' + id).data('code_district');
    var code_bv = $('#res_' + id).data('code_bv');
    tab = $('#res_' + id).data('voix');

    id_district = code_district;
    id_bv = code_bv;


    $('#select_district').val(code_district).selectpicker('refresh');

    chargeBV()
    chargeVoix();

    $('input[name="id_resultat"]').val(id);



}

//*******************ANNULATION BUTTTON */





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

            $("#select_district").empty();
            $("#select_district").append(data);

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

function filtrerResultat() {

    liste_resultat()

}
