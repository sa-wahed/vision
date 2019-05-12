
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px; background-image: url('<?php echo base_url('_resources/admin/img/White-Background.jpg')?>');">


    <ul class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-list"></i>
            <a href="index.html">Category</a> 
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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Category</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <fieldset>

                    <?php echo form_open('Dashboard/category', ['class' => 'form-horizontal']); ?>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Category Name</label>
                            <div class="controls">
                                <input name="cat_name" type="text" class="span8 typeahead"   >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Status</label>
                            <div class="controls">
                                <select name="cat_status" id="selectError3">
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit"  class="btn btn-primary">Save category</button>
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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Category List</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>

            <div style=" z-index: 50; margin-top: -1px;padding: 10px; background: #fff !important;">
               <div class="row-fluid">
                    <div class="span1">
                        <label><a href="<?php echo base_url('Dashboard/category'); ?>" ><button class="btn btn-warning" title="Refresh Category" onclick="refresh();"><i class="halflings-icon white refresh"></i></button> </a>
                        </label>
                    </div>
                    <div class="span6 pull-right">
                       <label>
                          <?php echo form_open('Dashboard/category_search');?> 
                           <input type="search" name="cat_name" placeholder="search category">
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
                            <th width="50%"><p align="center">Category Name</p></th>
                            <th width="15%">Status</th>
                            <th width="30%" style="text-align:center">Actions</th>
                        </tr>
                    </thead>   
                    <tbody>

                        <?php
                        
                        if($cat_info)
                        {                           
                            $sl = $page;
                            foreach ($cat_info as $value)
                            {
                        ?>   
                            <tr>
                                <td><?php echo ++$sl; ?></td>
                                <td class="center"><p align="center"><?php echo $value['cat_name']; ?></p></td>
                                <td class="center"><?php
                                    if ($value['cat_status'] == 1) {
                                        ?><span class="label label-success"><?php echo 'Published'; ?></span><?php
                                    } else {
                                        ?><span class="label label-important"><?php echo 'UnPublished'; ?></span><?php
                                    }
                                    ?>
                                </td>
                               
                                <td style="text-align:center;">
                                    <?php if ($value['cat_status'] == 1) { ?>
                                    <a class="btn btn-info" href="<?php  echo base_url('Dashboard/category_modify/unpublish/'). $value['cat_unid'] . '/' . $page;?>" title="Unpublish"><i class="halflings-icon white thumbs-up"></i></a>
                                    <?php } else { ?>
                                        <a class="btn btn-warning" href="<?php  echo base_url('Dashboard/category_modify/publish/'). $value['cat_unid'] . '/' . $page;?>" title="Publish"><i class="halflings-icon white thumbs-down"></i></a>
                                    <?php } ?>
                                        
                                    <?php if ($value['cat_post'] == 1) { ?>
                                        <a class="btn"style="background: purple;" href="<?php  echo base_url('Dashboard/category_modify/undo_post/'). $value['cat_unid'] . '/' . $page;?>" title="Undo post category"><i class=" white icon-list-alt"></i></a>
                                    <?php } else { ?>
                                         <a class="btn " href="<?php  echo base_url('Dashboard/category_modify/do_post/'). $value['cat_unid'] . '/' . $page;?>" title="Add to post category"><i class=" white icon-list-alt"></i></a>
                                   <?php } ?>
                                    <a class="btn btn-danger" href="<?php echo base_url('Dashboard/category_modify/delete/'). $value['cat_unid'] . '/' . $page;?>"  onclick="return confirm('Are u Sure?');"><i class="halflings-icon white trash"></i></a>
                                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $value['cat_unid']?>"><i class="halflings-icon white edit"></i></a>
                                  					
                                </td>
                            </tr>
                                                                        <!-- Modal -->
                                                                        <div class="modal fade" id="myModal-<?php echo $value['cat_unid'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                    <h4 class="modal-title" id="myModalLabel" style="color:purple">Edit Category</h4>
                                                                                </div>
                                                                                    <?php echo form_open('Dashboard/category_modify/');?>
                                                                                    <div class="modal-body">
                                                                                        <div class="span8 offset2">
                                                                                            <label class="control-label" style="color:brown"> Category name : </label>
                                                                                            <input name="cat_name" type="text" value="<?php echo $value['cat_name'];?>" class="span12"  >
                                                                                            <input type="hidden" name="cat_unid" value="<?php echo $value['cat_unid'];?>" />
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