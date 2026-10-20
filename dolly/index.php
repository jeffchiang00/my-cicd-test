<?php
/**
 * CodeIgniter
 * Standard index.php Framework Launcher (語法完美修正 + 官方路由重置版)
 */
// ⭕ 動態對齊：確保 SCRIPT_NAME 完美符合子目錄結構
$_SERVER['SCRIPT_NAME'] = '/dolly/index.php';

// ⭕ 修正核心：如果發現網址戳進 /dolly/，我們幫它補齊內部的路徑識別，但「絕對不要」把 URI 的 /dolly/ 抹除！
if ($_SERVER['REQUEST_URI'] === '/dolly/' || $_SERVER['REQUEST_URI'] === '/dolly') {
    $_SERVER['PATH_INFO'] = '/tw/';
    $_SERVER['REQUEST_URI'] = '/dolly/index.php/tw/';
    $_SERVER['PHP_SELF']    = '/dolly/index.php/tw/';
}

if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://192.168.0.109');
}

define('ENVIRONMENT', 'development');

// ⭕ 2. 完美對齊 switch 區塊，絕對不會再噴出第 66 行的 unexpected end of file 錯誤！
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;
	default:
		ini_set('display_errors', 0);
		error_reporting(0);
	break;
}

$system_path = 'system';
$application_folder = 'application';
$view_folder = '';

if (defined('STDIN')) { chdir(dirname(__FILE__)); }
if (($_temp = realpath($system_path)) !== FALSE) { $system_path = $_temp.DIRECTORY_SEPARATOR; } 
else { $system_path = rtrim($system_path, '/\\').DIRECTORY_SEPARATOR; }

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BFPATH', '');
define('BASEPATH', $system_path);
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('SYSDIR', basename(BASEPATH));

if (is_dir($application_folder)) {
	define('APPPATH', realpath($application_folder).DIRECTORY_SEPARATOR);
} else {
	define('APPPATH', BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
}

$view_folder = is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR) ? APPPATH.'views'.DIRECTORY_SEPARATOR : '';
define('VIEWPATH', $view_folder);

// 順暢載入核心，在 PHP 7.4 舒適圈完美爆發生命週期！
require_once BASEPATH.'core/CodeIgniter.php';

