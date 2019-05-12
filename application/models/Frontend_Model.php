<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Model extends CI_Model{

    function home_page(){
        $this->load->model('Category_post_Model');
        
        $data['main_post'] = $this->main_post();
        $data['top_post'] = $this->top_post();
        $data['bottom_post'] = $this->bottom_post();       
        $data['category_post'] = $this->Category_post_Model->category_post();
        return $data;
    }
    
    function main_post(){
        $query = $this->db
                       ->where('post_decoration','1' )
                       ->select(['post_title','post_unid','post_description','post_image','post_view'])
                       ->limit(1, 0)
                       ->order_by("post_id", "desc")
                       ->get('tbl_post');

       $data = $query->result_array();
       return $data;
    }
    
    function top_post(){
        $query = $this->db
                       ->where('post_decoration','2' )
                       ->select(['post_title','post_unid','post_description','post_image'])
                       ->limit(10, 0)
                       ->order_by("post_id", "desc")
                       ->get('tbl_post');

       $data = $query->result_array();
       return $data;
    }
    function bottom_post(){
        $query = $this->db
                       ->where('post_decoration','3' )
                       ->select(['post_title','post_unid','post_image'])
                       ->limit(12, 0)
                       ->order_by("post_id", "desc")
                       ->get('tbl_post');

       $data = $query->result_array();
       return $data;
    }
/*--------------------------------------------------------------------------------------*/    
    
    function post_detail($unid = false){
        
       if($unid == FALSE) redirect (base_url());
        $unid = $this->security->xss_clean($unid);
        
        $query = $this->db
                    ->where('post_unid', $unid )
                    ->select(['post_title','post_date','post_description','cat_id','post_image','post_view','post_unid','post_seo'])
                    ->get('tbl_post');
        $detail_post = $query->result_array();
        
        if($detail_post ==false)redirect (base_url());
        /*-----------------------------------------*/
        $cat_id = $detail_post[0]['cat_id'] ;
        $post_view = $detail_post[0]['post_view'] ;
        $post_view = 1 + (integer)$post_view; 
        
        $this->db->where('post_unid', $unid);
        $this->db->update('tbl_post',['post_view'=>$post_view]);
        /*---------------related-post----------------------*/
        $query = $this->db
                    ->where('cat_id', $cat_id )
                    ->select(['post_title','post_image','post_unid'])
                    ->limit(8, 0)
                    ->order_by("post_view", "desc")
                    ->get('tbl_post');
        $category_post=$query->result_array();
        
        $data['post_detile'] = $detail_post;
        $data['category_post'] = $category_post;
        return $data;
    }
    
/*---------------------------------------------------------------------------------------*/    
    public function category_post()
    {
        
        if($this->session->userdata('cat_id') == FALSE)redirect (base_url());
        //----------------------------------------------------- 
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/news/category';
            $config['total_rows'] = $this->count_my_post();
            $config['per_page'] = 12;
            
    
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
                            ->where('cat_id', $this->session->userdata('cat_id') )
                            ->select(['post_title','post_image','post_date','post_description','post_unid'])
                            ->limit($limit, $start)
                            ->order_by("post_id", "desc")
                            ->get('tbl_post');

            $data = $query->result_array();
            return $data;
    }
    public function count_my_post(){
        
        $query = $this->db
                        ->where('cat_id', $this->session->userdata('cat_id'))
                        ->get('tbl_post');
        $data = $query->num_rows();

        return $data;
        
    }
    
    
    
    
    
    
    
    
    
    
}

