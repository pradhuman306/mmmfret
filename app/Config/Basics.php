<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Basics extends BaseConfig {

	public $appName = 'MMM Fert';

	public $i18n = 'English'; 

	public $languages = [
		'en' => 'English',
	];


	public $languageFlags = [
		'en' => 'us',
	];


	public $authImplemented = true;



	public $theme = [
		'name' => 'Bootstrap5',
		'body-sm' => false,
		'navbar'  => [
		'bg'     => 'gray',
		'type'   => 'dark',
		'border' => true,
		'user'   => [
		'visible' => true,
		'shadow'  => 0,
		],
	],
		'sidebar' => [
		'type'    => 'dark',
		'shadow'  => 4,
		'border'  => false,
		'compact' => true,
		'links'   => [
		'bg'     => 'black', // only works with AdminLTE theme
		'shadow' => 1,
	],
		'brand' => [
		'bg'   => 'gray-light',
		'logo' => [
		'icon'   => 'favicon.ico', // path to image | this example icon on public root folder.
		'text'   => 'MMM Fert',
		'shadow' => 2,
		],
	],
		'user' => [
		'visible' => true,
		'shadow'  => 2,
		],
	],
		'footer' => [
		'fixed'      => false,
		'organization' => 'MMM Agronomy',
		'orglink' => '',
		],
	];

}
