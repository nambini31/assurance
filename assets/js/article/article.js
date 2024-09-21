

$(document).ready(function () {
  hide_categ_form();
  generation_dropdown_fournisseur();
  liste_article();
  
});


function liste_article() {
  
  $.ajax({
    beforeSend: function () {

      $("#card_article_menuiserie").block({
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
    url: base + "listes_article",
    type: "POST",
    success: function (res) {
      if ($.fn.DataTable.isDataTable("#users-contacts")) {
        $("#users-contacts").DataTable().destroy();
    }
     else {
      }
      $('#users-contacts').empty();
      $("#users-contacts").append(res);
      
      $('#users-contacts').DataTable({
        destroy: true,
        ordering: true,
        order: [[0, "desc"]],
        responsive: true,
        info: false,
        paging: true,
        deferRender: true,
        pageLength: 7,
        "initComplete": function(settings, json) {
          $('div.dataTables_wrapper div.dataTables_filter input').attr('placeholder', 'Recherche').css("font-size", "7px");
        },
        language: {
          "search": "",
          "zeroRecords": "Aucun article",
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
              liste_article();

            },
          },

          {
            className: "btn btn-sm btn-warning btn-min-width ",
            text: '<i class="ft-plus"> Ajouter</i>',
            action: function () {
              formatPrixImput();
              $('.entete_modal').text("Ajout");
              $('#btn_add_article').text("Ajouter");
              $("#AddContactModal").modal(
                { backdrop: "static", keyboard: false },
                "show"
              );
              $('#ajout_article').find(':input:not([type="hidden"]):not([type="radio"])').each(function() {
                if ($(this).is('select.selectpicker')) {
                    // Réinitialiser le selectpicker en vidant les sélections
                    $(this).selectpicker('val', []);
                } else {
                    // Réinitialiser les autres champs en vidant leur valeur
                    $(this).val('');
                }
            });


            },
          },
        ],
      });
      $("#card_article_menuiserie").unblock();

    },
  });

}




function generation_dropdown_fournisseur() {

  $.ajax({
    beforeSend: function () { },
    url: base + "generation_dropdown_fournisseur",
    type: "POST",
    success: function (res) {
      $("#id_fournisseur").empty();
      $("#id_fournisseur").append(res);
      $(".selectpicker").selectpicker("refresh");
    },
  });

  

}


$("#ajout_article").off("submit").on("submit",function (e) {
  e.preventDefault();

  let data = new FormData(this);

  $.ajax({
    beforeSend: function () { },
    url: base + "ajout_article",
    type: "POST",
    processData: false,
    contentType: false,
    cache: false,
    dataType: "JSON",
    data: data,
    success: function (res) {
      if ($('#btn_add_article').text() === "Modifier") {
        if (res.status == "success") {
          alertCustom("success", "ft-check", "Modification effectué avec succée");
          $('#ajout_article').find(':input:not([type="radio"])').each(function() {
            if ($(this).is('select.selectpicker')) {
                // Réinitialiser le selectpicker en vidant les sélections
                $(this).selectpicker('val', []);
            } else {
                // Réinitialiser les autres champs en vidant leur valeur
                $(this).val('');
            }
            $("#AddContactModal").modal("hide");
        });
        } else {
          alertCustom("danger", "ft-x", "Modification non effectué");
        }
        
      } else {

        $("#card_article_menuiserie").unblock();
        if (res.status == "success") {
          alertCustom("success", "ft-check", "Ajout effectué avec succée");
          $('#ajout_article').find(':input:not([type="radio"])').each(function() {
            if ($(this).is('select.selectpicker')) {
                // Réinitialiser le selectpicker en vidant les sélections
                $(this).selectpicker('val', []);
            } else {
                // Réinitialiser les autres champs en vidant leur valeur
                $(this).val('');
            }
        });
        } else {
          alertCustom("danger", "ft-x", "Ajout non effectué");
        }
      }
      $("#id_article_men_modif").val("");
      
      liste_article();


    },
  });
});

function delete_article_from_dialog(id) {

  $("#card_article_menuiserie").unblock();

  $.ajax({
    beforeSend: function () {

      $("#card_article_menuiserie").block({
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
    url: base + "delete_article",
    type: "POST",
    data: { id_article: id },
    success: function (res) {

      $("#card_article_menuiserie").unblock();

      if (res.id > 0) {

        alertCustom("success", 'ft-check', "Suppression effectué avec succée");

      } else {

        alertCustom("danger", 'ft-x', "Suppression non effectué");

      }

      liste_article();

    },
  });

}

function close_overlay_liste_article() {
  $("#card_article_menuiserie").unblock();
}



function delete_article_from_dialog(id) {



  $("#card_article_menuiserie").unblock();

  $.ajax({
    beforeSend: function () {

      $("#card_article_menuiserie").block({
        // message: '<div class="ft-refresh-cw icon-spin font-medium-2" style="margin:auto"></div>',

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
    url: base + "delete_article",
    type: "POST",
    dataType: "JSON",
    data: { id_article: id },
    success: function (res) {

      $("#card_article_menuiserie").unblock();

      if (res.id > 0) {

        alertCustom("success", 'ft-check', "Suppression effectué avec succée");

      } else {

        alertCustom("danger", 'ft-x', "Suppression non effectué");

      }

      liste_article();

    },
  });

}

function edit_article(id) {
  formatPrixImput();
  $('.entete_modal').text("Modification");
  $('#btn_add_article').text("Modifier");
  $("#AddContactModal").modal(
    { backdrop: "static", keyboard: false },
    "show"
  );

  var designation = $('#art_' + id).data('designation');
  var presentation = $('#art_' + id).data('presentation');
  var unite = $('#art_' + id).data('unite');
  var prix_unitaire = $('#art_' + id).data('prix_unitaire');
  var quantite = $('#art_' + id).data('quantite');
  var datePeremption = $('#art_' + id).data('dateperemption');


  console.log(id, prix_unitaire, quantite) // périmer, se périmer, être périmé

  $('input[name="designation"]').val(designation);
  $('input[name="prix_unitaire"]').val(prix_unitaire);
  $('input[name="quantite"]').val(quantite);
  $('input[name="presentation"]').val(presentation);
  $('#unite').val(unite).selectpicker('refresh');
  $('#dateperemption').val(datePeremption);
  
  $('input[name="id_article"]').val(id);

}

function delete_article(id) {


  $("#card_article_menuiserie").block({
    message: `
        
        
        <div class="card" style="max-width:400px ; ">
        <div class="card-header" style="max-width:400px ;">
                 <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p>Voulez-vous supprimer cet article ?</p>

                    <button type="button" onclick="delete_article_from_dialog(`+ id + `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                    <button type="button" onclick="close_overlay_liste_article()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>


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
