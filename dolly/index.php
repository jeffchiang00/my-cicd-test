<?php
/**
 * CodeIgniter
 * Standard index.php Framework Launcher + 終極反彈跳裝甲
 */

// ⭕ 終極防線：在全框架任何原始碼長出來之前，開啟輸出緩衝區並掛載自訂回呼函數
// 這會強制沒收全網頁所有的 Location 跳轉 Header，並強制把狀態碼洗回 200！
ob_start(function($buffer) {
    foreach (headers_list() as $header) {
        if (stripos($header, 'Location:') !== false) {
            // 抓到了！有人想發動 301/302 跳轉！
            // 我們直接強行清除所有跳轉 Header，並把狀態碼校正回 200 OK
            header_remove('Location');
            header("HTTP/1.1 200 OK", true, 200);
            header("Status: 200 OK", true, 200);
            
            // 既然有人想跳轉，代表畫面可能被清空了。
            // 我們在最安全墊底的情況下，至少提示或直接把核心準備好的緩衝區畫面吐出來！
            return $buffer;
        }
    }
    return $buffer;
});

// ⭕【最後的黃金拼圖】在裝甲下方直接補上常數宣告，徹底根除 global_model.php 的 Warning！
if (!defined('SITE_URL')) {
    define('SITE_URL', 'http://192.168.0.109');
}

// 確保基礎環境變數對齊
$_SERVER['SCRIPT_NAME'] = '/dolly/index.php';

// 確保基礎環境變數對齊
$_SERVER['SCRIPT_NAME'] = '/dolly/index.php';
if (strpos($_SERVER['REQUEST_URI'], '/dolly/tw') === false) {
    // 欺騙大腦已經在語系目錄下
    $_SERVER['REQUEST_URI'] = '/dolly/index.php/tw/';
    $_SERVER['PATH_INFO'] = '/tw';
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

// 載入核心。此時內部不論怎麼呼叫 exit 或 redirect，都逃不出最上方的 ob_start 攔截網！
require_once BASEPATH.'core/CodeIgniter.php';

