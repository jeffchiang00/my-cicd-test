<?php
session_start();
define('SITE_TITLE','DOLLY');
define('SITE_TITLE_ADMIN','DOLLY後台管理系統');
define("ADMIN_SITE_TITLE",'DOLLY後台管理系統');
define('SITE_URL','https://gapure.com/dolly/');//http://localhost/dolly/   //http://gapure.com/dolly/
define('IMG_URL','https://gapure.com/dolly/upload/');
define('ADMIN_URL','https://gapure.com/dolly/admin/');
define('ADMIN_SESSION','gapure_user_login');
define('ADMIN_ACTIVE','gapure_user_active');
if (!isset($_SESSION[ADMIN_SESSION])){
	$_SESSION[ADMIN_SESSION] = 0;
	$_SESSION[ADMIN_ACTIVE] = 0;
}
define('SITE_MEMBER_FIRST_NAME','gapure_member_first_name');
define('SITE_MEMBER_LAST_NAME','gapure_member_last_name');
define('SITE_MEMBER_EMAIL','gapure_member_email');
define('SITE_MEMBER_LOGIN','gapure_member_login');
if (!isset($_SESSION[SITE_MEMBER_LOGIN])){
	$_SESSION[SITE_MEMBER_LOGIN] = 0;
	$_SESSION[SITE_MEMBER_FIRST_NAME] = '';
	$_SESSION[SITE_MEMBER_LAST_NAME] = '';
	$_SESSION[SITE_MEMBER_EMAIL] = '';
}
define('SITE_CART_ITEMS','gapure_cart_count');
if (!isset($_SESSION[SITE_CART_ITEMS])){
	$_SESSION[SITE_CART_ITEMS] = 0;
}

//清空登入
//session_unset();
/*
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>";
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo "<meta charset='UTF-8' />";
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
echo "<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />";
echo "<meta property='fb:admins' content='1531802340' />";
echo "<meta property='fb:app_id' content='1720065518209265' />";

echo "<meta property='og:type' content='website' />";
echo "<meta property='og:url' content='http://gapure.com/dolly/index.php' />";
echo "<meta property='og:title' content='Dolly' />";
echo "<meta property='og:description' content='Dolly官方網站' />";
echo "<meta property='og:image' content='http://gapure.com/dolly/assets/img/about1.jpg' />";


if(preg_match("/\/dolly\/tw\/news\/post\//i", $_SERVER['REQUEST_URI'], $matches)){
    print "A match was found:". $matches[0];
    print "<br>" . $_SERVER['REQUEST_URI'];
} else {
    print "A match was not found.";
}
*/

//table define
define('admin_user','admin_user');
define('admin_func','admin_func');
define('article','article');
define('article_single_page','article_single_page');
define('article_type','article_type');
define('faq','faq');
define('tags','tags');
define('article_tags_assoc','article_tags_assoc');
define('product','product');
define('product_tags_assoc','product_tags_assoc');
define('product_image','product_image');
define('product_item','product_item');
define('product_color','product_color');
define('purchase','purchase');
define('purchase_item','purchase_item');
define('purchase_payment','purchase_payment');
define('purchase_statuses','purchase_statuses');
define('member','member');

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	define('ENVIRONMENT', 'production');
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			error_reporting(E_ALL);
		break;
	
		case 'testing':
		case 'production':
			error_reporting(0);
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

/*
 *---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
	$system_path = 'system';

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
	$application_folder = 'application';

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
	// The directory name, relative to the "controllers" folder.  Leave blank
	// if your controller is not in a sub-folder within the "controllers" folder
	// $routing['directory'] = '';

	// The controller class file name.  Example:  Mycontroller
	// $routing['controller'] = '';

	// The controller function you wish to be called.
	// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
	// $assign_to_config['name_of_config_item'] = 'value of config item';



// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

	// Set the current directory correctly for CLI requests
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (realpath($system_path) !== FALSE)
	{
		$system_path = realpath($system_path).'/';
	}

	// ensure there's a trailing slash
	$system_path = rtrim($system_path, '/').'/';

	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
	}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
	// The name of THIS file
	define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

	// The PHP file extension
	// this global constant is deprecated.
	define('EXT', '.php');

	// Path to the system folder
	define('BASEPATH', str_replace("\\", "/", $system_path));

	// Path to the front controller (this file)
	define('FCPATH', str_replace(SELF, '', __FILE__));

	// Name of the "system folder"
	define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


	// The path to the "application" folder
	if (is_dir($application_folder))
	{
		define('APPPATH', $application_folder.'/');
	}
	else
	{
		if ( ! is_dir(BASEPATH.$application_folder.'/'))
		{
			exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
		}

		define('APPPATH', BASEPATH.$application_folder.'/');
	}

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once BASEPATH.'core/CodeIgniter.php';

/* End of file index.php */
/* Location: ./index.php */

