<div class="page-heading">
    <h3><?=$titlePage?> &raquo; Edit
    </h3>
    <ul class="breadcrumb">
       <li>
            <a href="#">Root</a>
        </li>
        <li class="active">
            <a href="<?=base_url($selfUrl)?>"><?=$titlePage?></a>
        </li>
        <li class="active">
            <a href="javascript:;">Edit Promotion</a>
        </li>
    </ul>
</div>

<div class="wrapper">
  <div class="row">
    <div class="col-lg-12">
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
    
    
        <form role="form" class="cmxform" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
            <input name="form" type="hidden" value="1">
            
            <?php 
            $r = 0;
            foreach ($lang as $rowlang): ?>
            <input name="id[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
            <input name="oldpic<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['pic']?>">
            <input name="oldthumb<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['thumb']?>">
            <section class="panel">
            <header class="panel-heading">
                <?=$rowlang['title']?>
                <span class="tools pull-right"><a class="fa fa-chevron-down" href="javascript:;"></a></span>
            </header>
            <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
            <div class="panel-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <?php
                        if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                          $valuetitle = $status['form']['title'][$rowlang['id']];
                        }else{
                          $valuetitle = $rec[$r]['title'];
                        }
                        ?>
                        <label for="exampleInputEmail1">Title (*)</label>
                        <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" required />
                    </div>
                    <div class="form-group col-md-12">
                        <?php
                        if(isset($status['form']['description'][$rowlang['id']]) AND $status['form']['description'][$rowlang['id']] != ""){
                          $valuecontent = $status['form']['content'][$rowlang['id']];
                        }else{
                          $valuecontent = $rec[$r]['description'];
                        }
                        ?>
                        <label for="exampleInputEmail1">Content</label>
                        <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                    </div>
                    <div class="form-group">
                      <div class="col-md-offset-2 col-md-8 lebarwidth">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                          <div class="fileupload-new thumbnail" style="width: 325px; height: 254px;">
                            <?php if ($rec[$r]['pic'] != ""): ?>
                            <img src="<?=base_url('assets/images/'.$page.'/'.$rec[$r]['pic'])?>" alt=""/>
                            <?php else: ?>
                            <img src="http://www.placehold.it/325x254/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
                        <span class="label label-danger ">Suggestion!</span>
                        <span>Witdh : 500px - Height : 390px</span>
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
                <a href="<?=base_url('webadmin/pages')?>" class="btn btn-default" type="button">Cancel</a>
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