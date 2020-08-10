<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<style>
.body{
    width: 100% !important;
}
#map {width: 800px;height: 600px;}
#dragStatus { padding-top: 10px;}
.controls {
margin-top: 10px;
border: 1px solid transparent;
border-radius: 2px 0 0 2px;
box-sizing: border-box;
-moz-box-sizing: border-box;
height: 32px;
outline: none;
box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
background-color: #fff;
font-family: Roboto;
font-size: 15px;
font-weight: 300;
margin-left: 12px;
padding: 0 11px 0 13px;
text-overflow: ellipsis;
width: 300px;
}

#pac-input:focus {
border-color: #4d90fe;
}

.pac-container {
font-family: Roboto;
}

#type-selector {
color: #fff;
background-color: #4d90fe;
padding: 5px 11px 0px 11px;
}

#type-selector label {
font-family: Roboto;
font-size: 13px;
font-weight: 300;
}
#target {
width: 345px;
}

</style>

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
        <input name="form" type="hidden" value="1">
        <section class="panel">
          <header class="panel-heading custom-tab dark-tab">
            <ul class="nav nav-tabs">
            <li>
              <a href="<?=base_url('/webadmin/menu/')?>">
              Side Banner </a>
            </li>
          </ul>
          </header>
         
          <div class="panel-body">
            <?php 
            $r = 0;
            foreach ($lang as $rowlang): 
                $required = "";
                if ($r == 0){
                $required = "required='required'";
            }
            ?>
            <input name="oldpic<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['image']?>">
            <input name="sidebar_ads_global" type="hidden" value="1">
            <input name="idlang[<?=$r?>]" type="hidden" value="<?=$rowlang['id']?>">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Link Banner <?=$rowlang["title"]?></label>
                    <?php
                      if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                        $valuelink = $status['form']['link'][$rowlang['id']];
                      }else{
                        if(count($rec) > 0){
                            $valuelink = $rec[$r]['link'];
                        }else{
                            $valuelink = "";
                        }
                        
                      }
                      ?>
                    <input lang="<?=$rowlang['id']?>" class="form-control" placeholder="Enter your title" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]"  type="text" />
                  </div>
                </div>
                <div class="form-group" style="overflow: hidden;">
                  <div class="col-md-8 lebarwidth" style="padding-left: 0px; overflow: hidden">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      
                        <?php if ($rec[$r]['image'] != ""): ?>
                        <div class="fileupload-new thumbnail" style="width: 133px; height: 200px;">
                        <img src="<?=base_url('uploads/ads/'.$rec[$r]['image'])?>" alt=""/>
                        <?php else: ?>
                        <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">     
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php endif ?>  
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
                    <span>Witdh : 258px - Height : Bebas</span>
                  </div>
                  
                </div>
                <hr />
            <?php
            $r++;
            endforeach 
            ?>
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
                
                <button class="btn btn-success" name='publish' value="publish">Publish</button>
                <a href="<?=base_url('webadmin/'.$url_module)?>" class="btn btn-default" type="button">Cancel</a>
              </div>
            </div>
          </div>
        </section>
      </form>
      
       <form role="form" class="cmxform" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
        <input name="form_top" type="hidden" value="1">
        <section class="panel">
          <header class="panel-heading custom-tab dark-tab">
            <ul class="nav nav-tabs">
            <li>
              <a href="<?=base_url('/webadmin/menu/')?>">
              Top Banner </a>
            </li>
          </ul>
          </header>
         
          <div class="panel-body">
            <?php 
            $r = 0;
            foreach ($lang as $rowlang): 
                $required = "";
                if ($r == 0){
                $required = "required='required'";
            }
            ?>
            <input name="oldpic<?=$rowlang['id']?>" type="hidden" value="<?php if(count($rec_top) > 0){ echo $rec_top[$r]['image']; } ?>">
            <input name="oldpic_m<?=$rowlang['id']?>" type="hidden" value="<?php if(count($rec_top) > 0){ echo $rec_top[$r]['image_m']; } ?>">
            <input name="sidebar_ads_global_top" type="hidden" value="1">
            <input name="idlang[<?=$r?>]" type="hidden" value="<?=$rowlang['id']?>">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Link Banner <?=$rowlang["title"]?></label>
                    <?php
                      if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                        $valuelink = $status['form']['link'][$rowlang['id']];
                      }else{
                        if(count($rec_top) > 0){
                            $valuelink = $rec_top[$r]['link'];
                        }else{
                            $valuelink = "";
                        }
                        
                      }
                      ?>
                    <input lang="<?=$rowlang['id']?>" class="form-control" placeholder="Enter your title" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]"  type="text" />
                  </div>
                </div>
                <div class="form-group" style="display: block; overflow: hidden">
                  <div class=" col-md-4 lebarwidth" style="padding-left: 0px;">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail">
                        <?php if(count($rec_top) > 0){ 
                            if ($rec_top[$r]['image'] != ""){ ?>
                        <img src="<?=base_url('uploads/ads/'.$rec_top[$r]['image'])?>" alt=""/>
                        <?php }else{ ?>
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php } 
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
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image for Desktop</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="pic<?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span>Witdh : 847px - Height : 158px</span>
                  </div>
                  
                  <div class=" col-md-4 lebarwidth" style="padding-left: 0px;">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail">
                        <?php if(count($rec_top) > 0){ 
                            if ($rec_top[$r]['image_m'] != ""){ ?>
                        <img src="<?=base_url('uploads/ads/'.$rec_top[$r]['image_m'])?>" alt=""/>
                        <?php }else{ ?>
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php } 
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
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image for Mobile</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="pic_m<?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span>Witdh : 700px - Height : 287px</span>
                  </div>
                  
                  
                  
                  </div>
                  
                <hr />
            <?php
            $r++;
            endforeach 
            ?>
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
                
                <button class="btn btn-success" name='publish' value="publish">Publish</button>
                <a href="<?=base_url('webadmin/'.$url_module)?>" class="btn btn-default" type="button">Cancel</a>
              </div>
            </div>
          </div>
        </section>
      </form>
      
      
      
      
      <form role="form" class="cmxform" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
        <input name="form_top" type="hidden" value="1">
        <section class="panel">
          <header class="panel-heading custom-tab dark-tab">
            <ul class="nav nav-tabs">
            <li>
              <a href="<?=base_url('/webadmin/menu/')?>">
              Bottom Banner </a>
            </li>
          </ul>
          </header>
         
          <div class="panel-body">
            <?php 
            $r = 0;
            foreach ($lang as $rowlang): 
                $required = "";
                if ($r == 0){
                $required = "required='required'";
            }
            ?>
            <input name="oldpic_bottom<?=$rowlang['id']?>" type="hidden" value="<?php if(count($rec_bottom) > 0){ echo $rec_bottom[$r]['image']; } ?>">
            <input name="oldpic_m_bottom<?=$rowlang['id']?>" type="hidden" value="<?php if(count($rec_bottom) > 0){ echo $rec_bottom[$r]['image_m']; } ?>">
            <input name="sidebar_ads_global_bottom" type="hidden" value="1">
            <input name="idlang[<?=$r?>]" type="hidden" value="<?=$rowlang['id']?>">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Link Banner <?=$rowlang["title"]?></label>
                    <?php
                      if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                        $valuelink = $status['form']['link'][$rowlang['id']];
                      }else{
                        if(count($rec_bottom) > 0){
                            $valuelink = $rec_bottom[$r]['link'];
                        }else{
                            $valuelink = "";
                        }
                        
                      }
                      ?>
                    <input lang="<?=$rowlang['id']?>" class="form-control" placeholder="Enter your title" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]"  type="text" />
                  </div>
                </div>
                <div class="form-group" style="display: block; overflow: hidden">
                  <div class=" col-md-4 lebarwidth" style="padding-left: 0px;">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail">
                        <?php if(count($rec_bottom) > 0){ 
                            if ($rec_bottom[$r]['image'] != ""){ ?>
                        <img src="<?=base_url('uploads/ads/'.$rec_bottom[$r]['image'])?>" alt=""/>
                        <?php }else{ ?>
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php } 
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
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image for Desktop</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="pic_bottom<?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span>Witdh : 847px - Height : 158px</span>
                  </div>
                  
                  <div class=" col-md-4 lebarwidth" style="padding-left: 0px;">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail">
                        <?php if(count($rec_bottom) > 0){ 
                            if ($rec_bottom[$r]['image_m'] != ""){ ?>
                        <img src="<?=base_url('uploads/ads/'.$rec_bottom[$r]['image_m'])?>" alt=""/>
                        <?php }else{ ?>
                        <img src="http://www.placehold.it/500x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                        <?php } 
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
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image for Mobile</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="pic_m_bottom<?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span>Witdh : 700px - Height : 287px</span>
                  </div>
                  
                  
                  
                  </div>
                  
                <hr />
            <?php
            $r++;
            endforeach 
            ?>
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

<script>

$('#commentForm').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
</script>
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