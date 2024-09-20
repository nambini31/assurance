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
     $routes->post('delete_titulaire', 'titulaire\TitulaireCont::delete_titulaire');
     $routes->post('getTitulaireById', 'titulaire\TitulaireCont::getTitulaireById');
     $routes->get('getTitulaireById', 'titulaire\TitulaireCont::getTitulaireById');
     $routes->post('update_titulaire', 'titulaire\TitulaireCont::update_titulaire');

     //route pour patient

     $routes->post('listes_patient_malade', 'Consultation\ConsultationCont::listes_patient_malade');
     $routes->post('getDocteurSelonType', 'Consultation\ConsultationCont::getDocteurSelonType');
     $routes->post('charge_personne_malade', 'Consultation\ConsultationCont::charge_personne_malade');    
     $routes->post('ajout_patient', 'Consultation\ConsultationCont::ajout_patient');    

    //route medecin
    $routes->get('liengestion', 'gestion\AnalyseCont::lien');
    $routes->get('gestion', 'gestion\AnalyseCont::index');
    $routes->post('charge_type_analyse', 'gestion\AnalyseCont::charge_type_analyse');
    $routes->post('charge_cabinet', 'gestion\AnalyseCont::charge_cabinet');
    $routes->post('liste_analyse', 'gestion\AnalyseCont::liste_analyse');
    $routes->post('ajout_analyse', 'gestion\AnalyseCont::ajout_analyse');
    $routes->post('supprimer_analyse', 'gestion\AnalyseCont::supprimer_analyse');

    //route consultation
    $routes->get('lienconsultation', 'consultation\ConsultationCont::lien');
    $routes->get('consultation', 'consultation\ConsultationCont::index');
    $routes->post('charge_titulaire', 'consultation\ConsultationCont::charge_titulaire');
    $routes->post('getSpecialiteMedecin', 'consultation\ConsultationCont::getSpecialiteMedecin');
    $routes->post('charge_analyse', 'consultation\ConsultationCont::charge_analyse');
    $routes->post('charge_medicament', 'consultation\ConsultationCont::charge_medicament');
    $routes->post('charge_administration', 'consultation\ConsultationCont::charge_administration');
    $routes->post('listes_consultation', 'consultation\ConsultationCont::liste_consultation');
    $routes->post('ajout_consultation', 'consultation\ConsultationCont::ajout_consultation');
    $routes->post('delete_consultation', 'consultation\ConsultationCont::delete_consultation');
    $routes->post('affiche_parametre', 'consultation\ConsultationCont::affiche_parametre');
    $routes->post('affiche_clinique', 'consultation\ConsultationCont::affiche_clinique');
    $routes->post('add_parametre', 'consultation\ConsultationCont::add_parametre');
    $routes->post('add_clinique', 'consultation\ConsultationCont::add_clinique');
    $routes->post('add_Examen', 'consultation\ConsultationCont::add_Examen');
    $routes->post('add_medicament', 'consultation\ConsultationCont::add_medicament');
    $routes->post('delete_detailconsul', 'consultation\ConsultationCont::delete_detailconsul');
    $routes->post('listes_envoie_labo', 'Consultation\ConsultationCont::listes_envoie_labo');    
    $routes->post('valider_envoie_labo', 'Consultation\ConsultationCont::valider_envoie_labo');    
    $routes->post('downloadFile', 'Consultation\ConsultationCont::downloadFile');    
    $routes->post('envoyer_docteur', 'Consultation\ConsultationCont::envoyer_docteur');    
    $routes->post('listes_medic', 'Consultation\ConsultationCont::listes_medic');    
    $routes->post('delete_labo', 'Consultation\ConsultationCont::delete_labo');    
    $routes->post('listes_medicament', 'Consultation\ConsultationCont::listes_medicament');    
    

    //article
    $routes->get('lienarticle', 'article\ArticleCont::lien');
    $routes->get('article', 'article\ArticleCont::index');
    $routes->post('listeArticleMenuiserie', 'article\ArticleCont::listeArticle');
    $routes->post('generation_categorie_dynamique', 'article\ArticleCont::generation_categorie_dynamique');
    $routes->post('generation_dropdown_article', 'article\ArticleCont::generation_dropdown_article');
    $routes->post('generation_article_dynamique', 'article\ArticleCont::generation_article_dynamique');

    $routes->post('ajout_article', 'article\ArticleCont::ajout_article');
    $routes->post('listes_article', 'article\ArticleCont::listes_article');
    $routes->post('delete_article', 'article\ArticleCont::delete_article');
    $routes->post('generation_liste_par_groupe', 'article\ArticleCont::generation_liste_par_groupe');
    $routes->post('get_info_article', 'article\ArticleCont::get_info_article');


    //fournisseur
    $routes->get('lienfournisseur', 'fournisseur\FournisseurCont::lien');
    $routes->get('fournisseur', 'fournisseur\FournisseurCont::index');
    $routes->post('afficher_fournisseur', 'fournisseur\FournisseurCont::listes_fournisseur');
    $routes->post('ajout_fournisseur', 'fournisseur\FournisseurCont::ajout_fournisseur');
    $routes->post('modifier_fournisseur', 'fournisseur\FournisseurCont::modifier_fournisseur');
    $routes->post('delete_fournisseur', 'fournisseur\FournisseurCont::delete_fournisseur');
    $routes->post('get_fournisseur', 'fournisseur\FournisseurCont::get_fournisseur');
    $routes->post('generation_dropdown_fournisseur', 'fournisseur\FournisseurCont::generation_dropdown_fournisseur');


    //route cpn
    $routes->get('liencpn', 'cpn\CpnCont::lien');
    $routes->get('cpn', 'cpn\CpnCont::index');
    $routes->post('listes_details_consult', 'cpn\CpnCont::listes_details_consult');
    $routes->post('liste_cpn', 'cpn\CpnCont::liste_cpn');
    $routes->post('ajout_cpn', 'cpn\CpnCont::ajout_cpn');
    $routes->post('delete_cpn', 'cpn\CpnCont::delete_cpn');
    $routes->post('delete_detailcpn', 'cpn\CpnCont::delete_detailcpn');
    $routes->post('add_detailcpn', 'cpn\CpnCont::add_detailcpn');
    $routes->post('add_cpnParam', 'cpn\CpnCont::add_cpnParam');
    $routes->post('add_Examen_cpn', 'cpn\CpnCont::add_Examen_cpn');
    
    //route cpn
    $routes->get('lienpf', 'pf\PfCont::lien');
    $routes->get('pf', 'pf\PfCont::index');
    $routes->post('liste_pf', 'pf\PfCont::liste_pf');
    $routes->post('ajout_pf', 'pf\PfCont::ajout_pf');
    $routes->post('delete_pf', 'pf\PfCont::delete_pf');
    $routes->post('charge_methode_contraceptive', 'pf\PfCont::charge_methode_contraceptive');


    //route type_analyse
    $routes->post('ajout_type_analyse', 'gestion\Type_analyseCont::ajout_type_analyse');
    $routes->post('liste_type_analyse', 'gestion\Type_analyseCont::liste_type_analyse');
    $routes->post('supprimer_type_analyse', 'gestion\Type_analyseCont::supprimer_type_analyse');

    //route methodePf
    $routes->post('ajout_methodePf', 'gestion\MethodePfCont::ajout_methodePf');
    $routes->post('liste_methodePf', 'gestion\MethodePfCont::liste_methodePf');
    $routes->post('supprimer_methodePf', 'gestion\MethodePfCont::supprimer_methodePf');

    //route AdminMedicament
    $routes->post('ajout_adminMedicament', 'gestion\AdminMedicamentCont::ajout_adminMedicament');
    $routes->post('liste_adminMedicament', 'gestion\AdminMedicamentCont::liste_adminMedicament');
    $routes->post('supprimer_adminMedicament', 'gestion\AdminMedicamentCont::supprimer_adminMedicament');

    //route AutreActe
    $routes->post('ajout_autreActe', 'gestion\AutreActeCont::ajout_autreActe');
    $routes->post('liste_autreActe', 'gestion\AutreActeCont::liste_autreActe');
    $routes->post('supprimer_autreActe', 'gestion\AutreActeCont::supprimer_autreActe');


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

