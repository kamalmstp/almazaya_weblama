<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/js/ios-switch/switchery.css')?>" />
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
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
              <div class="col-lg-10">
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['module']) AND $status['form']['module'] != ""){
                    $selectidmodule = $status['form']['module'];
                  }else{
                    $selectidmodule = '';
                  }
                  echo $selectidmodule;
                  ?>
                  <label for="exampleInputEmail1">Module (*)</label>  
                  <select name="idmodule" id="idmodule" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Module</option>
                      <?php
                      foreach ($module as $row) {
                        if ($row['id'] == $rec["module"]) {
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
                <div class="form-group module1" <?php if ($rec["module"] != 1){ ?> style="display: none;" <?php } ?>>
                <div class="row">
                  <div class="col-md-6">
                    
                      <?php
                      if(isset($status['form']['width']) AND $status['form']['width'] != ""){
                        $valuewidth = $status['form']['width'];
                      }else{
                        $valuewidth = $rec['width'];;
                      }
                      ?>
                      <label for="exampleInputEmail1">Image Width (*) px</label>
                      <input class="form-control justnumber" required="" placeholder="Enter your width" value="<?=$valuewidth?>" id="width" name="width" type="text" />
                    </div>
                    
                    
                    <div class="col-md-6">
                      <?php
                      if(isset($status['form']['height']) AND $status['form']['height'] != ""){
                        $valueheight = $status['form']['height'];
                      }else{
                        $valueheight = $rec['height'];;
                      }
                      ?>
                      <label for="exampleInputEmail1">Image Height (*) px</label>
                      <input class="form-control justnumber" required="" placeholder="Enter your height" value="<?=$valueheight?>" id="height" name="height" type="text" />
                 
                    </div>
                </div>
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title']) AND $status['form']['title'] != ""){
                    $valuetitle = $status['form']['title'];
                  }else{
                    $valuetitle = $rec['title'];;
                  }
                  ?>
                  <label for="exampleInputEmail1">Title Menu (*)</label>
                  <input class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" id="cname" name="title" minlength="2" type="text" />
                </div>
                <div class="form-group ">
                  <?php
                  if(isset($status['form']['idparent']) AND $status['form']['idparent'] != ""){
                    $selectidparent = $status['form']['idparent'];
                  }else{
                    $selectidparent = $rec['parent'];;
                  }
                  //echo $selectidparent;
                  ?>
                  <label for="exampleInputEmail1">Menu Parent (*)</label>  
                  <select name="idparent" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Parent</option>
                      <option value='0' <?=($selectidparent == '0') ? "selected" : "" ;?>>Root Menu</option>
                      <?php
                      foreach ($menuparent as $row) {
                        if ($row['id'] == $selectidparent) {
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
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['link']) AND $status['form']['link'] != ""){
                        $valuelink = $status['form']['link'];
                      }else{
                        $valuelink = $rec['link'];;
                      }
                      ?>
                      <label for="exampleInputEmail1">Link URL</label>
                      <div class="input-group m-bot15">
                        <span class="input-group-addon group-addon-mod">webadmin/</span>
                        <input type="text" class="input-link-key form-control" value="<?=$valuelink?>" name="link">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <?php
                    if(isset($status['form']['submenu'])){
                      $valcheck = $status['form']['submenu'];
                    }else{
                      $valcheck = $rec['submenu'];
                    }
                    if($valcheck == 1){
                      $check = "checked";
                    }else{
                      $check = '';
                    }
                    ?>
                    <div class="form-group" style="margin-top:17px">
                      <label style="margin-top:12px" class="label-menu col-sm-6 control-label col-lg-6">Has Submenu?</label>
                      <div class="col-md-6">
                        <div>
                          <input type="checkbox" <?=$check?> name="submenu" id="submenu" value="1" class="js-switch-teal"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php
                      if(isset($status['form']['acc']) AND $status['form']['acc'] != ''){
                        $acc = $status['form']['acc'];
                      }else{
                        $acc = $rec['akses'];
                      }
                      ?>
                      <label for="exampleInputEmail1">Access</label>
                      <div class="icheck ">
                        <div class="flat-green">
                          <div class="radio ">
                            <input type="checkbox"
                            <?php
                            $pos = strpos($acc, '1');

                            if ($pos !== false) {
                                 echo "checked";
                            } else {
                                 echo "";
                            }
                            ?>
                            value="1" name="acc[]" id="add" >
                            <label for="add">Add</label>
                          </div>
                        </div>
                        <div class="flat-green">
                          <div class="radio ">
                            <input type="checkbox"
                            <?php
                            $pos = strpos($acc, '2');

                            if ($pos !== false) {
                                 echo "checked";
                            } else {
                                 echo "";
                            }
                            ?>
                            value="2" name="acc[]" id="update" >
                            <label for="update">Update</label>
                          </div>
                        </div>
                        <div class="flat-green">
                          <div class="radio ">
                            <input type="checkbox"
                            <?php
                            $pos = strpos($acc, '3');

                            if ($pos !== false) {
                                 echo "checked";
                            } else {
                                 echo "";
                            }
                            ?>
                            value="3" name="acc[]" id="delete" >
                            <label for="delete">Delete</label>
                          </div>
                        </div>
                        <div class="flat-green">
                          <div class="radio ">
                            <input type="checkbox"
                            <?php
                            $pos = strpos($acc, '4');

                            if ($pos !== false) {
                                 echo "checked";
                            } else {
                                 echo "";
                            }
                            ?>
                            value="4" name="acc[]" id="hide" >
                            <label for="hide">Hide</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" style="margin-top:20px">
                      <?php
                      if(isset($status['form']['icon']) AND $status['form']['icon'] != ""){
                        $valueicon = $status['form']['icon'];
                      }else{
                        $valueicon = $rec['icon'];
                      }
                      ?>
                      <div class="col-md-8">
                        <input value="<?=$valueicon?>" name="icon" placeholder="Input Icons" class="form-control" type="text" />
                      </div>
                      <div class="col-md-4">
                        <a href="#myModal2" data-toggle="modal" class="btn btn-info">
                            View Icon
                        </a>
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                <h4 class="modal-title">Simple Icon List (copy and paste icon to field)</h4>
                              </div>
                              <div class="modal-body">
                                <div class="wrapper">
        <div class="fontawesome-icon-list">

        <div id="new">
            <h2 class="page-header">11 New Icons in 4.0</h2>
            <div class="row fontawesome-icon-list">

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-rub"></i> fa-rub</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-ruble"></i> fa-ruble <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-rouble"></i> fa-rouble <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-pagelines"></i> fa-pagelines</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-stack-exchange"></i> fa-stack-exchange</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-arrow-circle-o-right"></i> fa-arrow-circle-o-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-arrow-circle-o-left"></i> fa-arrow-circle-o-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-wheelchair"></i> fa-wheelchair</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-vimeo-square"></i> fa-vimeo-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-try"></i> fa-try</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-turkish-lira"></i> fa-turkish-lira <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-plus-square-o"></i> fa-plus-square-o</a></div>

            </div>
        </div>

        <section id="web-application">
        <h2 class="page-header">Web Application Icons</h2>

        <div class="row fontawesome-icon-list">



        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-adjust"></i> fa-adjust</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-anchor"></i> fa-anchor</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-archive"></i> fa-archive</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-arrows"></i> fa-arrows</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-arrows-h"></i> fa-arrows-h</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-arrows-v"></i> fa-arrows-v</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-asterisk"></i> fa-asterisk</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-ban"></i> fa-ban</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bar-chart-o"></i> fa-bar-chart-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-barcode"></i> fa-barcode</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bars"></i> fa-bars</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-beer"></i> fa-beer</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bell"></i> fa-bell</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bell-o"></i> fa-bell-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bolt"></i> fa-bolt</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-book"></i> fa-book</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bookmark"></i> fa-bookmark</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bookmark-o"></i> fa-bookmark-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-briefcase"></i> fa-briefcase</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bug"></i> fa-bug</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-building-o"></i> fa-building-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bullhorn"></i> fa-bullhorn</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-bullseye"></i> fa-bullseye</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-calendar"></i> fa-calendar</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-calendar-o"></i> fa-calendar-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-camera"></i> fa-camera</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-camera-retro"></i> fa-camera-retro</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-caret-square-o-down"></i> fa-caret-square-o-down</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-caret-square-o-right"></i> fa-caret-square-o-right</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-caret-square-o-up"></i> fa-caret-square-o-up</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-certificate"></i> fa-certificate</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-check"></i> fa-check</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-check-circle"></i> fa-check-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-check-circle-o"></i> fa-check-circle-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-check-square"></i> fa-check-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-check-square-o"></i> fa-check-square-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-circle"></i> fa-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-circle-o"></i> fa-circle-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-clock-o"></i> fa-clock-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-cloud"></i> fa-cloud</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-cloud-download"></i> fa-cloud-download</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-cloud-upload"></i> fa-cloud-upload</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-code"></i> fa-code</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-code-fork"></i> fa-code-fork</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-coffee"></i> fa-coffee</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-cog"></i> fa-cog</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-cogs"></i> fa-cogs</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-comment"></i> fa-comment</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-comment-o"></i> fa-comment-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-comments"></i> fa-comments</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-comments-o"></i> fa-comments-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-compass"></i> fa-compass</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-credit-card"></i> fa-credit-card</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-crop"></i> fa-crop</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-crosshairs"></i> fa-crosshairs</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-cutlery"></i> fa-cutlery</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-dashboard"></i> fa-dashboard <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-desktop"></i> fa-desktop</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-download"></i> fa-download</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-edit"></i> fa-edit <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-ellipsis-h"></i> fa-ellipsis-h</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-ellipsis-v"></i> fa-ellipsis-v</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-envelope"></i> fa-envelope</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-envelope-o"></i> fa-envelope-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-eraser"></i> fa-eraser</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-exchange"></i> fa-exchange</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-exclamation"></i> fa-exclamation</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-exclamation-circle"></i> fa-exclamation-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-exclamation-triangle"></i> fa-exclamation-triangle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-external-link"></i> fa-external-link</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-external-link-square"></i> fa-external-link-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-eye"></i> fa-eye</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-eye-slash"></i> fa-eye-slash</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-female"></i> fa-female</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-fighter-jet"></i> fa-fighter-jet</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-film"></i> fa-film</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-filter"></i> fa-filter</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-fire"></i> fa-fire</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-fire-extinguisher"></i> fa-fire-extinguisher</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-flag"></i> fa-flag</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-flag-checkered"></i> fa-flag-checkered</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-flag-o"></i> fa-flag-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-flash"></i> fa-flash <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-flask"></i> fa-flask</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-folder"></i> fa-folder</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-folder-o"></i> fa-folder-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-folder-open"></i> fa-folder-open</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-folder-open-o"></i> fa-folder-open-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-frown-o"></i> fa-frown-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-gamepad"></i> fa-gamepad</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-gavel"></i> fa-gavel</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-gear"></i> fa-gear <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-gears"></i> fa-gears <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-gift"></i> fa-gift</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-glass"></i> fa-glass</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-globe"></i> fa-globe</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-group"></i> fa-group <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-hdd-o"></i> fa-hdd-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-headphones"></i> fa-headphones</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-heart"></i> fa-heart</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-heart-o"></i> fa-heart-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-home"></i> fa-home</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-inbox"></i> fa-inbox</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#"><i class="fa fa-info"></i> fa-info</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#info-circle"><i class="fa fa-info-circle"></i> fa-info-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#key"><i class="fa fa-key"></i> fa-key</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#keyboard-o"><i class="fa fa-keyboard-o"></i> fa-keyboard-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#laptop"><i class="fa fa-laptop"></i> fa-laptop</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#leaf"><i class="fa fa-leaf"></i> fa-leaf</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#gavel"><i class="fa fa-legal"></i> fa-legal <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#lemon-o"><i class="fa fa-lemon-o"></i> fa-lemon-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#level-down"><i class="fa fa-level-down"></i> fa-level-down</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#level-up"><i class="fa fa-level-up"></i> fa-level-up</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#lightbulb-o"><i class="fa fa-lightbulb-o"></i> fa-lightbulb-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#location-arrow"><i class="fa fa-location-arrow"></i> fa-location-arrow</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#lock"><i class="fa fa-lock"></i> fa-lock</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#magic"><i class="fa fa-magic"></i> fa-magic</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#magnet"><i class="fa fa-magnet"></i> fa-magnet</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#share"><i class="fa fa-mail-forward"></i> fa-mail-forward <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#reply"><i class="fa fa-mail-reply"></i> fa-mail-reply <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#mail-reply-all"><i class="fa fa-mail-reply-all"></i> fa-mail-reply-all</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#male"><i class="fa fa-male"></i> fa-male</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#map-marker"><i class="fa fa-map-marker"></i> fa-map-marker</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#meh-o"><i class="fa fa-meh-o"></i> fa-meh-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#microphone"><i class="fa fa-microphone"></i> fa-microphone</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#microphone-slash"><i class="fa fa-microphone-slash"></i> fa-microphone-slash</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#minus"><i class="fa fa-minus"></i> fa-minus</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#minus-circle"><i class="fa fa-minus-circle"></i> fa-minus-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#minus-square"><i class="fa fa-minus-square"></i> fa-minus-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#minus-square-o"><i class="fa fa-minus-square-o"></i> fa-minus-square-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#mobile"><i class="fa fa-mobile"></i> fa-mobile</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#mobile"><i class="fa fa-mobile-phone"></i> fa-mobile-phone <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#money"><i class="fa fa-money"></i> fa-money</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#moon-o"><i class="fa fa-moon-o"></i> fa-moon-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#music"><i class="fa fa-music"></i> fa-music</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#pencil"><i class="fa fa-pencil"></i> fa-pencil</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#pencil-square"><i class="fa fa-pencil-square"></i> fa-pencil-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#pencil-square-o"><i class="fa fa-pencil-square-o"></i> fa-pencil-square-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#phone"><i class="fa fa-phone"></i> fa-phone</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#phone-square"><i class="fa fa-phone-square"></i> fa-phone-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#picture-o"><i class="fa fa-picture-o"></i> fa-picture-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#plane"><i class="fa fa-plane"></i> fa-plane</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#plus"><i class="fa fa-plus"></i> fa-plus</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#plus-circle"><i class="fa fa-plus-circle"></i> fa-plus-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#plus-square"><i class="fa fa-plus-square"></i> fa-plus-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#plus-square-o"><i class="fa fa-plus-square-o"></i> fa-plus-square-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#power-off"><i class="fa fa-power-off"></i> fa-power-off</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#print"><i class="fa fa-print"></i> fa-print</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#puzzle-piece"><i class="fa fa-puzzle-piece"></i> fa-puzzle-piece</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#qrcode"><i class="fa fa-qrcode"></i> fa-qrcode</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#question"><i class="fa fa-question"></i> fa-question</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#question-circle"><i class="fa fa-question-circle"></i> fa-question-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#quote-left"><i class="fa fa-quote-left"></i> fa-quote-left</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#quote-right"><i class="fa fa-quote-right"></i> fa-quote-right</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#random"><i class="fa fa-random"></i> fa-random</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#refresh"><i class="fa fa-refresh"></i> fa-refresh</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#reply"><i class="fa fa-reply"></i> fa-reply</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#reply-all"><i class="fa fa-reply-all"></i> fa-reply-all</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#retweet"><i class="fa fa-retweet"></i> fa-retweet</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#road"><i class="fa fa-road"></i> fa-road</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#rocket"><i class="fa fa-rocket"></i> fa-rocket</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#rss"><i class="fa fa-rss"></i> fa-rss</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#rss-square"><i class="fa fa-rss-square"></i> fa-rss-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#search"><i class="fa fa-search"></i> fa-search</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#search-minus"><i class="fa fa-search-minus"></i> fa-search-minus</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#search-plus"><i class="fa fa-search-plus"></i> fa-search-plus</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#share"><i class="fa fa-share"></i> fa-share</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#share-square"><i class="fa fa-share-square"></i> fa-share-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#share-square-o"><i class="fa fa-share-square-o"></i> fa-share-square-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#shield"><i class="fa fa-shield"></i> fa-shield</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#shopping-cart"><i class="fa fa-shopping-cart"></i> fa-shopping-cart</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sign-in"><i class="fa fa-sign-in"></i> fa-sign-in</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sign-out"><i class="fa fa-sign-out"></i> fa-sign-out</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#signal"><i class="fa fa-signal"></i> fa-signal</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sitemap"><i class="fa fa-sitemap"></i> fa-sitemap</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#smile-o"><i class="fa fa-smile-o"></i> fa-smile-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort"><i class="fa fa-sort"></i> fa-sort</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-alpha-asc"><i class="fa fa-sort-alpha-asc"></i> fa-sort-alpha-asc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-alpha-desc"><i class="fa fa-sort-alpha-desc"></i> fa-sort-alpha-desc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-amount-asc"><i class="fa fa-sort-amount-asc"></i> fa-sort-amount-asc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-amount-desc"><i class="fa fa-sort-amount-desc"></i> fa-sort-amount-desc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-asc"><i class="fa fa-sort-asc"></i> fa-sort-asc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-desc"><i class="fa fa-sort-desc"></i> fa-sort-desc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-asc"><i class="fa fa-sort-down"></i> fa-sort-down <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-numeric-asc"><i class="fa fa-sort-numeric-asc"></i> fa-sort-numeric-asc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-numeric-desc"><i class="fa fa-sort-numeric-desc"></i> fa-sort-numeric-desc</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort-desc"><i class="fa fa-sort-up"></i> fa-sort-up <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#spinner"><i class="fa fa-spinner"></i> fa-spinner</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#square"><i class="fa fa-square"></i> fa-square</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#square-o"><i class="fa fa-square-o"></i> fa-square-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#star"><i class="fa fa-star"></i> fa-star</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#star-half"><i class="fa fa-star-half"></i> fa-star-half</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#star-half-o"><i class="fa fa-star-half-empty"></i> fa-star-half-empty <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#star-half-o"><i class="fa fa-star-half-full"></i> fa-star-half-full <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#star-half-o"><i class="fa fa-star-half-o"></i> fa-star-half-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#star-o"><i class="fa fa-star-o"></i> fa-star-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#subscript"><i class="fa fa-subscript"></i> fa-subscript</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#suitcase"><i class="fa fa-suitcase"></i> fa-suitcase</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sun-o"><i class="fa fa-sun-o"></i> fa-sun-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#superscript"><i class="fa fa-superscript"></i> fa-superscript</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#tablet"><i class="fa fa-tablet"></i> fa-tablet</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#tachometer"><i class="fa fa-tachometer"></i> fa-tachometer</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#tag"><i class="fa fa-tag"></i> fa-tag</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#tags"><i class="fa fa-tags"></i> fa-tags</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#tasks"><i class="fa fa-tasks"></i> fa-tasks</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#terminal"><i class="fa fa-terminal"></i> fa-terminal</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#thumb-tack"><i class="fa fa-thumb-tack"></i> fa-thumb-tack</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#thumbs-down"><i class="fa fa-thumbs-down"></i> fa-thumbs-down</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#thumbs-o-down"><i class="fa fa-thumbs-o-down"></i> fa-thumbs-o-down</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#thumbs-o-up"><i class="fa fa-thumbs-o-up"></i> fa-thumbs-o-up</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#thumbs-up"><i class="fa fa-thumbs-up"></i> fa-thumbs-up</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#ticket"><i class="fa fa-ticket"></i> fa-ticket</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#times"><i class="fa fa-times"></i> fa-times</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#times-circle"><i class="fa fa-times-circle"></i> fa-times-circle</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#times-circle-o"><i class="fa fa-times-circle-o"></i> fa-times-circle-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#tint"><i class="fa fa-tint"></i> fa-tint</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-down"><i class="fa fa-toggle-down"></i> fa-toggle-down <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-left"><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-right"><i class="fa fa-toggle-right"></i> fa-toggle-right <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-up"><i class="fa fa-toggle-up"></i> fa-toggle-up <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#trash-o"><i class="fa fa-trash-o"></i> fa-trash-o</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#trophy"><i class="fa fa-trophy"></i> fa-trophy</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#truck"><i class="fa fa-truck"></i> fa-truck</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#umbrella"><i class="fa fa-umbrella"></i> fa-umbrella</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#unlock"><i class="fa fa-unlock"></i> fa-unlock</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#unlock-alt"><i class="fa fa-unlock-alt"></i> fa-unlock-alt</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#sort"><i class="fa fa-unsorted"></i> fa-unsorted <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#upload"><i class="fa fa-upload"></i> fa-upload</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#user"><i class="fa fa-user"></i> fa-user</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#users"><i class="fa fa-users"></i> fa-users</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#video-camera"><i class="fa fa-video-camera"></i> fa-video-camera</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#volume-down"><i class="fa fa-volume-down"></i> fa-volume-down</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#volume-off"><i class="fa fa-volume-off"></i> fa-volume-off</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#volume-up"><i class="fa fa-volume-up"></i> fa-volume-up</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#exclamation-triangle"><i class="fa fa-warning"></i> fa-warning <span class="text-muted">(alias)</span></a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#wheelchair"><i class="fa fa-wheelchair"></i> fa-wheelchair</a></div>

        <div class="fa-hover col-md-4 col-sm-4"><a href="#wrench"><i class="fa fa-wrench"></i> fa-wrench</a></div>

        </div>

        </section>

        <section id="form-control">
            <h2 class="page-header">Form Control Icons</h2>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#check-square"><i class="fa fa-check-square"></i> fa-check-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#check-square-o"><i class="fa fa-check-square-o"></i> fa-check-square-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#circle"><i class="fa fa-circle"></i> fa-circle</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#circle-o"><i class="fa fa-circle-o"></i> fa-circle-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#dot-circle-o"><i class="fa fa-dot-circle-o"></i> fa-dot-circle-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#minus-square"><i class="fa fa-minus-square"></i> fa-minus-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#minus-square-o"><i class="fa fa-minus-square-o"></i> fa-minus-square-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#plus-square"><i class="fa fa-plus-square"></i> fa-plus-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#plus-square-o"><i class="fa fa-plus-square-o"></i> fa-plus-square-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#square"><i class="fa fa-square"></i> fa-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#square-o"><i class="fa fa-square-o"></i> fa-square-o</a></div>

            </div>
        </section>

        <section id="currency">
            <h2 class="page-header">Currency Icons</h2>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#btc"><i class="fa fa-bitcoin"></i> fa-bitcoin <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#btc"><i class="fa fa-btc"></i> fa-btc</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#jpy"><i class="fa fa-cny"></i> fa-cny <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#usd"><i class="fa fa-dollar"></i> fa-dollar <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#eur"><i class="fa fa-eur"></i> fa-eur</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#eur"><i class="fa fa-euro"></i> fa-euro <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#gbp"><i class="fa fa-gbp"></i> fa-gbp</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#inr"><i class="fa fa-inr"></i> fa-inr</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#jpy"><i class="fa fa-jpy"></i> fa-jpy</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#krw"><i class="fa fa-krw"></i> fa-krw</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#money"><i class="fa fa-money"></i> fa-money</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#jpy"><i class="fa fa-rmb"></i> fa-rmb <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#rub"><i class="fa fa-rouble"></i> fa-rouble <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#rub"><i class="fa fa-rub"></i> fa-rub</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#rub"><i class="fa fa-ruble"></i> fa-ruble <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#inr"><i class="fa fa-rupee"></i> fa-rupee <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#try"><i class="fa fa-try"></i> fa-try</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#try"><i class="fa fa-turkish-lira"></i> fa-turkish-lira <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#usd"><i class="fa fa-usd"></i> fa-usd</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#krw"><i class="fa fa-won"></i> fa-won <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#jpy"><i class="fa fa-yen"></i> fa-yen <span class="text-muted">(alias)</span></a></div>

            </div>

        </section>

        <section id="text-editor">
            <h2 class="page-header">Text Editor Icons</h2>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#align-center"><i class="fa fa-align-center"></i> fa-align-center</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#align-justify"><i class="fa fa-align-justify"></i> fa-align-justify</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#align-left"><i class="fa fa-align-left"></i> fa-align-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#align-right"><i class="fa fa-align-right"></i> fa-align-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#bold"><i class="fa fa-bold"></i> fa-bold</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#link"><i class="fa fa-chain"></i> fa-chain <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chain-broken"><i class="fa fa-chain-broken"></i> fa-chain-broken</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#clipboard"><i class="fa fa-clipboard"></i> fa-clipboard</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#columns"><i class="fa fa-columns"></i> fa-columns</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#files-o"><i class="fa fa-copy"></i> fa-copy <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#scissors"><i class="fa fa-cut"></i> fa-cut <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#outdent"><i class="fa fa-dedent"></i> fa-dedent <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#eraser"><i class="fa fa-eraser"></i> fa-eraser</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#file"><i class="fa fa-file"></i> fa-file</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#file-o"><i class="fa fa-file-o"></i> fa-file-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#file-text"><i class="fa fa-file-text"></i> fa-file-text</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#file-text-o"><i class="fa fa-file-text-o"></i> fa-file-text-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#files-o"><i class="fa fa-files-o"></i> fa-files-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#floppy-o"><i class="fa fa-floppy-o"></i> fa-floppy-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#font"><i class="fa fa-font"></i> fa-font</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#indent"><i class="fa fa-indent"></i> fa-indent</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#italic"><i class="fa fa-italic"></i> fa-italic</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#link"><i class="fa fa-link"></i> fa-link</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#list"><i class="fa fa-list"></i> fa-list</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#list-alt"><i class="fa fa-list-alt"></i> fa-list-alt</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#list-ol"><i class="fa fa-list-ol"></i> fa-list-ol</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#list-ul"><i class="fa fa-list-ul"></i> fa-list-ul</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#outdent"><i class="fa fa-outdent"></i> fa-outdent</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#paperclip"><i class="fa fa-paperclip"></i> fa-paperclip</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#clipboard"><i class="fa fa-paste"></i> fa-paste <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#repeat"><i class="fa fa-repeat"></i> fa-repeat</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#undo"><i class="fa fa-rotate-left"></i> fa-rotate-left <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#repeat"><i class="fa fa-rotate-right"></i> fa-rotate-right <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#floppy-o"><i class="fa fa-save"></i> fa-save <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#scissors"><i class="fa fa-scissors"></i> fa-scissors</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#strikethrough"><i class="fa fa-strikethrough"></i> fa-strikethrough</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#table"><i class="fa fa-table"></i> fa-table</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#text-height"><i class="fa fa-text-height"></i> fa-text-height</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#text-width"><i class="fa fa-text-width"></i> fa-text-width</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#th"><i class="fa fa-th"></i> fa-th</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#th-large"><i class="fa fa-th-large"></i> fa-th-large</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#th-list"><i class="fa fa-th-list"></i> fa-th-list</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#underline"><i class="fa fa-underline"></i> fa-underline</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#undo"><i class="fa fa-undo"></i> fa-undo</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chain-broken"><i class="fa fa-unlink"></i> fa-unlink <span class="text-muted">(alias)</span></a></div>

            </div>

        </section>

        <section id="directional">
            <h2 class="page-header">Directional Icons</h2>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-double-down"><i class="fa fa-angle-double-down"></i> fa-angle-double-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-double-left"><i class="fa fa-angle-double-left"></i> fa-angle-double-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-double-right"><i class="fa fa-angle-double-right"></i> fa-angle-double-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-double-up"><i class="fa fa-angle-double-up"></i> fa-angle-double-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-down"><i class="fa fa-angle-down"></i> fa-angle-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-left"><i class="fa fa-angle-left"></i> fa-angle-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-right"><i class="fa fa-angle-right"></i> fa-angle-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#angle-up"><i class="fa fa-angle-up"></i> fa-angle-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-down"><i class="fa fa-arrow-circle-down"></i> fa-arrow-circle-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-left"><i class="fa fa-arrow-circle-left"></i> fa-arrow-circle-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-o-down"><i class="fa fa-arrow-circle-o-down"></i> fa-arrow-circle-o-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-o-left"><i class="fa fa-arrow-circle-o-left"></i> fa-arrow-circle-o-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-o-right"><i class="fa fa-arrow-circle-o-right"></i> fa-arrow-circle-o-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-o-up"><i class="fa fa-arrow-circle-o-up"></i> fa-arrow-circle-o-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-right"><i class="fa fa-arrow-circle-right"></i> fa-arrow-circle-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-circle-up"><i class="fa fa-arrow-circle-up"></i> fa-arrow-circle-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-down"><i class="fa fa-arrow-down"></i> fa-arrow-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-left"><i class="fa fa-arrow-left"></i> fa-arrow-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-right"><i class="fa fa-arrow-right"></i> fa-arrow-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrow-up"><i class="fa fa-arrow-up"></i> fa-arrow-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrows"><i class="fa fa-arrows"></i> fa-arrows</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrows-alt"><i class="fa fa-arrows-alt"></i> fa-arrows-alt</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrows-h"><i class="fa fa-arrows-h"></i> fa-arrows-h</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrows-v"><i class="fa fa-arrows-v"></i> fa-arrows-v</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-down"><i class="fa fa-caret-down"></i> fa-caret-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-left"><i class="fa fa-caret-left"></i> fa-caret-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-right"><i class="fa fa-caret-right"></i> fa-caret-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-down"><i class="fa fa-caret-square-o-down"></i> fa-caret-square-o-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-left"><i class="fa fa-caret-square-o-left"></i> fa-caret-square-o-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-right"><i class="fa fa-caret-square-o-right"></i> fa-caret-square-o-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-up"><i class="fa fa-caret-square-o-up"></i> fa-caret-square-o-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-up"><i class="fa fa-caret-up"></i> fa-caret-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-circle-down"><i class="fa fa-chevron-circle-down"></i> fa-chevron-circle-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-circle-left"><i class="fa fa-chevron-circle-left"></i> fa-chevron-circle-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-circle-right"><i class="fa fa-chevron-circle-right"></i> fa-chevron-circle-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-circle-up"><i class="fa fa-chevron-circle-up"></i> fa-chevron-circle-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-down"><i class="fa fa-chevron-down"></i> fa-chevron-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-left"><i class="fa fa-chevron-left"></i> fa-chevron-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-right"><i class="fa fa-chevron-right"></i> fa-chevron-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#chevron-up"><i class="fa fa-chevron-up"></i> fa-chevron-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#hand-o-down"><i class="fa fa-hand-o-down"></i> fa-hand-o-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#hand-o-left"><i class="fa fa-hand-o-left"></i> fa-hand-o-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#hand-o-right"><i class="fa fa-hand-o-right"></i> fa-hand-o-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#hand-o-up"><i class="fa fa-hand-o-up"></i> fa-hand-o-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#long-arrow-down"><i class="fa fa-long-arrow-down"></i> fa-long-arrow-down</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#long-arrow-left"><i class="fa fa-long-arrow-left"></i> fa-long-arrow-left</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#long-arrow-right"><i class="fa fa-long-arrow-right"></i> fa-long-arrow-right</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#long-arrow-up"><i class="fa fa-long-arrow-up"></i> fa-long-arrow-up</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-down"><i class="fa fa-toggle-down"></i> fa-toggle-down <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-left"><i class="fa fa-toggle-left"></i> fa-toggle-left <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-right"><i class="fa fa-toggle-right"></i> fa-toggle-right <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#caret-square-o-up"><i class="fa fa-toggle-up"></i> fa-toggle-up <span class="text-muted">(alias)</span></a></div>

            </div>

        </section>

        <section id="video-player">
            <h2 class="page-header">Video Player Icons</h2>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#arrows-alt"><i class="fa fa-arrows-alt"></i> fa-arrows-alt</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#backward"><i class="fa fa-backward"></i> fa-backward</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#compress"><i class="fa fa-compress"></i> fa-compress</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#eject"><i class="fa fa-eject"></i> fa-eject</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#expand"><i class="fa fa-expand"></i> fa-expand</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#fast-backward"><i class="fa fa-fast-backward"></i> fa-fast-backward</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#fast-forward"><i class="fa fa-fast-forward"></i> fa-fast-forward</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#forward"><i class="fa fa-forward"></i> fa-forward</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#pause"><i class="fa fa-pause"></i> fa-pause</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#play"><i class="fa fa-play"></i> fa-play</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#play-circle"><i class="fa fa-play-circle"></i> fa-play-circle</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#play-circle-o"><i class="fa fa-play-circle-o"></i> fa-play-circle-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#step-backward"><i class="fa fa-step-backward"></i> fa-step-backward</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#step-forward"><i class="fa fa-step-forward"></i> fa-step-forward</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#stop"><i class="fa fa-stop"></i> fa-stop</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#youtube-play"><i class="fa fa-youtube-play"></i> fa-youtube-play</a></div>

            </div>

        </section>

        <section id="brand">
            <h2 class="page-header">Brand Icons</h2>

            <div class="alert alert-success">
                <ul class="margin-bottom-none padding-left-lg">
                    <li>All brand icons are trademarks of their respective owners.</li>
                    <li>The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome, nor vice versa.</li>
                </ul>

            </div>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#adn"><i class="fa fa-adn"></i> fa-adn</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#android"><i class="fa fa-android"></i> fa-android</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#apple"><i class="fa fa-apple"></i> fa-apple</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#bitbucket"><i class="fa fa-bitbucket"></i> fa-bitbucket</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#bitbucket-square"><i class="fa fa-bitbucket-square"></i> fa-bitbucket-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#btc"><i class="fa fa-bitcoin"></i> fa-bitcoin <span class="text-muted">(alias)</span></a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#btc"><i class="fa fa-btc"></i> fa-btc</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#css3"><i class="fa fa-css3"></i> fa-css3</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#dribbble"><i class="fa fa-dribbble"></i> fa-dribbble</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#dropbox"><i class="fa fa-dropbox"></i> fa-dropbox</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#facebook"><i class="fa fa-facebook"></i> fa-facebook</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#facebook-square"><i class="fa fa-facebook-square"></i> fa-facebook-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#flickr"><i class="fa fa-flickr"></i> fa-flickr</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#foursquare"><i class="fa fa-foursquare"></i> fa-foursquare</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#github"><i class="fa fa-github"></i> fa-github</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#github-alt"><i class="fa fa-github-alt"></i> fa-github-alt</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#github-square"><i class="fa fa-github-square"></i> fa-github-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#gittip"><i class="fa fa-gittip"></i> fa-gittip</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#google-plus"><i class="fa fa-google-plus"></i> fa-google-plus</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#google-plus-square"><i class="fa fa-google-plus-square"></i> fa-google-plus-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#html5"><i class="fa fa-html5"></i> fa-html5</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#instagram"><i class="fa fa-instagram"></i> fa-instagram</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#linkedin"><i class="fa fa-linkedin"></i> fa-linkedin</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#linkedin-square"><i class="fa fa-linkedin-square"></i> fa-linkedin-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#linux"><i class="fa fa-linux"></i> fa-linux</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#maxcdn"><i class="fa fa-maxcdn"></i> fa-maxcdn</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#pagelines"><i class="fa fa-pagelines"></i> fa-pagelines</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#pinterest"><i class="fa fa-pinterest"></i> fa-pinterest</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#pinterest-square"><i class="fa fa-pinterest-square"></i> fa-pinterest-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#renren"><i class="fa fa-renren"></i> fa-renren</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#skype"><i class="fa fa-skype"></i> fa-skype</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#stack-exchange"><i class="fa fa-stack-exchange"></i> fa-stack-exchange</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#stack-overflow"><i class="fa fa-stack-overflow"></i> fa-stack-overflow</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#trello"><i class="fa fa-trello"></i> fa-trello</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#tumblr"><i class="fa fa-tumblr"></i> fa-tumblr</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#tumblr-square"><i class="fa fa-tumblr-square"></i> fa-tumblr-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#twitter"><i class="fa fa-twitter"></i> fa-twitter</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#twitter-square"><i class="fa fa-twitter-square"></i> fa-twitter-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#vimeo-square"><i class="fa fa-vimeo-square"></i> fa-vimeo-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#vk"><i class="fa fa-vk"></i> fa-vk</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#weibo"><i class="fa fa-weibo"></i> fa-weibo</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#windows"><i class="fa fa-windows"></i> fa-windows</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#xing"><i class="fa fa-xing"></i> fa-xing</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#xing-square"><i class="fa fa-xing-square"></i> fa-xing-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#youtube"><i class="fa fa-youtube"></i> fa-youtube</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#youtube-play"><i class="fa fa-youtube-play"></i> fa-youtube-play</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#youtube-square"><i class="fa fa-youtube-square"></i> fa-youtube-square</a></div>

            </div>
        </section>

        <section id="medical">
            <h2 class="page-header">Medical Icons</h2>

            <div class="row fontawesome-icon-list">



                <div class="fa-hover col-md-4 col-sm-4"><a href="#ambulance"><i class="fa fa-ambulance"></i> fa-ambulance</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#h-square"><i class="fa fa-h-square"></i> fa-h-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#hospital-o"><i class="fa fa-hospital-o"></i> fa-hospital-o</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#medkit"><i class="fa fa-medkit"></i> fa-medkit</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#plus-square"><i class="fa fa-plus-square"></i> fa-plus-square</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#stethoscope"><i class="fa fa-stethoscope"></i> fa-stethoscope</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#user-md"><i class="fa fa-user-md"></i> fa-user-md</a></div>

                <div class="fa-hover col-md-4 col-sm-4"><a href="#wheelchair"><i class="fa fa-wheelchair"></i> fa-wheelchair</a></div>

            </div>

        </section>

        </div>
        </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12" style="margin-top:20px;">
                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Submit</button>
                  <a href="<?=base_url('webadmin/menu')?>" class="btn btn-default" type="button">Cancel</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!--ios7-->
<script src="<?=base_url('assets/backend/js/ios-switch/switchery.js')?>" ></script>
<script src="<?=base_url('assets/backend/js/ios-switch/ios-init.js')?>" ></script>

<!--icheck -->
<script src="<?=base_url('assets/backend/js/iCheck/jquery.icheck.js')?>"></script>
<script src="<?=base_url('assets/backend/js/icheck-init.js')?>"></script>

<script>
  $(function() {
    $("<style type='text/css' id='dynamic' />").appendTo("head");
    cekmenu = $('.js-switch-teal:checked').val();
    if (cekmenu === undefined || cekmenu === null) {
      $("#dynamic").text(".switchery:before{display:none;}");
    }else{
      $("#dynamic").text(".switchery:after{display:none;}");
    }
    $('.switchery').click(function(){
      cekmenu = $('.js-switch-teal:checked').val();
      //alert(toogle);
      if (cekmenu === undefined || cekmenu === null) {
        $("#dynamic").text(".switchery:before{display:none;}");
      }else{
        $("#dynamic").text(".switchery:after{display:none;}");
      }
    });
    
    $('.input-title-key').keyup(function(){
      var title = $('.input-title-key').val();
      var title = title.replace(/\s+/g, '');
      var title = title.toLowerCase();
      $('.input-link-key').val(title);
    });
    
    
    $("#idmodule").change(function(){
        if ($(this).val() == 1){
            $(".module1").show();
            $("#width").attr("required","");
        }else{
            $(".module1").hide();
            $("#width").removeAttr("required");
        }
    })
  });
</script>