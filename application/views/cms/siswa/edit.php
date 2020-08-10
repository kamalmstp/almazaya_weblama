<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<div class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <form role="form" class="cmxform" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
        <section class="panel">
          <div class="panel-body">
            <?php
            if (isset($status)) {
             if ($status['success'] == true) {
            ?>
              <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Success!</strong> Data has been saved!
              </div>
            <?php
              } else {
            ?>
              <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> Data not saved. Please check field.
                <ul>
                  <?=$status['notice']?>
                </ul>
              </div>
              <?php
              }
            }
            ?>
            <input name="form" type="hidden" value="1">
            
          </div>
        </section>
        <?php 
        $r = 0;
        foreach ($lang as $rowlang): ?>
        <input name="id[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
        <input name="oldpic<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['pic']?>">
        <input name="oldthumb<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['thumb']?>">
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-md-8">
                <?php
                if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                  $valuetitle = $status['form']['title'][$rowlang['id']];
                }else{
                  $valuetitle = $rec[$r]['title'];
                }
                ?>
                <label for="exampleInputEmail1">Nama (*)</label>
                <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" />
              </div>
              <div class="form-group col-md-8">
                <?php
                if(isset($status['form']['oleh'][$rowlang['id']]) AND $status['form']['oleh'][$rowlang['id']] != ""){
                  $valueoleh = $status['form']['oleh'][$rowlang['id']];
                }else{
                  $valueoleh = '';
                }
                ?>
                <label for="exampleInputEmail1">Jenis Kelamin (*)</label>
                
                <select  lang="<?=$rowlang['id']?>" name="jenis_kelamin[<?=$rowlang['id']?>]" class="form-control" data-placeholder="Pilih Jenis Kelamin">
                    <option value=''>-- Pilih Jenis Kelamin --</option>
                    
                    
                      <option value="Laki-laki" <?php if ($rec[$r]['jenis_kelamin'] == "Laki-laki"){ echo "selected=\"selected\""; }?>>Laki-laki</option>
                      <option value="Perempuan" <?php if ($rec[$r]['jenis_kelamin'] == "Perempuan"){ echo "selected=\"selected\""; }?>>Perempuan</option>
                  </select>
              </div>
              <div class="col-md-12" style="padding: 0px !important;">
                  <div class="form-group col-md-4">
                    <?php
                    if(isset($status['form']['tempat_lahir'][$rowlang['id']]) AND $status['form']['tempat_lahir'][$rowlang['id']] != ""){
                      $valuetempat_lahir = $status['form']['tempat_lahir'][$rowlang['id']];
                    }else{
                      $valuetempat_lahir = $rec[$r]['tempat_lahir'];
                    }
                    ?>
                    <label for="exampleInputEmail1">Tempat Lahir (*)</label>
                    <input lang="<?=$rowlang['id']?>" class="input-tempat-lahir-key form-control" placeholder="Tempat Lahir" value="<?=$valuetempat_lahir?>" name="tempat_lahir[<?=$rowlang['id']?>]" type="text" />
                  </div>
                  <div class="form-group col-md-4">
                    <?php
                    if(isset($status['form']['tgl_lahir'][$rowlang['id']]) AND $status['form']['tgl_lahir'][$rowlang['id']] != ""){
                      $valuetgl_lahir = $status['form']['tgl_lahir'][$rowlang['id']];
                    }else{
                        $valuetgl_lahir = explode("-",$rec[$r]['tanggal_lahir']);
                      $valuetgl_lahir = $valuetgl_lahir[2]."-".$valuetgl_lahir[1]."-".$valuetgl_lahir[0];
                    }
                    ?>
                    <label for="exampleInputEmail1">Tanggal Lahir (*)</label>
                    <input lang="<?=$rowlang['id']?>" class="input-tgl-key datepicker form-control" placeholder="Tanggal Lahir" value="<?=$valuetgl_lahir?>" name="tgl_lahir[<?=$rowlang['id']?>]" type="text" />
                  </div>
                </div>
                <div class="col-md-12" style="padding: 0px !important;">
                  <div class="form-group col-md-4">
                    <?php
                    if(isset($status['form']['ayah'][$rowlang['id']]) AND $status['form']['ayah'][$rowlang['id']] != ""){
                      $valueayah = $status['form']['ayah'][$rowlang['id']];
                    }else{
                      $valueayah = $rec[$r]['ayah'];
                    }
                    ?>
                    <label for="exampleInputEmail1">Nama Ayah (*)</label>
                    <input lang="<?=$rowlang['id']?>" class="input-nama-ayah-key form-control" placeholder="Nama Ayah" value="<?=$valueayah?>" name="ayah[<?=$rowlang['id']?>]" type="text" />
                  </div>
                  <div class="form-group col-md-4">
                    <?php
                    if(isset($status['form']['ibu'][$rowlang['id']]) AND $status['form']['ibu'][$rowlang['id']] != ""){
                      $valueibu = $status['form']['ibu'][$rowlang['id']];
                    }else{
                      $valueibu = $rec[$r]['ibu'];
                    }
                    ?>
                    <label for="exampleInputEmail1">Nama Ibu (*)</label>
                    <input lang="<?=$rowlang['id']?>" class="input-nama-ibu-key form-control" placeholder="Nama Ibu" value="<?=$valueibu?>" name="ibu[<?=$rowlang['id']?>]" type="text" />
                  </div>
                </div>
              <div class="form-group col-md-12">
                  <?php
                  if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                    $valuelink = $status['form']['link'][$rowlang['id']];
                  }else{
                    $valuelink = $rec[$r]['link'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Link URL</label>
                  <div class="input-group m-bot15">
                  <?php
                  $code_bahasa = "";
                  $cat = "kategori";
                    if ($rowlang["use_default"] != 1){
                        $code_bahasa = $rowlang['lang_code'] . "/";
                        $cat = "category";
                    }
                  ?>
                    <span class="input-group-addon group-addon-mod"><?=base_url()?><?=$code_bahasa?></span>
                    <input type="text" id="input-link-key<?=$rowlang['id']?>" class="form-control" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]">
                  </div>
                </div>  
            
               <div class="form-group col-md-12">
                <?php
                if(isset($status['form']['description'][$rowlang['id']]) AND $status['form']['description'][$rowlang['id']] != ""){
                  $valuedescription = $status['form']['description'][$rowlang['id']];
                }else{
                  $valuedescription = $rec[$r]['description'];
                }
                ?>
                <label for="exampleInputEmail1">Description</label>
                <textarea class="texttiny" name="description[<?=$rowlang['id']?>]" class="form-control" ><?=$valuedescription?></textarea>
              </div>
              <div class="form-group">
                <div class="col-md-offset-3 col-md-6 lebarwidth">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail">
                    
                    <?php
                    if($rec[$r]['pic'] != ""){
                    ?>
                    <img src="<?=base_url("uploads/siswa/resize/".$rec[$r]['pic'])?>" alt="" />
                    <?php
                    }else{
                    ?>
                    <img src="<?=base_url("assets/backend/no-image.png")?>" alt="" />
                    <?php
                    }
                    ?>
                        
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                    <div>
                      <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" name="pic<?=$rowlang['id']?>" />
                        <input type="hidden" name="oldpic[<?=$rowlang['id']?>]" value="<?=$rec[$r]["pic"]?>" />
                      </span>
                      <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                    </div>
                  </div>
                  <br/>
                  <span class="label label-danger ">NOTE!</span>
                  <span>Use image with width = 900px AND height = 655px</span>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php 

        $r++;
        endforeach ?>
        <section class="panel">
          <!-- <header class="panel-heading">
            Buttons
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-lg-12">
                <button class="btn btn-info" name='draft' value="draft">Save as Draft</button>
                <button class="btn btn-success" name='publish' value="publish">Publish</button>
                <a href="<?=base_url('webadmin/'.$url_module)?>" class="btn btn-default" type="button">Cancel</a>
              </div>
            </div>
          </div>
        </section>
      </form>
    </div>
  </div>
</div>

<!--icheck -->
<script src="<?=base_url('assets/backend/js/iCheck/jquery.icheck.js')?>"></script>
<script src="<?=base_url('assets/backend/js/icheck-init.js')?>"></script>
<script src="<?=base_url('assets/backend/js/tinymce/tinymce.min.js')?>"></script>
    
<script type="text/javascript">
  tinymce.init({
    selector: ".texttiny",
    forced_root_block : 'p',
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
    ],
    relative_urls: false,
    remove_script_host: false,
    content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic underline | blockquote hr | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor fontsizeselect | pastetext removeformat charmap | table | code"
  });
</script>
<script>
    $(function() {
        var lebihdiv = $('.lebarwidth').width();
        $('.fileinput-preview').css('max-width',lebihdiv);
        
        $('.input-title-key').blur(function(){
            
            var lang = $(this).attr('lang');
            if ($(this).val() != ""){
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("cek_slug")?>',
                    //data: { 'a': 1, 'b': 2, 'c': 3 },
                    dataType: 'html',
                    async:false,
                    data: { 'lang': $(this).attr("lang"),'title': $(this).val(),'table': 'pengumuman'},
                    beforeSend: function () {
                        $("#input-link-key" + lang).val("Loading...");
                    },
                    success: function (xml) {
                        $("#input-link-key" + lang).val(xml);
                    }
                });
            }
        });
    });
  $(function() {
    var lebihdiv = $('.lebarwidth').width();
    $('.fileinput-preview').css('max-width',lebihdiv);
  });
</script>