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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'home';
$route['404_override'] = 'home/pageNotFound';
// $route['access-applicants/(:num)'] = 'home/applicants/$1';
$route['dextryx'] = 'home/dextryx';
$route['about-us'] = 'home/aboutUs';
$route['terms-and-conditions'] = 'home/termsAndConditions';
$route['privacy-policy'] = 'home/privacyPolicy';
$route['contact-us'] = 'home/contactUs';

$route['general-details'] = 'home/generalDetails';
$route['skills'] = 'home/skills';
$route['skill-test'] = 'home/skillTest';
$route['skill-test-guidelines'] = 'home/skillTestGuidelines';
$route['educational-details'] = 'home/educationalDetails';

$route['verify-contact-details'] = 'home/verifyContactDetails';

$route['work-experience'] = 'home/workExperience';
$route['resume'] = 'home/resume';

$route['change-password'] = 'home/changePassword';

$route['add-new-offer'] = 'home/addNewOffer';
$route['my-added-offers'] = 'home/myAddedOffers';
$route['edit-offer/(:num)'] = 'home/editOffer/$1';


$route['applied-offers'] = 'home/appliedOffers';
$route['available-offers'] = 'home/availableOffers';

$route['offer/(:num)'] = 'home/offer/$1';

$route['hiring-nucleus/applicants/(:num)'] = 'home/applicants/$1';
$route['hiring-nucleus/compare-applicants'] = 'home/compareApplicants';
$route['hiring-nucleus/profile/(:num)/(:num)'] = 'home/profile/$1/$2';

$route['employer'] = 'home/employer';
$route['report/(:num)'] = 'home/report/$1';

$route['employer/job-offers'] = 'home/jobOffers';

$route['reset-password'] = 'home/resetPassword';


$route['404'] = 'home/pageNotFound';

$route['translate_uri_dashes'] = FALSE;
