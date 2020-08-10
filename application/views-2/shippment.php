<?php $this->load->view('sources/header.php')?>
    <section class="section-content shippment shopping_bag container" >
        
        <h1><?=$title_page?></h1>
        <div class="top-section">
        <div class="col-sm-12 no-padding">
            <h4><?=$this->lang->line('shippingdetails');?></h4>
            <?php
            if (count($alamat) == 0){
            ?>
            <div class="form-error" style="background: red none repeat scroll 0% 0%; color: rgb(255, 255, 255); padding: 10px; text-align: center;">
                Please Add Address before to payment
            </div>
            <?php
            }
            ?>
        </div>
            <div class="col-sm-12 no-padding detail_shipping">
                <div class="col-sm-4 no-padding shipping ">
                    <?php
                    if (count($other_alamat) > 1){
                    ?>
                    <h6><?=$this->lang->line('Chooseashippingaddress');?>:</h6>

                    <div class="select_address">
                        <select name="choose_address" class="form-control choose_address">
                            <?php
                                foreach($other_alamat as $dt){
                                    if ($dt["label_address"] == ""){
                            ?>
                            <option value="<?=$this->encrypt->encodeUrl($dt["uid"],$this->key)?>"><?=$dt["fullname"]?></option>
                            <?php
                            }else{
                            ?>
                            <option value="<?=$this->encrypt->encodeUrl($dt["uid"],$this->key)?>"><?=$dt["label_address"]?></option>
                            <?php
                            }
                            }
                            ?>
                        </select>
                    </div>
                    <?php
                    }
                    ?>
                    <h6><?=$this->lang->line('Shippingaddress');?></h6>
                    
                    <?php
                    if (count($alamat) > 0){
                    ?>
                    <input type="hidden" name="uid" value="<?=$this->encrypt->encodeUrl($alamat[0]["uid"],$key)?>" class="uid_address" />
                    <p class="address_value"><?=$alamat[0]["address_value"]?></p>
                    <p class="subdistrict_name"><?=$alamat[0]["subdistrict_name"]?></p>
                    <p class="city_provinsi"><?=$alamat[0]["city_name"]?>, <?=$alamat[0]["province"]?></p>
                    <p class="postal_code"><?=$alamat[0]["postal_code"]?></p>
                    
                    <br />
                    <br />
                    <p><a class="update_address"  style="text-transform: none;" data-toggle="modal" data-target="#myModal_address" href="<?=base_url($codebahasa."update_current_address/?xss=".$this->encrypt->encodeUrl($alamat[0]["uid"],$key))?>"><?=$this->lang->line('updatecurrentaddress');?></a></p>
                    
                    <div class="modal fade" id="myModal_address" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-12 no-padding detail_shipping">
                    <br />
                        <p><a style="text-transform: none;" href="<?=base_url($codebahasa."add_address")?>/" data-toggle="modal" data-target="#myModal_address"><?=$this->lang->line('AddaNewAddress');?></a></p>
                        <div class="modal fade" id="myModal_address" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div> 
                    </div>
                    <?php
                    }else{
                    ?>
                    <p><a style="text-transform: none;" href="<?=base_url($codebahasa."add_address")?>/" data-toggle="modal" data-target="#myModal_address"><?=$this->lang->line('AddaNewAddress');?></a></p>
                        <div class="modal fade" id="myModal_address" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div> 
                    <?php
                    }
                    ?>
                </div>
                
                <div class="col-sm-4 no-padding shipping">
                    <h6><?=$this->lang->line('EmailAddress');?></h6>
                    <p class="email"><?=$account[0]["email"]?></p>
                    <h6><?=$this->lang->line('ContactNumber');?></h6>
                    <p class="telepon"><?=$account[0]["telepon"]?></p>
                </div>
                
                <div class="col-sm-4 no-padding shipping">
                    <h6><?=$this->lang->line('ShippingFee');?></h6>
                    <?php
                    if (count($alamat) > 0){
                    ?>
                    <p><strong class="ongkir">Rp <?=$controller->rupiah($ongkir)?></strong></p>
                    <p>Estimated delivery time : 3 - 7<!--<?=$etd?>--> working days
from the payment confirmation date</p>
                    <?php
                    }
                    ?>
                </div>
            </div>
            
            
            
        </div>
        
        <?php
        if (isset($cart)){
        ?>
        <?php
        if (count($alamat) > 0){
        ?>
        <div class="nav-shop" style="overflow: hidden; display: block; width:100%;">
            <div class="col-xs-6" style="text-align:left; padding-left:0px; padding-right:0px;">
                <a class="continueshopping" href="<?=base_url($codebahasa.$prev_pages."/")?>"><?=$this->lang->line('ShoppingBag');?></a>
            </div>
            <div class="col-xs-6" style="text-align:right;padding-left:0px; padding-right:0px;">
                <a class="continueshopping" href="<?=base_url($codebahasa.$next_pages."/")?>"><?=$this->lang->line('ProceedtoPayment');?></a>
            </div>
        </div>
        <?php
            }}
            ?>
    </section>
    <script type="text/javascript">
        $(".form-login").submit(function(){
             $(".loading").show();
        });
        $(document).ready(function(){
            
            $(document).on('change', '.province', function (evt) {
                $(".city").attr("disabled","disabled");
                $(".subdistrict").val("");
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
                var form=$(this);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("update_current_address_submit")?>/',
                    dataType: 'html',
                    data:form.serialize(),
                    
                    complete: function () {
                        $(".subdistrict").removeAttr("disabled");
                    },
                    success: function (data) {
                        if (data > 0){
                            $(".choose_address").change();
                            $(".error-form").addClass("alert alert-success");
                            $(".error-form ").text("Successfully Updated Address");
                        }
                    }
                });
                return false;
            });
            $(document).on('change', '.choose_address', function (e) {
                $(".loading").show();
                var addressnya = $(this).val();
                var weight = <?=$totalweightall;?>;
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("select_address")?>/',
                    dataType: 'json',
                    data: { 'uid': addressnya, 'weight': weight},
                    async: false,
                    complete: function () {},
                    success: function (data) {
                        $.each(data.result, function(index, element) {
                            $(".address_value").text(element.address_value);
                            $(".subdistrict_name").text(element.subdistrict_name)
                            $(".city_provinsi").text(element.city_name + ", " +element.province);
                            $(".postal_code").text(element.postal_code);
                            $(".telepon").text(element.telepon);
                            
                            if (element.telepon == ""){
                                $(".telepon").text(element.telepon_utama);
                            }
                            $(".update_address").attr("href","<?=base_url($codebahasa."update_current_address/?xss=")?>" + data.uid);
                            
                        });
                        $(".uid_address").val(data.uid);
                        $(".ongkir").text(data.ongkir);
                        $(".loading").hide();
                    }
                });
                return false;
            });
            $('body').on('hidden.bs.modal', '.modal', function () {
  $(this).removeData('bs.modal');
}); 
        });
        function explode(){
          location.reload();
        }

    </script>
    
    
    <style>
    .modal-header h4{
        border: none;
    }
    
    </style>
    <style>
        .status-submit{
            color: #fff; background: red ; padding: 10px; margin-bottom: 18px;
        }
    </style>
<?php $this->load->view('sources/footer.php')?>