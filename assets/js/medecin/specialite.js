// Initialisation du DataTable

$(document).ready(function () {
  liste_specialite();
  
});

function liste_specialite() {
  $("#nom_specialite").val("");
  $("#id_specialite").val("");
  
  $("#ajouterspecialite").text("Ajouter");
  $.ajax({
    beforeSend: function () {
      $("#card_specialite").block({
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
    url: base + "liste_specialite",
    type: "POST",
    success: function (response) {
      $("#table_specialite ").empty();
      $("#table_specialite").append(response);
     
      // Convertissez la chaîne JSON en objet JavaScript
        $("#table_specialite").DataTable({
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
              liste_specialite();
            },
          },
        ],
      
      });

     $("#card_specialite").unblock();
    
    },

  });
}


// Fonction pour rafraichir le Form et le dataTable



// Fonction pour obtenir les données selectionnés et remplir le Form  **************************
function editspecialite(id) {


    var nom = $('#cab_' + id).data('nom_specialite');

    $('#nom_specialite').val(nom);
    $("#ajouterspecialite").text("Modifier");


    $('input[name="id_specialite"]').val(id);
}

// Fonction ajout et Modification  ************************************
$("#ajout_specialite").off("submit").on("submit",function (e) {
  e.preventDefault();
  var formData = new FormData(this);

    $.ajax({
      beforeSend: function () {},
      url: base + "ajout_specialite",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: formData,
      success: function (res) {
      

        //appler le Toast pour afficher le message
        if (res.id == 1) {

          if ($("#id_specialite").val() == "") {
            
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
          Annulerspecialite();
          liste_specialite();
        } else {
          alertCustom("danger", "ft-x", "Erreur ");
        }
      },
    });
 
});



function close_overlay_liste_specialite() {
  $("#card_specialite").unblock();
}

// Fonction pour dialogue une catégorie  ************************************************
function supprimerspecialite(id) {
  $("#card_specialite").block({
    message:
      `
    <div class="card" style="max-width:400px ;">
    <div class="card-header" style="max-width:400px ;  height:80px ">
             <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
    </div>
    <div class="card-content">
        <div class="card-body">
            <p>Voulez-vous supprimer ce specialite ?</p>

                <button type="button" onclick="delete_specialite_from_dialog(` +
      id +
      `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                <button type="button" onclick="close_overlay_liste_specialite()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>


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

function delete_specialite_from_dialog(id) {
  $.ajax({
    url: base + "supprimer_specialite",
    type: "POST",
    data: { id: id },
    success: function (response) {
      alertCustom("success", "ft-check", "Suppression effectué avec succée");
      liste_specialite();
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
  Annulerspecialite();
});

// Fonction pour vider les champs du formulaire **************************************************
function Annulerspecialite() {
  $("#nom_specialite").val("");
  $("#id_specialite").val("");
  //   isEditing = false;
  $("#ajouterspecialite").text("Ajouter");
}
