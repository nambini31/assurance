<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<?= view("header/head.php"); ?>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body style="background-image: url('<?php echo base_url() ?>/assets/logo/background.jpg')" class="vertical-layout vertical-menu 1-column  bg-full-screen-image blank-page"  data-open="click" data-menu="vertical-menu" data-col="1-column">



    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body" >
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center" style="z-index: 99999999999 !important;">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <i class="la la-lock danger" alt="branding logo" style="font-size: 200px;"></i>
                                    </div>
                                </div>
                                <div class="card-content">
                                    
                                <h6 class="card-subtitle line-on-side text-center"><span style="font-weight: bold;">Accès non autorisé</span></h6>
                                    
                                    <div class="card-body">
                                        <form class="form-horizontal" id="login_form" action="authentifier" method="post">
                                           
                                            
                                            <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"></p>
                                            
                                            <button type="submit" id="" style="color: white;" class=" form-control mr-1 mb-1 btn btn-sm btn-danger btn-min-width">RETOUR A LA PAGE D'ACCEUIL</button>
                                        
                                        </form>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
   
       
   <script src="<?php echo base_url() ?>/assets/js/vendors.min.js"></script>
   <script>

    let base = "<?php echo base_url(); ?>";
    var sessionData = <?= json_encode($_SESSION) ?>;

    var aujourdHui = new Date();

    // Soustrayez 30 jours à la date d'aujourd'hui
    aujourdHui.setDate(aujourdHui.getDate() - 30);

    // Obtenez la date de début (il y a 30 jours)
    var dateDebut = aujourdHui;
    // Obtenez la date de fin (aujourd'hui)
    var dateFin = new Date();
    
    // Convertissez les dates en format ISO (YYYY-MM-DD)
    var dateDebutISO = dateDebut.toISOString().split('T')[0];
    var dateFinISO = dateFin.toISOString().split('T')[0];
    
</script>
    
    <?= view("header/script.php"); ?>
</body>
<!-- END: Body-->

</html>