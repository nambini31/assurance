

$(document).ready(function () {
  $(".selectpicker").selectpicker("refresh");
    $('#password_confirmation').on('input', function () {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        if (password === confirmPassword) {
            $('.help-block').text('');
        } else {
            $('.help-block').text('Rétapez le mot de passe correct.');
        }
    });
    $("#label_image").html('');
    refresh_user();
    
});



function refresh_user() {
  $("#label_image").html('');

  $("#nom").val("");
  $("#prenom").val("");
  $("#role").val("");
  $("#password").val("");
  $("#password_confirmation").val("");
  $("#image").val("");
  $("#editUserId").val("");
  $("#Simple").prop("checked", true);
  $("#ajouterButton").text("Ajouter");

  $.ajax({
    beforeSend: function () {
      $("#card_utilisateur").block({
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
    url: base + "/afficher_utilisateur",
    type: "POST",
    success: function (response) {
      
     $("#card_utilisateur").unblock();
     $("#table_user").empty();
      $("#table_user").append(response);
     
      // Convertissez la chaîne JSON en objet JavaScript
        $("#table_user").DataTable({
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
          zeroRecords: "Aucun utilisateur",
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
              refresh_user();
            },
          },
        ],
      
      });
    },

  });
}


// Fonction pour rafraichir le Form et le dataTable


// Fonction pour obtenir les données selectionnés et remplir le Form  **************************
function editUsers(id) {
  //   isEditing = true;
  $.ajax({
    url: base + "get_utilisateur",
    type: "POST",
    data: { id: id },
    success: function (response) {
      // Convertissez la chaîne JSON en objet JavaScript
      var user = JSON.parse(response);
      console.log(user);
      // Remplissez le formulaire d'édition avec les détails récupérés et changer le texte boutton
      $("#nom").val(user.nom_user);
        $("#editUserId").val(user.id_user);
        $("#nom").val(user.nom_user);
        $("#prenom").val(user.prenom_user);
        $("#label_image").html(user.image);
        if (user.role_user === "admin") {
          $("#Admin").prop("checked", true);
        } else {
          $("#Simple").prop("checked", true);
        }
        $("#password").val(user.mdp_user);
        $("#password_confirmation").val(user.mdp_user);
        

        
        // 
        // if (user.image) {
        //   // $("#image").val(user.image);
        //   $("#image").html('<img src="' + user.image + '" alt="User Image" style="max-width: 100px;" id="image">');
        // }
  
    
        $("#ajouterButton").text("Modifier");

        // if (user.image) {
        //   // Assuming #image is the id of the file input field
        //   $("#image").val(user.image);
        // }
        
    },
    error: function (error) {
      console.error(
        "Erreur lors de la récupération des détails d'utlisateur':",
        error
      );
    },
  });
}

function getSelectedRole() {
  if ($("#Admin").prop("checked")) {
      return "admin";
  } else if ($("#Simple").prop("checked")) {
      return "simple";
  }
  // Add additional conditions if there are more roles
}

// Fonction ajout et Modification  ************************************
$("#ajout_utilisateur").off("submit").on("submit",function (e) {
  e.preventDefault();
  var formData = new FormData();
  var editUserId = $("#editUserId").val();
  var nom = $("#nom").val();
    var prenom = $("#prenom").val();
    var role = $("#role").val();
    var password = $("#password").val();
    var password_confirmation = $("#password_confirmation").val();
    var label_image = $("#label_image").text();
    // var image_view = $("image_view").val();

    
    var image = $("#image")[0].files.length > 0 ? $("#image")[0].files[0] : null;

    var fileInput = $("#image")[0];
    console.log("File Input:", fileInput);

    var files = fileInput.files;
    console.log("Files:", files);

  console.log(image);
  // console.log(image_view);

    var role = getSelectedRole();

  // Append values to the FormData object

  if (password === password_confirmation) {
    var passkey = password;
  formData.append("id", editUserId);
    formData.append("nom", nom);
    formData.append("prenom", prenom);
    formData.append("password", passkey);
    formData.append("role", role);
    formData.append("label_image", label_image);
    if (image) {
      formData.append("image", image);
    } 
  }


  console.log(editUserId);

  if (editUserId) {
    $.ajax({
      beforeSend: function () {},
      url: base + "modifier_utilisateur",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: formData,
      success: function (res) {
        refresh_user();

        //appler le Toast pour afficher le message
        // if (res.status == "success") {
        //   alertCustom("danger", "ft-x", "Modification non effectuée");
        // }
        if (res.status == "success") {
          alertCustom(
            "success",
            "ft-check",
            "Modification effectuée avec succès"
          );
          if(res.deconnecter){
            deconnecter();
          }
        }else{
          alertCustom("danger", "ft-x", "Modification non effectuée");
        }
        
        // liste_caracteristique();
      },
    });
  } else {
    $.ajax({
      beforeSend: function () {},
      url: base + "ajout_utilisateur",
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
          refresh_user();
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
  $("#card_utilisateur").unblock();
}

// Fonction pour dialogue une catégorie  ************************************************
function supprimerUser(id) {
  $("#card_utilisateur").block({
    message:
      `
    
    
    <div class="card" style="max-width:400px ;">
    <div class="card-header" style="max-width:400px ;  height:80px ">
             <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
    </div>
    <div class="card-content">
        <div class="card-body">
            <p>Voulez-vous supprimer cette utilisateur ?</p>

                <button type="button" onclick="delete_dialog_user(` +
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

function delete_dialog_user(id) {
  $.ajax({
    url: base + "supprimer_utilisateur",
    type: "POST",
    data: { id: id },
    success: function (response) {
      alertCustom("success", "ft-check", "Suppression effectué avec succès");
      refresh_user();
      // liste_caracteristique();
    },
    error: function (error) {
      alertCustom(
        "danger",
        "ft-x",
        "Erreur lors de la suppression d'utilisateur"
      );
    },
  });
}

//Gerer le boutton Annuler
$("#annuler_user").on("click", function () {
  Annuler_users();
});

// Fonction pour vider les champs du formulaire **************************************************
function Annuler_users() {
  $("#label_image").html('');

  $("#editUserId").val("");
    $("#nom").val("");
    $("#prenom").val("");
    $("#role").val("");
    $("#password").val("");
    $("#password_confirmation").val("");
    $("#ajouterButton").text("Ajouter");
}
