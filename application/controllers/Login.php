<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();        
    }

    public function index() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') $this->check_login (); 
       
        $this->load->view('admin/login');
    }

    public function check_login() {
     
        
            if ($this->form_validation->run('admin_login') == true)
            {
               $username = $this->input->post('username');
               $password = $this->input->post('password');
               
               $this->load->model('Login_Model');
               $this->Login_Model->login_validation($username,$password);

            } else {
                  $error = ['class'=>'warning','text'=> validation_errors()];
                  $this->session->set_flashdata('login_flash', $error);
                  redirect('Login');
            }
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
