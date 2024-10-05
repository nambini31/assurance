<div class="content-wrapper" style="padding: 0 !important;">
    <div class="content-detached content-center">
        <div class="content-body">
            <section class="row all-contacts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard" id="card_type_analyse">

                            <form method="POST" id="add_parametre" >
                            <input type="hidden" name="idDetailsCons" class="idDetailsCons">

                                 
                            <div id="table_parametre_vrai">

                            </div>
                                 

                                <?php 
                                        //verifier si c'est superAdmin
                                        if (!in_array($_SESSION['roleId'], ["6" , "3"])) {              
                                        ?>
                                        <div class="form-actions right" id="hideValidParam" >

                                                        
                                            <button type="submit" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-check"></i>Enregistrer</button>


                                            </div>
                                        <?php 
                                                }
                                        ?>
                               
                                    
                              
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>