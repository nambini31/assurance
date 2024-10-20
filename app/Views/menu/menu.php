<div class="main-menu menu-fixed menu-dark menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            

            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "1" , "2" , "3" , "4" , "8" , "9" , "10"])){
             
            ?>
             <li class=" nav-item" title="Visualiser consultation"><a class="menu-item" data-id="consultation" href="<?php echo base_url("lienconsultation"); ?>"><i class="las la-stethoscope la-2x"></i><span data-i18n="DataTables">Visites
                   </span></a>
            </li>
              <?php 
                     }
              ?>


            
            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "6"])){
             
            ?>
             <li class=" nav-item"><a href="#"><i class="la la-microscope"></i><span class="menu-title" data-i18n="DataTables">Demande d'analyse</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" data-id="consultation" href="<?php echo base_url("lienconsultation"); ?>"><span data-i18n="DataTables">Visites
                   </span></a></li>
                    <li><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><span data-i18n="DataTables">CPN
                   </span></a>
                    </li>
                </ul>
            </li>
              <?php 
                     }
              ?>
           
            

           

            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "1"])){
             
            ?>
            <li class=" nav-item" title="Visualiser Titulaire"><a class="menu-item" data-id="titulaire" href="<?php echo base_url("lientitulaire"); ?>"><i class="las la-user-tie la-2x"></i><span data-i18n="DataTables">Titulaire
                   </span></a>
            </li>
              <?php 
                     }
              ?>
            

            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "3" , "4" , "9" , "10"])){
             
            ?>
            <li class=" nav-item" title="Visualiser CPN"><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><i class="la la-female"></i><span data-i18n="DataTables">CPN
                   </span></a>
            </li>
                
              <?php 
                     }
              ?>
              
            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "3" , "4"])){
             
            ?>
            
                 <li class=" nav-item" title="Visualiser PF"><a class="menu-item" data-id="pf" href="<?php echo base_url("lienpf"); ?>"><i class="las la-calendar la-2x"></i><span data-i18n="DataTables">PF
                   </span></a>
            </li>
              <?php 
                     }
              ?>
            

            
            
            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5"])){
             
            ?>
                 <li class=" nav-item" title="Visualiser type de gestion"><a class="menu-item" data-id="gestion" href="<?php echo base_url("liengestion"); ?>"><i class="las la-tachometer-alt la-2x"></i><span data-i18n="DataTables">Gestion
                   </span></a>
            </li>
              <?php 
                     }
              ?>


           
            
            <?php 
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "1"])){
             
            ?>
                <li class=" nav-item" title="Visualiser medecin"><a class="menu-item" data-id="membre" href="<?php echo base_url("lienmembre"); ?>"><i class="las la-users la-2x"></i><span data-i18n="DataTables">Membres
                   </span></a>
            </li>
              <?php 
                     }
              ?>

           

            <?php 
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5" , "8" , "7"])){
             
            ?>
               <li class=" nav-item" title="Rapport d'examen"><a class="menu-item" data-id="examen" href="<?php echo base_url("lienexamen"); ?>"><i class="las la-notes-medical"></i><span data-i18n="DataTables">Examen Medical
                   </span></a>
            </li>
              <?php 
                     }
              ?>


            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5"])){
             
            ?>
             <li class=" nav-item"><a href="#"><i class="la la-microscope"></i><span class="menu-title" data-i18n="DataTables">Pharmacie Gros</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" data-id="fournisseur" href="<?php echo base_url("lienfournisseur"); ?>"><span data-i18n="DataTables">Fournisseur
                   </span></a></li>
                    <li><a class="menu-item" data-id="article" href="<?php echo base_url("lienarticle"); ?>"><span data-i18n="DataTables">Article
                   </span></a>
                    </li>
                    <li><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><span data-i18n="DataTables">Entrer
                   </span></a>
                    </li>
                    <li><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><span data-i18n="DataTables">Sortie
                   </span></a>
                    </li>
                </ul>
            </li>
              <?php 
                     }
              ?>
            <?php
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5"])){
             
            ?>
             <li class=" nav-item"><a href="#"><i class="la la-microscope"></i><span class="menu-title" data-i18n="DataTables">Pharmacie Detail</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><span data-i18n="DataTables">Article
                   </span></a>
                    </li>
                    <li><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><span data-i18n="DataTables">Entrer
                   </span></a>
                    </li>
                    <li><a class="menu-item" data-id="cpn" href="<?php echo base_url("liencpn"); ?>"><span data-i18n="DataTables">Sortie
                   </span></a>
                    </li>
                </ul>
            </li>
              <?php 
                     }
              ?>
             
           
           
            <?php 
            //verifier si c'est superAdmin
            if (in_array($_SESSION['roleId'], ["5"])){
             
            ?>



              <li class=" nav-item"><a class="menu-item" data-id="utilisateur" href="<?php echo base_url("lienutilisateur"); ?>"><i class="las la-user-circle la-2x"></i><span data-i18n="DataTables">Utilisateur
                     </span></a>
              </li>
              <?php 
                     }
              ?>


           
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