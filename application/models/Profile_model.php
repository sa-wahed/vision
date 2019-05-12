<?php   defined('BASEPATH') OR exit('No direct script access allowed');


class Profile_model extends CI_Model{
    //put your code here
    
    public function admin_info(){
        
        $query = $this->db
                        ->where('admin_id', $this->session->userdata('user_id'))
                        ->select('password,admin_email,admin_photo,admin_name,admin_fb')
                        ->get('tbl_admin');
        $data['admin_info'] = $query->result_array();
        return $data;
    }
    
    public function update_pass(){
        
        $password =  $this->security->xss_clean( $this->input->post('current_pass'));
        $new_pass = $this->security->xss_clean( $this->input->post('new_pass'));
        $con_pass = $this->security->xss_clean( $this->input->post('confirm_pass'));
         
       if( $new_pass === $con_pass)
       {
            $query = $this->db
                            ->where('admin_id',$this->session->userdata('user_id'))
                            ->where('password',md5('!@#$%^&*'.md5($password)) )
                            ->get('tbl_admin');
            $data= $query->result();

            if($data == true)
            {
                $this->db->where('admin_id', $this->session->userdata('user_id'));
                if( $this->db->update('tbl_admin',['password'=>md5('!@#$%^&*'.md5($new_pass))]) )
                {
                    $error = ['class'=>'info','text'=> 'Password Update Successfully'];
                    $this->session->set_flashdata('sms_flash', $error);  
                    redirect('Dashboard/profile');
                } else {
                    redirect('Dashboard/profile');
                }
                
            }else {
           
                $error = ['class'=>'warning','text'=> 'Current password not match'];
                $this->session->set_flashdata('sms_flash', $error);  
                redirect('Dashboard/profile');
            }   
       } else {
           
            $error = ['class'=>'warning','text'=> 'New & Confirm password don\'t match'];
            $this->session->set_flashdata('sms_flash', $error);  
            redirect('Dashboard/profile');
       }
        
    }
    
    public function update_profile(){
        $name = $this->security->xss_clean( $this->input->post('admin_name'));
        $email = $this->security->xss_clean( $this->input->post('admin_email'));
        $facebook = $this->security->xss_clean( $this->input->post('admin_fb'));
        
        $data = [
                    'admin_name' => $name,
                    'admin_email' => $email,
                    'admin_fb' => $facebook,
                ];
      
                $this->db->where('admin_id', $this->session->userdata('user_id'));
                if( $this->db->update('tbl_admin',$data) )
                {
                    $error = ['class'=>'info','text'=> 'Password Profile Successfully'];
                    $this->session->set_flashdata('sms_flash', $error);  
                    redirect('Dashboard/profile');
                } else {
                    redirect('Dashboard/profile');
                }
                
             

           
            $error = ['class'=>'warning','text'=> 'New & Confirm password don\'t match'];
            $this->session->set_flashdata('sms_flash', $error);  
            redirect('Dashboard/profile');

    }
    
    public function image_update(){
        
        $config['upload_path'] = 'images/user';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = 'image_' . uniqid();
            $config['overwrite'] = false;
            $config['max_size'] = '520';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('admin_image'))
        {
            $image_name =  (string)$config['file_name'].$this->upload->data()['file_ext'];
            
            $this->db->where('admin_id', $this->session->userdata('user_id'));
            if( $this->db->update('tbl_admin',['admin_photo'=>$image_name]) )
                {
                    $error = ['class'=>'info','text'=> ' Profile Photo Upload Successfully'];
                    $this->session->set_flashdata('sms_flash', $error);  
                    redirect('Dashboard/profile');
                }else{
                    redirect('Dashboard/profile');
                }
        } else {
            
            $error = ['class'=>'warning','text'=> $this->upload->display_errors()];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/profile'); 
        }
    }
    
}
