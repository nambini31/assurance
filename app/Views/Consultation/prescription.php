<div class="content-wrapper" style="padding: 0 !important;">

   
    <div class="content-detached content-center">
        <div class="content-body">
            <section class="row all-contacts">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard" id="card_prescription">

                            <table id="table_prescription" class="table table-white-space table-bordered table-sm no-wrap  text-center" style="width: 100% !important; overflow: auto;">
                                
                                </table>

                            </div>

                            
                            <?php 
                                        //verifier si c'est superAdmin
                                        if (in_array($_SESSION['roleId'], ["9" , "5"])) {              
                                        ?>

                                        <form action="" method="post">

                                            <div class="form-actions right" id="hideImprimeMedic" >
    
                                                
                                                <button type="button" class="mr-1 mb-1 btn btn-sm btn-warning btn-min-width"><i class="ft-print"></i>IMPRIMER</button>
    
    
                                                </div>

                                        </form>
                                        <?php 
                                                }
                                        ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>