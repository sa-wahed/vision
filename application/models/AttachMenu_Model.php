<?php   defined('BASEPATH') OR exit('No direct script access allowed');


class AttachMenu_Model extends CI_Model{
    //put your code here
    // START ATTACH NAVIGATION Functon 
    public function view_attach(){
        
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/Dashboard/attach_menu';
            $config['total_rows'] = $this->num_rows();
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
            $uri_segment_3 = (string)$this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['page'] = ($uri_segment_3) ? $uri_segment_3 : 0;
        $data['cat_info'] = $this->get_search_category( $config['per_page'], $this->uri->segment(3) );
        $data['nav_info'] = $this->navigation_info();
        return $data;
    }
    
    public function attach_search_view(){
        $this->load->library('pagination');
        // get search string
        $search = ($this->input->post("cat_name"))? (string)$this->input->post("cat_name") : "NIL";
        $search = ($this->uri->segment(3)) ? (string)$this->uri->segment(3) : $search;
   
        // pagination settings
        $config = array();
        $config['base_url']     = site_url("Dashboard/attach_search/$search");
        $config['total_rows']   = $this->search_num_rows($search);
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
        $data['nav_info'] = $this->navigation_info();
        return $data;
    }
          
     public function get_search_category($limit, $start, $search = null){
            //echo $limit.' '.$start." ".$search;
            $query = $this->db
                            ->where('cat_status','1')
                            ->like('cat_name', $search)
                            ->limit($limit, $start)
                            ->order_by("cat_id", "desc")
                            ->get('tbl_category');

            $data = $query->result_array();
            return $data;
        }
        
    public function search_num_rows($data){
        $query = $this->db
                        ->where('cat_status','1')
                        ->like('cat_name',$data)
                        ->get('tbl_category');
        $data = $query->num_rows();
        return $data;
    }
    public function num_rows(){
        $query = $this->db
                        ->where('cat_status','1')
                        ->get('tbl_category');
        $data = $query->num_rows();
        return $data;
    }
    
    public function navigation_info(){
        $query = $this->db->get('tbl_navigation');
        $data = $query->result_array();
        return $data;
    }
    
    public function attach_menu(){
        $cat_unid = (string) $this->input->post('cat_unid');
        $nav_id = (string) $this->input->post('nav_id');
        $nav_id = $this->security->xss_clean($nav_id);

            $this->db->where('cat_unid', $cat_unid);
            if($this->db->update('tbl_category',['nav_id'=>$nav_id]) == true)
            {
                $error = ['class'=>'success','text'=> 'Attach Navigation successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/attach_menu');
            } else {
                redirect('Dashboard/attachi_menu');
            }      
        

    }
}
