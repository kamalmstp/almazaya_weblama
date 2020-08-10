<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Nutrieve Benecol" />
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/normalize.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/foundation.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/superfish.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/style.css')?>">
    
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/owl-carousel/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/owl-carousel/owl.theme.css')?>">
    
    <script type="text/javascript" src="<?=base_url('assets/frontend/js/vendor/jquery.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/frontend/js/vendor/modernizr.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/frontend/js/superfish.js')?>"></script>
    
    
	<title>Nutrieve Benecol</title>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-77038614-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<div class="row rowfull">
    <div class="large-12 columns no-padding-left no-padding-right">
        <div class="lookup">
            <img src="<?=base_url('assets/frontend/images/logo-lookup-atas.png')?>" />
        </div>
        <div class="header">
            <div class="header-top">
                <div class="container_in">
                    
                    <div class="large-12 columns no-padding-left no-padding-right" style="text-align: right;">
                        <div class="box_language">
                            <span>PILIH BAHASA</span>
                            <div class="current_bahasa">
                                <!--<span class="current">ID <img class="arrow_down_bahasa" src="images/arrow-down.png" /></span>
                                <div class="select_bahasa" style="display: none;">
                                    <div class="ID"><a href="">ID</a></div>
                                    <div class="EN"><a href="">EN</a></div>
                                </div>
                                -->
                                <form method="POST">
                                <select name="bahasa" class="bahasa"  disabled="">
                                    <?=$controller->show_menu_lang()?>
                                </select>
                                </form>
                                <img class="arrow_down_bahasa" src="<?=base_url('assets/frontend/images/arrow-down.png')?>" />
                            </div>
                            
                        </div>
                        
                        
                        <div class="box_account">
                            <ul>
                                <li><a href="">MASUK</a></li>
                                <li><a href="">DAFTAR</a></li>
                            </ul>
                        </div>
                        <div class="box-search">
                            <span class="search">Search</span>
                            <div class="btn-search"><img src="<?=base_url('assets/frontend/images/search.png')?>" /></div>
                            <div class="input-search">
                                <input type="text" name="search" class="search-q" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom">
            
                <div class="container_in">
                    <ul class="sf-menu" id="example">
                        <?php
                        foreach ($menu as $mn){
                        ?>
                        
                            <?php
                            if ($mn["link"] == ""){
                            ?>
                            <li class="thishome">
                            <a href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> javascript:;  <?php  } ?>" class=""><img src="<?=base_url("assets/frontend/images/home-icon.png")?>" /></a>
                            <?php
                            }else{
                            ?>
                            <li>
                            <a href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> javascript:;  <?php  } ?>" class=""><?=$mn["title"]?></a>
                            <?php
                            }
                            ?>
                            
                            
                            
                            <?php
                                if ($mn["hasubmenu"] > 0){
                            ?>        
                            <?=$controller->submenu($mn["id"])?>
                            <?php
                            }
                            ?>                                                            
        
                        </li>
                        <?php
                        }
                        ?>
            		</ul>
                </div>
            </div>
        </div>