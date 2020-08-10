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
              <div class="col-lg-8">
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title']) AND $status['form']['title'] != ""){
                    $valuetitle = $status['form']['title'];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                  <label for="title">Title Language (*)</label>
                  <input class=" form-control" placeholder="Enter your title" value="<?=$valuetitle?>" id="title" name="title" minlength="2" type="text" />
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['lang']) AND $status['form']['lang'] != ""){
                        $valuelang = $status['form']['lang'];
                      }else{
                        $valuelang = '';
                      }
                      ?>
                      <label for="lang">Language Code (*)</label>
                      <input class=" form-control" value="<?=$valuelang?>" id="lang" name="lang" type="text" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4" style="text-align: center">
                <div class="col-lg-12">
                  <div class="form-group last">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;">
                        <img src="http://www.placehold.it/150x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-info btn-file">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="pic" />
                        </span>
                        <a href="#" style="margin-left:5px" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12" style="margin-top:20px;">
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <a href="<?=base_url('webadmin/language')?>" class="btn btn-default" type="button">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>