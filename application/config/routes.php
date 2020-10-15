<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']		= 'Clogin';
$route['404_override']				= '';
$route['translate_uri_dashes']		= FALSE;
$route['nojs.html']					= 'Cnojs';

//Hệ thống
$route['logout']					= 'Clogin/logout';
$route['register']					= 'Cregister';
$route['changepassword']			= 'Cchangepassword';
$route['welcome']					= 'Cwelcome';

//Uỷ viên
$route['infouv']					= 'Cinfouv';
$route['listsv']					= 'Clistsv';
$route['listsv/:num']				= 'Clistsv/index/$1';
$route['inbangdiem']    			= 'Cinbangdiem';
$route['statistical']				= 'Cstatistical';


$route['info-ung-vien']				= 'Cinfoungvien';
$route['muc1']			            = 'Cmuc1';
$route['muc2']			            = 'Cmuc2';
$route['muc3']			            = 'Cmuc3';
$route['muc4den5']			        = 'Cmuc4den5';
$route['muc6']			            = 'Cmuc6';
$route['muc7']			            = 'Cmuc7';
$route['tonghop']			        = 'Ctonghop';
$route['nhanxet']			        = 'Cnhanxet';
$route['export09']			    = 'uyvien/Cexport09';
$route['export06']			    = 'uyvien/Cexport06';
$route['ctdt']			    = 'CthamdinhCTDT';
$route['admin'] = 'Cadmin';