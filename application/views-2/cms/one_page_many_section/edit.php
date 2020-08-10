<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/green.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/minimal.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/red.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/green.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/blue.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/yellow.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/minimal/purple.css')?>" rel="stylesheet">

<link href="<?=base_url('assets/backend/js/iCheck/skins/square/square.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/square/red.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/square/green.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/square/blue.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/square/yellow.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/square/purple.css')?>" rel="stylesheet">

<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/grey.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/red.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/blue.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/yellow.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/purple.css')?>" rel="stylesheet">

<style>
.upload{
    background-color:#ff0000;
    border:1px solid #ff0000;
    color:#fff;
    border-radius:5px;
    padding:10px;
    text-shadow:1px 1px 0px green;
    box-shadow: 2px 2px 15px rgba(0,0,0, .75);
}
.upload:hover{
    cursor:pointer;
    background:#c20b0b;
    border:1px solid #c20b0b;
    box-shadow: 0px 0px 5px rgba(0,0,0, .75);
}
#file{
    color:green;
    padding:5px; border:1px dashed #123456;
    background-color: #f9ffe5;
}
#upload{
    margin-left: 45px;
}

#noerror{
    color:green;
    text-align: left;
}
#error{
    color:red;
    text-align: left;
}
#img{ 
    width: 40px;
    border: none; 
    height:40px;
    margin-left: -20px;
    margin-bottom: 91px;
}

.abcd{
    /*text-align: center;*/
}

.abcd img{
    width:298px;
    padding: 5px;
    border: 1px solid rgb(232, 222, 189);
}
b{
    color:red;
}
#formget{
    float:right; 

}

</style>
<div class="wrapper">
  <div class="row">
    <form role="form" class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
      <div class="col-md-12">
        
        <section class="panel">
         <header class="panel-heading">
            Page &amp; Section Type
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <div class="panel-body">
            <div class=" form">
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
                <div class="form-group">
                    <label for="exampleInputEmail1">Show on Page</label>
                    <select name="mainpages" id="idmodule" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Module</option>
                      <?php
                      foreach ($pages as $row) {
                        $selected = "";
                        if ($row["sister"] == $rec[0]["sisterpages"]){
                            $selected = "selected=\"selected\"";
                        }
                      ?>
                      <option <?=$selected?> value="<?=$row['sister']?>"><?=$row['title']?></option>
                      <?php
                      }
                      ?>
                  </select>
                    
                </div>
                <div class="form-group">
                    <select name="tipe_section" required="" id="tipe_section" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                    
                        <optgroup label="">
                        <option value=''>-- Choose Section Type --</option>
                        </optgroup>
                        <optgroup>
                            
                            <option <?php if ($rec[0]["tipe_section"] == 1){ echo "selected=\"selected\""; }?> value="1">Slide Banner</option>
                            <option <?php if ($rec[0]["tipe_section"] == 2){ echo "selected=\"selected\""; }?> value="2">Proudly Papua Format</option>
                            <option <?php if ($rec[0]["tipe_section"] == 3){ echo "selected=\"selected\""; }?> value="3">Buah Merah Format</option>
                            <option <?php if ($rec[0]["tipe_section"] == 4){ echo "selected=\"selected\""; }?> value="4">Latest News</option>
                        </optgroup>
                        <optgroup label="------------------------------------------------------">
                            <option <?php if ($rec[0]["tipe_section"] == 5){ echo "selected=\"selected\""; }?> value="5">Why Red - Proudly Papua</option>
                        </optgroup>
                        <optgroup label="------------------------------------------------------">
                            <option <?php if ($rec[0]["tipe_section"] == 6){ echo "selected=\"selected\""; }?> value="6">Left Text, Right Image</option>
                            <option <?php if ($rec[0]["tipe_section"] == 7){ echo "selected=\"selected\""; }?> value="7">Left Image, Right Text</option>
                            <option <?php if ($rec[0]["tipe_section"] == 8){ echo "selected=\"selected\""; }?> value="8">Graphic Orac</option>
                            <option <?php if ($rec[0]["tipe_section"] == 9){ echo "selected=\"selected\""; }?> value="9">Video</option>
                        </optgroup>
                  </select>
                    
                </div>
                
                
                
                
              </div>
              
              
            </div>
          </div>
        </section>
      </div>
      
      <?php 
      $r = 0;
      foreach ($lang as $rowlang): ?>
      <input name="id[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
      
      <div class="col-md-12 content-slide-banner" <?php if ($rec[0]["tipe_section"] == 1 || $rec[0]["tipe_section"] == 4 || $rec[0]["tipe_section"] == 8 || $rec[0]["tipe_section"] == 9){ echo "style='display:block;'"; }else{ echo "style='display:none;'"; }?>>
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa <?php if ($rowlang['id'] > 1){ echo "fa-chevron-up"; }else{ echo "fa-chevron-down"; } ?>" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang_slide[<?=$rowlang['id']?>]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body" <?php if ($rowlang['id'] > 1){ echo "style='display: none;'"; } ?>>
            <div class="form">
              <div class="col-md-12">
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title_slide_banner'][$rowlang['id']]) AND $status['form']['title_slide_banner'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title_slide_banner'][$rowlang['id']];
                  }else{
                    $valuetitle = $rec[$r]["title"];
                  }
                  ?>
                  <label for="exampleInputEmail1">Title (*)</label>
                  <input lang="<?=$rowlang['id']?>" class="input-title_slide_banner-key-<?=$rowlang['id']?> form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title_slide_banner[<?=$rowlang['id']?>]" type="text" <?php if ($rowlang['id'] == 1){ ?> required="" <?php } ?>  />
                </div>
                <div class="form-group source_slide_banner"  <?php if ($rec[0]["tipe_section"] == 1){ echo "style='display:block;'"; }else{ echo "style='display:none;'"; }?>>
                    <label for="exampleInputEmail1">Source Data</label>
                    <select name="source_data[<?=$rowlang['id']?>]" id="source_data" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">                    
                        <option value="">-- Pilih source data --</option>                        <?php
                            foreach ($menu_slide_banner as $dt_slide){ 
                                $selected = "";
                                if ($dt_slide["id"] == $rec[0]["page_source"]){
                                    $selected = "selected=\"selected\"";   
                                }
                                
                             
                            ?>
                                <option <?=$selected?> value="<?=$dt_slide["id"]?>"><?=$dt_slide["title"]?></option>
                                <?php                                
                            }
                        ?>
                  </select>
                </div>
                <div class="form-group linkyoutube" style="<?php if ($rec[0]["tipe_section"] == 9){ echo "display:block;"; }else{ echo "display:none;"; }?>">
                  <?php
                  if(isset($status['form']['youtube'][$rowlang['id']]) AND $status['form']['youtube'][$rowlang['id']] != ""){
                    $valueyoutube = $status['form']['youtube'][$rowlang['id']];
                  }else{
                    $valueyoutube = $rec[$r]["link_youtube"];
                  }
                  ?>
                  <label for="exampleInputEmail1">Link Youtube (*)</label>
                  <input lang="<?=$rowlang['id']?>" class="input-title-youtube-<?=$rowlang['id']?> form-control" placeholder="Enter link youtube" value="<?=$valueyoutube?>" name="link_youtube[<?=$rowlang['id']?>]" type="text" <?php if ($rowlang['id'] == 1){ if ($rec[0]["tipe_section"] == 9){ ?> required="" <?php }} ?>  />
                </div>
                
                
                <div class="form-group">
                  <div class="col-md-offset-2 col-md-8 lebarwidth">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                      <?php
                      if ($rec[$r]["background"] != ""){
                      ?>
                        <img src="<?=base_url("uploads/section/".$rec[$r]["background"])?>" alt="" />
                      <?php
                      }else{
                      ?>
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                      <?php
                      }
                      ?>
                          
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Background Section</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="background_1<?=$rowlang['id']?>" />
                          <input type="hidden" name="backgroundold_1[<?=$rowlang['id']?>]" value="<?=$rec[$r]["background"]?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span class="background-noted">Witdh : 1400px - Height : 768px</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php 

      $r++;
      endforeach ?>
      
      
      
      <?php 
      $r = 0;
      foreach ($lang as $rowlang): ?>
      <input name="id[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
      
      <div class="col-md-12 content-section"  <?php if ($rec[0]["tipe_section"] == 2 || $rec[0]["tipe_section"] == 3 || $rec[0]["tipe_section"] == 5 || $rec[0]["tipe_section"] == 6 || $rec[0]["tipe_section"] == 7){ echo "style='display:block;'"; }else{ echo "style='display:none;'"; }?>>
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa <?php if ($rowlang['id'] > 1){ echo "fa-chevron-up"; }else{ echo "fa-chevron-down"; } ?>" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang[<?=$rowlang['id']?>]" type="hidden" value="<?=$rowlang['id']?>">
          <input name="id_edit[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
          <div class="panel-body" <?php if ($rowlang['id'] > 1){ echo "style='display: none;'"; } ?>>
            <div class="form">
              <div class="col-md-12">
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title'][$rowlang['id']];
                  }else{
                    $valuetitle = $rec[$r]["title"];
                  }
                  ?>
                  <label for="exampleInputEmail1">Title Section (*)</label>
                  <input lang="<?=$rowlang['id']?>" class="input-title-key-<?=$rowlang['id']?> form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" type="text"   />
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title'][$rowlang['id']];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                    <label for="exampleInputEmail1">
                    <div class="icheck ">
                    <div class="flat-blue single-row">
                    <div class="radio ">
                        <input type="checkbox" <?php if ($rec[$r]['hide_title'] == 1){ echo "checked=\"\""; }?> name="hide_title[<?=$rowlang['id']?>]" value="1">
                        <label>Hide Title</label>
                    </div>
                    </div>
                    </div>
                    </label>
                  
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title'][$rowlang['id']];
                  }else{
                    $valuetitle = $rec[$r]["link"];
                  }
                  ?>
                  <label for="exampleInputEmail1">Url</label>
                  <input lang="<?=$rowlang['id']?>" class="input-url-key form-control" placeholder="Enter your Url" value="<?=$valuetitle?>" name="url[<?=$rowlang['id']?>]" type="text" />
                </div>
                
                <div class="form-group">
                  <?php
                  if(isset($status['form']['content'][$rowlang['id']]) AND $status['form']['content'][$rowlang['id']] != ""){
                    $valuecontent = $status['form']['content'][$rowlang['id']];
                  }else{
                    $valuecontent = $rec[$r]["description"];
                  }
                  ?>
                  <label for="exampleInputEmail1">Content</label>
                  <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                </div>
                <div class="form-group">
                  <div class="col-md-offset-2 col-md-8 lebarwidth">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                      <?php
                      if ($rec[$r]["background"] != ""){
                      ?>
                        <img src="<?=base_url("uploads/section/".$rec[$r]["background"])?>" alt="" />
                      <?php
                      }else{
                      ?>
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                      <?php
                      }
                      ?>
                          
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Background Section</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="background<?=$rowlang['id']?>" />
                          <input type="hidden" name="backgroundold[<?=$rowlang['id']?>]" value="<?=$rec[$r]["background"]?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    
                    <?php if ($rec[0]["tipe_section"] == 2){ ?>
                    <span class="background-noted">Witdh : 1400px - Height : 769px</span>
                    <?php } ?>
                    <?php if ($rec[0]["tipe_section"] == 3){ ?>
                    <span class="background-noted">Witdh : 1400px - Height : 683px</span>
                    <?php } ?>
                     <?php if ($rec[0]["tipe_section"] == 5){ ?>
                    <span class="background-noted">Witdh : 1400px - Height : 735px</span>
                    <?php } ?>
                    <?php if ($rec[0]["tipe_section"] == 6 || $rec[0]["tipe_section"] == 7){ ?>
                    <span class="background-noted">Witdh : 1400px - Height : 768px</span>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-offset-2 col-md-8 lebarwidth">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                          
                          <?php
                          if ($rec[$r]["image"] != ""){
                          ?>
                            <img src="<?=base_url("uploads/section/".$rec[$r]["image"])?>" alt="" />
                          <?php
                          }else{
                          ?>
                            <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                          <?php
                          }
                          ?>
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="image<?=$rowlang['id']?>" />
                          <input type="hidden" name="imageold[<?=$rowlang['id']?>]" value="<?=$rec[$r]["image"]?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <?php if ($rec[0]["tipe_section"] == 2){ ?>
                    <span class="image-noted">Witdh : 581px - Height : 583px</span>
                    <?php } ?>
                    <?php if ($rec[0]["tipe_section"] == 3){ ?>
                    <span class="image-noted">Witdh : 581px - Height : 583px</span>
                    <?php } ?>
                     <?php if ($rec[0]["tipe_section"] == 5){ ?>
                    <span class="image-noted">Witdh : 584px - Height : 510px</span>
                    <?php } ?>
                    <?php if ($rec[0]["tipe_section"] == 6 || $rec[0]["tipe_section"] == 7){ ?>
                    <span class="image-noted">Witdh : 476px - Height : 448px</span>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php 

      $r++;
      endforeach ?>
      <div class="col-md-12 content-setting"   <?php if ($rec[0]["tipe_section"] == 6 || $rec[0]["tipe_section"] == 7){ echo "style='display:block;'"; }else{ echo "style='display:none;'"; }?>>
        <section class="panel">
          <header class="panel-heading">
            Setting
            <span class="tools pull-right">
              <a class="fa fa-chevron-up" href="javascript:;"></a>
            </span>
          </header>
          <div class="panel-body" style="display: none;">
            <div class="form">
              <div class="col-md-12">
                <div class="form-group">
                  
                    <label for="exampleInputEmail1">Text Color </label>
                    <select name="color_text" id="color_text" class="form-control m-bot15" data-placeholder="Select...">
                        <option value="">-- Default --</option>
                        <option <?php if ($rec[0]["text_color"] == "#FFFFFF"){ echo "selected=\"selected\""; }?> value="#FFFFFF">White</option>
                        <option <?php if ($rec[0]["text_color"] == "#000000"){ echo "selected=\"selected\""; }?> value="#000000">Black</option>
                        
                    </select>
                </div>
                <div class="form-group">
                  
                    <label for="exampleInputEmail1">Grid (LEFT)</label>
                    <select name="grid_left" id="grid_left" class="form-control m-bot1" data-placeholder="Select...">
                        <option value="">-- Default --</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-1"){ echo "selected=\"selected\""; }?> value="col-xs-1">col-xs-1</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-2"){ echo "selected=\"selected\""; }?> value="col-xs-2">col-xs-2</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-3"){ echo "selected=\"selected\""; }?> value="col-xs-3">col-xs-3</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-4"){ echo "selected=\"selected\""; }?> value="col-xs-4">col-xs-4</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-5"){ echo "selected=\"selected\""; }?> value="col-xs-5">col-xs-5</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-6"){ echo "selected=\"selected\""; }?> value="col-xs-6">col-xs-6</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-7"){ echo "selected=\"selected\""; }?> value="col-xs-7">col-xs-7</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-8"){ echo "selected=\"selected\""; }?> value="col-xs-8">col-xs-8</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-9"){ echo "selected=\"selected\""; }?> value="col-xs-9">col-xs-9</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-10"){ echo "selected=\"selected\""; }?> value="col-xs-10">col-xs-10</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-11"){ echo "selected=\"selected\""; }?> value="col-xs-11">col-xs-11</option>
                        <option <?php if ($rec[0]["grid_left"] == "col-xs-12"){ echo "selected=\"selected\""; }?> value="col-xs-12">col-xs-12</option>
                    </select>
                </div>
                <div class="form-group">
                  
                    <label for="exampleInputEmail1">Grid (RIGHT)</label>
                    <select name="grid_right" id="grid_right" class="form-control m-bot1" data-placeholder="Select...">
                        <option value="">-- Default --</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-1"){ echo "selected=\"selected\""; }?> value="col-xs-1">col-xs-1</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-2"){ echo "selected=\"selected\""; }?> value="col-xs-2">col-xs-2</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-3"){ echo "selected=\"selected\""; }?> value="col-xs-3">col-xs-3</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-4"){ echo "selected=\"selected\""; }?> value="col-xs-4">col-xs-4</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-5"){ echo "selected=\"selected\""; }?> value="col-xs-5">col-xs-5</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-6"){ echo "selected=\"selected\""; }?> value="col-xs-6">col-xs-6</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-7"){ echo "selected=\"selected\""; }?> value="col-xs-7">col-xs-7</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-8"){ echo "selected=\"selected\""; }?> value="col-xs-8">col-xs-8</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-9"){ echo "selected=\"selected\""; }?> value="col-xs-9">col-xs-9</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-10"){ echo "selected=\"selected\""; }?> value="col-xs-10">col-xs-10</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-11"){ echo "selected=\"selected\""; }?> value="col-xs-11">col-xs-11</option>
                        <option <?php if ($rec[0]["grid_right"] == "col-xs-12"){ echo "selected=\"selected\""; }?> value="col-xs-12">col-xs-12</option>
                        
                    </select>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="col-md-12">
        <section class="panel">
          <!-- <header class="panel-heading">
            Buttons
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group col-lg-12">
                  <button class="btn btn-info" name='draft' value="draft">Save as Draft</button>
                  <button class="btn btn-success" name='publish' value="publish">Publish</button>
                  <a href="<?=base_url('webadmin/'.$url_module)?>" class="btn btn-default" type="button">Cancel</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </form>
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
<script>
    $(function() {
        var lebihdiv = $('.lebarwidth').width();
        $('.fileinput-preview').css('max-width',lebihdiv);
        
        $('.input-title-key').blur(function(){
            
            var lang = $(this).attr('lang');
            $.ajax({
                type: "POST",
                url: '<?=base_url("cek_slug")?>',
                //data: { 'a': 1, 'b': 2, 'c': 3 },
                dataType: 'html',
                async:false,
                data: { 'lang': $(this).attr("lang"),'title': $(this).val(),'table': 'kategori_artikel'},
                beforeSend: function () {
                    $("#input-link-key" + lang).val("Loading...");
                },
                success: function (xml) {
                    $("#input-link-key" + lang).val(xml);
                }
            });
            
        });
        //$('.input-title-key').keyup(function(){
//            var title = $(this).val();
//            var lang = $(this).attr('lang');
//            var title = title.replace(/\s+/g, '-');
//            var title = title.toLowerCase();
//            $('#input-link-key'+lang).val(title);
//        });

        $("#tipe_section").change(function(){
            if ($(this).val() == 1){
                $(".content-section").hide();
                $(".source_slide_banner").show();
                $(".input-title-key-1").removeAttr("required");
                $("#source_data").attr("required","");
                $(".input-title_slide_banner-key-1").attr("required","");
                $(".content-slide-banner").show();
                $(".content-setting").hide();   
                
            }
            if ($(this).val() == ""){
                $(".content-section").hide();
                $(".source_slide_banner").hide();
                $(".content-slide-banner").hide();
                $(".content-setting").hide();   
            }
            if ($(this).val() == 2){
                $(".content-section").show();
                $(".source_slide_banner").hide();
                $(".input-title_slide_banner-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".content-slide-banner").hide();
                $(".input-title-key-1").attr("required","");    
                $(".background-noted").text("Witdh : 1400px - Height : 769px");  
                $(".image-noted").text("Witdh : 581px - Height : 583px");         
                $(".content-setting").hide();   
            }
            if ($(this).val() == 3){
                $(".content-section").show();
                $(".source_slide_banner").hide();
                $(".input-title_slide_banner-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".content-slide-banner").hide();
                $(".input-title-key-1").attr("required","");    
                $(".background-noted").text("Witdh : 1400px - Height : 683px"); 
                $(".image-noted").text("Witdh : 351px - Height : 456px"); 
                $(".content-setting").hide();              
            }
            if ($(this).val() == 4){
                $(".content-section").hide();
                $(".source_slide_banner").show();
                $(".input-title-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".input-title_slide_banner-key-1").attr("required","");
                $(".content-slide-banner").show();
                $(".source_slide_banner").hide();
                $(".content-setting").hide();   
                
            }
            if ($(this).val() == 5){
                $(".content-section").show();
                $(".source_slide_banner").hide();
                $(".input-title_slide_banner-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".content-slide-banner").hide();
                $(".input-title-key-1").attr("required","");    
                $(".background-noted").text("Witdh : 1400px - Height : 769px");  
                $(".image-noted").text("Witdh : 581px - Height : 583px");     
                $(".content-setting").hide();          
            }
            if ($(this).val() == 6){
                $(".content-section").show();
                $(".source_slide_banner").hide();
                $(".input-title_slide_banner-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".content-slide-banner").hide();
                $(".input-title-key-1").attr("required","");    
                $(".background-noted").text("Witdh : 1400px - Height : 768px");  
                $(".image-noted").text("Witdh : 476px - Height : 448px");     
                $(".content-setting").show();          
            }
            if ($(this).val() == 7){
                $(".content-section").show();
                $(".source_slide_banner").hide();
                $(".input-title_slide_banner-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".content-slide-banner").hide();
                $(".input-title-key-1").attr("required","");    
                $(".background-noted").text("Witdh : 1400px - Height : 768px");  
                $(".image-noted").text("Witdh : 476px - Height : 448px");     
                $(".content-setting").show();          
            }
        });
    });
    
    var abc = 0; //Declaring and defining global increement variable
    $(document).ready(function() {
        //To add new input file field dynamically, on click of "Add More Files" button below function will be executed
        $('#add_more').click(function() {
            $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/>")
            ));
        });
        $(".radio label").click(function(){
            $(this).prev().find("input").click();
        });
        //following function will executes on change event of file input to select different file	
        $('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                $("#abcd1").remove();
                abc += 1; //increementing global variable by 1
                
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd1' class='abcd'><img id='previewimg" + abc + "' src=''/></div>");
                
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
        //To preview image     
        function imageIsLoaded(e) {
            $('#previewimg' + abc).attr('src', e.target.result);
        };
        $('#upload').click(function(e) {
            var name = $(":file").val();
            if (!name)
            {
                alert("First Image Must Be Selected");
                e.preventDefault();
            }
        });
    });
</script>