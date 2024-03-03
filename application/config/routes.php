<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'HomeRegistration';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin portal
$route['admin/dashboard'] 					        = 'AdminDashboard/index';
$route['admin/users'] 						        = 'AdminUsers/index';
$route['admin/users/datatable'] 			        = 'DataTable/GetUsers';
$route['admin/users/reset/(:num)'] 			        = 'AdminUsers/ResetPassword/$1';
$route['admin/users/status/(:num)/(:any)'] 	        = 'AdminUsers/AccountStatus/$1/$2';
$route['admin/logs'] 						        = 'AdminLogs/index';
$route['admin/logs/datatable'] 				        = 'DataTable/GetActivityLogs';
$route['admin/registration/(:any)'] 		        = 'AdminRegistration/index/$1';
$route['admin/registration/datatable/(:num)']       = 'DataTable/GetRegistrants/$1';
$route['admin/registration/view/(:any)']            = 'AdminRegistration/View/$1';
$route['admin/registration/approve/list'] 		    = 'AdminRegistration/ApproveRegistration';
$route['admin/registration/approve/datatable']      = 'DataTable/GetApproveRegistrants';
$route['admin/registration/view/approve/(:any)']    = 'AdminRegistration/View/$1/true';
$route['admin/registration/resend/(:any)/(:any)']   = 'AdminRegistration/Resend/$1/$2';

// home - registration
$route['how']       = 'HomeRegistration/How';
$route['faq']       = 'HomeRegistration/FAQ';
$route['register']  = 'HomeRegistration/Register';
$route['confirm']   = 'HomeRegistration/Confirm';
$route['product']   = 'HomeRegistration/Product';
$route['terms']     = 'HomeRegistration/Terms';
$route['privacy']   = 'HomeRegistration/Privacy';
$route['end']       = 'PromoEnd';