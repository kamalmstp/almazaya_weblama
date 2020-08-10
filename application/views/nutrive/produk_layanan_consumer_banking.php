<?php $this->load->view('sources/header.php')?>
<style>


    #owl-demo .item{
      margin: 3px;
    }
    #owl-demo .item img{
      display: block;
      width: 100%;
      height: auto;
    }
    #owl-demo-2 .item{
      margin: 5px;
    }
    #owl-demo-2 .item img{
      display: block;
      width: 100%;
      height: auto;
    }
    .produk_layanan h2{
        color: #6a0081 !important;
    }
    .owl-carousel{
        margin-bottom:10px;
    }
    .produk_layanan h4,.produk_layanan h3,.produk_layanan h2,.produk_layanan h1,li,td{
        font-family: "MyriadPro-Regular" !important
    }
    strong{
        color: hsl(0, 0%, 40%) !important;
    }
    #owl-demo-2 h3{
        color: #6a0081;
        font-family: "MyriadPro-Regular" !important;
        font-size:20px;
    }
    #owl-demo-2 .title{
        min-height: 70px;
    }
    .owl-theme .owl-controls{
        bottom: 0px !important;
        position: relative !important;
        top: 0px !important;
    }
    .otherproduct{
        border-top: 2px solid #84C225;
        padding-top: 15px;
    }
    .subtitle h5{
        font-family: "MyriadPro-Regular" !important;
        font-size:18px;
        color: #333333;
        line-height: 20px;
        margin-top: 8px;
    }
</style>
        <div class="wrap-judul-page">
            <div class="panah-judul"><img src="<?=base_url("assets/frontend/images/panah-pojok.png")?>" alt=""></div>
            <div class="row judul-page"><?=strip_tags($current_parent_page)?></div>
          </div>
          <div class="wrap-content row">
            <div id="wrap-menu-page-kiri" class="no-padding-left large-3 columns">
             <ul class="accordion" class="bg-corp" data-accordion role="tablist">
                
                <?php
              $counter = 1;
                foreach ($sidemenu as $sm){
                    $classess = "";
                    if ($sm->link == $link){
                        $classess = "aktif-menu-kiri";
                    }
                ?>
                <li class="accordion-item">
                <?php
                if ($sm->total > 0){
                ?>
                    <a href="#panel1d" role="tab" rel="test" class="accordion-title" id="panel1d-heading" aria-controls="panel1d"><?=$sm->title?></a>
                <?php
                }else{
                ?>
                    <a href="<?=$sm->link?>" ><?=$sm->title?></a>
                <?php
                }
                ?>
                  <?=$controller->_getSubSideMenu($sm->sister)?>
                </li>
                <?php
                $counter++;
                }
                ?>
              </ul>    
            </div>
            <div id="wrap-profil-person " class="large-9 columns no-padding-left">
                <div class="pengaduan_nasabah produk_layanan">
                <h1><?=$current_page?></h1>
                

                <div id="owl-demo">
                  <?php
                  if (count($rec_all) > 0){
                  foreach ($rec_all as $dt){
                  ?>    
                    <?php
                        if ($dt->pic == ""){
                    ?>    
                  <div class="item"><a href="<?=base_url($codebahasa.$link."/".$dt->link)?>"><img src="<?=base_url("assets/frontend/images/bank-muamalat.png")?>" alt="<?=$dt->title?>"></a><span class="title_img"><?=$dt->title?></span></div>
                    <?php
                    }else{
                    ?>
                    <div class="item"><a href="<?=base_url($codebahasa.$link."/".$dt->link)?>"><img src="<?=base_url("uploads/list_produk_service/".$dt->pic)?>" alt="<?=$dt->title?>"></a><!-- <span class="title_img"><?=$dt->title?></span> --></div>
                    <?php
                    }
                    ?>
                  <?php
                  }
                  }
                  ?>
                  
                </div>
                <h2>
                <?php
                    if (isset($rec[0]->title)){
                        echo $rec[0]->title;
                    }
                ?>
                </h2>
                <?php if ($current_sister != 133): ?>
                <div class="tabing">
                    <ul>
                        <?php
                            if (isset($rec[0]->description) AND $rec[0]->description != ''){
                              ?>
                              <li><a href="javascript:;" rel="detail_produk" class="active">DETAIL PRODUK</a></li>
                              <?php  
                            }
                        ?>
                        
                        <?php
                            if (isset($rec[0]->benefit) AND $rec[0]->benefit != ''){
                              ?>
                              <li><a href="javascript:;" rel="benefit">KEUNTUNGAN</a></li>
                              <?php  
                            }
                        ?>
                        <?php
                            if (isset($rec[0]->syarat_pembukaan) AND $rec[0]->syarat_pembukaan != ''){
                              ?>
                              <li><a href="javascript:;" rel="syarat_pembukaan">SYARAT PEMBUKAAN</a></li>
                              <?php  
                            }
                        ?>
                        <?php
                            if (isset($rec[0]->fitur_umum) AND $rec[0]->fitur_umum != ''){
                              ?>
                              <li><a href="javascript:;" rel="fitur_umum">FITUR UMUM</a></li>
                              <?php  
                            }
                        ?>
                    </ul>
                </div>
                <?php endif ?>
                <div class="contentnya">
                    <div class="detail_produk">
                        <?php
                            if (isset($rec[0]->description)){
                                echo $rec[0]->description;
                            }
                        ?>
                    </div>
                    <div class="benefit" style="display: none;">
                        <?php
                            if (isset($rec[0]->benefit)){
                                echo $rec[0]->benefit;
                            }
                        ?>
                    </div>
                    <div class="syarat_pembukaan" style="display: none;">
                        
                        <?php
                            if (isset($rec[0]->syarat_pembukaan)){
                                echo $rec[0]->syarat_pembukaan;
                            }
                        ?>
                    </div>
                    <div class="fitur_umum" style="display: none;">
                        <?php
                            if (isset($rec[0]->fitur_umum)){
                                echo $rec[0]->fitur_umum;
                            }
                        ?>
                    </div>
                </div>
            </div>
            
          </div>
          
            
          </div>
          <!-- <div class="row otherproduct">
            <?php
              if (count($rec_other) > 0){
              
            ?> 
            <h3>Retail Products &amp; Services lainnya</h3>
            <div id="owl-demo-2">
              <?php
              
              foreach ($rec_other as $dt){
              ?>        
                <div class="item">
                    <div class="title">
                        <?php
                            $titlenya = $dt->title;
                            if(strlen($dt->title) > 30){
                                $titlenya = substr($dt->title,0,30)."...";
                            }
                        ?>
                        <?php
                            $description = strip_tags($dt->description);
                            if(strlen($description) > 50){
                                $description = substr($description,0,50)."...";
                            }
                        ?>
                        <h3><?=$titlenya?></h3>
                    </div>
                    <?php
                        if ($dt->pic == ""){
                    ?>
                    <a href="<?=base_url($codebahasa.$link."/".$dt->link)?>"><img src="<?=base_url("assets/frontend/images/bank-muamalat.png")?>" alt="<?=$dt->title?>"></a>
                    <?php
                    }else{
                    ?>
                    <a href="<?=base_url($codebahasa.$link."/".$dt->link)?>"><img src="<?=base_url("uploads/list_produk_service/".$dt->pic)?>" alt="<?=$dt->title?>"></a>
                    <?php
                    }
                    ?>
                    <div class="subtitle">
                        <h5><?=$description?></h5>
                    </div>
                </div>
                
              <?php
              }
              ?>
              
            </div>
            <?php
              }
              ?>
          </div> -->
          <script>
          

            $(document).ready(function() {
              $("#owl-demo").owlCarousel({
             
                  autoPlay: 3000, //Set AutoPlay to 3 seconds
                  navigation : true,
                  items : 4,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3]
             
              });
              $("#owl-demo-2").owlCarousel({
             
                  autoPlay: 3000, //Set AutoPlay to 3 seconds
                  navigation : true,
                  items : 6,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3]
             
              });
             $(".tabing > ul > li > a").click(function(){
                var atribut = $(this).attr("rel");
                $(".tabing > ul > li > a").removeClass("active");
                $(this).addClass("active");
                $(".contentnya > div").hide();
                $(".contentnya > ." + atribut).fadeIn();
             });
             
             $(".item").hover(
              function() {
                $( this ).addClass( "hover" );
              }, function() {
                $( this ).removeClass( "hover" );
              }
            );
        
            });
          </script>
<?php $this->load->view('sources/footer.php')?>
