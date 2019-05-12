
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-tag"></i>
            <a href="index.html">Navitation</a> 
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
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon tag"></i><span class="break"></span>Add Navigation</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <fieldset>

                    <?php echo form_open('Dashboard/navigation', ['class' => 'form-horizontal']); ?>
                        <br/>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Navigation Name</label>
                            <div class="controls">
                                <input name="nav_name" type="text" class="span8 typeahead"   >
                            </div>
                        </div>
                        <br/>
                        <div class="form-actions">
                            <button type="submit"  class="btn btn-primary">Save Navigation</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    <?php echo form_close(); ?>

                </fieldset>
            </div>
        </div><!--/span-->
    </div><!--/row--> 

    <div class="row-fluid ">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon tags"></i><span class="break"></span>Navigation List</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>

            <div style=" z-index: 50; margin-top: -1px;padding: 10px; background: #fff !important;">
               <div class="row-fluid">
                    <div class="span1">
                        <label><a href="<?php echo base_url('Dashboard/navigation'); ?>" ><button class="btn btn-warning" title="Refresh Tags" onclick="refresh();"><i class="halflings-icon white refresh"></i></button> </a>
                        </label>
                    </div>
                    
                </div>
                <table class="table table-striped table-bordered" id="text_table">
                    <thead>
                        <tr>
                            <th width="5%">SL</th>
                            <th width="70%"><p align="center">Navigation Name</p></th>
                            <th width="25%">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>

                        <?php
                      
                        if($nav_info)
                        {                                                             
                            $sl = $page;
                            foreach ($nav_info as $value)
                            {
                        ?>   
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td class="center"><p align="center"><?php echo $value['nav_name']; ?></p></td>
                                <td>
                                    <a class="btn btn-danger" href="<?php echo base_url('Dashboard/navigation_modify/delete/'). $value['nav_unid'];?>" onclick="return confirm('Are u Sure?');"><i class="halflings-icon white trash"></i></a>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $value['nav_unid']?>"><i class="halflings-icon white edit"></i></a>
                                  					
                                </td>
                            </tr>
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="myModal-<?php echo $value['nav_unid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title" id="myModalLabel" style="color:purple">Edit Navigation</h4>
                                                                                </div>
                                                                                    <?php echo form_open('Dashboard/navigation_modify/');?>
                                                                                    <div class="modal-body">
                                                                                        <div class="span8 offset2">
                                                                                            <label class="control-label" style="color:brown"> Navigation name : </label>
                                                                                            <input name="nav_name" type="text" value="<?php echo $value['nav_name'];?>" class="span12"  >
                                                                                            <input type="hidden" name="nav_unid" value="<?php echo $value['nav_unid'];?>" />
                                                                                        </div>
                                                                                    </div><br />
                                                                                    <div class="modal-footer">
                                                                                        <button type="close" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary" >Save changes</button>
                                                                                    </div>
                                                                                   <?php echo form_close(); ?>
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