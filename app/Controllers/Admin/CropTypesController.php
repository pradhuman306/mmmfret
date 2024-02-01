<?php  
namespace App\Controllers\Admin;

use App\Controllers\GoBaseResourceController;

use App\Entities\Admin\CropType;
use Myth\Auth\Models\User;
use App\Libraries\TimezoneConverter;


class CropTypesController extends \App\Controllers\GoBaseController { 

	use \CodeIgniter\API\ResponseTrait;

    protected static $primaryModelName = 'App\Models\Admin\CropTypeModel';

    protected static $singularObjectNameCc = 'cropType';
    protected static $singularObjectName = 'Crop Type';
    protected static $pluralObjectName = 'Crop Types';
    protected static $controllerSlug = 'crop-types';

    protected static $viewPath = 'admin/cropTypeViews/';

    protected $indexRoute = 'cropTypeList';

    protected $timezoneConverter;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger) {
        $this->viewData['pageTitle'] = lang('CropTypes.moduleTitle');
        parent::initController($request, $response, $logger);
                 $this->viewData['usingSweetAlert'] = true;

         if (session('errorMessage')) {
            $this->session->setFlashData('sweet-error', session('errorMessage'));
         }
         if (session('successMessage')) {
            $this->session->setFlashData('sweet-success', session('successMessage'));
         }
    }

    public function index() {
        if ( !logged_in() ) {
			return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
		}
		if ( !in_groups('admin') ) {
			return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
		}
        $this->viewData['usingClientSideDataTable'] = true;
        $timezoneConverter = new TimezoneConverter();
        $this->viewData['timezoneConverter'] = $timezoneConverter;
        $this->viewData['userId'] = user_id();       
		$this->viewData['pageSubTitle'] = lang('Basic.global.ManageAllRecords', [lang('CropTypes.cropType')]);
        parent::index();

    }
    public function add() {
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }

        $loggedInUsername = null;

        $cropType = new CropType(); // Replace 'CropType' with the actual class name you are working with
    
        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table
        }
    
        $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table

        $requestMethod = $this->request->getMethod();
        if ($requestMethod === 'post') {
            $nullIfEmpty = true; // !(phpversion() >= '8.1');
    
            $postData = $this->request->getPost();
            $sanitizedData = [];
        foreach ($postData as $k => $v) {
            // Use logged-in username for 'created_by' field, if user is logged in
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
                $this->viewData['errorMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('CropTypes.cropType'))]);
                $this->session->setFlashdata('formErrors', $this->model->errors());
            }
    
            $thenRedirect = true; // Change this to false if you want your user to stay on the form after submission
    
            if ($noException && $successfulResult) {
                $id = $this->model->db->insertID();
    
                $message = lang('Basic.global.saveSuccess', [mb_strtolower(lang('CropTypes.cropType'))]) . '.';
                $message .= anchor(route_to('editCropType', $id), lang('Basic.global.continueEditing') . '?');
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
        }

        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
        $formatted_created_at = $timezoneConverter->convertToUserTimezone(null, $userId,'created_at');
        $this->viewData['formatted_created_at'] = $formatted_created_at;
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['cropType'] = isset($sanitizedData) ? new CropType($sanitizedData) : new CropType();
        $this->viewData['formAction'] = base_url().route_to('createCropType');
        $this->viewData['boxTitle'] = lang('Basic.global.addNew') . ' ' . lang('CropTypes.cropType') . ' ' . lang('Basic.global.addNewSuffix');
    
        return $this->displayForm(__METHOD__);
    }

    
    public function edit($requestedId = null) {
        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        if (!in_groups('admin')) {
            return redirect()->back()->with('errorMessage', lang('Auth.notEnoughPrivilege'));
        }
        if ($requestedId == null) {
            return $this->redirect2listView();
        }
        $loggedInUsername = null;

        $auth = service('authentication');
        $user = $auth->user();
        if ($user) {
            $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table
        }
    
        $loggedInUsername = $user->username; // Replace 'username' with the actual field name in your user table
    
        $id = filter_var($requestedId, FILTER_SANITIZE_URL);
        $cropType = $this->model->find($id);
    
        if ($cropType == false) {
            $message = lang('Basic.global.notFoundWithIdErr', [mb_strtolower(lang('CropTypes.cropType')), $id]);
            return $this->redirect2listView('sweet-error', $message);
        }
    
        $requestMethod = $this->request->getMethod();
    
        if ($requestMethod === 'post') {
            $nullIfEmpty = true; // !(phpversion() >= '8.1');
            $postData = $this->request->getPost();
            $sanitizedData = [];
    
            // Use logged-in username for 'updated_by' field, if the user is logged in
            foreach ($postData as $k => $v) {
                if ($k == 'updated_by' && $loggedInUsername !== null) {
                    $sanitizedData[$k] = $loggedInUsername;
                } else {
                    $sanitizationResult = goSanitize($v);
                    $sanitizedData[$k] = $sanitizationResult[0];
                }
            }
    
            if ($this->request->getPost('active') == null) {
                $sanitizedData['active'] = false;
            }
    
            $noException = true;
            $successfulResult = false; // for now
    
            if ($this->canValidate()) {
                try {
                    $successfulResult = $this->model->skipValidation(true)->update($id, $sanitizedData);
                } catch (\Exception $e) {
                    $noException = false;
                    $this->dealWithException($e);
                }
            } else {
                $this->viewData['warningMessage'] = lang('Basic.global.formErr1', [mb_strtolower(lang('CropTypes.cropType'))]);
                $this->session->setFlashdata('formErrors', $this->model->errors());
            }
    
            $cropType->fill($sanitizedData);
    
            $thenRedirect = true;
    
            if ($noException && $successfulResult) {
                $id = $cropType->id ?? $id;
                $message = lang('Basic.global.updateSuccess', [mb_strtolower(lang('CropTypes.cropType'))]) . '.';
                $message .= anchor(route_to('editCropType', $id), lang('Basic.global.continueEditing') . '?');
                $message = ucfirst(str_replace("'", "\'", $message));
    
                if ($thenRedirect) {
                    if (!empty($this->indexRoute)) {
                        return redirect()->to(base_url() . route_to($this->indexRoute))->with('sweet-success', $message);
                    } else {
                        return $this->redirect2listView('sweet-success', $message);
                    }
                } else {
                    $this->session->setFlashData('sweet-success', $message);
                }
            }
        }
    
        $timezoneConverter = new TimezoneConverter();
        $userId = user_id(); // Get the logged-in user's ID
    
        // Convert the 'updated_at' field for crop type to the user's local timezone
        if ($cropType) {
            $cropType->created_at = $timezoneConverter->convertToUserTimezone($cropType->id, $userId,'created_at');
            $cropType->updated_at = $timezoneConverter->convertToUserTimezone($cropType->id, $userId,'updated_at');
        }
        
        $this->viewData['loggedInUsername'] = $loggedInUsername;
        $this->viewData['cropType'] = $cropType;
        $this->viewData['formAction'] = base_url() . route_to('updateCropType', $id);
        $this->viewData['boxTitle'] = lang('Basic.global.edit2') . ' ' . lang('CropTypes.cropType') . ' ' . lang('Basic.global.edit3');
       
    
        return $this->displayForm(__METHOD__, $id);
    } // end function edit(...)
    
    
    

    public function allItemsSelect() {
        if ($this->request->isAJAX()) {
            $onlyActiveOnes = true;
            $reqVal = $this->request->getPost('val') ?? 'id';
            $menu = $this->model->getAllForMenu($reqVal.', crop_type', 'crop_type', $onlyActiveOnes, false);
            $nonItem = new \stdClass;
            $nonItem->id = '';
            $nonItem->crop_type = '- '.lang('Basic.global.None').' -';
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
            $columns2select = [$reqId ?? 'id', $reqText ?? 'crop_type'];
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
