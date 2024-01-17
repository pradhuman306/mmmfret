<?php

namespace App\Controllers;

use Myth\Auth\Entities\User;
use App\Models\UserModel;

class UserProfileController extends GoBaseController
{

    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index() {

        if (!logged_in()) {
            return redirect()->to('login')->with('warningMessage', lang('Auth.notLoggedIn'));
        }
        $user = user();

        if ($this->request->getMethod() === 'post') {
            $id = user()->id;
            $validationRules = [
                'email'        => "required|valid_email|is_unique[users.email,id,$id]",
                'username'     => "required|alpha_numeric_space|min_length[3]|is_unique[users.username,id,$id]",
                'password'     => 'if_exist',
                'pass_confirm' => 'required_with[password]|matches[password]',
            ];

            if (!$this->validate($validationRules)) {
                $errMsg = implode($this->validator->getErrors());
                return redirect()->back()->withInput()->with('error', $errMsg);
            }

            $postData = $this->request->getPost();
            $sanitizedData = $this->sanitized($postData);

            $sanitizedData['active'] = true;

        // if ($this->request->getPost('force_pass_reset') == null ) {
            $sanitizedData['force_pass_reset'] = false;
        // }


            if ($this->request->getPost('password')) {
                $user->password = $this->request->getPost('password');
                unset($sanitizedData['password']);
            }

            if (!empty($sanitizedData)) {
                $user->fill($sanitizedData);
            }

            $successMessage = lang('Basic.global.updateSuccess', [mb_strtolower(lang('Users.user'))]).'.';
            $errorMessage = lang('Basic.global.persistErr2', [mb_strtolower(lang('Users.user'))]);

            if ($this->userModel->skipValidation(true)->update(user()->id, $user)) {
                return redirect()->to(route_to('user-profile') )->with('message', $successMessage);
            }

            return redirect()->to(route_to('user-profile') )->withInput()->with('error', $errorMessage);
        }

        $hasFirstName = false;
        $hasLastName = false;
        if (isset($user->first_name) && !empty($user->first_name)) {
            $firstName = trim($user->first_name);
            $hasFirstName = true;
        }
        if (isset($user->last_name) && !empty($user->last_name)) {
            $lastName = trim($user->last_name);
            $hasLastName = true;
        }
        $this->viewData['firstName'] = $firstName ?? '';
        $this->viewData['lastName'] = $lastName ?? '';
        $this->viewData['userPic'] = site_url(isset($user->picture) && !empty($user->picture) ? $user->picture : '/assets/generic-user-avatar.png');
        $this->viewData['title'] = lang('Basic.global.profile');
        $this->viewData['userName'] = ($hasFirstName || $hasLastName) && method_exists($user,'getFullName') ? $user->getFullName() : $user->username;
        $this->viewData['joinDate'] = user()->created_at->toLocalizedString('MMM d, yyyy'); // . ' ' . user()->created_at->humanize() ;

		 $this->viewData['validation'] = \Config\Services::validation();

        return view('authViews/profile', $this->viewData);
    }


}