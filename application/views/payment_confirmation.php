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
                
                <div class="col-sm-9 content-account-purcase">
                    <h2><?=$title_pages?></h2>
                    
                    <div class="mypurcase">   
                        <div class="create_confirmation">
                            <a class="continueshopping" href="<?=base_url($codebahasa."add_confirmation")?>/" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal"><?=$this->lang->line('createpaymentconfirmation');?></a>
                        </div>
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        if (count($rec) > 0){
                        ?>
                        <table class="mobile-hide" style="border-collapse: collapse; width:100%">
                        
                            <tr><th><?=$this->lang->line('date');?></th><th><?=$this->lang->line('referenceorder');?></th><th><?=$this->lang->line('createpaymentconfirmation_title');?></th><th><?=$this->lang->line('createpaymentconfirmation_message');?></th><th>File</th></tr>
                            <?php
                            
                            foreach ($rec as $dt){
                                ?>
                                <tr><td><?=$dt["crdate"]?></td><td><?=$dt["reference"]?><td><?=$dt["title"]?></td><td><?=$dt["message"]?></td><td><a href="<?=base_url("uploads/confirmation_payment/".$dt["file"])?>" target="_blank">File</a></td></tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </table>
                        <?php
                        }else{
                            ?>
                            <p style="margin-top: 20px;">My purchase not available</p>
                            <?php
                        }
                        ?>
                        <table class="mobile_table_shop" style="border-collapse: collapse;">
                        
                            <tr><th style="width:100%;">Order Detail</th></tr>
                            <?php
                            
                            foreach ($rec as $dt){
                                ?>
                                <tr>
                                    <td style="border-bottom: 1px solid #ccc;">
                                    
                                            <p>Date : <?=$dt["crdate"]?></p>
                                            <p>Reference Order : <?=$dt["reference"]?></p>
                                       
                                            <p>Title : <?=$dt["title"]?></p>
                                      
                                            <p>Message : <?=$dt["message"]?></p>
                                            <p>File : <a href="<?=base_url("uploads/confirmation_payment/".$dt["file"])?>" target="_blank">File</a></p>
                                   
                                    </td>
                                    
                                    </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </table>
                        
                        
                        <?=$paging?>
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
            
            $(document).on('submit', '.addconfirmation', function (e) {
                $(".submit").val("Loading...");
                var form=$(this);
                var formData =  new FormData($(this)[0]);
                //formData.append('image', $('input[type=file]')[0].files[0]); 
                //formData.append('image', $('input[type=file]')[0].files[0]); 
                //alert(formData);
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("saveconfirmation")?>/',
                    dataType: 'html',
                    data:formData,
                    contentType: false,
                    processData: false,
                    
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
        table, td, th {
            
            padding:10px;
            font-size:18px !important;
           font-family: Avenir-roman !important;
           color: #8a8a8a !important;
        }
        td{
           font-size:18px !important;
           font-family: Avenir-roman !important;
           color: #8a8a8a !important;
        }
        tr th{
            border-bottom: 1px solid #ccc !important;
            
        }
        td a{
            color: hsl(0, 0%, 54%);
        }
        .create_confirmation{
            display: block; overflow: hidden; padding-top: 30px; padding-bottom: 30px;
        }
    </style>
    <?php $this->load->view('sources/footer.php')?>