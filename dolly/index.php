<?php
/**
 * CodeIgniter
 * Standard index.php Framework Launcher
 */

// ⭕ 僅保留最標準的環境校正變數，其餘所有自訂的 if 斷路器、exit 全部拔除！
$_SERVER['SCRIPT_NAME'] = '/dolly/index.php';

define('ENVIRONMENT', 'development');

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;
	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		} else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;
	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

$system_path = 'system';
$application_folder = 'application';
$view_folder = '';

if (defined('STDIN')) {
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE) {
	$system_path = $_temp.DIRECTORY_SEPARATOR;
} else {
	$system_path = rtrim($system_path, '/\\').DIRECTORY_SEPARATOR;
}

if ( ! is_dir($system_path)) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'Your system folder path does not appear to be set correctly.';
	exit(3); // EXIT_CONFIG
}

define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BFPATH', ''); // 墊底相容
define('BASEPATH', $system_path);
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('SYSDIR', basename(BASEPATH));

if (is_dir($application_folder)) {
	if (realpath($application_folder) !== FALSE) {
		$application_folder = realpath($application_folder);
	}
	define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);
} else {
	if ( ! is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR)) {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your application folder path does not appear to be set correctly.';
		exit(3); // EXIT_CONFIG
	}
	define('APPPATH', BASEPATH.$application_folder.DIRECTORY_SEPARATOR);
}

if ( ! is_dir($view_folder)) {
	if ( ! empty($view_folder) && is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR)) {
		$view_folder = APPPATH.$view_folder.DIRECTORY_SEPARATOR;
	} elseif (is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR)) {
		$view_folder = APPPATH.'views'.DIRECTORY_SEPARATOR;
	} else {
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your view folder path does not appear to be set correctly.';
		exit(3); // EXIT_CONFIG
	}
}

define('VIEWPATH', $view_folder);

// ⭕ 讓標準核心在 PHP 7.4 舒適圈順暢跑完生命週期！
require_once BASEPATH.'core/CodeIgniter.php';

