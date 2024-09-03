$(document).ready(function () {
    $('select').selectpicker('refresh');
    liste_consultation();
    charge_membre();
    charge_membre1();
    charge_type();

});

var membre_select ;
var titulaire_select ;
var specialite_docteur ;
var choix_docteur ;


function charge_membre() {
    $.ajax({
        url: base + 'charge_membre1',
        type: "POST",
        success: function (data) {
            $("#membre_select").empty();
            $("#membre_select").append(data);
            $('select').selectpicker('refresh');
            if (membre_select != "") {
                $('#membre_select').val(membre_select).selectpicker('refresh');
            }
        }
    });
  }

function charge_membre1() {
    $.ajax({
        url: base + 'charge_membre',
        type: "POST",
        success: function (data) {
            $("#membre_choix").empty();
            $("#membre_choix").append(data);
            $('select').selectpicker('refresh');
  
        }
    });
  }
function charge_analyse(id) {
    $.ajax({
        url: base + 'charge_analyse',
        type: "POST",
        success: function (data) {
            $("#analyse_select").empty();
            $("#analyse_select").append(data);
            $('select').selectpicker('refresh');
            
            $("#analyse_select").val($("#nat"+id).data('nature')).selectpicker('refresh');
  
        }
    });

  }

function attribuer_nature(id) {
    $.ajax({
        url: base + "affiche_parametre",
        type: "POST",
        dataType: "JSON",
        data: { id: id },
        success: function (res) {

            $("#temperature2").val(res.temperature);
            $("#poids2").val(res.poids);
            $("#tension2").val(res.tension);
            $("#taille2").val(res.taille);
            $("#rc").val(res.rc);
            $("#resultats").val(res.resultats);

        },
    });
}

function charge_type() {
    $.ajax({
        url: base + 'getSpecialiteMedecin',
        type: "POST",
        success: function (data) {
            $("#specialite_docteur").empty();
            $("#specialite_docteur").append(data);
            $('select').selectpicker('refresh');
            if (specialite_docteur != "") {
                $('#specialite_docteur').val(specialite_docteur).selectpicker('refresh');
            }
        }
    });
  }

function charge_titulaire_coix() {
    $.ajax({
        url: base + 'charge_titulaire',
        type: "POST",
        data:{
            id_membre : $("#membre_select").val()
        },
        success: function (data) {
            $("#titulaire_select").empty();
            $("#titulaire_select").append(data);
            $('select').selectpicker('refresh');
            if (titulaire_select != "") {
                $('#specialite_docteur').val(titulaire_select).selectpicker('refresh');
            }
  
        }
    });
}

function getDocteurSelonType() {
    $.ajax({
        url: base + 'getDocteurSelonType',
        type: "POST",
        data:{
            id : $("#specialite_docteur").val()
        },
        success: function (data) {
            $("#choix_docteur").empty();
            $("#choix_docteur").append(data);
            $('select').selectpicker('refresh');
            if (choix_docteur != "") {
                $('#choix_docteur').val(choix_docteur).selectpicker('refresh');
            }
  
        }
    });
}


$("#membre_select").on('change', function name(params) {
    charge_titulaire_coix();
})
$("#specialite_docteur").on('change', function name(params) {
    getDocteurSelonType();
})



// ***********************************liste consultation

function liste_consultation() {


    $.ajax({
        beforeSend: function () {

            $("#card_consultation").block({
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
        url: base + "listes_consultation",
        type: "POST",
        data:{
            id_membre :  $('#membre_choix').val() ,
            date_debut :  $('#date_debut').val() ,
            date_fin :  $('#date_fin').val()
        },
        success: function (res) {
            if ($.fn.DataTable.isDataTable("table_consultation")) {
                $("#table_consultation").DataTable().destroy();
            } else {
            }
            $('#table_consultation').empty();
            $("#table_consultation").append(res);


            $('#table_consultation').DataTable({
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
                    "zeroRecords": "Aucun enregistrement",
                    paginate: {
                        previous: "Précédent",
                        next: "Suivant",
                    },
                }
                ,



                dom: "Bfrtip",
                buttons: [

                    {
                        className: "btn btn-sm btn-secondary",
                        text: '<i class="ft-rotate-cw"> </i>',
                        action: function () {

                            liste_consultation();

                        },
                    },

                 
                    {
                        className: "btn btn-sm btn-warning btn-min-width ",
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {


                            $("#AddVisites").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                            );
                            


                        },
                    },
                    


                ],
            });
            $("#card_consultation").unblock();

        },
    });

}
function parametre(id) {

    $("#idDetailsCons").val(id);
    $("#temperature").val("");
            $("#poids").val("");
            $("#tension").val("");
            $("#taille").val("");
    fill_paramettre(id);
    $("#AddParametre").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    formatPrixImput()
    

}

function fill_paramettre(id) {

    $.ajax({
        url: base + "affiche_parametre",
        type: "POST",
        dataType: "JSON",
        data: { id : id },
        success: function (res) {

            $("#temperature").val(res.temperature);
            $("#poids").val(res.poids);
            $("#tension").val(res.tension);
            $("#taille").val(res.taille);
            $("#temperature1").text(res.temperature);
            $("#poids1").text(res.poids);
            $("#tension1").text(res.tension);
            $("#taille1").text(res.taille);


        },
    });
}

function laboratoire(id) {
    $("#idDetails").val(id);
    $("#AddLaboratoire").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    $("#temperature2").val("");
            $("#poids2").val("");
            $("#tension2").val("");
            $("#taille2").val("");
            $("#rc").val("");
            $("#resultats").val("");
    attribuer_nature(id)
    charge_analyse(id);
}

var idConsul ;
var isFinished ;

function liste_patient(idconsultation , isFinished) {

     idConsul = idconsultation;
     isFinished = isFinished;

    affichage_details(idconsultation, isFinished);
    $("#AddConsultation").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}


// **************************ajout consultation 
$("#ajout_consultation").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            $("#modal_content_add_consultation").block({
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
        url: base + "ajout_consultation",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        success: function (res) {

            if ($('#btn_add_consultation').text() === "Modifier") {
                if (res.id == 1) {
                    alertCustom("success", "ft-check", "Modification effectué avec succée");
                    liste_consultation();
                    annulerAjoutconsultation();
                    $("#AddContactModal").modal("hide");

                } else if (res.id == 2) {
                    alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                } else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
                
            } else {

                if (res.id == 1) {
                   
                    annulerAjoutconsultation();
                    alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    liste_consultation();

                } else if (res.id == 2) {
                    alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                } else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
            }
           

            

            $("#modal_content_add_consultation").unblock();


        },
    });
});
$("#add_parametre").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            
        },
        url: base + "add_parametre",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        success: function (res) {
                    //fill_paramettre( $("#idDetailsCons").val());
                    $("#AddParametre").modal("hide"
                    );
                    alertCustom("success", "ft-check", "Parametrage effectué avec succée");
                    affichage_details(idConsul , isFinished);



        },
    });
});

$("#add_examen").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            
        },
        url: base + "add_Examen",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        success: function (res) {
            $("#AddLaboratoire").modal("hide"
            );
                    alertCustom("success", "ft-check", "Demande d'examen envoyé");
                    
                    affichage_details(idConsul , isFinished);

        },
    });
});

$("#add_consultation").off("submit").on("submit", function (e) {

    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            $("#AddVisites").block({
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
        url: base + "ajout_consultation",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        success: function (res) {
            $("#AddVisites").modal("hide");
            $("#AddVisites").unblock();
            liste_patient(res.consultationId , res.isFinished);
            liste_consultation();

        },
    });
});

function affichage_details(idconsultation, isFinished) {
    
    $.ajax({
        beforeSend: function () {

            $("#AddConsultation").block({
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
        url: base + "listes_patient_malade",
        type: "POST",
        data: {
            idconsultation: idconsultation,
            isFinished: isFinished,
        },
        success: function (res) {
            var res = JSON.parse(res);
            $(".entete_modal").html(res.num_carte);
            $(".entete_docteur").html(res.docteur);

            if ($.fn.DataTable.isDataTable("#table_patient")) {
                $("#table_patient").DataTable().destroy();
            } else {
            }
            $('#table_patient').empty();
            $("#table_patient").append(res.table);


            $('#table_patient').DataTable({
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
                    "zeroRecords": "Aucun enregistrement",
                    paginate: {
                        previous: "Précédent",
                        next: "Suivant",
                    },
                },




                dom: "Bfrtip",
                buttons: [
                    {
                        className: "btn btn-sm btn-warning btn-min-width ",
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {


                            $("#AddConsultation").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                            );
                            annulerAjoutconsultation();


                        },
                    },
                ],
            });
            $("#AddConsultation").unblock();

        },
    });
}

function close_del_consultation() {
    $("#card_consultation").unblock();
}

// *************************dialogue suppression deleate
function supprimerconsultation(id) {


    $("#card_consultation").block({
        message: `
          
          
          <div class="card" style="max-width:400px ; ">
          <div class="card-header" style="max-width:400px ;">
                   <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
          </div>
          <div class="card-content">
              <div class="card-body">
                  <p>Voulez-vous supprimer ce consultation  ?</p>
  
                      <button type="button" onclick="delete_consultation_from_dialog(`+ id + `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                      <button type="button" onclick="close_del_consultation()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
  
  
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
function delete_consultation_from_dialog(id) {



    $("#card_consultation").unblock();

    $.ajax({
        beforeSend: function () {

            $("#card_consultation").block({
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
        url: base + "delete_consultation",
        type: "POST",
        dataType: "JSON",
        data: { id_consultation : id },
        success: function (res) {

            $("#card_consultation").unblock();

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            liste_consultation();

        },
    });

}

// *****************modification consultation

var id_faritany = 0;
var id_region = 0;
var id_district = 0;
var id_bv = 0;

function edit_consultation(id) {
    

    $('.entete_modal').text("Modification consultation");
    $('#btn_add_consultation').text("Modifier");
    $("#AddContactModal").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    var id_medecin = $('#cons_' + id).data('id_medecin');
    var id_membre = $('#cons_' + id).data('id_membre');
    var numero_patient = $('#cons_' + id).data('numero_patient');
    var motif = $('#cons_' + id).data('motif');
    num = numero_patient;
    $('#medecin_select').val(id_medecin).selectpicker('refresh');
    $('#membre_select').val(id_membre).selectpicker('refresh');
    $('#motif').val(motif);

    charge_titulaire_coix();

    $('#id_consultation_men_modif').val(id);

}

var num = "";

//*******************ANNULATION BUTTTON */

function annulerAjoutconsultation() {

    // $('#patient_select').selectpicker('val', []);
    // $('#medecin_select').selectpicker('val', []);
    // $("#id_consultation_men_modif").val("");
    // $("#motif").val("");
    // num = "";
}



// ******************************filtre en tete *****************************************/////***/*/*/*/*/*/************************

function filtrerVisite() {

    liste_consultation()

}