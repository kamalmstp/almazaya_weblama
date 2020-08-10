<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<div class="wrapper">
  <div class="row">
    <form role="form" class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
      <div class="col-md-12">
        <section class="panel">
          <div class="panel-body">
            <div class=" form">
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
              <div class="col-lg-12">
                <div class="form-group " style="display: none">
                  <?php
                  if(isset($status['form']['idmodule']) AND $status['form']['idmodule'] != ""){
                    $selectidmodule = $status['form']['idmodule'];
                  }else{
                    $selectidmodule = '';
                  }
                  //echo $selectidmodule;
                  ?>
                  <label for="exampleInputEmail1">Module (*)</label>  
                  <select name="idmodule" id="idmodule" class="form-control" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Module</option>
                      <?php
                      foreach ($module as $row) {
                        if ($row['id'] == 85) {
                          $select = "selected";
                        } else {
                          $select = "";
                        }
                      ?>
                      <option <?=$select?> value="<?=$row['id']?>"><?=$row['title']?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['idparent']) AND $status['form']['idparent'] != ""){
                    $selectidparent = $status['form']['idparent'];
                  }else{
                    $selectidparent = '';
                  }
                  //echo $selectidparent;
                  ?>
                  <label for="exampleInputEmail1">Menu Parent (*)</label>  
                  <select name="idparent" class="form-control" data-placeholder="Select..." id="cdiv">
                      <?php
                      $sister = "";
                      foreach ($menuparent as $row) {
                        if ($row['id'] == $selectidparent) {
                          $select = "selected";
                        } else {
                          $select = "";
                        }
                        if ($sister != ""){
                            $sister = $sister . "," .$row["sister"];
                        }else{
                            $sister = $row["sister"];
                        }
                      ?>
                      <option <?=$select?> value="<?=$row["sister"]?>"><?=$row['title']?></option>
                      <!--<?=$controller->_getSubPages($row['sister'],"--",$sister)?>-->
                      <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="form-group " style="display: none">
                  <?php
                  if(isset($status['form']['idparent']) AND $status['form']['idparent'] != ""){
                    $selectidparent = $status['form']['idparent'];
                  }else{
                    $selectidparent = "";
                  }
                  ?>
                  <label for="exampleInputEmail1">Hide in menu (*)</label>  
                  <select name="hide_in_menu" class="form-control m-bot15" data-placeholder="Select..." id="cdiv" required="required">
                    <option value='0'>No</option>
                        <option value="1">Yes</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php 
      $r = 0;
      foreach ($lang as $rowlang): ?>
      <div class="col-md-12">
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body">
            <div class="form">
              <div class="col-md-12">
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title'][$rowlang['id']];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Title Pages (*)</label>
                  <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" />
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['subtitle'][$rowlang['id']]) AND $status['form']['subtitle'][$rowlang['id']] != ""){
                    $valuesubtitle = $status['form']['subtitle'][$rowlang['id']];
                  }else{
                    $valuesubtitle = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Subtitle</label>
                  <input class="form-control" placeholder="Enter your subtitle" value="<?=$valuesubtitle?>" name="subtitle[<?=$rowlang['id']?>]" minlength="2" type="text" />
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                    $valuelink = $status['form']['link'][$rowlang['id']];
                  }else{
                    $valuelink = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Link URL</label>
                  <div class="input-group m-bot15">
                    <span class="input-group-addon group-addon-mod">yoursite.com/</span>
                    <input type="text" id="input-link-key<?=$rowlang['id']?>" class="form-control" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]">
                  </div>
                </div>  
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-8 lebarwidth">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                            <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                        <div>
                          <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                            <input type="file" class="default" name="pic<?=$rowlang['id']?>" />
                          </span>
                          <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                        </div>
                      </div>
                      <br/>
                      <span class="label label-danger ">Size Suggestion!</span>
                      <span>Width : 1400px - Height : 348px</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <?php
                    if(isset($status['form']['content'][$rowlang['id']]) AND $status['form']['content'][$rowlang['id']] != ""){
                      $valuecontent = $status['form']['content'][$rowlang['id']];
                    }else{
                      $valuecontent = '';
                    }
                    ?>
                    <label for="exampleInputEmail1">Content</label>
                    <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                  </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php 
      $r++;
      endforeach ?>
      <div class="col-md-12">
        <section class="panel">
          <!-- <header class="panel-heading">
            Buttons
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group col-lg-12">
                  <button class="btn btn-info" name='draft' value="draft">Save as Draft</button>
                  <button class="btn btn-success" name='publish' value="publish">Publish</button>
                  <a href="<?=base_url('webadmin/pages')?>" class="btn btn-default" type="button">Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </form>
  </div>
</div>
<!--icheck -->
<script src="<?=base_url('assets/backend/js/iCheck/jquery.icheck.js')?>"></script>
<script src="<?=base_url('assets/backend/js/icheck-init.js')?>"></script>
<script src="<?=base_url('assets/backend/js/tinymce/tinymce.min.js')?>"></script>
<script type="text/javascript">
  tinymce.init({
    selector: ".texttiny",
    forced_root_block : 'div',
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
    $( "#idmodule" ).change(function() {
      value = $(this).val();
      if(value==1){
        $('.default-page').show();
      }else{
        $('.default-page').hide();
      }
    });
    var lebihdiv = $('.lebarwidth').width();
    $('.fileinput-preview').css('max-width',lebihdiv);
    /*$('.input-title-key').keyup(function(){
      var title = $(this).val();
      var lang = $(this).attr('lang');
      var title = title.replace(/\s+/g, '-');
      var title = title.replace('&', '');
      var title = title.replace('?', '');
      var title = title.toLowerCase();
      $('#input-link-key'+lang).val(title);
    });*/
    $('.input-title-key').blur(function(){
        $(".group-addon-mod").text("Loading...");
        var teksnya = $(".group-addon-mod").text();
        var lang = $(this).attr('lang');
        $.ajax({
            type: "POST",
            url: '<?=base_url("cek_slug")?>',
            //data: { 'a': 1, 'b': 2, 'c': 3 },
            dataType: 'html',
            data: { 'lang': $(this).attr("lang"),'title': $(this).val(),'table': 'pages'},
            success: function (xml) {
                $(".group-addon-mod").text("yoursite.com");
                $("#input-link-key" + lang).val(xml);
            }
        });
    });
  });
</script>