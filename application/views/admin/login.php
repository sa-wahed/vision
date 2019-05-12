<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>vision21news</title>
        <link rel="shortcut icon" href="<?php echo base_url('images/site/vision12news_favicon.ico')?>" type="image/x-icon">
	
        <link type="text/css" href="<?php echo base_url('_resources/frontend/bootstrap-3.3.7/css/bootstrap.min.css')?>" rel="stylesheet">
        <link type="text/css" href="<?php echo base_url('_resources/bootstrap/admin_css.css')?>" rel="stylesheet">
	<style type="text/css">
	.login{margin-top:150px}
        body{background:url(<?php echo base_url('images/site/bc-1.jpg')?>)repeat;color:#E5E5E5;}
	</style>
</head>
<body>
	<div class="container login">
	<div class="col-md-6 col-md-offset-3">
	
		<div class="panel panel-default">
		<div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> &nbsp;&nbsp;Login Panel</div>
		<div class="panel-body">
		<div class="col-md-10 col-md-offset-1">
                    <div  style="min-height:60px" class="text-center">
                    <?php if( $this->session->flashdata('login_flash') ){ $flash = $this->session->flashdata('login_flash');?>
                    <div class="alert alert-<?php echo $flash['class'];?>">
                        <?php echo $flash['text'];?>
                    </div>
                    <?php }?>
                </div>
		
			<?php 
                            $act = base_url('login'); 
                            echo form_open($act);
                        ?>
				<label >User Name :</label>
				<div class="input-group input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
				<?php echo form_input(['name'=>'username','class'=>'form-control', 'placeholder'=>'user name','aria-describedby'=>'basic-addon1','value'=> set_value('username')]);?>
                                </div>	
				<br />
				
				<label >Password :</label>
				<div class="input-group input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
				<?php echo form_password(['name'=>'password','class'=>'form-control', 'placeholder'=>'password','aria-describedby'=>'basic-addon1']);?>
                                </div>
				<br />
				<?php echo form_submit(['name'=> 'submit' ,'class'=>'btn btn-success btn-block btn-lg' ,'value'=>'LOGIN']);?>
				
				<br /><br /><br />
                        <?php echo form_close();?>
			<?php echo validation_errors();?>
		</div>
		</div>
		</div>
	</div>
	</div>
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

</body>
</html>