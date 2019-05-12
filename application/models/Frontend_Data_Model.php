<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Data_Model extends CI_Model{
   
    
    function view_data(){
       
        $data['nav'] = $this->navigation();
        $data['single_nav'] = $this->single_nav();
        $data['cat'] = $this->category();
        
        $data['focus_post'] = $this->focus_post();
        $data['latest_post'] = $this->latest_post();
        $data['most_view'] = $this->most_view();
        
        return $data;
    }
    function navigation(){
        
            $query = $this->db
                            ->select(['nav_id','nav_name'])
                            ->order_by("nav_id", "desc")
                            ->get('tbl_navigation');

            $data = $query->result_array();
            return $data;
    }
    
    function category(){
            $query = $this->db
                            ->select(['cat_name','nav_id','cat_unid','cat_id'])
                            ->where('cat_status', '1')
                            ->order_by("cat_id", "asc")
                            ->get('tbl_category');
            $data = $query->result_array();
            return $data;
    }
    function single_nav(){
            $query = $this->db
                            ->select(['cat_name','cat_id'])
                            ->where('cat_status', '1')
                            ->where('nav_id', 'nav')
                            ->order_by("cat_id", "asc")
                            ->get('tbl_category');
            $data = $query->result_array();
            return $data;
    }

/*------------------------------------------------------------------------------*/
    function focus_post(){
        $query = $this->db
                       ->where('post_decoration','4' )
                       ->select(['post_title','post_unid','post_image'])
                       ->limit(7, 0)
                       ->order_by("post_id", "desc")
                       ->get('tbl_post');

       $data = $query->result_array();
       return $data;
    }
    
    function latest_post(){
        $query = $this->db
                       ->select(['post_title','post_unid','post_image'])
                       ->limit(7, 0)
                       ->order_by("post_id", "desc")
                       ->get('tbl_post');

       $data = $query->result_array();
       return $data;
    }
    
    function most_view(){
        $query = $this->db
                       ->select(['post_title','post_unid','post_image'])
                       ->limit(7, 0)
                       ->order_by("post_view", "desc")
                       ->get('tbl_post');

       $data = $query->result_array();
       return $data;
    }
    
    
}
