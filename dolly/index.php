<?php
/**
 * CodeIgniter
 * Standard index.php Framework Launcher (真・正統環境校正版)
 */
// ⭕ 終極環境淨化：直接將所有可能引發語系控制器 301 彈跳的變數全部校正回帶有斜線的原生格式！
$_SERVER['SCRIPT_NAME'] = '/dolly/index.php';

// 核心防線：管它外面是從哪裡戳進來，只要走到 dolly 專案，我們強制把路由變數鎖死在最標準的 welcome/ 格式（尾部帶斜線）
$_SERVER['PATH_INFO']   = '/tw/welcome/';
$_SERVER['REQUEST_URI'] = '/dolly/index.php/tw/welcome/';
$_SERVER['PHP_SELF']    = '/dolly/index.php/tw/welcome/';

if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://192.168.0.109/dolly/');

// 關鍵核心：當使用者戳 /dolly/ 時，強行將內部的 PATH_INFO 修正為 welcome，讓核心不走進語系彈跳，直接載入首頁！
if ($_SERVER['REQUEST_URI'] === '/dolly/' || $_SERVER['REQUEST_URI'] === '/dolly' || $_SERVER['REQUEST_URI'] === '/dolly/index.php/') {
    $_SERVER['PATH_INFO'] = '/welcome';
}

if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://192.168.0.109/dolly/');
}

define('ENVIRONMENT', 'development');

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

// 載入核心。此時沒有任何 ob_start 阻礙，PHP 核心將會以最健康、最高效的姿態跑完生命週期！
require_once BASEPATH.'core/CodeIgniter.php';
?>
