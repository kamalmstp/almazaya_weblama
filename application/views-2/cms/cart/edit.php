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
      <div class="col-md-8">
        <section class="panel">
                        <header class="panel-heading custom-tab dark-tab">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#home2">REFERENCE ORDER : <?=$rec["reference_order"]?></a>
                                </li>
                                
                            </ul>
                        </header>
                        <div class="panel-body">
                            <div class="tab-content">
                                <table class="table table-bordered table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Detail</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                        </tr>
                                        <tbody>
                                            
                                                <?php
                                                foreach ($produk as $pd){
                                                    ?>
                                                    <tr>
                                                    <td><img height="100" style="height: 100px;" src="<?=base_url("uploads/produk/".$pd["pic"])?>" /></td>
                                                    <td><?=$pd["title"]?></td>
                                                    <td>Rp <?=$controller->rupiah($pd["price"])?></td>
                                                    <td><?=$pd["qty"]?></td>
                                                    <td>Rp <?=$controller->rupiah($pd["total"])?></td>
                                                    </tr>
                                            
                                                    
                                                    <?php
                                                }
                                                ?>
                                                <tr><td colspan="4">Total Order</td><td>Rp <?=$controller->rupiah($rec["total_order"])?></td></tr>
                                                <tr><td colspan="4">Shipping fee</td><td>Rp <?=$controller->rupiah($rec["ongkir"])?></td></tr>
                                                <tr><td colspan="4">Total be paid</td><td>Rp <?=$controller->rupiah($rec["totalbepaid"])?></td></tr>
                                                
                                        </tbody>
                                        </thead>
                                </table>
                            </div>
                         </div>
                    </section>
                    <section class="panel">
                            <header class="panel-heading custom-tab dark-tab">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home2">Address</a>
                                    </li>
                                    
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            
                                            <tbody>
                                                
                                                   <?php
                                                   if (count($address) > 0){
                                                   ?>
                                                        <tr>
                                                            <td>Address : <?=$address[0]["address_value"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sub district : <?=$address[0]["subdistrict_name"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>City : <?=$address[0]["type_city"]?> <?=$address[0]["city_name"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Province : <?=$address[0]["province"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Postal Code : <?=$address[0]["postal_code"]?></td>
                                                        </tr>
                                                    <?php
                                                   }else{
                                                   ?>
                                                   No Address
                                                   <?php
                                                   }
                                                   ?>
                                            </tbody>
                                            </thead>
                                    </table>
                                </div>
                             </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="panel">
                            <header class="panel-heading custom-tab dark-tab">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home2">Customer</a>
                                    </li>
                                    
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <table class="table table-bordered table-striped table-condensed">
                                        <thead>
                                            
                                            <tbody>
                                                
                                                   <?php
                                                   if (count($account) > 0){
                                                   ?>
                                                        <tr>
                                                            <td>Fullname : <?=$account[0]["fullname"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Birthdate : <?=$account[0]["birthdate"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phone : <?=$account[0]["telepon"]?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email : <?=$account[0]["email"]?></td>
                                                        </tr>
                                                    <?php
                                                   }else{
                                                   ?>
                                                   No Address
                                                   <?php
                                                   }
                                                   ?>
                                            </tbody>
                                            </thead>
                                    </table>
                                </div>
                             </div>
                        </section>
                        
                        <section class="panel">
                    <div class="panel-body">
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
                      <div class=" form">
                            <div class="col-lg-9" style="margin-bottom: 20px;">
                            <div class="form-group">
                              <label for="name">Status</label>
                              <select name="status" class="form-control">
                                <option value="0" <?php if ($rec['status'] == 0 ){ echo "selected=\"selected\""; } ?>>Awaiting Payment</option>
                                <option value="1" <?php if ($rec['status'] == 1 ){ echo "selected=\"selected\""; } ?>>Paid</option>
                              </select>
                            </div>
                            
                          </div>
                            <input type="hidden" name="edit" value="1" />
                            <input name="form" type="hidden" value="1">
                          <div class="col-lg-9">
                            <div class="form-group">
                              <label for="name">No Resi</label>
                              <?php
                              if(isset($status['form']['no_resi']) AND $status['form']['no_resi'] != ""){
                                $valuename = $status['form']['no_resi'];
                              }else{
                                $valuename = $rec['no_resi'];
                              }
                              ?>
                              <input class=" form-control" placeholder="Enter Resi Number" id="name" value="<?=$valuename?>" name="resi" type="text" />
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