<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Nav_Model extends CI_Model{
    //put your code here
    public function add_nav(){
        $nav_name = (string)$this->input->post('nav_name');

        $dataa = [
                    'nav_name' =>  $nav_name ,
                    'nav_unid' => uniqid(),
                ];
        $data = $this->security->xss_clean($dataa);
        
        if($this->db->insert('tbl_navigation',$data))
        {
            $seccess = ['class'=>'success','text'=> 'Navigation Create Successfully'];
            $this->session->set_flashdata('sms_flash', $seccess);                  
            redirect('Dashboard/navigation');
        } else {
            $error = ['class'=>'warning','text'=> 'Navigation Creation Failed'];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/navigation');
        }
    }
   
    public function view_nav(){
        
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/Dashboard/navigation';
            $config['total_rows'] = $this->db->count_all('tbl_navigation');
            $config['per_page'] = 8;
            
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
            
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['nav_info'] = $this->get_search_nav( $config['per_page'], $this->uri->segment(3) );
        return $data;
    }
    
    public function get_search_nav($limit, $start, $search = null){
            $limit = (string)$limit;
            $start = (string)$start;
            $search = (string)$search;
            //echo $limit.' '.$start." ".$search;
            $query = $this->db
                            ->like('nav_name', $search)
                            ->limit($limit, $start)
                            ->order_by("nav_id", "desc")
                            ->get('tbl_navigation');

            $data = $query->result_array();
            return $data;
    }
    
     public function nav_delete($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('nav_unid', $id);
            if($this->db->delete('tbl_navigation') == true)
            {
                $error = ['class'=>'success','text'=> 'Navigation Deleted successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/navigation');
            } else {
                redirect('Dashboard/navigation');
            }      
        }else{
            redirect('Dashboard/navigation');
        }
    }
    
     public function nav_update(){
       
      
            $nav_name = $this->security->xss_clean($this->input->post('nav_name'));
            $nav_unid = (string)$this->input->post('nav_unid');
            $this->db->where('nav_unid', $nav_unid);
            if($this->db->update('tbl_navigation',['nav_name'=>$nav_name]) == true)
            {
                $error = ['class'=>'success','text'=> 'Navigation Update successfully'];
                $this->session->set_flashdata('sms_flash', $error);   
            }     
        
    }
    
    
    
    
    
    
    
}
