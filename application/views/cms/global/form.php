<div class="page-heading">
    <h3><?=$titlePage?> &raquo; <?=(isset($rec) ? 'Edit' : 'Add')?></h3>
    <ul class="breadcrumb">
       <li><a href="#">Root</a></li>
       <li class="active"><a href="<?=base_url($selfUrl)?>"><?=$titlePage?></a></li>
       <li class="active"><a href="javascript:;"><?=(isset($rec) ? 'Edit' : 'Add')?> Promotion</a></li>
    </ul>
</div>
<div class="wrapper">
  <div class="row">
    <div class="col-lg-12">
    
        <?php if (isset($status)) { if ($status['success'] == true) { ?>
            <div class="alert alert-success fade in">
            <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
            <strong>Success!</strong> Data has been saved!
            </div>
        <?php } else { ?>
            <div class="alert alert-block alert-danger fade in">
            <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
            <strong>Error!</strong> Data not saved. Please check field.
            <ul><?=$status['notice']?></ul>
            </div>
        <?php }} ?>
        <form role="form" class="cmxform" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
        
        <?php if(isset($mainOption)) { ?>
        <section class="panel">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group"> 
                    <label for="<?=$mainOption['id']?>"><?=$mainOption['label']?>(*)</label>
                    <select class="form-control" name="<?=$mainOption['id']?>">
                        <option value=""></option>
                        <?php foreach($mainOption['options'] as $opt) { ?>
                        <option value="<?=$opt['val']?>" <?=(isset($rec) && $rec[0][($mainOption['id'])] == $opt['val']) ? 'selected="selected"' : ''?>><?=$opt['label']?></option>
                        <?php } ?>
                    </select>
                </div>
              </div>
             </div>
            </div>  
        </section>
        <?php } ?>
        
        <?php 
        $r = 0;
        foreach ($lang as $rowlang): ?>
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?> <span class="tools pull-right"><a class="fa fa-chevron-down" href="javascript:;"></a></span>
          </header>
          <input name="form" type="hidden" value="1">
          <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-12">
              <?php foreach($form as $f) { 
                $value = (isset($status['form'][($f['id'])][$rowlang['id']]) AND $status['form'][($f['id'])][$rowlang['id']] != "") 
                       ? $status['form'][($f['id'])][$rowlang['id']] 
                       : (isset($rec) && isset($rec[$r][($f['id'])]) ? $rec[$r][($f['id'])] : '');
                if($f['type'] != 'hidden') { ?>
                <div class="form-group">  
                  <label for="<?=$f['id']?>"><?=$f['label']?> (*)</label>
                  <?php if($f['type'] == 'textarea') { ?>
                    <textarea class="texttiny" name="<?=$f['id']?>[<?=$rowlang['id']?>]" rows="6"><?=$value?></textarea>
                  <?php } elseif($f['type'] == 'image') { ?>
                    <div class="col-md-offset-2 col-md-8 lebarwidth">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 325px; height: 254px;">
                        <?php if (isset($rec) && $rec[$r][($f['id'])] != ""): ?>
                        <img src="<?=base_url('assets/images/'.$page.'/'.$rec[$r][$f['id']])?>" alt=""/>
                        <?php else: ?>
                        <img src="http://www.placehold.it/325x254/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif ?>  
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="<?=$f['id']?><?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">Suggestion!</span>
                    <span>Witdh : 500px - Height : 390px</span>
                   </div>  
                   <?php
                   //echo "<pre>";
                   //print_r($rec);
                   ?>
                   <div class="col-md-offset-2 col-md-8 lebarwidth">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 325px; height: 254px;">
                        <?php if (isset($rec) && $rec[$r][($f['id'])] != ""): ?>
                        <img src="<?=base_url('assets/images/'.$page.'/'.$rec[$r][$f['id']])?>" alt=""/>
                        <?php else: ?>
                        <img src="http://www.placehold.it/325x254/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif ?>  
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="<?=$f['id']?><?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">Suggestion!</span>
                    <span>Witdh : 500px - Height : 390px</span>
                   </div>  
                  <?php } else { ?>
                    <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your <?=$f['label']?>" value="<?=$value?>" name="<?=$f['id']?>[<?=$rowlang['id']?>]" minlength="2" type="text" />
                  <?php } ?>
                </div>
              <?php } else { ?> 
              <input lang="<?=$rowlang['id']?>" value="<?=$value?>" name="<?=$f['id']?>[<?=$rowlang['id']?>]" type="hidden" />  
              <?php }} ?>
            </div>
            </div>
          </div>
        </section>
        <?php  $r++; endforeach ?>
        
        <section class="panel">
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-lg-12">
                <button class="btn btn-info" name='draft' value="draft">Save as Draft</button>
                <button class="btn btn-success" name='publish' value="publish">Publish</button>
                <a href="<?=base_url($selfUrl)?>" class="btn btn-default" type="button">Cancel</a>
              </div>
            </div>
          </div>
        </section>
        
      </form>
    </div>
  </div>
</div>


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