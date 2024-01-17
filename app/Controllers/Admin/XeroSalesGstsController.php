<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Entities\Admin\XeroSalesGst;

use App\Models\Admin\XeroSalesGstModel;

use App\Libraries\TimezoneConverter;

class XeroSalesGstsController extends GoBaseResourceController { 

    protected $modelName = XeroSalesGstModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Xero Sales Gst';
    protected static $singularObjectNameCc = 'xeroSalesGst';
    protected static $pluralObjectName = 'Xero Sales Gsts';
    protected static $pluralObjectNameCc = 'xeroSalesGsts';

    protected static $controllerSlug = 'xero-sales-gsts';

    protected static $viewPath = 'admin/xeroSalesGstViews/';

    protected $indexRoute = 'xeroSalesGstList';

    protected $timezoneConverter;

  
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('XeroSalesGsts.moduleTitle');
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
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('XeroSalesGsts.xeroSalesGst')]),
                'xeroSalesGst' => new XeroSalesGst(),
                'usingServerSideDataTable' => true,
           
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class
        $timezoneConverter = new TimezoneConverter();
        $this->viewData['timezoneConverter'] = $timezoneConverter;

        return view(static::$viewPath.'viewXeroSalesGstList', $viewData);
    }

    public function add() {
    
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }
    
        $loggedInUsername = null;
        $xeroSalesGsts = new XeroSalesGst();
    
        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; 
        }
    
        $requestMethod = $this->request->getMethod();
    
        if ($requestMethod === 'post') {
    
            // Define validation rules
            $validationRules = [
                'type' => [
                    'rules' => 'required',
                    'label' => 'Type' // Show label name
                ],
                'xero_code' => [
                    'rules' => 'required',
                    'label' => 'Xero Code' // Show label name
                ]
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
    
                $noException = true;
                $successfulResult = false; // for now
    
                if ($this->canValidate()) {
                    try {
                        $successfulResult = $this->model->skipValidation(true)->save($sanitizedData);
                    } catch (\Exception $e) {
                        $noException = false;
                        $this->dealWithException($e);
                    }
                } else {
                    // Store the error message and form errors in the session
                    $this->session->setFlashdata('errorMessage', lang('Basic.global.formErr1', [mb_strtolower(lang('XeroSalesGsts.xeroSalesGst'))]));
                    $this->session->setFlashdata('formErrors', $this->model->errors());
                
                    // Redirect back to the form with old input values
                    return redirect()->back()->withInput();
                }
    
                $thenRedirect = true;  // Change this to false if you want your user to stay on the form after submission
                
                if ($noException && $successfulResult) {
                    $id = $this->model->db->insertID();
                    $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('XeroSalesGsts.xeroSalesGst'))]) . '.';
                    $message .= anchor(base_url("{$locale}/admin/xero-sales-gsts/{$id}/edit"), lang('Basic.global.continueEditing') . '?');
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
                // Data is not valid, handle validation errors
                $this->viewData['validationErrors'] = $this->validator->getErrors();
                $this->viewData['oldInput'] = $this->request->getPost();
            }
        }
    
        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
        $formatted_created_at = $timezoneConverter->convertToUserTimezone(null, $userId, 'created_at', 'XeroSalesGstModel');
        $this->viewData['formatted_created_at'] = $formatted_created_at;
    
        $this->viewData['xeroSalesGst'] = isset($sanitizedData) ? new XeroSalesGst($sanitizedData) : new XeroSalesGst();
    
        $this->viewData['formAction'] = base_url().route_to('createXeroSalesGst');
    
        $this->viewData['boxTitle'] = lang('Basic.global.addNew') . ' ' . lang('XeroSalesGsts.moduleTitle') . ' ' . lang('Basic.global.addNewSuffix');
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
            $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table
        }
    
        $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table

        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $xeroSalesGst = $this->model->find($id);

        if ($xeroSalesGst == false) :
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('XeroSalesGsts.xeroSalesGst')), $id]);
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
            	    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('XeroSalesGsts.xeroSalesGst'))]);
            	    $this->session->setFlashdata('formErrors', $this->model->errors());
            	
            	endif;
            	
            	$xeroSalesGst->fill($sanitizedData);
               
            	$thenRedirect = true;
            
            if ($noException && $successfulResult) :
                $id = $xeroSalesGst->id ?? $id;
                $message = lang('Basic.global.updateSuccess', [mb_strtolower(lang('XeroSalesGsts.xeroSalesGst'))]).'.';
                $message .= anchor(base_url( "{$locale}/admin/xero-sales-gsts/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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
          if ($xeroSalesGst) {
            $xeroSalesGst->created_at = $timezoneConverter->convertToUserTimezone($xeroSalesGst->id, $userId,'created_at','XeroSalesGstModel');
            $xeroSalesGst->updated_at = $timezoneConverter->convertToUserTimezone($xeroSalesGst->id, $userId,'updated_at','XeroSalesGstModel');
        }
        $this->viewData['oldInput'] = $this->request->getPost();
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['xeroSalesGst'] = $xeroSalesGst;
   		$this->viewData['formAction'] = base_url().route_to('updateXeroSalesGst', $id);
        $this->viewData['boxTitle'] = lang('Basic.global.edit2').' '.lang('XeroSalesGsts.moduleTitle').' '.lang('Basic.global.edit3');
        
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
            $order = XeroSalesGstModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
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
            $menu = $this->model->getAllForMenu($reqVal.', type', 'type', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->type = '- '.lang('Basic.global.None').' -';
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
            $columns2select = [$reqId ?? 'id', $reqText ?? 'type'];
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

}
