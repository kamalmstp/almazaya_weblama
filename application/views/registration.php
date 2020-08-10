<?php $this->load->view('sources/header.php')?>
<!-- About Section -->
    <section id="about">
      <div class="container">
                <div class="pendaftaran">
                    <h4>FORMULIR PENDAFTARAN SISWA BARU</h4>
                    <h2 style="margin-bottom: 80px;">ALMAZAYA BANJARMASIN</h2>
                    <?php
                    if (isset($_GET["id"])){
                    ?>
                    <div class="alert alert-success">
                      <strong>Selamat!</strong> Form pendaftaran anda sudah kami terima, silahkan tunggu konfirmasi dari Al-Mazaya Islamic School
                    </div>
                    <?php
                    }else{
                    ?>
                    <form action=""  class="form-horizontal" method="POST"  role="form">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="usr" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                <div class="col-sm-2">
                                    <input type="text" required="" name="awal" class="form-control justnumber" id="awal" placeholder="<?=date("Y")?>">
                                </div>
                                <div class="col-sm-1" style="font-size: 24px; text-align: center; width: 39px;">/</div>
                                <div class="col-sm-2">
                                    <input type="text" required="" name="akhir" class="form-control justnumber" id="akhir" placeholder="<?=date("Y")+1?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="usr" class="col-sm-2 col-form-label">Jenjang Pendidikan</label>
                                <div class="col-sm-10">
                                    <select name="jenjang" class="form-control" required>
                                        <option>-- Pilih Jenjang Pendidikan --</option>
                                        <option value="SMA">SMA</option>
                                        <option value="SMP">SMP</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                    <div class="col-lg-6 tempatlahir_col" style="padding-left: 0px;">
                                        <input type="text" class="form-control" required=""  name="tempatlahir" id="tempatlahir">
                                    </div>
                                    <div class="col-lg-6 tanggallahir_col" style="padding-right:0px;">
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
                                    <input type="text" class="form-control justnumber" required="" name="tahunkelulusan" id="asalsekolah">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="telp" class="col-sm-2 col-form-label">Telp rumah / No. Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control justnumber"  required="" name="telp" id="telp">
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
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="nama_bapak" class="col-sm-4 col-form-label">Bapak</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="nama_bapak" id="nama_bapak">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="pekerjaan_bapak" class="col-sm-4 col-form-label">Pekerjaan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="pekerjaan_bapak" id="pekerjaan_bapak">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" style="padding-left: 0px; padding-right: 0px;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="nama_ibu" class="col-sm-4 col-form-label">Ibu</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" required="" name="nama_ibu" id="nama_ibu">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                            <a href="" class="submitreg"><img src="<?=base_url("assets/img/simpan.png")?>" /></a>
                            <input style="display: none;" class="submitreg_submit" type="submit" name="submit" value="submit" />
                        </div>
                    </form>
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
    $(".submitreg").click(function(){
        $(".submitreg_submit").click();
        return false;
    })
  } );
  </script>
<?php $this->load->view('sources/footer.php')?>