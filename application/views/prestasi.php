<?php $this->load->view('sources/header.php')?>

<div class="top_panel_title top_panel_style_1  title_present scheme_original">
				<div class="top_panel_title_inner top_panel_inner_style_1  title_present_inner">
					<div class="content_wrap">
						<h1 class="page_title"><?=$current_page?></h1> </div>
				</div>
			</div>
			<div class="page_content_wrap page_paddings_yes">
				<div class="content_wrap wrapper">
					<div class="content">
                    <?php
                     foreach ($rec as $dt){
                        ?>
                    
                        <?php
                        $descriptionnya = strip_tags($dt["description"]);
                        if (strlen($descriptionnya) > 200){
                            $descriptionnya = substr($descriptionnya,0,200)."...";
                        }
                        
                        ?>
                        <div class="post_item post_item_excerpt post_featured_left post_format_standard odd post-470 post type-post status-publish format-standard has-post-thumbnail hentry category-gallery tag-adoption tag-donation">
							<div class="post_featured">
								<div class="post_thumb" data-image="images/image-14.jpg" data-title="American Humane Association">
									<img src="<?=base_url("uploads/prestasi/".$dt["pic"])?>" alt="<?=$dt["title"]?>">	
								</div>
							</div>
							<div class="post_content clearfix">
								<h3><?=$dt["title"]?></h3>
								
								<div class="post_descr">
									<?=$dt["description"]?>
								</div>
							</div>
							<!-- /.post_content -->
						</div>
                    
                    <?php
                    }
                    ?>
    				<?php
                    if (isset($rec)){
                        echo $paging;
                    }
                    ?>
                    
					
					</div>
					<!-- </div> class="content"> -->
				</div>
				<!-- </div> class="content_wrap"> -->
			</div>
<?php $this->load->view('sources/footer.php')?>