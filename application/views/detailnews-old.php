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
                                                <?php
                                                if ($detail[0]["pic"] != ""){
                                                ?>
                                                <img src="<?=base_url("uploads/aktifitas/".$detail[0]["pic"])?>" style="width: 100%;" />
                                                <?php
                                                }
                                                ?>
                                                <h1 class="post_title entry-title"><?=$detail[0]["title"]?></h1>
                                                <div class="post_info">
                                                <span class="post_info_item post_info_posted">
                                                <a class="post_info_date date updated" href="#" itemprop="datePublished" content="2016-09-12 14:20:49"><?=$detail[0]["datenya"]?></a>
                                                </span>
                                                </div>
                                                <?=$detail[0]["description"]?>
												<div class="h30"></div>
                                                <a href="<?=base_url($codebahasa.$detail[0]["link_pages"])?>/" class="sc_button sc_button_square sc_button_style_filled sc_button_size_small">&lt; Kembali ke Aktifitas</a>
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
            p, ul, ol, dl, blockquote, address {
                margin-bottom: 0.5em;
            }
            h1{
                font-size:2em;
            }
            </style>
<?php $this->load->view('sources/footer.php')?>