$(document).ready(function () {
    $('select').selectpicker('refresh');
    chargeProvince();
    liste_delegue();
    chargeDistrictTous();

    $("#usercin").on('paste', function () {
        $(this).typeahead('open');
    });
    var array;


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

//*****************************chargement province**************** */
function chargeProvince() {
    $.ajax({
        url: base + 'charge_province',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#select_province").empty();
            $("#select_province").append(data);
            $('select').selectpicker('refresh');

        }
    });
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

                $("#modal_content_add_delegue").unblock();

            }

        }
    });


}


// **************************evenement changemenet

$("#select_province").on('change', function name(params) {
    chargeRegion();
});
$("#select_region").on('change', function name(params) {
    chargeDistrict();
});
$("#select_district").on('change', function name(params) {
    chargeBV();
});



// ***********************************liste delegue

function liste_delegue() {


    $.ajax({
        beforeSend: function () {

            $("#card_delegue").block({
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
        url: base + "listes_delegue",
        type: "POST",
        data: {
            code_district: $("#district_choix").val(),
            code_commune: $("#commune_choix").val(),
            code_fokontany: $("#fokontany_choix").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            if ($.fn.DataTable.isDataTable("table_delegue")) {
                $("#table_delegue").DataTable().destroy();
            } else {
            }
            $('#table_delegue').empty();
            $("#table_delegue").append(res);


            $('#table_delegue').DataTable({
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
                        title: "Liste délégués",
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

                            $('.entete_modal').text("Ajout délégué ");
                            $('#btn_add_delegue').text("Ajouter");

                            $("#AddContactModal").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                            );
                            chargeProvince();
                            $('#ajout_delegue')[0].reset();
                            ('#select_bv').selectpicker('val', []);
                            ('#select_region').selectpicker('val', []);
                            ('#select_district').selectpicker('val', []);
                            $("#id_delegue_men_modif").val("");


                        },
                    },
                ],
            });
            $("#card_delegue").unblock();

        },
    });

}


// **************************ajout delegue 
$("#ajout_delegue").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            $("#modal_content_add_delegue").block({
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
        url: base + "ajout_delegue",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

            if ($('#btn_add_delegue').text() === "Modifier") {
                if (res.id == 1) {
                    alertCustom("success", "ft-check", "Modification effectué avec succée");
                    liste_delegue();
                    annulerAjoutDelegue();
                    $("#AddContactModal").modal("hide");

                } else if (res.id == 2) {
                    alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                } else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
                
            } else {

                if (res.id == 1) {
                   
                    annulerAjoutDelegue();
                    alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    liste_delegue();
                } else if (res.id == 2) {
                    alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                } else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
            }
           

            

            $("#modal_content_add_delegue").unblock();


        },
    });
});

function close_del_delegue() {
    $("#card_delegue").unblock();
}

// *************************dialogue suppression deleate
function delete_delegue(id) {


    $("#card_delegue").block({
        message: `
          
          
          <div class="card" style="max-width:400px ; ">
          <div class="card-header" style="max-width:400px ;">
                   <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
          </div>
          <div class="card-content">
              <div class="card-body">
                  <p>Voulez-vous supprimer ce délégué  ?</p>
  
                      <button type="button" onclick="delete_delegue_from_dialog(`+ id + `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                      <button type="button" onclick="close_del_delegue()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
  
  
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
function delete_delegue_from_dialog(id) {



    $("#card_delegue").unblock();

    $.ajax({
        beforeSend: function () {

            $("#card_delegue").block({
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
        url: base + "delete_delegue",
        type: "POST",
        dataType: "JSON",
        data: { id_delegue: id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

            $("#card_delegue").unblock();

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            liste_delegue();

        },
    });

}

// *****************modification delegue

var id_faritany = 0;
var id_region = 0;
var id_district = 0;
var id_bv = 0;

function edit_delegue(id) {
    $("#modal_content_add_delegue").block({
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

    $('.entete_modal').text("Modification délégué");
    $('#btn_add_delegue').text("Modifier");
    $("#AddContactModal").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    var nom = $('#del_' + id).data('nom');
    var contact = $('#del_' + id).data('contact');
    var code_faritany = $('#del_' + id).data('code_faritany');
    var code_region = $('#del_' + id).data('code_region');
    var code_district = $('#del_' + id).data('code_district');
    var code_bv = $('#del_' + id).data('code_bv');

    id_region = code_region;
    id_district = code_district;
    id_bv = code_bv;

    $('input[name="contact"]').val(contact);
    $('input[name="nom"]').val(nom);
    $('#select_province').val(code_faritany).selectpicker('refresh');
    chargeRegion();
    $('input[name="id_delegue"]').val(id);

}

//*******************ANNULATION BUTTTON */

function annulerAjoutDelegue() {
    $('#select_bv').selectpicker('val', []);
    $('#usercontact').val('');
    $('#usernom').val('');
    $("#id_delegue_men_modif").val("");
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

    liste_delegue()

}