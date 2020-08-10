<?php $this->load->view('sources/header-content.php')?>
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/fancybox/jquery.fancybox-buttons.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/fancybox/jquery.fancybox-thumbs.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/fancybox/jquery.fancybox.css')?>">
    
        <div class="wrap-judul-page">
            <div class="panah-judul"><img src="<?=base_url("assets/frontend/images/panah-pojok.png")?>" alt=""></div>
            <div class="row judul-page"><?=$current_parent_page?></div>
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
                <div class="pengaduan_nasabah penghargaan">
                <h1><?=$current_page?></h1>
                <ul class="list-item-gallery">
                        <?php
                            foreach ($gallery as $dt){
                        ?>                                                                    
                        <li>
                            <a  class="fancybox" rel="group" href="<?php echo base_url('uploads/penghargaan/'.$dt["pic"])?>" title="<?=$dt["title"]?>" ><img class="thisfoto" src="<?php echo base_url('uploads/penghargaan/'.$dt["thumb"])?>" /></a>
                            <div class="title-photo">
                                <?=$dt["title"]?>
                            </div>
                        </li>
                        <?php
                            }
                        ?>    
                </ul>
                <div class="pagination">
                    <?=$page?>
                </div>
                </div>
            
          </div>
          </div>
          <script src="<?php echo base_url('assets/frontend/js/fancybox/jquery.fancybox.js')?>"></script>
            <script src="<?php echo base_url('assets/frontend/js/fancybox/jquery.fancybox-buttons.js')?>"></script>
            <script src="<?php echo base_url('assets/frontend/js/fancybox/jquery.fancybox-thumbs.js')?>"></script>
            <script>
                var $= jQuery.noConflict();
                $(document).ready(function(){
                    $(".fancybox").fancybox();
                });
            </script>
          <script>
          $(".accordion-item > a").click(function(){
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
    
        });
          </script>
<?php $this->load->view('sources/footer.php')?>
