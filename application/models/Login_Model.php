<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model{
    
    public function login_validation($username, $password){
        
       $db_resousce = $this->db->get_where('tbl_admin',['username'=>$username,'password'=>md5('!@#$%^&*'.md5($password)) ]);
       $log_db_result = $db_resousce->row_array();
       
       if($log_db_result == true)
       {
           $this->session->set_userdata('user_id',$log_db_result['admin_id']);
           $this->session->set_userdata('admin_name',$log_db_result['admin_name']);
           $this->session->set_userdata('admin_role',$log_db_result['admin_role']);
           $this->session->set_userdata('username',$log_db_result['username']);
           
           redirect('Dashboard');
       } else {
           $error = ['class'=>'danger','text'=> 'Invalid Login'];
           $this->session->set_flashdata('login_flash',$error);
           redirect('Login');
       }
    }
    
    
    
    
    
    
    
    
    
    
    
}
