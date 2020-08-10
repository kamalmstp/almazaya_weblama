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
            Date &amp; Category
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
              <div class="col-md-12">
                
                <div class="form-group">
                <label for="exampleInputEmail1" style="width:100%;">Date</label>
                <input class="form-control datepicker" style="width: 104px; display: inline-table"  id="tanggal" autocomplete="off" value="<?=date("d-m-Y")?>" name="tanggal" minlength="2" type="text" required />
                <input class="form-control" style="width: 70px; display: inline-table"  id="time" autocomplete="off" name="time" value="<?=date("H:i")?>" minlength="2" type="text" required />
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                 <select name="idmodule" id="idmodule" class="form-control m-bot15" data-placeholder="Select..." id="cdiv">
                    <option value=''>Choose Category</option>
                      <?php
                      foreach ($cat as $row) {
                      ?>
                      <option value="<?=$row['sister']?>"><?=$row['title']?></option>
                      <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              
            </div>
            
          </div>
        </section>
      </div>
      <?php 
      $r = 0;
      foreach ($lang as $rowlang): 
      $required = "";
      if ($r == 0){
        $required = "required='required'";
      }
      ?>
      
      <div class="col-md-12">
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body">
            <div class="form">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Show on <?=$rowlang['title']?> (*)</label>
                  <select name="show[<?=$rowlang['id']?>]" id="show[<?=$rowlang['id']?>]" class="form-control m-bot15" data-placeholder="Show on <?=$rowlang['title']?> >" id="cdiv">
                    <option value=''>-- Choose --</option>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                  </select>
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                    $valuetitle = $status['form']['title'][$rowlang['id']];
                  }else{
                    $valuetitle = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Title (*)</label>
                  <input lang="<?=$rowlang['id']?>" <?=$required?> class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" />
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['link'][$rowlang['id']]) AND $status['form']['link'][$rowlang['id']] != ""){
                    $valuelink = $status['form']['link'][$rowlang['id']];
                  }else{
                    $valuelink = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Link URL</label>
                  <div class="input-group m-bot15">
                  <?php
                  $code_bahasa = "";
                  $cat = "kategori";
                    if ($rowlang["use_default"] != 1){
                        $code_bahasa = $rowlang['lang_code'] . "/";
                        $cat = "category";
                    }
                  ?>
                    <span class="input-group-addon group-addon-mod"><?=base_url()?><?=$code_bahasa?></span>
                    <input type="text" id="input-link-key<?=$rowlang['id']?>" class="form-control" value="<?=$valuelink?>" name="link[<?=$rowlang['id']?>]">
                  </div>
                </div>  
                <!-- <div class="form-group">
                  <?php
                  if(isset($status['form']['subtitle'][$rowlang['id']]) AND $status['form']['subtitle'][$rowlang['id']] != ""){
                    $valuesubtitle = $status['form']['subtitle'][$rowlang['id']];
                  }else{
                    $valuesubtitle = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Subtitle</label>
                  <input class="form-control" placeholder="Enter your subtitle" value="<?=$valuesubtitle?>" name="subtitle[<?=$rowlang['id']?>]" minlength="2" type="text" />
                </div> -->
                <div class="form-group">
                  <?php
                  if(isset($status['form']['content'][$rowlang['id']]) AND $status['form']['content'][$rowlang['id']] != ""){
                    $valuecontent = $status['form']['content'][$rowlang['id']];
                  }else{
                    $valuecontent = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Content</label>
                  <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                </div>
                
                
                
                <div class="form-group">
                  <div class=" col-md-8 no-padding-left lebarwidth">
                  <label for="exampleInputEmail1">Image List (*)</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                          <img src="<?=base_url("assets/backend/images/no-image.png")?>" alt="" />
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
                    <span>Witdh : 345px - Height : 386px</span>
                  </div>
                </div>
                
                
                <div class="form-group">
                  <div class=" col-md-8 no-padding-left lebarwidth">
                  <label for="exampleInputEmail1">Image Detail (*)</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <div class="fileupload-new thumbnail" style="width: 500px; height: 200px;">
                          <img src="<?=base_url("assets/backend/images/no-image.png")?>" alt="" />
                      </div>
                      <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                      <div>
                        <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                          <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="pic2<?=$rowlang['id']?>" />
                        </span>
                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                      </div>
                    </div>
                    <br/>
                    <span class="label label-danger ">NOTE!</span>
                    <span>Witdh : 816px - Height : Bebas</span>
                  </div>
                </div>
                
                <h2 style="margin-left:-15px;margin-right:-15px;">Meta</h2>
                  <div class="form-group">
                  <?php
                  if(isset($status['form']['metatitle'][$rowlang['id']]) AND $status['form']['metatitle'][$rowlang['id']] != ""){
                    $valuemetatitle = $status['form']['metatitle'][$rowlang['id']];
                  }else{
                    $valuemetatitle = "";
                  }
                  ?>
                  <label for="exampleInputEmail1">Title </label>
                  <input lang="<?=$rowlang['id']?>" class="form-control" placeholder="Enter your title" value="<?=$valuemetatitle?>" name="metatitle[<?=$rowlang['id']?>]"  type="text" />
                </div>
                
                <div class="form-group">
                  <?php
                  if(isset($status['form']['metadescription'][$rowlang['id']]) AND $status['form']['metadescription'][$rowlang['id']] != ""){
                    $valuemetadescription = $status['form']['metadescription'][$rowlang['id']];
                  }else{
                    $valuemetadescription = "";
                  }
                  ?>
                  <label for="exampleInputEmail1" style="width: 100%;">Description </label>
                  <textarea class="form-control" name="metadescription[<?=$rowlang['id']?>]"><?=$valuemetadescription?></textarea>
                </div>
              
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php 

      $r++;
      endforeach ?>
      
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
    relative_urls : false,
remove_script_host : false,
convert_urls : true,
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
            if ($(this).val() != ""){
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("cek_slug")?>',
                    //data: { 'a': 1, 'b': 2, 'c': 3 },
                    dataType: 'html',
                    async:false,
                    data: { 'lang': $(this).attr("lang"),'title': $(this).val(),'table': 'artikel'},
                    beforeSend: function () {
                        $("#input-link-key" + lang).val("Loading...");
                    },
                    success: function (xml) {
                        $("#input-link-key" + lang).val(xml);
                    }
                });
            }
        });
        //$('.input-title-key').keyup(function(){
//            var title = $(this).val();
//            var lang = $(this).attr('lang');
//            var title = title.replace(/\s+/g, '-');
//            var title = title.toLowerCase();
//            $('#input-link-key'+lang).val(title);
//        });
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
            $(this).prev().children().click();
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