<?php



return [
		'id' => 'ID',
		'moduleTitle' => 'Xero GST Codes',
		'type' => 'Type',
		'xero-sales-gsts' => 'Xero GST',
		'xeroCode' => 'Xero Code',
		'xeroSalesGst' => 'Xero GST',
		'xeroSalesGstList' => 'Xero GST Codes',
		'xeroSalesGsts' => 'Xero Sales GST',
		'validation' => [
			'type' => [
				'required' => 'The {field} field is required.', // Message for required rule
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',
			],
			'xero_code' => [
				'required' => 'The {field} field is required.', // Message for required rule
				'max_length' => 'The {field} field cannot exceed {param} characters in length.',
			],
		],
		


];