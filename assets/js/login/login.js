
$(document).ready(function () {
  $("#login_form").off("submit").on("submit",function (e) {
    e.preventDefault();

    var currentPath = window.location.pathname;

    $.ajax({
      beforeSend: function () { },
      url: base + "authentifier",
      type: "POST",
      processData: false,
      contentType: false,
      cache: false,
      dataType: "JSON",
      data: new FormData(this),
      success: function (res) {

        if (res.id == 1) {
          window.location.href = currentPath;
          // or location.reload();
        } else {
          alert("Prénom ou Mot de Passe incorrect !");
        }

      },
    });
  });
});