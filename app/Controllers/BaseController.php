<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use App\Models\login\LoginModel;
use App\Controllers\login\LoginCont;

use App\Models\Cabinet\CabinetModel;

use App\Models\Consultation\ConsultationModel;

use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Medecin\MedecinModel;
use App\Models\Membre\MembreModel;
use App\Models\Patient\PatientModel;
use App\Models\Specialiste\SpecialiteModel;
use App\Models\Utilisateur\RoleModel;
use App\Models\Utilisateur\TypeMedecinModel;
use App\Models\Titulaire\TitulaireModel;
use Psr\Log\LoggerInterface;
use App\Models\utilisateur\UtilisateurModel;


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


    protected $patient;
    protected $medecin;
    protected $specialite;
    protected $consultation;
    protected $cabinet;
    protected $clientApi;
    protected $membre;
    protected $titulaire;


    public function __construct()
    {
        //deputation
        $this->utilisateur = new UtilisateurModel();
        $this->role = new RoleModel();
        $this->typeMedecin = new TypeMedecinModel();
        $this->connexion = new LoginModel();
        $this->consultation = new ConsultationModel();
        $this->patient = new PatientModel();
        $this->titulaire = new TitulaireModel();
        $this->specialite = new SpecialiteModel();
        $this->cabinet = new CabinetModel();
        $this->medecin = new MedecinModel();
        $this->membre = new MembreModel();
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
