<?php

class Auth 
{
    
    protected $CI;
    
    function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->library('encryption');
    }
    
    function set_formToken()
    {
        $formToken = bin2hex($this->CI->encryption->create_key(16));
        $this->CI->session->set_userdata('formToken',$formToken);
        return  $formToken;
    }
    
    
    function unset_formToken()
    {
        $this->CI->session->unset_userdata('formToken');
    }
    
    function isvalid_formToken()
    {
        $result = ( $this->CI->session->userdata('formToken') == $this->CI->input->post('formToken') )?true:false;
        $this->unset_formtoken();
        return $result;
    }
}
