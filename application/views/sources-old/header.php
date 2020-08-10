<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Nutrieve Benecol" />
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/normalize.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/foundation.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/superfish.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/style.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/responsive-base.css?v=1')?>">
    
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/owl-carousel/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/frontend/css/owl-carousel/owl.theme.css')?>">
    
    
    <script type="text/javascript" src="<?=base_url('assets/frontend/js/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/frontend/js/vendor/modernizr.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/frontend/js/superfish.js')?>"></script>
    <link href="http://nutrivebenecol.com/jualtiketindonesiatangkalkolesterol/assets/images/favicon-benecol.png" rel="shortcut icon" type="image/x-icon" />
    
    <title>Nutrive Benecol - <?=$title?></title>
    <meta name="description" content="<?=strip_tags($description)?>"/>
    
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
      ga('create', 'UA-48212576-1', 'auto');
      ga('send', 'pageview');
    
    </script>
</head>
<body>
<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">                

      <nav class="tab-bar">
        <section class="right-small">
          <a class="right-off-canvas-toggle menu-icon" ><span></span></a>
         </section>
        <section class="middle tab-bar-section">
        </section>
      </nav>
      <aside class="right-off-canvas-menu">
        <ul class="off-canvas-list">
          <li><label>Menu</label></li>
          <?php
                    foreach ($menu as $mn){
                ?>
                <li>
                    <a href="<?=base_url().$codebahasa.$mn["link"]?>" class=""><?=strip_tags($mn["title"])?></a>
                    
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
      </aside>
      <section class="main-section">
<div class="off-canvas-wrapper">
<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
<div class="off-canvas position-right" id="offCanvas" data-off-canvas data-position="right"></div>
<div class="off-canvas-content" data-off-canvas-content>

<div class="row rowfull">
    <div class="large-12 columns no-padding-left no-padding-right">
        <div class="lookup">
            <a href="<?=base_url($codebahasa)?>"><img src="<?=base_url('assets/frontend/images/logo-lookup-atas.png')?>" /></a>
        </div>
        <div class="header">
            <div class="header-top">
                <div class="container_in">
                    
                    <div class="large-12 columns no-padding-left no-padding-right" style="text-align: right;">
                        <div class="box_language">
                            <?php
                            if ($codebahasa == ""){
                            ?>
                            <span>PILIH BAHASA</span>
                            <?php
                            }else{
                            ?>
                            <span>LANGUAGE</span>
                            
                            <?php
                            }
                            ?>
                            <div class="current_bahasa">
                                
                                <form method="POST">
                                <select name="bahasa" class="bahasa" disabled="">
                                    <?=$controller->show_menu_lang()?>
                                </select>
                                </form>
                                <img class="arrow_down_bahasa" src="<?=base_url('assets/frontend/images/arrow-down.png')?>" />
                            </div>
                            
                        </div>
                        
                        
                        <div class="box_account">
                            <ul>
                                <?php
                                if ($codebahasa == ""){
                                ?>
                                <li><a href="">MASUK</a></li>
                                <li><a href="">DAFTAR</a></li>
                                <?php
                                }else{
                                ?>
                                <li><a href="">LOGIN</a></li>
                                <li><a href="">REGISTER</a></li>
                                <?php
                                }
                                ?>
                                
                            </ul>
                        </div>
                        <div class="box-search">
                            <span class="search">Search</span>
                            <div class="btn-search"><img src="<?=base_url('assets/frontend/images/search.png')?>" /></div>
                            <div class="input-search">
                                <form method="get" action="<?=base_url($codebahasa."search")?>">
                                <input type="text" name="q" class="search-q" />
                                </form>
                                
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
                                if ($mn["idmodule"] == 36){
                                   $link = $mn["link"];
                                }else{
                                    $link = base_url().$codebahasa.$mn["link"];
                                }
                            ?>
                            <li>
                            <a href="<?=$link?>" class=""><?=$mn["title"]?></a>
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
                    <nav class="mobile_bas"> 
                <a class="menu_mobile" href="javascript:;"><span>Menu</span></a>
                </nav>
                </div>
            </div>
        </div>