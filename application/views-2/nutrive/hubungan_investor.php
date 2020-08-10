<?php $this->load->view('sources/header.php')?>
<style>
.accordion {
    margin-bottom: 0;
    border: none;
}
.accordion::before, .accordion::after {
    content: " ";
    display: table;
}
.accordion::after {
    clear: both;
}
.accordion dd {
    display: block;
    margin-bottom: 0 !important;
}
.accordion dd.active a {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsl(0, 0%, 91%);
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
}
.accordion dd > a {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsl(0, 0%, 94%);
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
    border-bottom-left-radius: 7px;
    border-bottom-right-radius: 7px;
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
    color: hsl(0, 0%, 13%);
    display: block;
    font-family: "Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
    font-size: 1rem;
    font-weight: bold;
    margin-bottom: 10px;
    padding-bottom: 7px;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 7px;
}
.accordion dd > a:hover {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsl(0, 0%, 89%);
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
}
.accordion .content {
    display: none;
}
.accordion .content.active {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsl(0, 0%, 100%);
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
    display: block;
}
.accordion dd > a:active{
    background-color: hsl(84, 68%, 45%);
    font-size: inherit;
}
.accordion span{
    
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsla(0, 0%, 0%, 0);
    background-image: url("http://www.hypermart.co.id/img/accordion-notactive.png");
    background-origin: padding-box;
    background-position: left center;
    background-repeat: no-repeat;
    background-size: auto auto;
    margin-right:2px;
}
.accordion span.active1{
    
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsla(0, 0%, 0%, 0);
    background-image: url("http://www.hypermart.co.id/img/accordion-active.png");
    background-origin: padding-box;
    background-position: left center;
    background-repeat: no-repeat;
    background-size: auto auto;
    margin-right:2px;

}
</style>
        <div class="wrap-judul-page">
            <div class="panah-judul"><img src="<?=base_url("assets/frontend/images/panah-pojok.png")?>" alt=""></div>
            <div class="row judul-page"><?=$current_page?></div>
          </div>
          <div class="wrap-content row">
            <div id="wrap-menu-page-kiri" class="no-padding-left large-3 columns">
              <ul class="accordion" class="bg-corp" data-accordion role="tablist">
                <?php
                foreach ($sidemenu as $sm){
                ?>
                <li class="accordion-item">
                    <?php
                    if ($controller->getChild($sm->id) > 0){
                    ?>
                    <a href="#panel1d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel1d"><?=$sm->title?></a>
                    <!--<div id="panel1d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel1d-heading">
                        <ul>
                            <li><a href="#">Dewan Pengawas Syariah</a></li>
                            <li><a href="#">Dewan Komisaris</a></li>
                            <li><a href="#">Direksi</a></li>
                            <li><a href="#">Kepala Wilayah</a></li>
                            <li><a href="#">Struktur Organisasi</a></li>
                            <li><a href="#">Komite Audit</a></li>
                        </ul>
                    </div>-->
                    <?php
                    }else{
                    ?>
                    <a href="<?=base_url($sm->link)?>"><?=$sm->title?></a>
                    <?php
                    }
                    ?>
                    
                </li>
                <?php
                }
                ?>
              </ul>
            </div>
            <div id="wrap-profil-person" class="large-9 columns no-padding-left">
                <div class="list_hubungi_investor">
                    <h1><?=$current_menu?></h1>
                    <ul>
                        <?php
                        foreach ($rec as $dt){
                        ?>
                        <li <?php if($dt["link"] == $current_link){ ?>class="current"<?php }?> ><a href="<?=base_url($codebahasa.$link."/".$dt["link"])?>"><?=$dt["title"]?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                    <?php
                    if (count($report) > 0){
                    ?>
                    <div class="reportnya">
                        <table>
                            <?php
                            foreach ($report as $rp){
                            ?>
                            <tr><td style="width: 30%;"><?=$rp["title"]?></td>
                            <?php
                            if ($rp["file"] != ""){
                            ?>
                            <td>
                                <a href="<?=base_url("/download/file/".$rp["file"])?>"><img src="<?=base_url("assets/frontend/images/icon-pdf.png")?>" /><span class="download">Download Report</span></a>
                            </td>
                            <?php
                            }else{
                            ?>
                            <td>
                                -
                            </td>
                            <?php
                            }
                            ?>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        
                        
                        
                    </div>
                    <?php
                    }
                    ?>
                    
                    <?php
                        if(count($rec_child) > 0){
                            ?>
                             
 
                                <dl class="accordion" data-accordion>
                            
                            
                            <?php
                            $konter=1;
                                foreach ($rec_child as $dt_child){
                            ?>
                                
                            <?php
                            ?>
                                <dd class="accordion-navigation">
                                    <a href="#panel<?=$konter?>b"><span class="tanda">&nbsp;&nbsp;</span><?=$dt_child["title"]?></a>
                                    <div id="panel<?=$konter?>b" class="content">
                                      <div class="reportnya">
                                      <table>
                                      <?php
                                      if (count($controller->show_child_level3($dt_child["id"])) > 0){
                                          foreach ($controller->show_child_level3($dt_child["id"]) as $dt){
                                            ?>
                                            
                                            
                                            
                                               
                                                <tr><td style="width: 30%;"><?=$dt["title"]?></td>
                                                <?php
                                                if ($dt["file"] != ""){
                                                ?>
                                                <td>
                                                    <a href="<?=base_url("/download/file/".$dt["file"])?>"><img src="<?=base_url("assets/frontend/images/icon-pdf.png")?>" /><span class="download">Download Report</span></a>
                                                </td>
                                                <?php
                                                }else{
                                                ?>
                                                <td>
                                                    -
                                                </td>
                                                <?php
                                                }
                                                ?>
                                                </tr>
                                              
                                            
                                            
                                            
                                            
                                            <?php
                                            
                                            
                                          }
                                      }
                                      ?>
                                      </table>
                                      </div>
                                      <?=$dt_child["description"]?>
                                    </div>
                                  </dd>
                            <?php
                            $konter++;
                            }
                            ?>
                            
                            
                                </dl>
                            <?php
                            
                            }
                    ?>
                   
                    <div class="content">
                        <?=$description?>
                    </div>
                </div>
          
            </div>
            
          </div>
          </div>
<?php $this->load->view('sources/footer.php')?>
<script>
    $(document).ready(function(){
        $(".accordion-navigation > a").click(function(){
                $(".accordion-navigation > a > span").removeClass("active1");
                $(this + " > .tanda").addClass("active1"); 
        });
    })
</script>