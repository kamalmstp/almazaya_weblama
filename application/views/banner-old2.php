<?php $this->load->view('sources/header.php')?>

			<div class="slider_wrap slider_fullwide slider_engine_revo slider_alias_main">
				<div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
					<!-- START REVOLUTION SLIDER 5.2.5.4 fullwidth mode -->
					<div id="rev_slider_1_1" class="rev_slider fullwidthabanner" data-version="5.2.5.4">
						<ul>
							
                            
                            <?php
                            foreach ($rec_banner as $banner){
                                ?>
                                <li>
    								<img src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="" >
    								<div class="tp-caption TRX-title-white   tp-resizeme" id="slide-2-layer-2" data-x="center" data-hoffset="0" data-y="210" data-responsive_offset="on"><?=$banner["title"]?></div>
                                   
    							</li>
                                <?php
                            }
                            ?>
                            
                            
							
                            
						</ul>
						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!-- END REVOLUTION SLIDER -->
			</div>
			<div class="page_content_wrap page_paddings_no">
				<div class="content_wrap">
					<div class="content">
						<div class="itemscope post_item post_item_single post_featured_default post_format_standard post-2 page type-page status-publish hentry" itemscope itemtype="http://schema.org/Article">
							<div class="post_content" itemprop="articleBody">
								<div class="block_1473435558335">
									<div class="column_container">
										<div class="column-inner">
											<div class="wrapper">
												<div id="sc_services_1443866382_wrap" class="sc_services_wrap">
													<div id="sc_services_1443866382" class="sc_services sc_services_style_services-1 sc_services_type_images  margin_top_huge margin_bottom_huge">
														<h2 class="sc_services_title sc_item_title sc_item_title_without_descr"><?=$profile[0]["title"]?></h2>
                                                        
                                                        <?php
                                                        if ($profile[0]["pic"] != ""){
                                                            ?>
                                                            <img style="width: 100%;" class="animate fadeInRight" data-wow-delay="0.4s" src="<?=base_url("uploads/content/".$profile[0]["pic"])?>" alt="about-sec-img2">
                                                            <?php
                                                        }
                                                        ?>
														<div class="sc_services_descr sc_item_descr"><?=strip_tags($profile[0]["description"])?></div>
														
                                                        <?php
                                                        if ($profile[0]["link"] != ""){
                                                            ?>
                                                            <div class="sc_services_button sc_item_button"><a href="<?=$profile[0]["link"]?>" class="sc_button sc_button_square sc_button_style_filled sc_button_size_large  sc_button_iconed icon-arrow">Selengkapnya</a></div>
                                                            <?php
                                                        }
                                                        ?>
														
													</div>
													<!-- /.sc_services -->
												</div>
												<!-- /.sc_services_wrap -->
												<div class="h10"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="block">
									<div class="column_container">
										<div class="column-inner">
											<div class="wrapper">
												<div class="h55"></div>
												<div id="sc_donations_108588160" class="sc_donations sc_donations_style_excerpt">
                                                    
													<h2 class="sc_donations_title sc_item_title">Artikel</h2>
													<div class="sc_donations_columns_wrap">
                                                    
                                                    
                                                    <?php
                                                    foreach($aktifitas as $ak){
                                                        $descriptionnya = strip_tags($ak["description"]);
                                                        if (strlen($descriptionnya) > 200){
                                                            $descriptionnya = substr($descriptionnya,0,200)."...";
                                                        }
                                                        ?>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <div class="post_item_excerpt post_type_donation sc_donations_column-1_3">
															<div class="post_featured">
																<a href="<?=base_url($codebahasa.$ak["link_pages"].'/'.$ak["link"])?>"><img src="<?=base_url("uploads/aktifitas/".$ak["pic"])?>" alt="<?=$ak["title"]?>"></a>
															</div>
															<!-- .post_featured -->
															<div class="post_body">
																<div class="post_header entry-header">
																	<h4 class="entry-title"><a href="<?=base_url($codebahasa.$ak["link_pages"].'/'.$ak["link"])?>" rel="bookmark"><?=$ak["title"]?></a></h4>
																</div>
																<!-- .entry-header -->
																<div class="post_content entry-content">
																	<p><?=$descriptionnya?></p>
																
																	<a class="more-link" href="<?=base_url($codebahasa.$ak["link_pages"].'/'.$ak["link"])?>" rel="bookmark">Selengkapnya &gt;</a> </div>
																<!-- .entry-content -->
															</div>
															<!-- .post_body -->
														</div>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    
                                                    
														
														
													
													</div>
												</div>
												<!-- /.sc_donations -->
												<div class="h28"></div>
											</div>
										</div>
									</div>
								</div>
								
								
								
								
								
								<div class="block">
									<div class="column_container">
										<div class="column-inner">
											<div class="wrapper">
												<h2 class="sc_title sc_title_regular sc_align_center margin_top_huge margin_bottom_medium">Galeri</h2>
												<div class="h07"></div>
												<div id="sc_blogger_54178882" class="sc_blogger layout_classic_2 template_masonry margin_bottom_huge  sc_blogger_horizontal">
												    <ul class="gallery-list">
                                                    <?php
                                                    foreach ($gallery as $gl){
                                                        ?>
                                                        <li>
                                                            <img src="<?=base_url("uploads/infographic/resize/".$gl["pic"])?>" alt="<?=$gl["title"]?>">
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                    </ul>
                                                    
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<!-- </div> class="post_content" itemprop="articleBody"> -->
						</div>
						<!-- </div> class="itemscope post_item post_item_single post_featured_default post_format_standard post-2 page type-page status-publish hentry" itemscope itemtype="http://schema.org/Article"> -->
					</div>
					<!-- </div> class="content"> -->
				</div>
				<!-- </div> class="content_wrap"> -->
			</div>
			<!-- </.page_content_wrap> -->
<?php $this->load->view('sources/footer.php')?>