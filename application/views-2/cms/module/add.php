

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
                  if(isset($status['form']['title']) AND $status['form']['title'] != ""){
                    $valuetitle = $status['form']['title'];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                  <label for="title">Title Module (*)</label>
                  <input class=" form-control" placeholder="Enter your title" value="<?=$valuetitle?>" id="title" name="title" minlength="2" type="text" />
                </div>
                <div class="row form-group">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['controller']) AND $status['form']['controller'] != ""){
                        $valuecontroller = $status['form']['controller'];
                      }else{
                        $valuecontroller = '';
                      }
                      ?>
                      <label for="controller">Controller File (*)</label>
                      <input class="form-control" value="<?=$valuecontroller?>" id="controller" name="controller" type="text" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['type']) AND $status['form']['type'] != ""){
                        $valuetype = $status['form']['type'];
                      }else{
                        $valuetype = '';
                      }
                      ?>
                      <label for="type">Module Type (*)</label>
                      <input class="form-control" value="<?=$valuetype?>" id="type" name="type" type="text" />
                    </div>
                  </div>
                  
                </div>
                <div class="row form-group">
                  <div class="col-md-12">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['controller_be']) AND $status['form']['controller_be'] != ""){
                        $valuecontroller = $status['form']['controller_be'];
                      }else{
                        $valuecontroller = '';
                      }
                      ?>
                      <label for="controller">Controller File Backend(*)</label>
                      <input class="form-control" value="<?=$valuecontroller?>" id="controller_be" name="controller_be" type="text" />
                    </div>
                  </div>
                
                  
                </div>
              </div>
              <div class="col-lg-12" style="margin-top:20px;">
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <a href="<?=base_url('webadmin/module')?>" class="btn btn-default" type="button">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>