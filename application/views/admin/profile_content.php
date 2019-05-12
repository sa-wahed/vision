
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
				
				
        <div class="box span6">
                <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Update Password</h2>
                        <div class="box-icon">
                                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                </div>
                <div class="box-content">
                  <?php echo form_open('Dashboard/change_pass', ['class' => 'form-horizontal']); ?>
                        <div class="control-group">
                            <label class="control-label">Current Password</label>
                            <div class="controls">
                                <input name="current_pass" type="password" class="span10"   >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">New Password</label>
                            <div class="controls">
                                <input name="new_pass" type="password" class="span10"   >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Confirm Password</label>
                            <div class="controls">
                                <input name="confirm_pass" type="password" class="span10"   >
                            </div>
                        </div>
                    
                        <div class="form-actions">
                            <button type="submit"  class="btn btn-primary">Change</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    <?php echo form_close(); ?>    
                </div>
        </div><!--/span-->
        
        <div class="box span6">
                <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Update Profile</h2>
                        <div class="box-icon">
                                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                </div>
                <div class="box-content">
                  <?php echo form_open('Dashboard/change_profile', ['class' => 'form-horizontal']); ?>
                        <div class="control-group">
                            <label class="control-label">Profile Name</label>
                            <div class="controls">
                                <input name="admin_name" type="text" class="span10" value="<?php echo $admin_info[0]['admin_name'];?>"  >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Email Address</label>
                            <div class="controls">
                                <input name="admin_email" type="email" class="span10" value="<?php echo $admin_info[0]['admin_email'];?>"  >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Facebook ID</label>
                            <div class="controls">
                                <input name="admin_fb" type="text" class="span10" value="<?php echo $admin_info[0]['admin_fb'];?>"  >
                            </div>
                        </div>
                        

                        <div class="form-actions">
                            <button type="submit"  class="btn btn-primary">Change</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    <?php echo form_close(); ?>        
                            
                </div>
        </div><!--/span-->

    </div><!--/row-->
    
    <div class="row-fluid sortable">
        
        <div class="box span6 offset3">
                <div class="box-header">
                        <h2><i class="halflings-icon align-justify"></i><span class="break"></span>Update Photo</h2>
                        <div class="box-icon">
                                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                        </div>
                </div>
                <div class="box-content">
                  <?php echo form_open_multipart('Dashboard/change_profile_photo', ['class' => 'form-horizontal']); ?>
                        
                       
                        <div class="control-group">
                            <label class="control-label" >profile Photo</label>
                            <div class="controls">
                                <input name="admin_image" type="file"  />
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit"  class="btn btn-primary">Change</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    <?php echo form_close(); ?>        
                            
                </div>
        </div><!--/span-->

    </div><!--/row-->
    
</div>
<!--/.fluid-container-->
          
<!-- end: Content --> 
<?php $this->load->view('admin/includes/footer'); ?>