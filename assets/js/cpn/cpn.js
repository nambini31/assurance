$(document).ready(function () {
    $('select').selectpicker('refresh');
    charge_membre1();
    liste_cpn();
    charge_membre();
    $("#deleteConsultation").insertAfter("#ListesLabo");
    $("#AddConsultCpn").insertAfter("#ListesLabo");

   

});

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

var membre_select ;
var titulaire_select ;
var specialite_docteur ;
var choix_docteur ;
var personne_selectcpn ;
var analyse_select ;
var docteurEchographie ;
var typeechographie;



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
                charge_personne_malade();
            }
            $("#AddVisites").unblock();
  
        }
    });
}

function charge_personne_malade() {
    $.ajax({
        url: base + 'charge_personne_malade',
        type: "POST",
        data:{
            id : $("#titulaire_select").val()
        },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#personne_selectcpn").empty();
            $("#personne_selectcpn").append(data);
            $('select').selectpicker('refresh');
            if (personne_selectcpn != "") {
                $('#personne_selectcpn').val(personne_selectcpn).selectpicker('refresh');
            }
  
        }
    });
}




function charge_laboratoire_echographie() {
    $.ajax({
        beforeSend: function () {

            $("#modal_laboratoire").block({
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
        url: base + 'charge_laboratoire_echographie',
        type: "POST",
        data: { type: $("#type_destinataire").val() },
        error: function (xhr, status, error) {
            alertCustom("danger", 'ft-x', "Une erreur s'est produite");
        }, success: function (data) {
            $("#placeEchoLabo").empty();
            $("#placeEchoLabo").html(data);

            if ($("#type_destinataire").val() == "Echographie") {

                $("#submitEchoLabo").text("Envoyer à l'échographie");
                $('#typeEchographie').selectpicker('refresh');

                charge_doc_echographie();
                if (typeechographie != "") {
                    $('#typeEchographie').val(typeechographie).selectpicker('refresh');
                }
                $("#hideValidLabo").show();

            }
            else if ($("#type_destinataire").val() == "Laboratoire") {

                $("#submitEchoLabo").text("Envoyer au laboratoire");
                charge_analyse();
                $("#hideValidLabo").show();

            } else {
                $("#modal_laboratoire").unblock();
                $("#hideValidLabo").hide();

            }




        }
    });
}


  
function charge_doc_echographie() {
    $.ajax({
        url: base + 'charge_doc_echographie',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#docteurEchographie").empty();
            $("#docteurEchographie").html(data);
            $('#docteurEchographie').selectpicker('refresh');
            if (docteurEchographie != "") {
                $('#docteurEchographie').val(docteurEchographie).selectpicker('refresh');
            }
            $("#modal_laboratoire").unblock();
  
        }
    });

  }

  $('#type_destinataire').on('change', function() {
    
    charge_laboratoire_echographie();

    
});


$("#membre_select").on('change', function name(params) {
    
    charge_titulaire_coix();
})
$("#titulaire_select").on('change', function name(params) {

    charge_personne_malade();
})



function edit_laboratoire(id) {
   
    $("#AddLaboratoire").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    var nature = $("#labedit" + id).data('nature');
    typeDestinataire = $("#labedit" + id).data("typedestinataire");
    var typeecho = $("#labedit" + id).data("typeechographie");
    var doc = $("#labedit" + id).data("docteurechographie");

    analyse_select = nature;
    docteurEchographie = doc;
    typeechographie = typeecho;

    $("#type_destinataire").val(typeDestinataire).selectpicker("refresh");


    charge_laboratoire_echographie();

    $("#idDetails").val(iddetail);
    $("#idenvoielabo").val(id);
    $("#idConsPour").val(idCpn);

    var rc = $("#labedit" + id).data('rc');
    var resultats = $("#labedit" + id).data('resultats');

    $('#rc').val(rc);
    $('#resultats').val(resultats);

}
function laboratoire() {
   
    $("#AddLaboratoire").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    $("#idDetails").val(iddetail);
    $("#idConsPour").val(idCpn);


    $('#add_examen').find(':input:not([type="hidden"])').each(function() {
        if ($(this).is('select.selectpicker')) {
            $(this).selectpicker('val', []); // Réinitialiser le selectpicker
        } else {
            $(this).val('');
        }
    });

    $("#idenvoielabo").val("");

    charge_laboratoire_echographie();

}



$("#add_examen").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            
        },
        url: base + "add_Examen_cpn",
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
            alertCustom("success", "ft-check", "Demande d'examen envoyé");
            fill_consult(idCpn);
            fill_labo(iddetail);
            liste_cpn();

        },
    });
});


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

            $("#modal_laboratoire").unblock();
  
        }
    });

  }



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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            
            var res = JSON.parse(res);

            var hide = ["5" , "3" , "4"].includes(res.roleId) ? "" : 'hidden';


            if ($.fn.DataTable.isDataTable("#table_cpn")) {
                $("#table_cpn").DataTable().destroy();
            } else {
            }
            $('#table_cpn').empty();
            $("#table_cpn").append(res.table);


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
                        className: "btn btn-sm btn-warning btn-min-width "+hide,
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {
                            $("#AddVisites").unblock();

                            $('#id_cpnfirt').val('');

                            $('#add_consultation').find(':input:not([type="hidden"]):not([type="radio"])').each(function() {
                                if ($(this).is('select.selectpicker')) {
                                    // Réinitialiser le selectpicker en vidant les sélections
                                    $(this).selectpicker('val', []);
                                } else {
                                    // Réinitialiser les autres champs en vidant leur valeur
                                    $(this).val('');
                                }
                            });

                            $('.entete_modalVIS').text("Ajout CPN");
                            $('#btn_add_cpn_first').text("Ajouter");

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
    $("#idcpn1").val(id);

    $("#descendant_modal").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    

    var element = $('#cpnpere'+ id );

    // Attribuer les valeurs des data-* aux champs correspondants dans le formulaire
    $('input[name="idcpn"]').val(element.data('idcpn'));
    $('input[name="dateAccouchement"]').val(element.data('dateaccouchement'));

    // Fonction pour gérer les boutons radio (Oui/Non)
    

    // Attribuer les valeurs pour les radios (AGE < 16 ans, AGE > 35 ans, etc.)
    setRadioValue('ageinf16', element.data('ageinf16'));
    setRadioValue('agesup35', element.data('agesup35'));
    setRadioValue('taille', element.data('taille'));
    setRadioValue('tension', element.data('tension'));
    setRadioValue('parite', element.data('parite'));
    setRadioValue('cesarienne', element.data('cesarienne'));
    setRadioValue('mortne', element.data('mortne'));
    setRadioValue('drepanocytose', element.data('drepanocytose'));

    // Attribuer les dates des vaccinations
    $('input[name="vat1"]').val(element.data('vat1'));
    $('input[name="vat2"]').val(element.data('vat2'));
    $('input[name="vat3"]').val(element.data('vat3'));
    $('input[name="vat4"]').val(element.data('vat4'));
    $('input[name="vat5"]').val(element.data('vat5'));

    


}

function setRadioValue(name, value) {
    if (value === 1) {
        $('input[name="' + name + '"][value="1"]').prop('checked', true); // Oui
    } else if (value === 0) {
        $('input[name="' + name + '"][value="0"]').prop('checked', true); // Non
    } else {
        $('input[name="' + name + '"]').prop('checked', false); // Aucun checked
    }
}

var idCpn ;


function consult_cpn(id) {
    idCpn = id ;
    $("#idcpnCons").val(id);
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

            $("#deleteConsultation").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            fill_consult(idCpn);
            liste_cpn();

        },
    });

}

$("#add_cpnParam").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            
        },
        url: base + "add_cpnParam",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
                    //fill_paramettre( $("#idDetailsCons").val());
                 
                    alertCustom("success", "ft-check", "Parametrage effectué avec succée");
                    liste_cpn();



        },
    });
});

$("#add_consultcpn").off("submit").on("submit", function (e) {
    e.preventDefault();

    if (nums.includes($("#numCons").val()) ) {

          if (iddetail == '') {
            
              alertCustom("warning", "ft-check", "N° de consultation existe deja");

              return ;
          } else{
          
           if ( numedit != $("#numCons").val()) {
            
              alertCustom("warning", "ft-check", "N° de consultation existe deja");

              return ;
          }
          
          }



      
    } 

        let data = new FormData(this);

        $.ajax({
            beforeSend: function () {
                
            },
            url: base + "add_detailcpn",
            type: "POST",
            processData: false,
            contentType: false,
            cache: false,
            dataType: "JSON",
            data: data,
            error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
        
                        


                        if ($('#btn_add_detail_cpn').text() === "Modifier") {
                            if (res.id == 1) {
                                alertCustom("success", "ft-check", "Modification effectué avec succée");
            
                                $("#AddConsultCpn").modal("hide");
                                fill_consult(idCpn);

                                liste_cpn();
                                
            
                            }  else {
                                alertCustom("danger", "ft-x", "Ajout non effectué");
            
                            }
                            
                        } else {
            
                            if (res.id == 1) {
                               
                                alertCustom("success", "ft-check", "Ajout effectué avec succée");
                                fill_consult(idCpn);

                                                        $("#AddConsultCpn").modal("hide");
                                
                                                        liste_cpn();
            
                            }else {
                                alertCustom("danger", "ft-x", "Ajout non effectué");
            
                            }
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
        url: base + "ajout_cpn",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            $("#modal_visites").unblock();
            if ($('#btn_add_cpn_first').text() === "Modifier") {
                if (res.id == 1) {
                    alertCustom("success", "ft-check", "Modification effectué avec succée");

                    $("#AddVisites").modal("hide");
                    liste_cpn();

                    
                    

                }  else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
                
            } else {

                if (res.id == 1) {
                   
                    alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    liste_cpn();

                    $("#AddVisites").modal("hide");
                    


                }else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
            }

        },
    });
});

var nums = new Array();

function fill_consult(idcpn) {
    
    $.ajax({
        beforeSend: function () {

            $("#consultationcpn_modal").block({
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            var res = JSON.parse(res);
            $(".entete_modal2").text(res.num_cpn);

            var hide = [ "5" , "3" , "4"].includes(res.roleId) ? "" : 'hidden';

            if (["6"].includes(res.roleId)) {
                $('#add_cpnParam').find(':input').each(function() {
                    $(this).prop('disabled', true);
                });
                
            }else{
                $('#add_cpnParam').find(':input').each(function() {
                    $(this).prop('disabled', false); 
                });
               $('#poidstaille').prop('disabled', true);
            }
            
            nums = res.nums;
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
                        className: "btn btn-sm btn-warning btn-min-width "+hide,
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {

                            $("#idDetailsCons").val('');

                            $("#btn_add_detail_cpn").text('Ajouter');

                            iddetail = '';
                            

                              $('#add_consultcpn').find(':input:not([type="hidden"])').each(function() {
                                if ($(this).is('select.selectpicker')) {
                                    $(this).selectpicker('val', []); // Réinitialiser le selectpicker
                                } else {
                                    $(this).val('');
                                }
                            });

                            $("#AddConsultCpn").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                                );
                                $("#ListesLabo").css("overflow-y" , "auto") ;
                                $("#AddConsultCpn").css("overflow-y" , "auto") ;
                                
                                $('.entete_modal_patpo').text("Ajout consultation");
                                

                        },
                    },
                ],
            });
            $("#consultationcpn_modal").unblock();
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

var numedit ;
function edit_detailcpn(id) {

    var element = $("#detailcpn" + id);
    
    // Utiliser jQuery pour sélectionner les inputs par leur 'name' et assigner les valeurs des attributs 'data-*'
    const dataFields = [
        'tagd',
        'poids',
        'taille',
        'alboedemes',
        'vedese',
        'cpnconjonctive',
        'saignement',
        'hauteuruterine',
        'largue',
        'ddr',
        'dpa',
        'hu',
        'maf',
        'omi',
        'vat',
        'spi',
        'bdcf',
        'rechercheactive',
        'presentation',
        'refeaccouche',
        'serologierdr',
        'serologievidal',
        'asaurine',
        'groupage',
        'hiv',
        'fcv',
        'bw',
        'toxoplasmose',
        'rubuole',
        'tpha',
        'nfs',
        'feracfolique',
        'daterendevous',
        'createdAt'
    ];
    
    dataFields.forEach(field => {
        $('input[name="' + field + '"]').val(element.data(field));
    });

    numedit = element.data('num') ;
    $('#numCons').val(element.data('num')).selectpicker('refresh');
    $("#idDetailsCons").val(id);

    $("#btn_add_detail_cpn").text('Modifier');
    $(".entete_modal_patpo").text('Modification consultation');



    iddetail = id ;
    
    $("#AddConsultCpn").modal(
        { backdrop: "static", keyboard: false },
        "show"
        );
        
        
        $("#ListesLabo").css("overflow-y" , "auto") ;
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
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {

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

function edit_cpn(id , membre_select1 , titulaire_select1) {
    membre_select = membre_select1;
    titulaire_select =  titulaire_select1;

    $('#id_cpnfirt').val(id);
    personne_selectcpn = $("#cpnF" + id).data('personne');
    $('.entete_modalVIS').text("Modification CPN");
    $('#btn_add_cpn_first').text("Modifier");
    setRadioValue('mariee', $("#cpnF" + id).data('mariee'));
    $("#AddVisites").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    charge_membre();

}


function details_cpn(id) {

    $('.nav-tabs .nav-link').removeClass('active').first().addClass('active');
    
    $('.tab-content .tab-pane').removeClass('active').first().addClass('active');

    idCpn = id ;

    formatPrixImput();

    $("#ListesLabo").modal(
        { backdrop: "static", keyboard: false },
        "show"
        );
        $("#ListesLabo").css("overflow-y" , "auto") ;

    fill_consult(id);
    liste_descendant(id);

    

    $('.table_parametre').each(function() {
        $(this).DataTable({
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
    });

}


function fill_labo(id) {
    $.ajax({
        beforeSend: function () {

            $("#ListesLabocontent1").block({
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
            type: "cpn"
        },
        error: function (xhr, status, error) {
            alertCustom("danger", 'ft-x', "Une erreur s'est produite");
        }, success: function (res) {
            var res = JSON.parse(res);

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
                            laboratoire();

                        },
                    },
                ],
            });
            $("#ListesLabocontent1").unblock();

        },
    });
}



function affichage_demande(id) {

    $("#idDetails").val(id);
    $("#idConsPour").val(idCpn);
    $("#ListesDemande").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    iddetail = id ;

    fill_labo(id);
}





var idEnvoie ;
var typeEnvoie
var idType


var id_labo ;
var typeDestinataire ;
function delete_labo(id) {

    id_labo = id ;
    typeDestinataire = $("#labedit" + id).data("typedestinataire")
    $("#deletelabo").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

}

function delete_laboExam() {

    $.ajax({

        url: base + "delete_labo",
        type: "POST",
        dataType: "JSON",
        data: { id_labo : id_labo , id : idCpn , iddetail : iddetail , type : "cpn" , typeDestinataire : typeDestinataire},
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {


            $("#deletelabo").modal(
                "hide"
            );

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            fill_labo(iddetail);
            fill_consult(idCpn);
            liste_cpn();

        },
    });

}


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
    data.append('typeDestinataire', typeDestinataire);
    data.append('type', typeEnvoie);
    data.append('idConsult', idCpn);
    data.append('type', "cpn");

    $("#valideLabo").modal(
        "hide"
    );

    $.ajax({
        beforeSend: function () {

            $("#ListesLabocontent1").block({
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
            $("#ListesLabocontent1").unblock();
            fill_labo(iddetail);
            fill_consult(idCpn);
            liste_cpn();
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
    typeDestinataire = $("#labedit" + id).data("typedestinataire");

    idEnvoie = id ;
    idType = idType1 ;
    typeEnvoie = typeen

    $("#valideLabo").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );
    

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

    liste_cpn();

}

