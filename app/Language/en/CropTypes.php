<?php



return [
		'active' => 'Active',
		'createdAt' => 'Created At',
		'createdBy' => 'Created By',
		'crop-types' => 'Crop Types',
		'cropType' => 'Crop Type',
		'cropTypeList' => 'Crop Type List',
		'cropTypes' => 'Crop Types',
		'id' => 'ID',
		'moduleTitle' => 'Crop Types',
		'updatedAt' => 'Updated At',
		'updatedBy' => 'Updated By',
		'variety' => 'Variety',
		'validation' =>  [
			'created_by' =>  [
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',

			],

			'crop_type' =>  [
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',

			],

			'status' =>  [
				'integer' => 'The {field} field must contain an integer.',

			],

			'variety' =>  [
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',

			],

			'created_at' =>  [
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',
				'valid_date' => 'The {field} field must contain a valid date.',

			],

			'updated_at' =>  [
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',
				'valid_date' => 'The {field} field must contain a valid date.',

			],

			'updated_by' =>  [
				'integer' => 'The {field} field must contain an integer.',
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',

			],


		],


];