<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category_post_Model extends CI_Model{
    
    function do_post($id)
    {
       if($id )
        {
            $id = (string)$id;
            $this->db->where('cat_unid', $id);
            if($this->db->update('tbl_category', ['cat_post' => '1']) == true)
            {
                $error = ['class'=>'success','text'=> 'Category post add successfully'];
                $this->session->set_flashdata('sms_flash', $error);
            }     
        }
    }
    function undo_post($id)
    {
         if($id )
        {
            $id = (string)$id;
            $this->db->where('cat_unid', $id);
            if($this->db->update('tbl_category', ['cat_post' => '0']) == true)
            {
                $error = ['class'=>'success','text'=> 'Category post undo successfully'];
                $this->session->set_flashdata('sms_flash', $error);
            }     
        }
    }
    function category_post()
    { 
        $cat = $this->db->where('cat_post',1)
                        ->where('cat_status',1)
                        ->select('cat_id')
                        ->get('tbl_category')
                        ->result();    
        
        foreach ($cat as $value)
        {
            $id[]= $value->cat_id;
        }
        
        foreach ($id as $value)
        {  
            $query =   $this->db->where('cat_id',$value )
                                ->select(['post_title','post_unid','post_image','cat_id'])
                                ->limit(6, 0)
                                ->order_by("post_id", "desc")
                                ->get('tbl_post');
            $data[] = $query->result_array();
        }
//        echo '<pre>';
//        print_r($data);
        return $data;
    }
    
}
