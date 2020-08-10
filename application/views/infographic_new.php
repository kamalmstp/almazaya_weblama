<?php $this->load->view('sources/header.php')?>



<section id="about" class="news">
      <div class="container">
        
        <div class="row">
          <div class="col-sm-6 left"><h2 ><img src="<?=base_url("assets/img/news-icon.png")?>" /> Gallery</h2></div>
          <div class="col-sm-6 right">
            <ul class="submenu-post">
            
                <?php if ($link_page == $allpage_link)
                {
                ?>
                    <li><a class="active" href="<?=base_url($codebahasa.$allpage_link)?>">All</a></li>
                <?php
                }else{
                    ?>
                    <li><a href="<?=base_url($codebahasa.$allpage_link)?>">All</a></li>
                    <?php
                }
                ?>
                <?php
                foreach($subnews as $sn){
                    if ($current_page_id == $sn->id){
                        ?>
                        <li><a class="active" href="<?=base_url($codebahasa.$sn->link)?>"><?=$sn->title?></a></li>
                        <?php
                    }else{
                        ?>
                        <li><a href="<?=base_url($codebahasa.$sn->link)?>"><?=$sn->title?></a></li>
                        <?php
                    }
                    ?>
                    
                    <?php
                }
                ?>
                
            </ul>
          </div>
          
        </div>
        <div class="row postfeature">
        
        <?php
                        foreach ($rec as $dt){
                    ?>
                    
                        <?php
                        $titlenya = strip_tags($dt["title"]);
                        if (strlen($titlenya) > 30){
                            $titlenya = substr($titlenya,0,30)."...";
                        }
                        
                        ?>
                        <div class="col-sm-3 list_post">
							<div class="post_featured">
								<div class="post_thumb" data-image="<?=base_url("uploads/infographic/thumb_".$dt["pic"])?>" data-title="<?=$dt["title"]?>">
									<a data-fancybox="images" data-caption="<?=$dt["title"]?>" class="hover_icon hover_icon_link" href="<?=base_url("uploads/infographic/".$dt["pic"])?>"   rel="magnific"><img src="<?=base_url("uploads/infographic/resize/".$dt["pic"])?>" alt="<?=$dt["title"]?>"></a>
								</div>
							</div>
                            
						</div>
                    
                    <?php
                    }
                    ?>
    				
        </div>
        <div class="row">
            <div class="col-sm-12">
            <?php
            if (isset($rec)){
                echo $paging;
            }
            ?>
            </div>
        </div>
      </div>
    </section>
    
<?php $this->load->view('sources/footer.php')?>