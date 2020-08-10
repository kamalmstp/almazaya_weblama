

<?php
$title = "Nutrive Benecol";
$description = "Cara enak turunkan kolesterol";
$data["title"] = $title;
$data["description"] = $description;
?>
<?php $this->load->view('sources/header.php',$data)?>

    <div class="slide-banner">
    </div>
    <div class="staging">
            <ul class="stage">
                <li><a href="http://nutrivebenecol.com/indonesiatangkalkolesterol/video.html?type=2" target="_blank"><img src="<?=base_url('assets/frontend/images/Senam.png')?>" alt="Mirror Edge"></a></li>
                <li><a href="http://nutrivebenecol.com/indonesiatangkalkolesterol/video.html" target="_blank"><img src="<?=base_url('assets/frontend/images/resep.png')?>" alt="Mirror Edge"></a></li>
                <li><a target="_blank" href="<?=base_url('cekrisikojantung')?>"><img src="<?=base_url('assets/frontend/images/cekjantung.png')?>" alt="Mirror Edge"></a></li>
                <li><a target="_blank" href="http://nutrivebenecol.com/indonesiatangkalkolesterol/"><img src="<?=base_url('assets/frontend/images/tangkalkolesterol.png')?>" alt="Mirror Edge"></a></li>
            </ul>
        </div>
</div>
<div class="content" id="content">
    <div class="content-row">
        <div class="content-left">
            <div class="article">
                <ul class="list-article">
                    <?php
                    foreach ($rec_artikel as $dt){
                        $descriptionnya = strip_tags($dt["description"]);
                        if (strlen($descriptionnya) > 150){
                            $descriptionnya = substr($descriptionnya,0,150)."...";
                        }
                    ?>
                    <li>
                        <?php
                            $str = $dt["title"];
                            if (strlen($dt["title"]) > 60){
                                $str = wordwrap($dt["title"], 60);
                                $str = explode("\n", $str);
                                $str = $str[0] . '...';
                            }
                            
                        ?>
                        <div class="category"><?=$dt["title_cat"]?></div>
                        
                        <?php
                        if ($dt["pic"] != ""){
                            ?>
                            <div class="image-article"><a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link_news"])?>"><img src="<?=base_url('uploads/artikel/'.$dt["pic"])?>" /></a></div>
                            <?php
                        }else{
                            ?>
                            <div class="image-article"><a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link_news"])?>"><img src="<?=base_url('uploads/artikel/noimage.png')?>" /></a></div>
                            <?php
                        }
                        ?>
                        
                        <div class="title-list">
                            <h2><a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link_news"])?>"><?=$dt["title"]?></a></h2>
                        </div>
                        <div class="description-list">
                            <?=$descriptionnya?>
                        </div>
                        <div class="selengkapnya-list"><a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link_news"])?>">Selengkapnya &raquo;</a></div>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
                <?php
                if ($total_artikel > 4){
                ?>
                <div class="loadmore"><a href="javascript:;">Klik untuk artikel selanjutnya</a></div>
                <?php
                }
                ?>
                
            </div>
        </div> 
        <div class="content-right" id="content-right">
            <div class="sidebanner" id="sidebanner">
               
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
                
                <div class="banner-right newsletter">
                    
                    <form class="subscribe-form" method="POST">
                        <p class="notif-subscribe" style="display: none;">Thanks for subscribe</p>
                        <p><input type="text" class="subscribe-widget" name="email" placeholder="Your Email..." /></p>
                        <p><input type="submit" class="subscribe_submit" name="submit" value="Subscribe" /></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="batas-sticky">&nbsp;</div>
</div>
<div id="lhc_status_container">
<a  target="_blank"  href="<?=base_url("livechat")?>" onclick="return popup(this, 'Nutrive Benecol')">
<img src="http://nutrivebenecol.com/assets/images/livechat.png">
</a>
</div>
<style>
#lhc_status_container * {
    box-sizing: content-box;
    direction: ltr;
    font-family: arial;
    font-size: 12px;
    margin: 0;
    padding: 0;
    text-align: left;
}
#lhc_status_container .status-icon {
    color: #000;
    display: block;
    font-size: 12px;
    font-weight: bold;
    padding: 10px 35px 10px 9px;
    text-decoration: none;
}
#lhc_status_container:hover {
    right: -55px;
    transition: all 0.2s ease 0s;
}
#lhc_status_container {
    
    right: -68px;
    position: fixed;
    top: 150px;
    transition: all 0.2s ease 0s;
    width: 190px;
    z-index: 9989;
}
</style>
<script>
var awal = 4;
$(".loadmore a").click(function () {
    
    
    $('html, body').animate({
        scrollTop: $(".loadmore").offset().top
    }, 1000);
    
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getartikelall")?>",
        //data: { 'a': 1, 'b': 2, 'c': 3 },
        dataType: 'json',
        data: { 'lang': <?=$langnow?>, 'awalnya': awal, 'codebahasa': '<?=$codebahasa?>'},
        beforeSend: function () {
            $(".loadmore a").html("<img src='<?=base_url('assets/frontend/images/loading_small.gif')?>'>");
        },
        complete: function () {
            <?php
            if ($codebahasa == ""){
            ?>
            $(".loadmore a").html("Klik untuk artikel selanjutnya");
            <?php
            }else{
            ?>
            $(".loadmore a").html("Click for load other articles");
            <?php
            }
            ?>
        },
        success: function (data) {
            $(".list-article").append(data.result);
            if (data.total_count_next == 0){
                $(".loadmore a").hide();
            }
            awal += 4;
        }
    });
});
$(window).load(function(){
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getbanner")?>",
        
        dataType: 'html',
        data: { 'lang': <?=$langnow?>, 'codebahasa': '<?=$codebahasa?>'},
        
        complete: function () {
          
        },
        success: function (data) {
            $(".slide-banner").html(data);
            $("#owl-demo").owlCarousel({
              autoPlay: 25000,
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true
        
              // "singleItem:true" is a shortcut for:
              // items : 1, 
              // itemsDesktop : false,
              // itemsDesktopSmall : false,
              // itemsTablet: false,
              // itemsMobile : false
        
              });
        }
    });
});
$(document).ready(function(){
    
    $(".subscribe-form").submit(function(){
        $(".subscribe_submit").val("Loading...");
        $.ajax({
            type: "POST",
            url: "<?=base_url("ajax/subscribe")?>",
            //data: { 'a': 1, 'b': 2, 'c': 3 },
            dataType: 'json',
            data: { 'email': $(".subscribe-widget").val()},
            beforeSend: function () {
                $(".subscribe_submit").val("Loading...");
            },
            complete: function () {
                
            },
            success: function (data) {
                if (data > 0){
                    $(".notif-subscribe").show();
                    $(".subscribe_submit").val("Subscribe");
                }
                if (data == -1){
                    $(".notif-subscribe").show();
                    $(".notif-subscribe").html("Email has been saved successfully");
                    $(".subscribe_submit").val("Subscribe");
                }
                if (data == 0){
                    $(".notif-subscribe").show();
                    $(".notif-subscribe").html("Email is required");
                    $(".subscribe_submit").val("Subscribe");
                }
                awal += 4;
            }
        });
        return false;
    });
});
var doit;
function resizedw(){
    var widthnya = $( window ).width();
    if (widthnya <= 640 && $("#owl-demo-m").length == 0){
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getbanner_m")?>",
        
        dataType: 'html',
        data: { 'lang': <?=$langnow?>, 'codebahasa': '<?=$codebahasa?>'},
        
        complete: function () {
          
        },
        success: function (data) {
            $(".slide-banner").html(data);
            $("#owl-demo-m").owlCarousel({
              autoPlay: 25000,
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true
        
              // "singleItem:true" is a shortcut for:
              // items : 1, 
              // itemsDesktop : false,
              // itemsDesktopSmall : false,
              // itemsTablet: false,
              // itemsMobile : false
        
              });
        }
    });
    }
    
    if (widthnya > 640 && $("#owl-demo").length == 0){
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getbanner")?>",
        
        dataType: 'html',
        data: { 'lang': <?=$langnow?>, 'codebahasa': '<?=$codebahasa?>'},
        
        complete: function () {
          
        },
        success: function (data) {
            $(".slide-banner").html(data);
            $("#owl-demo").owlCarousel({
              autoPlay: 25000,
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true
        
              // "singleItem:true" is a shortcut for:
              // items : 1, 
              // itemsDesktop : false,
              // itemsDesktopSmall : false,
              // itemsTablet: false,
              // itemsMobile : false
        
              });
        }
    });
    }
}
window.onresize = function() {
    clearTimeout(doit);
    doit = setTimeout(function() {
        resizedw();
    }, 100);
};


</script>
<script type="text/javascript">
    function popup(mylink, windowname) {
        if (!window.focus) return true;
        var href;
        if (typeof (mylink) == 'string')
            href = mylink;
        else
            href = mylink.href;
        window.open(href, windowname, 'width=400,height=550,scrollbars=yes');
        return false;
    }
</script>
<?php $this->load->view('sources/footer.php')?>