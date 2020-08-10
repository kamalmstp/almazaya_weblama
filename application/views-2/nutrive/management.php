<?php $this->load->view('sources/header.php')?>

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
            <div id="wrap-profil-person" class="large-7 columns no-padding-left">
            
            <?php
            $person = 1;
            foreach($content as $dt){
            ?>
            
            <div id="person<?=$person?>" class="profil-person" style="padding-top:0!important;">
                <div class="large-4 no-padding-left columns">
                  <img src="<?=base_url("uploads/management/".$dt["pic"])?>" alt="">
                </div>
                <div class="large-8 no-padding columns">
                  <div class="wrap-txt-profil-person">
                    <div class="txt-content-nama"><?=$dt["title"]?></div>
                    <div class="txt-content-jabatan"><?=$dt["position"]?></div>
                    <div class="txt-content-isi">
                      <?=$dt["description"]?> 
                    </div>
                  </div>
                </div>
              </div>
            <?php
            $person++;
            }
            ?>
              
              
            
            </div>
            <div id="nama-jabatan" class="no-padding-right large-2 columns">
              <ul id="scrollfix">
                <?php
                    $person = 1;
                    foreach($content as $dt){
                ?>
                <li>
                  <a class="aktif-jabatan" href="#person<?=$person?>">
                    <div class="nama"><?=$dt["title"]?></div>    
                    <div class="jabatan"><?=$dt["position"]?></div>
                  </a>
                </li>
                <?php
                    $person++;
                    }
                    ?>
                
               
              </ul>
            </div>
            
            
          </div>
          <script>
          /*$(".accordion-item > a").click(function(){
            if ($(this).next().children("ul").length == 0){
                window.location.href =  $(this).attr("href");
            }else{
                if ($(this).next().css("display") == "block"){
                    $(this).next().slideUp("fast");
                    $(this).parent().addClass("not-active");
                    
                }else{
                    $(this).next().slideDown("fast");
                    $(this).parent().removeClass("not-active");
                }
            }
    
        });*/
          </script>
<?php $this->load->view('sources/footer.php')?>
