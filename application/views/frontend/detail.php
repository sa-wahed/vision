<?php require_once('nav.php'); ?>
<div id="news_contents" class="row">

    <div id="news_section" class="col-md-9">

        <div id="secondery_news_section" class="row">

            <div id="" class="container-fluid top_news news">
                <div class="container-fluid">
                    <?php 
                    if($detaile['post_detile'] == true){
                        foreach ($detaile['post_detile'] as $post){
                        ?>
                    <h4><?php echo $post['post_title']?></h4>
                    <img class="img-thumbnail" src="<?php echo base_url().'images/'.$post['post_image'];?>" alt="" />
                    <p><?php echo $post['post_description']?></p>
                    <?php } }?>
                </div>
            </div>
        
        </div>
        
         <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div style="float:right;"class="fb-share-button " data-href="<?php echo base_url('news/article/').$detaile['post_detile'][0]['post_unid'];?>" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>
        
        <div id="fb-root"></div>
          
        <div class="fb-comments" data-href="https://www.facebook.com/vision21news/<?php echo $detaile['post_detile'][0]['post_unid']?>" data-width="" data-numposts="5"></div>
        
       
        <div id="mid_ad_block" class="row">
            <marquee><h4>CONTACT FOR ADVERTISEMENT</h4></marquee>
            <a href="javscript:void(0);" id="remove_this_item" style="color:red;font-weight:bold; position:relative;top:-50px;left:99%;"><big>x</big></a>
        </div> <!--end: #mid_ad_block -->

        <div id="secondery_news_section" class="row">

            <?php  foreach ($detaile['category_post'] as $bottom){?>
            <div id="bottom_post" class="col-md-3 col-sm-3 col-xs-6  news">
                <a href="<?php echo base_url('news/article/').$bottom['post_unid']?>">
                    <img class="img-thumbnail" src="<?php echo  base_url().'images/'.$bottom['post_image'];?>" alt="" />
                    <h5><?php echo $bottom['post_title'];?></h5>
                </a>
            </div>
            <?php } ?>

        </div> <!--end:#secondery_news_section-->

    </div> <!--end: #news_section -->
    <?php require_once('side.php'); ?>
</div> <!-- end: #news_content -->
<?php require_once('foot.php'); ?>