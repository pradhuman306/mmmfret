<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Models\Admin\PostcodeAustraliaListModel;

use App\Entities\Admin\SoilTestLab;

use App\Models\Admin\SoilTestLabModel;

use App\Models\Admin\StateModel;

use App\Libraries\TimezoneConverter;

class SoilTestLabsController extends GoBaseResourceController { 

    protected $modelName = SoilTestLabModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Soil Test Lab';
    protected static $singularObjectNameCc = 'soilTestLab';
    protected static $pluralObjectName = 'Soil Test Labs';
    protected static $pluralObjectNameCc = 'soilTestLabs';

    protected static $controllerSlug = 'soil-test-labs';

    protected static $viewPath = 'admin/soilTestLabViews/';

    protected $indexRoute = 'soilTestLabList';

    protected $timezoneConverter;

    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('SoilTestLabs.moduleTitle');
        $this->viewData['usingSweetAlert'] = true;
        parent::initController($request, $response, $logger);
    }


    public function index() {
        if ( !logged_in() ) {
			return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
		}
		if ( !in_groups('admin') ) {
			return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
		}
        $viewData = [
                'currentModule' => static::$controllerSlug,
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('SoilTestLabs.soilTestLab')]),
                'soilTestLab' => new SoilTestLab(),
                'usingServerSideDataTable' => true,
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class

        return view(static::$viewPath.'viewSoilTestLabList', $viewData);
    }

    public function add() {
    
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }
    
        $loggedInUsername = null;
        $soilTestLab = new SoilTestLab();
    
        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; 
        }
    
        $requestMethod = $this->request->getMethod();
    
        if ($requestMethod === 'post') {

            $id = $this->request->getPost('soilTestLab_id') ?? null;
        
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
                ]
            ];
        
            // Additional rule for 'company' field to ensure uniqueness, except for the current record when editing
            $SoilTestLabValidationRule = 'required';
  
            $validationRules['company'] = [
                'label' => 'Company',
                'rules' => $SoilTestLabValidationRule
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
            $sanitizedData['id'] = 'id';

                $noException = true;
                $successfulResult = $this->model->skipValidation(true)->insert($sanitizedData);
                $sanitizedData['id'] = $id; // Assuming $id is the company_id
                $thenRedirect = true;  // Change this to false if you want your user to stay on the form after submission

                if ($noException && $successfulResult) :

                    $id = $sanitizedData['id'];
    
                    $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('SoilTestLabs.soilTestLab'))]).'.';
                    $message .= anchor(base_url( "{$locale}/admin/soil-test-labs/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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
        $formatted_created_at = $timezoneConverter->convertToUserTimezone(null, $userId, 'created_at', 'SoilTestLabModel');
        $this->viewData['formatted_created_at'] = $formatted_created_at;
    
        $this->viewData['stateList'] = $this->getStateListItems($this->request->getPost('state'));
		$this->viewData['postcodeAustraliaListList'] = $this->getPostcodeAustraliaListListItems($this->request->getPost('suburb'));

        $this->viewData['soilTestLab'] = isset($sanitizedData) ? new SoilTestLab($sanitizedData) : new SoilTestLab();
    
        $this->viewData['formAction'] = base_url().route_to('createSoilTestLab');
    
        $this->viewData['boxTitle'] = lang('Basic.global.addNew').' '.lang('SoilTestLabs.moduleTitle').' '.lang('Basic.global.addNewSuffix');
    
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
        $soilTestLab = $this->model->find($id);

        if ($soilTestLab == false) :
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('SoilTestLab.soilTestLab')), $id]);
            return $this->redirect2listView('sweet-error', $message);
        endif;

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') {
            $nullIfEmpty = true; 
            // !(phpversion() >= '8.1');
            $id = filter_var($requestedId, FILTER_SANITIZE_NUMBER_INT);
            $postData = $this->request->getPost();
            $locale = $this->request->getLocale();
            $sanitizedData = $this->sanitized($postData, $nullIfEmpty);
    
            // Define validation rules, including the unique check for 'company'
            $validationRules = [
                'company' => [
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
                    $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('SoilTestLabs.soilTestLab'))]).'.'; // This is the sweet alert message on successful update
                        if (!empty($this->indexRoute)) :
                            return redirect()->to(base_url().route_to( $this->indexRoute )  )->with('sweet-success', $message);
                        else:
                            return $this->redirect2listView('sweet-success', $message);
                        endif;
                endif; // $noException && $successfulResult
                    
                } else {
                    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('SoilTestLabs.soilTestLab'))]);
                    $this->session->setFlashdata('formErrors', $this->model->errors());
                }
                
                $soilTestLab->fill($sanitizedData);
            } else {
                // Handle validation errors
                $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('SoilTestLabs.soilTestLab'))]);
                $this->session->setFlashdata('formErrors', $this->validator->getErrors());
            }
        }
        

        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
          // Convert the 'updated_at' field for company to the user's local timezone
          if ($soilTestLab) {
            $soilTestLab->created_at = $timezoneConverter->convertToUserTimezone($soilTestLab->id, $userId,'created_at','SoilTestLabModel');
            $soilTestLab->updated_at = $timezoneConverter->convertToUserTimezone($soilTestLab->id, $userId,'updated_at','SoilTestLabModel');
        }
        $this->viewData['stateList'] = $this->getStateListItems($soilTestLab->state);
		$this->viewData['postcodeAustraliaListList'] = $this->getPostcodeAustraliaListListItems($soilTestLab->suburb);
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['soilTestLab'] = $soilTestLab;
        $this->viewData['formAction'] = base_url().route_to('updateSoilTestLab', $id);
        $this->viewData['boxTitle'] = lang('Basic.global.edit2').' '.lang('SoilTestLabs.moduleTitle').' '.lang('Basic.global.edit3');
   
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
            $order = SoilTestLabModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
            $dir = $reqData['order']['0']['dir'] ?? 'asc';

            $resourceData = $this->model->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject();
			foreach ($resourceData as $item) :
            if (isset($item->company) && strlen($item->company) > 100) :
                $item->company = character_limiter($item->company, 100);
                endif;if (isset($item->title) && strlen($item->title) > 100) :
                $item->title = character_limiter($item->title, 100);
            endif;
			endforeach;

            return $this->respond(Collection::datatable(
                $resourceData,
                $this->model->getResource()->countAllResults(),
                $this->model->getResource($search)->countAllResults()
            ));
        } else {
            return $this->failUnauthorized('Invalid request', 403);
        }
    }

    public function allItemsSelect() {
        if ($this->request->isAJAX()) {
            $onlyActiveOnes = true;
            $reqVal = $this->request->getPost('val') ?? 'id';
            $menu = $this->model->getAllForMenu($reqVal.', company', 'company', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->company = '- '.lang('Basic.global.None').' -';
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

    public function menuItems() {
        if ($this->request->isAJAX()) {
            $searchStr = goSanitize($this->request->getPost('searchTerm'))[0];
            $reqId = goSanitize($this->request->getPost('id'))[0];
            $reqText = goSanitize($this->request->getPost('text'))[0];
            $onlyActiveOnes = false;
            $columns2select = [$reqId ?? 'id', $reqText ?? 'company'];
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

