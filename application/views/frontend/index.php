<?php require_once('nav.php'); ?>
<div id="news_contents" class="row-fluid">

    <div id="news_section" class="col-md-9 ">
        <div id="primary_news_section" class="row">
            
            <div id="" class="col-md-8 top_news news">
               <?php if($main_post == true){?> 
                <a href="<?php echo base_url().'news/article/'.$main_post[0]['post_unid']?>">
                    <h4><?php echo $main_post[0]['post_title'];?></h4>
                    <img class="img-thumbnail" src="<?php echo base_url().'images/'.$main_post[0]['post_image'];?>" alt="" />
                </a>
                <p>
                <?php
                    $description = strip_tags($main_post[0]['post_description']);
                    $pieces = explode(' ',$description);
                    $count = array_splice($pieces,0,63);
                    $dessrip = implode(' ',$count);
                    echo $dessrip."&nbsp;&nbsp;<a href='". base_url().'news/article/'.$main_post[0]['post_unid']."'><small>বিস্তারিত ...</small> </a> ";
                ?>
                </p>
               <?php } ?>
            </div>

            <?php  foreach ($top_post as $top){?>
            <div id="top_post" class="col-md-4 news">
                <a href="<?php echo base_url().'news/article/'.$top['post_unid']?>">
                    <h4><?php echo $top['post_title'];?></h4>
                    <img class="img-thumbnail" src="<?php echo base_url().'images/'.$top['post_image'];?>" alt="" />
                </a>
                <p>
                <?php
                    $description = strip_tags($top['post_description']);
                    $pieces = explode(' ',$description);
                    $count = array_splice($pieces,0,15);
                    $dessrip = implode(' ',$count);
                    echo $dessrip."&nbsp;&nbsp;<a href='". base_url().'news/article/'.$top['post_unid']."'><small>বিস্তারিত ...</small> </a> ";
                ?>
                </p>
            </div>
            <?php } ?>
            
        </div>	<!--end:#primary_news_section-->
<style type="text/css">
    #category_news_section .panel 
    {
        background-color: rgba(255, 255, 255, 0.65);
        border: 0px solid transparent;
        border-radius: 10px;
    }
    #category_news_section   #title-1
    {
        font-size: 12px;
        text-align: left;
    }
    #category_news_section .box
    {
        padding-left: 7px;
        padding-right: 7px;
    }
    #category_news_section .box a
    {
        color:tomato;
    }
    #category_news_section .box a:hover
    {
        color:slateblue;
    }
    #category_news_section .box-2
    {
        font-size: 13px;
        text-align: left;
        margin-top: 10px;
    }
    #category_news_section .box-2 a
    {
        color:#295;
    }
    #category_news_section .box-2 a:hover
    {
        color:mediumorchid;
    }
    #category_news_section .panel-heading
    {
        font-size: 15px;
        color:#990073;
        text-align: center;
        font-weight: bold;
    }
</style>

<?php if(!empty($category_post)){?>
        <div id="category_news_section" class="row">
<?php   foreach ($category_post as $cat_post){?>
            <div class="panel panel-success col-md-6">
                <div class="panel-heading">
                    <?php   foreach ($cat as $cat_value){if($cat_post[0]['cat_id']==$cat_value['cat_id'])echo $cat_value['cat_name'];} ?>
                </div>
                <div class="panel-body">
                    <div class="row">
        <?php   $i=0; 
                foreach ($cat_post as $cat_post_val)
                {  
                    if($i < 2)
                    {   ?>                    
                        <div class="col-sm-6 box">
                            <a href="<?php echo base_url('news/article/').$cat_post_val['post_unid']?>">
                                <img src="<?php echo base_url().'images/'.$cat_post_val['post_image'];?>" class="img-thumbnail">
                                <span id="title-1"><?php echo $cat_post_val['post_title'];?></span>
                            </a>
                        </div> 
                       
        <?php       }else{  ?>
                        <div class="col-sm-12 box-2"><i class="glyphicon glyphicon-chevron-right">&nbsp;</i><a href="<?php echo base_url('news/article/').$cat_post_val['post_unid']?>"><?php echo $cat_post_val['post_title'];?></a></div>
        <?php       }
                $i++;                 
                }   ?>
                    </div>  
                </div>
            </div>
<?php }?>                  
        </div>
<?php }?>
        <div id="secondery_news_section" class="row">
            
            <?php  foreach ($bottom_post as $bottom){?>
            <div id="bottom_post" class="col-md-3 col-xs-6 news">
                <a href="<?php echo base_url('news/article/').$bottom['post_unid']?>">
                    <img class="img-thumbnail" src="<?php echo base_url().'images/'.$bottom['post_image'];?>" alt="" />
                    <h5><?php echo $bottom['post_title'];?></h5>
                </a>
            </div>
            <?php } ?>
        </div> <!--end:#secondery_news_section-->

    </div> <!--end: #news_section -->
    <?php require_once('side.php'); ?>
</div> <!-- end: #news_content -->
<?php require_once('foot.php'); ?>