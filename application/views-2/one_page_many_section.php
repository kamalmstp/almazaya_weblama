<?php $this->load->view('sources/header.php')?>



    
        


<div id="staticImg">
		<div class="imgsContainer">
			
		</div>
	</div>

	
	<?php foreach ($one_page as $dt){ ?>
        <?php
            if ($dt["tipe_section"] == 1){
        ?>
        
                                
        <section class="section container-fluid" id="section1">
    		<div class="row">
                <div class="owl-carousel main-carousel">
    				
                    <?php
                    
                    $data_banner = $controller->getbanner($dt["page_source"]);
                    $no = 1;
                    foreach ($data_banner as $banner){
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
                                    <div class="moreinfo"><a target="_blank" href="<?=$banner["link"]?>">See More</a></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
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
            if ($dt["tipe_section"] == 5){
        ?>
        <section id="produly_papua" class="whyred section" style="background-image:url(<?=base_url("uploads/section/".$dt["background"])?>); background-size: cover;background-position: left center">
            <div class="container">
               
                <div class="row">
                    <div class="col-xs-6 text-sec">
                        <div class="section-text-new">
                            <h3 style="display: none;"><?=$dt["title"]?></h3>
                            <?=$dt["description"]?>
                        </div>
                    </div>
                   
                </div>
            </div>
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
        </section>
    <?php
        }
        ?>
        
        
        <?php
            if ($dt["tipe_section"] == 8){
        ?>
        
        <section class="comparation section" style="background-image:url('<?=base_url()?>/uploads/section/1background_20160825064601_whybuahmerah.png'); background-size: cover;background-position: left center">
            <div class="container">
                <h2>-  <?=$dt["title"]?>  -</h2>
                    <div class="hi-icon-wrap hi-icon-effect-8">
                    <ul class="animatedwhyred">
                        <?php
                        foreach ($orac as $dt){
                        ?>
                        <li>
                            <div class="desc-an" style="display: none;">
                                <span class="topdesc"><?=$dt["title"]?></span>
                                    <img src="<?=base_url("assets/img/dotted.png")?>" />
                                <span class="bottomdesc"><?=$dt["orac"]?></span>
                            </div>
                            <a href="#set-8" class="hi-icon"><img src="<?=base_url("uploads/graphic_orac/".$dt["pic"])?>" /></a>
                        </li>
                        
                        <?php
                        }
                        ?>
                        
                    </ul>
                       
				</div>
                
            </div>
        </section>
        
        <?php
        }
        ?>
        
        
        <?php
            if ($dt["tipe_section"] == 6){
        ?>
        
        <section class="why_red_fruit section" style="background-image: url('<?=base_url("uploads/section/".$dt["background"])?>'); background-size: cover; background-position: left center;">
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
        
        <section class="section" id="news">
        <div class="container news-container"  style="overflow: hidden;">
            <div class="row">
                
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>- <?=$dt["title"]?> -</h2>
                </div>
                <?php
                foreach ($artikel as $article){
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
                            
                            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor</p>
                        </div>
                    </div>
                    <?php
                    }                                        
                ?>              
                
            </div>
            <div class="row">
                <div class="loadmorenews">
                    <a href="<?=base_url($codebahasa.'articles')?>">See More..</a>
                </div>
            </div>
        </div>
    </section>
        <?php
        }
        ?>
        <?php
            if ($dt["tipe_section"] == 9){
        ?>
        
        <section class="comparation video section" style="background-image:url(<?=base_url("uploads/section/".$dt["background"])?>); background-size: cover;background-position: left center">
	       <div class="container" style="text-align: center; position: relative;">
           <div class="row">
            <h2 style="position: absolute; width: 100%; text-align: center;"><?=$dt["title"]?></h2>
            </div>
                <div class="row">
                    <div class="col-xs-12 text-sec" style="text-align: center">
                        <div class="section-text-new">
                            <?php
                                if ($dt["link_youtube"] != ""){
                                    
                                    preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#", $dt["link_youtube"], $matches);
                                }
                            ?>
                            <?php
                            if (isset($matches)){
                            if(count($matches) > 0){
                                ?>
                                <a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="https://www.youtube.com/embed/<?=$matches[0][0]?>"><img src="<?=base_url("assets/img/video-play.png")?>" /></a>
                                <?php
                            }
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
            if ($dt["tipe_section"] == 8){
        ?>
        
        <section class="comparation section" style="background-image:url('http://brightstars.co.id/eternaleaf/uploads/section/1background_20160825064601_whybuahmerah.png'); background-size: cover;background-position: left center">
            <div class="container">
                <h2>-  <?=$dt["title"]?>  -</h2>
                    <div class="hi-icon-wrap hi-icon-effect-8">
                    <ul class="animatedwhyred">
                        <?php
                        foreach ($orac as $dt){
                        ?>
                        <li>
                            <div class="desc-an" style="display: none;">
                                <span class="topdesc"><?=$dt["title"]?></span>
                                    <img src="<?=base_url("assets/img/dotted.png")?>" />
                                <span class="bottomdesc"><?=$dt["orac"]?></span>
                            </div>
                            <a href="#set-8" class="hi-icon"><img src="<?=base_url("uploads/graphic_orac/".$dt["pic"])?>" /></a>
                        </li>
                        
                        <?php
                        }
                        ?>
                        
                    </ul>
                       
				</div>
                
            </div>
        </section>
        
        <?php
        }
        ?>
    <?php } ?>
     
	

<?php $this->load->view('sources/footer.php')?>