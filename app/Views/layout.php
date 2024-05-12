<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<?= view("header/head.php"); ?>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">


   <?= view('header/header') ?>
   <?= view('menu/menu') ?>
   <script src="<?php echo base_url() ?>/assets/js/vendors.min.js"></script>
   <script src="<?php echo base_url() ?>/assets/js/cleave.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   

   <script>
    

    let base = "<?php echo base_url(); ?>";
    
</script>
    <div id="content">
       <?= $content ?>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target">
      
    </div>
    <?= $this->include("footer/footer.php"); ?>
    <?= view("header/script") ?>

</body>

</html>