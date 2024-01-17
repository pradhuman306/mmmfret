<?php



return [
		'companyId' => 'Company ID',
		'description' => 'Description',
		'id' => 'ID',
		'moduleTitle' => 'Settings',
		'setting' => 'Setting',
		'settingList' => 'Setting List',
		'settings' => 'Settings',
		'validation' =>  [
			'description' =>  [
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',

			],

			'company_id' =>  [
				'integer' => 'The {field} field must contain an integer.',
				'required' => 'The {field} field is required.',

			],


		],


];