<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model('Frontend_Data_Model','data_model');
        
    }
    
    public function index()
    {
        $data = $this->data_model->view_data();
        $this->load->view('frontend/head',$data);
        
        $this->load->model('Frontend_Model');
        $data = $this->Frontend_Model->home_page();
        $this->load->view('frontend/index',$data);
    }
    
    public function article( $unid = false)
    {
        if($unid == false) redirect (base_url());
        
        $data = $this->data_model->view_data();
        
        $this->load->model('Frontend_Model');
        $data['detaile'] = $this->Frontend_Model->post_detail($unid);
        
        $this->load->view('frontend/head_detail',$data);
        $this->load->view('frontend/detail');
//        echo '<pre>';
//        print_r($data);
    }
    public function id($id)
    {
        if($id == false) redirect (base_url());
        $this->session->set_userdata('cat_id',$id);
        redirect(base_url('news/category'));
    }

    public function category()
    {   
        $data = $this->data_model->view_data();
        $this->load->view('frontend/head',$data);
        
        $this->load->model('Frontend_Model');
        $data = $this->Frontend_Model->category_post();
        $this->load->view('frontend/category',$data);
    }
}
