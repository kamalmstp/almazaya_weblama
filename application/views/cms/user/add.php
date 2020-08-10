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
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['username']) AND $status['form']['username'] != ""){
                    $valueusername = $status['form']['username'];
                  }else{
                    $valueusername = '';
                  }
                  ?>
                  <label for="cname" class="control-label col-lg-3">Username (*)</label>
                  <div class="col-lg-9">
                    <input class=" form-control" placeholder="Enter your username" value="<?=$valueusername?>" id="cname" name="username" minlength="2" type="text" required />
                  </div>
                </div>
                <div class="form-group ">
                  <label for="cpass" class="control-label col-lg-3">Password (*)</label>
                  <div class="col-lg-9">
                    <input class="form-control " id="cpass" type="password" name="password" required />
                  </div>
                </div>
                <div class="form-group ">
                  <label for="crepass" class="control-label col-lg-3">Re-Password (*)</label>
                  <div class="col-lg-9">
                    <input class="form-control " id="crepass" type="password" name="repassword" />
                  </div>
                </div>
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['fullname']) AND $status['form']['fullname'] != ""){
                    $valuefullname = $status['form']['fullname'];
                  }else{
                    $valuefullname = '';
                  }
                  ?>
                  <label for="cfull" class="control-label col-lg-3">Fullname (*)</label>
                  <div class="col-lg-9">
                    <input class="form-control " id="cfull" type="text" name="fullname" placeholder="Enter your fullname" value="<?=$valuefullname?>"/>
                  </div>
                </div>
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['iddivisi']) AND $status['form']['iddivisi'] != ""){
                    $selectdivisi = $status['form']['iddivisi'];
                  }else{
                    $selectdivisi = '';
                  }
                  ?>
                  <label for="cdiv" class="control-label col-lg-3">Divisi (*)</label>
                  <div class="col-lg-9">
                    <select name="iddivisi" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                      <option value=''>Choose Divisi</option>
                      <?php
                      foreach ($rec as $row) {
                        if ($row['id'] == $selectdivisi) {
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
                  <div class="col-lg-offset-2 col-lg-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a href="<?=base_url('webadmin/user')?>" class="btn btn-default" type="button">Cancel</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>