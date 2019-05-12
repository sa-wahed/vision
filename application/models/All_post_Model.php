<?php defined('BASEPATH') OR exit('No direct script access allowed');

class All_post_Model extends CI_Model{
    //put your code here
    
     public function view_post(){
        
        $this->load->library('pagination');

            $config['base_url'] = base_url().'/Dashboard/all_post';
            $config['total_rows'] =  $this->db->count_all('tbl_post');
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
        $data['post_info'] = $this->get_search_result( $config['per_page'], $this->uri->segment(3) );
        $data['cat_info'] = $this->all_category();
        $data['tag_info'] = $this->all_tag();
        return $data;
    }


    public function get_search_result($limit, $start, $search = null){
            //echo $limit.' '.$start." ".$search;
            $query = $this->db
                            ->like('post_title', $search)
                            ->limit($limit, $start)
                            ->order_by("post_id", "desc")
                            ->get('tbl_post');

            $data = $query->result_array();
            return $data;
        }
        
   
    
    public function post_delete($id){
       
        if($id )
        {
            $id = (string)$id;
            $query = $this->db
                            ->select('post_image')
                            ->where('post_unid',$id)
                            ->get('tbl_post');
            $data = $query->result_array();
            $img_path = base_url('./images/').$data[0]['post_image'];
            
            
            $this->db->where('post_unid', $id);
            if($this->db->delete('tbl_post') == true)
            {
                if(file_exists($img_path))
                {
                    unlink($img_path);                        
                }
                
                $error = ['class'=>'success','text'=> 'Post Deleted successfully'];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/all_post');
            } else {
                redirect('Dashboard/all_post');
            }      
        }else{
            redirect('Dashboard/all_post');
        }
    }
    public function edit_post_info($id){
       
        if($id )
        {
            $id = (string)$id;
            $this->session->set_userdata('edit_id',$id);
            $query  =  $this->db
                            ->where('post_unid', $id)
                            ->get('tbl_post');
            $data = $query->result_array();
            
            if($data == true)
            {
                $data['edit_info'] = $data;
                
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
            } else {
                redirect('Dashboard/all_post');
            }      
        }else{
            redirect('Dashboard/all_post');
        }
    }
    
    public function update_post(){
        
        if($this->session->userdata('edit_id'))
        {
            $title          = (string)$this->input->post('post_title');
            $description    = (string)$this->input->post('post_description');
            $category       = (string)$this->input->post('post_category');
            $tag            = $this->input->post('post_tags'); 
            $seo            = $this->input->post('post_seo'); 

            $tags           = (string)implode(', ',$tag);

            $data = [
                            'post_title' => $title,
                            'post_description' => $description,
                            'cat_id' => $category,
                            'tag_id' => $tags,
                            'post_seo' => $seo,

                    ];
            
            $data = $this->security->xss_clean($data); 
            
            $this->db->where('post_unid', $this->session->userdata('edit_id'));
            if($this->db->update('tbl_post', $data) == true )
            {
                $error = ['class'=>'success','text'=> 'Post Update successfully'];
                $this->session->set_flashdata('sms_flash', $error); 

                $this->session->unset_userdata('edit_id');
                redirect('Dashboard/all_post');
            } else {
                $error = ['class'=>'danger','text'=> 'Information Error'];
                $this->session->set_flashdata('sms_flash', $error); 

                $this->session->unset_userdata('post_image');
                $this->session->unset_userdata('edit_id');
                redirect('Dashboard/all_post');
            }
        } else {
            redirect('Dashboard/all_post');
        }             
    }
    
    public function update_image(){
        
        $config['upload_path'] = './images';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] =  'update_' . substr(md5(rand()), 0, 7);
        $config['overwrite'] = false;
        $config['max_size'] = '1120';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('post_image'))
        {
            $error = ['class'=>'warning','text'=> $this->upload->display_errors()];
            $this->session->set_flashdata('sms_flash', $error);

            $data = $this->edit_post_info($this->session->userdata('edit_id'));
            $this->load->view('admin/post_edit_content',$data);
        } else {

            $img_path = './images/'.$this->session->userdata('post_image');
            if(file_exists($img_path))
            {
                unlink($img_path);                        
            }
            $up_img = $config['file_name'].$this->upload->data()['file_ext'];
            $this->db->where('post_unid', $this->session->userdata('edit_id'));
            $this->db->update('tbl_post',['post_image'=> $up_img] );


            $error = ['class'=>'success','text'=> 'update success'];
            $this->session->set_flashdata('sms_flash', $error); 

            $this->session->unset_userdata('post_image');
            $this->session->unset_userdata('edit_id');
            redirect('Dashboard/post_view');
        }
    }
    
    public function post_search(){
        
        $this->load->library('pagination');
        // get search string
             $search = ($this->input->post("post_title"))? (string)$this->input->post("post_title") : "NIL";
         $search = ($this->uri->segment(3)) ? (string)$this->uri->segment(3) : $search;
        
        // pagination settings
        $config = array();
        $config['base_url']     = site_url("Dashboard/all_post_search/$search");
        $config['total_rows']   = $this->num_rows_search($search);
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
        $data['post_info'] = $this->get_search_result($config['per_page'], $data['page'], $search);
        $data['cat_info'] = $this->all_category();
        $data['tag_info'] = $this->all_tag();
        return $data;
    }
    
    public function num_rows_search($data){
        $query = $this->db
                        ->where('admin_id', $this->session->userdata('user_id'))
                        ->like('post_title',$data)
                        ->get('tbl_post');
        $data = $query->num_rows();
        return $data;
    }
    
    public function all_category(){
        
        $query = $this->db->get('tbl_category');
        $result = $query->result_array();
        return $result;
    }
    
    public function all_tag(){
        
        $query = $this->db->get('tbl_tag');
        $result = $query->result_array();
        return $result;
    }
}
