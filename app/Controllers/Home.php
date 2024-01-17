<?php

namespace App\Controllers;
use CodeIgniter\Session\Session;
use Myth\Auth\Config\Auth as AuthConfig;

class Home extends BaseController {

	/**
	* @var array A standardized array variable to hold view data
	*/
	public $viewData = [];

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
		$this->viewData['currentModule'] = 'Dashboard';
		parent::initController($request, $response, $logger);
		$this->viewData['currentLocale'] = $this->request->getLocale();
		helper(['text', 'auth']);
	}

	/**
	* Index Page for this controller.
	*
	* @return string
	*/

	protected $auth;

    /**
     * @var AuthConfig
     */
    protected $config;

    /**
     * @var Session
     */
    protected $session;

	public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }
	public function index() {

		$this->viewData['pageTitle'] = 'MMM Fert';
		$this->viewData['pageSubTitle'] = lang('Basic.global.Dashboard');

		$cationFormulaModel = model('App\Models\Admin\CationFormulaModel');

		$xeroSalesGstModel = model('App\Models\Admin\XeroSalesGstModel');

		$timezoneModel = model('App\Models\Admin\TimezoneModel');

		$postcodeAustraliaListModel = model('App\Models\Admin\PostcodeAustraliaListModel');

		$stateModel = model('App\Models\Admin\StateModel');

		$companyModel = model('App\Models\Admin\CompanyModel');

		$cropTypeModel = model('App\Models\Admin\CropTypeModel');

		$fertilzerCompanyModel = model('App\Models\Admin\FertilzerCompanyModel');

		$fertilizerTemplateModel = model('App\Models\Admin\FertilizerTemplateModel');

		$harvestTemplateModel = model('App\Models\Admin\HarvestTemplateModel');

		$irrigationTemplateModel = model('App\Models\Admin\IrrigationTemplateModel');

		$plantingTemplateModel = model('App\Models\Admin\PlantingTemplateModel');

		$pestDiseasesTemplateModel = model('App\Models\Admin\PestDiseasesTemplateModel');

		$pPETemplateModel = model('App\Models\Admin\PPETemplateModel');

		$pricelistTemplateModel = model('App\Models\Admin\PricelistTemplateModel');

		$taskTemplateModel = model('App\Models\Admin\TaskTemplateModel');

		$settingModel = model('App\Models\Admin\SettingModel');

		$soilTestLabModel = model('App\Models\Admin\SoilTestLabModel');

		$userModel = model('UserModel');

		$userGroupModel = model('App\Models\Admin\UserGroupModel');

		$this->viewData['totalNrOfCationFormulas'] = $cationFormulaModel->getCount();

		// $this->viewData['cationFormulaList'] = $cationFormulaModel->findAll(5);

		$this->viewData['totalNrOfXeroSalesGsts'] = $xeroSalesGstModel->getCount();

		// $this->viewData['xeroSalesGstList'] = $xeroSalesGstModel->findAll(5);

		$this->viewData['totalNrOfTimezones'] = $timezoneModel->getCount();

		// $this->viewData['timezoneList'] = $timezoneModel->findAll(5);

		$this->viewData['totalNrOfPostcodeAustraliaLists'] = $postcodeAustraliaListModel->getCount();

		// $this->viewData['postcodeAustraliaListList'] = $postcodeAustraliaListModel->findAll(5);

		$this->viewData['totalNrOfStates'] = $stateModel->getCount();

		// $this->viewData['stateList'] = $stateModel->findAll(5);

		$this->viewData['totalNrOfCompanies'] = $companyModel->getCount();

		// $this->viewData['companyList'] = $companyModel->findAll(5);

		$this->viewData['totalNrOfCropTypes'] = $cropTypeModel->getCount();

		// $this->viewData['cropTypeList'] = $cropTypeModel->findAll(5);

		$this->viewData['totalNrOfFertilzerCompanies'] = $fertilzerCompanyModel->getCount();

		// $this->viewData['fertilzerCompanyList'] = $fertilzerCompanyModel->findAll(5);

		$this->viewData['totalNrOfFertilizerTemplates'] = $fertilizerTemplateModel->getCount();

		// $this->viewData['fertilizerTemplateList'] = $fertilizerTemplateModel->findAll(5);

		$this->viewData['totalNrOfHarvestTemplates'] = $harvestTemplateModel->getCount();

		// $this->viewData['harvestTemplateList'] = $harvestTemplateModel->findAll(5);

		$this->viewData['totalNrOfIrrigationTemplates'] = $irrigationTemplateModel->getCount();

		// $this->viewData['irrigationTemplateList'] = $irrigationTemplateModel->findAll(5);

		$this->viewData['totalNrOfPlantingTemplates'] = $plantingTemplateModel->getCount();

		// $this->viewData['plantingTemplateList'] = $plantingTemplateModel->findAll(5);

		$this->viewData['totalNrOfPestDiseasesTemplates'] = $pestDiseasesTemplateModel->getCount();

		// $this->viewData['pestDiseasesTemplateList'] = $pestDiseasesTemplateModel->findAll(5);

		$this->viewData['totalNrOfPpeTemplates'] = $pPETemplateModel->getCount();

		// $this->viewData['ppeTemplateList'] = $pPETemplateModel->findAll(5);

		$this->viewData['totalNrOfPriceListTemplates'] = $pricelistTemplateModel->getCount();

		// $this->viewData['priceListTemplateList'] = $pricelistTemplateModel->findAll(5);

		$this->viewData['totalNrOfTaskTemplates'] = $taskTemplateModel->getCount();

		// $this->viewData['taskTemplateList'] = $taskTemplateModel->findAll(5);

		$this->viewData['totalNrOfSettings'] = $settingModel->getCount();

		// $this->viewData['settingList'] = $settingModel->findAll(5);

		$this->viewData['totalNrOfSoilTestLabs'] = $soilTestLabModel->getCount();

		// $this->viewData['soilTestLabList'] = $soilTestLabModel->findAll(5);

		$this->viewData['totalNrOfUsers'] = $userModel->getCount();

		// $this->viewData['userList'] = $userModel->findAll(5);

		$this->viewData['totalNrOfUserGroups'] = $userGroupModel->getCount();

		// $this->viewData['userGroupList'] = $userGroupModel->findAll(5);

		return view('dashboardHome', $this->viewData);
	}

	public function login()
    {
        // No need to show a login form if the user
        // is already logged in.
        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);
            return redirect()->to('dashboard');
        }

        // Set a return URL if none is specified
        $_SESSION['redirect_url'] = session('redirect_url') ?? previous_url() ?? site_url('/');

		return view('authViews/login', ['config' => $this->config]);

    }

	public function attemptLogin()
    {
        $rules = [
            'login'    => 'required',
            'password' => 'required',
        ];
        if ($this->config->validFields === ['email']) {
            $rules['login'] .= '|valid_email';
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $login    = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // Determine credential type
        $type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Try to log them in...
        if (! $this->auth->attempt([$type => $login, 'password' => $password], $remember)) {
            return redirect()->back()->withInput()->with('error', $this->auth->error() ?? lang('Auth.badAttempt'));
        }

        // Is the user being forced to reset their password?
        if ($this->auth->user()->force_pass_reset === true) {
            return redirect()->to(route_to('reset-password') . '?token=' . $this->auth->user()->reset_hash)->withCookies();
        }

        $redirectURL = session('redirect_url') ?? site_url('/');
        unset($_SESSION['redirect_url']);

        return redirect()->to($redirectURL)->withCookies()->with('message', lang('Auth.loginSuccess'));
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        if ($this->auth->check()) {
            $this->auth->logout();
        }

        return redirect()->to(site_url('/'));
    }
}
