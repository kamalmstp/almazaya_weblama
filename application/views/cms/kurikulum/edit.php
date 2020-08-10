<div class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <div class="panel-body">
          <div class=" form">
            <form role="form" class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
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
               
              <div class="col-lg-9">
                <div class="form-group">
                  <label for="exampleInputEmail1">Level</label>
                 <select name="level" id="idmodule" class="form-control m-bot15" data-placeholder="Select level" id="cdiv" required>
                    <option value=''>Choose level</option>
                      <?php
                      foreach ($cat as $row) {
                        $class = "";
                        if ($rec['cat'] == $row['id']){
                            $class= "selected=\"selected\"";
                        }else{
                            $class = "";
                        }
                      ?>
                      <option <?=$class?> value="<?=$row['sister']?>"><?=$row['title']?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['name']) AND $status['form']['name'] != ""){
                    $valuename = $status['form']['name'];
                  }else{
                    $valuename = $rec['title'];
                  }
                  ?>
                  <label for="name">Name (*)</label>
                  <input class=" form-control" placeholder="Enter your name" value="<?=$valuename?>" id="name" name="name" minlength="2" type="text" />
                </div>
                
                <div class="form-group">
                  <?php
                  if(isset($status['form']['description']) AND $status['form']['description'] != ""){
                    $valuedescription = $status['form']['description'];
                  }else{
                    $valuedescription = $rec['description'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Description</label>
                  <textarea class="texttiny" name="description" rows="6"><?=$valuedescription?></textarea>
                </div>
                
              </div>
              <div class="col-lg-12" style="margin-top:20px;">
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <a href="<?=base_url('webadmin/'.$url_module.'')?>" class="btn btn-default" type="button">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
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