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
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['idmodule']) AND $status['form']['idmodule'] != ""){
                    $selectidmodule = $status['form']['idmodule'];
                  }else{
                    $selectidmodule = $rec[0]['idmodule'];
                  }
                  //echo $selectidmodule;
                  ?>
                  <label for="exampleInputEmail1">Module (*)</label>  
                  <select name="idmodule" class="form-control" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Module</option>
                      <?php
                      foreach ($module as $row) {
                        if ($row['id'] == $selectidmodule) {
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
                    $selectidparent = $rec[0]['parent'];
                  }
                  //echo $selectidparent;
                  ?>
                  <label for="exampleInputEmail1">Menu Parent (*)</label>  
                  <select name="idparent" class="form-control" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Parent</option>
                      <option value='0' <?=($selectidparent == '0') ? "selected" : "" ;?>>Root Menu</option>
                      <?php
                      foreach ($menuparent as $row) {
                        if ($row['id'] == $selectidparent) {
                          $select = "selected";
                        } else {
                          $select = "";
                        }
                      ?>
                      <option <?=$select?> value="<?=$row['sister']?>"><?=$row['title']?></option>
                      <?=$controller->_getSubPagesEdit($row['sister'],"--",$rec[0]["parent"])?>
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
                    $selectidparent = $rec[0]['parent'];
                  }
                  //echo $selectidparent;
                  ?>
                  <label for="exampleInputEmail1">Use Sidebar (*)</label>  
                  <select name="sidebar" class="form-control" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Parent</option>
                      
                  </select>
                </div>
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['hide_in_menu']) AND $status['form']['hide_in_menu'] != ""){
                    $selectidparent = $status['form']['hide_in_menu'];
                  }else{
                    $selectidparent = $rec[0]['hide_in_menu'];
                  }
                  //echo $selectidparent;
                  ?>
                  <label for="exampleInputEmail1">Hide in menu (*)</label>  
                  <select name="hide_in_menu" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                    <option value=''>Hide in menu ?</option>
                      <option value='1' <?=($selectidparent == '1') ? "selected" : "" ;?>>Yes</option>
                      <option value='0' <?=($selectidparent == '0') ? "selected" : "" ;?>>No</option>
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
      <input name="id[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
      <input name="oldpic<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['pic']?>">
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
                    $valuetitle = $rec[$r]['title'];
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
                    $valuesubtitle = $rec[$r]['subtitle'];
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
                    $valuelink = $rec[$r]['link'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Link URL</label>
                  <div class="input-group m-bot15">
                    <span class="input-group-addon group-addon-mod">yoursite.com/</span>
                    <input type="text" id="input-link-key<?=$rowlang['id']?>" class="form-control" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]">
                  </div>
                </div>
                <?php
                if ($rec[0]['idmodule'] == 1) {
                  $showdefault = 'style="display:block"';
                }else{
                  $showdefault = '';
                }
                ?>  
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-8 lebarwidth">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail fileupload-preview" style="height: auto; line-height: 20px;">
                          <?php if ($rec[$r]['pic'] != ""): ?>
                          <img src="<?=base_url('uploads/pages/'.$rec[$r]['pic'])?>" alt=""/>
                          <?php else: ?>
                          <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                          <?php endif ?>
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
                      $valuecontent = $rec[$r]['content'];
                    }
                    ?>
                    <label for="exampleInputEmail1">Content</label>
                    <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                  </div>
                  <h2 style="margin-left:-15px;margin-right:-15px;">Meta</h2>
                  <div class="form-group">
                  <?php
                  if(isset($status['form']['metatitle'][$rowlang['id']]) AND $status['form']['metatitle'][$rowlang['id']] != ""){
                    $valuemetatitle = $status['form']['metatitle'][$rowlang['id']];
                  }else{
                    $valuemetatitle = $rec[$r]['meta_title'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Title </label>
                  <input lang="<?=$rowlang['id']?>" class="form-control" placeholder="Enter your title" value="<?=$valuemetatitle?>" name="metatitle[<?=$rowlang['id']?>]"  type="text" />
                </div>
                
                <div class="form-group">
                  <?php
                  if(isset($status['form']['metadescription'][$rowlang['id']]) AND $status['form']['metadescription'][$rowlang['id']] != ""){
                    $valuemetadescription = $status['form']['metadescription'][$rowlang['id']];
                  }else{
                    $valuemetadescription = $rec[$r]['meta_description'];
                  }
                  ?>
                  <label for="exampleInputEmail1" style="width: 100%;">Description </label>
                  <textarea class="form-control" name="metadescription[<?=$rowlang['id']?>]"><?=$valuemetadescription?></textarea>
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
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
    ],
    relative_urls: false,
    remove_script_host: false,
    content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic underline | blockquote hr | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor fontsizeselect | pastetext removeformat charmap | table | code",
    forced_root_block : 'p'
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
    
    $('.input-title-key').keyup(function(){
      var title = $(this).val();
      var lang = $(this).attr('lang');
      var title = title.replace(/\s+/g, '-');
      var title = title.replace('&', '');
      var title = title.replace('?', '');
      var title = title.toLowerCase();
      $('#input-link-key'+lang).val(title);
    });
  });
</script>