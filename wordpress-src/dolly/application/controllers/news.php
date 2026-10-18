<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('global_model','global_model');
        $this->data['language_sort'] = $this->global_model->language_sort;
        $this->load->model('article_model','model');
    }

	public function index(){
		/*$this->data['type_id'] = 0;
		$this->data['rs'] = $this->model->get_rs(0,10);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);*/

		$this->data['type_id'] = 1;
		$this->data['rs'] = $this->model->get_rs(0,30,1);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 1;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}

	public function page($page,$records,$type=0){
		if ($page==2){
			$start = 10;
		}
		else{
			$start = ($page-1) * $records + 2;
		}
		$this->data['rs'] = $this->model->get_rs($start,$records,$type);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = false;
		$this->data['content_view'] = $this->load->view('article_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}

	public function post($id){
		$this->data['row'] = $this->model->get_row($id,1);
		if ($this->data['row']===false){
			show_404();
			exit;
		}
		$this->data['next'] = $this->model->get_next_prev($this->data['row']['next_id']);
		$this->data['prev'] = $this->model->get_next_prev($this->data['row']['prev_id']);
		$template_content = json_decode(urldecode($this->data['row']['template_content']));
		$lang = $this->data['language_sort'][0][0];
		$content = '';
		$arr_next_title = array('','');
		$arr_prev_title = array('','');
				$idx = 1;
				$title = $this->data['row']['title_tw'];
				$type_title = $this->data['row']['type_title_tw'];
				$next_title = $this->data['next']===false?'':nl2br($this->data['next']['title_tw']);
				$prev_title = $this->data['prev']===false?'':nl2br($this->data['prev']['title_tw']);

		if ($this->data['next']!==false){
			$link = SITE_URL . $_SESSION['lang'] . '/news/post/' . $this->data['next']['id'];
			$arr_next_title = array('<a href="'.$link.'">NEXT</a>','<img src="' . SITE_URL . 'assets/img/page_now_next.png"></td><td><a href="'.$link.'"><b>NEXT</b><br>'.$next_title.'</a>');
		}

		if ($this->data['prev']!==false){
			$link = SITE_URL . $_SESSION['lang'] . '/news/post/' . $this->data['prev']['id'];
			$arr_prev_title = array('<a href="'.$link.'">PREV</a>','<a href="'.$link.'"><b>PRENIOUS</b><br>'.$prev_title.'</a></td><td><img src="' . SITE_URL . 'assets/img/page_now_pre.png">');
		}

		if (count($template_content[$idx])>0){
			$content = $this->get_template($template_content[$idx]);
		}

		//相關文章
		$recommand = $this->model->get_recommand($id);
		$this->data['content_view'] = $this->load->view('news_post_view',array(
			'title'=>$title,
			'id'=>$id,
			'type_title'=>$type_title,
			'small_type_id'=>$this->data['row']['small_type_id2'],
			'article_date'=>strtotime($this->data['row']['article_date']),
			'template_content'=>$content,
			'next_title'=>$arr_next_title,
			'prev_title'=>$arr_prev_title,
			'cover_img'=>$this->data['row']['cover_img'],
			'youtube_url'=>$this->data['row']['youtube_url'],
			'post_type'=>"news",
			'recommand'=>$recommand
		),true);
		$this->load->view('master_view',$this->data);
	}

	private function get_template($template_content){
		$content = '';
		foreach($template_content as $template_info){
			$template_data = array(
				'view_id'=>$template_info->view_id,
				'content'=>$template_info->text,
				'img'=>$template_info->img
			);
			for($key=0;$key<count($template_data['img']);$key++){
				if ($template_data['img'][$key]==''){
					switch($template_data['view_id']){
						case 1:
							$template_data['img'][$key] = '';
							$template_data['default_img'][$key] = 'http://placehold.it/860x200';
							break;
						case 2:
							$template_data['img'][$key] = '';
							$template_data['default_img'][$key] = 'http://placehold.it/430x275';
							break;
					}
				}
				else{
					//$template_data['img'][$key] = IMG_URL . $template_data['img'][$key];
				}
			}
			$content .= $this->load->view('template/template_0' . $template_data['view_id'] . '_view',$template_data,true);
		}
		return $content;
	}

	public function class1(){
		$this->data['small_type_id'] = 1;
		$this->data['rs'] = $this->model->get_rs_by_smalltypeid(0,10,1,1);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 1;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}

	public function class2(){
		$this->data['small_type_id'] = 2;
		$this->data['rs'] = $this->model->get_rs_by_smalltypeid(0,10,2,1);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 2;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}

	public function class3(){
		$this->data['small_type_id'] = 3;
		$this->data['rs'] = $this->model->get_rs_by_smalltypeid(0,10,3,1);
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 3;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}
	public function old(){
		$this->data['type_id'] = 1;
		$this->data['rs'] = array_reverse($this->model->get_rs(0,9,1));
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 1;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}
	public function class1_old(){
		$this->data['small_type_id'] = 1;
		$this->data['rs'] = array_reverse($this->model->get_rs_by_smalltypeid(0,10,1,1));
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 1;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}

	public function class2_old(){
		$this->data['small_type_id'] = 2;
		$this->data['rs'] = array_reverse($this->model->get_rs_by_smalltypeid(0,10,2,1));
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 2;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}

	public function class3_old(){
		$this->data['small_type_id'] = 3;
		$this->data['rs'] = array_reverse($this->model->get_rs_by_smalltypeid(0,10,3,1));
		$this->data['rs'] = $this->data['rs']===false?array():$this->data['rs'];
		$this->data['is_page_1'] = true;
		$this->data['news_tag_idx'] = 3;
		$this->data['content_view'] = $this->load->view('news_list_view',$this->data,true);
		$this->load->view('master_view',$this->data);
	}
}
