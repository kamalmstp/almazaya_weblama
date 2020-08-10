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
                      ?>
                      <option value="<?=$row['sister']?>"><?=$row['title']?></option>
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
                            <option value="1">Slide Banner</option>
                            <option value="2">Proudly Papua Format</option>
                            <option value="3">Buah Merah Format</option>
                            <option value="4">Latest News</option>
                        </optgroup>
                        <optgroup label="------------------------------------------------------">
                            <option value="5">Why Red - Proudly Papua</option>
                        </optgroup>
                        <optgroup label="------------------------------------------------------">
                            <option value="6">Left Text, Right Image (Default)</option>
                            <option value="7">Left Image, Right Text (Default)</option>
                            
                            <option value="8">Graphic Orac</option>
                            
                            <option value="9">Video</option>
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
      <div class="col-md-12 content-slide-banner" style="display: none;">
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa <?php if ($rowlang['id'] > 1){ echo "fa-chevron-up"; }else{ echo "fa-chevron-down"; } ?>" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang_slide[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body" <?php if ($rowlang['id'] > 1){ echo "style='display: none;'"; } ?>>
            <div class="form">
              <div class="col-md-12">
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title_slide_banner'][$rowlang['id']]) AND $status['form']['title_slide_banner'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title_slide_banner'][$rowlang['id']];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Title (*)</label>
                  <input lang="<?=$rowlang['id']?>" class="input-title_slide_banner-key-<?=$rowlang['id']?> form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title_slide_banner[<?=$rowlang['id']?>]" type="text" <?php if ($rowlang['id'] == 1){ ?> required="" <?php } ?>  />
                </div>
                <div class="form-group source_slide_banner" style="display: none;">
                    <select name="source_data[<?=$rowlang['id']?>]" id="source_data" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">                    
                        <option value="">-- Pilih source data --</option>                        <?php
                            foreach ($menu_slide_banner as $dt_slide){                                ?>
                                <option value="<?=$dt_slide["id"]?>"><?=$dt_slide["title"]?></option>
                                <?php                                
                            }
                        ?>
                  </select>
                </div>
                <div class="form-group linkyoutube" style="display: none;">
                  <?php
                  if(isset($status['form']['youtube'][$rowlang['id']]) AND $status['form']['youtube'][$rowlang['id']] != ""){
                    $valueyoutube = $status['form']['youtube'][$rowlang['id']];
                  }else{
                    $valueyoutube = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Link Youtube (*)</label>
                  <input lang="<?=$rowlang['id']?>" class="input-title-youtube-<?=$rowlang['id']?> form-control" placeholder="Enter link youtube" value="<?=$valueyoutube?>" name="link_youtube[<?=$rowlang['id']?>]" type="text" <?php if ($rowlang['id'] == 1){ ?> required="" <?php } ?>  />
                </div>
                
                <div class="form-group bg_video_comparation" style="display: none;">
                  <div class="col-md-offset-2 col-md-8 lebarwidth">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                          <img src="<?=base_url("assets/backend/images/no-image.png")?>" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Background Section</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="background_1<?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span class="background-noted">Witdh : 1400px - Height : 769px</span>
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
      
      
      <div class="col-md-12 content-setting" style="display: none;">
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
                        <option value="#FFFFFF">White</option>
                        <option value="#000000">Black</option>
                        
                    </select>
                </div>
                <div class="form-group">
                  
                    <label for="exampleInputEmail1">Grid (LEFT)</label>
                    <select name="grid_left" id="grid_left" class="form-control m-bot1" data-placeholder="Select...">
                        <option value="">-- Default --</option>
                        <option value="col-xs-1">col-xs-1</option>
                        <option value="col-xs-2">col-xs-2</option>
                        <option value="col-xs-3">col-xs-3</option>
                        <option value="col-xs-4">col-xs-4</option>
                        <option value="col-xs-5">col-xs-5</option>
                        <option value="col-xs-6">col-xs-6</option>
                        <option value="col-xs-7">col-xs-7</option>
                        <option value="col-xs-8">col-xs-8</option>
                        <option value="col-xs-9">col-xs-9</option>
                        <option value="col-xs-10">col-xs-10</option>
                        <option value="col-xs-11">col-xs-11</option>
                        <option value="col-xs-12">col-xs-12</option>
                    </select>
                </div>
                <div class="form-group">
                  
                    <label for="exampleInputEmail1">Grid (RIGHT)</label>
                    <select name="grid_right" id="grid_right" class="form-control m-bot1" data-placeholder="Select...">
                        <option value="">-- Default --</option>
                        <option value="col-xs-1">col-xs-1</option>
                        <option value="col-xs-2">col-xs-2</option>
                        <option value="col-xs-3">col-xs-3</option>
                        <option value="col-xs-4">col-xs-4</option>
                        <option value="col-xs-5">col-xs-5</option>
                        <option value="col-xs-6">col-xs-6</option>
                        <option value="col-xs-7">col-xs-7</option>
                        <option value="col-xs-8">col-xs-8</option>
                        <option value="col-xs-9">col-xs-9</option>
                        <option value="col-xs-10">col-xs-10</option>
                        <option value="col-xs-11">col-xs-11</option>
                        <option value="col-xs-12">col-xs-12</option>
                        
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required"); 
                
            }
            if ($(this).val() == ""){
                $(".content-section").hide();
                $(".source_slide_banner").hide();
                $(".content-slide-banner").hide();
                $(".content-setting").hide();   
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");           
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required"); 
                
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");      
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");        
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
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");      
            }
            if ($(this).val() == 8){
                $(".content-section").hide();
                $(".source_slide_banner").show();
                $(".input-title-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".input-title_slide_banner-key-1").attr("required","");
                $(".content-slide-banner").show();
                $(".source_slide_banner").hide();
                $(".content-setting").hide();   
                $(".linkyoutube").hide();
                $(".linkyoutube").removeAttr("required");
                $(".bg_video_comparation").show();
            }
            
            if ($(this).val() == 9){
                $(".content-section").hide();
                $(".source_slide_banner").show();
                $(".input-title-key-1").removeAttr("required");
                $("#source_data").removeAttr("required");
                $(".input-title_slide_banner-key-1").attr("required","");
                $(".content-slide-banner").show();
                $(".source_slide_banner").hide();
                $(".content-setting").hide();   
                $(".linkyoutube").show();
                $(".bg_video_comparation").show();
                
                
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