<?php

if ($aksi == "detail"){
    if ($detail[0]["title"] == ""){
        header('Location: '.base_url());
    }
    $title = $detail[0]["title"];
    $description = substr($detail[0]["description"], 0, 100);
    $data["title"] = $detail[0]["title"];
    $data["description"] = $description;
}else{
    $title = "Artikel";
    $description = "Cara enak turunkan kolesterol";
    $data["title"] = $title;
    $data["description"] = $description;
}
?>
<?php $this->load->view('sources/header.php',$data)?>
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->
<div class="content-banner">
            <div class="image_banner">
            
            <?php
            if ($banner != ""){
            ?>
            <img src="<?=base_url("assets/images/pages/".$banner)?>" />
            <?php
            }else{
            ?>
            <img src="<?=base_url("assets/frontend/images/news-banner.jpg")?>" />
            <?php
            }
            ?>
                
            </div>
            <div class="title-banner"><?=$title_page?></div>
        </div>
        <div class="breadcrumb-row">
            <div class="breadcrumbs">
           
                <a href="<?=base_url()?>">Home</a><?=$parent_breadcrumb?><a href=""><?=$current_page?></a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="content-row">
        
            
                <?php
                    if ($aksi == "detail"){
                ?>
                <div class="content-left">
                <div class="detail_article">
                <h1 class="detail_artikel"><?=$detail[0]["title"]?></h1>
                <!--<script>
                    function fbShare(url, title, descr, image, winWidth, winHeight) {
                        var winTop = (screen.height / 2) - (winHeight / 2);
                        var winLeft = (screen.width / 2) - (winWidth / 2);
                        //window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
                        window.open('http://www.facebook.com/sharer.php?u=' + url, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
                    }
                    function tweet(url,text, winWidth, winHeight) {
                        var winTop = (screen.height / 2) - (winHeight / 2);
                        var winLeft = (screen.width / 2) - (winWidth / 2);
                        //window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
                        window.open('https://twitter.com/intent/tweet?url=' + url + '&text=' + text,'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
                    }
                </script>-->
                
                <?php
                if ($detail[0]["pic2"] != ""){
                ?>
                <div class="image_detail_news">
                    <img src="<?=base_url("uploads/artikel/".$detail[0]["pic2"])?>" />
                </div>
                <?php
                }
                ?>
                
                <div class="detail_description_article">
                    <?=$detail[0]["description"]?>
                </div>
                <!--<div class="detail_share_socmed">
                    <ul>
                        <li>
                            <a href="javascript:fbShare('<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>', '<?=$detail[0]["title"]?>', '<?=substr(strip_tags($detail[0]["description"]), 0, 100)?>', '<?=base_url("uploads/artikel/".$detail[0]["pic2"])?>', 520, 350)"><img src="<?=base_url("assets/frontend/images/share-fb.png")?>"></a>
                            
                        </li>
                        <li>
                            <a href="javascript:tweet('<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>','<?=$detail[0]["title"]?>', 520, 350)"><img src="<?=base_url("assets/frontend/images/share-tw.png")?>" /></a>
                        </li>
                    </ul>
                </div>-->
                <div class="page-prev-next">
                    <?php
                    if ($prev != ""){
                        if (count($prev) > 0){
                            //print_r($prev);
                            ?>
                            <a class="left-side" href="<?=base_url($codebahasa.$prev[0]["link_detail"].'/'.$prev[0]["link_news"])?>"><div class="prev-article"><img class="previmg" src="<?=base_url("assets/images/prev-article.png")?>"><div class="page-name">Sebelumnya</div><div class="title-page"><?=$prev[0]["title"]?></div></div></a>
                            <?php
                        }
                        
                    }
                    ?>
                <?php
                    if ($next != ""){
                        if (count($next) > 0){
                            
                            ?>
                            <a class="right-side" href="<?=base_url($codebahasa.$next[0]["link_detail"].'/'.$next[0]["link_news"])?>"><div class="next-article"><img class="nextimg" src="<?=base_url("assets/images/next-article.png")?>"><div class="page-name">Selanjutnya</div><div class="title-page"><?=$next[0]["title"]?></div></div></a>
                            <?php
                        }
                        
                    }
                    ?>
                    
                    
                </div>
                <!--<div class="fb-comments" data-href="<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>" data-numposts="5"></div>-->
                
                <div class="article">
                <ul class="list-article" style="margin-left: 0px !important;">
                        <?php
                        foreach ($rec_artikel as $dt){
                            $descriptionnya = strip_tags($dt["description"]);
                            if (strlen($descriptionnya) > 150){
                                $descriptionnya = substr($descriptionnya,0,150)."...";
                            }
                        ?>
                        <li>
                            <?php
                            if ($dt["pic"] != ""){
                                ?>
                                <div class="image-article"><img src="<?=base_url('uploads/artikel/'.$dt["pic"])?>" /></div>
                                <?php
                            }else{
                                ?>
                                <div class="image-article"><img src="<?=base_url('uploads/artikel/noimage.png')?>" /></div>
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
                    </div>
                </div>
                <?php
                }else{
                ?>
                <div class="content-full">
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
                            <div class="category"><?=$dt["title_cat"]?></div>
                            
                            <?php
                            if ($dt["pic"] != ""){
                                ?>
                                <div class="image-article"><img src="<?=base_url('uploads/artikel/'.$dt["pic"])?>" /></div>
                                <?php
                            }else{
                                ?>
                                <div class="image-article"><img src="<?=base_url('uploads/artikel/noimage.png')?>" /></div>
                                <?php
                            }
                            ?>
                            
                            <div class="title-list">
                                <h2 style="min-height: 46px;"><a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link_news"])?>"><?=$dt["title"]?></a></h2>
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
                <?php
                }
                ?>
                
            
        </div> 
        <?php
            if ($aksi == "detail"){
        ?>
        <?php $this->load->view('sources/sidebar.php')?>
        <?php
            }
        ?>
    </div>
    <div id="batas-sticky">&nbsp;</div> 
</div>

<script>
var awal = 6;
$(".loadmore a").click(function () {
    $('html, body').animate({
        scrollTop: $(".loadmore").offset().top
    }, 1000);
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getartikelbypage")?>",
        //data: { 'a': 1, 'b': 2, 'c': 3 },
        dataType: 'json',
        data: { 'lang': <?=$langnow?>, 'awalnya': awal, 'codebahasa': '<?=$codebahasa?>', 'sisterpage':<?=$sisterpage?>},
        beforeSend: function () {
            $(".loadmore a").html("<img src='<?=base_url("assets/frontend/images/loading_small.gif")?>'>");
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

$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        singleItem : true
    })
})
</script>
<?php $this->load->view('sources/footer.php')?>
