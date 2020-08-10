<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<style>
.body{
    width: 100% !important;
}
</style>

<div class="page-heading">
    <h3>
        List Produk &amp; Service &raquo; Edit
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Root</a>
        </li>
        <li class="active">
            <a href="<?=base_url("webadmin/".$url_module)?>">List Produk &amp; Service</a>
        </li>
        <li class="active">
            <a href="javascript:;">Edit</a>
        </li>
    </ul>
</div>
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
          <header class="panel-heading">
            Pages Management
            <span class="tools pull-right">
            </span>
          </header> 
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-lg-12">
                <div class="form-group">
                
                 <select name="category" class="form-control">
                <option value="">-- Pages Management --</option>
                    <?php
                    foreach ($pages as $ct){
                        $selected = "";
                        if ($ct["sister"] == $rec[0]['idpages'])
                        {
                            $selected="selected=\"selected\"";
                        }
                        
                    ?>
                    <option <?=$selected?> value="<?=$ct["sister"]?>"><?=$ct["title"]." ( ".$ct["link"]." ) "?></option>
                    <?php
                    }
                    ?>
                </select>
              </div>
              </div>
            </div>
          </div>
        </section> 
        <?php 
        $r = 0;
        foreach ($lang as $rowlang): ?>
        <input name="id[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['id']?>">
        <input name="slug[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['link']?>">
        <input name="slug_ori[<?=$rowlang['id']?>]" type="hidden" value="<?=$rec[$r]['link_ori']?>">
        <input name="oldpic<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['pic']?>">
        <input name="oldpic_home<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['pic_home']?>">
        <input name="oldthumb<?=$rowlang['id']?>" type="hidden" value="<?=$rec[$r]['thumb']?>">
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-md-12">
                <?php
                if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                  $valuetitle = $status['form']['title'][$rowlang['id']];
                }else{
                  $valuetitle = $rec[$r]['title'];
                }
                ?>
                <label for="exampleInputEmail1">Title Banner (*)</label>
                <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" required />
              </div>
              <div class="form-group col-md-12">
                  <?php
                  if(isset($status['form']['description'][$rowlang['id']]) AND $status['form']['description'][$rowlang['id']] != ""){
                    $valuecontent = $status['form']['description'][$rowlang['id']];
                  }else{
                    $valuecontent = $rec[$r]['description'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Product Detail</label>
                  <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                </div>
                
                <div class="form-group col-md-12">
                  <?php
                  if(isset($status['form']['benefit'][$rowlang['id']]) AND $status['form']['benefit'][$rowlang['id']] != ""){
                    $benefit = $status['form']['benefit'][$rowlang['id']];
                  }else{
                    $benefit = $rec[$r]['benefit'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Benefit</label>
                  <textarea class="texttiny" name="benefit[<?=$rowlang['id']?>]" rows="6"><?=$benefit?></textarea>
                </div>
               <div class="form-group col-md-12">
                 <?php
                  if(isset($status['form']['syarat_pembukaan'][$rowlang['id']]) AND $status['form']['syarat_pembukaan'][$rowlang['id']] != ""){
                    $syarat_pembukaan = $status['form']['syarat_pembukaan'][$rowlang['id']];
                  }else{
                    $syarat_pembukaan = $rec[$r]['syarat_pembukaan'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Syarat Pembukaan</label>
                  <textarea class="texttiny" name="syarat_pembukaan[<?=$rowlang['id']?>]" rows="6"><?=$syarat_pembukaan?></textarea>
                </div>
                <div class="form-group col-md-12">
                  <?php
                  if(isset($status['form']['fitur_umum'][$rowlang['id']]) AND $status['form']['fitur_umum'][$rowlang['id']] != ""){
                    $fitur_umum = $status['form']['fitur_umum'][$rowlang['id']];
                  }else{
                    $fitur_umum = $rec[$r]['fitur_umum'];
                  }
                  ?>
                  <label for="exampleInputEmail1">Fitur Umum</label>
                  <textarea class="texttiny" name="fitur_umum[<?=$rowlang['id']?>]" rows="6"><?=$fitur_umum?></textarea>
                </div>
                
                <div class="form-group">
                <div class="col-md-offset-3 col-md-6 lebarwidth">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail fileupload-preview" style="height: auto; line-height: 20px;">
                      <?php if ($rec[$r]['pic'] != ""): ?>
                      <img src="<?=base_url('uploads/list_produk_service/'.$rec[$r]['pic'])?>" alt=""/>
                      <?php else: ?>
                      <img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
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
                  <span>Witdh : 217px - Height : 267px</span>
                </div>
              </div>
              
              
              <div class="form-group">
                <div class="col-md-offset-3 col-md-6 lebarwidth">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail fileupload-preview" style="height: auto; line-height: 20px;">
                      <?php if ($rec[$r]['pic_home'] != ""): ?>
                      <img src="<?=base_url('uploads/list_produk_service/'.$rec[$r]['pic_home'])?>" alt=""/>
                      <?php else: ?>
                      <img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                      <?php endif ?>
                    </div>
                    <div class="fileupload-preview fileupload-exists thumbnail" style="height: auto; line-height: 20px;"></div>
                    <div>
                      <span class="btn btn-default btn-file" style="margin-left:0px;margin-right:10px">
                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                        <input type="file" class="default" name="pic_home<?=$rowlang['id']?>" />
                      </span>
                      <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                    </div>
                  </div>
                  <br/>
                  <span class="label label-danger ">NOTE!</span>
                  <span>Witdh : 298px - Height : 169px</span>
                </div>
              </div>
            </div>
          </div>
          
        </section>
        
        
        <?php 

        $r++;
        endforeach ?>
        
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
                <button class="btn btn-info" name='draft' value="draft">Save as Draft</button>
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
  var abc = 0; //Declaring and defining global increement variable
    $(document).ready(function() {
        //To add new input file field dynamically, on click of "Add More Files" button below function will be executed
        $('#add_more').click(function() {
            $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/>")
            ));
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