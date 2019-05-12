
<div class="col-md-3 side">

    <div class="row">
        <?php foreach ($focus_post as $focus){?>
        <div class="focus_news">
            <a href="<?php echo  base_url().'news/article/'.$focus['post_unid'];?>">
                <img src="<?php echo base_url().'images/'.$focus['post_image'];?>">
                <p> <?php echo $focus['post_title'];?></p>
            </a>
        </div>
        <?php } ?>
    </div> <!--.row (focus news) -->

    <div id="news_tabspan" class="row">
        <div id="news_tabspan">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">সর্বশেষ</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">সর্বাধিক পঠিত</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <?php foreach ($latest_post as $latest){?>
                    <div class="focus_news">
                        <a href="<?php echo  base_url().'news/article/'.$latest['post_unid'];?>">
                            <img src="<?php echo base_url().'images/'.$latest['post_image'];?>">
                            <p> <?php echo $latest['post_title'];?></p>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <div role="tabpanel" class="tab-pane " id="profile">
                    <?php foreach ($most_view as $most){?>
                    <div class="focus_news">
                        <a href="<?php echo  base_url().'news/article/'.$most['post_unid'];?>">
                            <img src="<?php echo base_url().'images/'.$most['post_image'];?>">
                            <p> <?php echo $most['post_title'];?></p>
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div> <!--.row (tabspan) -->

</div> <!--end: side -->
