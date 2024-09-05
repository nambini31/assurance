$(document).ready(function () {
    $('select').selectpicker('refresh');
    liste_cpn();
    charge_membre();
    charge_membre1();
    charge_type();
    $("#deleteConsultation").insertAfter("#modal_consultationcpn");


});

var membre_select ;
var titulaire_select ;
var specialite_docteur ;
var choix_docteur ;
var personne_select ;


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
                charge_titulaire_coix()
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
            
            var tab = $("#nat" + id).data('nature');

            // Vérifier si le tableau n'est pas vide
            if (tab && tab.length > 0) {
                // Si le tableau n'est pas vide, définir la valeur du selectpicker
                $("#analyse_select").val(tab).selectpicker('refresh');

            }
  
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
                getDocteurSelonType();
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
                $('#titulaire_select').val(titulaire_select).selectpicker('refresh');
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

function charge_personne_malade() {
    $.ajax({
        url: base + 'charge_personne_malade',
        type: "POST",
        data:{
            id : $("#titulaire_id").val()
        },
        success: function (data) {
            $("#personne_select").empty();
            $("#personne_select").append(data);
            $('select').selectpicker('refresh');
            if (personne_select != "") {
                $('#personne_select').val(personne_select).selectpicker('refresh');
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

function liste_cpn() {


    $.ajax({
        beforeSend: function () {

            $("#card_cpn").block({
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
        url: base + "liste_cpn",
        type: "POST",
        data:{
            id_membre :  $('#membre_choix').val() ,
            date_debut :  $('#date_debut').val() ,
            date_fin :  $('#date_fin').val()
        },
        success: function (res) {
            if ($.fn.DataTable.isDataTable("table_cpn")) {
                $("#table_cpn").DataTable().destroy();
            } else {
            }
            $('#table_cpn').empty();
            $("#table_cpn").append(res);


            $('#table_cpn').DataTable({
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

                            liste_cpn();

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
            $("#card_cpn").unblock();

        },
    });

}


function liste_descendant(id) {
    idCpn = id ;

    $("#descendant_modal").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}

var idCpn ;


function consult_cpn(id) {
    idCpn = id ;
    $("#idDetailsCons").val(id);
    fill_consult(id);
    $("#modal_consultationcpn").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}

var iddetail ;

function delete_detailcpn(id) {

    iddetail = id ;

    $("#deleteConsultation").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}
function delete_detail() {

    $.ajax({

        url: base + "delete_detailcpn",
        type: "POST",
        dataType: "JSON",
        data: { id : iddetail },
        success: function (res) {

            $("#deleteConsultation").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            fill_consult(idCpn);

        },
    });

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



// **************************ajout consultation 
$("#ajout_patient").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {

        },
        url: base + "ajout_patient",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        success: function (res) {

            if ($('#btn_add_patient').text() === "Modifier") {
                if (res.id == 1) {
                    alertCustom("success", "ft-check", "Modification effectué avec succée");

                    $("#AddpatientMalade").modal("hide");
                    affichage_details(idConsul , isFinished);
                    $('#motif_persMalade').val("");
                    

                }  else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
                
            } else {

                if (res.id == 1) {
                   
                    alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    affichage_details(idConsul , isFinished);
                    $('#motif_persMalade').val("");


                }else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
            }
           

            



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



function fill_consult(idcpn) {
    
    $.ajax({
        beforeSend: function () {

            $("#modal_consultationcpn").block({
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
        url: base + "listes_details_consult",
        type: "POST",
        data: {
            idcpn: idcpn,
        },
        success: function (res) {
            var res = JSON.parse(res);

            if ($.fn.DataTable.isDataTable("#table_consultation")) {
                $("#table_consultation").DataTable().destroy();
            } else {
            }
            $('#table_consultation').empty();
            $("#table_consultation").append(res.table);


            $('#table_consultation').DataTable({
                destroy: true,
                ordering: false,
                responsive: true,
                info: false,
                paging: false,
                deferRender: true,
                pageLength: 15,
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

                            
                            
                            $("#AddpatientMalade").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                                );
                                
                                $('.entete_modal_pat').text("Ajout patient");
                                $('#btn_add_patient').text("Ajouter");

                        },
                    },
                ],
            });
            $("#modal_consultationcpn").unblock();
        },
    });
}

function close_del_consultation() {
    $("#card_cpn").unblock();
}


// *************************dialogue suppression deleate
function supprimercpn(id) {


    idCpn = id ;
    
    $("#deleteCpn").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );


}


// **************************suppression apres boite dialogue de suppression
function delete_cpn() {


    $.ajax({
        beforeSend: function () {

            $("#card_cpn").block({
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
        url: base + "delete_cpn",
        type: "POST",
        dataType: "JSON",
        data: { id_cpn : idCpn },
        success: function (res) {

            $("#deleteCpn").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            liste_cpn();

        },
    });

}

// *****************modification consultation

function edit_consultation(id , membre_select1 , titulaire_select1 , choix_docteur1 , specialite_docteur1) {
    membre_select = membre_select1;
    titulaire_select =  titulaire_select1;
    specialite_docteur = specialite_docteur1;
    choix_docteur = choix_docteur1;
    $('#id_consultation').val(id);

    $('.entete_modal').text("Modification visite");
    $("#AddVisites").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    charge_membre();
    charge_type();

}
function edit_patient(id) {
    var motif = $("#nat" + id).data('motif');
    personne_select = $("#nat" + id).data('personne');
    $('#id_detail_consultattion').val(id);
    $('#motif_persMalade').val(motif);
    $('.entete_modal_pat').text("Modification patient");
    $('#btn_add_patient').text("Modifier");
    $("#AddpatientMalade").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    charge_personne_malade();

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