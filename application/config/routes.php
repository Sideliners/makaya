<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "page";
$route['404_override'] = '';

$route['page/about-us'] = 'page/aboutus';
$route['page/terms-of-use'] = 'page/termsofuse';
$route['page/legal-copyright'] = 'page/legalcopyright';

$route['shopping-cart'] = 'cart';
$route['customer-support'] = 'support/customer';
$route['donation-info'] = 'support/donation';
$route['feedback']	=	'support/feedback';

$route['product/(:num)/(:num)/(:any)'] = 'product/index/$1/$2/$3';
$route['artisan/(:num)/(:num)/(:any)'] = 'artisan/index/$1/$2/$3';
$route['enterprise/(:num)/(:num)/(:any)'] = 'enterprise/index/$1/$2/$3';

$route['article/(:num)/(:num)/(:any)'] = 'article/index/$1/$2/$3';
$route['collection/(:num)/(:any)'] = 'collection/index/$1/$2';

$route['search/(:any)'] = 'search/index/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
