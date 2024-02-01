<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Entities\Admin\WaterRate;

use App\Models\Admin\WaterRateModel;

use App\Libraries\TimezoneConverter;

class WaterRatesController extends \App\Controllers\GoBaseResourceController { 

    protected $modelName = WaterRateModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Water Rate';
    protected static $singularObjectNameCc = 'waterRate';
    protected static $pluralObjectName = 'Water Rates';
    protected static $pluralObjectNameCc = 'waterRates';

    protected static $controllerSlug = 'water-rates';

    protected static $viewPath = 'admin/waterRateViews/';

    protected $indexRoute = 'waterRateList';

    protected $timezoneConverter;
    

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('WaterRates.moduleTitle');
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
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('WaterRates.waterRate')]),
                'waterRate' => new WaterRate(),
                'usingServerSideDataTable' => true,
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class

        return view(static::$viewPath.'viewWaterRateList', $viewData);
    }

    public function add() {
        
        if ( !logged_in() ) {
			return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
		}
		if ( !in_groups('admin') ) {
			return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
		}

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
						$successfulResult = $this->model->skipValidation(true)->save($sanitizedData);
					} catch (\Exception $e) {
						$noException = false;
						$this->dealWithException($e);
					}
				else:
                    $this->viewData['errorMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('WaterRates.waterRate'))]);
						$this->session->setFlashdata('formErrors', $this->model->errors());
				endif;
            
            $thenRedirect = true;  // Change this to false if you want your user to stay on the form after submission
            
            if ($noException && $successfulResult) :

                $id = $this->model->db->insertID();

                $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('WaterRates.waterRate'))]).'.';
                $message .= anchor(base_url( "{$locale}/admin/water-rates/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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

        $this->viewData['waterRate'] = isset($sanitizedData) ? new WaterRate($sanitizedData) : new WaterRate();
        $this->viewData['formAction'] = base_url().route_to('createWaterRate');
        $this->viewData['boxTitle'] = lang('Basic.global.addNew').' '.lang('WaterRates.moduleTitle').' '.lang('Basic.global.addNewSuffix');
        
        return $this->displayForm(__METHOD__);
    } // end function add()

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
        $waterRate = $this->model->find($id); // Change this reference

        if ($waterRate == false) : // Change this reference
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('WaterRates.waterRate')), $id]);
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
                    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('WaterRates.waterRate'))]);
                    $this->session->setFlashdata('formErrors', $this->model->errors());
            	
            	endif;
            	
            	$waterRate->fill($sanitizedData); // Change this reference
               
            	$thenRedirect = true;
                if ($noException && $successfulResult) :
                    $id = $waterRate->id ?? $id;
                    $message = lang('Basic.global.updateSuccess', [mb_strtolower(lang('WaterRates.waterRate'))]).'.';
                    $message .= anchor(base_url( "{$locale}/admin/water-rates/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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
          if ($waterRate) {  // Change this reference
            $waterRate->created_at = $timezoneConverter->convertToUserTimezone($waterRate->id, $userId,'created_at','WaterRateModel'); // Change this reference
            $waterRate->updated_at = $timezoneConverter->convertToUserTimezone($waterRate->id, $userId,'updated_at','WaterRateModel'); // Change this reference
        }
            $this->viewData['loggedInUsername'] = $loggedInUsername;
            $this->viewData['waterRate'] = $waterRate;
            $this->viewData['formAction'] = base_url().route_to('updateWaterRate', $id);
            $this->viewData['boxTitle'] = lang('Basic.global.edit2').' '.lang('WaterRates.moduleTitle').' '.lang('Basic.global.edit3');
        
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
            $order = WaterRateModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
            $dir = $reqData['order']['0']['dir'] ?? 'asc';

            $resourceData = $this->model->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject();
			foreach ($resourceData as $item) :
if (isset($item->updated_by) && strlen($item->updated_by) > 100) :
    $item->updated_by = character_limiter($item->updated_by, 100);
endif;if (isset($item->created_by) && strlen($item->created_by) > 100) :
    $item->created_by = character_limiter($item->created_by, 100);
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
            $menu = $this->model->getAllForMenu($reqVal.', rate', 'rate', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->rate = '- '.lang('Basic.global.None').' -';
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
            $columns2select = [$reqId ?? 'id', $reqText ?? 'rate'];
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