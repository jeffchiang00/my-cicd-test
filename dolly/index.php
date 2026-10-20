<?php

// ⭕ 完全物理斷路器：無視一切 Nginx/Apache 尾部斜線與 301 跳轉，直接強行加載 Welcome 畫面並終止程式！
if (strpos($_SERVER['REQUEST_URI'], '/dolly') !== false && !strpos($_SERVER['REQUEST_URI'], 'assets')) {
    // 1. 強制宣告環境正常，堵住 CodeIgniter 的嘴
    $_SERVER['SCRIPT_NAME'] = '/dolly/index.php';
    
    // 2. 這裡就是關鍵：既然進來了，我們不讓 CI 語系控制器有機會發動 redirect()！
    // 我們直接親手引入 CodeIgniter 核心，並強制導向預設方法，然後直接 exit 斷路！
    require_once 'system/core/CodeIgniter.php';
    exit; 
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

// 終極防線：讓 CI3 官方核心安全地把常數、資料庫全部初始化完畢後，在發動跳轉前一瞬間，強行把畫面沒收並噴給瀏覽器！
if (strpos($_SERVER['REQUEST_URI'], '/dolly') !== false && !strpos($_SERVER['REQUEST_URI'], 'assets')) {
    $CI =& get_instance();
    // 強制呼叫 welcome 控制器的 index 首頁方法
    $CI->load->library('modules');
    if(class_exists('Welcome')) {
        $welcome = new Welcome();
        $welcome->index();
    } else {
        // 安全墊底：如果控制器名稱是大寫或 HMVC 模組，直接逼迫輸出大腦把渲染好的畫面吐出來
        $CI->output->_display();
    }
    exit; // ⭕ 物理斷路，絕對不給老舊語系套件有機會執行到下方的 301 redirect！
}
