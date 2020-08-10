<?php $this->load->view('sources/header.php')?>

<div class="page_content_wrap page_paddings_no">
				<div class="content_wrap">
					<div class="content">
						<div class="contact-us itemscope post_item post_item_single post_featured_default post_format_standard post-27 page type-page status-publish hentry" itemscope itemtype="http://schema.org/Article">
							<div class="post_content" itemprop="articleBody">
							
								<div class="columns_wrap">
									<div class="column_container">
										<div class="column-inner">
											<div class="wrapper">
                                                
                                                <h3><?=$current_page?></h3>
                                                
                                                <ul class="listgalery">
							
                            
                                                    <?php
                                                    foreach ($rec as $gl){
                                                        ?>
                                                        <li>
                                                            <a  href="<?=base_url("uploads/infographic/".$gl["pic"])?>" data-fancybox data-caption="<?=$gl["title"]?>">
                                                                <img src="<?=base_url("uploads/infographic/resize/".$gl["pic"])?>" alt="<?=$gl["title"]?>">
                                                            </a>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                    
                        							
                                                    
                        						</ul>
                                                <?php
                                                if (isset($rec)){
                                                    echo $paging;
                                                }
                                                ?>
												<div class="h30"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- </div> class="post_content" itemprop="articleBody"> -->
						</div>
						<!-- </div> class="itemscope post_item post_item_single post_featured_default post_format_standard post-27 page type-page status-publish hentry" itemscope itemtype="http://schema.org/Article"> -->
					</div>
					<!-- </div> class="content"> -->
				</div>
				<!-- </div> class="content_wrap"> -->
			</div>
            
            <style>
                h3{
                    text-align: center;
                }
                ul.listgalery li{
                    display: inline-table;
                    width:33%;
                }
                ul.listgalery li img{
                    width:100%;
                }
            </style>
<?php $this->load->view('sources/footer.php')?>