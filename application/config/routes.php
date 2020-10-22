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
$route['addfile']					= 'Caddfile';
$route['listsv']					= 'Clistsv';
$route['listsv/:num']				= 'Clistsv/index/$1';
$route['inbangdiem']    			= 'Cinbangdiem';
$route['statistical']				= 'Cstatistical';
