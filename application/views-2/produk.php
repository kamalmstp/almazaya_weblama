
<?php $this->load->view('sources/header-produk.php')?>
<section class="section container-fluid" id="section1">
	</section>
    <section class="produk" style="background-position: 30% 107%;">
	    <div class="container">
            <div class="row">
                <br />
                <div class="breadcrumb">
                    <a href="<?=base_url()?>">Home</a><?=$parent_breadcrumb?><a href="javascript:;"><?=$current_page?></a>
                </div>
            </div>
        </div>
		<div class="row1">
            
            <div class="title-page">
                <h2><?=$current_page?></h2>
                <hr />
            </div>
            
            <div class="owl-produk">
            <?php
            if (count($product_list) > 0){
            ?>
			<div id="owl-demo" class="owl-carousel owl-theme ">
            
                <?php
                $counter = 1;
                foreach ($product_list as $pl){
                    $descriptionnya = strip_tags($pl["description"]);
                    if (strlen($descriptionnya) > 100){
                        $descriptionnya = substr($descriptionnya,0,100)."...";
                    }
                    ?>
                    <?php
                       
                    ?>
                    <div class="item">
                        <div class="image-produk"><img data-id="<?=$pl["sisternya"]?>" src="<?=base_url("uploads/produk/".$pl["pic"])?>" />
                            <h6><?=$pl["title"]?></h6>
                        </div>
                        <div class="produk-deskripsi" style="display: none;">
                            <h3><?=$pl["title"]?></h3>
                            <div class="price"><?=$pl["price"]?></div>
                            <p><?=$descriptionnya?></p>
                            <div class="seedetail">
                                <a href="<?=base_url($codebahasa.$pl["link_detail"].'/'.$pl["link_produk"])?>">See Detail</a>
                            </div>
                        </div>
                      </div>
                    <?php
                    $counter++;
                }
                ?>
              
            </div>
            
            <?php
            }else{
            ?>
            <br />
            <br />
            <h4 style="text-align: center;">Products Not Available</h4>
            <?php
            }
            ?>
            </div>
            
            <div class="showoff">
                
                <?php
                $cou = 1;
                if (count($product_list) > 0){
                    foreach ($product_list as $pl2){
                        if ($cou > 1){
                            $stylehide = "style=\"display: none\"";
                        }else{
                            $stylehide = "";
                        }
                ?>
                    <div class="container-showoff  desc_<?=$pl2["sisternya"]?>"  <?=$stylehide?>>
                    <div class="forbg"><img src="<?=base_url("uploads/produk/".$pl2["icon"])?>" /></div>
                        <div class="img_detail">
                            <img src="<?=base_url("uploads/produk/".$pl2["pic"])?>" height="364" style="padding-bottom: 40px; margin-top: 32px;">
                        </div>
                    
                        <div class="produk-deskripsi">
                            <h3><?=$pl2["title"]?></h3>
                            <p><?=$pl2["short_description"]?></p>
                            <div class="seedetail">
                                <a href="<?=base_url($codebahasa.$pl2["link_detail"].'/'.$pl2["link_produk"])?>"><?=$this->lang->line('seedetail');?></a>
                            </div>
                        </div>
                    </div>
                <?php
                $cou++;
                    }
                }
                ?>
            </div>
            
            
            <div class="mobile_list_produk">
                <ul>
                <?php
                foreach ($product_list as $pl){
                    $descriptionnya = strip_tags($pl["description"]);
                    if (strlen($descriptionnya) > 60){
                        $descriptionnya = substr($descriptionnya,0,60)."...";
                    }
                    ?>
                    
                    <li>
                        <div class="image-list-produk">
                            <img src="<?=base_url("uploads/produk/".$pl["pic"])?>" />
                        </div>
                        <div class="produk-deskripsi-mobile">
                            <h3><?=$pl["title"]?></h3>
                            <p><?=$descriptionnya?></p>
                            <div class="seedetail">
                                <a href="<?=base_url($codebahasa.$pl["link_detail"].'/'.$pl["link_produk"])?>">See Detail</a>
                            </div>
                        </div>
                    </li> 
                    <?php
                }
                ?>
                                  
                </ul>
            </div>
		</div>
	</section>
    <style>
    .aktif img{
        width:150px !important
    }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".image-produk img").click(function(){
                $(".container-showoff").hide();
                
                $(".image-produk img").next().removeClass("active");
                $(this).next().addClass("active");
                $(".desc_" + $(this).attr("data-id")).show();
                $(".desc_" + $(this).attr("data-id")).addClass("zoomIn animated");
            })
        })
    </script>
    <?php $this->load->view('sources/footer-produk.php')?>