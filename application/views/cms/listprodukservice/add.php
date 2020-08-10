<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<style>
.body{
    width: 100% !important;
}
</style>
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
<div class="page-heading">
    <h3>
        Produk &amp; Layanan (Consumer Banking) &raquo; List Produk &amp; Service
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Root</a>
        </li>
        <li class="active">
            <a href="<?=base_url("webadmin/hubungan_investor")?>">Produk &amp; Layanan (Consumer Banking) &raquo; List Produk &amp; Service </a>
        </li>
        <li class="active">
            <a href="javascript:;">Add</a>
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
        <section class="panel">
          <header class="panel-heading">
            Management Category
            <span class="tools pull-right">
            </span>
          </header> 
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-lg-12">
                <div class="form-group">
                
                <label for="exampleInputEmail1">Category (*)</label>
                <select name="cat" class="form-control" required>
                    <option value=""> -- Choose Pages -- </option>
                    <?php
                    foreach ($pages as $ct){
                    ?>
                    <option value="<?=$ct["sister"]?>"><?=$ct["title"]." ( ".$ct["link"]." ) "?></option>
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
        <section class="panel">
          <header class="panel-heading">
            <?=$rowlang['title']?>
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
          <input name="form" type="hidden" value="1">
          <input name="idlang[]" type="hidden" value="<?=$rowlang['id']?>">
          <div class="panel-body">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <?php
                if(isset($status['form']['title'][$rowlang['id']]) AND $status['form']['title'][$rowlang['id']] != ""){
                  $valuetitle = $status['form']['title'][$rowlang['id']];
                }else{
                  $valuetitle = '';
                }
                ?>
                <label for="exampleInputEmail1">Title (*)</label>
                <input lang="<?=$rowlang['id']?>" class="input-title-key form-control" placeholder="Enter your title" value="<?=$valuetitle?>" name="title[<?=$rowlang['id']?>]" minlength="2" type="text" />
              </div>
              <div class="form-group">
                  <?php
                  if(isset($status['form']['content'][$rowlang['id']]) AND $status['form']['content'][$rowlang['id']] != ""){
                    $valuecontent = $status['form']['content'][$rowlang['id']];
                  }else{
                    $valuecontent = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Product Detail</label>
                  <textarea class="texttiny" name="content[<?=$rowlang['id']?>]" rows="6"><?=$valuecontent?></textarea>
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['benefit'][$rowlang['id']]) AND $status['form']['benefit'][$rowlang['id']] != ""){
                    $valuebenefit = $status['form']['benefit'][$rowlang['id']];
                  }else{
                    $valuebenefit = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Benefit</label>
                  <textarea class="texttiny" name="benefit[<?=$rowlang['id']?>]" rows="6"><?=$valuebenefit?></textarea>
                </div>
               <div class="form-group">
                  <?php
                  if(isset($status['form']['syarat_pembukaan'][$rowlang['id']]) AND $status['form']['syarat_pembukaan'][$rowlang['id']] != ""){
                    $valuesyarat_pembukaan = $status['form']['syarat_pembukaan'][$rowlang['id']];
                  }else{
                    $valuesyarat_pembukaan = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Syarat Pembukaan</label>
                  <textarea class="texttiny" name="syarat_pembukaan[<?=$rowlang['id']?>]" rows="6"><?=$valuesyarat_pembukaan?></textarea>
                </div>
                <div class="form-group">
                  <?php
                  if(isset($status['form']['fitur_umum'][$rowlang['id']]) AND $status['form']['fitur_umum'][$rowlang['id']] != ""){
                    $valuefitur_umum = $status['form']['fitur_umum'][$rowlang['id']];
                  }else{
                    $valuefitur_umum = '';
                  }
                  ?>
                  <label for="exampleInputEmail1">Fitur Umum</label>
                  <textarea class="texttiny" name="fitur_umum[<?=$rowlang['id']?>]" rows="6"><?=$valuefitur_umum?></textarea>
                </div>
                
              <div class="form-group">
                <div class="col-md-offset-3 col-md-6 lebarwidth">
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-new thumbnail" style="width: 400px; height: 200px;">
                        <img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
                    <div class="fileupload-new thumbnail" style="width: 400px; height: 200px;">
                        <img src="http://www.placehold.it/400x200/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
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
                <a href="<?=base_url('webadmin/'.$url_module.'')?>" class="btn btn-default" type="button">Cancel</a>
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