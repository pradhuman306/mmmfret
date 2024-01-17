<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Entities\Admin\Company;

use App\Models\Admin\PostcodeAustraliaListModel;

use App\Models\Admin\CompanyModel;

use App\Models\Admin\StateModel;

use App\Libraries\TimezoneConverter;

class CompaniesController extends GoBaseResourceController { 

    protected $modelName = CompanyModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Company';
    protected static $singularObjectNameCc = 'company';
    protected static $pluralObjectName = 'Companies';
    protected static $pluralObjectNameCc = 'companies';

    protected static $controllerSlug = 'companies';

    protected static $viewPath = 'admin/companyViews/';

    protected $indexRoute = 'companyList';

    protected $timezoneConverter;

    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('Companies.moduleTitle');
        $this->viewData['usingSweetAlert'] = true;
        parent::initController($request, $response, $logger);
    }


    public function index() {
        helper(['form']);
        if ( !logged_in() ) {
			return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
		}
		if ( !in_groups('admin') ) {
			return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
		}
        $viewData = [
                'currentModule' => static::$controllerSlug,
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('Companies.company')]),
                'company' => new Company(),
                'usingServerSideDataTable' => true,
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class

        return view(static::$viewPath.'viewCompanyList', $viewData);
    }

    public function add() {
    
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }
    
        $loggedInUsername = null;
        $companys = new Company();
    
        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; 
        }
    
        if ($this->request->getPost()) { 

            $id = $this->request->getPost('company_id') ?? null;
        
            // Define base validation rules
            $validationRules = [
                'street' => [
                    'rules' => 'required',
                    'label' => 'Street' // Show label name
                ],
                'state' => [
                    'rules' => 'required',
                    'label' => 'State' // Show label name
                ],
                'suburb' => [
                    'rules' => 'required',
                    'label' => 'Suburb' // Show label name
                ],
                'first_name' => [
                    'rules' => 'required',
                    'label' => 'First Name' // Show label name
                ],
                'last_name' => [
                    'rules' => 'required',
                    'label' => 'Last Name' // Show label name
                ],
                'email_address' => [
                    'rules' => 'required',
                    'label' => 'Email Address' // Show label name
                ],
                'mobile_number' => [
                    'rules' => 'required',
                    'label' => 'Mobile Number' // Show label name
                ]
            ];
        
            // Additional rule for 'company' field to ensure uniqueness, except for the current record when editing
            $companyValidationRule = 'required';
            if ($id) {
                $companyValidationRule .= '|is_unique[company.company_name,id,' . $id . ']';
            } else {
                $companyValidationRule .= '|is_unique[company.company_name]';

            }
            $validationRules['company_name'] = [
                'label' => 'Company',
                'rules' => $companyValidationRule
            ];
         
            if ($this->validate($validationRules)) {
                $nullIfEmpty = true; // !(phpversion() >= '8.1');
                $postData = $this->request->getPost();
                $locale = $this->request->getLocale();
                $sanitizedData = [];
                foreach ($postData as $k => $v) {
                    if ($k == 'created_by' && $loggedInUsername !== null) {
                        $sanitizedData[$k] = $loggedInUsername;
                    } else {
                        $sanitizationResult = goSanitize($v);
                        $sanitizedData[$k] = $sanitizationResult[0];
                    }
                }
                $file1 = isset($_FILES['logo_url']['size']) && $_FILES['logo_url']['size'] > 0 ? $this->request->getFile('logo_url') : null;
                $fileName1 = $_FILES['logo_url']['name'];
                $sanitizedData['id'] = 'id';
                $sanitizedData['logo_url'] = $fileName1;

                $noException = true;
                $successfulResult = $this->model->skipValidation(true)->insert($sanitizedData);
                $sanitizedData['id'] = $id; // Assuming $id is the company_id
                $thenRedirect = true;  // Change this to false if you want your user to stay on the form after submission

                if ($noException && $successfulResult) :

                    $id = $sanitizedData['id'];
                    if (isset($file1) && method_exists($file1,'isValid') && !$file1->hasMoved()) :
				    $filePath1 = FCPATH . 'res/companies';
				    try {
				        $movedAlright = isset($fileName1) && !empty($fileName1) ? $file1->move($filePath1, $fileName1) : $file1->move($filePath1);
                    } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $he) {
				        $movedAlright = false;
				        log_message('error', 'File upload processing failed for field logo_url in the Companies module due to a HTTPException thrown:'.PHP_EOL.$he->getMessage());
				    } catch (\Exception $e) {
				        $movedAlright = false;
				        log_message('error', 'File upload processing failed for field logo_url in the Companies module due to an unexpected exception thrown:'.PHP_EOL.$e->getMessage());
				    }
				    if (!$movedAlright):
				        // Take further action to deal with unsuccessful upload
				        log_message('error', 'logo_url file could not be saved in '.$filePath1.' due to a server error (possible reasons: insufficient permissions or server storage full).');
				        $this->model->skipValidation(true)->update($id, ['logo_url' => null]);
				        $this->session->setFlashData('errorMessage', 'Upload for logo_url has been unsuccessful due to a server error.');

				    elseif ( isset($fileName1) && !empty($fileName1) && file_exists($filePath1.'/'.$fileName1)) :
				        try {
				            service('image')->withFile($filePath1.'/'.$fileName1)->fit(256, 256, 'center')->save($filePath1.'/'.$fileName1);
				        } catch (\Exception $e) {
				            log_message('error', 'Image resizing failed for field logo_url in the Companies module. Exception thrown:'.PHP_EOL.$e->getMessage());
				        }
				    endif;
				endif;

    
                    $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('Companies.company'))]).'.';
                    $message .= anchor(base_url( "{$locale}/admin/companies/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
                    $message = ucfirst(str_replace("'", "\'", $message));
    
                    if ($thenRedirect) :
                        if (!empty($this->indexRoute)) :
                            return redirect()->to(base_url().route_to( $this->indexRoute )  )->with('sweet-success', $message);
                        else:
                            return $this->redirect2listView('sweet-success', $message);
                        endif;
                    else:
                        $this->session->setFlashData('sweet-success', $message);
                    endif;
    
                endif; // $noException && $successfulResult

                

            } else {
                // Handle validation errors
                $this->viewData['validationErrors'] = $this->validator->getErrors();
                $this->viewData['oldInput'] = $this->request->getPost();
            }
        }
      
        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
        $formatted_created_at = $timezoneConverter->convertToUserTimezone(null, $userId, 'created_at', 'CompanyModel');
        $this->viewData['formatted_created_at'] = $formatted_created_at;
    
        $this->viewData['stateList'] = $this->getStateListItems($this->request->getPost('state'));
		$this->viewData['postcodeAustraliaListList'] = $this->getPostcodeAustraliaListListItems($this->request->getPost('suburb'));

        $this->viewData['company'] = isset($sanitizedData) ? new Company($sanitizedData) : new Company();
    
        $this->viewData['formAction'] = base_url().route_to('createCompany');
    
        $this->viewData['boxTitle'] = lang('Basic.global.addNew') . ' ' . lang('Company.moduleTitle') . ' ' . lang('Basic.global.addNewSuffix');
    
        return $this->displayForm(__METHOD__);
        // end function add()
    }

    public function edit($requestedId = null) {
        if ( !logged_in() ) {
			return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
		}
		if ( !in_groups('admin') ) {
			return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
		}
        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;

        $loggedInUsername = null;

        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; 
        }
    
        $loggedInUsername = $user->username; 

        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $company = $this->model->find($id);

        if ($company == false) :
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('Companys.company')), $id]);
            return $this->redirect2listView('sweet-error', $message);
        endif;


        if ($this->request->getPost()) { 
            $nullIfEmpty = true; 
            // !(phpversion() >= '8.1');
            $id = filter_var($requestedId, FILTER_SANITIZE_NUMBER_INT);
            $postData = $this->request->getPost();
            $locale = $this->request->getLocale();
            $sanitizedData = $this->sanitized($postData, $nullIfEmpty);
    
            // Define validation rules, including the unique check for 'company'
            $validationRules = [
                'company_name' => [
                    'label' => 'Company',
                    'rules' => 'required'
                ]
            ];
    
            $noException = true;
            $successfulResult = false; // for now
    
            if ($this->validate($validationRules)) {
                if ($this->canValidate()) {
                    try {
                        $successfulResult = $this->model->skipValidation(true)->update($id, $sanitizedData);
                    } catch (\Exception $e) {
                        $noException = false;
                        $this->dealWithException($e);
                    }

                if ($noException && $successfulResult) :
                    $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('Companies.company'))]).'.';
                        if (!empty($this->indexRoute)) :
                            return redirect()->to(base_url().route_to( $this->indexRoute )  )->with('sweet-success', $message);
                        else:
                            return $this->redirect2listView('sweet-success', $message);
                        endif;
                endif; // $noException && $successfulResult
                    
                } else {
                    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('Companys.company'))]);
                    $this->session->setFlashdata('formErrors', $this->model->errors());
                }
                
                $company->fill($sanitizedData);
            } else {
                // Handle validation errors
                $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('Companys.company'))]);
                $this->session->setFlashdata('formErrors', $this->validator->getErrors());
            }
        }
 
        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
          // Convert the 'updated_at' field for company to the user's local timezone
          if ($company) {
            $company->created_at = $timezoneConverter->convertToUserTimezone($company->id, $userId,'created_at','CompanyModel');
            $company->updated_at = $timezoneConverter->convertToUserTimezone($company->id, $userId,'updated_at','CompanyModel');
        }
        $this->viewData['stateList'] = $this->getStateListItems($company->state);
		$this->viewData['postcodeAustraliaListList'] = $this->getPostcodeAustraliaListListItems($company->suburb);
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['company'] = $company;
   		$this->viewData['formAction'] = base_url().route_to('updateCompany', $id);
   
        return $this->displayForm(__METHOD__, $id);
    } // end function edit(...)
    


    public function datatable() {
        if ($this->request->isAJAX()) {
            $reqData = $this->request->getPost();
            if (!isset($reqData['draw']) || !isset($reqData['columns']) ) {
                $errstr = 'No data available in response to this specific request.';
                $response = $this->respond(Collection::datatable(  [], 0, 0, $errstr ), 400, $errstr);
                return $response;
            }
            $start = $reqData['start'] ?? 0;
            $length = $reqData['length'] ?? 5;
            $search = $reqData['search']['value'];
            $requestedOrder = $reqData['order']['0']['column'] ?? 1;
            $order = CompanyModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
            $dir = $reqData['order']['0']['dir'] ?? 'asc';

            $resourceData = $this->model->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject();

            return $this->respond(Collection::datatable(
                $resourceData,
                $this->model->getResource()->countAllResults(),
                $this->model->getResource($search)->countAllResults()
            ));
        } else {
            return $this->failUnauthorized('Invalid request', 403);
        }
    }

    public function menuItems() {
        if ($this->request->isAJAX()) {
            $searchStr = goSanitize($this->request->getPost('searchTerm'))[0];
            $reqId = goSanitize($this->request->getPost('id'))[0];
            $reqText = goSanitize($this->request->getPost('text'))[0];
            $onlyActiveOnes = false;
            $columns2select = [$reqId ?? 'company_id', $reqText ?? 'company_name'];
            $onlyActiveOnes = false;
            $menu = $this->model->getSelect2MenuItems($columns2select, $columns2select[1], $onlyActiveOnes, $searchStr);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->text = '- '.lang('Basic.global.None').' -';
            array_unshift($menu , $nonItem);

            $newTokenHash = csrf_hash();
            $csrfTokenName = csrf_token();
            $data = [
                'menu' => $menu,
                $csrfTokenName => $newTokenHash
            ];
            return $this->respond($data);
        } else {
            return $this->failUnauthorized('Invalid request', 403);
        }
    }

    protected function getPostcodeAustraliaListListItems($selId = null) { 
		$data = [''=>lang('Basic.global.pleaseSelectA', [mb_strtolower(lang('PostcodeAustraliaLists.postcodeAustraliaList'))])];
        if (!empty($selId)) :
            		$postcodeAustraliaListModel = model('App\Models\Admin\PostcodeAustraliaListModel');

            $selOption = $postcodeAustraliaListModel->where('id', $selId)->findColumn('suburb');
            if (!empty($selOption)) :
                $data[$selId] = $selOption[0];
            endif;
        endif;
		return $data;
	}


	protected function getStateListItems($selId = null) { 
		$data = [''=>lang('Basic.global.pleaseSelectA', [mb_strtolower(lang('States.state'))])];
        if (!empty($selId)) :
            		$stateModel = model('App\Models\Admin\StateModel');

            $selOption = $stateModel->where('state_id', $selId)->findColumn('state');
            if (!empty($selOption)) :
                $data[$selId] = $selOption[0];
            endif;
        endif;
		return $data;
	}

}
