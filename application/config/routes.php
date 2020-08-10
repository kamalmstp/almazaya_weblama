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

$webadmin = "webadmin";
$route[$webadmin.'/hubungan_investor_report'] = "webadmin_hubungan_investor_report/hubungan_investor_report";
$route[$webadmin.'/hubungan_investor_report/(:any).*'] = "webadmin_hubungan_investor_report/hubungan_investor_report";
$route[$webadmin.'/setting_jenis_pertanyaan'] = "webadmin_pengaduan_nasabah/pengaduan_nasabah_jenis_pertanyaan";
$route[$webadmin.'/setting_jenis_pertanyaan/(:any).*'] = "webadmin_pengaduan_nasabah/pengaduan_nasabah_jenis_pertanyaan";
$route[$webadmin.'/list_penerima_email_pengaduan_nasabah'] = "webadmin_pengaduan_nasabah/pengaduan_nasabah_receiver";
$route[$webadmin.'/list_penerima_email_pengaduan_nasabah/(:any).*'] = "webadmin_pengaduan_nasabah/pengaduan_nasabah_receiver";
$route[$webadmin.'/managementcategory'] = "webadmin_management/management";
$route[$webadmin.'/managementcategory/(:any).*'] = "webadmin_management/management";
$route[$webadmin.'/managementlist'] = "webadmin_management/managementlist";
$route[$webadmin.'/managementlist/(:any).*'] = "webadmin_management/managementlist";

$route[$webadmin.'/joblist'] = "webadmin_karir/joblist";
$route[$webadmin.'/joblist/(:any).*'] = "webadmin_karir/joblist";

$route[$webadmin.'/kurs'] = "webadmin_kurs/kurs";
$route[$webadmin.'/kurs/(:any).*'] = "webadmin_kurs/kurs";

$route[$webadmin.'/kategoriproduklayananconsumerbanking'] = "webadmin_produklayananconsumerbanking/kategori";
$route[$webadmin.'/kategoriproduklayananconsumerbanking/(:any).*'] = "webadmin_produklayananconsumerbanking/kategori";
$route[$webadmin.'/listprodukservice'] = "webadmin_produklayananconsumerbanking/listprodukservice";
$route[$webadmin.'/listprodukservice/(:any).*'] = "webadmin_produklayananconsumerbanking/listprodukservice";
$route['cek_slug'] = "webadmin/cek_slug_ajax";
$route['get_karir_desc'] = "ajax/get_karir_desc";
$route['getbanner'] = "ajax/getbanner";
$route['getsearch'] = "ajax/getsearch";
$route['getbanner_m'] = "ajax/getbanner_m";
$route['get_kenali'] = "ajax/get_kenali";
$route['getpromoinfo'] = "ajax/getpromoinfo";
$route['cekrisikojantung'] = "cekresikojantung";
$route['cekkalorimakanan'] = "cekkalorimakanan";
$route['subscribe'] = "ajax/subscribe";
$route['cekconfirmationpayment'] = "ajax/cekconfirmationpayment";
$route['captchatest'] = "captcha_test";
$route['addcart'] = "ajax/addcart";
$route['updatecart'] = "ajax/updatecart";
$route['updatecartpayment'] = "ajax/updatecartpayment";
$route['deletecart'] = "ajax/deletecart";
$route['saveregistration'] = "ajax/saveregistration";
$route['id/saveregistration'] = "ajax/saveregistration";
$route['captcha'] = "captcha_test/captcha";
$route['captcha_contact'] = "captcha_test/captcha_contact";
$route['captcha_forgot'] = "captcha_test/captcha_forgot";

$route['add_confirmation'] = "ajax/add_confirmation";
$route['id/add_confirmation'] = "ajax/add_confirmation";
$route['saveconfirmation'] = "ajax/saveconfirmation";
$route['cekresi'] = "ajax/cekresi";
$route['get_province'] = "ajax/get_province";
$route['update_province'] = "ajax/update_province";
$route['update_city'] = "ajax/update_city";
$route['update_district'] = "ajax/update_district";
$route['update_address'] = "ajax/update_address";
$route['id/update_address'] = "ajax/update_address";
$route['update_address_new'] = "ajax/update_address_new";
$route['id/update_address_new'] = "ajax/update_address_new";
$route['update_current_address'] = "ajax/update_current_address";
$route['id/update_current_address'] = "ajax/update_current_address";
$route['update_account'] = "ajax/update_account";

$route['update_password'] = "ajax/update_password";
$route['savepassword'] = "ajax/savepassword";
$route['savethedata'] = "ajax/savethedata";
$route['id/savethedata'] = "ajax/savethedata";
$route['update_current_address_submit'] = "ajax/update_current_address_submit";
$route['ongkir'] = "ajax/ongkir";

$route['savekontak'] = "ajax/savekontak";
$route['saveaccount'] = "ajax/saveaccount";
$route['select_address'] = "ajax/select_address";
$route['id/add_address'] = "ajax/add_address";
$route['add_address'] = "ajax/add_address";
$route['saveaddress'] = "ajax/saveaddress";
$route['save_add_address'] = "ajax/save_add_address";
$route['get_city'] = "ajax/get_city";
$route["en/search"] = "search";
$route["search"] = "search";
$route['default_controller'] = 'main';

require_once( BASEPATH .'database/DB.php' ); 
$db =& DB();
$resultbiasa = $db->query('SELECT pages.link,module.controller,pages.sister FROM pages INNER JOIN module on module.id=pages.idmodule INNER JOIN language ON language.id=pages.idlanguage WHERE language.use_default = 1 AND pages.draft = 0 AND pages.hapus = 0')->result();

foreach ($resultbiasa as $rowbiasa) {
  $route[ $rowbiasa->link ]                 = $rowbiasa->controller;
  $route[ $rowbiasa->link.'/:any' ]         = $rowbiasa->controller;
  $route[ $rowbiasa->link.'/(:any).*' ]         = $rowbiasa->controller;
  //$route[ $rowbiasa->controller ]           = 'error404';
  //$route[ $rowbiasa->controller.'/:any' ]   = 'error404';
  /*$resultbiasa2 = $db->query('SELECT pages.link,module.controller FROM pages INNER JOIN module on module.id=pages.idmodule INNER JOIN language ON language.id=pages.idlanguage WHERE language.use_default = 1 AND pages.draft = 0 AND pages.hapus = 0 AND pages.parent = '.$rowbiasa->sister)->result();
    foreach ($resultbiasa2 as $rowbiasa2) {
        $route[ $rowbiasa->link.'/'.$rowbiasa2->link ]   = $rowbiasa2->controller;
        $route[ $rowbiasa->link.'/'.$rowbiasa2->link.'/:any' ]   = $rowbiasa2->controller;
        
    }
  */
}
//echo "<pre>";
//print_r($route);
$resultlengkap = $db->query('SELECT language.lang_code,pages.link,pages.sister,module.controller FROM pages INNER JOIN module on module.id=pages.idmodule INNER JOIN language ON language.id=pages.idlanguage WHERE pages.draft = 0 AND pages.hapus = 0')->result();
//echo "<pre>";
//print_r($resultlengkap); 
foreach ($resultlengkap as $rowlengkap) {
  if ($rowlengkap->link == '') {
    $route[ $rowlengkap->lang_code ]        = "Main";
    
  } 
  
  else {
    
    $route[ $rowlengkap->lang_code.'/'.$rowlengkap->link ]                 = $rowlengkap->controller;
    $route[ $rowlengkap->lang_code.'/'.$rowlengkap->link.'/:any' ]         = $rowlengkap->controller;
    $route[ $rowlengkap->lang_code.'/'.$rowlengkap->controller ]           = 'error404';
    $route[ $rowlengkap->lang_code.'/'.$rowlengkap->controller.'/:any' ]   = 'error404';
    
    $resultlengkap2 = $db->query('SELECT language.lang_code,pages.link,module.controller FROM pages INNER JOIN module on module.id=pages.idmodule INNER JOIN language ON language.id=pages.idlanguage WHERE pages.draft = 0 AND pages.hapus = 0 AND pages.parent = '.$rowlengkap->sister)->result();
    foreach ($resultlengkap2 as $rowlengkap2) {
        $route[ $rowlengkap->lang_code.'/'.$rowlengkap->link.'/'.$rowlengkap2->link ]                 = $rowlengkap2->controller;
        $route[ $rowlengkap->lang_code.'/'.$rowlengkap->link.'/'.$rowlengkap2->link.'/:any' ]         = $rowlengkap2->controller;
    
    }
  }
}



//$route['webadmin/(:any).*'] = "webadmin/pilihfunction";


$resultcms = $db->query('SELECT a.id,a.module,a.parent,a.title,a.link,b.controller,b.controller_be FROM menu a LEFT JOIN module b ON a.module=b.id')->result();
foreach ($resultcms as $datacms){
    $route[$webadmin.'/'.$datacms->link.''] = $datacms->controller_be;
    $route[$webadmin.'/'.$datacms->link.'/(:any).*'] = $datacms->controller_be;
    
}
//echo "<pre>";
//print_r($route); 
$route['download/(:any).*'] = "download";
//$route['404_override'] = 'page404';
//$route['404_override'] = "";
$route['translate_uri_dashes'] = FALSE;

