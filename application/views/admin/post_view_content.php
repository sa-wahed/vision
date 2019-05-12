
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-list"></i>
            <a href="index.html">View Post</a> 
        </li>
    </ul>
    
    <?php if ($this->session->flashdata('sms_flash')) {  $message = $this->session->flashdata('sms_flash');?>
        <div class="alert alert-<?php echo $message['class'];?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div style="text-align:center;"><?php echo $message['text'];?></div>
        </div>
    <?php } ?>
    
    
    
    <div class="row-fluid ">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>My post</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>

            <div style=" z-index: 50; margin-top: -1px;padding: 10px; background: #fff !important;">
               <div class="row-fluid">
                    <div class="span1">
                        <label><a href="<?php echo base_url('Dashboard/post_view'); ?>" ><button class="btn btn-warning" title="Refresh Category" onclick="refresh();"><i class="halflings-icon white refresh"></i></button> </a>
                        </label>
                    </div>
                    <div class="span6 pull-right">
                       <label>
                        <?php echo form_open('Dashboard/post_search');?> 
                           <input type="search" name="post_title" placeholder="search post">
                           &nbsp;&nbsp;&nbsp;&nbsp;
                           <button  type="submit" class="btn btn-info" style="margin-top: -10px"><i class="halflings-icon white search"></i></button>
                        <?php echo form_close();?>
                       </label>
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="text_table">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="75%"><p align="center">Post Title</p></th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>

                        <?php
                        
                        if($post_info)
                        {                           
                            $sl = $page;
                            foreach ($post_info as $value)
                            {
                        ?>   
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td><?php   $pieces = explode(' ',$value['post_title']);
                                            $count = array_splice($pieces,0,10);
                                            echo $title =  implode(' ',$count);
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" data-toggle="modal" data-target="#myModal-<?php echo $value['post_unid']?>" ><i class="halflings-icon white eye-open"></i></a>
                                    <a class="btn btn-danger" href="<?php echo base_url('Dashboard/post_modify/delete/'). $value['post_unid'];?>"  onclick="return confirm('Are u Sure?');"><i class="halflings-icon white trash"></i></a>
                                    <a class="btn btn-success" href="<?php echo base_url('Dashboard/post_edit/'). $value['post_unid'];?>"  ><i class="halflings-icon white edit"></i></a>
                                  					
                                </td>
                            </tr>
                                                                <!-- Modal -->
                                                                        <div class="modal fade" id="myModal-<?php echo $value['post_unid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title" id="myModalLabel" style="color:purple">Post No: <?php echo $sl;?></h4>
                                                                                </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="span12">
                                                                                            <label style="color:red;">Title: </label>
                                                                                                <div class="span12"><?php echo $value['post_title'];?></div>
                                                                                            <label style="color:red;">Tags: </label>
                                                                                                <div class="span12"><?php  echo $value['post_seo']?>  </div>
                                                                                            <label style="color:red;">Category: </label>
                                                                                                <div class="span12"><?php 
                                                                                                    foreach ($cat_info as $cat_value)
                                                                                                    {
                                                                                                        if($value['cat_id']==$cat_value['cat_id'])
                                                                                                        {
                                                                                                            echo $cat_value['cat_name'];
                                                                                                        }
                                                                                                    } ?>
                                                                                                </div>
                                                                                            <label style="color:red;">Description: </label>
                                                                                                <div class="span12"><?php echo $value['post_description'];?></div>
                                                                                            <label style="color:red;">Image: </label>
                                                                                            <div class="span8 offset2">
                                                                                                <div id="image-1" class="masonry-thumb">
                                                                                                    <img class="grayscale" src="<?php echo base_url('images/').$value['post_image'];?>" width="100%">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                            
                                                                                    </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="close" class="btn btn-info" data-dismiss="modal">Close</button>
                                                                                    </div>
                                                                            </div>
                                                                          </div>
                                                                        </div> 
                                                                        <!-- End Modal --->
                        <?php } 
                        }else{ ?>
                            <tr>
                                <td colspan="4"> <p align="center">NO Data Exist !</p> </td>
                            </tr>
                    <?php } ?>
                    </tbody>
                </table>  
                <div class="row-fluid">
                     <div class="span12 center">
                        <div class="pagination">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
              
            </div>
        </div><!--/span-->
    </div><!--/row-->
</div>
<!--/.fluid-container-->
            
		
           
<!-- end: Content --> 
<?php
$this->load->view('admin/includes/footer');
?>