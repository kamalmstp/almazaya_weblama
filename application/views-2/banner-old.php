<?php $this->load->view('sources/header.php')?>



    
        


<div id="staticImg">
		<div class="imgsContainer">
			
		</div>
	</div>

	
	<?php foreach ($one_page as $dt){ ?>
        <?php
            if ($dt["tipe_section"] == 1){
        ?>
        
           <!--                     
        <section class="section container-fluid" id="section1">
    		<div class="row">
                <div class="owl-carousel main-carousel">
    				
                    <?php
                    
                    $data_banner = $controller->getbanner($dt["page_source"]);
                    $no = 1;
                    foreach ($data_banner as $banner){
                        ?>
                        
                        
                            <?php
                            if(trim($banner["title"]) != "" AND trim($banner["description"])){
                                ?>
                                <div class="item item<?=$no?>"  style="background-image:url(<?=base_url("uploads/banner/".$banner["pic"])?>);">
                                    <img class="item-img img-responsive" src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="">
                                        <div class="overlay">
                                            <div class="text-banner">
                                                <h3><?=$banner["title"]?></h3>
                                                <?=$banner["description"]?>
                                                <?php
                                                if ($banner["link"] != ""){
                                                ?>
                                                <div class="moreinfo"><a target="_blank" href="<?=$banner["link"]?>"><?=$this->lang->line('seemore_banner');?></a></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <?php
                                if ($banner["link"] != ""){
                                ?>
                                <a href="<?=$banner["link"]?>">
                                <?php
                                }
                                ?>
                                <div class="item item<?=$no?>"  style="background-image:url(<?=base_url("uploads/banner/".$banner["pic"])?>);">
                                    <img class="item-img img-responsive" src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="">
                                </div>
                                <?php
                                if ($banner["link"] != ""){
                                ?>
                                </a>
                                <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                            
                        
                        <?php
                        $no++;
                    }
                    ?>
                    
                    
                    
    			</div>
    		</div>
    	</section>
        -->
        
        <section class="section container-fluid" id="section1">
    		<div class="row">
                <div class="owl-carousel main-carousel">
    				
                    <?php
                    
                    $data_banner = $controller->getbanner($dt["page_source"]);
                    $no = 1;
                    foreach ($data_banner as $banner){
                        ?>
                        
                        
                            <?php
                            if(trim($banner["title"]) != "" AND trim($banner["description"])){
                                ?>
                                <div class="item item<?=$no?>"  style="background-image:url(<?=base_url("uploads/banner/".$banner["pic"])?>);">
                                    <img class="item-img img-responsive" src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="">
                                        <div class="overlay">
                                            <div class="text-banner">
                                                <h3><?=$banner["title"]?></h3>
                                                <?=$banner["description"]?>
                                                <?php
                                                if ($banner["link"] != ""){
                                                ?>
                                                <div class="moreinfo"><a target="_blank" href="<?=$banner["link"]?>"><?=$this->lang->line('seemore_banner');?></a></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                </div>
                                <?php
                            }else{
                                ?>
                                <?php
                                if ($banner["link"] != ""){
                                ?>
                                <a href="<?=$banner["link"]?>">
                                <?php
                                }
                                ?>
                                <div class="item item<?=$no?>"  style="background-image:url(<?=base_url("uploads/banner/".$banner["pic"])?>);">
                                    <img class="item-img img-responsive" src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="">
                                </div>
                                <?php
                                if ($banner["link"] != ""){
                                ?>
                                </a>
                                <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                            
                        
                        <?php
                        $no++;
                    }
                    ?>
                    
                    
                    
    			</div>
    		</div>
    	</section>
        
        
        <?php
        }
        ?>
        <?php
            if ($dt["tipe_section"] == 2){
        ?>
        <section id="proudly" class="section" style="background-image:url(<?=base_url("uploads/section/".$dt["background"])?>); background-size: cover;">
            <div class="container">
               
                <div class="row">
                    <div class="col-xs-6 text-sec">
                        <div class="section-text-new">
                            <h3><?=$dt["title"]?></h3>
                            <?=$dt["description"]?>
                            <?php
                            if ($dt["link"] != ""){
                                ?>
                                <div class="moreinfo">
                                    <a href="<?=$dt["link"]?>" target="_blank">More Info</a>
                                </div>
                                <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                    <div class="col-xs-6 image-sec">
                        <div class="image-section">
                            <?php
                                if ($dt["image"] != ""){
                                    ?>
                                    <img src="<?=base_url("uploads/section/".$dt["image"])?>" />
                                    <?php                                    
                                }else{
                            ?>
                            &nbsp;
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        ?>
        
        <?php
            if ($dt["tipe_section"] == 3){
        ?>
        <section class="section" id="buah_merah" style="background-image:url(<?=base_url("uploads/section/".$dt["background"])?>); background-size: cover;">
            <div class="container">
               
                <div class="row">
                    <div class="col-xs-5 image-sec">
                        <div class="image-section">
                            <?php
                            if ($dt["image"] != ""){
                                ?>
                                <img src="<?=base_url("uploads/section/".$dt["image"])?>" />
                                <?php                                    
                            }else{
                            ?>
                            &nbsp;
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>
                    <div class="col-xs-7 text-sec">
                        <div class="section-text-new">
                            <h3><?=$dt["title"]?></h3>
                            <?=$dt["description"]?>
                            <?php
                            if ($dt["link"] != ""){
                                ?>
                                <div class="moreinfo">
                                    <a href="<?=$dt["link"]?>" target="_blank">More Info</a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <?php
        }
        ?>
        
        
        
        
        
        <?php
            if ($dt["tipe_section"] == 6){
        ?>
        
        <section class="why_red_fruit section" style="background-image:url(<?=base_url("uploads/section/".$dt["background"])?>); background-size: cover;background-position: left center">
            <div class="container">
               
                <div class="row">
                    <?php
                    if ($dt["grid_right"] != ""){
                    ?>
                    <div class="<?=$dt["grid_right"]?> text-sec">
                    <?php
                    }else{
                        ?>
                        <div class="col-xs-7 text-sec">
                        <?php                        
                    }
                    ?>
                    
                        <div class="section-text-new">
                            <h3><?=$dt["title"]?></h3>
                            <?=$dt["description"]?>
                            
                        </div>
                    </div>
                    <?php
                    if ($dt["grid_right"] != ""){
                    ?>
                    <div class="<?=$dt["grid_right"]?> image-sec">
                    <?php
                    }else{
                        ?>
                        <div class="col-xs-5 image-sec">
                        <?php                        
                    }
                    ?>
                    
                        <div class="image-section">
                            <?php
                            if ($dt["image"] != ""){
                            ?>
                            <img src="<?=base_url("uploads/section/".$dt["image"])?>" />
                            <?php
                            }else{
                            ?>
                            &nbsp;
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        
        <?php
        }
        ?>
        
        
        <?php
            if ($dt["tipe_section"] == 7){
        ?>
        
        <section class="why_red_fruit section" style="background-image:url(<?=base_url("uploads/section/".$dt["background"])?>); background-size: cover;background-position: left center">
            <div class="container">
               
                <div class="row">
                    <?php
                    if ($dt["grid_right"] != ""){
                    ?>
                    <div class="<?=$dt["grid_left"]?> image-sec">
                    <?php
                    }else{
                        ?>
                        <div class="col-xs-6 image-sec">
                        <?php                        
                    }
                    ?>
                        <div class="image-section">
                            <?php
                            if ($dt["image"] != ""){
                            ?>
                            <img src="<?=base_url("uploads/section/".$dt["image"])?>" />
                            <?php
                            }
                            ?>
                            
                            
                        </div>
                    </div>
                    
                    <?php
                    if ($dt["grid_right"] != ""){
                    ?>
                    <div class="<?=$dt["grid_right"]?> text-sec">
                    <?php
                    }else{
                        ?>
                        <div class="col-xs-6 text-sec">
                        <?php                        
                    }
                    ?>
                        <div class="section-text-new">
                            <h3 ><?=$dt["title"]?></h3>
                            <?=$dt["description"]?>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </section>
        
        <?php
        }
        ?>
        <?php
            if ($dt["tipe_section"] == 4){
        ?>
        
        <section class="section homenews" id="news">
        <div class="container news-container"  style="overflow: hidden;">
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>- <?=$dt["title"]?> -</h2>
                </div>
                <?php
                foreach ($artikel as $article){
                   
                    $descriptionnya = strip_tags($article["description"]);
                    if (strlen($descriptionnya) > 100){
                        $descriptionnya = substr($descriptionnya,0,75)."...";
                        $descriptionnya = str_replace(array('<br/>', '&', '"'), ' ', $descriptionnya);
                    }
                    $titlenya = strip_tags($article["title"]);
                    if (strlen($titlenya) > 30){
                        $titlenya = substr($titlenya,0,30)."...";
                    }
                    ?>
                    <div class="col-sm-3 news-item">
                        <div class="list-news-item">
                            <div class="image-list-news">
                                <?php
                                if ($article["pic"] != ""){
                                ?>
                                    <a href="<?=base_url($codebahasa.$article["link_detail"].'/'.$article["link_news"])?>"><img alt="<?=$article["title"]?>" src="<?=base_url("uploads/artikel/".$article["pic"])?>" /></a>
                                    
                                <?php
                                }else{
                                ?>
                                    <a href="<?=base_url($codebahasa.$article["link_detail"].'/'.$article["link_news"])?>"><img src="<?=base_url("assets/img/no-image-news.png")?>" /></a>
                                <?php
                                }
                                ?>
                            </div>
                            <h3><a href="<?=base_url($codebahasa.$article["link_detail"].'/'.$article["link_news"])?>/" title="<?=$article["title"]?>"><?=$titlenya?></a></h3>
                            
                            <?=$descriptionnya?>
                        </div>
                    </div>
                    <?php
                    }                                        
                ?>              
                
            </div>
            <div class="row">
                <div class="loadmorenews">
                    <a href="<?=base_url($codebahasa.'articles')?>"><?=$this->lang->line('seemore');?>..</a>
                </div>
            </div>
        </div>
    </section>
        <?php
        }
        ?>
        
    <?php } ?>

	

<?php $this->load->view('sources/footer.php')?>