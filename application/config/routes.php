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

$route['default_controller'] = "main";
$route['404_override'] = 'error';


/*********** USER DEFINED ROUTES *******************/

$route['SystemSignIn'] = 'login/systemsignin';
$route['systemlogin'] = 'login/systemlogins';
$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'user';
$route['logout'] = 'user/logout';
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['checkEmailExists'] = "attachment/checkEmailExists";
$route['addNewUser'] = "user/addNewUser";
$route['editOld'] = "user/editOld";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['profile'] = "user/profile";
$route['profileUpdate'] = "user/profileUpdate";
$route['loadchangePass'] = "user/loadchangePass";
$route['changePassword'] = "user/changePassword";
$route['pageNotFound'] = "user/pageNotFound";

/*********** Credit Hours ROUTES *******************/
$route['credithour'] = "setting/settings/viewCredit";
$route['addnewCredit'] = "setting/settings/addNewCredit";
$route['addNewCreditInfo'] = "setting/settings/addNewCreditInfo";
$route['editcredit/(:num)'] = "setting/settings/editCredit/$1";
$route['editcardInfo'] = "setting/settings/editcardInfo";

/*********** FRONTEND ROUTES *******************/

$route['login'] = 'login';
$route['forgotPassword'] = "login";
$route['forgotEmail'] = "login/forgetemail";
$route['feedback'] = "regbox/feedback";

/*********** FRONTEND MALE ROUTES *******************/
$route['malePage'] = "regbox/malemain";
$route['appformmale/(:any)'] = "regbox/getmalestudentdetails/$1";
$route['appformmale'] = "regbox/getmalestudentdetails";
$route['appformmalesignup'] = "regbox/addNewSignup";
$route['maleCE'] = "regbox/maleCE";
$route['maleGI'] = "regbox/maleGI";
$route['maleCU'] = "regbox/maleCU";
$route['maleLists'] = "regbox/maleLists";
$route['maleNotifications'] = "regbox/maleNotifications";
$route['maleForms'] = "regbox/maleForms";

/*********** FRONTEND FEMALE ROUTES *******************/
$route['appformfemale/(:num)'] = "femalereg/appformfemale/$1";
$route['femaleapp/(:any)'] = "femalereg/femaleapp/$1";
$route['appformfemale'] = "femalereg/appformfemale";
$route['femalePage'] = "femalereg/femalemain";
$route['femaleCU'] = "femalereg/femaleCU";
$route['femaleRC'] = "femalereg/femaleRC";
$route['femaleLists'] = "femalereg/femaleLists";
$route['femaleNotifications'] = "femalereg/femaleNotifications";
$route['femaleForms'] = "femalereg/femaleForms";
$route['femaleMFDR'] = "femalereg/femaleMFDR";

/*********** Studnet Contact Info Module *******************/

//$route['students'] = "studentContactInfo/Student/studentList";

//$route['student'] = "studentContactInfo/Student/student";
$route['students_contact_info'] = "studentContactInfo/Student/students";
$route['edit_student/(:any)'] = "studentContactInfo/Student/edit_student/$1";
//$route['search_student'] = "studentContactInfo/Student/searchStudent";
$route['update_student'] = "studentContactInfo/Student/updateStudentInformation";



/*********** HOW TO APPLY ROUTES *******************/
$route['tutorials'] = "regbox/tutorials";
$route['stepguideFP'] = "regbox/stepguideFP";
$route['stepguideNA'] = "regbox/stepguideNA";
$route['stepguideA'] = "regbox/stepguideA";
$route['stepguideR'] = "regbox/stepguideR";


$route['import_data'] = "importData/import_data";

/* End of file routes.php */
/* Location: ./application/config/routes.php */

/* API Routes */
$route['api/student-picture/(:any)/(:any)'] = "api/HostelStudentPicture/$1/$2";
$route['api/test-student-picture/(:any)/(:any)'] = "api/TestHostelStudentPicture/$1/$2";