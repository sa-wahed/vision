<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Post_Model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
    }
    
    public function add_post(){
        
        $title          = (string)$this->input->post('post_title');
        $description    = (string)$this->input->post('post_description');
        $category       = (string)$this->input->post('post_category');
        $tag            = $this->input->post('post_tags'); 
        
        foreach ($this->all_tags() as $all_tag )
        {
            foreach($tag as $tag_val)
            {
               if( $tag_val == $all_tag['tag_id'])
               {
                  $tag_seo[] = $all_tag['tag_name'];
                  break;
               }
            }
        }
        $tag_seo = implode(', ', $tag_seo);
       
        $seo = $tag_seo.', '.$this->input->post('post_seo');
        
        $tags          = (string)implode(', ',$tag);
        $admin_id       = $this->session->userdata('user_id');
        $author_name    = $this->session->userdata('username');
        
            $config['upload_path'] = './images';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = 'image_' . uniqid();
            $config['overwrite'] = false;
            $config['max_size'] = '1120';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('post_image'))
        {
            $error = ['class'=>'warning','text'=> $this->upload->display_errors()];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/post');
        } else {
            $image_name =  $config['file_name'].$this->upload->data()['file_ext'];
            $data = [
                        'post_title' => $title,
                        'post_unid' => uniqid(),
                        'post_description' => $description,
                        'cat_id' => $category,
                        'tag_id' => $tags,
                        'post_author' => ' ',
                        'admin_id' => $admin_id,
                        'post_image' => $image_name,
                        'post_date' => date('Y-m-d h:i:sa'),
                        'post_seo' => $seo,

                    ];
					
            $data = $this->security->xss_clean($data);
            
            if($this->db->insert('tbl_post', $data))
            {
                $error = ['class'=>'success','text'=> 'Post Upload Successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/post');
            }

        }
    }
    
    public function post_info(){
        $query = $this->db
                        ->where('cat_status', '1')
                        ->order_by('cat_name','asc')
                        ->get('tbl_category');

        $data['cat_info'] = $query->result_array();
         
         $query2 = $this->db
                        ->where('tag_status', '1')
                        ->order_by('tag_name','asc')
                        ->get('tbl_tag');

        $data['tag_info'] = $query2->result_array();
        return $data;
    }
    
    public function all_tags(){
            $query = $this->db
                            ->where("tag_status", "1")
                            ->get('tbl_tag');
            $data = $query->result_array();
            return $data;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
