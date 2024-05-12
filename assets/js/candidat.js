$(document).ready(function () {
  $('select').selectpicker('refresh');
  chargeDistrictTous();
  chargeDistrictTouts();
});


//***************************chargement tous district  choisit dans une region
function chargeDistrictTous() {
  $.ajax({
      url: base + 'charge_district_tout',
      type: "POST",
      success: function (data) {
          $("#code_district").empty();
          $("#code_district").append(data);
          $('select').selectpicker('refresh');

      }
  });
}

function chargeDistrictTouts() {
  $.ajax({
      url: base + 'charge_district_touts',
      type: "POST",
      success: function (data) {
          $("#id_categorie").empty();
          $("#id_categorie").append(data);
          $('select').selectpicker('refresh');

      }
  });
}

// **************************evenement changemenet


// $("#id_categorie").on('change', function name(params) {
//   chargeDistrictTous();
// });

$("#id_categorie").on('change', function() {
  refresh_candidat();
});


$(document).ready(function () {
  $(".selectpicker").selectpicker("refresh");
    $("#label_image").html('');
    refresh_candidat();
    
});



function refresh_candidat() {
  $("#label_image").html('');
  $("#nom").val("");
  $("#numero_candidat").val("");
  $("#prenom").val("");
  $("#image").val("");
  $("#editCandidatId").val("");
  $("#code_district").selectpicker('refresh'); 
  $("#ajouterButton").text("Ajouter");

  $.ajax({
    beforeSend: function () {
      $("#card_candidat").block({
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
    url: base + "/afficher_candidat",
    type: "POST",
    data : {
      code_district: $("#id_categorie").val(),
    },
    success: function (response) {

      
     $("#card_candidat").unblock();
     $("#table_candidat").empty();
      $("#table_candidat").append(response);

      

     
      // Convertissez la chaîne JSON en objet JavaScript
        $("#table_candidat").DataTable({
        destroy: true,
        ordering: true,
        order: [[0, "asc"]],
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
          zeroRecords: "Aucun candidat",
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
              refresh_candidat();
            },
          },
        ],
      
      });
    },

  });
}


// Fonction pour rafraichir le Form et le dataTable


// Fonction pour obtenir les données selectionnés et remplir le Form  **************************
function editCandidats(id) {
  //   isEditing = true;
  $.ajax({
    url: base + "get_candidat",
    type: "POST",
    data: { id: id },
    success: function (response) {
      // Convertissez la chaîne JSON en objet JavaScript
      var candidat = JSON.parse(response);
      console.log(candidat);
      // Remplissez le formulaire d'édition avec les détails récupérés et changer le texte boutton
      
        $("#editCandidatId").val(candidat.id_candidat);
        // $("#code_district").val(candidat.code_district);
        $("#numero_candidat").val(candidat.numero);
        $("#nom").val(candidat.nom);
        $("#prenom").val(candidat.prenom);
        $("#label_image").html(candidat.photo);
        
        $("#code_district").selectpicker('val', candidat.code_district); // Update selectpicker value
        
  
    
        $("#ajouterButton").text("Modifier");

        
        
    },
    error: function (error) {
      console.error(
        "Erreur lors de la récupération des détails d'un candidat':",
        error
      );
    },
  });
}


// Fonction ajout et Modification  ************************************
$("#ajout_candidat").off("submit").on("submit",function (e) {
  e.preventDefault();
  var formData = new FormData();
  var editCandidatId = $("#editCandidatId").val();
  var numero = $("#numero_candidat").val();
  var code_district = $("#code_district").val();
  var nom = $("#nom").val();
    var prenom = $("#prenom").val();
    var label_image = $("#label_image").text();

    
    var image = $("#image")[0].files.length > 0 ? $("#image")[0].files[0] : null;

    var fileInput = $("#image")[0];
    console.log("File Input:", fileInput);

    var files = fileInput.files;
    console.log("Files:", files);

  console.log(image);
  // console.log(image_view);

  // Append values to the FormData object

  
  formData.append("id", editCandidatId);
  formData.append("numero_candidat", numero);
  formData.append("code_district", code_district);
    formData.append("nom", nom);
    formData.append("prenom", prenom);
    formData.append("label_image", label_image);
    if (image) {
      formData.append("image", image);
    } 


  console.log(editCandidatId);

  if (editCandidatId) {
    $.ajax({
      beforeSend: function () {},
      url: base + "modifier_candidat",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: formData,
      success: function (res) {
        refresh_candidat();

        
        if (res.status == "success") {
          alertCustom(
            "success",
            "ft-check",
            "Modification effectuée avec succès"
          );
          // if(res.deconnecter){
          //   deconnecter();
          // }
        }else{
          alertCustom("danger", "ft-x", "Modification non effectuée");
        }
        
        // liste_caracteristique();
      },
    });
  } else {
    $.ajax({
      beforeSend: function () {},
      url: base + "ajout_candidat",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: new FormData(this),
      success: function (res) {
        

        if (res.status == "failed") {
          alertCustom("warning", "ft-alert-triangle", "Donnée déjà existante");
        } else if (res.status == "success") {
          alertCustom("success", "ft-check", "Ajout avec succès");
          refresh_candidat();
        }else if (res.status == "fail") {
            alertCustom("warning", "ft-check", "Mot de passe doit contenir au moins 8 caractères");
        }
        else if (res.status == "fail_p") {
          alertCustom("warning", "ft-check", "Le mot de passe est différent de celui de la confirmation.");
      }
        
        else {
          alertCustom("danger", "ft-x", "Ajout non effectué");
        }
        // liste_caracteristique();
      },
    });
  }
});

function close_overlay_liste_user() {
  $("#card_candidat").unblock();
}

// Fonction pour dialogue une catégorie  ************************************************
function supprimerCandidat(id) {
  $("#card_candidat").block({
    message:
      `
    
    
    <div class="card" style="max-width:400px ;">
    <div class="card-header" style="max-width:400px ;  height:80px ">
             <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
    </div>
    <div class="card-content">
        <div class="card-body">
            <p>Voulez-vous supprimer ce candidat ?</p>

                <button type="button" onclick="delete_dialog_candidat(` +
      id +
      `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                <button type="button" onclick="close_overlay_liste_user()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>


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

function delete_dialog_candidat(id) {
  $.ajax({
    url: base + "supprimer_candidat",
    type: "POST",
    data: { id: id },
    success: function (response) {
      alertCustom("success", "ft-check", "Suppression effectué avec succès");
      refresh_candidat();
    },
    error: function (error) {
      alertCustom(
        "danger",
        "ft-x",
        "Erreur lors de la suppression d'un candidat"
      );
    },
  });
}

//Gerer le boutton Annuler
$("#annuler_user").on("click", function () {
  Annuler_candidat();
});

// Fonction pour vider les champs du formulaire **************************************************
function Annuler_candidat() {
  $("#label_image").html('');

  $("#editCandidatId").val("");
    $("#nom").val("");
    $("#prenom").val("");
    $("#numero_candidat").val("");
    $("#code_district").selectpicker('val', "");
    $("#code_district").selectpicker('refresh'); 
     $("#ajouterButton").text("Ajouter");
}
