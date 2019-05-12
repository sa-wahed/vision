<?php   defined('BASEPATH') OR exit('No direct script access allowed');


class User_Model extends CI_Model{
    //put your code here
    
    public function create_user(){
        
         $password =  $this->security->xss_clean($this->input->post('password')); 
         $username =  $this->security->xss_clean($this->input->post('username'));
         $user_pass = $this->security->xss_clean($this->input->post('user_pass'));
         $conf_pass = $this->security->xss_clean($this->input->post('confirm_pass'));
        
       if( $user_pass === $conf_pass)
       {
            $query = $this->db->get_where('tbl_admin',['admin_id'=>'1','password'=> md5('!@#$%^&*'.md5($password)) ]);
            $data = $query->row_array();

            if($data == true)
            {
                $data = [
                        'username' => $username,
                        'password' => md5('!@#$%^&*'.md5($user_pass)),
                        'admin_role' => '1',
                        ];
                
                if( $this->db->insert('tbl_admin',$data) )
                {
                    $error = ['class'=>'info','text'=> 'User Creare successfully'];
                    $this->session->set_flashdata('sms_flash', $error);  
                    redirect('Dashboard/user');
                } else {
                    redirect('Dashboard/user');
                }
                
            }else {
           
                $error = ['class'=>'warning','text'=> 'Invalid Password'];
                $this->session->set_flashdata('sms_flash', $error);  
                redirect('Dashboard/user');
            }   
       } else {
           
            $error = ['class'=>'warning','text'=> 'User & Confirm password don\'t match'];
            $this->session->set_flashdata('sms_flash', $error);  
            redirect('Dashboard/user');
       }
    }
    
    public function view_admin(){
        
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/Dashboard/user';
            $config['total_rows'] = $this->db->count_all('tbl_admin');
            $config['per_page'] = 5;
            
            $config['full_tag_open'] = '<div class="pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '</a></li>';
            
            $config['prev_link'] = '←';
            $config['next_link'] = '→';
            
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['first_link'] = 'First';
            
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['last_link'] = 'Last';
            $uri_segment_3 = (string)$this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['page'] = ($uri_segment_3) ? $uri_segment_3 : 0;
        $data['admin_info'] = $this->get_search_result( $config['per_page'], $this->uri->segment(3) );
        return $data;
    }
    
    public function get_search_result($limit, $start){
            //echo $limit.' '.$start." ".$search;
            $query = $this->db
                            ->limit($limit, $start)
                            ->get('tbl_admin');
            $data = $query->result_array();
            return $data;
    }
    
    public function delete_user($data){
        $id = (string)$data;
        if($id == '1')
        {
            $error = ['class'=>'warning','text'=> 'User Deleted Error'];
            $this->session->set_flashdata('sms_flash', $error);  
            redirect('Dashboard/user'); 
        }else{
            
               $this->db->where('admin_id', $id);
            if($this->db->delete('tbl_admin') == true)
            {
                $error = ['class'=>'info','text'=> 'User Deleted successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/user');
            }else{
                $error = ['class'=>'danger','text'=> 'User Deleted Error'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/user');
            }
        }
    }
    
    public function update_user(){
        
        $id =(string) $this->input->post('update');
        $admin_role =(string) $this->input->post('admin_role');
        
        if($admin_role == '0' || $admin_role == '1' || $admin_role == '5')
        {
            if($id == '1')
            {
                $error = ['class'=>'warning','text'=> 'Admin role Updated Error'];
                $this->session->set_flashdata('sms_flash', $error);  
                redirect('Dashboard/user'); 
            }
               $this->db->where('admin_id',$id);
            if($this->db->update('tbl_admin',['admin_role'=>$admin_role]) == true)
            {
                $error = ['class'=>'info','text'=> 'Admin role updated successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/user');
            } else {
                show_404();
            }
        } else {
            show_404();
        }    
    }
    
}
