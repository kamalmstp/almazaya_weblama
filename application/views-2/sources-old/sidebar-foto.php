<div class="content-right">
            <div class="sidebanner" id="sidebanner">
            <div class="article-right" >
                <div class="ribbon-atas">ARTIKEL FAVORIT</div>
                
                <?php
                    foreach ($new_artikel as $dt){
                    ?>
                    
                    <div class="list-news-item">
                        <div class="image-list-news">
                            <?php
                            if ($dt["pic"] != ""){
                            ?>
                                <img src="<?=base_url('uploads/artikel/'.$dt["pic"])?>"  style="width: 120px;" />
                                <?php
                            }else{
                                ?>
                                <img src="<?=base_url('assets/frontend/images/new-noimage.png')?>" />
                                <?php
                            }
                            ?>
                        </div>
                        <div class="date-list-news"><?=$controller->hari($dt["tgl"])?>, <?=$dt["tglnya"]?> <?=$controller->bulan($dt["bln"])?> <?=$dt["thn"]?></div>
                        <div class="title-list-news">
                            <a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link_news"])?>"><?=$dt["title"]?></a>
                        </div>
                    </div>
                    
                    
                    <?php
                    }
                    ?>
            </div>
            <div class="sidebanner">
                    <!--<div class="banner-right">
                        <a href="<?=base_url('produk/strawberry-smoothie')?>"><img src="<?=base_url('assets/frontend/images/smoothies.png')?>" /></a>
                    </div>-->
                    <div class="banner-right">
                        <a href="javascript:;" class="show_video">
                        <img class="playvideo" style="position: absolute; left: 50%; margin-top: 63px; margin-left: -62px;" src="<?=base_url('assets/frontend/images/play.png')?>" />
                        <img class="video-image" src="<?=base_url('assets/frontend/images/videonya.png')?>" />
                        </a>
                        <div class="title_video">
                            <p>Nutrive Benecol - Cara Enak Turunkan Kolesterol</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>