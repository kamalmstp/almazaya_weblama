<?php
$data = array();
if ($aksi == "detail"){
    
    
    if (isset($cat_title)){
        $title = $cat_title;
        if ($title == ""){
            //header('Location: '.base_url());
        }
        $data["title"] = $title;
    }
    
    
    if (isset($detail[0]["description"])){
        $description = substr($detail[0]["description"], 0, 100);
        $data["description"] = $description;
    }
    
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
                <a href="<?=base_url()?>">Home</a><a href="<?=base_url($current_link_page)?>"><?=$current_page?> </a>
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
            <div class="content-description">
            <?=$isicontent?>   
            </div>
        </div> 
        <?php $this->load->view('sources/sidebar.php')?>
        
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
    <?php
        if ($aksi == "detail"){
    ?>
    
    $.ajax({
        type: "POST",
        url: "<?=base_url("ajax/getfotobycat")?>",
        //data: { 'a': 1, 'b': 2, 'c': 3 },
        dataType: 'json',
        data: { 'lang': <?=$langnow?>, 'awalnya': awal, 'codebahasa': '<?=$codebahasa?>','cat': '<?=$parameter?>', 'sisterpage':<?=$sisterpage?>}, 
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
    <?php
        }else{
            
            ?>
            $.ajax({
                type: "POST",
                url: "<?=base_url("ajax/getfotocat")?>",
                //data: { 'a': 1, 'b': 2, 'c': 3 },
                dataType: 'json',
                data: { 'lang': <?=$langnow?>, 'awalnya': awal, 'codebahasa': '<?=$codebahasa?>','cat': '<?=$parameter?>', 'sisterpage':<?=$sisterpage?>}, 
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
            <?php
        }
    ?>
});
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox").fancybox();
    });
</script>
<?php $this->load->view('sources/footer.php')?>
