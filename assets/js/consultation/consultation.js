$(document).ready(function () {
    $('select').selectpicker('refresh');
    liste_consultation();
    charge_membre();
    charge_membre1();
    charge_type();
    charge_administration();
    $("#AddpatientMalade").insertAfter("#AddConsultation");
    $("#deletepatient").insertAfter("#AddConsultation");
    

});

var membre_select ;
var titulaire_select ;
var specialite_docteur ;
var choix_docteur ;
var analyse_select ;
var medicament_select ;
var personne_select ;
var idAdministration ;


function charge_membre() {
    $.ajax({
        url: base + 'charge_membre1',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
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

function charge_administration() {
    $.ajax({
        url: base + 'charge_administration',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#idAdministration").empty();
            $("#idAdministration").append(data);
            $('select').selectpicker('refresh');
            if (idAdministration != "") {
                $('#idAdministration').val(idAdministration).selectpicker('refresh');
            }
        }
    });
  }

function charge_membre1() {
    $.ajax({
        url: base + 'charge_membre',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#membre_choix").empty();
            $("#membre_choix").append(data);
            $('select').selectpicker('refresh');
  
        }
    });
  }

function charge_analyse() {
    $.ajax({
        url: base + 'charge_analyse',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#analyse_select").empty();
            $("#analyse_select").append(data);
            $('select').selectpicker('refresh');
            if (analyse_select != "") {
                $('#analyse_select').val(analyse_select).selectpicker('refresh');
            }
  
        }
    });

  }

function charge_medicament() {
    $.ajax({
        
        beforeSend: function () {

            $("#modal_medicament").block({
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
        url: base + 'charge_medicament',
        type: "POST",
        data:{
            qte : ancienQte ,
            medicament_select : medicament_select
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#medicament_select").empty();
            $("#medicament_select").append(data);
            $('select').selectpicker('refresh');
            if (medicament_select != "") {
                $('#medicament_select').val(medicament_select).selectpicker('refresh');
            }

            $("#modal_medicament").unblock();
  
        }
    });

}

$('#medicament_select').on('change', function() {
    
    $('#qte').val("");  // Stocker la quantité max dans le champ qte
    var maxQuantity = $('#medicament_select').find('option:selected').data('qte-max');
    // Si maxQuantity est 0, vider le champ et sortir
    if (maxQuantity === 0) {
        alertCustom("warning", 'ft-x', "Stock epuisé");
    }

    
});

$('#qte').on('keydown', function(e) {

    var maxQuantity = $('#medicament_select').find('option:selected').data('qte-max');

    if (maxQuantity === 0) {
        $(this).val(''); 
        alertCustom("warning", 'ft-x', "Stock epuisé");
        return;
    }

    if ($(this).val() == "") {
        return;
    }

    
    let value = parseInt($(this).val());
  
    if (e.key === 'ArrowUp') {
        e.preventDefault(); // Empêcher le comportement par défaut

        if (value == maxQuantity) {
            $(this).val(maxQuantity);
        }
        else{

            $(this).val(value + 1); // Incrémenter la valeur
        }
        
    } else if (e.key === 'ArrowDown') {
        e.preventDefault(); // Empêcher le comportement par défaut
        if (value == 1) {
            $(this).val(1);
        }
        else{
            $(this).val(value - 1); // Décrémenter la valeur
        }
    }
  });


$('#qte').on('input', function() {
    var enteredQuantity = $(this).val();  // Obtenir la valeur actuelle
    var maxQuantity = $('#medicament_select').find('option:selected').data('qte-max');

    // Si le champ est vide, ne rien faire
    if (enteredQuantity === '') {
        return;
    }

    // Si maxQuantity est 0, vider le champ et sortir
    if (maxQuantity === 0) {
        $(this).val(''); 
        alertCustom("warning", 'ft-x', "Stock epuisé");
        return;
    }

    // Convertir en nombre à virgule flottante pour la vérification
    enteredQuantity = parseFloat(enteredQuantity);

    // Empêcher la saisie de valeurs inférieures à 1 ou supérieures à la quantité maximale
    if (enteredQuantity > maxQuantity) {
        $(this).val(maxQuantity);  // Fixer la valeur au maximum si elle dépasse
    } else if (enteredQuantity < 1) {
        $(this).val(1);  // Fixer la valeur à 1 si elle est inférieure
    }
});

function charge_type() {
    $.ajax({
        url: base + 'getSpecialiteMedecin',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
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
    $.ajax({
        url: base + 'charge_titulaire',
        type: "POST",
        data:{
            id_membre : $("#membre_select").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#titulaire_select").empty();
            $("#titulaire_select").append(data);
            $('select').selectpicker('refresh');
            if (titulaire_select != "") {
                $('#titulaire_select').val(titulaire_select).selectpicker('refresh');
            }

            $("#AddVisites").unblock();
  
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {


            var res = JSON.parse(res);

            var hide = ["5" , "1" , "2"].includes(res.roleId) ? "" : 'hidden';
            
            if ($.fn.DataTable.isDataTable("table_consultation")) {
                $("#table_consultation").DataTable().destroy();
            } else {
            }
            $('#table_consultation').empty();
            $("#table_consultation").append(res.table);


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
                        className: "btn btn-sm btn-warning btn-min-width "+hide,
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {

                            $('#id_consultation').val('');

                            $('#add_consultation').find(':input:not([type="hidden"])').each(function() {
                                if ($(this).is('select.selectpicker')) {
                                    $(this).selectpicker('val', []); // Réinitialiser le selectpicker
                                } else {
                                    $(this).val('');
                                }
                            });

                            $('.entete_modalVIS').text("Ajout visite");

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


function fill_paramettre(id) {

    $.ajax({
        beforeSend: function () {

            $("#card_parametre").block({
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
        url: base + "affiche_parametre",
        type: "POST",

        data: { id : id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
        var res = JSON.parse(res);

        
        if ($.fn.DataTable.isDataTable("#table_parametre_vrai1")) {
            $("#table_parametre_vrai1").DataTable().destroy();
        } else {
        }
        if ($.fn.DataTable.isDataTable("#table_parametre_vrai2")) {
            $("#table_parametre_vrai2").DataTable().destroy();
        } else {
        }


            $("#table_parametre_vrai").empty();
            $("#table_parametre_vrai").append(res.table);
            $('#table_parametre_vrai1').DataTable({
                destroy: true,
                ordering: false,
                responsive: true,
                info: false,
                paging: false,
                deferRender: true,
                searching : false ,
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




                dom: "frtip",
               
            });
            $('#table_parametre_vrai2').DataTable({
                destroy: true,
                ordering: false,
                responsive: true,
                info: false,
                paging: false,
                deferRender: true,
                searching : false ,
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




                dom: "frtip",
               
            });

            if (["3"].includes(isFinished) ) {
                $("#hideValidParam").hide();
            }else{
                $("#hideValidParam").show();
            }

            if (["6"].includes(res.roleId)) {
                $('#add_parametre').find(':input').each(function() {
                    $(this).prop('disabled', true);
                });
                
            }else{
                $('#add_parametre').find(':input').each(function() {
                    $(this).prop('disabled', false); 
                });
            }

            
        
            // Appel de la fonction quand le poids ou la taille change
            $('#poids, #taille').on('input', function() {
                calculerPoidsTaille();
            });
    
            formatPrixImput();
        },
    });

    $("#card_parametre").unblock();
}

function fill_conclusion(id) {

    $.ajax({
        beforeSend: function () {

            $("#card_conclusion").block({
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
        url: base + "affiche_conclusion",
        type: "POST",

        data: { id : id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
        var res = JSON.parse(res);

        
        $("#table_conclusion_vrai").empty();
            $("#table_conclusion_vrai").append(res.table);

            formatPrixImput();
            $(".idDetailsCons").val(iddetail);
            submitConclusion();
        },
    });

    $("#card_conclusion").unblock();
}

function calculerPoidsTaille() {
    var poids = parseFloat($('#poids').val()) || 0;
    var taille = parseFloat($('#taille').val()) || 0;

    if (poids > 0 && taille > 0) {
        var poidsTaille = poids / taille;
        $('#poidstaille').val(poidsTaille.toFixed(2));  // Met à jour la valeur visible
        $('#poidstaille').attr('value', poidsTaille.toFixed(2));  // Met à jour l'attribut 'value'
    } else {
        $('#poidstaille').val('');  // Vide la valeur visible
        $('#poidstaille').attr('value', '');  // Vide l'attribut 'value'
    }
}


function fill_clinique(id) {

    $.ajax({
        url: base + "affiche_clinique",
        type: "POST",

        data: { id : id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
        var res = JSON.parse(res);

        if ($.fn.DataTable.isDataTable("#table_clinique_vrai")) {
            $("#table_clinique_vrai").DataTable().destroy();
        } else {
        }


            $("#table_clinique_vrai").empty();
            $("#table_clinique_vrai").append(res.table);
            $('#table_clinique_vrai').DataTable({
                destroy: true,
                ordering: false,
                responsive: true,
                info: false,
                paging: false,
                deferRender: true,
                searching : false ,
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




                dom: "frtip",
               
            });
            

            formatPrixImput();
        },
    });
}

function fill_antecedent(id) {

    $.ajax({
        url: base + "affiche_antecedent",
        type: "POST",

        data: { id : id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
        var res = JSON.parse(res);

        if ($.fn.DataTable.isDataTable("#table_antecedent_vrai")) {
            $("#table_antecedent_vrai").DataTable().destroy();
        } else {
        }


            $("#table_antecedent_vrai").empty();
            $("#table_antecedent_vrai").append(res.table);
            $('#table_antecedent_vrai').DataTable({
                destroy: true,
                ordering: false,
                responsive: true,
                info: false,
                paging: false,
                deferRender: true,
                searching : false ,
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




                dom: "frtip",
               
            });
            

            formatPrixImput();
        },
    });
}



function edit_laboratoire(id) {
   
    $("#AddLaboratoire").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    var nature = $("#labedit" + id).data('nature');

    analyse_select = nature ;
    
    charge_analyse();
    $("#idDetails").val(iddetail);
    $("#idenvoielabo").val(id);
    $("#idConsPour").val(idConsul);

    var rc = $("#labedit" + id).data('rc');
    var resultats = $("#labedit" + id).data('resultats');

    $('#rc').val(rc);
    $('#resultats').val(resultats);

}

var ancienQte ;

var iddetailmedicament ;

function delete_medic(id) {

    iddetailmedicament = id ;
   
   $("#deletemedicament").modal(
       { backdrop: "static", keyboard: false },
       "show"
   );


}

function edit_medic(id) {
   
    $("#AddMedicament").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    var idAdmin = $("#medicedit" + id).data('idadministration');
    var idMedic = $("#medicedit" + id).data('medicamentid');

    idAdministration = idAdmin ;
    medicament_select = idMedic ;
    var qte = $("#medicedit" + id).data('qte');
    
    ancienQte = qte ;
    
    charge_medicament();
    charge_administration();
    
    $("#idDetails1").val(iddetail);
    $("#iddetailmedicament").val(id);
    $("#idConsPour1").val(idConsul);

    var durrejours = $("#medicedit" + id).data('durrejours');
    var modeprise = $("#medicedit" + id).data('modeprise');

    $('#qte').val(qte);
    $('#durrejours').val(durrejours);
    $('#modeprise').val(modeprise);

    $('#btn_add_med').text("Modifier");
    $('.entete_modal_med').text("MODIFICATION");

}
function laboratoire() {
   
    $("#AddLaboratoire").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    $("#idDetails").val(iddetail);
    $("#idConsPour").val(idConsul);

    $('#add_examen').find(':input:not([type="hidden"])').each(function() {
        if ($(this).is('select.selectpicker')) {
            $(this).selectpicker('val', []); // Réinitialiser le selectpicker
        } else {
            $(this).val('');
        }
    });

    $("#idenvoielabo").val("");

}

var idConsul ;
var isFinished ;

function liste_patient(idconsultation , isFinished1) {

     idConsul = idconsultation;
     isFinished = isFinished1;

    affichage_details(idconsultation, isFinished);
    $("#AddConsultation").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    

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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
                    
                    alertCustom("success", "ft-check", "Parametrage effectué avec succée");
                    affichage_details(idConsul , isFinished);



        },
    });
});



$("#add_clinique").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            
        },
        url: base + "add_clinique",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

                    alertCustom("success", "ft-check", "Examen clinique enregistré avec succée");
                    affichage_details(idConsul , isFinished);



        },
    });
});

$("#add_antecedent").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            
        },
        url: base + "add_antecedent",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

                    alertCustom("success", "ft-check", "Antecedents enregistré avec succée");
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            $("#AddLaboratoire").modal("hide"
            );
            fill_labo(iddetail);
                    alertCustom("success", "ft-check", "Demande d'examen envoyé");
                    
                    affichage_details(idConsul , isFinished);
                    liste_consultation();

        },
    });
});

$("#add_medicament").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    data.append('ancienQte', ancienQte);

    $.ajax({
        beforeSend: function () {
            $("#modal_medicament").block({
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
        url: base + "add_medicament",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

                    $("#modal_medicament").unblock();

                    if(res.id == 1 && $("#iddetailmedicament").val() == ""){

                        fill_prescription(iddetail);
                        alertCustom("success", "ft-check", "Ajout effectué avec succée");

                        addMedicModal();

                        affichage_details(idConsul , isFinished);
                        liste_consultation();

                    }
                    else if (res.id == 1 && $("#iddetailmedicament").val() != "") {
                        alertCustom("success", "ft-check", "Modification effectué avec succée");
                        $("#AddMedicament").modal("hide");
                        fill_prescription(iddetail);

                        affichage_details(idConsul , isFinished);
                        liste_consultation();
                    }
                    else {

                        alertCustom("warning", "ft-check", res.message);
                        
                    }
                    

        },
    });
});

$("#add_consultation").off("submit").on("submit", function (e) {

    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            $("#modal_visites").block({
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            $("#AddVisites").modal("hide");
            $("#modal_visites").unblock();
            liste_patient(res.consultationId , res.isFinished);
            liste_consultation();

        },
    });
});



var iddetail ;

function submitConclusion() {
    $("#add_ceritificat").off("submit").on("submit", function (e) {

        e.preventDefault();


        let data = new FormData(this);

        $.ajax({
            beforeSend: function () {
            },
            url: base + "add_ceritificat",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            dataType: "JSON",
            data: data,
            error: function (xhr, status, error) {
                alertCustom("danger", 'ft-x', "Une erreur s'est produite");
            }, success: function (res) {

                alertCustom("success", "ft-check", "Certification enregistré avec succée");
                affichage_details(idConsul, isFinished);



            },
        });
    });

    $("#add_repos").off("submit").on("submit", function (e) {
        e.preventDefault();

        let data = new FormData(this);

        $.ajax({
            beforeSend: function () {
            },
            url: base + "add_repos",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            dataType: "JSON",
            data: data,
            error: function (xhr, status, error) {
                alertCustom("danger", 'ft-x', "Une erreur s'est produite");
            }, success: function (res) {

                alertCustom("success", "ft-check", "Repos medical enregistré avec succée");
                affichage_details(idConsul, isFinished);



            },
        });
    });
}

function delete_detailvisite(id) {

    iddetail = id ;

    $("#deletepatient").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}
var id_labo ;

function delete_labo(id) {

    id_labo = id ;

    $("#deletelabo").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}
function delete_detail() {

    $.ajax({

        url: base + "delete_detailconsul",
        type: "POST",
        dataType: "JSON",
        data: { id : iddetail , idConsul : idConsul },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {


            $("#deletepatient").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");
                affichage_details(idConsul , isFinished);
            liste_consultation();

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            

        },
    });

}
function delete_medicament() {

    $.ajax({

        url: base + "delete_detail_medicament",
        type: "POST",
        dataType: "JSON",
        data: { id : iddetailmedicament , iddetail : iddetail},
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {


            $("#deletemedicament").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");
                fill_prescription(iddetail);
                affichage_details(idConsul , isFinished);
                liste_consultation();

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }


        },
    });

}

function delete_laboExam() {

    $.ajax({

        url: base + "delete_labo",
        type: "POST",
        dataType: "JSON",
        data: { id_labo : id_labo , id : idConsul , iddetail : iddetail , type : "visite"},
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {


            $("#deletelabo").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");
                affichage_details(idConsul , isFinished);
            fill_labo(iddetail);
            liste_consultation();

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            

        },
    });

}

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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            var res = JSON.parse(res);
            isFinished = res.isFinished ;
            var hide = ["5" , "1" , "2"].includes(res.roleId) ? "" : 'hidden';

            if (["1" , "2"].includes(res.roleId)) {

                if (res.isFinished != "0" && res.typeConsultationId == "1") {
                    hide = "hidden"
                }
                if (res.isFinished != "1" && res.typeConsultationId == "2") {
                    hide = "hidden"
                }

            }

            if (res.isFinished == "0") {
                
                $("#textParamDoc").text("Souhaitez-vous valider le paramétrage et envoyer le(s) patient(s) au docteur ?");
            }
            else {
                $("#textParamDoc").text("Souhaitez-vous valider et envoyer le(s) patient(s) au pahrmacie si nécessaire ?");
            }


            if (res.isLabo == "1" ) {
                $("#hideValidParamDoc").hide();
            }else{
                
                    if (res.isFinished == "3" ) {
                        
                        $("#hideValidParamDoc").hide();
                    }
                    
                    else{
                        
                        if (["1", "2" ,"6"].includes(res.roleId)) {
                            
                            $("#hideValidParamDoc").hide();
                            
                        }else{
                            if (["8"].includes(res.roleId) &&res.isFinished == "2" ) {
                                
                                $("#hideValidParamDoc").hide();
                            }
                            else if (["3","4"].includes(res.roleId) &&res.isFinished == "1" ) {
                                
                                $("#hideValidParamDoc").hide();
                            }
                            else{

                                $("#hideValidParamDoc").show();
    
                                if (["3","4","5"].includes(res.roleId) && res.isFinished == "0") {
                                    $("#btn_add_patie").text("Envoyer au docteur");
                                }
                                if (["8","5"].includes(res.roleId) && res.isFinished == "1") {

     
                                        $("#btn_add_patie").text("Valider ou Envoyer au pharmacie");
                                        
                            

                                }
                                if (["9","5"].includes(res.roleId) && res.isFinished == "2") {
                                    $("#btn_add_patie").text("Terminer");
                                }
                            }
                           
                        }
                        

                    }
                

            }



            $(".entete_modal1").html(res.num_carte);
            $(".entete_docteur").html(res.docteur);
            $("#titulaire_id").val(res.titulaireId);
            $("#id_patient").val(res.titulaireId);
            $("#id_concult").val(idconsultation);

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
                        className: "btn btn-sm btn-warning btn-min-width "+ hide ,
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {

                            $('#id_detail_consultattion').val('');

                            $('#ajout_patient').find(':input:not([type="hidden"])').each(function() {
                                if ($(this).is('select.selectpicker')) {
                                    $(this).selectpicker('val', []); // Réinitialiser le selectpicker
                                } else {
                                    $(this).val('');
                                }
                            });
                            
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
            $("#AddConsultation").unblock();
            charge_personne_malade();
            
        },
    });
}

function affichage_demande(id) {

    $('.nav-tabs .nav-link').removeClass('active').first().addClass('active');
    
    $('.tab-content .tab-pane').removeClass('active').first().addClass('active');

    iddetail = id ;
    if (["3"].includes(isFinished) ) {
        $("#hideValidParam").hide();
    }else{
        $("#hideValidParam").show();
    }
    formatPrixImput();
    charge_analyse();

    $(".idDetailsCons").val(id);

    $("#ListesLabo").modal(
        { backdrop: "static", keyboard: false },
        "show"
        );
    
        iddetail = id ;

    fill_paramettre(id);
    fill_clinique(id);
    fill_labo(id);
    fill_prescription(id);
    fill_conclusion(id);
    fill_antecedent(id);
}


function fill_labo(id) {
    $.ajax({
        beforeSend: function () {

            $("#card_demande").block({
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
        url: base + "listes_envoie_labo",
        type: "POST",
        data: {
            idType: id,
            type: "visite"
        },
        error: function (xhr, status, error) {
            alertCustom("danger", 'ft-x', "Une erreur s'est produite");
        }, success: function (res) {
            var res = JSON.parse(res);

            if (["4" , "3"].includes(res.isFinished) ) {
                $("#hideValidLabo").hide();
            }else{
                $("#hideValidLabo").show();
        
            }

            if ($.fn.DataTable.isDataTable("#table_demande")) {
                $("#table_demande").DataTable().destroy();
            } else {
            }
            $('#table_demande').empty();
            $("#table_demande").append(res.table);


            $('#table_demande').DataTable({
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
                        className: "btn btn-sm btn-warning btn-min-width "+res.hide ,
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {
                            $("#idenvoielabo").val(id);
                            laboratoire();

                        },
                    },
                ],
            });
            $("#card_demande").unblock();

        },
    });
}

function fill_prescription(id) {
    $.ajax({
        beforeSend: function () {

            $("#card_prescription").block({
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
        url: base + "listes_medicament",
        type: "POST",
        data: {
            id: id,
        },
        error: function (xhr, status, error) {
            alertCustom("danger", 'ft-x', "Une erreur s'est produite");
        }, success: function (res) {
            var res = JSON.parse(res);

            var hide = ["5" , "8"].includes(res.roleId) ? "" : 'hidden';

            if ([0].includes(res.ishide) ) {
                $("#hideImprimeMedic").hide();
            }else{
                $("#hideImprimeMedic").show();
            }


            if ($.fn.DataTable.isDataTable("#table_prescription")) {
                $("#table_prescription").DataTable().destroy();
            } else {
            }
            $('#table_prescription').empty();
            $("#table_prescription").append(res.table);


            $('#table_prescription').DataTable({
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
                        className: "btn btn-sm btn-warning btn-min-width "+ hide ,
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {

                            addMedicModal();

                        },
                    },
                ],
            });
            $("#card_prescription").unblock();

        },
    });
}

function addMedicModal() {
    $("#AddMedicament").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    $("#iddetailmedicament").val("");

    $("#idDetails1").val(iddetail);
    $("#idConsPour1").val(idConsul);

    $('#add_medicament').find(':input:not([type="hidden"])').each(function () {
        if ($(this).is('select.selectpicker')) {
            $(this).selectpicker('val', []); // Réinitialiser le selectpicker
        } else {
            $(this).val('');
        }
    });

    $('#btn_add_med').text("Ajouter");
    $('.entete_modal_med').text("AJOUT");
    medicament_select = "";
    ancienQte = "";

    charge_medicament();
    formatPrixImput();
}

function close_del_consultation() {
    $("#card_consultation").unblock();
}

// *************************dialogue suppression deleate
function supprimerconsultation(id) {

     idConsul = id ;
    
    $("#deleteconsultation").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );


}
function medic_docteur(id) {

     iddetail = id ;
    
    $("#AddDocteur").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );


}

function envoyer_doc() {


    $("#valideParametre").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );


}


function confirmer_anvoie_doc() {

    $("#valideParametre").modal(
        "hide"
    );

    

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
        url: base + "envoyer_docteur",
        type: "POST",
        dataType: "JSON",
        data: { id_consultation : idConsul , isFinished : isFinished},
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

        $("#AddConsultation").unblock();

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Envoie effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Envoie non effectué");

            }

            affichage_details(idConsul , isFinished);
            liste_consultation();

        },
    });


}


// **************************suppression apres boite dialogue de suppression
function delete_consultation() {

    $.ajax({

        url: base + "delete_consultation",
        type: "POST",
        dataType: "JSON",
        data: { id_consultation : idConsul },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

            $("#deleteconsultation").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            affichage_details(idConsul , isFinished);
            liste_consultation();

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

    $('.entete_modalVIS').text("Modification visite");
    $("#AddVisites").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    charge_membre();
    charge_type();

}



var idEnvoie ;
var typeEnvoie
var idType



$("#form_analyse").off("submit").on("submit", function (e) {

    e.preventDefault();

    var fileInput = $('#fichierAnalyse')[0]; // Assurez-vous que l'élément de fichier est dans le DOM

    if (fileInput.files.length > 0) {
        var file = fileInput.files[0];

        // Vérification de la taille du fichier (3 Mo max)
        if (file.size > 3 * 1024 * 1024) {
            alert('Le fichier ne doit pas dépasser 3 Mo.');
            return;
        }

        // Vérification du type de fichier
        var allowedTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ];

        if (!allowedTypes.includes(file.type)) {
            alert('Le fichier doit être un PDF, un document Word, une présentation PowerPoint ou un fichier Excel.');
            return;
        }
    }

    let data = new FormData(this);

    data.append('idenvoie_labo', idEnvoie);
    data.append('idType', idType);
    data.append('type', typeEnvoie);
    data.append('idConsult', idConsul);
    data.append('type', "visite");

    $("#valideLabo").modal(
        "hide"
    );

    $.ajax({
        beforeSend: function () {

            $("#ListesLabocontent").block({
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
        url: base + "valider_envoie_labo",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            alertCustom("success", 'ft-check', "Confirmation effectué avec succée");
            $("#ListesLabocontent").unblock();
            fill_labo(idType);
            affichage_details(idConsul, isFinished);
            liste_consultation();
        },
    });
});

function downloadFile(id) {
    // Sélectionnez l'élément de fichier pour vérifier ses propriétés
    

    $.ajax({
        url: base + "downloadFile",
        data: {
            fileName: $("#idlabed" + id).data("file")
        },
        type: 'POST',
        xhrFields: {
            responseType: 'blob' // Important pour le téléchargement de fichiers
        },
        success: function(response, status, xhr) {
            var contentType = xhr.getResponseHeader('Content-Type');
        var blob = new Blob([response], { type: contentType });
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = $("#idlabed" + id).data("file");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(link.href);
            alertCustom("success", 'ft-check', "Téléchargement effectué avec succès");
        },
        error: function(xhr, status, error) {
            // Affichez des informations de débogage en cas d'erreur
            alertCustom("success", 'ft-check', "Téléchargement effectué avec succès");

        }
    });
    
}


function valider_demande(id , idType1) {

    var typeen = $("#labovalider" + id).data('typeenvoie');

    idEnvoie = id ;
    idType = idType1 ;
    typeEnvoie = typeen
    $('#fichierAnalyse').val("");

    $("#valideLabo").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    

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