
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-tag"></i>
            <a href="index.html">Profile</a> 
        </li>
    </ul>
    
    <?php if ($this->session->flashdata('sms_flash')) {  $message = $this->session->flashdata('sms_flash');?>
        <div class="alert alert-<?php echo $message['class'];?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div style="text-align:center;"><?php echo $message['text'];?></div>
        </div>
    <?php } ?>
    
     
    <div class="row-fluid sortable">	
				
				
        <div class="box span8 offset2">
            <div class="box-header">
                    <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Create User</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
            </div>
            <div class="box-content">
                <?php echo form_open('Dashboard/add_user', ['class' => 'form-horizontal']); ?>

                    <div class="control-group">
                        <label class="control-label">Admin Password</label>
                        <div class="controls">
                            <input name="password" type="password" class="span10"   >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">New User Name</label>
                        <div class="controls">
                            <input name="username" type="text" class="span10"   >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">User Password</label>
                        <div class="controls">
                            <input name="user_pass" type="password" class="span10"   >
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Confirm Password</label>
                        <div class="controls">
                            <input name="confirm_pass" type="password" class="span10"   >
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit"  class="btn btn-primary">Create</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                <?php echo form_close(); ?>    
            </div>
        </div><!--/span-->
        
    </div><!--/row-->
    
   <div class="row-fluid ">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>My post</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>

            <div style=" z-index: 50; margin-top: -1px;padding: 10px; background: #fff !important;">
               <div class="row-fluid">
                    <div class="span1">
                        <label><a href="<?php //echo base_url('Dashboard/post_view'); ?>" ><button class="btn btn-warning" title="Refresh Category" onclick="refresh();"><i class="halflings-icon white refresh"></i></button> </a>
                        </label>
                    </div>
                    <div class="span6 pull-right">
                       
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="text_table">
                    <thead>
                        <tr>
                            <th width="5%"><p align="center">SL</p></th>
                            <th width="25%"><p align="center">User Name</p></th>
                            <th width="25%"><p align="center">Profile Name</p></th>
                            <th width="15%"><p align="center">Role</p></th>
                            <th width="15%"><p align="center">Modify</p></th>
                            <th width="15%"><p align="center">Actions</p></th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        
                        if($admin_info)
                        {                           
                            $sl = $page;
                            foreach ($admin_info as $value)
                            {
                        ?> 
                         
                            <tr>
                                <td><p align="center"><?php echo ++$sl; ?></p></td>
                                <td><p align="center"><?php echo $value['username']; ?></p></td>
                                <td><p align="center"><?php echo $value['admin_name']; ?></p></td>
                                <td>
                                    <p align="center"><?php
                                        if($value['admin_role'] == '1')
                                        {
                                            echo '<span class="label label-success">Contributor</span>';
                                        }
                                        elseif ($value['admin_role'] == '0') 
                                        {
                                             echo '<span class="label">In Active</span>';
                                        } 
                                        elseif ($value['admin_role'] == '5') 
                                        {
                                             echo '<span class="label label-info">Author</span>';
                                        }else{
                                            echo '<span class="label label-warning">Administrator</span>';
                                        }
                                    ?></p>
                                </td>
                                 <?php
                                    echo form_open('Dashboard/admin_update');
                                    echo form_hidden(['update'=>$value['admin_id']]);
                                    ?>
                                <td><p align="center">
                                   
                                    <select name="admin_role" style="margin-bottom: -10px;">
                                        <option value="1"> Contributor </option>
                                        <option value="0"> In Active </option>
                                        <option value="5"> Author </option>
                                    </select>
                                    </p>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success"><i class="halflings-icon white pushpin"></i></button>
                                    <a class="btn btn-danger" href="<?php echo base_url('Dashboard/admin_modify/trash/'). $value['admin_id'];?>"  onclick="return confirm('Are u Sure?');"><i class="halflings-icon white trash"></i></a>
                                </td>
                            </tr>
                            <?php
                             echo form_close();
                            } 
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