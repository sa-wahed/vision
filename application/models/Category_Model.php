<?php   defined('BASEPATH') OR exit('No direct script access allowed');


class Category_Model extends CI_Model{
    
    public function add_category(){
        $cat_name = (string)$this->input->post('cat_name');
        $cat_status = (string)$this->input->post('cat_status');
        $data = [
                    'cat_name' =>  $cat_name ,
                    'cat_unid' => uniqid(),
                    'cat_status' =>  $cat_status,
                ];
        $data = $this->security->xss_clean($data);
        
        if($this->db->insert('tbl_category',$data))
        {
            $seccess = ['class'=>'success','text'=> 'Category Create Successfully'];
            $this->session->set_flashdata('sms_flash', $seccess);                  
            redirect('Dashboard/category');
        } else {
            $error = ['class'=>'warning','text'=> 'Category Create Failed'];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/category');
        }
    }
    
    public function view_category()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url().'/Dashboard/category';
        $config['total_rows'] = $this->db->count_all('tbl_category');
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
        $data['page'] = ($uri_segment_3) ? (integer)$uri_segment_3 : 0;
        $data['cat_info'] = $this->get_search_category( $config['per_page'], $this->uri->segment(3) );
        return $data;
    }

    
    public function search_view(){
        $this->load->library('pagination');
        // get search string
        $search = ($this->input->post("cat_name"))? (string)$this->input->post("cat_name") : "NIL";
        $search = ($this->uri->segment(3)) ? (string)$this->uri->segment(3) : $search;
   
        // pagination settings
        $config = array();
        $config['base_url']     = site_url("Dashboard/category_search/$search");
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
        $data['cat_info'] = $this->get_search_category($config['per_page'], $data['page'], $search);
        return $data;
          }
    
    public function get_search_category($limit, $start, $search = null){
            //echo $limit.' '.$start." ".$search;
            $query = $this->db
                            ->like('cat_name', $search)
                            ->limit($limit, $start)
                            ->order_by("cat_id", "desc")
                            ->get('tbl_category');

            $data = $query->result_array();
            return $data;
    }
        
    public function num_rows($data){
        $query = $this->db
                        ->like('cat_name',$data)
                        ->get('tbl_category');
        $data = $query->num_rows();
        return $data;
    }
    
    public function cat_publish($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('cat_unid', $id);
            if($this->db->update('tbl_category', ['cat_status' => '1']) == true)
            {
                $error = ['class'=>'success','text'=> 'Category Published successfully'];
                $this->session->set_flashdata('sms_flash', $error);
            }     
        }
    }
    
    public function cat_unpublish($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('cat_unid', $id);
            if($this->db->update('tbl_category', ['cat_status' => '0']) == true)
            {
                $error = ['class'=>'success','text'=> 'Category Unpublished successfully'];
                $this->session->set_flashdata('sms_flash', $error); 
            }      
        }
    }
    
    public function cat_delete($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->db->where('cat_unid', $id);
            if($this->db->delete('tbl_category') == true)
            {
                $error = ['class'=>'success','text'=> 'Category Deleted successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/category');
            } else {
                redirect('Dashboard/category');
            }      
        }else{
            redirect('Dashboard/category');
        }
    }
    public function cat_update()
    {
            $cat_name = (string)$this->input->post('cat_name');
            $cat_unid = (string)$this->input->post('cat_unid');
            $this->db->where('cat_unid', $cat_unid);
            if($this->db->update('tbl_category',['cat_name'=>$cat_name]) == true)
            {
                $error = ['class'=>'success','text'=> 'Category Update successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/category');
            } else {
                redirect('Dashboard/category');
            }      
        
    }
        
            
}
