<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Frontend';
$route['404_override'] = '';

$admin_prefix = 'hotel-admin';
$auth_prefix  = 'hotel-login';


// $route['member'] = 'auth/member_auth';
// $route['member/login'] = 'auth/member_auth';
// $route['member/register'] = 'auth/member_register';
// $route['member/logout'] = 'auth/member_logout';


// Auth
$route[$auth_prefix] = 'auth/index';
$route[$auth_prefix . '/auth'] = 'auth/index';
$route[$auth_prefix . '/(:any)'] = 'auth/$1';
$route[$auth_prefix . '/(:any)/(:any)'] = 'auth/$1/$2';
$route[$auth_prefix . '/(:any)/(:any)/(:any)'] = 'auth/$1/$2/$3';
$route[$auth_prefix . '/(:any)/(:any)/(:any)/(:any)'] = 'auth/$1/$2/$3/$4';
$route[$auth_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'auth/$1/$2/$3/$4/$5';
$route[$auth_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'auth/$1/$2/$3/$4/$5/$6';
$route[$auth_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'auth/$1/$2/$3/$4/$5/$6/$7';

// Admin
$route[$admin_prefix] = 'admin/dashboard/index';
$route[$admin_prefix . '/(:any)'] = 'admin/$1';
$route[$admin_prefix . '/(:any)/(:any)'] = 'admin/$1/$2';
$route[$admin_prefix . '/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4/$5';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4/$5/$6';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4/$5/$6/$7';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4/$5/$6/$7/$8';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route[$admin_prefix . '/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';

// API
$route['api'] = 'api/api';
$route['api/(:any)'] = 'api/api/$1';
$route['api/(:any)/(:any)'] = 'api/api/$1/$2';
$route['api/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3';
$route['api/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4';
$route['api/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4/$5';
$route['api/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4/$5/$6';
$route['api/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4/$5/$6/$7';
$route['api/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4/$5/$6/$7/$8';
$route['api/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4/$5/$6/$7/$8/$9';
$route['api/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'api/api/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';

// Member
// $route['member'] = 'member/index';
// $route['member/(:any)'] = 'member/$1';
// $route['member/(:any)/(:any)'] = 'member/$1/$2';
// $route['member/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3';
// $route['member/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4';
// $route['member/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4/$5';
// $route['member/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4/$5/$6';
// $route['member/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4/$5/$6/$7';
// $route['member/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4/$5/$6/$7/$8';
// $route['member/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4/$5/$6/$7/$8/$9';
// $route['member/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'member/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';

// Frontend
$route[] = $route['default_controller'] . '/index';
$route['(:any)/room'] = $route['default_controller'] . '/room/$1';
$route['(:any)/room_details/(:any)'] = $route['default_controller'] . '/room_details/$1/$2';
$route['(:any)/facilities'] = $route['default_controller'] . '/facilities/$1';
$route['(:any)/gallery'] = $route['default_controller'] . '/gallery/$1';
$route['(:any)/contact'] = $route['default_controller'] . '/contact/$1';

$route['(:any)'] = $route['default_controller'] . '/hotel_index/$1';
// $route['(:any)/(:any)/contact'] = $route['default_controller'] . '/hotel_contact/$1';
$route['(:any)/(:any)'] = $route['default_controller'] . '/$1/$2';

// $route['(:any)'] = $route['default_controller'] . '/$1';
// $route['(:any)/(:any)'] = $route['default_controller'] . '/$1/$2';
// $route['(:any)/(:any)/(:any)'] = $route['default_controller'] . '/$1/$2/$3';
// $route['(:any)/(:any)/(:any)/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4';
// $route['(:any)/(:any)/(:any)/(:any)/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4/$5';
// $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4/$5/$6';
// $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4/$5/$6/$7';
// $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any))/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4/$5/$6/$7/$8';
// $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any))/(:any))/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4/$5/$6/$7/$8/$9';
// $route['(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any))/(:any))/(:any))/(:any)'] = $route['default_controller'] . '/$1/$2/$3/$4/$5/$6/$7/$8/$9/$10';


$route['translate_uri_dashes'] = true;
