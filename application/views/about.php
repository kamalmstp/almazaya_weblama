<?php $this->load->view('sources/header.php')?>

<!-- About Section -->
    <section id="about">
      <div class="container">
        <?php
        if (isset($_GET["pendaftaran"])){
            if ($_GET["pendaftaran"] == "SMA"){
                ?>
                <div class="pendaftaran">
                    <h4>FORMULIR PENDAFTARAN SISWA BARU</h4>
                    <h2 style="margin-bottom: 80px;">SMA ALMAZAYA BANJARMASIN</h2>
                    <form action=""  class="form-horizontal" method="POST"  role="form">
                        <div class="col-lg-12" style="padding-left:0px; padding-right:0px; margin-bottom:60px;">
                        <div class="col-lg-6 ">
                            <div class="form-group row">
                            <label for="tahunpendaftarn" class="col-sm-4 col-form-label">Tahun Pendaftaran </label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" readonly   id="tahunpendaftarn" value="<?=date("Y")?>/<?=date("Y")+1?>">
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-6 noregistrasi ">
                            No Registrasi : xxxx/xxxx/xx098
                        </div>
                        </div>
                        <br />
                        <br />
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="usr" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" required="" name="nama" class="form-control" id="nama">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                        
                        
                            <div class="form-group">
                                <label for="usr" class="col-sm-2 col-form-label">Tempat Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <div class="col-lg-6" style="padding-left: 0px;">
                                        <input type="text" class="form-control" required=""  name="tempatlahir" id="tempatlahir">
                                    </div>
                                    <div class="col-lg-6" style="padding-right:0px;">
                                        <i class="fa fa-calendar" aria-hidden="true"  style="position: absolute; top: 10px; left: 24px;"></i>

                                        <input type="text" class="form-control datepicker"  required=""  name="tanggallahir" id="tanggallahir" style="padding-left: 30px;">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required="" name="alamat" id="alamat">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="kelurahan" class="col-sm-2 col-form-label">Kelurahan </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  required="" name="kelurahan" id="kelurahan">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required="" name="kecamatan" id="kecamatan">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="kota" class="col-sm-2 col-form-label">Kota </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required="" name="kota" id="kota">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="jeniskelamin" class="col-sm-2 col-form-label">Jenis Kelamin </label>
                                <div class="col-sm-10">
                                    <label class="checkbox-inline" style="padding-left: 0px;"><input type="radio" name="jeniskelamin" required="" value="Laki-laki">&nbsp;Laki-laki</label>
                                    <label class="checkbox-inline"><input type="radio" name="jeniskelamin" required="" value="Perempuan">&nbsp;Perempuan</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="asalsekolah" class="col-sm-2 col-form-label">Asal Sekolah </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required="" name="asalsekolah" id="asalsekolah">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="tahunkelulusan" class="col-sm-2 col-form-label">Tahun Kelulusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required="" name="tahunkelulusan" id="asalsekolah">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="telp" class="col-sm-2 col-form-label">Telp rumah / No. Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" required="" name="telp" id="telp">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="telp" class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="telp" class="col-sm-2 col-form-label">Orang Tua Wali</label>
                                <div class="col-sm-10">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px; padding-right: 0px;">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="nama_bapak" class="col-sm-4 col-form-label">Bapak</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="nama_bapak" id="nama_bapak">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="pekerjaan_bapak" class="col-sm-4 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="pekerjaan_bapak" id="pekerjaan_bapak">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px; padding-right: 0px;">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-sm-4 col-form-label">Ibu</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="nama_ibu" id="nama_ibu">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label for="pekerjaan_ibu" class="col-sm-4 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="pekerjaan_ibu" id="pekerjaan_ibu">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="margin-top:60px;">
                            Dengan ini mendaftarkan diri sebagai calon siswa/i SMA AL MAZAYA ISLAMIC SCHOOL BANJARMASIN dan telah menyetujui persyaratan dan peraturan yang berlaku di sekolah ini.
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px; padding-right: 0px;">
                            <div class="col-lg-3" style="margin-top:60px;">
                                Tertanda,<br />
                                <input type="text" class="form-control" required="" name="tertanda" id="tertanda">
                            </div>
                        </div>
                        <div class="col-lg-12" style="margin-top:60px; text-align: center;">
                            <a href="javascript:;"><img src="<?=base_url("assets/img/simpan.png")?>" /></a>
                            <input type="submit" name="submit" value="submit" />
                        </div>
                    </form>
                </div>
                <?php
            }else{
                ?>
                
                <?php
            }
        }else{
            ?>
                <h2 class="text-center"><img src="<?=base_url("assets/img/about-icon.png")?>" /> ABOUT AL-MAZAYA</h2>
                <div class="row">
                  <div class="col-lg-12 ml-auto">
                    <?=$isicontent?>
                  </div>
                  
                </div>
            <?php
        }
        ?>
      
        
      </div>
    </section>
    <section id="segmentasi" class="segmentasi content">
        <div class="container">
            <div class="row">
            <div class="col-sm-12">
                <ul class="segmentasi-list">
                
                    <?php
                        foreach ($about_detail as $lv){
                            ?>
                            <li style="width: 33.33333%;">
                            <a data-id="<?=$lv["title"]?>" href="javascript:;" rel="<?=$lv["id"]?>">
                                <div class="imageicon">                  
                                    <img src="<?=base_url("uploads/about_detail/".$lv["pic2"])?>" />
                                </div>       
                                <div class="titlesegments">  
                                    <?=$lv["title"]?> 
                                </div>
                            </a>
                            </li>
                            <?php
                        }
                    ?>
                </ul>
                <?php
                foreach ($about_detail as $lv2){
                    ?>
                    <div class="segment1 class-<?=$lv2["id"]?>">
                        
                        <div class="desc_header">
                            <?=$lv2["description"]?> 
                        </div>
                    
                    </div>
                    
                    
                    
                    
                    <?php
                }
                ?>
                
            </div>
        </div>
    </section>
  <script>
  $( function() {
    $('.datepicker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'dd-mm-yy'
    });
    
  } );
  </script>
<?php $this->load->view('sources/footer.php')?>