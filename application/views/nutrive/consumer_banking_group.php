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
            <div id="wrap-profil-person" class="large-9 columns no-padding-left">
                <div class="pengaduan_nasabah" style="overflow: hidden;" >
                <h1><?=$current_page?></h1>
                
                
                <div class="content consumer_banking_group" style="margin-left: -20px;">
                    <ul>
                        <?php
                            foreach ($rec as $dt){
                        ?>
                                                
                        <li><a href="<?=base_url($codebahasa.$dt->link)?>"><img src="<?=base_url("uploads/consumer_banking/".$dt->picnya)?>" /></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                
            </div>
            
          </div>
          </div>
          
          
<?php $this->load->view('sources/footer.php')?>
