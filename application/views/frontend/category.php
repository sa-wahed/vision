<?php require_once('nav.php'); ?>
<div id="news_contents" class="row">

    <div id="news_section" class="col-md-9">
        <div id="primary_news_section" class="row">
            <?php 
            if($post_info == TRUE){
                foreach ($post_info as $post_cat){                
            ?>
                <div id="top_post" class="col-md-4 col-xs-12 news">
                    <a href="<?php echo base_url().'news/article/'.$post_cat['post_unid']?>">
                        <h4><?php echo $post_cat['post_title']?></h4>
                        <img class="img-thumbnail" src="<?php echo base_url().'images/'.$post_cat['post_image'];?>" alt="" />
                    </a>
                    <p>
                    <?php
                        $description = strip_tags($post_cat['post_description']);
                        $pieces = explode(' ',$description);
                        $count = array_splice($pieces,0,18);
                        $dessrip = implode(' ',$count);
                        echo $dessrip."&nbsp;&nbsp;<a href='". base_url().'news/article/'.$post_cat['post_unid']."'><small>বিস্তারিত ...</small> </a> ";
                        
                    ?>
                    </p>
                </div>
            <?php }}?>
        <div class="row col-md-12">
            <nav class="text-center">
                <ul class="pagination">
                   <?php echo $this->pagination->create_links(); ?>
                </ul>
              </nav>
        </div>
            
        </div>	<!--end:#primary_news_section-->
        
        <div id="mid_ad_block" class="row">
            <marquee><h4>CONTACT FOR ADVERTISEMENT</h4></marquee>
            <a href="javscript:void(0);" id="remove_this_item" style="color:red;font-weight:bold; position:relative;top:-50px;left:99%;"><big>x</big></a>
        </div> <!--end: #mid_ad_block -->



    </div> <!--end: #news_section -->
    <?php require_once('side.php'); ?>
</div> <!-- end: #news_content -->
<?php require_once('foot.php'); ?>