

<!doctype html>
<html class="no-js" lang="en">

<!-- Mirrored from techlinqs.com/html/school-0.2/blog-full-width.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Mar 2017 03:51:11 GMT -->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content=""/>

<title>SDIT AL UMAR NGARGOSOKA <?php if (isset($meta_title)){ ?> - <?=$meta_title?><?php } ?></title>
<?php if (isset($meta_description)){ ?>
<meta name="description" content="<?=$meta_description?>">
<?php } ?>

<!-- StyleSheets -->
<link rel="stylesheet" href="<?=base_url("assets/css/vendor/bootstrap.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/style.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/icomoon.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/main.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/color-1.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/animate.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/font-awesome.min.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/responsive.css")?>">
<link rel="stylesheet" href="<?=base_url("assets/css/transition.css")?>">

<!-- FontsOnline -->
<link href="https://fonts.googleapis.com/css?family=Mrs+Saint+Delafield|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">

<!-- JavaScripts -->
<script src="js/vendors/modernizr.html"></script>
</head>
<body>
<!-- Wrapper -->
<div class="wrapper">
	
	<!-- Header -->
	<header id="header" class="inner-header sticky-2">
		<div class="container">
			
			<!-- logo -->
			<div class="logo-holder">
				<strong><a href="<?=base_url()?>"><img style="height: 90px;" src="<?=base_url("assets/images/inner-logos/logo-1.png")?>" alt="logo"></a></strong>
			</div>
			<!-- logo -->

			<!-- Navigation -->
		    <nav class="navigation-holder">
		    	<a class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		    		<i class="fa fa-bars"></i>
		    	</a>
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="tc-navigation"> 
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
                            <a href="<?php if ($mn["submenu"] == 0){ ?><?=base_url().$codebahasa.$mn["link"]?><?php }else{ ?> <?=base_url().$codebahasa.$mn["link"]?>/  <?php  } ?>" class="">Home</a>
                            <?php
                            }else{
                                if ($mn["idmodule"] == 36){
                                   $link = $mn["link"];
                                }else{
                                    $link = base_url().$codebahasa.$mn["link"];
                                }
                            ?>
                            <li <?php if ($mn["submenu"] == 0){ ?><?php }else{ ?> class="dropdown" <?php  } ?> >
                            <a <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>/"<?php }else{ ?> href="<?=base_url().$codebahasa.$mn["link"]?>/" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><b class="caret"></b><?php } ?></a>
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
                
		    </nav>
		    <!-- Navigation -->

		</div>
	</header>
	<!-- Header -->

	
			