<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_Model extends CI_Model{
    
    //put your code here
    public function add_tag(){
        $tag_name = (string)$this->input->post('tag_name');
        $tag_status = (string)$this->input->post('tag_status');

        $data = [
                    'tag_name' =>  $tag_name ,
                    'tag_unid' => uniqid(),
                    'tag_status' =>  $tag_status,
                ];
        $data = $this->security->xss_clean($data);
        if($this->db->insert('tbl_tag',$data))
        {
            $seccess = ['class'=>'success','text'=> 'Tag Create Successfully'];
            $this->session->set_flashdata('sms_flash', $seccess);                  
            redirect('Dashboard/tag');
        } else {
            $error = ['class'=>'warning','text'=> 'Tag Create Failed'];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/tag');
        }
    }
    
    public function view_tag(){
        
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/Dashboard/tag';
            $config['total_rows'] = $this->db->count_all('tbl_tag');
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
            
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['tag_info'] = $this->get_search_tags( $config['per_page'], $this->uri->segment(3) );
        return $data;
    }
    
    public function search_view(){
        $this->load->library('pagination');
        // get search string
        $search = ($this->input->post("tag_name"))? (string)$this->input->post("tag_name") : "NIL";
        $search = ($this->uri->segment(3)) ? (string)$this->uri->segment(3) : $search;
   
        // pagination settings
        $config = array();
        $config['base_url']     = site_url("Dashboard/tag_search/$search");
        $config['total_rows']   = $this->num_rows($search);
        $config['per_page']     = "8";
        $config["uri_segment"]  = 4;
        $choice                 = $config["total_rows"]/$config["per_page"];
        $config["num_links"]    = floor($choice);
        
        // integrate bootstrap pagination
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

        $data['page'] = ($this->uri->segment(4)) ? (string)$this->uri->segment(4) : 0;
        // get books list
        $data['tag_info'] = $this->get_search_tags($config['per_page'], $data['page'], $search);
        return $data;
    }
    
    public function get_search_tags($limit, $start, $search = null){
            $limit = (string)$limit;
            $start = (string)$start;
            $search = (string)$search;
            //echo $limit.' '.$start." ".$search;
            $query = $this->db
                            ->like('tag_name', $search)
                            ->limit($limit, $start)
                            ->order_by("tag_id", "desc")
                            ->get('tbl_tag');

            $data = $query->result_array();
            return $data;
    }
    
    public function num_rows($search){
        $query = $this->db
                        ->like('tag_name',$search)
                        ->get('tbl_tag');
        $data = $query->num_rows();
        return $data;
    }
    
    public function tag_publish($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('tag_unid', $id);
            if($this->db->update('tbl_tag', ['tag_status' => '1']) == true)
            {
                $error = ['class'=>'success','text'=> 'Tag Published successfully'];
                $this->session->set_flashdata('sms_flash', $error);
            }     
        }
    }
    
    public function tag_unpublish($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('tag_unid', $id);
            if($this->db->update('tbl_tag', ['tag_status' => '0']) == true)
            {
                $error = ['class'=>'success','text'=> 'Tag Unpublished successfully'];
                $this->session->set_flashdata('sms_flash', $error); 
            }     
        }
    }
    
    public function tag_delete($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('tag_unid', $id);
            if($this->db->delete('tbl_tag') == true)
            {
                $error = ['class'=>'success','text'=> 'Tag Deleted successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
               
            }      
        }
    }
    
    
    public function tag_update()
    {
        $cat_name = (string)$this->input->post('tag_name');
        $cat_unid = $data = $this->security->xss_clean($this->input->post('tag_unid'));
        
        $this->db->where('tag_unid', $cat_unid);
        if($this->db->update('tbl_tag',['tag_name'=>$cat_name]) == true)
        {
            $error = ['class'=>'success','text'=> 'Tag Update successfully'];
            $this->session->set_flashdata('sms_flash', $error); 
        }
    }
    
    
    
    
    
    
    
    
    
    
    
}

