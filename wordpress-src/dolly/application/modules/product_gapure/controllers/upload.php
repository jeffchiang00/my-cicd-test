<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MX_Controller {
	public $data;
	function __construct(){
        parent::__construct();
        $this->post = $this->input->post(null,true);
        $this->load->model('article_model','model');
    }

    public function cover_img(){
        $this->load->model('admin/upload_model');
        $this->upload_model->data_key = array('image_width');
        $img = $this->upload_model->img_upload('myCoverUpload_instance_0');

        //縮圖
        $thumbnail_size = json_decode($this->post['thumbnail_size']);
        if (count($thumbnail_size)){
            $this->upload_model->size = $thumbnail_size;
            $this->upload_model->img_fit($img['file']);
            $file_name = explode('/',$img['file']);

            $img = array('img_url'=>IMG_URL,'file'=>$file_name[0].'/'.file_core_name($file_name[1]).'_'.$thumbnail_size[0].'.'. file_extension($file_name[1]));
        }
        else{
            $file_name = explode('/',$img['file']);
            $img = array('img_url'=>IMG_URL,'file'=>$file_name[0].'/'.file_core_name($file_name[1]).'.'. file_extension($file_name[1]));
        }
        echo json_encode($img);
        exit;
    }

    public function gallery_img(){
        $this->load->model('admin/upload_model');
        $this->upload_model->data_key = array('image_width');
        $img = $this->upload_model->img_upload('myGalleryUpload_instance');

        //縮圖
        $thumbnail_size = json_decode($this->post['thumbnail_size']);
        if (count($thumbnail_size)){
            $this->upload_model->size = $thumbnail_size;
            $this->upload_model->img_fit($img['file']);
            $file_name = explode('/',$img['file']);

            $img = array('img_url'=>IMG_URL,'file'=>$file_name[0].'/'.file_core_name($file_name[1]).'_'.$thumbnail_size[0].'.'. file_extension($file_name[1]));
        }
        else{
            $file_name = explode('/',$img['file']);
            $img = array('img_url'=>IMG_URL,'file'=>$file_name[0].'/'.file_core_name($file_name[1]).'.'. file_extension($file_name[1]));
        }
        echo json_encode($img);
        exit;
    }

    public function template_upload(){
        $this->load->model('admin/upload_model');
        $this->upload_model->data_key = array('image_width');
        $img = $this->upload_model->img_upload('template_file_input');
        $img = $this->upload_model->resize($img['file'],$this->post['width']);
        $file_name = explode('/',$img['file']);
        $img = array('img_url'=>IMG_URL,'file'=>$file_name[0].'/'.file_core_name($file_name[1]).'.'. file_extension($file_name[1]));
        echo json_encode($img);
        exit;
    }
}