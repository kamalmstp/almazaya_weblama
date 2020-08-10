<?php $this->load->view('sources/header.php')?>
<section class="container account" >
	
		<div class="row">
            
           <div class="col-md-12">
                <div class="col-sm-3 nav-account">
                
                    <ul>
                        <?php
                        $data_akun = $controller->pages_account();
                        //print_r($data_akun);
                        foreach ($data_akun as $pages_sub){
                            if ($link_pages == $pages_sub["link"]){
                                $addclass = "ac";
                            }else{
                                $addclass = "";
                            }
                        ?>
                        <li><a class="<?=$addclass?>" href="<?=base_url($codebahasa.$pages_sub["link"])?>"><?=$pages_sub["title"]?></a></li>
                        <?php
                        }
                        ?>
                        
                    </ul>
                </div>
                
                <div class="col-sm-9 content-account">
                    <h2><?=$title_pages?></h2>
                    
                    <div class="profile">
                       <?php
                       foreach ($alamat as $dt_alamat){
                        $label = $dt_alamat["label_address"];
                        $telepon = $dt_alamat["telepon"];
                        if ($dt_alamat["default"] == 1){
                            $label = $fullname;
                            $telepon = $dt_alamat["telepon_utama"];
                        }
                       ?>
                        <h4 style="color: #EF4C27;"><?=$this->lang->line('Address');?> (<?=$label?>)</h4>
                        <?php
                        if (count($alamat) > 0){
                            echo $dt_alamat["address_value"];
                            ?>
                            <br />
                            <?=$dt_alamat["province"]?>
                            <br />
                            <?=$dt_alamat["subdistrict_name"]?>, <?=$dt_alamat["city_name"]?>
                            <br />
                            <?=$dt_alamat["postal_code"]?>
                            <br />
                            <?php
                            if ($dt_alamat["default"] == 1){
                            ?>
                            <a style="color: red; text-decoration: underline" class="cartclick" href="<?=base_url($codebahasa."update_address/?xss=".$this->encrypt->encodeUrl($dt_alamat["uid"],$key))?>" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal<?=$dt_alamat["uid"]?>"><?=$this->lang->line('editaddress');?></a>
                            <?php
                            }else{
                            ?>
                            <a style="color: red; text-decoration: underline" class="cartclick" href="<?=base_url($codebahasa."update_address_new/?xss=".$this->encrypt->encodeUrl($dt_alamat["uid"],$key))?>" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal<?=$dt_alamat["uid"]?>"><?=$this->lang->line('editaddress');?></a>
                            <?php
                            }
                            ?>
                            <?php
                        }else{
                        ?>
                            
                        <?php
                        }
                        ?>
                        <br />
                        
                        <!-- Modal HTML -->
                        <div class="modal fade" id="myModal<?=$dt_alamat["uid"]?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div>
                        <br />
                        <h4 style="color: #EF4C27;"><?=$this->lang->line('Phone');?></h4>
                        <p><?=$telepon?></p>
                        
                        
                        <br />
                        <br />
                        <?php
                        }
                        ?>
                        <div class="edit_myaccount">
                            <ul>
                                <li>
                                    <a href="<?=base_url($codebahasa."add_address")?>/" data-toggle="modal" data-target="#myModal_address"><?=$this->lang->line('ADDADDRESS');?></a>
                                </li>
                                
                            </ul>
                            <!-- Modal HTML -->
                           
                        <div class="modal fade" id="myModal_address" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div>
                        
                      
                        </div>
                    </div>
                </div>
            </div>
            
            
		</div>
	</section>
    
    
    
    
    <section class="top-footer" style="display: none;">
        &nbsp;
    </section>
    
    <script type="text/javascript">
        $(".form-login").submit(function(){
             $(".loading").show();
        });
        $(document).ready(function(){
            
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
            $(document).on('keydown', '.justnumber', function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                     // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            
            
            
            $(document).on('keydown', '.justnumber', function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                     // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            $(document).on('submit', '.add_address', function (e) {
                
                $(".loading").show();
                var form=$(this);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("save_add_address")?>/',
                    dataType: 'html',
                    data:form.serialize(),
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        if (data > 0){
                            setTimeout(explode, 1000);
                            $(".error-form").addClass("alert alert-success");
                            $(".error-form ").text("Successfully Updated Address");
                        }
                    }
                });
                return false;
            });
            $(document).on('submit', '.address', function (e) {
                $(".loading").show();
                var form=$(this);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("saveaddress")?>/',
                    dataType: 'html',
                    data:form.serialize(),
                    
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        if (data > 0){
                            setTimeout(explode, 2000);
                            $(".error-form").addClass("alert alert-success");
                            $(".error-form ").text("Successfully Updated Address");
                        }
                    }
                });
                return false;
            });
            $(document).on('submit', '.address_edit_new', function (e) {
                $(".loading").show();
                var form=$(this);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("save_add_address")?>/',
                    dataType: 'html',
                    data:form.serialize(),
                    
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        if (data > 0){
                            setTimeout(explode, 2000);
                            $(".error-form").addClass("alert alert-success");
                            $(".error-form ").text("Successfully Updated Address");
                        }
                    }
                });
                return false;
            });
            
        });
        function explode(){
          location.reload();
        }

    </script>
    <style>
        .status-submit{
            color: #fff; background: red ; padding: 10px; margin-bottom: 18px;
        }
    </style>
    <?php $this->load->view('sources/footer.php')?>