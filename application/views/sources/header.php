<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Al Mazaya Islamic School - <?php if (isset($meta_title)){ ?><?=$meta_title?><?php } ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url("assets/css/bootstrap.min.css")?>" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="<?=base_url("assets/vendor/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url("assets/css/owl.carousel.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/owl.theme.css")?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?=base_url("assets/css/freelancer.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/base.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/jquery.fancybox.min.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/jasny-bootstrap.css")?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url("assets/css/jquery-ui.css")?>">
    <script src="<?=base_url("assets/js/jquery-1.12.4.js")?>"></script>
    <script src="<?=base_url("assets/js/jquery-ui.js")?>"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="<?=base_url("favicon-16x16.png")?>">
  </head>
  <body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="topmenu">
    <div class="container">
    <div class="row">
          <div class="col-xs-6 left">
                <ul>
                    <li><a href="">ENG</a></li>
                    <li><a href="">IND</a></li>
                </ul>
            </div>
            <div class="col-xs-6 right">
                <ul>
                    <li><a href=""><img src="<?=base_url("assets/img/fb-icon.png")?>" /></a></li>
                    <li><a href=""><img src="<?=base_url("assets/img/tw-icon.png")?>" /></a></li>
                    <li><a href=""><img src="<?=base_url("assets/img/ig-icon.png")?>" /></a></li>
                </ul>
            </div>
          </div>   
          </div>   
          </div>    
        <div class="container" style="position: relative">
                <div class="navbar-header page-scroll">
                <div class="logo">
                    <a class="navbar-brand js-scroll-trigger" href="<?=base_url()?>">
                    <img src="<?=base_url("assets/img/logo.png")?>" />
                    </a>
                </div>
                </div>
                <div class="mobilemenu">
                    <a href="javascript:;">MENU <i class="fa fa-bars"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                                    foreach ($menu as $mn){
                                    ?>
                                        <?php
                                        if ($mn["link"] == ""){
                                        ?>
                                        <li class="nav-item">
                                        <a class="nav-link" href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> <?=base_url().$codebahasa.$mn["link"]?>/  <?php  } ?>" class="">HOME</a>
                                        <?php
                                        }else{
                                            if ($mn["idmodule"] == 36){
                                               $link = $mn["link"];
                                            }else{
                                                $link = base_url().$codebahasa.$mn["link"];
                                            }
                                        ?>
                                        <li class="nav-item" <?php if ($mn["submenu"] == 0){ ?><?php }else{ ?> class="dropdown" <?php  } ?> >
                                        <a class="nav-link"  <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>/"<?php }else{ ?> href="#" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><b class="caret"></b><?php } ?></a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="http://virtualclass.almazayaislamicschool.sch.id/" class="">VIRTUAL CLASS</a>
                        </li>
                        <li class="nav-item search">
                                <div class="formsearch" style="display: none">
                                    <form method="GET" class="searchform" action="<?=base_url("search")?>/">
                                        <input type="text" class="search" name="q" placeholder="Search Here..." />
                                    </form>
                                </div>
                            <a href="javascript:;" class="btn-search"><img src="<?=base_url("assets/img/search.png")?>" /></a>
                        </li>
                    </ul>
            </div>
        </div>
    </nav>
    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas"><!--###navmenu navmenu-default navmenu-fixed-right offcanvas### begin --> 
        <span class="keluar"><a href="javascript:;">&times;</a></span>
        <ul class="nav navmenu-nav" id="navmenu-nav-top">
        <?php
            foreach ($menu as $mn){
            ?>
                <?php
                if ($mn["link"] == ""){
                ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> <?=base_url().$codebahasa.$mn["link"]?>/  <?php  } ?>" class="">HOME</a>
                <?php
                }else{
                    if ($mn["idmodule"] == 36){
                       $link = $mn["link"];
                    }else{
                        $link = base_url().$codebahasa.$mn["link"];
                    }
                ?>
                <li class="nav-item" <?php if ($mn["submenu"] == 0){ ?><?php }else{ ?> class="dropdown" <?php  } ?> >
                <a class="nav-link"  <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>/"<?php }else{ ?> href="#" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><b class="caret"></b><?php } ?></a>
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
    <!-- Header -->