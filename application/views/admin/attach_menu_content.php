
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
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Category List</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>

            <div class="box-content">
               <div class="row-fluid ">
                    <div class="span1">
                        <label><a href="<?php echo base_url('Dashboard/attach_menu'); ?>" ><button class="btn btn-warning" title="Refresh Category" onclick="refresh();"><i class="halflings-icon white refresh"></i></button> </a>
                        </label>
                    </div>
                    <div class="span6 pull-right">
                       <label>
                          <?php echo form_open('Dashboard/attach_search');?> 
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
                            <th width="30%"><p align="center">Category Name</p></th>
                            <th width="30%"><p align="center">Add Navigation</p></th>
                            <th width="30%"><p align="center">Attached Navigation</p></th>
                            <th width="5%">Pin</th>
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
                                <?php echo form_open('Dashboard/attach_menu');
                                        echo form_hidden('cat_unid',$value['cat_unid']);
                                ?>                                  
                                    <td><?php echo ++$sl; ?></td>
                                    <td class="center"><p align="center" style="color: #800080"><?php echo $value['cat_name']; ?></p></td>
                                    <td class="center"> <p align="center">  
                                        <select name="nav_id" style="margin-bottom: -10px;">
                                            <option value="">Add or Edit Selection</option>
                                            <?php if($nav_info){
                                            foreach ($nav_info as $nav_value)
                                            {   ?>
                                            <option value="<?php echo $nav_value['nav_id'];?>"><?php echo $nav_value['nav_name'];?></option>
                                            <?php } } ?>
                                            <option value="nav">As a Navigation</option>
                                        </select></p>
                                    </td>
                                    <td class="center"><p align="center">
                                        <?php 
                                            if($value['nav_id'] == 'nav')
                                            {
                                                ?><span class="label label-warning">Navigator</span><?php
                                            } else {
                                                 foreach ( $nav_info as $attach_nav)
                                                    {
                                                    if( $value['nav_id'] == $attach_nav['nav_id'])
                                                        echo '<span class="label label-info">' .$attach_nav['nav_name']. '</span>';
                                                    }
                                            }
                                                
                                        ?></p>
                                    </td>

                                    <td class="center">
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