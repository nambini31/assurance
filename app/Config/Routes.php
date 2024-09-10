<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Article\ArticleCont::index');


    

    //login user
    $routes->get('/', 'login\LoginCont::index');
    $routes->get('login', 'login\LoginCont::index');
    $routes->get('redirect', 'login\LoginCont::redirect');
    $routes->POST('exportDatabase', 'login\LoginCont::exportDatabase');
    $routes->post('authentifier', 'login\LoginCont::authentifier');
    $routes->post('deconnecter', 'login\LoginCont::deconnecter');
    $routes->get('recuperation_patient', 'login\LoginCont::recuperation_patient');
    $routes->get('consultation_histo', 'login\LoginCont::consultation_histo', ['api' => true]);


    //route utilisateur
    $routes->get('lienutilisateur', 'utilisateur\UtilisateurCont::lien');
    $routes->get('utilisateur', 'utilisateur\UtilisateurCont::page_utilisateur');
    $routes->post('afficher_utilisateur', 'utilisateur\UtilisateurCont::afficher');
    $routes->post('ajout_utilisateur', 'utilisateur\UtilisateurCont::ajouter');
    $routes->post('modifier_utilisateur', 'utilisateur\UtilisateurCont::modifier');
    $routes->post('supprimer_utilisateur', 'utilisateur\UtilisateurCont::supprimer');
    $routes->post('get_utilisateur', 'utilisateur\UtilisateurCont::get_user_details');
    $routes->post('getTypeMedecin', 'utilisateur\UtilisateurCont::getTypeMedecin');
    $routes->post('getRole', 'utilisateur\UtilisateurCont::getRole');

    //route dashboard
    $routes->get('liendashboard', 'dashboard\DashboardCont::lien');
    $routes->get('dashboard', 'dashboard\DashboardCont::index');
    $routes->post('resultat_dashboard', 'dashboard\DashboardCont::resultat_dashboard');


     //route pour membre
     $routes->get('membre', 'membre\MembreCont::index');
     $routes->get('lienmembre', 'membre\MembreCont::lien');
     $routes->post('listes_membre', 'membre\MembreCont::listes_membre');
     $routes->post('ajout_membre', 'membre\MembreCont::ajout_membre');
     $routes->post('delete_membre', 'membre\MembreCont::delete_membre');
     $routes->post('infos_membre', 'membre\MembreCont::infos_membre');
     $routes->post('bloque_membre', 'membre\MembreCont::bloque_membre');
     $routes->post('debloque_membre', 'membre\MembreCont::debloque_membre');

     //route pour examen
     $routes->get('patient', 'patient\PatientCont::index');
     $routes->get('lienpatient', 'patient\PatientCont::lien');
     $routes->post('listes_patient', 'patient\PatientCont::listes_patient');
     $routes->post('charge_membre', 'patient\PatientCont::charge_membre');
     
     //route pour titulaire
     $routes->get('titulaire', 'titulaire\TitulaireCont::index');
     $routes->get('lientitulaire', 'titulaire\TitulaireCont::lien');
     $routes->post('listesTitulaire', 'titulaire\TitulaireCont::listesTitulaire');
     $routes->post('ajout_titulaire', 'titulaire\TitulaireCont::ajout_titulaire');
     $routes->post('ajout_enfant', 'titulaire\TitulaireCont::ajout_enfant');
     $routes->post('delete_titulaire', 'titulaire\TitulaireCont::delete_titulaire');
     $routes->post('getTitulaireById', 'titulaire\TitulaireCont::getTitulaireById');
     $routes->post('getEnfantById', 'titulaire\TitulaireCont::getEnfantById');
     $routes->post('update_titulaire', 'titulaire\TitulaireCont::update_titulaire');
     $routes->post('update_enfant', 'titulaire\TitulaireCont::update_enfant');
     $routes->post('toNonAssure', 'titulaire\TitulaireCont::toNonAssure');
     $routes->post('toAssure', 'titulaire\TitulaireCont::toAssure');
     $routes->post('listeEnfant', 'titulaire\TitulaireCont::listeEnfant');
     $routes->post('delete_enfant', 'titulaire\TitulaireCont::delete_enfant');

     //route pour patient

     $routes->post('listes_patient_malade', 'titulaire\ConsultationCont::listes_patient_malade');
    //  $routes->post('ajout_titulaire', 'titulaire\TitulaireCont::ajout_titulaire');    

    //route medecin
    $routes->get('lienmedecin', 'medecin\MedecinCont::lien');
    $routes->get('medecin', 'medecin\MedecinCont::index');
    $routes->post('charge_specialite', 'medecin\MedecinCont::charge_specialite');
    $routes->post('charge_cabinet', 'medecin\MedecinCont::charge_cabinet');
    $routes->post('liste_medecin', 'medecin\MedecinCont::liste_medecin');
    $routes->post('ajout_medecin', 'medecin\MedecinCont::ajout_medecin');
    $routes->post('supprimer_medecin', 'medecin\MedecinCont::supprimer_medecin');

    //route consultation
    $routes->get('lienconsultation', 'consultation\ConsultationCont::lien');
    $routes->get('consultation', 'consultation\ConsultationCont::index');
    // $routes->get('/', 'consultation\ConsultationCont::index');
    $routes->post('charge_patient', 'consultation\ConsultationCont::charge_patient');
    $routes->post('charge_medecin', 'consultation\ConsultationCont::charge_medecin');
    $routes->post('listes_consultation', 'consultation\ConsultationCont::liste_consultation');
    $routes->post('ajout_consultation', 'consultation\ConsultationCont::ajout_consultation');
    $routes->post('delete_consultation', 'consultation\ConsultationCont::delete_consultation');

    //route cabinet
    $routes->post('ajout_cabinet', 'medecin\CabinetCont::ajout_cabinet');
    $routes->post('liste_cabinet', 'medecin\CabinetCont::liste_cabinet');
    $routes->post('supprimer_cabinet', 'medecin\CabinetCont::supprimer_cabinet');
    //route specialite
    $routes->post('ajout_specialite', 'medecin\SpecialiteCont::ajout_specialite');
    $routes->post('liste_specialite', 'medecin\SpecialiteCont::liste_specialite');
    $routes->post('supprimer_specialite', 'medecin\SpecialiteCont::supprimer_specialite');


    //route pour examen
    $routes->get('examen', 'examen\ExamenCont::index');
    $routes->get('lienexamen', 'examen\ExamenCont::lien');
    $routes->post('listes_examen', 'examen\ExamenCont::listes_examen');
    $routes->post('getExamenById', 'examen\ExamenCont::getExamenById');
    $routes->post('ajout_examen', 'examen\ExamenCont::ajout_examen');
    $routes->post('update_examen', 'examen\ExamenCont::update_examen');
    $routes->post('update_examen_by_docteur', 'examen\ExamenCont::update_examen_by_docteur');
    $routes->post('delete_examen', 'examen\ExamenCont::delete_examen');
    //imprimer Examen
    $routes->post('imprimerExamen', 'examen\ExamenCont::imprimerExamen');
    $routes->post('getDocteurExamen', 'examen\ExamenCont::getDocteurExamen');

