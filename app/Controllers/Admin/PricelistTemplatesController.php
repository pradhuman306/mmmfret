<?php  namespace App\Controllers\Admin;


use App\Controllers\GoBaseResourceController;

use App\Models\Collection;

use App\Entities\Admin\PricelistTemplate;

use App\Models\Admin\PricelistTemplateModel;

class PricelistTemplatesController extends \App\Controllers\GoBaseResourceController { 

    protected $modelName = PricelistTemplateModel::class;
    protected $format = 'json';

    protected static $singularObjectName = 'Price List Template';
    protected static $singularObjectNameCc = 'priceListTemplate';
    protected static $pluralObjectName = 'Price List Templates';
    protected static $pluralObjectNameCc = 'priceListTemplates';

    protected static $controllerSlug = 'pricelist-templates';

    protected static $viewPath = 'admin/pricelistTemplateViews/';

    protected $indexRoute = 'priceListTemplateList';

    

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('PricelistTemplates.moduleTitle');
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
                'pageSubTitle' => lang('Basic.global.ManageAllRecords', [lang('PricelistTemplates.priceListTemplate')]),
                'pricelistTemplate' => new PricelistTemplate(),
                'usingServerSideDataTable' => true,
                
            ];

        $viewData = array_merge($this->viewData, $viewData); // merge any possible values from the parent controller class

        return view(static::$viewPath.'viewPriceListTemplateList', $viewData);
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
					$this->viewData['errorMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('PricelistTemplates.priceListTemplate'))]);
						$this->session->setFlashdata('formErrors', $this->model->errors());
				endif;
            
            $thenRedirect = true;  // Change this to false if you want your user to stay on the form after submission
            
            if ($noException && $successfulResult) :

                $id = $this->model->db->insertID();

                $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('PricelistTemplates.priceListTemplate'))]).'.';
                $message .= anchor(base_url( "{$locale}/admin/pricelist-templates/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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

        $this->viewData['pricelistTemplate'] = isset($sanitizedData) ? new PricelistTemplate($sanitizedData) : new PricelistTemplate();

        $this->viewData['formAction'] = base_url().route_to('createPriceListTemplate');

        $this->viewData['boxTitle'] = lang('Basic.global.addNew').' '.lang('PricelistTemplates.moduleTitle').' '.lang('Basic.global.addNewSuffix');
        

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
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $pricelistTemplate = $this->model->find($id);

        if ($pricelistTemplate == false) :
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('PricelistTemplates.priceListTemplate')), $id]);
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
            	    $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('PricelistTemplates.priceListTemplate'))]);
            	    $this->session->setFlashdata('formErrors', $this->model->errors());
            	
            	endif;
            	
            	$pricelistTemplate->fill($sanitizedData);

            	$thenRedirect = true;
            
            if ($noException && $successfulResult) :
                $id = $pricelistTemplate->id ?? $id;
                $message = lang('Basic.global.updateSuccess', [mb_strtolower(lang('PricelistTemplates.priceListTemplate'))]).'.';
                $message .= anchor(base_url( "{$locale}/admin/pricelist-templates/{$id}/edit" ), lang('Basic.global.continueEditing').'?');
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

        $this->viewData['pricelistTemplate'] = $pricelistTemplate;

        		$this->viewData['formAction'] = base_url().route_to('updatePriceListTemplate', $id);

        $this->viewData['boxTitle'] = lang('Basic.global.edit2').' '.lang('PricelistTemplates.moduleTitle').' '.lang('Basic.global.edit3');
        
        
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
            $order = PricelistTemplateModel::SORTABLE[$requestedOrder > 0 ? $requestedOrder : 1];
            $dir = $reqData['order']['0']['dir'] ?? 'asc';

            $resourceData = $this->model->getResource($search)->orderBy($order, $dir)->limit($length, $start)->get()->getResultObject();
			foreach ($resourceData as $item) :
if (isset($item->details) && strlen($item->details) > 100) :
    $item->details = character_limiter($item->details, 100);
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
            $menu = $this->model->getAllForMenu($reqVal.', details', 'details', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->details = '- '.lang('Basic.global.None').' -';
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
            $columns2select = [$reqId ?? 'id', $reqText ?? 'details'];
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