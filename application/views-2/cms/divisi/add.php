<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/js/ios-switch/switchery.css')?>" />
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/blue.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/red.css')?>" rel="stylesheet">
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
              <div class="col-lg-12">
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['title']) AND $status['form']['title'] != ""){
                    $valuetitle = $status['form']['title'];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                  <label for="ctitle" class="control-label col-lg-2">Title Divisi (*)</label>
                  <div class="col-lg-10">
                    <input class=" form-control" placeholder="Title Divisi" value="<?=$valuetitle?>" id="ctitle" name="title" minlength="2" type="text" />
                  </div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <div class="wrap-btn-check col-md-12">
                      <button type="button" class="check-all btn btn-primary">Check All</button>
                      <button type="button" class="uncheck-all btn btn-success">Uncheck All</button>
                    </div>
                    <div class="panel-body">
                      <table class="table">
                        <thead>
                        <tr>
                          <th style="width:50px;text-align:center">
                             #
                          </th>
                          <th style="text-align:center">
                             Menu Title
                          </th>
                          <th style="width:375px;text-align:center">
                             Action
                          </th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php
                          $urut = 0;
                          foreach ($rec as $row) {
                          ?>
                          <tr>
                            <td style="width:50px;text-align:center"><strong><?=$row['posisi']?></strong></td>
                            <td><strong><?=$row['title']?></strong></td>
                            <td>
                              <?php

                              if(isset($status['form']['view']) AND $status['form']['view'] != ''){
                                $accview = $status['form']['view'];
                              }else{
                                $accview = '';
                              }
                              if(isset($status['form']['add']) AND $status['form']['add'] != ''){
                                $accadd = $status['form']['add'];
                              }else{
                                $accadd = '';
                              }
                              if(isset($status['form']['update']) AND $status['form']['update'] != ''){
                                $accupdate = $status['form']['update'];
                              }else{
                                $accupdate = '';
                              }
                              if(isset($status['form']['delete']) AND $status['form']['delete'] != ''){
                                $accdelete = $status['form']['delete'];
                              }else{
                                $accdelete = '';
                              }
                              if(isset($status['form']['hide']) AND $status['form']['hide'] != ''){
                                $acchide = $status['form']['hide'];
                              }else{
                                $acchide = '';
                              }
                              ?>
                              <div class="icheck ">
                                <div class="flat-green">
                                  <div class="radio">
                                    <input type="checkbox"
                                  <?php
                                    
                                    $ischeck = explode(';',$accview);
                                    if (in_array($row['id'], $ischeck)) {
                                      $check = "checked";
                                    }else{
                                      $check = "";
                                    }
                                    
                                  ?>
                                  value="1" name="accview[<?=$row['id']?>]" id="view<?=$row['id']?>" class="md-check view-check" lang="<?=$row['id']?>" <?=$check?>>
                                  <label for="view<?=$row['id']?>">View</label>
                                  </div>
                                </div>
                                <?php
                                //$akses = $row['akses'];
                                $akses = strpos($row['akses'], '1');

                                if ($akses !== false) {
                                ?>
                                <div class="flat-blue">
                                  <div class="radio">
                                    <input type="checkbox"
                                  <?php
                                    $ischeckadd = explode(';',$accadd);
                                    if (in_array($row['id'], $ischeckadd)) {
                                      $check = "checked";
                                    }else{
                                      $check = "";
                                    }
                                  ?>
                                  value="1" name="accadd[<?=$row['id']?>]" id="add<?=$row['id']?>" class="md-check add-check" lang="<?=$row['id']?>" <?=$check?>>
                                  <label for="add<?=$row['id']?>">Add</label>
                                  </div>
                                </div>
                                <?php 
                                }
                                $akses = strpos($row['akses'], '2');
                                if ($akses !== false) {
                                ?>
                                <div class="flat-blue">
                                  <div class="radio">
                                    <input type="checkbox"
                                  <?php
                                    $ischeckupdate = explode(';',$accupdate);
                                    if (in_array($row['id'], $ischeckupdate)) {
                                      $check = "checked";
                                    }else{
                                      $check = "";
                                    }
                                  ?>
                                  value="1" name="accupdate[<?=$row['id']?>]" id="update<?=$row['id']?>" class="md-check update-check" lang="<?=$row['id']?>" <?=$check?>>
                                  <label for="update<?=$row['id']?>">Update</label>
                                  </div>
                                </div>
                                <?php 
                                }
                                $akses = strpos($row['akses'], '3');
                                if ($akses !== false) {
                                ?>
                                <div class="flat-red">
                                  <div class="radio">
                                    <input type="checkbox"
                                  <?php
                                    $ischeckdelete = explode(';',$accdelete);
                                    if (in_array($row['id'], $ischeckdelete)) {
                                      $check = "checked";
                                    }else{
                                      $check = "";
                                    }
                                  ?>
                                  value="1" name="accdelete[<?=$row['id']?>]" id="delete<?=$row['id']?>" class="md-check delete-check" lang="<?=$row['id']?>" <?=$check?>>
                                  <label for="delete<?=$row['id']?>">Delete</label>
                                  </div>
                                </div>
                                <?php 
                                }
                                $akses = strpos($row['akses'], '4');
                                if ($akses !== false) {
                                ?>
                                <div class="flat-green">
                                  <div class="radio">
                                    <input type="checkbox"
                                  <?php
                                    $ischeckhide = explode(';',$acchide);
                                    if (in_array($row['id'], $ischeckhide)) {
                                      $check = "checked";
                                    }else{
                                      $check = "";
                                    }
                                  ?>
                                  value="1" name="acchide[<?=$row['id']?>]" id="hide<?=$row['id']?>" class="md-check hide-check" lang="<?=$row['id']?>" <?=$check?>>
                                  <label for="hide<?=$row['id']?>">Hide</label>
                                  </div>
                                </div>
                                <?php 
                                }
                                ?>
                              </div>
                            </td>
                          </tr>
                          <?php
                            if(isset($child[$urut][0])){
                              foreach ($child[$urut] as $row2) {
                              ?>
                              <tr>
                                <td style="width:50px;text-align:center"><?=$row['posisi']?>.<?=$row2['posisi']?></td>
                                <td class="list-child"><?=$row2['title']?></td>
                                <td>
                                  <div class="icheck ">
                                    <div class="flat-green">
                                      <div class="radio">
                                        <input type="checkbox"
                                      <?php
                                        
                                        $ischeck = explode(';',$accview);
                                        if (in_array($row2['id'], $ischeck)) {
                                          $check = "checked";
                                        }else{
                                          $check = "";
                                        }
                                        
                                      ?>
                                      value="1" name="accview[<?=$row2['id']?>]" id="view<?=$row2['id']?>" class="md-check view-check" lang="<?=$row2['id']?>" <?=$check?>>
                                      <label for="view<?=$row2['id']?>">View</label>
                                      </div>
                                    </div>
                                    <?php
                                    //$akses = $row2['akses'];
                                    $akses = strpos($row2['akses'], '1');

                                    if ($akses !== false) {
                                    ?>
                                    <div class="flat-blue">
                                      <div class="radio">
                                        <input type="checkbox"
                                      <?php
                                        $ischeckadd = explode(';',$accadd);
                                        if (in_array($row2['id'], $ischeckadd)) {
                                          $check = "checked";
                                        }else{
                                          $check = "";
                                        }
                                      ?>
                                      value="1" name="accadd[<?=$row2['id']?>]" id="add<?=$row2['id']?>" class="md-check add-check" lang="<?=$row2['id']?>" <?=$check?>>
                                      <label for="add<?=$row2['id']?>">Add</label>
                                      </div>
                                    </div>
                                    <?php 
                                    }
                                    $akses = strpos($row2['akses'], '2');
                                    if ($akses !== false) {
                                    ?>
                                    <div class="flat-blue">
                                      <div class="radio">
                                        <input type="checkbox"
                                      <?php
                                        $ischeckupdate = explode(';',$accupdate);
                                        if (in_array($row2['id'], $ischeckupdate)) {
                                          $check = "checked";
                                        }else{
                                          $check = "";
                                        }
                                      ?>
                                      value="1" name="accupdate[<?=$row2['id']?>]" id="update<?=$row2['id']?>" class="md-check update-check" lang="<?=$row2['id']?>" <?=$check?>>
                                      <label for="update<?=$row2['id']?>">Update</label>
                                      </div>
                                    </div>
                                    <?php 
                                    }
                                    $akses = strpos($row2['akses'], '3');
                                    if ($akses !== false) {
                                    ?>
                                    <div class="flat-red">
                                      <div class="radio">
                                        <input type="checkbox"
                                      <?php
                                        $ischeckdelete = explode(';',$accdelete);
                                        if (in_array($row2['id'], $ischeckdelete)) {
                                          $check = "checked";
                                        }else{
                                          $check = "";
                                        }
                                      ?>
                                      value="1" name="accdelete[<?=$row2['id']?>]" id="delete<?=$row2['id']?>" class="md-check delete-check" lang="<?=$row2['id']?>" <?=$check?>>
                                      <label for="delete<?=$row2['id']?>">Delete</label>
                                      </div>
                                    </div>
                                     <?php 
                                    }
                                    $akses = strpos($row2['akses'], '4');
                                    if ($akses !== false) {
                                    ?>
                                    <div class="flat-green">
                                      <div class="radio">
                                        <input type="checkbox"
                                      <?php
                                        $ischeckhide = explode(';',$acchide);
                                        if (in_array($row2['id'], $ischeckhide)) {
                                          $check = "checked";
                                        }else{
                                          $check = "";
                                        }
                                      ?>
                                      value="1" name="acchide[<?=$row2['id']?>]" id="hide<?=$row2['id']?>" class="md-check hide-check" lang="<?=$row2['id']?>" <?=$check?>>
                                      <label for="hide<?=$row2['id']?>">Hide</label>
                                      </div>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                  </div>
                                </td>
                              </tr>
                              <?php
                              }
                            } 
                          $urut++;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              <div class="col-lg-12" style="margin-top:20px;">
                <div class="form-group">
                  <div class="col-lg-10">
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

<!--icheck -->
<script src="<?=base_url('assets/backend/js/iCheck/jquery.icheck.js')?>"></script>
<script src="<?=base_url('assets/backend/js/icheck-init.js')?>"></script>

<script> 
  $('.check-all').click(function(){
    $('input').iCheck('check');
  });
  $('.uncheck-all').click(function(){
    $('input').iCheck('uncheck');
  });
  $('.view-check').on('ifUnchecked', function(event){
    var lang = $(this).attr('lang');

    $('#add'+lang).iCheck('uncheck');
    $('#update'+lang).iCheck('uncheck');
    $('#delete'+lang).iCheck('uncheck');
  });
  $('.add-check').on('ifChecked', function(event){
    var lang = $(this).attr('lang');

    $('#view'+lang).iCheck('check');
  });
  $('.update-check').on('ifChecked', function(event){
    var lang = $(this).attr('lang');

    $('#view'+lang).iCheck('check');
  });
  $('.delete-check').on('ifChecked', function(event){
    var lang = $(this).attr('lang');

    $('#view'+lang).iCheck('check');
  });
  $('.hide-check').on('ifChecked', function(event){
    var lang = $(this).attr('lang');

    $('#view'+lang).iCheck('check');
  });
</script>