<!DOCTYPE html>
<html lang="en-US" class="scheme_original">

<head>
	<title>Yayasan Al Umar Tirto Sudarmo</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />

	<link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700%7COpen+Sans:300,300i,400,400i,600,600i,700,700i,800,800i%7CRaleway:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext" rel="stylesheet">
	<link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/font-face/WCManoNegraBta/stylesheet.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/fontello/css/fontello.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/plugins/revslider/public/assets/css/settings.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/plugins/essential-grid/public/assets/css/settings.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/style.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/global.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/fw/css/core.animation.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/shortcodes/theme.shortcodes.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/plugin.tribe-events.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/plugin.donations.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/css/responsive.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/mediaelement/mediaelementplayer.min.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/plugins/trx_donations/trx_donations.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/fw/js/core.messages/core.messages.css")?>' type='text/css' media='all' />
    <link property="stylesheet" rel='stylesheet' href='<?=base_url("assets/js/vendor/fw/js/swiper/swiper.css")?>' type='text/css' media='all' />
    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/jquery.fancybox.min.css")?>">
</head>
<body>
	<a id="toc_home" class="sc_anchor" title="Home" data-description="&lt;i&gt;Return to Home&lt;/i&gt; - &lt;br&gt;navigate to home page of the site" data-icon="icon-home" data-url="http://charity-is-hope.themerex.net/" data-separator="yes"></a>
	<a id="toc_top" class="sc_anchor" title="To Top" data-description="&lt;i&gt;Back to top&lt;/i&gt; - &lt;br&gt;scroll to top of the page" data-icon="icon-double-up" data-url="" data-separator="yes"></a>
	<div class="body_wrap">
		<div class="page_wrap">
			<div class="top_panel_fixed_wrap"></div>
			<header class="top_panel_wrap top_panel_style_1 scheme_original">
				<div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_above">
					<div class="top_panel_middle">
						<div class="content_wrap">
							<div class="contact_logo">
								<div class="logo">
									<a href="<?=base_url()?>"><img src="<?=base_url("assets/images/logo.png")?>" class="logo_main" alt=""></a>
								</div>
							</div>
							<div class="contact_button">
								
							<div class="contact_socials">
								<div class="sc_socials sc_socials_type_icons sc_socials_shape_round sc_socials_size_tiny">
									<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_twitter"><span class="icon-twitter"></span></a></div>
									<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_facebook"><span class="icon-facebook"></span></a></div>
									
									<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_youtube"><span class="icon-youtube"></span></a></div>
									
								</div>
							</div>
						</div>
					</div>

					<div class="top_panel_bottom">
						<div class="content_wrap clearfix">
							<nav class="menu_main_nav_area menu_hover_fade">
								<ul id="menu_main" class="menu_main_nav">
									
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
                                        <a <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>/"<?php }else{ ?> href="#" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><b class="caret"></b><?php } ?></a>
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
							
						</div>
					</div>
				</div>
			</header>
			<div class="header_mobile">
				<div class="content_wrap">
					<div class="menu_button icon-menu"></div>
					<div class="logo">
						<a href="<?=base_url()?>"><img src="<?=base_url("assets/images/logo.png")?>" class="logo_main" alt=""></a>
					</div>
				</div>
			
            
            
            
            
            
            
            <div class="side_wrap">
					
					<div class="panel_top">
						<nav class="menu_main_nav_area">
							<ul id="menu_mobile" class="menu_main_nav">
								
                                
                                
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
                                        <li <?php if ($mn["submenu"] == 0){ ?><?php }else{ ?> class="menu-item menu-item-has-children" <?php  } ?> >
                                        <a <?php if ($mn["submenu"] == 0){ ?>href="<?=base_url().$codebahasa.$mn["link"]?>/"<?php }else{ ?> href="#" class="dropdown-toggle" data-toggle="dropdown"  <?php  } ?> class=""><?=$mn["title"]?> <?php if ($mn["submenu"] > 0){ ?><?php } ?></a>
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
					</div>
					<div class="contact_socials">
						<div class="sc_socials sc_socials_type_icons sc_socials_shape_square sc_socials_size_small">
							<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_twitter"><span class="icon-twitter"></span></a></div>
							<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_facebook"><span class="icon-facebook"></span></a></div>
							<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_vine"><span class="icon-vine"></span></a></div>
							<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_youtube"><span class="icon-youtube"></span></a></div>
							<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_pinterest-circled"><span class="icon-pinterest-circled"></span></a></div>
							<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_gplus"><span class="icon-gplus"></span></a></div>
						</div>
					</div>
				</div>
				<div class="mask"></div>
			</div>
            