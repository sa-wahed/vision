<?php 
$pg = isset($pg)?$pg:null;
?>
<!-- start: Content -->
<div id="content" class="span10" style="min-height: 218px;">


    <ul class="breadcrumb">
        <li>
            <a href="#">Dashboard</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-list"></i>
            <a href="index.html">Attach Menu</a> 
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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Post Decoration</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>

            <div class="box-content">
               <div class="row-fluid ">
                    <div class="span1">
                        <label><a href="<?php echo base_url('Dashboard/decoration/'.$pg); ?>" ><button class="btn btn-warning" title="Refresh Category" onclick="refresh();"><i class="halflings-icon white refresh"></i></button> </a>
                        </label>
                    </div>
                    <div class="span6 pull-right">
                      
                    </div>
                </div>
                <table class="table table-striped table-bordered" id="text_table">
                    <thead>
                        <tr>
                            <th width="5%"><p align="center">SL</p></th>
                            <th width="50%"><p align="center">Post Title</p></th>
                            <th width="20%"><p align="center">Decorated</p></th>
                            <th width="20%"><p align="center">Decorations</p></th>
                            <th width="5%" ><p align="center">Pin</p></th>
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
                                <?php 
                                    echo form_open('Dashboard/decoration/'.$pg);
                                ?>                                  
                                    <td><p align="center"><?php echo ++$sl; ?></p></td>
                                    <td><?php echo $value['post_title']; ?></td>
                                    <td><p align="center"><?php
                                        if($value['post_decoration'] == '1')
                                        {
                                            echo '<span class="label label-important">Main</span>';
                                        }
                                        elseif ($value['post_decoration'] == '2') 
                                        {
                                             echo '<span class="label label-success">Top</span>';
                                        }
                                        elseif ($value['post_decoration'] == '3') 
                                        {
                                             echo '<span class="label label-info">Bottom</span>';
                                        }
                                        elseif ($value['post_decoration'] == '4') 
                                        {
                                             echo '<span class="label label-warning">Focus</span>';
                                        }
                                    ?></p>
                                    </td>
                                    <td>
                                        <p align="center">  
                                        <select name="post_decoration" style="margin-bottom: -10px;">
                                            <option value="">Add or Edit Selection</option>
                                            <option value="1">Main Post</option>
                                            <option value="2">Top Post</option>
                                            <option value="3">Bottom Post</option>
                                            <option value="4">Focus Post</option>
                                        </select>
                                        <input type="hidden" name="post_unid"  value="<?php echo $value['post_unid'];?>" />
                                        </p>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success" ><i class="halflings-icon white pushpin"></i></button>
                                    </td>
                                <?php echo form_close(); ?>
                            </tr>   
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
                            <?php  echo $this->pagination->create_links(); ?>
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