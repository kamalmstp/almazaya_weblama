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
<div class="content-produk">
    <div class="content-row-produk">
        <div class="content-full">
            <div class="produk">
                <?php
                if ($aksi == "detail"){
                ?>
                <div class="list-produk">
                    

                    <div id="owl-demo" class="owl-carousel owl-theme">
                              
                        <?php
                        
                            foreach ($rec_artikel as $dt){
                                $selected = "";
                                if ($dt["link"] == $parameter){
                                    $selected = "active";
                                }else{
                                    $selected = "notactive";
                                }
                                //echo "<pre>";
//                                print_r($rec_artikel);
                        ?>
                        <div class="item">
                            <div class="title <?=$selected?>"><?=$dt["title"]?></div>
                            <div class="image-product">
                                <a href="<?=base_url($codebahasa.$dt["link_pages"]."/".$dt["link_news"])?>"><img alt="<?=$dt["title"]?>"  src="<?=base_url("uploads/produk/".$dt["pic"])?>" /></a>
                            </div>
                        </div>
                        
                        <?php
                        }
                        ?>
                        
                        
                    </div>
                

                </div>
                <div class="row">
                    <div class="medium-5 columns" style="padding: 0px;">
                        <div class="detail_image_produk">
                            <img alt="<?=$dt["title"]?>"  src="<?=base_url("uploads/produk/".$detail[0]["pic"])?>" />
                        </div>
                        <script>
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
                        </script>
                        <div class="box-beli">
                            <ul class="button-produk">
                                <li><a id="beli" target="_blank" href="<?=$detail[0]["linkkalbestore"]?>">Beli</a>
                                </li>
                                <!--<li><a id="free-sample" target="_blank" href="javascript:;">
                                        Free Sample
                                    </a>
                                </li>-->
                            </ul>
                            <div class="socmed">
                                <span>Share : </span> 
                                <a href="javascript:fbShare('<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>', '<?=$detail[0]["title"]?>', '<?=substr($detail[0]["description"], 0, 100)?>', '<?=base_url("uploads/artikel/".$detail[0]["pic"])?>', 520, 350)"><img src="http://prenagen.com/images/fb.png"></a>&nbsp;<a href="javascript:tweet('<?="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"?>','<?=$detail[0]["title"]?>', 520, 350)"><img src="http://prenagen.com/images/tw.png"></a>
                            </div>
                        </div>
                    </div>
                    <div class="medium-7 columns" style="padding: 0px;">
                        <div class="deskripsi-produk-title">
                            <h1><?=$detail[0]["title"]?></h1>
                        </div>
                        <div class="deskripsi-produk-detail">
                            <?=$detail[0]["description"]?>
                        </div>
                    </div>
                </div>
                
                
               
                <?php
                }else{
                ?>
                <div class="subtitle">
                <?=$content?>
                </div>
               <div class="bgproduct row-belt-desktop">
                    <div id="dumex-mamil-list" class="dock">
                        <div class="dock-container2">
                        
                        
                            <?php
                                $konter = 1;
                                foreach ($rec_artikel as $dt){
                            ?>
                            <a class="dock-item2 itm<?=$konter?>" href="<?=base_url($codebahasa.$dt["link_pages"]."/".$dt["link_news"])?>"><span style="display: none; background: url('<?=base_url("uploads/produk/".$dt["pic2"])?>') 50% 100% no-repeat;"> Mamil Mama </span><img alt="<?=$dt["title"]?>"  src="<?=base_url("uploads/produk/".$dt["pic"])?>" /></a>
                            
                            <?php
                            $konter++;
                            }
                            ?>
                        
                            
                        </div>
                    </div>
                    
                </div>
                <div class="produkmobile row-belt-mobile">
                    <ul>
                        <?php
                            $konter = 1;
                            foreach ($rec_artikel as $dt){
                        ?>
                        
                        <li>
                            <div class="Image-produkPage">
                                <a href="<?=base_url($codebahasa.$dt["link_pages"]."/".$dt["link_news"])?>">
                                <img src="<?=base_url("uploads/produk/".$dt["pic"])?>" alt="<?=$dt["title"]?>"></a>
                            </div>
                            <div class="entry-content">
                                <h3><a href="<?=base_url($codebahasa.$dt["link_pages"]."/".$dt["link_news"])?>"><?=$dt["title"]?></a></h3>
                                <div class="description-produk">
                                    <a href="<?=base_url($codebahasa.$dt["link_pages"]."/".$dt["link_news"])?>"> <?=strip_tags($dt["description"])?></a>
                                </div>
                            </div>
                        </li>
                        
                        <?php
                        $konter++;
                        }
                        ?>
                        <li></li>
                    </ul>
                </div>
                <ul class="btn-produk"  style="text-align: center;">
                    <li><div class="btn-beli"><a target="_blank" href="http://www.kalbestore.com/Product/Brand/Nutrive-Benecol">Beli</a></div></li>
                    <!--<li><div class="btn-freesample"><a href="javascript:;">Free Sample</a></div></li>-->
                </ul>
                
                
            <?php
            }
            ?>
        </div> 
        
    </div>
    <div id="batas-sticky">&nbsp;</div> 
</div>
</div>

<script  type="text/javascript" src="<?=base_url("assets/frontend/js/interface-v1.js")?>"></script>
<style>

    .produkmobile ul li{list-style:none; border-bottom: 1px solid #14899D;margin-bottom: 20px;}
    .produkmobile ul li:last-child{border-bottom:none}
    .Image-produkPage{float:left; margin-right: 15px;}
    .entry-content{    
        min-height: 160px;
        overflow: hidden;
        color: #4b4b4b;

    }
    .description-produk{
        line-height: 20px;
        margin-bottom: 20px;
    }
    .entry-content a{ 
        color: #fff;
    }
    .produkmobile ul li a img {width: 100px;}
    #carousel{
        margin: auto;
        width: 142px;
    }
    
    #owl-demo .item{
      padding: 30px 0px;
      margin: 10px;
      color: #FFF;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      text-align: center;
    }
    #owl-demo .item img{
        width: 60px !important;
        margin: auto
    }
    
    .owl-item{
        padding-top:10px;
    }
    .item div.title {
        background-attachment: scroll;
        background-clip: border-box;
        background-color: #14899D;
        background-image: none;
        background-origin: padding-box;
        background-position: 0 0;
        background-repeat: repeat;
        background-size: auto auto;
        position: absolute; width: 92%; margin-top: -45px;
        border-radius:5px;
        padding-top:4px;
        padding-bottom: 4px;
    }
    .item div.title.notactive{
        display: none;
    }
    .item div.title:after, .title:before {
	top: 100%;
	left: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.item div.title:after {
	border-color: rgba(136, 183, 213, 0);
	border-top-color: #14899D;
	border-width: 8px;
	margin-left: -8px;
}
.item div.title:before {
	border-color: rgba(194, 225, 245, 0);
	border-top-color: #14899D;
	border-width: 10px;
	margin-left: -10px;
}
    .owl-controls{
        display: none;
    }
    .owl-buttons{
        display: none !important;
    }
</style>
 <script type="text/javascript">
 

    $(document).ready(function() {
     
      
       $("#owl-demo").owlCarousel({
      items : 5, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0;
      itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
      navigation : true
  });
    });


 jQuery.curCSS = jQuery.css;
        $(document).ready(function () {
            
            $('#dumex-mamil-list').Fisheye({
                maxWidth: 20,
                items: 'a',
                itemsText: 'span',
                container: '.dock-container2',
                itemWidth: 100,
                proximity: 120,
                alignment: 'left',
                valign: 'bottom',
                halign: 'center'
            });
            $('#dumex-dugro-list').Fisheye({
                maxWidth: 20,
                items: 'a',
                itemsText: 'span',
                container: '.dock-container2',
                itemWidth: 80,
                proximity: 120,
                alignment: 'left',
                valign: 'bottom',
                halign: 'center'
            });
            
            var timer;
            var delay = 200;

            $('ul#example li.top').hover(function () {
                timer = setTimeout(function () {
                    var heightnya = $(document).height();
                    document.body.scrollTop = document.documentElement.scrollTop = heightnya;
                }, delay);
            }, function () {
                
                clearTimeout(timer);
            });
        });
    </script>
<?php $this->load->view('sources/footer-produk.php')?>
