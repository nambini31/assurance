$(document).ready(function () {
    $('select').selectpicker('refresh');
    listeTitulaire();
    charge_membre();

});

function charge_membre() {
    $.ajax({
        url: base + 'charge_membre',
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (data) {
            $("#membre_choix").empty();
            $("#membre_choix").append(data);
            $("#membreId").append(data);
            $('select').selectpicker('refresh');  
        }
    });
}

$("#membre_choix").on('change', function name(params) {
    liste_patient();
})

// *** affichage titulaire ----------------
function listeTitulaire() {
    $.ajax({
        beforeSend: function () {

            $("#card-titulaire").block({
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
        url: base + "listesTitulaire",
        type: "POST",
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            if ($.fn.DataTable.isDataTable("table-titulaire")) {
                $("#table-titulaire").DataTable().destroy();
            }
            $('#table-titulaire').empty();
            $("#table-titulaire").append(res);
            $('#table-titulaire').DataTable({
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
                        extend: "excelHtml5",
                        title: "Listes des Titulaire",
                        className: "btn btn-sm btn-success",
                        text: 'Excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }

                    },
                    {
                        className: "btn btn-sm btn-secondary btn-min-width ",
                        text: '<i class="ft-refresh"> Actualiser</i>',
                        action: function () {
                            listeTitulaire();
                        },
                    },
                    {
                        className: "btn btn-sm btn-warning btn-min-width ",
                        text: '<i class="ft-plus"> Ajouter</i>',
                        action: function () {
                            $('.entete_modal').text("Nouveau Titulaire");
                            $('#btn_add_titualire').text("Ajouter");
                            $("#createTitulaireModel").modal(
                                { backdrop: "static", keyboard: false },
                                "show"
                            );                           
                            $('#createTitulaireForm')[0].reset();
                            $("#id_titualire_men_modif").val("");
                        },
                    },
                ],
            });
            $("#card-titulaire").unblock();

        },
    });
}
//--------------------------------------------------------


// ------ ajout Titualaire ----------------------
$("#createTitulaireForm").off("submit").on("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);
    var photo = $("#photo")[0].files[0];
    var url = "ajout_titulaire";

    //verifier si c'st modifier
    if ($('#titulaireId').val() != "0") {
        url = "update_titulaire";
        if (!photo) {
            // Vérifiez le type de fichier et la taille
            // if (!photo.type.startsWith('image/') || photo.size > 10485760) {
            //     alert("Veuillez selectionner une image avec une talle < 10Mo");
            //     return;
            // }else{            
            //     formData.append("photo", photo);                
            // }
            // formData.append("labelImageTitulaireIn", nomPhoto);                       
            var nomPhoto = $('#labelImageTitulaire').html();
            formData.append("photo", nomPhoto);                          
        } 
    }
    if (photo) {
        // Vérifiez le type de fichier et la taille
        if (!photo.type.startsWith('image/') || photo.size > 10485760) {
            alert("Veuillez selectionner une image avec une talle < 10Mo");
            return;
        }else{            
            formData.append("photo", photo);                
        }
    }    
    
    $.ajax({
        beforeSend: function () {
            $("#modal_content_add_titulaire").block({
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
        url: base + url,
        type: "POST",
        processData: false,
        contentType: false,
        cache: false,
        dataType: "JSON",
        data: formData,
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            if (res.success) {
                if ($('#btn_add_titualire').text() === "Modifier") {
                    alertCustom("success", "ft-check", "Modification effectué avec succée");
                    listeTitulaire();
                    annulerAjoutTitulaire();
                    $("#createTitulaireModel").modal("hide");               
                }
                else {            
                    annulerAjoutTitulaire();
                    alertCustom("success", "ft-check", "Ajout effectué avec succée");
                    listeTitulaire();
                    $("#createTitulaireModel").modal("hide");
                }                
            }
            else{                
                alertCustom("danger", "ft-check", res.message);                
            }
            $("#modal_content_add_titulaire").unblock();
        }
    });
});
//--------------------------------------------------------------

function close_del_titulaire() {
    $("#card-titulaire").unblock();
}

// *************************dialogue suppression deleate
function deleteTitulaire(id) {
    $("#card-titulaire").block({
        message: `
            <div class="card" style="max-width:400px ; ">
                <div class="card-header" style="max-width:400px ;">
                    <i class="ft-trash-2" style='color:rgb(233, 46, 46);font-size:50px'></i>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p>Voulez-vous supprimer ?</p>  
                        <button type="button" onclick="delete_titulaire_from_dialog(`+ id + `)" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i> Oui</button>
                        <button type="button" onclick="close_del_titulaire()" class="mr-1 mb-1 btn btn-sm btn-outline-light btn-min-width"><i class="ft-x"></i> Annuler</button>
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
function delete_titulaire_from_dialog(id) {
    // $("#card-titulaire").unblock();
    $.ajax({
        beforeSend: function () {
            $("#card-titulaire").block({
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
        url: base + "delete_titulaire",
        type: "POST",
        dataType: "JSON",
        data: { titulaireId: id },
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
            $("#card-titulaire").unblock();
            if (res.id > 0) {
                alertCustom("success", 'ft-check', "Suppression effectué avec succée");
            } else {
                alertCustom("danger", 'ft-x', "Suppression non effectué");
            }
            listeTitulaire();
        },
    });
}

// ***** modification *******/
function editTitulaire(id) {

    $.ajax({
        url: base + "getTitulaireById", // L'URL du contrôleur qui renvoie les données du titulaire
        type: 'POST',
        dataType: 'JSON',
        data: { titulaireId: id }, // Passer l'id du titulaire à l'URL
        error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function(res) {
            var titulaire = res.data[0];
            
            // Remplir les champs du formulaire avec les données du titulaire
            $('#titulaireId').val(titulaire.titulaireId);
            $('#membreId').val(titulaire.membreId);
            $('select').selectpicker('refresh');
            $('#numCnaps').val(titulaire.numCnaps);
            $('#nom').val(titulaire.nom);
            $('#prenom').val(titulaire.prenom);
            $('#genre').val(titulaire.genre);
            $('#dateNaiss').val(titulaire.dateNaiss);
            $('#telephone').val(titulaire.telephone);
            $('#cin').val(titulaire.cin);
            $('#adresse').val(titulaire.adresse);
            $('#fonction').val(titulaire.fonction);
            $('#dateEmbauche').val(titulaire.dateEmbauche);
            $('#dateDebauche').val(titulaire.dateDebauche);
            // Pour la photo, il peut être nécessaire de gérer cela différemment
            $('#labelImageTitulaire').html(titulaire.photo);            
            $('#labelImageTitulaireIn').val(titulaire.photo);
            $('#email').val(titulaire.email);
            $('#nomPrenomConjoint').val(titulaire.nomPrenomConjoint);
            $('#dateNaissConjoint').val(titulaire.dateNaissConjoint);
            $('#telephoneConjoint').val(titulaire.telephoneConjoint);
            $('#genreConjoint').val(titulaire.genreConjoint);

            // Afficher le formulaire (par exemple, en ouvrant un modal)
            // $('#createTitulaireForm').modal('show');
            $('.entete_modal').text("Modification");
            $('#btn_add_titualire').text("Modifier");
            $("#createTitulaireModel").modal(
                { backdrop: "static", keyboard: false },
                "show"
            );
        },
        error: function(xhr, status, error) {
            // Gestion des erreurs
            console.log("Erreur lors de la récupération des données :", error);
        }
    });
}

//*******************ANNULATION BUTTTON */
function annulerAjoutTitulaire() {
    $('#createTitulaireForm')[0].reset();
    $("#titulaireId").val("");
    $("#labelImageTitulaire").html("");
    $("#membreId").val("");
    $('select').selectpicker('refresh');
}
//-------------------------------------------------


// ******************************filtre en tete *****************************************/////***/*/*/*/*/*/************************




// **************************evenement changemenet de filtre
$("#district_choix").on('change', function name(params) {
    chargeCommuneTous();
    chargeQuartierVider();
});


///******************filtre patientr ******* */

function filtrerpatient() {

    liste_patient()

}