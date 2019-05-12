
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a>Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-list-alt"></i>
            <a>Post</a> 
        </li>

    </ul>
    
    <?php if ($this->session->flashdata('sms_flash')) {  $message = $this->session->flashdata('sms_flash');?>
        <div class="alert alert-<?php echo $message['class'];?>">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <div style="text-align:center;"><?php echo $message['text'];?></div>
        </div>
    <?php } ?>
    
   <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="icon-list-alt"></i><span class="break"></span>Add New Post</h2>
                <div class="box-icon">
                   <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
           
            <div class="box-content">
                    <fieldset>
                    <?php 
                    
                    echo form_open_multipart('Dashboard/post',['class'=>'form-horizontal']);?>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Post Title</label>
                            <div class="controls">
                                <?php echo form_input(['name'=>'post_title','class'=>'span7','value'=>set_value('post_title'),'required'=>'true']);?>
                            </div>
                            
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2" required >Post Description </label>
                            <div class="controls">
                                <textarea name="post_description"class="cleditor" id="textarea2" rows="3"><?php echo set_value('post_description');?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError">Post Category</label>
                            <div class="controls">
                                <select name="post_category" id="selectError2" data-rel="chosen" >
                                     <option value=""> --- Select a Category --- </option>
                                <?php 
                                if($cat_info){
                                    foreach ($cat_info as $value)
                                    {   ?>
                                    <option value="<?php echo $value['cat_id']; ?>"<?php echo set_select('post_category',$value['cat_id']); ?> ><?php echo $value['cat_name'];?></option>
                                <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError1">Add Tag </label>
                            <div class="controls">
                                <select name="post_tags[]" id="selectError1"  multiple data-rel="chosen" >
                                    
                                     <?php 
                                    if($tag_info){
                                    foreach ($tag_info as $value)
                                    {   ?>
                                    <option value="<?php echo $value['tag_id'];?>"  ><?php echo $value['tag_name'];?></option>
                                <?php } } ?>
                              </select>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">More Tag for SEO </label>
                            <div class="controls">
                                <textarea name="post_seo"  style="width:500px;" ><?php echo set_value('post_seo');?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Post Image</label>
                            <div class="controls">
                                <input name="post_image" type="file" required>
                            </div>
                       </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Post Upload</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                        <?php echo form_close();?>
                        
                    </fieldset>
                  

            </div>
        </div><!--/span-->

    </div><!--/row--> 

</div>
<!--/.fluid-container-->
<!-- end: Content --> 
<?php
$this->load->view('admin/includes/footer');
?>