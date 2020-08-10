<?php
$data = array();
$data["description"] = "";
$data["codebahasa"] = "";
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
            
            
            <img src="<?=base_url("assets/frontend/images/news-banner.jpg")?>" />
            
                
            </div>
            <div class="title-banner">Search</div>
        </div>
        <div class="breadcrumb-row">
            <div class="breadcrumbs">
                <a href="<?=base_url()?>">Home</a> <a>Search</a>
                <?php
                if (isset($cat_title)){
                    $title = $cat_title;
                    if ($title == ""){
                        //header('Location: '.base_url());
                    }
                    $data["title"] = $title;
                
                ?>
                <a href=""><?=$cat_title?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="content-row">
        <div class="content-left">
            <div class="content-search">
                <?php
                foreach ($search_result as $dt){
                    $descriptionnya = strip_tags($dt["description"]);
                    if (strlen($descriptionnya) > 150){
                        $descriptionnya = substr($descriptionnya,0,150)."...";
                    }
                ?>
                    
                    <div class="list-news-search">
                        <div class="image-list-search">
                            <?php
                            if ($dt["pic"] != ""){
                            ?>
                                <a href="<?=base_url($bhs.$dt["link_detail"].'/'.$dt["link_news"])?>"><img src="<?=base_url('uploads/artikel/'.$dt["pic"])?>" /></a>
                                <?php
                            }else{
                                ?>
                                <a href="<?=base_url($bhs.$dt["link_detail"].'/'.$dt["link_news"])?>"><img src="<?=base_url('assets/frontend/images/new-noimage.png')?>" /></a>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="date-list-news"><?=$controller->hari($dt["tgl"])?>, <?=$dt["tglnya"]?> <?=$controller->bulan($dt["bln"])?> <?=$dt["thn"]?></div>
                        <div class="title-list-news">
                            <a href="<?=base_url($bhs.$dt["link_detail"].'/'.$dt["link_news"])?>"><?=$dt["title"]?></a>
                        </div>
                        <div class="title-list-news-desc">
                            <?=$descriptionnya?>
                        </div>
                    </div>
                <?php
                }
                ?>
                
            </div>
            <?php
                if ($count_search > 6){
                ?>
                <div class="loadmore"><a href="javascript:;">Klik untuk artikel selanjutnya</a></div>
                <?php
                }
                ?>
        </div> 
        <div class="content-right">
            <div class="sidebanner" id="sidebanner">
            <div class="article-right" >
                <div class="ribbon-atas">ARTIKEL TERBARU</div>
                
                <?php
                    foreach ($new_artikel as $dt){
                    ?>
                    
                    <div class="list-news-item">
                        <div class="image-list-news">
                            <?php
                            if ($dt["pic"] != ""){
                            ?>
                                <img src="<?=base_url('uploads/artikel/'.$dt["thumb"])?>" />
                                <?php
                            }else{
                                ?>
                                <img src="<?=base_url('assets/frontend/images/new-noimage.png')?>" />
                                <?php
                            }
                            ?>
                        </div>
                        <div class="date-list-news">Senin, 12 Februari 2016</div>
                        <div class="title-list-news">
                            <a href="<?=base_url($bhs.$dt["link_detail"].'/'.$dt["link_news"])?>"><?=$dt["title"]?></a>
                        </div>
                    </div>
                    
                    
                    <?php
                    }
                    ?>
            </div>
            <div class="sidebanner">
                    <div class="banner-right">
                        <img src="<?=base_url('assets/frontend/images/banner-right1.png')?>" />
                    </div>
                    <div class="banner-right">
                        <img src="<?=base_url('assets/frontend/images/video.png')?>" />
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div id="batas-sticky">&nbsp;</div> 
</div>
<link rel="stylesheet" href="<?=base_url('assets/frontend/css/fancybox/jquery.fancybox-buttons.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/frontend/css/fancybox/jquery.fancybox-thumbs.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/frontend/css/fancybox/jquery.fancybox.css')?>">

<script src="<?=base_url('assets/frontend/js/fancybox/jquery.fancybox.js')?>"></script>
<script src="<?=base_url('assets/frontend/js/fancybox/jquery.fancybox-buttons.js')?>"></script>
<script src="<?=base_url('assets/frontend/js/fancybox/jquery.fancybox-thumbs.js')?>"></script>
<script src="<?=base_url('assets/frontend/js/fancybox/jquery.easing-1.3.pack.js')?>"></script>
<script src="<?=base_url('assets/frontend/js/fancybox/jquery.mousewheel-3.0.6.pack.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".various").fancybox({
            maxWidth: 800,
            maxHeight: 600,
            fitToView: false,
            width: '70%',
            height: '70%',
            autoSize: false,
            closeClick: false,
            openEffect: 'elastic',
            closeEffect: 'none'
        });
    });
</script>


<script>
var awal = 6;
$(".loadmore a").click(function () {
   
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getsearch")?>",
        //data: { 'a': 1, 'b': 2, 'c': 3 },
        dataType: 'json',
        data: { 'awalnya': awal, 'lang': '<?=$id_bahasa?>','q': '<?=$_GET["q"]?>'}, 
        beforeSend: function () {
            $(".loadmore a").html("<img src='<?=base_url("assets/frontend/images/loading_small.gif")?>'>");
        },
        complete: function () {
            <?php
            if ($id_bahasa == 1){
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
            $(".content-search").append(data.result);
            if (data.total_count_next == 0){
                $(".loadmore a").hide();
            }
            awal += 4;
        }
    });
    
   
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox();
    });
</script>
<?php $this->load->view('sources/footer.php')?>
