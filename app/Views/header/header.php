<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark" style="background-color: #1978ff !important;
    background-repeat: repeat-x;">
    <div class=" navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item"><a class="navbar-brand" href="/dashboard">

                        <h3 class="brand-text" style="margin-top: 10px; color : white">LOGO</h3>
                        <!-- <h3 class="brand-text" style="margin-top: 10px;"><img class="brand-logo" style="width: 125px;" alt="modern admin logo" src="<?php echo base_url() ?>/assets/logo/logo.png"></h3> -->
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"> <i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse " id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a style=" color : white" class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a style=" color : white" class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav mr-auto float-center">
                    <li class="nav-item d-none d-md-block">
                        <h5 style=" color : white"><span id="horloge"></span></h5>
                    </li>
                </ul>

                <ul class="nav navbar-nav float-right">
                    <div id="liste_notification">
                        
                    </div>

                    <li class="dropdown dropdown-user nav-item"><a style=" color : white" class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700"><?= ucfirst($_SESSION['nom_user']) . " " . ucfirst($_SESSION['prenom_user']) ?></span><span><img style="width: 38px; height: 38px; clip-path:circle();" src="<?php echo base_url() ?>/assets/img/user/<?= ($_SESSION['image_user'] == "") ? 'default.png' : $_SESSION['image_user'] ?>" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <?php
                            if (isset($_SESSION["role_user"]) && $_SESSION["role_user"] == "admin") {
                            ?>
                            <a class="dropdown-item" href="#" onclick="exportDatabase()"><i class="ft-download"></i>Exporter la base de données</a>
                            <?php } ?>
                            
                            <a class="dropdown-item" href="" onclick="deconnecter()"><i class="ft-power"></i>Deconnecter</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div id="alert_place">
</div>


<script>
    window.onload = function() {
        horloge('horloge');
    };

    //affichage d'heure
    function horloge(el) {
        if (typeof el == "string") {
            el = document.getElementById(el);
        }

        function actualiser() {
            var date = new Date();
            var months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
            var str = (date.getDate() < 10 ? '0' : '') + date.getDate();
            str += ' ' + ((date.getMonth() + 1) < 10 ? '' : '') + months[date.getMonth()];
            str += ' ' + date.getFullYear();
            str += ' - ' + (date.getHours() < 10 ? '0' : '') + date.getHours();
            str += ':' + (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
            str += ':' + (date.getSeconds() < 10 ? '0' : '') + date.getSeconds();

            el.innerHTML = str;
        }
        actualiser();
        setInterval(actualiser, 1000);
    }
</script>