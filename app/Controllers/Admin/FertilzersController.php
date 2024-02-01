<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Entities\Admin\Fertilzer;

use App\Models\Admin\CategoryModel;

use App\Models\Admin\FertilzerModel;

use App\Libraries\TimezoneConverter;

class FertilzersController extends GoBaseResourceController { 

    protected $modelName = FertilzerModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Fertilzer';
    protected static $singularObjectNameCc = 'fertilzer';
    protected static $pluralObjectName = 'Fertilzers';
    protected static $pluralObjectNameCc = 'fertilzers';

    protected static $controllerSlug = 'fertilzers';

    protected static $viewPath = 'admin/fertilzerViews/';

    protected $indexRoute = 'fertilzerList';

     protected $timezoneConverter;

    
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('Fertilzers.moduleTitle');
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
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('Fertilzers.fertilzer')]),
                'fertilzer' => new Fertilzer(),
                'usingServerSideDataTable' => true,
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class

        return view(static::$viewPath.'viewFertilzerList', $viewData);
    }


    public function add() {
    
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }
    
        $loggedInUsername = null;
        $fertilzers = new Fertilzer();
    
        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; 
        }
    
        $requestMethod = $this->request->getMethod();
    
        if ($requestMethod === 'post') {
    
            // Define validation rules
            $validationRules = [
                'fertilzer' => [
                    'rules' => 'required',
                    'label' => 'Fertilzer'
                ]
                // Add other validation rules as needed
            ];
    
            if ($this->validate($validationRules)) {
                $postData = $this->request->getPost();
                $locale = $this->request->getLocale();
                $sanitizedData = [];
    
                // Define an array of specific fields to handle
                $specificFields = ['nitrogen', 'phosphorus', 'potassium', 'calcium', 'sulfur', 'magnesium', 'maganense', 'boron'];
    
                foreach ($postData as $k => $v) {
                    if (in_array($k, $specificFields)) {
                        // Validate the value as a floating-point number
                        $value = filter_var($v, FILTER_VALIDATE_FLOAT);
                        if ($value !== false && $value > 0) {
                            $sanitizedData[$k] = $value;
                        } else {
                            continue; // Skip adding the field if it's invalid or zero
                        }
                    } else {
                        // Process other fields as usual
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
                } else {
                    $this->session->setFlashdata('errorMessage', lang('Basic.global.formErr1', [mb_strtolower(lang('Fertilzers.fertilzer'))]));
                    $this->session->setFlashdata('formErrors', $this->model->errors());
    
                    return redirect()->back()->withInput();
                }
    
                $thenRedirect = true;
    
                if ($noException && $successfulResult) {
                    $id = $this->model->db->insertID();
                    $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('Fertilzers.fertilzer'))]).'.';
                    $message .= anchor(base_url( "{$locale}/admin/fertilzers/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
                    $message = ucfirst(str_replace("'", "\'", $message));
    
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
                $this->viewData['validationErrors'] = $this->validator->getErrors();
                $this->viewData['oldInput'] = $this->request->getPost();
            }
        }
    
        $timezoneConverter = new TimezoneConverter();
        $userId = user_id();
        $formatted_created_at = $timezoneConverter->convertToUserTimezone(null, $userId, 'created_at', 'FertilzerModel');
        $this->viewData['formatted_created_at'] = $formatted_created_at;
    
        $this->viewData['fertilzer'] = isset($sanitizedData) ? new Fertilzer($sanitizedData) : new Fertilzer();
		$this->viewData['categoryList'] = $this->getCategoryListItems($fertilzer->category ?? null);
    
        $this->viewData['formAction'] = base_url().route_to('createFertilzer');
    
        $this->viewData['boxTitle'] = lang('Basic.global.addNew').' '.lang('Fertilzers.moduleTitle').' '.lang('Basic.global.addNewSuffix');
        $this->viewData['oldInput'] = $this->request->getPost();
    
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
        $fertilzer = $this->model->find($id); // Change this reference

        if ($fertilzer == false) : // Change this reference
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('Fertilzers.fertilzer')), $id]); // Change this reference
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
            	    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('Fertilzers.fertilzer'))]); // Change this reference
            	    $this->session->setFlashdata('formErrors', $this->model->errors());
            	
            	endif;
            	
            	$fertilzer->fill($sanitizedData); // Change this reference
               
            	$thenRedirect = true;
                if ($noException && $successfulResult) :
                    $id = $fertilzer->id ?? $id;
                    $message = lang('Basic.global.updateSuccess', [mb_strtolower(lang('Fertilzers.fertilzer'))]).'.';
                    $message .= anchor(base_url( "{$locale}/admin/fertilzers/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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
          if ($fertilzer ) {  // Change this reference
            $fertilzer->created_at = $timezoneConverter->convertToUserTimezone($fertilzer->id, $userId,'created_at','FertilzerModel'); // Change this reference
            $fertilzer->updated_at = $timezoneConverter->convertToUserTimezone($fertilzer->id, $userId,'updated_at','FertilzerModel'); // Change this reference
        }
        $this->viewData['oldInput'] = $this->request->getPost();
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['fertilzer'] = $fertilzer;
		$this->viewData['categoryList'] = $this->getCategoryListItems($fertilzer->category ?? null);

        $this->viewData['formAction'] = base_url().route_to('updateFertilzer', $id);

        $this->viewData['boxTitle'] = lang('Basic.global.edit2').' '.lang('Fertilzers.moduleTitle').' '.lang('Basic.global.edit3');
         
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
            $order = FertilzerModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
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
            $menu = $this->model->getAllForMenu($reqVal.', fertilzer', 'fertilzer', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->fertilzer = '- '.lang('Basic.global.None').' -';
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
            $columns2select = [$reqId ?? 'id', $reqText ?? 'fertilzer'];
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


	protected function getCategoryListItems($selId = null) { 
		$data = [''=>lang('Basic.global.pleaseSelectA', [mb_strtolower(lang('Categories.category'))])];
        if (!empty($selId)) :
            		$categoryModel = model('App\Models\Admin\CategoryModel');

            $selOption = $categoryModel->where('id', $selId)->findColumn('category');
            if (!empty($selOption)) :
                $data[$selId] = $selOption[0];
            endif;
        endif;
		return $data;
	}

}
