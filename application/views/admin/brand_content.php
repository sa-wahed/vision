
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-fire"></i>
            <a href="index.html">Brand</a> 
        </li>

    </ul>

    <div class="row-fluid sortable">
        <div class="box span8 offset2">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Footer</h2>
                <div class="box-icon">
                   <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
           
            
            <div class="box-content">
                
                 
                
                
                    <fieldset>
                        
                        <?php
                        if($this->session->flashdata('sms_flash') ){
                            $data = $this->session->flashdata('sms_flash');
                            echo $data['text'];
                        }
                        ?>
                        
                        
                        <?php echo form_open('Dashboard/brand',['class'=>'form-horizontal']);?>
                        <div class="control-group hidden-phone">
                            
                            <label class="control-label" for="textarea2">You can update Footer </label>
                            <div class="controls">
                                <textarea name="footer_text"class="cleditor" id="textarea2" rows="3"><?php
                                  if(isset($footer_text)){
                                      echo $footer_text;
                                  }  
                                ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                        <?php echo form_close();?>
                        
                    </fieldset>
                  

            </div>
        </div><!--/span-->

    </div><!--/row--> 
    <div class="row-fluid sortable">
				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Logo</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
                                    <div class="box-content">
                                        logho text or image
                                    </div>
				</div><!--/span-->
			</div><!--/row-->
</div>
<!--/.fluid-container-->
<!-- end: Content --> 
<?php
$this->load->view('admin/includes/footer');
?>