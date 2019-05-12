
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a>Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-list-alt"></i>
            <a>Post Edit</a> 
        </li>

    </ul>
    <?php if ($this->session->flashdata('sms_flash')) {  $message = $this->session->flashdata('sms_flash');?>
        <div class="alert alert-<?php echo $message['class'];?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div style="text-align:center;"><?php echo $message['text'];?></div>
        </div>
    <?php } ?>
    <?php if($edit_info == false)       redirect('Dashboard'); ?>
    <?php if($tag_info == false)        redirect('Dashboard'); ?>
    <?php if($cat_info == false)        redirect('Dashboard'); ?>
    
   <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="icon-list-alt"></i><span class="break"></span>Update Post</h2>
                <div class="box-icon">
                   <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
           
            <?php   foreach ($edit_info as $value){?>
            <div class="box-content">
                    <fieldset>
                    <?php echo form_open('Dashboard/all_post_edit',['class'=>'form-horizontal']);?>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Post Title</label>
                            <div class="controls">
                                <?php echo form_input(['name'=>'post_title','class'=>'span7','value'=>$value['post_title'],'required'=>'true']);?>
                            </div>
                            
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2" required >Post Description </label>
                            <div class="controls">
                                <textarea name="post_description"class="cleditor" id="textarea2" rows="3"><?php echo $value['post_description'];?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError">Post Category</label>
                            <div class="controls">
                                <select name="post_category" id="selectError2" data-rel="chosen" >
                                     <option value=""> --- Select a Category --- </option>
                                <?php 
                                if($cat_info)
                                    {
                                        foreach ($cat_info as $cat)
                                        {   
                                            if($value['cat_id'] == $cat['cat_id']){
                                                
                                                ?><option value="<?php echo $cat['cat_id']; ?>" selected ><?php echo $cat['cat_name'];?></option><?php
                                            }else{
                                                ?><option value="<?php echo $cat['cat_id']; ?>" ><?php echo $cat['cat_name'];?></option><?php 
                                            }
                                        } 
                                
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <?php //echo '<pre>'; print_r($tag_info);?>
                        <div class="control-group">
                            <label class="control-label" for="selectError1">Add Tag </label>
                            <div class="controls">
                                <select name="post_tags[]" id="selectError1"  multiple data-rel="chosen" >
                                <?php 
                                    if($tag_info)
                                    {
                                        foreach ($tag_info as $all_tag)
                                        {   
                                            $post_tag = explode(',', $value['tag_id']);
                                            $match = 0;
                                            
                                            foreach ($post_tag as $tag_id)
                                            {
                                                if($all_tag['tag_id'] == $tag_id)
                                                {
                                                    $match = 1;
                                                    break;
                                                } 
                                            }
                                            
                                            if($match == 1)
                                            {
                                                ?><option value="<?php echo $all_tag['tag_id'];?>" selected><?php echo $all_tag['tag_name'];?></option><?php
                                            } else {
                                                ?><option value="<?php echo $all_tag['tag_id'];?>" ><?php echo $all_tag['tag_name'];?></option><?php
                                            }
                                        } 
                                    
                                    } ?>
                              </select>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">More Tag for SEO </label>
                            <div class="controls">
                                <textarea name="post_seo"  style="width:500px;" required><?php echo $value['post_seo'];?></textarea>
                            </div>
                        </div>
                       
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Post Update</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                        <?php echo form_close();?>
                        
                    </fieldset>
            </div>
            <?php } ?>
        </div><!--/span-->

    </div><!--/row--> 
    <div class="row-fluid sortable">
        <div class="box span6">
            <div class="box-header">
                    <h2><i class="halflings-icon picture"></i><span class="break"></span>Current Image</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
            </div>
            <div class="box-content">
                <div id="image-1" class="masonry-thumb">
                    <img class="grayscale" src="<?php echo base_url('images/').$edit_info[0]['post_image'];?>" width="100%">
                </div>
            </div>
        </div><!--/span-->
				
        <div class="box span6">
            <div class="box-header">
                    <h2><i class="halflings-icon picture"></i><span class="break"></span>Update Image</h2>
                    <div class="box-icon">
                            <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                            <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
            </div>
            <div class="box-content">
                <?php echo form_open_multipart('Dashboard/post_imge_update',['class'=>'form-horizontal']);
                    $this->session->set_userdata('post_image',$edit_info[0]['post_image']);?>
                    
                    <fieldset> 
                        <div class="control-group"style="padding: 50px 0;">
                            <label class="control-label" for="fileInput">New input</label>
                            <div class="controls" >
                                <input class="input-file uniform_on" name="post_image" id="fileInput" type="file">
                            </div>
                        </div> 
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Image</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                    
                <?php echo form_close();?>
            </div>
        </div><!--/span-->
    </div><!--/row-->

</div>
<!--/.fluid-container-->
<!-- end: Content -->

<?php $this->load->view('admin/includes/footer'); ?>