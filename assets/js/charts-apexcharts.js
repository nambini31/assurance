/*=========================================================================================
    File Name: charts-apexcharts.js
    Description: Apex charts examples.
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
// compt_commande();

var dateDebut = $("#recherche_date_debut").val(dateDebutISO);
var dateFin = $("#recherche_date_fin").val(dateFinISO);

affichage_dashboard();

var $primary = "#666ee8",
  $secondary = "#FFB06E",
  $success = "#1C9066",
  $info = "#1E9FF2",
  $warning = "#FFB73E",
  $danger = "#FF4961";

var $themeColor = [$primary, $success];

var areaSplineChart;
var area_spline_chart;

function affichage_dashboard() {
  var dateDebut = $("#recherche_date_debut").val();
  var dateFin = $("#recherche_date_fin").val();

  $("#id_dash_reload").block({
    message:
      '<div class="ft-refresh-cw icon-spin font-medium-2" style="margin:auto"></div>',
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

  var requestData = {
    date_debut: dateDebut,
    date_fin: dateFin,
  };

  chalenge(requestData);
  chart_challenge_user(requestData);

  $.ajax({
    url: base + "afficher_dashboard",
    type: "POST",
    dataType: "JSON",
    data: requestData,
    error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) { alert(res);
      // document.querySelector("#area-spline-chart").html("");
      // pour les cards
      // alert((res.solde) ? (res.solde + " Ar") : (0 + " Ar"));
      $("#revenu_total").text(
        String(res.solde ? res.solde + " Ar" : 0 + " Ar")
      );

      $("#Nb_devis_total").text(
        String(res.Nb_devis_total ? res.Nb_devis_total : 0)
      );

      $("#Nb_alu").text(String(res.Nb_devis_alu ? res.Nb_devis_alu : 0));

      $("#Nb_melam").text(
        String(res.Nb_devis_melam ? res.Nb_devis_melam : 0)
      );

      $("#Nb_devis_comander").text(
        String(res.Nb_devis_comander ? res.Nb_devis_comander : 0)
      );
      $("#Pourcentage_devis_confirme").text(
        String(
          res.Pourcentage_devis_confirme
            ? res.Pourcentage_devis_confirme + "%"
            : 0 + "%"
        )
      );

      $("#Nb_fact_reste").text(
        String(res.Nb_fact_reste ? res.Nb_fact_reste : 0)
      );
      $("#Montant_reste_paye").text(
        String(
          res.Montant_reste_paye ? res.Montant_reste_paye + " Ar" : 0 + " Ar"
        )
      );

      $("#Nb_fact_total_paye").text(
        String(res.Nb_fact_total_paye ? res.Nb_fact_total_paye : 0)
      );

      //********************************************* Chart Admin */
      var o = $("#line-stacked-area");
      new Chart(o, {
        type: "line",
        options: {
          responsive: !0,
          maintainAspectRatio: !1,
          legend: { position: "bottom" },
          hover: { mode: "label" },
          scales: {
            xAxes: [
              {
                display: !0,
                gridLines: { color: "#f3f3f3", drawTicks: !1 },
                scaleLabel: { display: !0, labelString: "Mois" },
              },
            ],
            yAxes: [
              {
                display: !0,
                gridLines: { color: "#f3f3f3", drawTicks: !1 },
                scaleLabel: { display: !0, labelString: "Montant" },
              },
            ],
          },
          title: { display: !0, text: "Chart.js Line Chart - Legend" },
        },
        data: {
          labels: res.mois, // Mois
          datasets: [
            {
              label: "Aluminium",
              data: res.revenu_aluminium, // Donnée revenu mentiel de l'aluminium
              backgroundColor: "rgba(22,211,154,.5)",
              borderColor: "transparent",
              pointBorderColor: "#28D094",
              pointBackgroundColor: "#FFF",
              pointBorderWidth: 2,
              pointHoverBorderWidth: 2,
              pointRadius: 4,
            },
            {
              label: "Mélamine",
              data: res.revenu_melamine,
              backgroundColor: "rgba(81,117,224,.5)",
              borderColor: "transparent",
              pointBorderColor: "#5175E0",
              pointBackgroundColor: "#FFF",
              pointBorderWidth: 2,
              pointHoverBorderWidth: 2,
              pointRadius: 4,
            },
          ],
        },
      });

      // stackedAreaChart.render();

      $("#id_dash_reload").unblock();
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function chalenge(filtre) {
  // alert(filtre);

  $.ajax({
    url: base + "afficher_chalenge",
    type: "POST",
    data: filtre,
    error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
      $("#challenge_user").empty();
      $("#challenge_user").append(res);
    },
    error: function (error) {
      // console.error("Erreur lors de la récupération nombre de commande", error);
    },
  });
}

function chart_challenge_user(filtre_user) {
  $.ajax({
    url: base + "afficher_chart_challenge_user",
    type: "POST",
    dataType: "JSON",
    data: filtre_user,
    error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
      // Vérifier si res est un objet et a une seule clé
      if (typeof res === "object" && Object.keys(res).length === 1) {
        // Récupérer la seule clé de l'objet
        var uniqueKey = Object.keys(res)[0];

        // Récupérer les données de l'utilisateur connecté
        var currentUserData = res[uniqueKey];

        // Fonction pour convertir le numéro du mois en abréviation
        function convertirMoisEnAbréviation(numMois) {
          const moisNoms = [
            "jan",
            "fév",
            "mar",
            "avr",
            "mai",
            "juin",
            "juil",
            "août",
            "sep",
            "oct",
            "nov",
            "déc",
          ];
          return moisNoms[parseInt(numMois) - 1];
        }

        // Reformater les données pour correspondre à la structure attendue par ApexCharts
        var Nom_user = [currentUserData.prenom_user];
        var seriesData = [Number(currentUserData.nb_devis)];
        var categories = [convertirMoisEnAbréviation(currentUserData.mois)];

        // Générer la configuration du graphique uniquement pour l'utilisateur connecté
        var areaSplineChart = {
          chart: {
            height: 260,
            type: "area",
          },
          dataLabels: {
            enabled: false,
          },
          stroke: {
            curve: "smooth",
            colors: $themeColor,
          },
          series: [
            {
              name: Nom_user,
              data: seriesData,
            },
          ],
          xaxis: {
            categories: categories,
          },
          yaxis: {
            title: {
              text: "Nombre de devis",
            },
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return +val + " Devis";
              },
            },
          },
        };

        var area_spline_chart = new ApexCharts(
          document.querySelector("#area-spline-chart_user"),
          areaSplineChart
        );
        area_spline_chart.render();
      }
    },

    error: function (error) {
      // console.error("Erreur lors de la récupération nombre de commande", error);
    },
  });
}

function afficher_liste_reste_paye_modal() {
  // alert("modal reste");
  var dateDebut = $("#recherche_date_debut").val();
  var dateFin = $("#recherche_date_fin").val();

  var requestData = {
    date_debut: dateDebut,
    date_fin: dateFin,
  };

  $.ajax({
    url: base + "afficher_liste_reste_paye",
    type: "POST",
    data: requestData,
    error: function(xhr, status, error) {
       alertCustom("danger", 'ft-x', "Une erreur s'est produite");
    } ,success: function (res) {
      $("#table_liste_reste_modal ").empty();
      $("#table_liste_reste_modal").append(res);
      $("#Modal_devis_reste_paye").modal(
        { backdrop: "static", keyboard: false },
        "show"
      );

      // Convertissez la chaîne JSON en objet JavaScript
      $("#table_liste_reste_modal").DataTable({
        destroy: true,
        ordering: true,
        order: [[0, "desc"]],
        info: false,
        paging: true,
        searching: false,
        preDrawCallback: function (settings) {},
        pageLength: 5,
        "initComplete": function(settings, json) {
          $('div.dataTables_wrapper div.dataTables_filter input').attr('placeholder', 'Recherche').css("font-size", "7px");
        },
        language: {
          "search": "",
          zeroRecords: "Aucun article",
          paginate: {
            previous: "Précédent",
            next: "Suivant",
          },
        },
        dom: "Bfrtip",
        buttons: [],
      });
    },
  });
}
