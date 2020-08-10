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
            <div id="wrap-profil-person" class="large-8 end columns no-padding-left">
                <div class="pengaduan_nasabah content"> 
                <h1><?=$current_page?></h1>
                <form data-abide action="" class="pengaduan_nasabah_form" method="POST"  enctype="multipart/form-data">
                    <h6>Kalkulator KPR</h6>
                    
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                Plafon
                            </div>
                            <div class="large-6 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="nama" type="text" name="nama" required="" >
                                <small class="error">Plafon Harus Diisi</small>
                            </div>
                        </label>
                        
                    </div>
                    
                    
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                Jangka Waktu (Bulan)
                            </div>
                            <div class="large-6 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="telepon_rumah" type="text" name="telepon_rumah" required="">
                                <small class="error"><?=$this->lang->line("form_nasabah_error_telepon_rumah")?></small>
                            </div>
                            <div class="large-6 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">Bulan</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                Angsuran Setiap Bulan
                            </div>
                            <div class="large-6 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="telepon_selular" type="text" name="telepon_selular" required="">
                                <small class="error"><?=$this->lang->line("form_nasabah_error_telepon_selular")?></small>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right: 0px; margin-top: 36px;">
                        <input type="submit" name="submit" class="submit" value="CEK" />&nbsp;<img class="loadingimage" style="display: none;" src="<?=base_url("assets/frontend/images/ajax-loader.gif")?>" />
                    </div>
                </form>
            </div>
            
          </div>
          </div>
<?php $this->load->view('sources/footer.php')?>
