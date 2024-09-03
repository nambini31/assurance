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
     $routes->post('charge_membre1', 'patient\PatientCont::charge_membre1');
     
     //route pour titulaire
     $routes->get('titulaire', 'titulaire\TitulaireCont::index');
     $routes->get('lientitulaire', 'titulaire\TitulaireCont::lien');
     $routes->post('listesTitulaire', 'titulaire\TitulaireCont::listesTitulaire');
     $routes->post('ajout_titulaire', 'titulaire\TitulaireCont::ajout_titulaire');  

     //route pour patient

     $routes->post('listes_patient_malade', 'Consultation\ConsultationCont::listes_patient_malade');
     $routes->post('getDocteurSelonType', 'Consultation\ConsultationCont::getDocteurSelonType');
    //  $routes->post('ajout_titulaire', 'titulaire\TitulaireCont::ajout_titulaire');    

    //route medecin
    $routes->get('lienanalyse', 'analyse\AnalyseCont::lien');
    $routes->get('analyse', 'analyse\AnalyseCont::index');
    $routes->post('charge_type_analyse', 'analyse\AnalyseCont::charge_type_analyse');
    $routes->post('charge_cabinet', 'analyse\AnalyseCont::charge_cabinet');
    $routes->post('liste_analyse', 'analyse\AnalyseCont::liste_analyse');
    $routes->post('ajout_analyse', 'analyse\AnalyseCont::ajout_analyse');
    $routes->post('supprimer_analyse', 'analyse\AnalyseCont::supprimer_analyse');

    //route consultation
    $routes->get('lienconsultation', 'consultation\ConsultationCont::lien');
    $routes->get('consultation', 'consultation\ConsultationCont::index');
    // $routes->get('/', 'consultation\ConsultationCont::index');
    $routes->post('charge_titulaire', 'consultation\ConsultationCont::charge_titulaire');
    $routes->post('getSpecialiteMedecin', 'consultation\ConsultationCont::getSpecialiteMedecin');
    $routes->post('charge_analyse', 'consultation\ConsultationCont::charge_analyse');
    $routes->post('listes_consultation', 'consultation\ConsultationCont::liste_consultation');
    $routes->post('ajout_consultation', 'consultation\ConsultationCont::ajout_consultation');
    $routes->post('delete_consultation', 'consultation\ConsultationCont::delete_consultation');
    $routes->post('affiche_parametre', 'consultation\ConsultationCont::affiche_parametre');
    $routes->post('add_parametre', 'consultation\ConsultationCont::add_parametre');
    $routes->post('add_Examen', 'consultation\ConsultationCont::add_Examen');

    //route type_analyse
    $routes->post('ajout_type_analyse', 'analyse\Type_analyseCont::ajout_type_analyse');
    $routes->post('liste_type_analyse', 'analyse\Type_analyseCont::liste_type_analyse');
    $routes->post('supprimer_type_analyse', 'analyse\Type_analyseCont::supprimer_type_analyse');


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

