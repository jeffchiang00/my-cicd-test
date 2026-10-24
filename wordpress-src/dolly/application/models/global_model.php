<?PHP if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_model extends CI_Model {
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->post = $this->input->post(NULL,TRUE);
        $this->get = $this->input->get(NULL,TRUE);
        $this->load->library('cart');
        $this->load->library('email');
        $this->config->set_item('storeid', '010370705');
        $this->config->set_item('cubkey', 'f166746926cb5ebe402e0916585d481b');
        $this->config->set_item('mccode', '020370007000');
        $this->config->set_item('atmkey', '6119');
        $this->config->set_item('credit_url','https:// [hostname]/NewebmPP/cdcard.jsp');//測試交易網址https://testmaple2.neweb.com.tw/NewebmPP/cdcard.jsp
        $this->config->set_item('credit_id','');//測試ID 760319
        $this->config->set_item('credit_pwd','');//測試CODE abcd1234

        //$this->language = array('en','cn','tw');
        $this->language = array('cn','tw');
        $this->site_init();
    }

    private function site_init(){
        //判斷語系
        if ($this->uri->segment(1)!='payment'){
            $this->set_language();
        }
        $this->language_sort = $this->get_language_sort();
        //
        $this->load->library('cart');
        $_SESSION[SITE_CART_ITEMS] = $this->cart->total_items();
        //是否登入
        if (isset($_COOKIE["email"]) && isset($_COOKIE["pwd"])){
            $this->load->model('member_model');
            $this->member_model->login_cookie();
        }
    }

    private function set_language(){
        if (!isset($_SESSION['user_detault_locale']) || !in_array($this->uri->segment(1),$this->language) ){
            
             $browser_lang = !empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? strtok(strip_tags($_SERVER['HTTP_ACCEPT_LANGUAGE']), ',') : '';
            // $browser_lang = substr($browser_lang, 0,2);
           
             //   $browser_lang = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

            $str_uri = '';
            if (strlen($this->uri->uri_string)>0){
                $str_uri = $this->uri->uri_string;
            }
            //exit('tw/'.$str_uri) ;
            switch($browser_lang){
                case 'zh-TW':
                    $_SESSION['user_detault_locale'] = 'tw';
                    if (in_array($this->uri->segment(1),$this->language)===false){
                        $str_uri = $_SESSION['user_detault_locale'] . '/' . $str_uri;
                    }
                    header ('HTTP/1.1 301 Moved Permanently');
                    header ('Location: '.SITE_URL.($str_uri==''?'tw': $str_uri));
                    break;
                case 'zh-CN':
                    $_SESSION['user_detault_locale'] = 'cn';
                    if (in_array($this->uri->segment(1),$this->language)===false){
                        $str_uri = $_SESSION['user_detault_locale'] . '/' . $str_uri;
                    }
                    header ('HTTP/1.1 301 Moved Permanently');
                    header ('Location: '.SITE_URL.($str_uri==''?'cn': $str_uri));
                    break;
                default:
                    // $_SESSION['user_detault_locale'] = 'en';
                    // if (in_array($this->uri->segment(1),$this->language)===false){
                    //     $str_uri = $_SESSION['user_detault_locale'] . '/' . $str_uri;
                    // }
                    // header ('HTTP/1.1 301 Moved Permanently');
                    // header ('Location: '.SITE_URL.($str_uri==''?'en': $str_uri));

                    //2014-12-25 預設繁中
                    $_SESSION['user_detault_locale'] = 'tw';
                    if (in_array($this->uri->segment(1),$this->language)===false){
                        $str_uri = $_SESSION['user_detault_locale'] . '/' . $str_uri;
                    }
                    header ('HTTP/1.1 301 Moved Permanently');
                    header ('Location: '.SITE_URL.($str_uri==''?'tw': $str_uri));
                    break;
            }
            exit;
        }
        else

            
        $_SESSION['lang'] = $this->uri->segment(1);

    }

    public function get_language_sort(){
        //2014-12-25 英文先關閉
        switch($_SESSION['lang']){
            case 'tw':
                return array(
                        array('tw','繁'),
                        //array('en','EN'),
                        array('cn','簡')
                    );
                break;
            // case 'en':
            //     return array(
            //             array('en','EN'),
            //             array('tw','繁'),
            //             array('cn','簡')
            //         );
            //     break;
            case 'cn':
                return array(
                        array('cn','簡'),
                        //array('en','EN'),
                        array('tw','繁')
                    );
                break;
        }
    }
}
?>