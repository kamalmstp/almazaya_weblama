<?php $this->load->view('sources/header.php')?>
    <header>
        <div id="owl-demo" class="owl-carousel owl-theme">
            <?php
            foreach ($rec_banner as $banner){
                ?>
                    <?php
                        if ($banner["link"] != ""){
                            ?>
                            <div class="item"><a href="<?=$banner["link"]?>"><img src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="<?=$banner["title"]?>"></a></div>
                            <?php
                        }else{
                            ?>
                            <div class="item"><img src="<?=base_url("uploads/banner/".$banner["pic"])?>" alt="<?=$banner["title"]?>"></div>
                            <?php
                        }
                    ?>
                <?php
            }
            ?>
        </div>
    </header>
    <section id="segmentasi" class="segmentasi">
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
                <ul class="segmentasi-list">
                    <?php
                        foreach ($level as $lv){
                            ?>
                            <li >
                            <a data-id="<?=$lv["title"]?>" href="javascript:;" rel="<?=$lv["id"]?>">
                                <div class="imageicon">                  
                                    <img src="<?=base_url("uploads/level/".$lv["pic2"])?>" />
                                </div>       
                                <div class="titlesegments">  
                                    <?=$lv["title"]?> 
                                </div>
                            </a>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
                <?php
                foreach ($level as $lv2){
                    ?>
                    <div class="segment1 class-<?=$lv2["id"]?>">
                        <div class="header_segment">
                            <?=$lv2["subtitle"]?>
                        </div>
                        <div class="desc_header">
                            <?=$lv2["description"]?> 
                        </div>
                        <div class="curricullum">
                        <div class="header">Curricullum</div>
                        <div class="desc_curr">
                            <?=$lv2["content_curricullum"]?>
                        </div>
                        <div class="image">
                            <img src="<?=base_url("uploads/level/".$lv2["pic"])?>" />
                        </div>
                        <div class="subject_area"><?=$lv2["title"]?> Superior Program</div>
                        <div class="list_curricullum">
                             <div class="panel-group" id="accordion">
                             <?php
                             $curricullumnya = $controller->get_curricullum($lv2["id"]);
                             ?>
                             <?php
                                $no = 0;
                                foreach ($curricullumnya as $sp){
                                ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapses<?=$no?>">
                                            <?=$sp["title"]?></a>
                                          </h4>
                                        </div>
                                        <div id="collapses<?=$no?>" class="panel-collapse collapse in">
                                          <div class="panel-body"><?=$sp["description"]?></div>
                                        </div>
                                      </div>
                                <?php
                                $no++;
                                }
                                ?>
                            </div> 
                        </div>
                    </div>
                    </div>
                    <?php
                }
                ?>
                <div class="segment1 secondary" style="display: none;">
                    <?php
                        if (count($seondary1) > 0){
                    ?>
                    <div class="header_segment">
                        <?=$seondary1[0]["title"]?>
                    </div>
                    <div class="desc_header">
                         <?=$seondary1[0]["description"]?> 
                    </div>
                    <?php
                    }
                    ?>
                    <div class="curricullum">
                        <?php
                        if (count($seondary_curricullum) > 0){
                        ?>
                        <div class="header"><?=$seondary_curricullum[0]["title"]?></div>
                        <div class="desc_curr">
                            <?=$seondary_curricullum[0]["description"]?>
                        </div>
                        <div class="image">
                            <img src="<?=base_url("uploads/content/".$seondary_curricullum[0]["pic"])?>" />
                        </div>
                        <?php
                        }
                        ?>
                        <div class="subject_area">Subject Area</div>
                        <div class="list_curricullum">
                             <div class="panel-group" id="accordion">
                             <?php
                                $no = 0;
                                foreach ($kurikulum_seondary as $sp){
                                ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                          <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapses<?=$no?>">
                                            <?=$sp["title"]?></a>
                                          </h4>
                                        </div>
                                        <div id="collapses<?=$no?>" class="panel-collapse collapse in">
                                          <div class="panel-body"><?=$sp["description"]?></div>
                                        </div>
                                      </div>
                                <?php
                                $no++;
                                }
                                ?>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section id="about">
      <div class="container">
        <h2 class="text-center"><img src="<?=base_url("assets/img/about-icon.png")?>" /> <?=$profile[0]["title"]?></h2>
        <div class="row">
          <div class="col-lg-12 ml-auto">
                      <?=$profile[0]["description"]?>
            </div>
        </div>
      </div>
    </section>
    <!-- About Section -->
    <section id="testimonial">
      <div class="container">
        <h2 class="text-center"><img src="<?=base_url("assets/img/icon-testimonial.png")?>" /> TESTIMONIAL</h2>
        <div class="row">
          <div class="col-lg-12 ml-auto">
                <div id="owl-demo-testi" class=" owl-theme">
                <?php
                foreach ($rec_testimonial as $testi){
                    ?>
                    <div class="item">
                        <?=$testi["testimonial"]?>
                        <div class="name"><?=$testi["name"]?></div>
                        <div class="as">( <?=$testi["sebagai"]?>)</div>
                    </div>
                    <?php
                }
                ?>
                </div>
          </div>
        </div>
      </div>
    </section>
    <!-- About Section -->
    <section id="news">
      <div class="container">
        <h2 class="text-center"><img src="<?=base_url("assets/img/news-icon.png")?>" /> NEWS</h2>
        <div class="row">
          <div class="col-lg-12 ml-auto">
                <div id="owl-demo-news" class=" owl-theme">
                    <?php
                    foreach ($rec_aktifitas as $ak){
                        ?>
                        <div class="item">
                            <div class="image-news">
                                <a href="<?=base_url($codebahasa.$ak["link_pages"]."/".$ak["link"])?>/"><img alt="<?=$ak["title"]?>" title="<?=$ak["title"]?>" src="<?=base_url("uploads/artikel/thumb_".$ak["pic"])?>" /></a>
                            </div>
                            <div class="category-list-news"><?=$ak["cat"]?></div>
                            <div class="title-list-news"><a href="<?=base_url($codebahasa.$ak["link_pages"]."/".$ak["link"])?>/" title="<?=$ak["title"]?>"><?=$ak["title"]?></a> </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="viewmore"><a href="<?=base_url("news")?>/"><img src="<?=base_url("assets/img/viewmore.png")?>" /></a></div>
          </div>
        </div>
      </div>
    </section>
    <section id="gallery">
      <div class="container">
        <h2 class="text-center"><img src="<?=base_url("assets/img/gallery-icon.png")?>" /> GALLERY</h2>
        <div class="row">
          <div class="col-lg-12 ml-auto">
                <div id="owl-demo-gallery" class=" owl-theme">
                    <?php
                    foreach ($rec_gallery as $gal){
                    ?>
                    <div class="item">
                        <div class="image-gallery">
                            <img src="<?=base_url("uploads/galeri/thumb_".$gal["pic"])?>" />
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="viewmore"><a href="<?=base_url("gallery")?>"><img src="<?=base_url("assets/img/viewmore.png")?>" /></a></div>
          </div>
        </div>
      </div>
    </section>
    <script>
        $(document).ready(function(){
            $("h4.panel-title a").click(function(e) {
                e.preventDefault();
            });
        })
    </script>
<?php $this->load->view('sources/footer.php')?>