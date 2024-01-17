<?php

namespace App\Libraries;

use App\Models\Admin\CropTypeModel;
use App\Models\Admin\CompanyModel;

class TimezoneConverter
{
    protected $userModel;
    protected $cropTypeModel;  
    protected $companyModel;
    public function __construct()
    {
        // Load required models
        $this->userModel = new \App\Models\UserModel();
        $this->cropTypeModel = new CropTypeModel();
        $this->companyModel = new CompanyModel();
    }


    public function getLoggedInUsername() 
    {
        try {
            $userId = user_id(); // Get the logged-in user's ID
            $user = $this->userModel->find($userId);
            return $user ? $user->username : null; 
        } catch (\Throwable $th) {
            return  null; 
        }
       
    }

    public function convertToUserTimezone($recordId, $userId, $field = 'updated_at', $model = null)
{
    $userTimezone = $this->userModel->getUserTimeZone($userId);
    if ($model == null) {
        $model = $this->cropTypeModel;
    } else {
        // Load the model dynamically -- Pradhuman
        $model = model('App\Models\Admin\\' . $model);
        // Access the loaded model
    }

    if ($recordId) {
        $record = $model->find($recordId);
        $datefield = ($field == 'updated_at') ? $record->updated_at : $record->created_at;

        if (!$record || empty($datefield)) {
            return null; // Or handle as per your application's logic
        }

        $utcTime = new \DateTime($datefield, new \DateTimeZone('UTC'));  // For Updated_at
    } else {
        $utcTime = new \DateTime(date("Y-m-d H:i:s"), new \DateTimeZone('UTC'));  // For Created_at
    }

    $utcTime->setTimeZone(new \DateTimeZone($userTimezone));
    return $utcTime->format('Y-m-d\TH:i');
}

}
