<?php

// ⭕ 終極環境校正：修正 SCRIPT_NAME 並動態補齊尾部斜線，徹底粉碎語系套件的 301 跳轉死結！
$_SERVER['SCRIPT_NAME'] = '/dolly/index.php';

// 關鍵防線：如果 Nginx 丟進來的網址是 /dolly/tw 或 /dolly/tw?xxxx，自動幫它補上斜線變成 /dolly/tw/
if (preg_match('/\/dolly\/tw(\?|$)/', $_SERVER['REQUEST_URI'])) {
    $_SERVER['REQUEST_URI'] = preg_replace('/\/dolly\/tw/', '/dolly/tw/', $_SERVER['REQUEST_URI'], 1);
}


error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

//if (!defined('SITE_URL')) {
//    define('SITE_URL', 'http://192.168.0');
//}

define('ENVIRONMENT', 'development');

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING);
		break;
	case 'testing':
	case 'production':
		error_reporting(0);
		ini_set('display_errors', 0);
		break;
	default:
		exit('The application environment is not set correctly.');
}

$system_path = 'system';
$application_folder = 'application';
$view_folder = 'application/views';

if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE)
{
	$system_path = $_temp.'/';
}
else
{
	$system_path=rtrim($system_path, '/').'/';
}

if ( ! is_dir($system_path))
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
	exit(3);
}

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', str_replace('\\', '/', $system_path));
define('FCPATH', dirname(__FILE__).'/');
define('SYSDIR', basename(BASEPATH));

if (is_dir($application_folder))
{
	if (realpath($application_folder) !== FALSE)
	{
		$application_folder=realpath($application_folder);
	}
	define('APPPATH', rtrim($application_folder, '/').'/');
}
else
{
	if ( ! is_dir(BASEPATH.$application_folder.'/'))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3);
	}
	define('APPPATH', BASEPATH.$application_folder.'/');
}

if (is_dir($view_folder))
{
	if (realpath($view_folder) !== FALSE)
	{
		$view_folder=realpath($view_folder);
	}
	define('VIEWPATH', rtrim($view_folder, '/').'/');
}
else
{
	if ( ! is_dir(APPPATH.'views/'))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: '.SELF;
		exit(3);
	}
	define('VIEWPATH', APPPATH.'views/');
}

require_once BASEPATH.'core/CodeIgniter.php';
