<?php $this->load->view('sources/header.php')?>
<style>
    select{
        background: rgb(237, 229, 238) none repeat scroll 0% 0%; border: medium none; border-radius: 3px;
        font-family: "MyriadPro-Regular";
        font-size: 15px;
    }
    div > small.error{
        display: none;
    }
    div > small.error_captcha{
        display: none !important;
    }
    div.error > small.error_captcha{
        display: block !important;
    }
    div.error > small.error{
        display: table;
        width: 100%;
        background: #C60F13;
        color: #fff;
        padding-left:10px;
        margin-bottom:20px;
    }
    div.error > input{
        margin-bottom:0px;
    }
    div.error > select{
        margin-bottom:0px;
    }
    div.error > textarea{
        margin-bottom:0px;
    }
</style>
        <div class="wrap-judul-page">
            <div class="panah-judul"><img src="<?=base_url("assets/frontend/images/panah-pojok.png")?>" alt=""></div>
            <div class="row judul-page"><?=$current_parent_page?></div>
          </div>
          <div class="wrap-content row">
            <div id="wrap-menu-page-kiri" class="no-padding-left large-3 columns">
              <ul class="accordion" class="bg-corp" data-accordion role="tablist">
                
                <?php
                foreach ($sidemenu as $sm){
                    $classess = "";
                    if ($sm->link == $link){
                        $classess = "aktif-menu-kiri";
                    }
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
                    <a class="<?=$classess?>" href="<?=base_url($codebahasa.$sm->link)?>"><?=$sm->title?></a>
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
                <div class="pengaduan_nasabah">
                <h1><?=$current_page?></h1>
                <div class="alert-form-submit" style="display: none;"></div>
                <form data-abide action="" class="pengaduan_nasabah_form" method="POST"  enctype="multipart/form-data">
                    <h6><?=$this->lang->line("form_nasabah_title")?></h6>
                    
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                <?=$this->lang->line("form_nasabah_name")?>
                            </div>
                            <div class="large-11 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="nama" type="text" name="nama" required="" >
                                <small class="error"><?=$this->lang->line("form_nasabah_error_nama_lengkap")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                        
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                <?=$this->lang->line("form_nasabah_email")?>
                            </div>
                            <div class="large-11 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="alamat_email" type="email" name="alamat_email" required="">
                                <small class="error"><?=$this->lang->line("form_nasabah_error_alamat_email")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                <?=$this->lang->line("form_nasabah_alamat_domisili")?>
                            </div>
                            <div class="large-11 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="alamat_domisili" type="text" name="alamat_domisili" required="">
                                <small class="error"><?=$this->lang->line("form_nasabah_error_alamat_domisili")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                <?=$this->lang->line("form_nasabah_telepon_rumah")?>
                            </div>
                            <div class="large-11 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="telepon_rumah" type="text" name="telepon_rumah" required="">
                                <small class="error"><?=$this->lang->line("form_nasabah_error_telepon_rumah")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                                <?=$this->lang->line("form_nasabah_telepon_selular")?>
                            </div>
                            <div class="large-11 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="telepon_selular" type="text" name="telepon_selular" required="">
                                <small class="error"><?=$this->lang->line("form_nasabah_error_telepon_selular")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right: 0px; margin-top: 36px;">
                        <label>
                            <div class="regtitle two_coloumn large-6 columns" style="padding-left: 0px;">
                                <?=$this->lang->line("form_nasabah_Sudah_menjadi_nasabah_muamalat")?> ?
                            </div>
                            <div class="large-5 columns kolomkanan"  style="padding-right:8px; position: relative">
                                <select name="nasabah_muamalat" class="nasabah_muamalat" required>
                                <option value="">-- <?=$this->lang->line("form_nasabah_Sudah_menjadi_nasabah_muamalat")?> -- </option>
                                
                                <option value="Sudah"><?=$this->lang->line("form_nasabah_option_1")?></option>
                                <option value="Belum"><?=$this->lang->line("form_nasabah_option_2")?></option>
                                
                                </select>
                                <span><img src="<?=base_url("assets/images/arrow-down.png")?>"  style="position: absolute; top: 16px; right: 15px;" /></span>
                                <small class="error"><?=$this->lang->line("form_nasabah_error_sudah_menjadi_nasabah_muamalat")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right: 0px; margin-top: 36px;">
                        <label>
                            <div class="regtitle two_coloumn large-6 columns" style="padding-left: 0px;">
                                <?=$this->lang->line("form_nasabah_tipe_pertanyaan")?> ?
                            </div>
                            <div class="large-5 columns kolomkanan"  style="padding-right:8px; position: relative">
                                <select name="jenis_pertanyaan" class="jenis_pertanyaan" required>
                                <option value="">-- <?=$this->lang->line("form_nasabah_tipe_pertanyaan")?> -- </option>
                                <?php
                                foreach ($jenis_pertanyaan as $quest){
                                ?>
                                <option value="<?=$quest["title"]?>"><?=$quest["title"]?></option>
                                <?php
                                }
                                ?>
                                </select>
                                <span><img src="<?=base_url("assets/images/arrow-down.png")?>"  style="position: absolute; top: 16px; right: 15px;" /></span>
                                <small class="error"><?=$this->lang->line("form_nasabah_error_tipe_pertanyaan")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right: 0px; margin-top: 36px;">
                        <label>
                            <div class="large-6 columns" style="padding-left: 0px; padding-right:8px;position: relative">
                                <div class="regtitle ">
                                    <?=$this->lang->line("form_nasabah_isi_masalah")?>
                                </div>
                                <textarea name="masalah" required class="masalah"  rows="7"></textarea><span class="mandatory mandatory_masalah">*) mandatory</span>
                                <small class="error"><?=$this->lang->line("form_nasabah_error_isi_masalah")?></small> 
                            </div>
                            <div class="large-6 columns kolomkanan" style="padding-right:8px;position: relative">
                                <div class="regtitle ">
                                    <?=$this->lang->line("form_nasabah_lampiran")?>
                                </div>
                                <div class="browse_file">Browse</div> 
                                <input type="file" name="file" class="attachment" style="display: none;"/>
                                <p>Attachment File (Zip File format, max 300 Kb)</p>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right:0px;">
                        <label>
                            <div class="regtitle">
                            
                            
                                Captcha <img src="<?=base_url("captcha.php")?>" />
                                <?php
                            //print_r($_SESSION);
                            ?>
                            </div>
                            <div class="large-11 columns" style="padding-left: 0px; padding-right:8px;float:left;">
                                <input class="captcha" type="text" name="captcha" required="">
                                <small class="error error_captcha"><?=$this->lang->line("form_nasabah_error_captcha")?></small>
                            </div>
                            <div class="large-1 columns" style="padding-left: 0px; padding-right:0px; position:relative">
                                <span class="mandatory">*) mandatory</span>
                            </div>
                        </label>
                    </div>
                    <div class="large-12 columns" style="padding-left: 0px; padding-right: 0px; margin-top: 36px;">
                        <input type="submit" name="submit" class="submit" value="<?=$this->lang->line("form_nasabah_kirim")?>" />&nbsp;<img class="loadingimage" style="display: none;" src="<?=base_url("assets/frontend/images/ajax-loader.gif")?>" />
                    </div>
                </form>
            </div>
            
          </div>
          </div>
<?php $this->load->view('sources/footer.php')?>
<script>
    $(document).ready(function(){
        $(".browse_file").click(function(){
            $(".attachment").click();
        });
        $("input:file").change(function (){
            $(".filenya").remove();
            var fileName = $(this).val();
            $(".browse_file").after("<p class=\"filenya\">"+fileName+"</p>");
        });
        $(".pengaduan_nasabah_form").submit(function(){
            if ($(".nama").val() != '' && $(".alamat_email").val() != '' && $(".alamat_domisili").val() != '' && $(".telepon_rumah").val() != '' && $(".telepon_selular").val() != '' && $(".nasabah_muamalat").val() != '' && $(".jenis_pertanyaan").val() != '' && $(".masalah").val() != '' && $(".captcha").val() != '' ){
                var formData = new FormData($(this)[0]);
                formData.append('image', $('input[type=file]')[0].files[0]); 
                $.ajax({
                    type: "POST",
                    url: "<?=base_url("pengaduan-nasabah/?post=1")?>",
                    //data: { 'nama': $(".nama").val(), 'alamat_email': $(".alamat_email").val(), 'alamat_domisili': $(".alamat_domisili").val(), 'telepon_rumah':$(".telepon_rumah").val(), 'telepon_selular':$(".telepon_selular").val(), 'nasabah_muamalat': $(".nasabah_muamalat").val(), 'jenis_pertanyaan': $(".jenis_pertanyaan").val(), 'masalah':$(".masalah").val(), 'captcha':$(".captcha").val() },
                    data : formData,
                    processData: false,
                    contentType: false,
                    dataType: 'html',
                    beforeSend: function () {
                        $(".loadingimage").show();
                        $(".submit").val("loading...");
                        $(".captcha").next().hide();
                    },
                    complete: function () {
                        $(".submitdaftar").val("SUBMIT");
                    },
                    success: function (xml) {
                        if(xml == 0){
                            $(".captcha").parent().addClass("error");
                            $(".captcha").next().text("<?=$this->lang->line("notifikasi_error_captcha")?>");
                            $(".captcha").next().css("display","table");
                            $(".loadingimage").hide();
                            $(".submit").val("<?=$this->lang->line("form_nasabah_kirim")?>");
                            
                        }
                        if(xml > 0){
                            $(".loadingimage").hide();
                            $(".submit").val("<?=$this->lang->line("form_nasabah_kirim")?>");
                            $(window).scrollTop($('.wrap-judul-page').offset().top);
                            $("input").val("");
                            $("select").val("");
                            $("textarea").val("");
                            $(".filenya").val("");
                            $(".alert-form-submit").text("<?=$this->lang->line("notifikasi_form_nasabah")?>");
                            $(".alert-form-submit").show();
                            $(".captcha").next().hide();
                        }
                        
                    }
                });
            }
            return false;
        });
        
    });
</script>
