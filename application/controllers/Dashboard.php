<?php   defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library('access_role');
        $this->access_role->not_Active();
        
        $this->load->model('Brand_Model');
        $data = $this->Brand_Model->footer_text();
             
        $this->load->view('admin/includes/header',$data);
        $this->load->view('admin/includes/navigation');
          
    }
    
    public function index(){
       
        $this->load->view('admin/home_dashboard');
    }
    
 
//\\ START POST Function //\\    
    
    public function post(){   
        if($this->access_role->is_Active() == false)            show_404();
        
        $this->load->model('Post_Model'); 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST')
            {

                if( $this->form_validation->run('post_validation') )
                {
                    if($_FILES['post_image']['size'] != 0)
                    {                    
                        $this->Post_Model->add_post();
                    } else {
                        $error = ['class'=>'warning','text'=> 'No Image Selected'];
                        $this->session->set_flashdata('sms_flash', $error);                  
                        redirect('Dashboard/post');
                    }

                } else {

                    $error = ['class'=>'warning','text'=> validation_errors()];
                    $this->session->set_flashdata('sms_flash', $error);   
                }        
            }
            $data = $this->Post_Model->post_info();
            $this->load->view('admin/post_content',$data);
        
    }
   
    public function post_view(){
        $this->load->model('Post_view_Model');
        $data = $this->Post_view_Model->view_post();
        $this->load->view('admin/post_view_content',$data);
    }
    
    public function post_modify($type = false, $id = false){
        
        if($this->access_role->is_Active() == false) show_404();
        
        if ($type == 'delete' && $id == true)
        {
            $this->load->model('Post_view_Model');
            $this->Post_view_Model->post_delete($id);
          
        }else{
            redirect('Dashboard/post_view');
        }
    }
    
    public function post_edit($id = false){
        
        if($this->access_role->is_Active() == false) show_404();
        $this->load->model('Post_view_Model');
        
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
           
                if( $this->form_validation->run('post_validation') )
                {
                    $this->Post_view_Model->update_psot();

                } else {

                    $error = ['class'=>'warning','text'=> validation_errors()];
                    $this->session->set_flashdata('sms_flash', $error);                  

                    $data = $this->Post_view_Model->edit_post_info($this->session->userdata('edit_id'));
                    $this->load->view('admin/post_edit_content',$data); 
               }
           
        } else {
            
            $data = $this->Post_view_Model->edit_post_info($id);
            $this->load->view('admin/post_edit_content',$data);  
        }
    }
    
    public function post_imge_update(){
        
            if($this->access_role->is_Active() == false) show_404();  
            if($_FILES['post_image']['size'] != 0)
            {
                $this->load->model('Post_view_Model');
                $this->Post_view_Model->update_image();
            } else {
                $error = ['class'=>'warning','text'=> 'No Image Selected'];
                $this->session->set_flashdata('sms_flash', $error);  

                $this->load->model('Post_view_Model');
                $data = $this->Post_view_Model->edit_post_info($this->session->userdata('edit_id'));
                $this->load->view('admin/post_edit_content',$data);
            }  
    }
    
    public function post_search(){
        if($this->form_validation->run('post_search') )
        {
            $this->load->model('Post_view_Model');
            $data = $this->Post_view_Model->post_search();
            $this->load->view('admin/post_view_content',$data);
       
        } else {

            redirect('Dashboard/post_view');
        }
    }

//\\ END POST Function //\\    
    
    
//\\ START CATEGORY Function  //\\
    
    public function category()
    {        
        if($this->access_role->is_Admin() == false) show_404();
        $this->load->model('Category_Model');
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->form_validation->run('category_insert') ){
                $this->Category_Model->add_category(); 
            } else {
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/category');
            }
        } 
        else{
            $data = $this->Category_Model->view_category();
        }
        
        $this->load->view('admin/category_content',$data);
    }
    public function category_search(){
        
        if($this->form_validation->run('category_search') )
        {
            $this->load->model('Category_Model');
            $data = $this->Category_Model->search_view();
            $this->load->view('admin/category_content',$data);
        } 
        else 
            redirect('Dashboard/category');
    }
    public function category_modify($type = false, $id = false, $pg=null)
    {
        $this->load->model('Category_Model');
        $this->load->model('Category_post_Model');
      
        if($type == 'publish')
            $this->Category_Model->cat_publish($id);
       
        elseif ($type == 'unpublish')
            $this->Category_Model->cat_unpublish($id);
        
        elseif ($type == 'delete')        
            $this->Category_Model->cat_delete($id);
        
        elseif ($type == 'do_post')        
            $this->Category_post_Model->do_post($id);
        
        elseif ($type == 'undo_post')        
            $this->Category_post_Model->undo_post($id);
        
        elseif($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->form_validation->run('category_edit') == true)
                $this->Category_Model->cat_update();
            
            else {
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);
            }
        }
        $pg = (integer)$pg;
        redirect('Dashboard/category/'.$pg);
        
    }
//\\   END CATEGORY Function //\\         
    
    
//\\    START TAG Function  //\\
    public function tag($pg=false)
    {
        if($this->access_role->is_Active() == false) show_404();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if( $this->session->userdata('admin_role') == '0' )
                redirect('Dashboard');
            
            if($this->form_validation->run('tag_insert') )
            {
                $this->load->model('Tag_Model');
                $this->Tag_Model->add_tag(); 
            } 
            else 
            {
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/tag/'.$data['pg']);
            }
        }
        $this->load->model('Tag_Model');
        $data = $this->Tag_Model->view_tag();
        $data['pg']=($pg)?(integer)$pg:null;
        $this->load->view('admin/tag_content',$data);
        
    }
    public function tag_search(){
        
        if($this->form_validation->run('tag_search') ){
            
                $this->load->model('Tag_Model');
                $data = $this->Tag_Model->search_view();
                $this->load->view('admin/tag_content',$data);
            } 
            else 
                redirect('Dashboard/tag');
    }
    
    public function tag_modify($type = false, $id = false,$pg=false)
    {
        $data['pg']=($pg)?(integer)$pg:null;
        
        if( $this->session->userdata('admin_role') == '0' )
            redirect('Dashboard');
      
       if($type == 'publish')
        {
            $this->load->model('Tag_Model');
            $this->Tag_Model->tag_publish($id);
        }
        elseif ($type == 'unpublish')
        {
            $this->load->model('Tag_Model');
            $this->Tag_Model->tag_unpublish($id);
        }
        elseif ($type == 'delete')
        {
            $this->load->model('Tag_Model');
            $this->Tag_Model->tag_delete($id);
        }
        elseif($_SERVER['REQUEST_METHOD'] == 'POST')
        {          
            if($this->form_validation->run('tag_edit') == true)
            {
                $this->load->model('Tag_Model');
                $this->Tag_Model->tag_update();
            } else {
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);
            }
        }
        redirect('Dashboard/tag/'.$data['pg']);
    }
//\\   END TAG Function //\\ 
    
    
//\\    START NAVIGATION Function  //\\
    public function navigation(){
        if($this->access_role->is_Admin() == false) show_404();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->form_validation->run('navigation_insert') ){
                
                $this->load->model('Nav_Model');
                $this->Nav_Model->add_nav(); 
            }
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/navigation');
           
            
            
        } else {
            
            $this->load->model('Nav_Model');
            $data = $this->Nav_Model->view_nav();

            $this->load->view('admin/nav_content',$data);
        }
        
    }

    public function navigation_modify($type = false, $id = false){
      
        if ($type == 'delete')
        {
            $this->load->model('Nav_Model');
            $this->Nav_Model->nav_delete($id);
        }
        elseif($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($this->form_validation->run('navigation_edit') == true)
            {
                $this->load->model('Nav_Model');
                $this->Nav_Model->nav_update();
            } else {
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/navigation');
            }
        }else{
            redirect('Dashboard/navigation');
        }
    }
//\\   END NAVIGATION Function //\\  
    
    
//\\  START ATTACH MANU Function //\\  
     public function attach_menu(){
         
        if($this->access_role->is_Admin() == false) show_404();
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
           if($this->form_validation->run('attach_menu') ){
               
               $this->load->model('AttachMenu_Model');
               $this->AttachMenu_Model->attach_menu();
               
           } else {
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/attach_menu');
            }
            
            
        } else {
            
            $this->load->model('AttachMenu_Model');
            $data = $this->AttachMenu_Model->view_attach();
            $this->load->view('admin/attach_menu_content',$data);
        }
        
    }
    
    public function attach_search(){
        
        if($this->form_validation->run('category_search') ){
            
                $this->load->model('AttachMenu_Model');
                $data = $this->AttachMenu_Model->attach_search_view();
                $this->load->view('admin/attach_menu_content',$data);
            } else {
                               
                redirect('Dashboard/attach_menu');
            }
    }

  
    
//\\  END ATTACH MANU Function //\\  
    
    
//\\ START POST DECORATION Function //\\   
          
    public function decoration($pg = false)
    {
       if($this->access_role->is_Author())
       {
          $this->load->model('Decoration_Model');
        
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $this->Decoration_Model->add_decoration();
            }

            $data = $this->Decoration_Model->view_post();
            $data['pg']=($pg)?(integer)$pg:null;
            $this->load->view('admin/post_deoration_content',$data); 
       }
       else 
       {
           show_404();
       }
         
    }
    
//\\ END POST DECORATION Function //\\ 
    
    
//\\ START PROFILE Functions //\\

    public function profile(){
        
        
        $this->load->model('profile_model');
        $data = $this->profile_model->admin_info();
        $this->load->view('admin/profile_content',$data);
    }
    public function change_pass(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if( $this->form_validation->run('password_validation') )
            {
                $this->load->model('profile_model');
                $this->profile_model->update_pass();
            }else{
                
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);  
                redirect('Dashboard/profile');
            }
        }
    }
    public function change_profile(){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if( $this->form_validation->run('profile_validation') )
            {
                $this->load->model('profile_model');
                $this->profile_model->update_profile();
            }else{
                
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);  
                redirect('Dashboard/profile');
            }
        }
    }
    
    public function change_profile_photo(){          
        
        if($_FILES['admin_image']['size'] != 0)
        {
            $this->load->model('profile_model');
            $this->profile_model->image_update();
        } else {
            $error = ['class'=>'warning','text'=> 'No Photo Selected'];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/profile');
        };
    }

    //\\ END PROFILE Function //\\   
    
    
    
//\\ START BRAND Function //\\    
    public function brand(){
        
        if($this->access_role->is_Admin() == false) show_404();
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
           if ($this->form_validation->run('foote_validition') == true)
            {
                $this->load->model('Brand_Model');
                $this->Brand_Model->update_footer();
            } else {
                
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
                redirect('Dashboard/brand');
            }  
        } else {
            
            $this->load->view('admin/brand_content');
        }
    }
  
//\\ END Brand Function //\\   
    
  

//\\ START USER Function //\\
    
    public function user(){
        if($this->access_role->is_Admin() == false) show_404();
        
        $this->load->model('User_Model');
        $data = $this->User_Model->view_admin();
        $this->load->view('admin/user_content',$data);
    }
    
    public function add_user(){
                
        if ($this->form_validation->run('user_validition') == true)
        {
            $this->load->model('User_Model');
            $this->User_Model->create_user();
        } else {

            $error = ['class'=>'warning','text'=> validation_errors()];
            $this->session->set_flashdata('sms_flash', $error);                  
            redirect('Dashboard/user');
        }  
    }
    
    public function admin_modify($type = false, $id = false){
               
        if($type == FALSE || $id == FALSE) show_404 ();
            
        if($type == 'trash')
         {
             $this->load->model('User_Model');
             $this->User_Model->delete_user($id);

         }else{
             redirect('Dashboard/user');
         }
    }
    
    public function admin_update(){
        
        
        if($this->form_validation->run('user_update'))
        {
            
            $this->load->model('User_Model');
            $this->User_Model->update_user();
            
        }else{
            show_404();
        }
    }

//\\ END USER Function //\\


//\\ START ALL POST Function //\\    

    public function all_post() {
         if($this->access_role->is_Admin() == false) show_404();
             
        $this->load->model('All_post_Model');
        $data = $this->All_post_Model->view_post();
        $this->load->view('admin/all_post_content',$data);
    }
    
    public function all_post_search(){
        if($this->form_validation->run('post_search') )
        {
            $this->load->model('All_post_Model');
            $data = $this->All_post_Model->post_search();
            $this->load->view('admin/all_post_content',$data);
       
        } else {

            redirect('Dashboard/all_post');
        }
    }
    
     public function all_post_modify($type = false, $id = false){
        
      
        if ($type == 'delete' && $id == true)
        {
            $this->load->model('All_post_Model');
            $this->All_post_Model->post_delete($id);
          
        }else{
            redirect('Dashboard/all_post');
        }
    }
    
    public function all_post_edit($id = false){
                
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            if( $this->form_validation->run('post_validation') )
            {
                $this->load->model('All_post_Model');
                $this->All_post_Model->update_post();
               
            } else {
                
                $error = ['class'=>'warning','text'=> validation_errors()];
                $this->session->set_flashdata('sms_flash', $error);                  
               
                $this->load->model('All_post_Model');
                $data = $this->All_post_Model->edit_post_info($this->session->userdata('edit_id'));
                $this->load->view('admin/post_edit_content',$data); 
           } 
           
        } else {
            
            
            $this->load->model('All_post_Model');
            $data = $this->All_post_Model->edit_post_info($id);
            $this->load->view('admin/all_post_edit_content',$data);  
        }
    }
    
    public function all_post_imge_update(){
        
                
        if($_FILES['post_image']['size'] != 0)
        {
            $this->load->model('Post_view_Model');
            $this->Post_view_Model->update_image();
        } else {
            $error = ['class'=>'warning','text'=> 'No Image Selected'];
            $this->session->set_flashdata('sms_flash', $error);  
            
            $this->load->model('Post_view_Model');
            $data = $this->Post_view_Model->edit_post_info($this->session->userdata('edit_id'));
            $this->load->view('admin/post_edit_content',$data);
        } 
                
    }
//\\ END ALL POST Function //\\    
//\\ START LOGOUT Function //\\
    
    public function  logout(){
    
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('admin_name');
        $this->session->unset_userdata('admin_role');
        $this->session->unset_userdata('username');
        redirect('login');
    }
    
    //\\ END LOGOUT Function //\\
   
}
