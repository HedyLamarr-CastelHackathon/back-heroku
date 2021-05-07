<?php
namespace App\Services\Constant;


/**
 * Class permettant d'utiliser des constantes
 */
class Constant
{
    private $projectDirectory;
    private $company;
    private $appName;
    private $appVersion;
    private $protocol;
    private $protocolApi;
    private $appDomain;
    private $fullAppDomain;
    private $apiDomain;
    private $fullApiDomain;
    private $apiGovDomain;
    private $fullApiGovDomain;

    private static $instance;

    private function __construct()
    {
        // $this->projectDirectory = $PROJECT_DIR;
    }
    /**
     * Permet de récupérer l'instance de Constant
     *
     * @return Constant
     */
    private static function getInstance() : Constant
    {
        if(!self::$instance)
        {
            self::$instance = new Constant();
            self::$instance->initialize();
        }
        return self::$instance;
    }

    /**
     * Permet d'initializer une instance de Constant
     *
     * @return void
     */
    private function initialize()
    {
        $this->company = "Hakathon";
        $this->appName = "Poubelle Manager";
        $this->appVersion = $_ENV['APP_VERSION'] ?? '0.0.1';
        $this->protocol = 'https://';
        $this->protocolApi = $_ENV['API_PROTOCOL'] ?? $this->protocol;

        $this->appDomain = $_ENV['APP_DOMAIN'] ?? 'hedylamarr-castelhackathon.vercel.app';
        $this->fullAppDomain = $this->protocol . $this->appDomain .'/';

        $this->apiDomain = $_ENV['API_DOMAIN'] ?? 'api-hedy-lamarr.herokuapp.com';
        $this->fullApiDomain = $this->protocolApi . $this->apiDomain .'/';

        $this->apiGovDomain = $_ENV['API_GOV_DOMAIN'] ?? 'api-adresse.data.gouv.fr';
        $this->fullApiGovDomain = $this->protocol . $this->apiGovDomain .'/';
    }

    /**
     * Permet de récupérer une valeur de constante
     *
     * @param string $attribute
     * @return mixed
     */
    public static function get(string $attribute)
    {
        return self::getInstance()->$attribute;
    }

    /**
     * Permet de récupérer toutes les constantes
     *
     * @param string $attribute
     * @return array
     */
    public static function getAll()
    {
        $classVars = get_object_vars(self::getInstance());
        $constants = array();
        foreach (array_keys($classVars) as $attribute)
        {
           $constants[$attribute] = self::getInstance()->$attribute;
        }
        return $constants;
    }
}

?>