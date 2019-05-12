<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        if($detaile['post_detile'] == true){
            foreach ($detaile['post_detile'] as $value){
        ?>
        <title><?php echo $value['post_title'];?></title>
        <meta name="keywords" content="<?php echo $value['post_seo'];?>" />
        <meta property="og:title" content="<?php echo $value['post_title'];?>"/>
        <meta property="og:site_name" content="visio21news"/>
        <meta property="og:description" content="<?php echo strip_tags($value['post_description']);?>" />
        <meta property="og:type" content="article"/>
        <meta property="article:publisher" content="https://www.facebook.com/vision21news/"/>
        <meta property="og:url" content="<?php echo base_url('news/article/').$value['post_unid'];?>" />
        <meta property="og:image" content="<?php echo 'images/'.$value['post_image'];?>" />
        <?php  }}?>

        <link rel="shortcut icon" href="<?php echo base_url('images/site/vision12news_favicon.ico')?>" type="image/x" />