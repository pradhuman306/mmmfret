<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Entities\Admin\PostcodeAustraliaList;

use App\Models\Admin\TimezoneModel;

use App\Models\Admin\StateModel;

use App\Models\Admin\PostcodeAustraliaListModel;

use App\Libraries\TimezoneConverter;

class PostcodeAustraliaListsController extends GoBaseResourceController { 

    protected $modelName = PostcodeAustraliaListModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Postcode Australia List';
    protected static $singularObjectNameCc = 'postcodeAustraliaList';
    protected static $pluralObjectName = 'Postcode Australia Lists';
    protected static $pluralObjectNameCc = 'postcodeAustraliaLists';

    protected static $controllerSlug = 'postcode-australia-lists';

    protected static $viewPath = 'admin/postcodeAustraliaListViews/';

    protected $indexRoute = 'postcodeAustraliaListList';

    protected $timezoneConverter;

    

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('PostcodeAustraliaLists.moduleTitle');
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
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('PostcodeAustraliaLists.postcodeAustraliaList')]),
                'postcodeAustraliaList' => new PostcodeAustraliaList(),
                'usingServerSideDataTable' => true,
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class
        $timezoneConverter = new TimezoneConverter();
        $this->viewData['timezoneConverter'] = $timezoneConverter;

        return view(static::$viewPath.'viewPostcodeAustraliaListList', $viewData);
    }

    public function getstate()
    {
		$data = $this->model->getstatebytimezone($_GET['id']);
        echo json_encode($data?$data[0]:null);
    }

    public function add() {
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }
    
        $loggedInUsername = null;
        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; 
        }
        $requestMethod = $this->request->getMethod();
    
        if ($requestMethod === 'post') {
            // Define validation rules
            $validationRules = [
                'timezone' => [
                    'rules' => 'required',
                    'label' => 'Timezone'
                ],
                'postcode' => [
                    'rules' => 'required',
                    'label' => 'Postcode'
                ],
                'lat' => [
                    'rules' => 'required',
                    'label' => 'Latitude'
                ],
                'lon' => [
                    'rules' => 'required',
                    'label' => 'Longitude'
                ],
                'suburb' => [
                    'rules' => 'required',
                    'label' => 'Suburb'
                ]
            ];
    
            if ($this->validate($validationRules)) {
                $nullIfEmpty = true;
                $postData = $this->request->getPost();
                $locale = $this->request->getLocale();
                $sanitizedData = $this->sanitized($postData, $nullIfEmpty);
                foreach ($postData as $k => $v) {
                    if ($k == 'created_by' && $loggedInUsername !== null) {
                        $sanitizedData[$k] = $loggedInUsername;
                    } else {
                        $sanitizationResult = goSanitize($v);
                        $sanitizedData[$k] = $sanitizationResult[0];
                    }
                }
    
                $noException = true;
                $successfulResult = false;
                
                if ($this->canValidate()) {
                    try {
                        $successfulResult = $this->model->skipValidation(true)->save($sanitizedData);
                    } catch (\Exception $e) {
                        $noException = false;
                        $this->dealWithException($e);
                    }
    
                    if ($noException && $successfulResult) {
                        $id = $this->model->db->insertID();
                        $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('PostcodeAustraliaLists.postcodeAustraliaList'))]) . '.';
                        $message .= anchor(base_url("{$locale}/admin/postcode-australia-lists/{$id}/edit"), lang('Basic.global.continueEditing') . '?');
                        $message = ucfirst(str_replace("'", "\'", $message));
    
                        $thenRedirect = true; // Change this if you want your user to stay on the form after submission
                        if ($thenRedirect) {
                            if (!empty($this->indexRoute)) {
                                return redirect()->to(base_url().route_to($this->indexRoute))->with('sweet-success', $message);
                            } else {
                                return $this->redirect2listView('sweet-success', $message);
                            }
                        } else {
                            $this->session->setFlashData('sweet-success', $message);
                        }
                    }
                } else {
                    $this->session->setFlashdata('errorMessage', lang('Basic.global.formErr1', [mb_strtolower(lang('PostcodeAustraliaLists.postcodeAustraliaList'))]));
                    $this->session->setFlashdata('formErrors', $this->model->errors());
                    return redirect()->back()->withInput();
                }
            } else {
                // Data is not valid, handle validation errors
                $this->viewData['validationErrors'] = $this->validator->getErrors();
                $this->viewData['oldInput'] = $this->request->getPost();
            }
        }
    
        $timezoneConverter = new TimezoneConverter();
        $userId = user_id();
        $formatted_created_at = $timezoneConverter->convertToUserTimezone(null, $userId, 'created_at', 'PostcodeAustraliaListModel');
        $postcodeAustraliaList = new PostcodeAustraliaList();
        
        $this->viewData['postcodeAustraliaList'] = isset($sanitizedData) ? new PostcodeAustraliaList($sanitizedData) : new PostcodeAustraliaList();
        $this->viewData['timezoneList'] = $this->getTimezoneListItems($postcodeAustraliaList->timezone ?? null);
        $this->viewData['stateList'] = $this->getStateListItems($postcodeAustraliaList->state ?? null);
        $this->viewData['oldInput'] = $this->request->getPost();
        $this->viewData['formAction'] = base_url().route_to('createPostcodeAustraliaList');
        $this->viewData['boxTitle'] = lang('Basic.global.addNew').' '.lang('PostcodeAustraliaLists.moduleTitle').' '.lang('Basic.global.addNewSuffix');
    
        return $this->displayForm(__METHOD__);
    } // end function add
    

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

        if ($requestedId == null) :
            return $this->redirect2listView();
        endif;

        $loggedInUsername = null;

        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table
        }
    
        $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table


        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $postcodeAustraliaList = $this->model->find($id);

        if ($postcodeAustraliaList == false) :
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('PostcodeAustraliaLists.postcodeAustraliaList')), $id]);
            return $this->redirect2listView('sweet-error', $message);
        endif;

        $requestMethod = $this->request->getMethod();

        if ($requestMethod === 'post') :

            $nullIfEmpty = true; // !(phpversion() >= '8.1');
        
            $postData = $this->request->getPost();
            $locale = $this->request->getLocale();
            			$sanitizedData = $this->sanitized($postData, $nullIfEmpty);

            $noException = true;
            $successfulResult = false; // for now

            	if ($this->canValidate()) :
            	    try {
            	        $successfulResult = $this->model->skipValidation(true)->update($id, $sanitizedData);
            	    } catch (\Exception $e) {
            	        $noException = false;
            	        $this->dealWithException($e);
            	    }
            	else:
            	    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('PostcodeAustraliaLists.postcodeAustraliaList'))]);
            	    $this->session->setFlashdata('formErrors', $this->model->errors());
            	
            	endif;
            	
            	$postcodeAustraliaList->fill($sanitizedData);

            	$thenRedirect = true;
            
            if ($noException && $successfulResult) :
                $id = $postcodeAustraliaList->id ?? $id;
                $message = lang('Basic.global.updateSuccess', [mb_strtolower(lang('PostcodeAustraliaLists.postcodeAustraliaList'))]).'.';
                $message .= anchor(base_url( "{$locale}/admin/postcode-australia-lists/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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
        endif; // ($requestMethod === 'post')

        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
          // Convert the 'updated_at' field for crop type to the user's local timezone
          if ($postcodeAustraliaList) {
            $postcodeAustraliaList->created_at = $timezoneConverter->convertToUserTimezone($postcodeAustraliaList->id, $userId,'created_at','PostcodeAustraliaListModel');
            $postcodeAustraliaList->updated_at = $timezoneConverter->convertToUserTimezone($postcodeAustraliaList->id, $userId,'updated_at','PostcodeAustraliaListModel');
        }
        $state_data = $this->model->getstatebytimezone($postcodeAustraliaList->timezone);
        $postcodeAustraliaList->state_id = $state_data[0]->state;
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['postcodeAustraliaList'] = $postcodeAustraliaList;
        $this->viewData['oldInput'] = $this->request->getPost();
		$this->viewData['timezoneList'] = $this->getTimezoneListItems($postcodeAustraliaList->timezone ?? null);
		$this->viewData['stateList'] = $this->getStateListItems($postcodeAustraliaList->state ?? null);
        $this->viewData['formAction'] = base_url().route_to('updatePostcodeAustraliaList', $id);
        $this->viewData['boxTitle'] = lang('Basic.global.edit2').' '.lang('PostcodeAustraliaLists.moduleTitle').' '.lang('Basic.global.edit3');
        
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
            $order = PostcodeAustraliaListModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
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

    public function allItemsSelect() {
        if ($this->request->isAJAX()) {
            $onlyActiveOnes = true;
            $reqVal = $this->request->getPost('val') ?? 'id';
            $menu = $this->model->getAllForMenu($reqVal.', suburb', 'suburb', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->suburb = '- '.lang('Basic.global.None').' -';
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
            $columns2select = [$reqId ?? 'id', $reqText ?? 'suburb'];
            $onlyActiveOnes = false;
            $statenumber= goSanitize($this->request->getPost('statenumber'))[0];
            $menu = $this->model->getSelect2MenuItemsBystate($statenumber,$columns2select, $columns2select[1], $onlyActiveOnes, $searchStr);
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


	protected function getTimezoneListItems($selId = null) { 
		$data = [''=>lang('Basic.global.pleaseSelectA', [mb_strtolower(lang('Timezones.timezone'))])];
        $timezoneModel = model('App\Models\Admin\TimezoneModel');
            $selOption = $timezoneModel->findColumn('timezone');
            if (!empty($selOption)) :
                $data[] = $selOption;
            endif;
		return $data;
	}

}
