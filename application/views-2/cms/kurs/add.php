<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<style>
.body{
    width: 100% !important;
}
</style>
<div class="page-heading">
    <h3>
        Kurs &raquo; Add
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Root</a>
        </li>
        <li class="active">
            <a href="<?=base_url("webadmin/".$url_module)?>">Kurs</a>
        </li>
        <li class="active">
            <a href="javascript:;">Add Kurs</a>
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
        
       
        <section class="panel">
          <header class="panel-heading">
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <input name="form" type="hidden" value="1">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                
                <label for="exampleInputEmail1">Mata Uang (*)</label>
                <input class="input-title-key form-control" name="mata_uang" type="text" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Indicative Special Rate Jual (*)</label>
                <input class="input-title-key form-control" name="indicative_special_rate_jual" type="text" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Indicative Special Rate Beli (*)</label>
                <input class="input-title-key form-control" name="indicative_special_rate_beli" type="text" />
              </div>
              <hr />
              <div class="form-group">
                <label for="exampleInputEmail1">TTCounter Jual (*)</label>
                <input class="input-title-key form-control" name="ttcounter_jual" type="text" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">TTCounter Beli (*)</label>
                <input class="input-title-key form-control" name="ttcounter_beli" type="text" />
              </div>
              <hr />
              <div class="form-group">
                <label for="exampleInputEmail1">Bank Notes Jual (*)</label>
                <input class="input-title-key form-control" name="bank_notes_jual" type="text" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Bank Notes Beli (*)</label>
                <input class="input-title-key form-control" name="bank_notes_beli" type="text" />
              </div>
            </div>
            </div>
          </div>
        </section>
        
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
    force_p_newlines : true,
    force_br_newlines : true,
    convert_newlines_to_brs : false,
    remove_linebreaks : true,    
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