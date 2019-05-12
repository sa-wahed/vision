<?php


class Test extends CI_Controller
{
	function __construct(){
		parent::__construct();
	}
	
	function index()
	{
		$x = $this->db->select('*')->from('tbl_admin')->where(['username'=>'superadmin','password'=>'1234'])->get()->row();
		if($x) 
			echo 'true';
		else 
			echo 'false';
		
		echo '<pre>';
		var_dump($x);
		echo '</pre>';
	}
	
    /*put your code here
    
    public function file(){
        echo $f_path ='images/image_58d9e9d297760.jpg';
        echo '<br>';
        echo $path = base_url().$f_path;
        
        echo '<br><img src="'.$path.'"/> <br>' ;
        if(file_exists($f_path)){
            echo '<br>paisi';
        } else {
            echo '<br>painai';
        }
    }
	*/
}
