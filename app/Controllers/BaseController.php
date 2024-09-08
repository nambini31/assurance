<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\login\LoginModel;
use App\Controllers\login\LoginCont;
use App\Models\Cabinet\CabinetModel;

use App\Models\Consultation\ConsultationModel;
use App\Models\Consultation\DetailconsultationModel;
use App\Models\Cpn\CpnModel;
use App\Models\Cpn\DetailConsultationCpnModel;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Membre\MembreModel;
use App\Models\Patient\PatientModel;
use App\Models\Utilisateur\RoleModel;
use App\Models\Utilisateur\TypeMedecinModel;
use App\Models\Titulaire\TitulaireModel;
use Psr\Log\LoggerInterface;
use App\Models\utilisateur\UtilisateurModel;
use App\Models\Examen\ExamenModel;
use App\Models\Gestion\AnalyseModel;
use App\Models\Gestion\MethodePfModel;
use App\Models\Gestion\Type_analyseModel;
use App\Models\Pf\PfModel;
use Mpdf\Mpdf;



/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{

    //deputation
    protected $connexion;
    protected $utilisateur;
    protected $role;
    protected $session;
    protected $typeMedecin;
    protected $consultation;
    protected $detailconsultation;
    protected $pdf;
    protected $dompdf;

    protected $patient;
    protected $analyse;
    protected $type_analyse;
    protected $cabinet;
    protected $clientApi;
    protected $membre;
    protected $titulaire;
    protected $examen;
    protected $cpn;
    protected $pf;
    protected $detailconsultationcpn;
    protected $methodePf;


    public function __construct()
    {
        //deputation
        $this->utilisateur = new UtilisateurModel();
        $this->role = new RoleModel();
        $this->typeMedecin = new TypeMedecinModel();
        $this->connexion = new LoginModel();
        $this->consultation = new ConsultationModel();
        $this->detailconsultation = new DetailconsultationModel();
        $this->detailconsultationcpn = new DetailConsultationCpnModel();
        $this->cpn = new CpnModel();
        $this->methodePf = new MethodePfModel();
        

        $this->patient = new PatientModel();
        $this->titulaire = new TitulaireModel();
        $this->type_analyse = new Type_analyseModel();
        $this->cabinet = new CabinetModel();
        $this->analyse = new AnalyseModel();
        $this->membre = new MembreModel();
        $this->examen = new ExamenModel();
        $this->pf = new PfModel();
        $this->pdf = new Mpdf();

    }

    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */




    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */


    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        $this->clientApi = \Config\Services::curlrequest();

        $this->teste_session();
        
    }

    function genererNumeroCarte($nomMembre, $numeroCarte) {
        // Garder les trois premières lettres du nom en majuscules
    $prefixe = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $nomMembre), 0, 3));
    
    // Si le numéro a moins de 3 chiffres, on ajoute des zéros à gauche
    if ($numeroCarte < 100) {
        $numeroCarte = str_pad($numeroCarte, 3, '0', STR_PAD_LEFT);
    }
    
    // Générer le numéro de carte complet
    $numCarte = $prefixe . '-' . $numeroCarte;
    
    return $numCarte;
    }

    public function teste_session()
    {

        try {

             
            if ($this->request->uri->getPath() === '/index.php/consultation_histo' || $this->request->uri->getPath() === "/Assurance/index.php/consultation_histo") {
                
                return ;
            }

            // Vérifier si la requête est destinée à une API
            if (strpos(service('request')->getHeaderLine('Accept'), 'application/json') !== false) {
                // Pour les requêtes API, ne pas effectuer de vérification de session
                return;
            }

            // // Vérifier si le code s'exécute dans un contexte de tâche planifiée (cron job)
            $isCron = isset($_SERVER['argv'][0]) && strpos($_SERVER['argv'][0], 'php') !== false;
            if ($isCron) {
                // Ne pas effectuer de vérification de session pour les tâches planifiées
                return;
            }

            // Vérifier si la session de l'utilisateur est active
            if (!$this->session->has('is_connected') && service('request')->uri->getPath() !== 'login') {
                // Rediriger vers la page de connexion si la session n'est pas active et si ce n'est pas déjà la page de connexion
                $contLog = new LoginCont();
                $contLog->authentifier();
            }
        } catch (\Throwable $th) {
            // Gérer les erreurs éventuelles
            echo $th ;
        }
    }
    
}
