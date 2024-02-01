<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
require SYSTEMPATH . 'Config/Routes.php';
}

/**
* --------------------------------------------------------------------
* Router Setup
* --------------------------------------------------------------------
*/
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
* --------------------------------------------------------------------
* Route Definitions
* --------------------------------------------------------------------
*/

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::login');
$routes->get('/dashboard', 'Home::index');

// Additional in-file definitions

$routes->group('{locale}/admin', [], function($routes) {
	$routes->get('/', 'Home::index');
	
	$routes->group('cation-formulas', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'CationFormulasController::index', ['as' => 'cationFormulaList']);
		$routes->get('index', 'CationFormulasController::index', ['as' => 'cationFormulaIndex']);
		$routes->get('list', 'CationFormulasController::index', ['as' => 'cationFormulaList2']);
		$routes->get('add', 'CationFormulasController::add', ['as' => 'newCationFormula']);
		$routes->post('add', 'CationFormulasController::add', ['as' => 'createCationFormula']);
		$routes->get('edit/(:num)', 'CationFormulasController::edit/$1', ['as' => 'editCationFormula']);
		$routes->post('edit/(:num)', 'CationFormulasController::edit/$1', ['as' => 'updateCationFormula']);
		$routes->get('delete/(:num)', 'CationFormulasController::delete/$1', ['as' => 'deleteCationFormula']);
		$routes->post('allmenuitems', 'CationFormulasController::allItemsSelect', ['as' => 'select2ItemsOfCationFormulas']);
		$routes->post('menuitems', 'CationFormulasController::menuItems', ['as' => 'menuItemsOfCationFormulas']);
	});
	
	$routes->group('postcode-australia-lists', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'PostcodeAustraliaListsController::index', ['as' => 'postcodeAustraliaListList']);
		$routes->get('add', 'PostcodeAustraliaListsController::add', ['as' => 'newPostcodeAustraliaList']);
		$routes->post('add', 'PostcodeAustraliaListsController::add', ['as' => 'createPostcodeAustraliaList']);
		$routes->post('create', 'PostcodeAustraliaListsController::create', ['as' => 'ajaxCreatePostcodeAustraliaList']);
		$routes->put('(:num)/update', 'PostcodeAustraliaListsController::update/$1', ['as' => 'ajaxUpdatePostcodeAustraliaList']);
		$routes->post('(:num)/edit', 'PostcodeAustraliaListsController::edit/$1', ['as' => 'updatePostcodeAustraliaList']);
		$routes->post('datatable', 'PostcodeAustraliaListsController::datatable', ['as' => 'dataTableOfPostcodeAustraliaLists']);
		$routes->post('allmenuitems', 'PostcodeAustraliaListsController::allItemsSelect', ['as' => 'select2ItemsOfPostcodeAustraliaLists']);
		$routes->post('menuitems', 'PostcodeAustraliaListsController::menuItems', ['as' => 'menuItemsOfPostcodeAustraliaLists']);
	});
	$routes->resource('postcode-australia-lists', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'PostcodeAustraliaListsController', 'except' => 'show,new,create,update']);

	
	$routes->group('timezones', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'TimezonesController::index', ['as' => 'timezoneList']);
		$routes->get('add', 'TimezonesController::add', ['as' => 'newTimezone']);
		$routes->post('add', 'TimezonesController::add', ['as' => 'createTimezone']);
		$routes->post('create', 'TimezonesController::create', ['as' => 'ajaxCreateTimezone']);
		$routes->put('(:num)/update', 'TimezonesController::update/$1', ['as' => 'ajaxUpdateTimezone']);
		$routes->post('(:num)/edit', 'TimezonesController::edit/$1', ['as' => 'updateTimezone']);
		$routes->post('datatable', 'TimezonesController::datatable', ['as' => 'dataTableOfTimezones']);
		$routes->post('allmenuitems', 'TimezonesController::allItemsSelect', ['as' => 'select2ItemsOfTimezones']);
		$routes->post('menuitems', 'TimezonesController::menuItems', ['as' => 'menuItemsOfTimezones']);
	});
	$routes->resource('timezones', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'TimezonesController', 'except' => 'show,new,create,update']);

	
	$routes->group('xero-sales-gsts', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'XeroSalesGstsController::index', ['as' => 'xeroSalesGstList']);
		$routes->get('add', 'XeroSalesGstsController::add', ['as' => 'newXeroSalesGst']);
		$routes->post('add', 'XeroSalesGstsController::add', ['as' => 'createXeroSalesGst']);
		$routes->post('create', 'XeroSalesGstsController::create', ['as' => 'ajaxCreateXeroSalesGst']);
		$routes->put('(:num)/update', 'XeroSalesGstsController::update/$1', ['as' => 'ajaxUpdateXeroSalesGst']);
		$routes->post('(:num)/edit', 'XeroSalesGstsController::edit/$1', ['as' => 'updateXeroSalesGst']);
		$routes->post('datatable', 'XeroSalesGstsController::datatable', ['as' => 'dataTableOfXeroSalesGsts']);
		$routes->post('allmenuitems', 'XeroSalesGstsController::allItemsSelect', ['as' => 'select2ItemsOfXeroSalesGsts']);
		$routes->post('menuitems', 'XeroSalesGstsController::menuItems', ['as' => 'menuItemsOfXeroSalesGsts']);
	});
	$routes->resource('xero-sales-gsts', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'XeroSalesGstsController', 'except' => 'show,new,create,update']);

	
	$routes->group('states', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'StatesController::index', ['as' => 'stateList']);
		$routes->get('add', 'StatesController::add', ['as' => 'newState']);
		$routes->post('add', 'StatesController::add', ['as' => 'createState']);
		$routes->post('create', 'StatesController::create', ['as' => 'ajaxCreateState']);
		$routes->put('(:num)/update', 'StatesController::update/$1', ['as' => 'ajaxUpdateState']);
		$routes->post('(:num)/edit', 'StatesController::edit/$1', ['as' => 'updateState']);
		$routes->post('datatable', 'StatesController::datatable', ['as' => 'dataTableOfStates']);
		$routes->post('allmenuitems', 'StatesController::allItemsSelect', ['as' => 'select2ItemsOfStates']);
		$routes->post('menuitems', 'StatesController::menuItems', ['as' => 'menuItemsOfStates']);
	});
	$routes->resource('states', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'StatesController', 'except' => 'show,new,create,update']);

	
	$routes->group('companies', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'CompaniesController::index', ['as' => 'companyList']);
		$routes->get('add', 'CompaniesController::add', ['as' => 'newCompany']);
		$routes->post('add', 'CompaniesController::add', ['as' => 'createCompany']);
		$routes->post('create', 'CompaniesController::create', ['as' => 'ajaxCreateCompany']);
		$routes->put('(:num)/update', 'CompaniesController::update/$1', ['as' => 'ajaxUpdateCompany']);
		$routes->post('(:num)/edit', 'CompaniesController::edit/$1', ['as' => 'updateCompany']);
		$routes->post('datatable', 'CompaniesController::datatable', ['as' => 'dataTableOfCompanies']);
		$routes->post('allmenuitems', 'CompaniesController::allItemsSelect', ['as' => 'select2ItemsOfCompanies']);
		$routes->post('menuitems', 'CompaniesController::menuItems', ['as' => 'menuItemsOfCompanies']);
	});
	$routes->resource('companies', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'CompaniesController', 'except' => 'show,new,create,update']);

	
	$routes->group('crop-types', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'CropTypesController::index', ['as' => 'cropTypeList']);
		$routes->get('index', 'CropTypesController::index', ['as' => 'cropTypeIndex']);
		$routes->get('list', 'CropTypesController::index', ['as' => 'cropTypeList2']);
		$routes->get('add', 'CropTypesController::add', ['as' => 'newCropType']);
		$routes->post('add', 'CropTypesController::add', ['as' => 'createCropType']);
		$routes->get('edit/(:num)', 'CropTypesController::edit/$1', ['as' => 'editCropType']);
		$routes->post('edit/(:num)', 'CropTypesController::edit/$1', ['as' => 'updateCropType']);
		$routes->get('delete/(:num)', 'CropTypesController::delete/$1', ['as' => 'deleteCropType']);
		$routes->post('allmenuitems', 'CropTypesController::allItemsSelect', ['as' => 'select2ItemsOfCropTypes']);
		$routes->post('menuitems', 'CropTypesController::menuItems', ['as' => 'menuItemsOfCropTypes']);
	});
	
	$routes->group('fertilzer-companies', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'FertilzerCompaniesController::index', ['as' => 'fertilzerCompanyList']);
		$routes->get('index', 'FertilzerCompaniesController::index', ['as' => 'fertilzerCompanyIndex']);
		$routes->get('list', 'FertilzerCompaniesController::index', ['as' => 'fertilzerCompanyList2']);
		$routes->get('add', 'FertilzerCompaniesController::add', ['as' => 'newFertilzerCompany']);
		$routes->post('datatable', 'FertilzerCompaniesController::datatable', ['as' => 'dataTableOfFertilzerCompanies']);
		$routes->post('add', 'FertilzerCompaniesController::add', ['as' => 'createFertilzerCompany']);
		$routes->get('edit/(:num)', 'FertilzerCompaniesController::edit/$1', ['as' => 'editFertilzerCompany']);
		$routes->post('edit/(:num)', 'FertilzerCompaniesController::edit/$1', ['as' => 'updateFertilzerCompany']);
		$routes->get('delete/(:num)', 'FertilzerCompaniesController::delete/$1', ['as' => 'deleteFertilzerCompany']);
		$routes->post('allmenuitems', 'FertilzerCompaniesController::allItemsSelect', ['as' => 'select2ItemsOfFertilzerCompanies']);
		$routes->post('menuitems', 'FertilzerCompaniesController::menuItems', ['as' => 'menuItemsOfFertilzerCompanies']);
	});
	
	$routes->group('fertilzers', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'FertilzersController::index', ['as' => 'fertilzerList']);
		$routes->get('add', 'FertilzersController::add', ['as' => 'newFertilzer']);
		$routes->post('add', 'FertilzersController::add', ['as' => 'createFertilzer']);
		$routes->post('create', 'FertilzersController::create', ['as' => 'ajaxCreateFertilzer']);
		$routes->put('(:num)/update', 'FertilzersController::update/$1', ['as' => 'ajaxUpdateFertilzer']);
		$routes->post('(:num)/edit', 'FertilzersController::edit/$1', ['as' => 'updateFertilzer']);
		$routes->post('datatable', 'FertilzersController::datatable', ['as' => 'dataTableOfFertilzers']);
		$routes->post('allmenuitems', 'FertilzersController::allItemsSelect', ['as' => 'select2ItemsOfFertilzers']);
		$routes->post('menuitems', 'FertilzersController::menuItems', ['as' => 'menuItemsOfFertilzers']);
	});
	$routes->resource('fertilzers', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'FertilzersController', 'except' => 'show,new,create,update']);
	
	$routes->group('fertilizer-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'FertilizerTemplatesController::index', ['as' => 'fertilizerTemplateList']);
		$routes->get('index', 'FertilizerTemplatesController::index', ['as' => 'fertilizerTemplateIndex']);
		$routes->get('list', 'FertilizerTemplatesController::index', ['as' => 'fertilizerTemplateList2']);
		$routes->get('add', 'FertilizerTemplatesController::add', ['as' => 'newFertilizerTemplate']);
		$routes->post('add', 'FertilizerTemplatesController::add', ['as' => 'createFertilizerTemplate']);
		$routes->get('edit/(:num)', 'FertilizerTemplatesController::edit/$1', ['as' => 'editFertilizerTemplate']);
		$routes->post('edit/(:num)', 'FertilizerTemplatesController::edit/$1', ['as' => 'updateFertilizerTemplate']);
		$routes->get('delete/(:num)', 'FertilizerTemplatesController::delete/$1', ['as' => 'deleteFertilizerTemplate']);
		$routes->post('allmenuitems', 'FertilizerTemplatesController::allItemsSelect', ['as' => 'select2ItemsOfFertilizerTemplates']);
		$routes->post('menuitems', 'FertilizerTemplatesController::menuItems', ['as' => 'menuItemsOfFertilizerTemplates']);
	});
	
	$routes->group('fertilzer-companies', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
	$routes->get('', 'FertilzerCompaniesController::index', ['as' => 'fertilzerCompanyList']);
	$routes->get('add', 'FertilzerCompaniesController::add', ['as' => 'newFertilzerCompany']);
	$routes->post('add', 'FertilzerCompaniesController::add', ['as' => 'createFertilzerCompany']);
	$routes->post('create', 'FertilzerCompaniesController::create', ['as' => 'ajaxCreateFertilzerCompany']);
	$routes->put('(:any)/update', 'FertilzerCompaniesController::update/$1', ['as' => 'ajaxUpdateFertilzerCompany']);
	$routes->post('(:any)/edit', 'FertilzerCompaniesController::edit/$1', ['as' => 'updateFertilzerCompany']);
	$routes->post('datatable', 'FertilzerCompaniesController::datatable', ['as' => 'dataTableOfFertilzerCompanies']);
	$routes->post('allmenuitems', 'FertilzerCompaniesController::allItemsSelect', ['as' => 'select2ItemsOfFertilzerCompanies']);
	$routes->post('menuitems', 'FertilzerCompaniesController::menuItems', ['as' => 'menuItemsOfFertilzerCompanies']);
});
	$routes->resource('fertilzer-companies', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'FertilzerCompaniesController', 'except' => 'show,new,create,update']);

	
	$routes->group('irrigation-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'IrrigationTemplatesController::index', ['as' => 'irrigationTemplateList']);
		$routes->get('add', 'IrrigationTemplatesController::add', ['as' => 'newIrrigationTemplate']);
		$routes->post('add', 'IrrigationTemplatesController::add', ['as' => 'createIrrigationTemplate']);
		$routes->post('create', 'IrrigationTemplatesController::create', ['as' => 'ajaxCreateIrrigationTemplate']);
		$routes->put('(:num)/update', 'IrrigationTemplatesController::update/$1', ['as' => 'ajaxUpdateIrrigationTemplate']);
		$routes->post('(:num)/edit', 'IrrigationTemplatesController::edit/$1', ['as' => 'updateIrrigationTemplate']);
		$routes->post('datatable', 'IrrigationTemplatesController::datatable', ['as' => 'dataTableOfIrrigationTemplates']);
		$routes->post('allmenuitems', 'IrrigationTemplatesController::allItemsSelect', ['as' => 'select2ItemsOfIrrigationTemplates']);
		$routes->post('menuitems', 'IrrigationTemplatesController::menuItems', ['as' => 'menuItemsOfIrrigationTemplates']);
	});
	$routes->resource('irrigation-templates', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'IrrigationTemplatesController', 'except' => 'show,new,create,update']);

	
	$routes->group('planting-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'PlantingTemplatesController::index', ['as' => 'plantingTemplateList']);
		$routes->get('add', 'PlantingTemplatesController::add', ['as' => 'newPlantingTemplate']);
		$routes->post('add', 'PlantingTemplatesController::add', ['as' => 'createPlantingTemplate']);
		$routes->post('create', 'PlantingTemplatesController::create', ['as' => 'ajaxCreatePlantingTemplate']);
		$routes->put('(:num)/update', 'PlantingTemplatesController::update/$1', ['as' => 'ajaxUpdatePlantingTemplate']);
		$routes->post('(:num)/edit', 'PlantingTemplatesController::edit/$1', ['as' => 'updatePlantingTemplate']);
		$routes->post('datatable', 'PlantingTemplatesController::datatable', ['as' => 'dataTableOfPlantingTemplates']);
		$routes->post('allmenuitems', 'PlantingTemplatesController::allItemsSelect', ['as' => 'select2ItemsOfPlantingTemplates']);
		$routes->post('menuitems', 'PlantingTemplatesController::menuItems', ['as' => 'menuItemsOfPlantingTemplates']);
	});
	$routes->resource('planting-templates', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'PlantingTemplatesController', 'except' => 'show,new,create,update']);

	
	$routes->group('pest-diseases-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'PestDiseasesTemplatesController::index', ['as' => 'pestDiseasesTemplateList']);
		$routes->get('add', 'PestDiseasesTemplatesController::add', ['as' => 'newPestDiseasesTemplate']);
		$routes->post('add', 'PestDiseasesTemplatesController::add', ['as' => 'createPestDiseasesTemplate']);
		$routes->post('create', 'PestDiseasesTemplatesController::create', ['as' => 'ajaxCreatePestDiseasesTemplate']);
		$routes->put('(:num)/update', 'PestDiseasesTemplatesController::update/$1', ['as' => 'ajaxUpdatePestDiseasesTemplate']);
		$routes->post('(:num)/edit', 'PestDiseasesTemplatesController::edit/$1', ['as' => 'updatePestDiseasesTemplate']);
		$routes->post('datatable', 'PestDiseasesTemplatesController::datatable', ['as' => 'dataTableOfPestDiseasesTemplates']);
		$routes->post('allmenuitems', 'PestDiseasesTemplatesController::allItemsSelect', ['as' => 'select2ItemsOfPestDiseasesTemplates']);
		$routes->post('menuitems', 'PestDiseasesTemplatesController::menuItems', ['as' => 'menuItemsOfPestDiseasesTemplates']);
	});
	$routes->resource('pest-diseases-templates', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'PestDiseasesTemplatesController', 'except' => 'show,new,create,update']);

	
	$routes->group('ppe-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'PPETemplatesController::index', ['as' => 'ppeTemplateList']);
		$routes->get('add', 'PPETemplatesController::add', ['as' => 'newPpeTemplate']);
		$routes->post('add', 'PPETemplatesController::add', ['as' => 'createPpeTemplate']);
		$routes->post('create', 'PPETemplatesController::create', ['as' => 'ajaxCreatePpeTemplate']);
		$routes->put('(:num)/update', 'PPETemplatesController::update/$1', ['as' => 'ajaxUpdatePpeTemplate']);
		$routes->post('(:num)/edit', 'PPETemplatesController::edit/$1', ['as' => 'updatePpeTemplate']);
		$routes->post('datatable', 'PPETemplatesController::datatable', ['as' => 'dataTableOfPpeTemplates']);
		$routes->post('allmenuitems', 'PPETemplatesController::allItemsSelect', ['as' => 'select2ItemsOfPpeTemplates']);
		$routes->post('menuitems', 'PPETemplatesController::menuItems', ['as' => 'menuItemsOfPpeTemplates']);
	});
	$routes->resource('ppe-templates', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'PPETemplatesController', 'except' => 'show,new,create,update']);

	
	$routes->group('pricelist-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'PricelistTemplatesController::index', ['as' => 'priceListTemplateList']);
		$routes->get('add', 'PricelistTemplatesController::add', ['as' => 'newPriceListTemplate']);
		$routes->post('add', 'PricelistTemplatesController::add', ['as' => 'createPriceListTemplate']);
		$routes->post('create', 'PricelistTemplatesController::create', ['as' => 'ajaxCreatePriceListTemplate']);
		$routes->put('(:num)/update', 'PricelistTemplatesController::update/$1', ['as' => 'ajaxUpdatePriceListTemplate']);
		$routes->post('(:num)/edit', 'PricelistTemplatesController::edit/$1', ['as' => 'updatePriceListTemplate']);
		$routes->post('datatable', 'PricelistTemplatesController::datatable', ['as' => 'dataTableOfPriceListTemplates']);
		$routes->post('allmenuitems', 'PricelistTemplatesController::allItemsSelect', ['as' => 'select2ItemsOfPriceListTemplates']);
		$routes->post('menuitems', 'PricelistTemplatesController::menuItems', ['as' => 'menuItemsOfPriceListTemplates']);
	});
	$routes->resource('pricelist-templates', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'PricelistTemplatesController', 'except' => 'show,new,create,update']);

	
	$routes->group('task-templates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'TaskTemplatesController::index', ['as' => 'taskTemplateList']);
		$routes->get('index', 'TaskTemplatesController::index', ['as' => 'taskTemplateIndex']);
		$routes->get('list', 'TaskTemplatesController::index', ['as' => 'taskTemplateList2']);
		$routes->get('add', 'TaskTemplatesController::add', ['as' => 'newTaskTemplate']);
		$routes->post('add', 'TaskTemplatesController::add', ['as' => 'createTaskTemplate']);
		$routes->get('edit/(:num)', 'TaskTemplatesController::edit/$1', ['as' => 'editTaskTemplate']);
		$routes->post('edit/(:num)', 'TaskTemplatesController::edit/$1', ['as' => 'updateTaskTemplate']);
		$routes->get('delete/(:num)', 'TaskTemplatesController::delete/$1', ['as' => 'deleteTaskTemplate']);
		$routes->post('allmenuitems', 'TaskTemplatesController::allItemsSelect', ['as' => 'select2ItemsOfTaskTemplates']);
		$routes->post('menuitems', 'TaskTemplatesController::menuItems', ['as' => 'menuItemsOfTaskTemplates']);
	});
	
	$routes->group('settings', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'SettingsController::index', ['as' => 'settingList']);
		$routes->get('index', 'SettingsController::index', ['as' => 'settingIndex']);
		$routes->get('list', 'SettingsController::index', ['as' => 'settingList2']);
		$routes->get('add', 'SettingsController::add', ['as' => 'newSetting']);
		$routes->post('add', 'SettingsController::add', ['as' => 'createSetting']);
		$routes->get('edit/(:num)', 'SettingsController::edit/$1', ['as' => 'editSetting']);
		$routes->post('edit/(:num)', 'SettingsController::edit/$1', ['as' => 'updateSetting']);
		$routes->get('delete/(:num)', 'SettingsController::delete/$1', ['as' => 'deleteSetting']);
		$routes->post('allmenuitems', 'SettingsController::allItemsSelect', ['as' => 'select2ItemsOfSettings']);
		$routes->post('menuitems', 'SettingsController::menuItems', ['as' => 'menuItemsOfSettings']);
	});
	
		$routes->group('soil-test-labs', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'SoilTestLabsController::index', ['as' => 'soilTestLabList']);
		$routes->get('add', 'SoilTestLabsController::add', ['as' => 'newSoilTestLab']);
		$routes->post('add', 'SoilTestLabsController::add', ['as' => 'createSoilTestLab']);
		$routes->post('create', 'SoilTestLabsController::create', ['as' => 'ajaxCreateSoilTestLab']);
		$routes->put('(:any)/update', 'SoilTestLabsController::update/$1', ['as' => 'ajaxUpdateSoilTestLab']);
		$routes->post('(:any)/edit', 'SoilTestLabsController::edit/$1', ['as' => 'updateSoilTestLab']);
		$routes->post('datatable', 'SoilTestLabsController::datatable', ['as' => 'dataTableOfSoilTestLabs']);
		$routes->post('allmenuitems', 'SoilTestLabsController::allItemsSelect', ['as' => 'select2ItemsOfSoilTestLabs']);
		$routes->post('menuitems', 'SoilTestLabsController::menuItems', ['as' => 'menuItemsOfSoilTestLabs']);
	});
		$routes->resource('soil-test-labs', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'SoilTestLabsController', 'except' => 'show,new,create,update']);

		$routes->group('categories', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
			$routes->get('', 'CategoriesController::index', ['as' => 'categoryList']);
			$routes->get('add', 'CategoriesController::add', ['as' => 'newCategory']);
			$routes->post('add', 'CategoriesController::add', ['as' => 'createCategory']);
			$routes->post('create', 'CategoriesController::create', ['as' => 'ajaxCreateCategory']);
			$routes->put('(:num)/update', 'CategoriesController::update/$1', ['as' => 'ajaxUpdateCategory']);
			$routes->post('(:num)/edit', 'CategoriesController::edit/$1', ['as' => 'updateCategory']);
			$routes->post('datatable', 'CategoriesController::datatable', ['as' => 'dataTableOfCategories']);
			$routes->post('allmenuitems', 'CategoriesController::allItemsSelect', ['as' => 'select2ItemsOfCategories']);
			$routes->post('menuitems', 'CategoriesController::menuItems', ['as' => 'menuItemsOfCategories']);
	});
		$routes->resource('categories', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'CategoriesController', 'except' => 'show,new,create,update']);

		$routes->group('water-rates', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
			$routes->get('', 'WaterRatesController::index', ['as' => 'waterRateList']);
			$routes->get('add', 'WaterRatesController::add', ['as' => 'newWaterRate']);
			$routes->post('add', 'WaterRatesController::add', ['as' => 'createWaterRate']);
			$routes->post('create', 'WaterRatesController::create', ['as' => 'ajaxCreateWaterRate']);
			$routes->put('(:num)/update', 'WaterRatesController::update/$1', ['as' => 'ajaxUpdateWaterRate']);
			$routes->post('(:num)/edit', 'WaterRatesController::edit/$1', ['as' => 'updateWaterRate']);
			$routes->post('datatable', 'WaterRatesController::datatable', ['as' => 'dataTableOfWaterRates']);
			$routes->post('allmenuitems', 'WaterRatesController::allItemsSelect', ['as' => 'select2ItemsOfWaterRates']);
			$routes->post('menuitems', 'WaterRatesController::menuItems', ['as' => 'menuItemsOfWaterRates']);
	});
		$routes->resource('water-rates', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'WaterRatesController', 'except' => 'show,new,create,update']);
		
		$routes->group('chemicals', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'ChemicalsController::index', ['as' => 'chemicalList']);
		$routes->get('add', 'ChemicalsController::add', ['as' => 'newChemical']);
		$routes->post('add', 'ChemicalsController::add', ['as' => 'createChemical']);
		$routes->post('create', 'ChemicalsController::create', ['as' => 'ajaxCreateChemical']);
		$routes->put('(:num)/update', 'ChemicalsController::update/$1', ['as' => 'ajaxUpdateChemical']);
		$routes->post('(:num)/edit', 'ChemicalsController::edit/$1', ['as' => 'updateChemical']);
		$routes->post('datatable', 'ChemicalsController::datatable', ['as' => 'dataTableOfChemicals']);
		$routes->post('allmenuitems', 'ChemicalsController::allItemsSelect', ['as' => 'select2ItemsOfChemicals']);
		$routes->post('menuitems', 'ChemicalsController::menuItems', ['as' => 'menuItemsOfChemicals']);
	});
	$routes->resource('chemicals', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'ChemicalsController', 'except' => 'show,new,create,update']);

	
	$routes->group('plant-nutrients', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'PlantNutrientsController::index', ['as' => 'plantNutrientList']);
		$routes->get('add', 'PlantNutrientsController::add', ['as' => 'newPlantNutrient']);
		$routes->post('add', 'PlantNutrientsController::add', ['as' => 'createPlantNutrient']);
		$routes->post('create', 'PlantNutrientsController::create', ['as' => 'ajaxCreatePlantNutrient']);
		$routes->put('(:num)/update', 'PlantNutrientsController::update/$1', ['as' => 'ajaxUpdatePlantNutrient']);
		$routes->post('(:num)/edit', 'PlantNutrientsController::edit/$1', ['as' => 'updatePlantNutrient']);
		$routes->post('datatable', 'PlantNutrientsController::datatable', ['as' => 'dataTableOfPlantNutrients']);
		$routes->post('allmenuitems', 'PlantNutrientsController::allItemsSelect', ['as' => 'select2ItemsOfPlantNutrients']);
		$routes->post('menuitems', 'PlantNutrientsController::menuItems', ['as' => 'menuItemsOfPlantNutrients']);
	});
	$routes->resource('plant-nutrients', ['namespace'  => 'App\Controllers\Admin', 'controller' => 'PlantNutrientsController', 'except' => 'show,new,create,update']);
	
	$routes->group('users', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'UsersController::index', ['as' => 'userList']);
		$routes->get('index', 'UsersController::index', ['as' => 'userIndex']);
		$routes->get('list', 'UsersController::index', ['as' => 'userList2']);
		$routes->get('add', 'UsersController::add', ['as' => 'newUser']);
		$routes->post('add', 'UsersController::add', ['as' => 'createUser']);
		$routes->get('edit/(:num)', 'UsersController::edit/$1', ['as' => 'editUser']);
		$routes->post('edit/(:num)', 'UsersController::edit/$1', ['as' => 'updateUser']);
		$routes->get('delete/(:num)', 'UsersController::delete/$1', ['as' => 'deleteUser']);
		$routes->post('allmenuitems', 'UsersController::allItemsSelect', ['as' => 'select2ItemsOfUsers']);
		$routes->post('menuitems', 'UsersController::menuItems', ['as' => 'menuItemsOfUsers']);
	});
	
	$routes->group('user-groups', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
		$routes->get('', 'UserGroupsController::index', ['as' => 'userGroupList']);
		$routes->get('index', 'UserGroupsController::index', ['as' => 'userGroupIndex']);
		$routes->get('list', 'UserGroupsController::index', ['as' => 'userGroupList2']);
		$routes->get('add', 'UserGroupsController::add', ['as' => 'newUserGroup']);
		$routes->post('add', 'UserGroupsController::add', ['as' => 'createUserGroup']);
		$routes->get('edit/(:num)', 'UserGroupsController::edit/$1', ['as' => 'editUserGroup']);
		$routes->post('edit/(:num)', 'UserGroupsController::edit/$1', ['as' => 'updateUserGroup']);
		$routes->get('delete/(:num)', 'UserGroupsController::delete/$1', ['as' => 'deleteUserGroup']);
		$routes->post('allmenuitems', 'UserGroupsController::allItemsSelect', ['as' => 'select2ItemsOfUserGroups']);
		$routes->post('menuitems', 'UserGroupsController::menuItems', ['as' => 'menuItemsOfUserGroups']);
	});

});

    $routes->group('{locale}', [], function($routes) {
        $routes->match(['get', 'post'], 'user-profile', 'UserProfileController::index', ['as' => 'user-profile']);
    });

/**
* --------------------------------------------------------------------
* Additional Routing
* --------------------------------------------------------------------
*
* There will often be times that you need additional routing and you
* need it to be able to override any defaults in this file. Environment
* based routes is one such time. require() additional route files here
* to make that happen.
*
* You will have access to the $routes object within that file without
* needing to reload it.
*/
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}