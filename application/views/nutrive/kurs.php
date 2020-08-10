<?php $this->load->view('sources/header-content.php')?>
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
                    <a href="<?=base_url($codebahasa.$sm->link)?>" ><?=$sm->title?></a>
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
                <div class="pengaduan_nasabah treasury ">
                <h1><?=$current_page?></h1>
                    <span class="datetreasure"><?=date("d M Y / H:i")?> Wib</span>
                    <table style="width:100%;" class="kurs">
                        <tr><td rowspan="2">Mata Uang</td><td colspan="2">Indicative Special Rate</td><td colspan="2">TT Counter</td><td colspan="2">Bank Notes</td></tr>
                        <tr><td>Jual</td><td>Beli</td><td>Jual</td><td>Beli</td><td>Jual</td><td>Beli</td></tr>
                        <?php
                            foreach ($kurs as $dt){
                        ?>                                                                    
                        <tr>
                            <td><?=$dt["title"]?></td>
                            <td><?=$dt["indicative_special_rate_jual"]?></td>
                            <td><?=$dt["indicative_special_rate_beli"]?></td>
                            <td><?=$dt["ttcounter_jual"]?></td>
                            <td><?=$dt["ttcounter_beli"]?></td>
                            <td><?=$dt["bank_notes_jual"]?></td>
                            <td><?=$dt["bank_notes_beli"]?></td>
                        </tr>
                        <?php
                            }
                        ?>    
                    </table>
                    <br />
                    <br />
                    <div class="kalkulator_kurs">
                        <h2>Kalkulator Kurs</h2>
                        <ul class="type_kal">
                            <li><a class="active" rel="1" href="javascript:;">Jual</a></li>
                            <li><a rel="2" href="javascript:;">Beli</a></li>
                        </ul>
                        <table class="calculate">
                            <tr>
                                <td>Jumlah</td>
                                <td>Dari (Kurs)</td>
                                <td>Ke (Kurs)</td>
                                <td>Hasil</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="jumlah" class="jumlah" /></td>
                                <td>
                                    <select name="dari" class="dari">
                                        <option value=""></option>
                                        <?php
                                            foreach ($kurs as $dt){
                                        ?>  
                                        <option value="<?=$dt["bank_notes_jual"]?>;<?=$dt["bank_notes_beli"]?>"><?=$dt["title"]?></option>
                                        <?php
                                            }
                                        ?>  
                                    </select>
                                </td>
                                <td>
                                    <select name="ke" class="ke">
                                        <option value=""></option>
                                        <?php
                                            foreach ($kurs as $dt){
                                        ?>  
                                        
                                        <option value="<?=$dt["bank_notes_jual"]?>;<?=$dt["bank_notes_beli"]?>"><?=$dt["title"]?></option>
                                        <?php
                                            }
                                        ?>  
                                    </select>
                                </td>
                                <td><input type="text" name="hasil" class="hasil" /></td>
                                <td style="vertical-align: top; padding-top: 13px; text-align: left;"><input type="submit" name="submit" class="submit" value="Calculate" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
          </div>
        </div>
          
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
        $("ul.type_kal > li > a").click(function(){
            $("ul.type_kal > li > a").removeClass("active");
            $(this).addClass("active");
            $(".jumlah").val("");
            $(".dari").val("");
            $(".ke").val("");
            $(".hasil").val("");
        });
        $(".submit").click(function(){
            var jumlah = $(".jumlah").val();
            var dari = $(".dari").val();
            var ke = $(".ke").val();
            
            var dari_ = dari.split(";");
            var dari_jual = dari_[0];
            var dari_beli = dari_[1];
            
            var ke_ = ke.split(";");
            var ke_jual = ke_[0];
            var ke_beli = ke_[1];
            
            if(jumlah != "" && dari != "" && ke != ""){
                if ($("ul.type_kal > li > a.active").attr("rel") == 1){
                    
                    var hasil = ((jumlah * dari_jual) / ke_jual).toFixed(2);
                    $(".hasil").val(hasil);
                }else{
                    var hasil = ((jumlah * dari_beli) / ke_beli).toFixed(2);
                    $(".hasil").val(hasil);
                }
            }
            
        });
        </script>
<?php $this->load->view('sources/footer.php')?>
