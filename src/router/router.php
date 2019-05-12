<?php
/**
* This file contains all the routes for the project
*/

use Emeka\Router\RouterConfig as Router;
use Emeka\Middlewares\CsrfVerifier;
use Emeka\Middlewares\ApiVerification;
use Emeka\Http\Handlers\CustomExceptionHandler;

Router::csrfVerifier(new CsrfVerifier());

Router::group(['namespace' => '\Emeka\Http\Controllers', 'exceptionHandler' => CustomExceptionHandler::class], function () {

	Router::get('/', 'CustomerController@index');
	Router::get('/customers', 'CustomerController@showCustomers');
	Router::get('/customer/{id}', 'CustomerController@showCustomer');
	
	Router::get('/plans', 'PlanController@showPlans');
	Router::get('/plan/{id}', 'PlanController@showPlan');

	// API Routes
	Router::group(['prefix' => '/api'], function () {
		Router::get('/', 'CustomerController@apiGetCustomers');
		Router::get('/customer/{id}', 'CustomerController@customer');
		Router::post('/customer', 'CustomerController@create');
		Router::post('/customer/{id}', 'CustomerController@update');
		Router::post('/customer/{id}/plan', 'CustomerController@apiCustomerAddPlan');
		Router::delete('/customer/{id}', 'CustomerController@delete');
		
		Router::get('/plan', 'planController@apiGetPlans');
		Router::post('/plan', 'planController@apiCreatePlan');
		Router::post('/plan/{id}', 'planController@apiUpdatePlans');
		Router::post('/plan/{id}/workout', 'planController@apiPlanAddWorkout');
		Router::delete('/plan/{id}', 'planController@apiDeletePlan');
	});
});