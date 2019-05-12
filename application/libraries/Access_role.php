<?php


class Access_role
{
    protected $CI;
        
    function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->library('encryption');
    }
    function not_Active()
    {
        if( $this->CI->session->userdata('admin_role')== FALSE || $this->CI->session->userdata('user_id')==FALSE )
        {
            redirect(base_url('login')); 
        }
    }
            
    function is_Active()
    {
        if($this->CI->session->userdata('admin_role') == 5 ||  $this->CI->session->userdata('admin_role') == 1 || $this->CI->session->userdata('admin_role') == '*')
        {
            return true;
        } else {
            return false;
        } 
    }
    
    function is_Author()
    {
                
        if($this->CI->session->userdata('admin_role') == '5' ||  $this->CI->session->userdata('admin_role') == '*')
        {
            return true;
        } else {
            return FALSE;
        }
    }
    
    function is_Admin()
    {
               
        if($this->CI->session->userdata('admin_role') == '*' ) 
        {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
}
