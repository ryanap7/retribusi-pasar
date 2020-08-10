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
$route['default_controller'] = 'Auth';

$route['auth'] = 'Auth';

// ------------------------------------------------------------------------
// Admin
// ------------------------------------------------------------------------
$route['admin/dashboard']                                   = 'Admin/DashboardController';

$route['admin/pegawai']                                     = 'Admin/PegawaiController';
$route['admin/pegawai/create']                              = 'Admin/PegawaiController/create';
$route['admin/pegawai/store']                               = 'Admin/PegawaiController/store';
$route['admin/pegawai/edit/(:any)']                         = 'Admin/PegawaiController/edit/$1';
$route['admin/pegawai/update']                              = 'Admin/PegawaiController/update';
$route['admin/pegawai/delete/(:any)']                       = 'Admin/PegawaiController/delete/$1';

$route['admin/pedagang']                                    = 'Admin/PedagangController';
$route['admin/pedagang/create']                             = 'Admin/PedagangController/create';
$route['admin/pedagang/store']                              = 'Admin/PedagangController/store';
$route['admin/pedagang/edit/(:any)']                        = 'Admin/PedagangController/edit/$1';
$route['admin/pedagang/update']                             = 'Admin/PedagangController/update';
$route['admin/pedagang/delete/(:any)']                      = 'Admin/PedagangController/delete/$1';

$route['admin/setoran']                                     = 'Admin/SetoranController';
$route['admin/setoran/create']                              = 'Admin/SetoranController/create';
$route['admin/setoran/store']                               = 'Admin/SetoranController/store';
$route['admin/setoran/edit/(:any)']                         = 'Admin/SetoranController/edit/$1';
$route['admin/setoran/update']                              = 'Admin/SetoranController/update';
$route['admin/setoran/delete/(:any)']                       = 'Admin/SetoranController/delete/$1';
$route['admin/setoran/search']                              = 'Admin/SetoranController/search';

$route['admin/penunggakan']                                 = 'Admin/PenunggakanController';
$route['admin/penunggakan/create']                          = 'Admin/PenunggakanController/create';
$route['admin/penunggakan/store']                           = 'Admin/PenunggakanController/store';
$route['admin/penunggakan/edit/(:any)']                     = 'Admin/PenunggakanController/edit/$1';
$route['admin/penunggakan/update']                          = 'Admin/PenunggakanController/update';
$route['admin/penunggakan/delete/(:any)']                   = 'Admin/PenunggakanController/delete/$1';
$route['admin/penunggakan/search']                          = 'Admin/PenunggakanController/search';

$route['admin/laporan/findSetoran']                         = 'Admin/LaporanController/findSetoran';
$route['admin/laporan/findSetoran_']                        = 'Admin/LaporanController/findSetoran_';
$route['admin/laporan/findPenunggakan']                     = 'Admin/LaporanController/findPenunggakan';
$route['admin/laporan/findPenunggakan_']                    = 'Admin/LaporanController/findPenunggakan_';
$route['admin/laporan/setoran']                             = 'Admin/LaporanController/setoran';
$route['admin/laporan/print_setoran']                       = 'Admin/LaporanController/print_setoran';
$route['admin/laporan/penunggakan']                         = 'Admin/LaporanController/penunggakan';
$route['admin/laporan/print_penunggakan']                   = 'Admin/LaporanController/print_penunggakan';

$route['admin/setting']                                     = 'Admin/SettingController';
$route['admin/setting/update']                              = 'Admin/SettingController/update';

$route['admin/harga_tempat']                                = 'Admin/HargaTempatController';
$route['admin/harga_tempat/update']                         = 'Admin/HargaTempatController/update';

$route['profile/edit']                                      = 'ProfileController/edit';
$route['profile/update']                                    = 'ProfileController/update';
$route['profile/changepassword']                            = 'ProfileController/changepassword';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
