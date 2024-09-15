// Initialisation du DataTable

$(document).ready(function () {
  refresh_cat();
  
});

function refresh_cat() {
  $("#designation").val("");
  $("#editCategoryId").val("");
  
  $("#ajouterButton").text("Ajouter");
  $.ajax({
    beforeSend: function () {
      $("#card_categorie").block({
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
    url: base + "afficher_categorie",
    type: "POST",
    success: function (response) {
      $("#table_categorie ").empty();
      $("#table_categorie").append(response);
     
      // Convertissez la chaîne JSON en objet JavaScript
        $("#table_categorie").DataTable({
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
          zeroRecords: "Aucune catégorie",
          paginate: {
            previous: "Précédent",
            next: "Suivant",
          },
        },
        dom: "Bfrtip",
        buttons: [
          {
            className: "btn btn-sm btn-secondary",
            text: '<i class="ft-rotate-cw"> </i>',
            action: function () {
              refresh_cat();
            },
          },
        ],
      
      });

     $("#card_categorie").unblock();
    
    },

  });
}


// Fonction pour rafraichir le Form et le dataTable



// Fonction pour obtenir les données selectionnés et remplir le Form  **************************
function editCategorie(id) {
  //   isEditing = true;
  $.ajax({
    url: base + "get_categorie_details",
    type: "POST",
    data: { id: id },
    success: function (response) {
      // Convertissez la chaîne JSON en objet JavaScript
      var categorie = JSON.parse(response);
      console.log(categorie);
      // Remplissez le formulaire d'édition avec les détails récupérés et changer le texte boutton
      $("#designation").val(categorie.designation);
      $("#editCategoryId").val(categorie.id_categorie);
      $("#ajouterButton").text("Modifier");
    },
    error: function (error) {
      console.error(
        "Erreur lors de la récupération des détails de la catégorie:",
        error
      );
    },
  });
}

// Fonction ajout et Modification  ************************************
$("#ajout_categorie").off("submit").on("submit",function (e) {
  e.preventDefault();
  var formData = new FormData();
  var editCategoryId = $("#editCategoryId").val();
  var designation = $("#designation").val();

  // Append values to the FormData object
  formData.append("id", editCategoryId);
  formData.append("designation", designation);

  console.log(editCategoryId);

  if (editCategoryId) {
    $.ajax({
      beforeSend: function () {},
      url: base + "modifier_categorie",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: formData,
      success: function (res) {
        refresh_cat();

        //appler le Toast pour afficher le message
        if (res.status == "success") {
          alertCustom(
            "success",
            "ft-check",
            "Modification effectuée avec succée"
          );
        } else {
          alertCustom("danger", "ft-x", "Modification non effectuée");
        }
      },
    });
  } else {
    $.ajax({
      beforeSend: function () {},
      url: base + "ajouter_categorie",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: new FormData(this),
      success: function (res) {
        refresh_cat();
        if (res.status == "failed") {
          alertCustom("warning", "ft-alert-triangle", "Donnée déjà existante");
        } else if (res.status == "success") {
          alertCustom("success", "ft-check", "Ajout avec success");
        } else {
          alertCustom("danger", "ft-x", "Ajout non effectué");
        }
      },
    });
  }
});

function close_overlay_liste_categorie() {
  $("#card_categorie").unblock();
}

// Fonction pour dialogue une catégorie  ************************************************
function supprimerCategorie(id) {
  $("#card_categorie").block({
    message:
      `
    <div class="card" style="max-width:400px ;">
    <div class="card-header" style="max-width:400px ;  height:80px ">
             <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
    </div>
    <div class="card-content">
        <div class="card-body">
            <p>Voulez-vous supprimer cette catégorie ?</p>

                <button type="button" onclick="delete_categorie_from_dialog(` +
      id +
      `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                <button type="button" onclick="close_overlay_liste_categorie()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>


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

function delete_categorie_from_dialog(id) {
  $.ajax({
    url: base + "supprimer_categorie",
    type: "POST",
    data: { id: id },
    success: function (response) {
      alertCustom("success", "ft-check", "Suppression effectué avec succée");
      refresh_cat();
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
  Annuler();
});

// Fonction pour vider les champs du formulaire **************************************************
function Annuler() {
  $("#designation").val("");
  $("#editCategoryId").val("");
  //   isEditing = false;
  $("#ajouterButton").text("Ajouter");
}
