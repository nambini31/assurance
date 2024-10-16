$(document).ready(function () {
    $('select').selectpicker('refresh');
    liste_membre();

});










// ***********************************liste membre

function liste_membre() {


    $.ajax({
        beforeSend: function () {

            $("#card_membre").block({
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
        url: base + "listes_membre",
        type: "POST",
        success: function (res) {
            if ($.fn.DataTable.isDataTable("table_membre")) {
                $("#table_membre").DataTable().destroy();
            } else {
            }
            $('#table_membre').empty();
            $("#table_membre").append(res);


            $('#table_membre').DataTable({
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
                        className: "btn btn-sm btn-secondary btn-min-width ",
                        text: '<i class="ft-refresh"> Actualiser</i>',
                        action: function () {

                            liste_membre();


                        },
                    },

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

                            $('.entete_modal').text("Ajout Membre ");
                            $('#btn_add_membre').text("Ajouter");

                            $("#AddContactModal").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                            );
                           
                            $('#ajout_membre')[0].reset();
                            $("#id_membre_men_modif").val("");


                        },
                    },
                ],
            });
            $("#card_membre").unblock();

        },
    });

}


// **************************ajout membre 
$("#ajout_membre").off("submit").on("submit", function (e) {
    e.preventDefault();

    let data = new FormData(this);

    $.ajax({
        beforeSend: function () {
            $("#modal_content_add_membre").block({
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
        url: base + "ajout_membre",
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: data,
        success: function (res) {

            if ($('#btn_add_membre').text() === "Modifier") {
                if (res.id == 1) {
                    alertCustom("success", "ft-check", "Modification effectué avec succée");
                    liste_membre();
                    annulerAjoutmembre();
                    $("#AddContactModal").modal("hide");

                } else if (res.id == 2) {
                    alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                } else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
                
            } else {

                if (res.id == 1) {
                   
                    annulerAjoutmembre();
                    alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    liste_membre();
                } else if (res.id == 2) {
                    alertCustom("danger", "ft-x", "Bureau de vote existe déjà");
                } else {
                    alertCustom("danger", "ft-x", "Ajout non effectué");

                }
            }
           

            

            $("#modal_content_add_membre").unblock();


        },
    });
});

function close_del_membre() {
    $("#card_membre").unblock();
}

// *************************dialogue suppression deleate
function delete_membre(id) {


    $("#card_membre").block({
        message: `
          
          
          <div class="card" style="max-width:400px ; ">
          <div class="card-header" style="max-width:400px ;">
                   <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
          </div>
          <div class="card-content">
              <div class="card-body">
                  <p>Voulez-vous supprimer ce membre  ?</p>
  
                      <button type="button" onclick="delete_membre_from_dialog(`+ id + `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                      <button type="button" onclick="close_del_membre()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
  
  
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
function delete_membre_from_dialog(id) {



    $("#card_membre").unblock();

    $.ajax({
        beforeSend: function () {

            $("#card_membre").block({
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
        url: base + "delete_membre",
        type: "POST",
        dataType: "JSON",
        data: { id_membre: id },
        success: function (res) {

            $("#card_membre").unblock();

            if (res.id > 0) {

                alertCustom("success", 'ft-check', "Suppression effectué avec succée");

            } else {

                alertCustom("danger", 'ft-x', "Suppression non effectué");

            }

            liste_membre();

        },
    });

}

// *****************modification membre

var id_faritany = 0;
var id_region = 0;
var id_district = 0;
var id_bv = 0;

function edit_membre(id) {
    

    $('.entete_modal').text("Modification Membre");
    $('#btn_add_membre').text("Modifier");
    $("#AddContactModal").modal(
        { backdrop: "static", keyboard: false },
        "show"
    );

    var nom = $('#mem_' + id).data('nom_membre');
    var contact = $('#mem_' + id).data('contact_membre');
    var email = $('#mem_' + id).data('email_membre');

    $('input[name="contact_membre"]').val(contact);
    $('input[name="nom_membre"]').val(nom);
    $('input[name="email_membre"]').val(nom);

    $('input[name="id_membre"]').val(id);

}

//*******************ANNULATION BUTTTON */

function annulerAjoutmembre() {
    $('#ajout_membre')[0].reset();
    $("#id_membre_men_modif").val("");
}



// ******************************filtre en tete *****************************************/////***/*/*/*/*/*/************************

