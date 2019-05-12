<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_Model extends CI_Model{
    
    public function footer_text(){
       
       $db_resousce = $this->db->get_where('tbl_footer',['footer_id'=>0]);
       $footer_db_result = $db_resousce->row_array();
       $data['footer_text'] = $footer_db_result['footer_text'];
       return $data;
    }
    
    public function update_footer(){
 
            $data = $this->input->post('footer_text');
            $data = $this->security->xss_clean($data);
            $this->db->where('footer_id', '0');
            $data = $this->db->update('tbl_footer',[ 'footer_text' => $data]);
            if($data == true){
                $error = ['class'=>'warning','text'=> 'Footer text update successfully'];
                $this->session->set_flashdata('sms_flash', $error);
            }
            redirect('Dashboard/brand');
    }
}
