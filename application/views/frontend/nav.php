        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_resources/frontend/bootstrap-3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_resources/frontend/font-awesome-4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_resources/frontend/style.css" />
    </head>
    <body>

        <div id="main_wrapper" class="container">
            <div style="height:100px;"></div>
            <div class="navbar-fixed-top"> 

                
                <div id="top_nav" class="container">
                    <nav class="navbar navbar-inverse navbar-custom" id="menu">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="<?php echo base_url();?>" >
                                    <span class="logo">
                                        <img src="<?php echo base_url('images/site/vision21_logo.jpg');?>" style=""/>
                                        <i style="color: red;font-weight: bold;"> vision 21 news</i>
                                    </span>
                                </a>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <?php foreach ($single_nav as $sin_val){?>
                                    <li><a href="<?php echo base_url('news/id/'.$sin_val['cat_id']);?>"><?php echo $sin_val['cat_name'];?></a></li>
                                    <?php } foreach ( $nav as $nav_val) { ?>
                                    <li class="dropdown">
                                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nav_val['nav_name'];?></a>
                                        <ul class="dropdown-menu">
                                            <?php foreach ($cat as $cat_val){ if($nav_val['nav_id'] == $cat_val['nav_id']){ ?>
                                            <li><a href="<?php echo base_url('news/id/'.$cat_val['cat_id']);?>"><?php echo $cat_val['cat_name'];?></a></li>
                                            <?php } } ?>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>

                </div> <!--end #top_nav -->
            </div>