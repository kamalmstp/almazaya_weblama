<?php $this->load->view('sources/header.php')?>



<section id="about" class="news">
      <div class="container">
        
        <div class="row">
          <div class="col-sm-6 left"><h2 ><img src="<?=base_url("assets/img/news-icon.png")?>" /> NEWS</h2></div>
          <div class="col-sm-6 right">
            <ul class="submenu-post">
            
                <?php if ($link_page == $allpage_link)
                {
                ?>
                    <li><a class="active" href="<?=base_url($codebahasa.$allpage_link)?>/">All</a></li>
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
                        <div class="col-sm-4 list_post">
							<div class="post_featured">
								<div class="post_thumb" data-image="<?=base_url("uploads/artikel/thumb_".$dt["pic"])?>" data-title="<?=$dt["title"]?>">
									<a class="hover_icon hover_icon_link" href="<?=base_url($codebahasa.$dt["link_pages"].'/'.$dt["link"])?>/"><img src="<?=base_url("uploads/artikel/thumb_".$dt["pic"])?>" alt="<?=$dt["title"]?>"></a>
								</div>
							</div>
                            <div class="post_event">
								<?=$dt["cat"]?>
							</div>
							<div class="post_content">
								<h3 class="post_title"><a href="<?=base_url($codebahasa.$dt["link_pages"].'/'.$dt["link"])?>"><?=$titlenya?></a></h3>
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