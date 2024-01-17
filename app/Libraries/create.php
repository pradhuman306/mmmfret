<?php

namespace App\Libraries;

use App\Libraries\TimezoneConverter;
class create
{

    public function index() 
    {
       $uri = service('uri');
       $isAddPage = strpos($uri->getPath(), 'add') !== false;
       $isEditPage = strpos($uri->getPath(), 'edit') !== false;
       $userId = user_id();
       $TimezoneConverter = new TimezoneConverter();
       $date = $TimezoneConverter->convertToUserTimezone(false, $userId,$field='created_at');
       ?>
       <script>
       
       function setReadOnlyField(fieldId) {
           var field = document.getElementById(fieldId);
           if (field) field.readOnly = true;
       }
       
       function setFieldsForAddPage() {
           var createdAtField = document.getElementById('createdAt');

           if (createdAtField && !createdAtField.value) {
            //    var formattedDateTime = TimeZoneConverter.getFormattedDateTimeWithTimezone(new Date());
               createdAtField.value = '<?= $date; ?>';
           }
       }

       
       function setFieldVisibility(isAddPage, isEditPage, updatedAtValue, updatedByValue) {
        console.log(isEditPage);
           var updatedAtInput = document.getElementById('updatedAt');
           var updatedAtFormGroup = updatedAtInput.closest('.mb-3');
           var updatedByInput = document.getElementById('updatedBy');
           var updatedByFormGroup = updatedByInput.closest('.mb-3');
       
           // Set fields as read-only
           updatedAtInput.readOnly = true;
           updatedByInput.readOnly = true;
       
           // Handle visibility for edit page
        //    console.log(updatedAtValue);
           if (isEditPage) {
               if (updatedAtValue) {
                   updatedAtInput.value = updatedAtValue.replace(' ', 'T');
                   updatedAtFormGroup.style.display = '';
               } else {
                   updatedAtFormGroup.style.display = 'none';
               }
       
               if (!updatedByValue || updatedByValue.trim() === '' || updatedByValue === 'null') {
                   updatedByFormGroup.style.display = 'none';
               } else {
                   updatedByFormGroup.style.display = '';
               }
           }
       
           // Handle visibility for add page
           if (isAddPage) {
               updatedAtFormGroup.style.display = 'none';
               updatedByFormGroup.style.display = 'none';
           }
       }
       
       document.addEventListener('DOMContentLoaded', function() {
           var isAddPage = '<?= ($isAddPage) ?>';
           var isEditPage = '<?= ($isEditPage) ?>';
           //var updatedAtValue = '<?php //(isset($cropType)?$cropType->updated_at:'' ?? '') ?>';
           //var updatedByValue = '<?php //(isset($cropType)?$cropType->updated_by:'' ?? '') ?>';
          var updatedAtValue = document.getElementById('updatedAt').value;
          var updatedByValue = document.getElementById('updatedBy').value;

           setFieldVisibility(isAddPage, isEditPage, updatedAtValue, updatedByValue);
       });
       
       window.onload = function() {
           var isAddPage = '<?= ($isAddPage) ?>';
           if (isAddPage) {
               setFieldsForAddPage();
           }
       };
       </script>
       <?php
    }
}

