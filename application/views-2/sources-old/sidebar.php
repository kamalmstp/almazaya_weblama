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
                        <img src="<?=base_url('assets/frontend/images/banner-right1.png')?>" />
                    </div>-->
                    <?php
                foreach ($sidebar as $datasidebar){
                    if ($datasidebar["tipe"] == 2){
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $datasidebar["link"], $match)) {
                            $video_id = $match[1];
                        }
                    ?>
                        <?php
                        if ($datasidebar["target"] == 3){
                        ?>
                            <div class="banner-right">
                                <a href="javascript:;" class="show_video" data-id="<?=$video_id?>">
                                <img class="playvideo" style="position: absolute; left: 50%; margin-top: 63px; margin-left: -62px;" src="<?=base_url('assets/frontend/images/play.png')?>" />
                                <img class="video-image" src="<?=base_url('assets/images/sidebar/'.$datasidebar["pic"])?>" />
                                </a>
                                <div class="title_video">
                                    <p><?=$datasidebar["title"]?></p>
                                </div>
                            </div>
                        <?php
                        }elseif ($datasidebar["target"] == 2){
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $datasidebar["link"], $match)) {
                                $video_id = $match[1];
                            }
                            ?>
                            <script>
                            function myFunction() {
                                var w = 400;
                                var h = 400;
                                var left = (screen.width/2)-(w/2);
                                var top = (screen.height/2)-(h/2);
                                window.open("https://www.youtube.com/embed/<?=$video_id?>?autoplay=1", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top="+top+",left="+left+",width=400,height=400");
                            }
                            </script>
                            <div class="banner-right">
                                <a onclick="myFunction()" class="show_video1">
                                <img class="playvideo" style="position: absolute; left: 50%; margin-top: 63px; margin-left: -62px;" src="<?=base_url('assets/frontend/images/play.png')?>" />
                                <img class="video-image" src="<?=base_url('assets/images/sidebar/'.$datasidebar["pic"])?>" />
                                </a>
                                <div class="title_video">
                                    <p><?=$datasidebar["title"]?></p>
                                </div>
                            </div>
                            <?php                            
                        }elseif ($datasidebar["target"] == 1){
                            
                            ?>
                            
                            <div class="banner-right">
                                <a target="_blank" href="https://www.youtube.com/embed/<?=$video_id?>?autoplay=1" class="show_video1">
                                <img class="playvideo" style="position: absolute; left: 50%; margin-top: 63px; margin-left: -62px;" src="<?=base_url('assets/frontend/images/play.png')?>" />
                                <img class="video-image" src="<?=base_url('assets/images/sidebar/'.$datasidebar["pic"])?>" />
                                </a>
                                <div class="title_video">
                                    <p><?=$datasidebar["title"]?></p>
                                </div>
                            </div>
                            <?php                            
                        }
                        ?>
                    <?php
                    }else{
                        ?>
                         <?php
                        if ($datasidebar["target"] == 3){
                        ?>
                            <div class="banner-right">
                                <a href="javascript:;">
                                <img class="video-image" src="<?=base_url('assets/images/sidebar/'.$datasidebar["pic"])?>" />
                                </a>
                                <div class="title_video">
                                    <p><?=$datasidebar["title"]?></p>
                                </div>
                            </div>
                        <?php
                        }elseif ($datasidebar["target"] == 2){
                            ?>
                           <script>
                            function myFunction() {
                                var w = 400;
                                var h = 400;
                                var left = (screen.width/2)-(w/2);
                                var top = (screen.height/2)-(h/2);
                                window.open("<?=$datasidebar["link"]?>", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top="+top+",left="+left+",width=400,height=400");
                            }
                            </script>
                            <div class="banner-right">
                                <a onclick="myFunction()">
                                <img class="video-image" src="<?=base_url('assets/images/sidebar/'.$datasidebar["pic"])?>" />
                                </a>
                                <div class="title_video">
                                    <p><?=$datasidebar["title"]?></p>
                                </div>
                            </div>
                            <?php                            
                        }elseif ($datasidebar["target"] == 1){
                            ?>
                            <div class="banner-right">
                                <a target="_blank" href="<?=$datasidebar["link"]?>" class="show_video1">
                                <img class="video-image" src="<?=base_url('assets/images/sidebar/'.$datasidebar["pic"])?>" />
                                </a>
                                <div class="title_video">
                                    <p><?=$datasidebar["title"]?></p>
                                </div>
                            </div>
                            <?php                            
                        }
                        ?>
                        <?php
                    }
                }
                ?>
                </div>
            </div>
        </div>