<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Eternaleaf</title>
    <link href="<?=base_url("assets/css/bootstrap.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/freelancer.css")?>" rel="stylesheet">
    <link href="<?=base_url("assets/css/font-awesome.min.css")?>" rel="stylesheet" type="text/css">
   <link href="<?=base_url("assets/css/base.css")?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url("assets/css/owl.carousel.css")?>" />
    <link href="<?=base_url("assets/css/jasny-bootstrap.css")?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url("assets/css/animate.css")?>" />
    <script src="<?=base_url("assets/js/jquery-1.10.2.min.js")?>"></script>
    <script src="<?=base_url("assets/js/bootstrap.min.js")?>"></script>
    <meta name="google-site-verification" content="cAxRafuEz9wZ8Ahd49OaUml4BN10dgkG26psVNU2SEs" />
    <link rel="icon" href="<?=base_url("assets/img/web-icon-eternaleaf.png")?>" type="image/x-icon">
    
  <style type="text/css">
    .navmenu-fixed-right {
    left: auto !important;
}
  </style>
  <script>
    $(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
    </script>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84875713-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-desktop" >
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"  href="<?=base_url($link_bahasa)?>"><img style="position: relative; z-index:9999" src="<?=base_url("assets/img/logo.png")?>" /></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="topmenu">
                <ul class="nav-top" >
                    <li>
                        <?php
                        if ($codebahasa == ""){
                        ?>
                        <a href="<?=base_url($codebahasa."your-shopping-bag")?>"><i class="cart"><img src="<?=base_url("assets/img/cart.png")?>" /></i><?=$this->lang->line('yourcart');?> <b class="qty_cart"><?=$controller->getcart_qty()?></b></a>
                        <?php
                        }else{
                        ?>
                        <a href="<?=base_url($codebahasa."belanjaan-saya")?>"><i class="cart"><img src="<?=base_url("assets/img/cart.png")?>" /></i><?=$this->lang->line('yourcart');?> <b class="qty_cart"><?=$controller->getcart_qty()?></b></a>
                        <?php
                        }
                        ?>
                    </li>
                    <?php
                    $data_session = $this->session->all_userdata();
                    if (isset($data_session["login_user"]["eternaleaf_user_login"])){
                        ?>
                        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Hello, <?=$data_session["login_user"]["eternaleaf_fullname"]?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php
                                $data_akun = $controller->pages_account();
                                //print_r($data_akun);
                                foreach ($data_akun as $pages_sub){
                                ?>
                                <li><a href="<?=base_url($pages_sub["link"])?>"><?=$pages_sub["title"]?></a></li>
                                <?php
                                }
                                ?>
                            
                                
                            </ul>
                        </li>                        
                        <?php                        
                    }else{
                    ?>                    
                    <li>
                        <?php
                        if ($codebahasa == ""){
                        ?>
                        <a href="<?=base_url($codebahasa."login")?>"><?=$this->lang->line('masukdaftar');?></a>
                        <?php
                        }else{
                        ?>
                        <a href="<?=base_url($codebahasa."masuk")?>"><?=$this->lang->line('masukdaftar');?></a>
                        <?php
                        }
                        ?>
                    </li>
                    <?php
                    }
                    ?>
                    <li>
                        Language :
                            <div class="dropdown-custom">
                                <select name="bahasa" id="dynamic_select">
                                    <?php
                                    echo $controller->show_menu_lang();
                                    ?>
                                    
                                </select>
                                <i class="arrow-down" style="position: absolute; top: -1px; right: 9px;">
                                <img src="<?=base_url("assets/img/new_arrow.png")?>">
                                </i>
                            </div>
                    </li>
                    <li>
                        <a href="javascript:;"><?=$this->lang->line('cari');?> <i class="search_btn"><img src="<?=base_url("assets/img/ico_search30.png")?>"></i></a>
                        <div class="input" style="display: none; ">
                            <form class="search-form" method="GET" action="<?=base_url($codebahasa."search")?>/">
                            <input class="s open" type="text" placeholder="<?=$this->lang->line('searchhere');?>..." name="q" style="width: 375px; border: medium none; padding: 5px; border-radius: 2px;">
                            <input type="submit" name="submit" class="submitsearch" style="display: none;" value="1" />
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    
                    <?php
                        foreach ($menu as $mn){
                        ?>
                        
                            <?php
                            if ($mn["link"] == ""){
                            ?>
                            <li>
                            <a href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> javascript:;  <?php  } ?>" class="">Home</a>
                            <?php
                            }else{
                                if ($mn["idmodule"] == 36){
                                   $link = $mn["link"];
                                }else{
                                    $link = base_url().$codebahasa.$mn["link"];
                                }
                            ?>
                            <li <?php if ($mn["submenu"] == 0){ ?><?php }else{ ?> class="dropdown" <?php  } ?> >
                            <a <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>"<?php }else{ ?> href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><b class="caret"></b><?php } ?></a>
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
                <div class="topmenu2" style="display: none;">
                <ul class="nav-top" style="padding-left: 0px;" >
                    <li class="cart-li">
                        <?php
                        if ($codebahasa == ""){
                        ?>
                        <a href="<?=base_url($codebahasa."your-shopping-bag")?>"><i class="cart"><img src="<?=base_url("assets/img/cart.png")?>" /></i><?=$this->lang->line('yourcart');?> <b class="qty_cart"><?=$controller->getcart_qty()?></b></a>
                        <?php
                        }else{
                        ?>
                        <a href="<?=base_url($codebahasa."belanjaan-saya")?>"><i class="cart"><img src="<?=base_url("assets/img/cart.png")?>" /></i><?=$this->lang->line('yourcart');?> <b class="qty_cart"><?=$controller->getcart_qty()?></b></a>
                        <?php
                        }
                        ?>
                    </li>
                    <li>
                        <a href="javascript:;">Login/Sign Up</a>
                    </li>
                    <li>
                        Language :
                            <div class="dropdown-custom">
                                <select name="bahasa">
                                    <option value="">EN</option>
                                    <option value="">IN</option>
                                </select>
                                <i class="arrow-down" style="position: absolute; top: -1px; right: 9px;">
                                <img src="assets/img/new_arrow.png">
                                </i>
                            </div>
                    </li>
                    <li>
                        <a href="javascript:;">Search <i class="search_btn"><img src="assets/img/ico_search30.png"></i></a>
                        <div class="input" style="display: none; ">
                            <input class="s open" type="text" placeholder="Search here..." name="s" style="width: 375px; border: medium none; padding: 5px; border-radius: 2px;">
                        </div>
                    </li>
                </ul>
            </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas"> 
        <span class="keluar"><a href="javascript:;">&times;</a></span>
        <ul class="nav navmenu-nav">
            <?php
                    
                foreach ($menu as $mn){
                ?>
                
                    <?php
                    if ($mn["link"] == ""){
                    ?>
                    <li>
                    <a href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> javascript:;  <?php  } ?>" class="">Home</a>
                    <?php
                    }else{
                        if ($mn["idmodule"] == 36){
                           $link = $mn["link"];
                        }else{
                            $link = base_url().$codebahasa.$mn["link"];
                        }
                    ?>
                    <li <?php if ($mn["submenu"] == 0){ ?><?php }else{ ?> class="dropdown" <?php  } ?> >
                    <a <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>/"<?php }else{ ?> href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><b class="caret"></b><?php } ?></a>
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
        <ul class="nav navmenu-nav user-menu">
            <li class="cart-li">
                <?php
                        if ($codebahasa == ""){
                        ?>
                        <a href="<?=base_url($codebahasa."your-shopping-bag")?>"><i class="cart"><img src="<?=base_url("assets/img/cart.png")?>" /></i><?=$this->lang->line('yourcart');?> <b class="qty_cart"><?=$controller->getcart_qty()?></b></a>
                        <?php
                        }else{
                        ?>
                        <a href="<?=base_url($codebahasa."belanjaan-saya")?>"><i class="cart"><img src="<?=base_url("assets/img/cart.png")?>" /></i><?=$this->lang->line('yourcart');?> <b class="qty_cart"><?=$controller->getcart_qty()?></b></a>
                        <?php
                        }
                        ?>
            </li>
            <?php
                    $data_session = $this->session->all_userdata();
                    if (isset($data_session["login_user"]["eternaleaf_user_login"])){
                        ?>
                        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Hello, <?=$data_session["login_user"]["eternaleaf_fullname"]?><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php
                                $data_akun = $controller->pages_account();
                                //print_r($data_akun);
                                foreach ($data_akun as $pages_sub){
                                ?>
                                <li><a href="<?=base_url($pages_sub["link"])?>"><?=$pages_sub["title"]?></a></li>
                                <?php
                                }
                                ?>
                            
                                
                            </ul>
                        </li>                        
                        <?php                        
                    }else{
                    ?>                    
                    <li>
                        <a href="<?=base_url($codebahasa."login")?>">Login/Sign Up</a>
                    </li>
                    <?php
                    }
                    ?>
            </li>
            <li>
                        <div style="display: none; overflow: hidden;"><span style="float: left;">Language :</span>
                            <div class="dropdown-custom">
                                <select name="bahasa">
                                    <option value="">EN</option>
                                    <option value="">IN</option>
                                </select>
                                <i class="arrow-down" style="position: absolute; top: -1px; right: 0px;">
                                <img src="<?=base_url("assets/img/new_arrow_orange.png")?>">
                                </i>
                            </div>
                            </div>
                    </li>
            <li>
                <form class="search-form" method="GET" action="<?=base_url($codebahasa."search")?>/">
                <input  class="s open search_m" type="text" placeholder="Search here..." name="q" style="margin-left: 6px;"/>
                </form>
            </li>
            
        </ul>
    </div>
    <div class="navbar navbar-default navbar-fixed-top hidden-md hidden-lg">
        <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu"> <span class="icon-bar"></span>
 <span class="icon-bar"></span>
 <span class="icon-bar"></span>
        </button> <a class="navbar-brand" href="<?=base_url($link_bahasa)?>"><img src="<?=base_url("assets/img/logo.png")?>" /></a>
    </div>