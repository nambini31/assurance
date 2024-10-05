
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div class="content-overlay"></div>

            <section class="row all-contacts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-underline">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="baseIcon-tab21" data-toggle="tab" aria-controls="tabIcon21" href="#tabIcon21" aria-expanded="true"><i class="la la-tag"></i> Types d'analyse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab22" data-toggle="tab" aria-controls="tabIcon22" href="#tabIcon22" aria-expanded="false"><i class="ft-layers"></i> Analyse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab23" data-toggle="tab" aria-controls="tabIcon23" href="#tabIcon23" aria-expanded="false"><i class="la la-tag"></i>Methodes contraceptives</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="baseIcon-tab24" data-toggle="tab" aria-controls="tabIcon24" href="#tabIcon24" aria-expanded="false"><i class="la la-tag"></i>Administration Medicament</a>
                                    </li>
                                
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabIcon21" aria-expanded="true" aria-labelledby="baseIcon-tab21">
                                <?= view("gestion/type_analyse.php") ?>
                            </div>
                            <div role="tab-panel" class="tab-pane"  id="tabIcon22" aria-expanded="true" aria-labelledby="baseIcon-tab22">
                                <?= view("gestion/analyse.php") ?>
                            </div>
                            <div class="tab-pane"  id="tabIcon23" aria-expanded="true" aria-labelledby="baseIcon-tab23">
                                <?= view("gestion/methodePf.php") ?>
                            </div>
                            <div class="tab-pane"  id="tabIcon24" aria-expanded="true" aria-labelledby="baseIcon-tab23">
                                <?= view("gestion/adminMedicament.php") ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>

</div>


<script src="<?php echo base_url() ?>/assets/js/gestion/analyse.js"></script>
<script src="<?php echo base_url() ?>/assets/js/gestion/type_analyse.js"></script>
<script src="<?php echo base_url() ?>/assets/js/gestion/methodePf.js"></script>
<script src="<?php echo base_url() ?>/assets/js/gestion/adminMedicament.js"></script>
