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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&.js"></script>

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
            <li class="active">
              <a href="javascript:;">
              Shipping Origin</a>
            </li>
            
          </ul>
        </header>
         
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Province</label>
                <select name="province" class="form-control province" required="">
                    <option value="">-- Select Province --</option>
                    <?php
                    foreach ($prov as $dt){
                        $selected = "";
                        if ($dt["province_id"] == $rec[0]["province_id"]){
                            $selected = "selected=\"selected\"";
                        }else{
                            $selected = "";
                        }
                        ?>
                        <option <?=$selected?> value="<?=$dt["province_id"]?>"><?=$dt["province"]?></option>
                        
                        <?php
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">City</label>
                    <select name="city" class="form-control city"  required="">
                        <option value="">-- Select City --</option>
                        <?php
                        foreach ($city as $dt1){
                            $selected = "";
                            if ($dt1["city_id"] == $rec[0]["city_id"]){
                                $selected = "selected=\"selected\"";
                            }else{
                                $selected = "";
                            }
                            ?>
                            <option <?=$selected?> value="<?=$dt1["city_id"]?>"><?=$dt1["type_city"]?> <?=$dt1["city_name"]?></option>
                            
                            <?php
                        }
                        ?>
                    </select>
              </div>
            </div>
            
            
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
  $(document).on('change', '.province', function (evt) {
                $(".city").attr("disabled","disabled");
                $.ajax({
                    
                    type: "POST",
                    url: '<?=base_url("get_city")?>/',
                    dataType: 'json',
                    data: { 'province_id': $(this).val()},
                    
                    complete: function () {
                        $(".city").removeAttr("disabled");
                    },
                    success: function (data) {
                        $(".city option").remove();
                        $('<option>').val("").text("-- Select City --").appendTo('.city');
                        $.each(data, function(k, v) {
                            $('<option>').val(v.city_id).text(v.type_city + " " + v.city_name).appendTo('.city');
                        });
                    }
                });
            });
            
            $(document).on('change', '.city', function (evt) {
                $(".subdistrict").attr("disabled","disabled");
                $.ajax({
                    
                    type: "POST",
                    url: '<?=base_url("update_district")?>/',
                    dataType: 'json',
                    data: { 'city_id': $(this).val()},
                    
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        $(".subdistrict option").remove();
                        $('<option>').val("").text("-- Select Sub District --").appendTo('.subdistrict');
                        $.each(data, function(k, v) {
                            $('<option>').val(v.subdistrict_id).text(v.subdistrict_name).appendTo('.subdistrict');
                        });
                    }
                });
            });
</script>