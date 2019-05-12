<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Decoration_Model extends CI_Model{
    //put your code here
    public function view_post(){
        
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/Dashboard/decoration';
            $config['total_rows'] = $this->db->count_all('tbl_post');
            $config['per_page'] = 10;
            
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
        $data['post_info'] = $this->get_search_result( $config['per_page'], $this->uri->segment(3) );
     
        return $data;
    }
    
    public function get_search_result($limit, $start){
        //echo $limit.' '.$start." ".$search;
        $query = $this->db
                        ->select('post_unid, post_title, post_decoration')
                        ->limit($limit, $start)
                        ->order_by("post_id", "desc")
                        ->get('tbl_post');

        $data = $query->result_array();
        return $data;
    }
    
    public function add_decoration(){
           $decoration = (string)$this->input->post('post_decoration');
           $unid = (string)$this->input->post('post_unid');
        
            $this->db->where('post_unid', $unid);
            if($this->db->update('tbl_post',['post_decoration'=>$decoration]) == true)
            {               
                
            } else {
                redirect('Dashboard/decoration');
            }         
    }
}
