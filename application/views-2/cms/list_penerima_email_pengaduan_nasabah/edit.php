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
                  <?php
                  if(isset($status['form']['name']) AND $status['form']['name'] != ""){
                    $valuename = $status['form']['name'];
                  }else{
                    $valuename = $rec['name'];
                  }
                  ?>
                  <label for="name">Name (*)</label>
                  <input class=" form-control" placeholder="Enter your name" value="<?=$valuename?>" id="name" name="name" minlength="2" type="text" />
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['email']) AND $status['form']['email'] != ""){
                        $valueemail = $status['form']['email'];
                      }else{
                        $valueemail = $rec['email'];
                      }
                      ?>
                      <label for="email">Email (*)</label>
                      <input class=" form-control" value="<?=$valueemail?>" id="email" name="email" type="email" />
                    </div>
                  </div>
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