// Initialisation du DataTable

$(document).ready(function () {
  liste_medecin();
  charge_specialite();
  charge_cabinet();
  
});

function charge_specialite() {
  $.ajax({
      url: base + 'charge_specialite',
      type: "POST",
      success: function (data) {
          $("#id_specialite_id").empty();
          $("#id_specialite_id").append(data);
          $('select').selectpicker('refresh');

      }
  });
}


function charge_cabinet() {
  $.ajax({
      url: base + 'charge_cabinet',
      type: "POST",
      success: function (data) {
          $("#id_cabinet_id").empty();
          $("#id_cabinet_id").append(data);
          $('select').selectpicker('refresh');

      }
  });
}


function liste_medecin() {
  $("#nom_medecin").val("");
  $("#id_medecin").val("");
  
  $("#ajoutermedecin").text("Ajouter");
  $.ajax({
    beforeSend: function () {
      $("#card_medecin").block({
        message:
          '<div class="ft-refresh-cw icon-spin font-medium-2" style="margin:auto , font-size : 80px !important"></div>',
  
        overlayCSS: {
          backgroundColor: "black",
          opacity: 0.1,
          cursor: "wait",
        },
        css: {
          border: 0,
          padding: 0,
          backgroundColor: "transparent",
        },
      });
    },
    url: base + "liste_medecin",
    type: "POST",
    success: function (response) {
      $("#table_medecin ").empty();
      $("#table_medecin").append(response);
     
      // Convertissez la chaîne JSON en objet JavaScript
        $("#table_medecin").DataTable({
        destroy: true,
        ordering: true,
        order: [[0, "desc"]],
        info: false,
        paging: true, 
        preDrawCallback: function (settings) {
          
        },
        pageLength: 5,
        "initComplete": function(settings, json) {
          $('div.dataTables_wrapper div.dataTables_filter input').attr('placeholder', 'Recherche').css("font-size", "7px");
        },
        language: {
          "search": "",
          zeroRecords: "Aucun enregistrement",
          paginate: {
            previous: "Précédent",
            next: "Suivant",
          },
        },
        dom: "Bfrtip",
        buttons: [
          {
            className: "btn btn-sm btn-secondary btn-min-width",
            text: '<i class="ft-refresh-ccw"> Actualiser</i>',
            action: function () {
              liste_medecin();
            },
          },
        ],
      
      });

     $("#card_medecin").unblock();
    
    },

  });
}


// Fonction pour rafraichir le Form et le dataTable



// Fonction pour obtenir les données selectionnés et remplir le Form  **************************
function editmedecin(id) {


    var nom = $('#med_' + id).data('nom_medecin');

    $('#nom_medecin_id').val(nom);

    $('#id_specialite_id').val($('#med_' + id).data('id_specialite')).selectpicker('refresh');
    $('#id_cabinet_id').val($('#med_' + id).data('id_cabinet')).selectpicker('refresh');
    $("#ajoutermedecin").text("Modifier");
    $('#id_medecin_id').val(id);
}

// Fonction ajout et Modification  ************************************
$("#ajout_medecin").off("submit").on("submit",function (e) {
  e.preventDefault();
  var formData = new FormData(this);

    $.ajax({
      beforeSend: function () {},
      url: base + "ajout_medecin",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: formData,
      success: function (res) {
      

        //appler le Toast pour afficher le message
        if (res.id == 1) {

          if ($("#id_medecin").val() == "") {
            
            alertCustom(
              "success",
              "ft-check",
              "Ajout effectuée avec succée"
            );

          } else {
            alertCustom(
              "success",
              "ft-check",
              "Modification effectuée avec succée"
            );
            
          }
          Annulermedecin();
          liste_medecin();
        } else {
          alertCustom("danger", "ft-x", "Erreur ");
        }
      },
    });
 
});



function close_overlay_liste_medecin() {
  $("#card_medecin").unblock();
}

// Fonction pour dialogue une catégorie  ************************************************
function supprimermedecin(id) {
  $("#card_medecin").block({
    message:
      `
    <div class="card" style="max-width:400px ;">
    <div class="card-header" style="max-width:400px ;  height:80px ">
             <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
    </div>
    <div class="card-content">
        <div class="card-body">
            <p>Voulez-vous supprimer ce medecin ?</p>

                <button type="button" onclick="delete_medecin_from_dialog(` +
      id +
      `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                <button type="button" onclick="close_overlay_liste_medecin()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>


        </div>
    </div>
    </div>
  


    `,

    overlayCSS: {
      backgroundColor: "black",
      opacity: 0.1,
      cursor: "wait",
    },
    css: {
      border: 0,
      padding: 0,
      backgroundColor: "transparent",
    },
  });
}

function delete_medecin_from_dialog(id) {
  $.ajax({
    url: base + "supprimer_medecin",
    type: "POST",
    data: { id: id },
    success: function (response) {
      alertCustom("success", "ft-check", "Suppression effectué avec succée");
      liste_medecin();
    },
    error: function (error) {
      alertCustom(
        "danger",
        "ft-x",
        "Erreur lors de la suppression de la catégorie"
      );
    },
  });
}

//Gerer le boutton Annuler
$("#annuler").on("click", function () {
  Annulermedecin();
});

// Fonction pour vider les champs du formulaire **************************************************
function Annulermedecin() {
  $("#nom_medecin_id").val("");
  $("#id_medecin_id").val("");
  $('#id_specialite_id').selectpicker('val', []);
  $('#id_cabinet_id').selectpicker('val', []);
  $("#ajoutermedecin").text("Ajouter");
}
