<?php
/**
 * CodeIgniter
 * Standard index.php Framework Launcher
 */


// ⭕ 請精準修改為以下無誤的黃金常數：
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://192.168.0.109');
}

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

// 📁 dolly/index.php 檔案最下方全盤替換：

// 1. 在框架大腦啟動前，開啟 PHP 輸出緩衝區，把接下來所有產生的畫面全部攔截在記憶體內
ob_start();

// 2. 讓 CodeIgniter 7.4 核心安全、順暢地去跑完資料庫、模型與視圖渲染
require_once BASEPATH.'core/CodeIgniter.php';

// 3. 【黃金攔截點】核心執行到這裡時，畫面已經在緩衝區準備好了！
// 我們無視後續任何老舊語系套件企圖拋出的 301 Header，強行把畫面抓出來吐給瀏覽器！
if (strpos($_SERVER['REQUEST_URI'], '/dolly') !== false && !strpos($_SERVER['REQUEST_URI'], 'assets')) {
    // 強制洗掉可能已經被丟進來的 301/302 狀態碼，全面校正回 200 OK！
    header("HTTP/1.1 200 OK");
    header("Status: 200 OK");
    
    // 把記憶體內精美的網頁 HTML 首頁畫面直接噴印出來
    echo ob_get_clean();
    
    // ⭕ 物理斷路！直接就地強制終止 PHP，徹底剝奪任何元件發動 301 重新整理的權利！
    exit; 
}

