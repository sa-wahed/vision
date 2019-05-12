 <!-- start: Header -->

        <div class="container-fluid-full">
            <div class="row-fluid">

                <!-- start: Main Menu -->
                <div id="sidebar-left" class="span2">
                    <div class="nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li><a href="<?php echo base_url('Dashboard')?>"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>	
                            <li><a href="<?php echo base_url()?>" target="_blank"><i class="icon-globe"></i><span class="hidden-tablet" > My Site</span></a></li>
                            <?php if( $this->session->userdata('admin_role') != '0' ) { ?>
                            <li><a href="<?php echo base_url('Dashboard/post')?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> Add Post</span></a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url('Dashboard/post_view')?>"><i class="icon-list-alt"></i><span class="hidden-tablet"> View Post</span></a></li>
                            <?php if( $this->session->userdata('admin_role') != '0' ) { ?>
                            <li><a href="<?php echo base_url('Dashboard/tag')?>"><i class="icon-reorder"></i><span class="hidden-tablet"> Tag </span></a></li>
                            <?php } ?>
                            <?php if( $this->session->userdata('admin_role') == '5' || $this->session->userdata('user_id') == '1' ) { ?>
                            <li><a href="<?php echo base_url('Dashboard/decoration')?>"><i class="icon-reorder"></i><span class="hidden-tablet"> Post Deoration </span></a></li>
                            <?php } ?>
                            <?php if( $this->session->userdata('user_id') == '1'){ ?>
                            <li>
                                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Controller </span><span class="label label-important"> 3 </span></a>
                                <ul>
                                    <li><a href="<?php echo base_url('Dashboard/all_post')?>"><i class="icon-reorder"></i><span class="hidden-tablet"> All Post </span></a></li>
                                    <li><a href="<?php echo base_url('Dashboard/category')?>"><i class="icon-reorder"></i><span class="hidden-tablet"> Category </span></a></li>
                                    <li><a href="<?php echo base_url('Dashboard/navigation')?>"><i class="icon-reorder"></i><span class="hidden-tablet"> Navigation </span></a></li>
                                    <li><a href="<?php echo base_url('Dashboard/attach_menu')?>"><i class="icon-reorder"></i><span class="hidden-tablet"> Attach Menu </span></a></li>
                                    <li><a href="<?php echo base_url('Dashboard/brand')?>"><i class="icon-fire"></i><span class="hidden-tablet">Brand</span></a></li>
                                    <li><a href="<?php echo base_url('Dashboard/user')?>"><i class="icon-reorder"></i><span class="hidden-tablet">User Management</span></a></li>
                            
                                </ul>	
                            </li>
                            <?php } ?>
                            </ul>
                    </div>
                </div>
                <!-- end: Main Menu -->

                <noscript>
                &lt;div class="alert alert-block span10"&gt;
                &lt;h4 class="alert-heading"&gt;Warning!&lt;/h4&gt;
                &lt;p&gt;You need to have &lt;a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank"&gt;JavaScript&lt;/a&gt; enabled to use this site.&lt;/p&gt;
                &lt;/div&gt;
                </noscript>