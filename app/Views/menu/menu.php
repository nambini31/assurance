<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item" title="Visualiser visite"><a class="menu-item" data-id="consultation" href="<?php echo base_url("lienconsultation"); ?>"><i class="ft-users"></i><span data-i18n="DataTables">Visite
                   </span></a>
            </li>

            <li class=" nav-item" title="Visualiser patient"><a class="menu-item" data-id="patient" href="<?php echo base_url("lienpatient"); ?>"><i class="ft-users"></i><span data-i18n="DataTables">Patient
                   </span></a>
            </li>
            
            <li class=" nav-item" title="Visualiser medecin"><a class="menu-item" data-id="medecin" href="<?php echo base_url("lienmedecin"); ?>"><i class="ft-users"></i><span data-i18n="DataTables">Medecin
                   </span></a>
            </li>
            <li class=" nav-item" title="Visualiser medecin"><a class="menu-item" data-id="membre" href="<?php echo base_url("lienmembre"); ?>"><i class="ft-users"></i><span data-i18n="DataTables">Membres
                   </span></a>
            </li>
           
            <?php
            if (isset($_SESSION["role_user"]) && $_SESSION["role_user"] == "admin") {
            ?>
                <li class=" nav-item"><a class="menu-item" data-id="utilisateur" href="<?php echo base_url("lienutilisateur"); ?>"><i class="la la-user"></i><span data-i18n="DataTables">Utilisateur

                        </span></a>

                </li>
            <?php } ?>


           
            <!-- <li class=" nav-item" title="Visualiser Historique"><a class="menu-item" data-id="historique" href="<?php echo base_url("lienhistorique"); ?>"><i class="la la-history"></i><span data-i18n="DataTables">Historiques

                    </span></a>


            </li>
            <li class=" nav-item" title="Visualiser Session Utilisateur"><a class="menu-item" data-id="session" href="<?php echo base_url("liensession"); ?>"><i class="la la-eye"></i><span data-i18n="DataTables">Session

                    </span></a>


            </li>
            <li class=" nav-item" title="Visualiser Client"><a class="menu-item" data-id="client" href="<?php echo base_url("lienclient"); ?>"><i class="ft-users"></i><span data-i18n="DataTables">Client
                   </span></a>
            </li> -->
        </ul>
    </div>
</div>