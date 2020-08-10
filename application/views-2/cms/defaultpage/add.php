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
            <div class="row">
              <div class="form-group col-lg-12">
                <?php
                if(isset($status['form']['idpages']) AND $status['form']['idpages'] != ""){
                  $selectidpages = $status['form']['idpages'];
                }else{
                  $selectidpages = '';
                }
                //echo $selectidpages;
                ?>
                <label for="exampleInputEmail1">Pages Content (*)</label>  
                <select name="idpages" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                  <option value=''>Choose Pages</option>
                    <?php
                    foreach ($pages as $row) {
                      if ($row['id'] == $selectidpages) {
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
            </div>
          </div>
        </section>
        <?php 
        $r = 0;
        foreach ($lang as $rowlang): ?>
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
              <div class="form-group col-md-6">
                <?php
                if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                  $valuetitle = $status['form']['title'][$rowlang['id']];
                }else{
                  $valuetitle = '';
                }
                ?>
                <label for="exampleInputEmail1">Title Banner (*)</label>
                <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" />
              </div>
              <div class="form-group col-md-6">
                <?php
                if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                  $valuelink = $status['form']['link'][$rowlang['id']];
                }else{
                  $valuelink = '';
                }
                ?>
                <label for="exampleInputEmail1">Link URL</label>
                <input type="text" placeholder="Eg. http://yoursite.com/about-us" id="input-link-key<?=$rowlang['id']?>" class="form-control" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]">
              </div>
              <div class="form-group">
                <div class="col-md-offset-3 col-md-6 lebarwidth">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 400px; height: 200px;">
                        <img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
                  <span class="label label-danger ">NOTE!</span>
                  <span>Attached image thumbnail is</span>
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

<!--icheck -->
<script src="<?=base_url('assets/backend/js/iCheck/jquery.icheck.js')?>"></script>
<script src="<?=base_url('assets/backend/js/icheck-init.js')?>"></script>

<script>
  $(function() {
    var lebihdiv = $('.lebarwidth').width();
    $('.fileinput-preview').css('max-width',lebihdiv);
  });
</script>