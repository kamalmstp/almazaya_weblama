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
                        <h4><?=$rec[0]["fullname"]?></h4>
                        <p><?=$this->lang->line('joined');?> <?=$rec[0]["datenya"]?></p>
                        <table>
                            <tr><td><?=$this->lang->line('dateofbirth');?></td><td>: <?=$rec[0]["birthdatenya"]?></td></tr>
                            <tr><td>Email</td><td>: <?=$rec[0]["email"]?></td></tr>
                        </table>
                        <div class="dob">
                            <p><?=$this->lang->line('dateofbirth');?> : <br /><?=$rec[0]["birthdatenya"]?></p>
                            <p>Email : <br /><?=$rec[0]["email"]?></p>
                        </div>
                        <ul style="display: none;">
                            <li><a href="">Edit Profile</a></li>
                            <li><a href="">Edit Password</a></li>
                        </ul>
                        <h4 style="color: #EF4C27;"><?=$this->lang->line('Address');?></h4>
                        <?php
                        if (count($alamat) > 0){
                            echo $alamat[0]["address_value"];
                            ?>
                            <br />
                            <?=$alamat[0]["province"]?>
                            <br />
                            <?=$alamat[0]["subdistrict_name"]?>, <?=$alamat[0]["city_name"]?>
                            <br />
                            <?=$alamat[0]["postal_code"]?>
                            <br />
                            <a style="color: #000; text-decoration: underline" class="cartclick" href="<?=base_url($codebahasa."update_address/?xss=".$this->encrypt->encodeUrl($alamat[0]["uid"],$key))?>" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal"><?=$this->lang->line('editaddress');?></a>
                            <?php
                        }else{
                        ?>
                            <a style="color: #000; text-decoration: underline" class="cartclick" href="<?=base_url($codebahasa."update_address")?>/" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal"><?=$this->lang->line('editaddress');?></a>
                        <?php
                        }
                        ?>
                        <br />
                        
                        <!-- Modal HTML -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div>
                        
                        <br />
                        <br />
                        <h4 style="color: #EF4C27;"><?=$this->lang->line('Phone');?></h4>
                        <p><?=$rec[0]["telepon"]?></p>
                        <br />
                        <br />
                        <div class="edit_myaccount">
                            <ul>
                                <li>
                                <?php
                                if ($codebahasa == ""){
                                    ?>
                                    <a href="<?=base_url("update_account")?>/" data-toggle="modal" data-target="#myModal_editaccount"><?=$this->lang->line('EDITACCOUNT');?></a>
                                    <?php
                                }else{
                                    ?>
                                    <a href="<?=base_url("update_account")?>/?lang=<?=$codebahasa?>" data-toggle="modal" data-target="#myModal_editaccount"><?=$this->lang->line('EDITACCOUNT');?></a>
                                    <?php
                                }
                                ?>
                                    
                                </li>
                                <li>
                                    <?php
                                    if ($codebahasa == ""){
                                        ?>
                                        <a href="<?=base_url("update_password")?>/" data-toggle="modal" data-target="#myModal_editpassword"><?=$this->lang->line('EDITPASSWORD');?></a>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="<?=base_url("update_password")?>/?lang=<?=$codebahasa?>" data-toggle="modal" data-target="#myModal_editpassword"><?=$this->lang->line('EDITPASSWORD');?></a>
                                        <?php
                                    }
                                    ?>
                                    
                                </li>
                            </ul>
                            <!-- Modal HTML -->
                           
                        <div class="modal fade" id="myModal_editaccount" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="myModal_editpassword" role="dialog">
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
            $(document).on('submit', '.address', function (e) {
                $(".submit").val("Loading...");
                var province = $(".province").val();
                var city = $(".city").val();
                var subdistrict = $(".subdistrict").val();
                var address_value = $(".address_value").val();
                var postal_code = $(".postal_code").val();
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
                            setTimeout(explode, 1000);
                            $(".error-form").addClass("alert alert-success");
                            <?php
                            if ($codebahasa == ""){
                                ?>
                                $(".error-form ").text("Successfully Updated Address");
                                <?php
                            }else{
                                ?>
                                $(".error-form ").text("Alamat Berhasil Diubah");
                                <?php
                            }
                            ?>
                            
                        }
                    }
                });
                return false;
            });
            
            $(document).on('submit', '.account', function (e) {
                $(".submit").val("Loading...");
                var form=$(this);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("saveaccount")?>/',
                    dataType: 'html',
                    data:form.serialize(),
                    
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        if (data > 0){
                            setTimeout(explode, 1000);
                            $(".error-form").addClass("alert alert-success");
                            <?php
                            if ($codebahasa == ""){
                                ?>
                                $(".error-form ").text("Successfully Updated Account");
                                <?php
                            }else{
                                ?>
                                $(".error-form ").text("Akun Berhasil Diubah");
                                <?php
                            }
                            ?>
                            
                        }
                    }
                });
                return false;
            });
            
            $(document).on('submit', '.password', function (e) {
                $(".submit").val("Loading...");
                var form=$(this);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("savepassword")?>/',
                    dataType: 'html',
                    data:form.serialize(),
                    
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        if (data.trim() == "00"){
                            $(".submit").val("Submit");
                            $(".error-form").addClass("status-submit");
                            
                            <?php
                            if ($codebahasa == ""){
                                ?>
                                $(".error-form ").text("New Password & Confirm New Password not same");
                                <?php
                            }else{
                                ?>
                                $(".error-form ").text("Kata Sandi Baru dan Konfirmasi Kata Sandi Baru Tidak Sama");
                                <?php
                            }
                            ?>
                        }
                        if (data.trim() == "0"){
                            $(".submit").val("Submit");
                            $(".error-form").addClass("status-submit");
                            <?php
                            if ($codebahasa == ""){
                                ?>
                                $(".error-form ").text("Your password not valid");
                                <?php
                            }else{
                                ?>
                                $(".error-form ").text("Kata Sandi Tidak Valid");
                                <?php
                            }
                            ?>
                            
                        }
                        if (data.trim() == "1"){
                            setTimeout(explode, 2000);
                            $(".error-form").addClass("alert alert-success");
                            
                            <?php
                            if ($codebahasa == ""){
                                ?>
                                $(".error-form ").text("Successfully Updated Password");
                                <?php
                            }else{
                                ?>
                                $(".error-form ").text("Kata Sandi Berhasil Diubah");
                                <?php
                            }
                            ?>
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