<?php $this->load->view('sources/header.php')?>
    <section class="section-content shippment shopping_bag container" >
        
        <h1><?=$title_page?></h1>
        <div class="top-section">
            <div class="col-sm-12 no-padding">
                <h4><?=$this->lang->line('ChooseYourBankTransfer');?></h4>
                <?php
                if (isset($cart)){
                ?>
                <div class="bank_transfer">
                    <form class="form-horizontal address_edit_new" role="form" action="" method="POST">
                        <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputPassword3">Bank Transfer</label>
                        <div class="col-sm-9">
                            <select name="bank" class="form-control select_bank">
                                <option value="">-- Select Bank Transfer --</option>
                                <?php
                                foreach ($bank as $dt){
                                    ?>
                                    <option value="<?=$dt["id"]?>"><?=$dt["title"]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputPassword3"></label>
                            <div class="col-sm-9">
                                <?=$this->lang->line('Youhavechosentopaybybanktransfer');?> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputPassword3"></label>
                            <div class="col-sm-9">
                                <p style="font-size: 15px;"><?=$this->lang->line('Thetotalamountofyourorderis');?>  <strong class="totalall" >Rp <?=$controller->rupiah($totalhargaall)?></strong></p>
                                <p style="font-size: 15px;"><?=$this->lang->line('ShippingFeeis');?>  <strong class="shippingfee" >Rp <?=$controller->rupiah($shippingfee)?></strong></p>
                                <p style="font-size: 15px;"><?=$this->lang->line('Thetotalamounttobepaidis');?>  <strong class="totaltobepaid" >Rp <?=$controller->rupiah($totaltobepaid)?></strong></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputPassword3"></label>
                            <div class="col-sm-9 bankdescription">
                                <?php
                                $no = 1;
                                foreach ($bank as $dt){
                                ?>
                                <div class="bankdescription_<?=$dt["id"]?>" style="display: none;">
                                    <?=$dt["description"]?>
                                    <p><b>Please confirm your order by clicking "Place order"</b></p>
                                    
                                </div> 
                                
                                
                                <?php
                                }
                                ?>
                                
                            </div>
                            
                        </div>
                    </form>
                    <div class="button-place-order" style="display: none;">
                        <a class="continueshopping place_order" href="">Place Order</a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <br />
        
        <br />
        
        <br />
        <h1><?=$this->lang->line('myshoppingbag');?> </h1>
        <div class="cart">
            <?php
            if (isset($cart)){
            ?>
            <table cellspacing="1" cellpadding="1" >
            <thead><tr><th><?=$this->lang->line('product');?></th><th>Detail</th><th class="mobile-hide"><?=$this->lang->line('Price');?></th><th class="mobile-hide"><?=$this->lang->line('quantity');?></th><th class="mobile-hide">Total</th><th class="mobile-hide">&nbsp;</th></tr></thead>
            <tbody>
                <?php
                foreach($cart as $dt){
                ?>
                <tr class="baris-<?=$dt["sisterproduk"]?>">
                    <td><img style="width: 30px;" src="<?=base_url("uploads/produk/".$dt["pic"])?>" /></td>
                    <td>
                        <h3><?=$dt["title"]?></h3>
                        <div class="mobile_table_shop">
                            <b class="idr" style="display: block; margin-bottom: 5px;">Price : Rp <?=$controller->rupiah($dt["price"])?></b>
                            
                            <a href="javascript:;" data-id="<?=$dt["sisterproduk"]?>" class="plus-shopping-bag"><img src="<?=base_url("assets/img/plus-shopping-bag.png")?>" /></a>&nbsp;<b class="qty-<?=$dt["sisterproduk"]?>"><?=$dt["totalnya"]?></b>&nbsp;<a href="javascript:;" data-id="<?=$dt["sisterproduk"]?>" class="minus-shopping-bag"><img src="<?=base_url("assets/img/minus-shopping-bag.png")?>" /></a>
                            <br />
                            <a style="display: none;" class="update_qty" data-id="<?=$dt["id_detail"]?>" data-id-harga="<?=$dt["price"]?>" data-id-produk="<?=$dt["sisterproduk"]?>" href="javascript:;"><?=$this->lang->line('Update');?></a>
                            <div style="margin-top: 8px;">Total : <b class="idr idr-<?=$dt["sisterproduk"]?>">Rp <?=$controller->rupiah($dt["totalharga"])?></b></div>
                        </div>
                        
                    </td>
                    <td class="mobile-hide"><b class="idr">Rp <?=$controller->rupiah($dt["price"])?></b></td>
                    <td class="mobile-hide"><a href="javascript:;" data-id="<?=$dt["sisterproduk"]?>" class="plus-shopping-bag"><img src="<?=base_url("assets/img/plus-shopping-bag.png")?>" /></a>&nbsp;<b class="qty-<?=$dt["sisterproduk"]?>"><?=$dt["totalnya"]?></b>&nbsp;<a href="javascript:;" data-id="<?=$dt["sisterproduk"]?>" class="minus-shopping-bag"><img src="<?=base_url("assets/img/minus-shopping-bag.png")?>" /></a>
                        <br />
                        <a style="display: none;" class="update_qty" data-id="<?=$dt["id_detail"]?>" data-id-harga="<?=$dt["price"]?>" data-id-produk="<?=$dt["sisterproduk"]?>" href="javascript:;"><?=$this->lang->line('Update');?></a>
                    </td>
                    <td class="mobile-hide"><b class="idr idr-<?=$dt["sisterproduk"]?>">Rp <?=$controller->rupiah($dt["totalharga"])?></b>
                    <br />
                    
                    </td>
                    <td class="mobile-hide"><a data-id="<?=$dt["id_detail"]?>" data-id-harga="<?=$dt["price"]?>" data-id-produk="<?=$dt["sisterproduk"]?>" class="trash" href="javascript:;"><i class="fa fa-trash-o" ></i> <?=$this->lang->line('Delete');?></a></td>
                </tr>
                
                
                <?php
                }
                ?>
                <?php
                if (isset($cart)){
                ?>
                <tr>
                    <td class="mobile-hide">&nbsp;</td>
                    <td class="mobile-hide">&nbsp;</td>
                    <td class="mobile-hide">&nbsp;</td>
                    <td   style="width: 15%; font-family: Avenir-Medium; font-size: 24px;"><?=$this->lang->line('shippingfee');?></td>
                    <td   style="font-family: Avenir-Medium; font-size:24px;">
                        <b class="shippingfee">Rp <?=$controller->rupiah($shippingfee)?></b>
                    </td>
                    <td class="mobile-hide">&nbsp;</td>
                </tr>
                <tr>
                    <td class="mobile-hide">&nbsp;</td>
                    <td class="mobile-hide">&nbsp;</td>
                    <td class="mobile-hide">&nbsp;</td>
                    <td   style="width: 15%; font-family: Avenir-Medium; font-size: 24px;">Total</td>
                    <td   style="font-family: Avenir-Medium; font-size:24px;">
                        <b class="totaltobepaid">Rp <?=$controller->rupiah($totaltobepaid)?></b>
                    </td>
                    <td class="mobile-hide">&nbsp;</td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
            
            <?php
            }else{
            ?>
            <h4 style="text-align: center;">Your cart is empty</h4>
            <div class="nav-shop">
                <div class="col-sm-12" style="text-align:center;">
                    <a class="continueshopping" href="<?=base_url($codebahasa."products")?>">Continue Shopping</a>
                </div>
               
            </div>
            <?php
            }
            ?>
        </div>
       
    </section>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $("a.plus-shopping-bag").click(function(){
                var dataid = $(this).attr("data-id");
                var qtyawal = parseInt($(this).next().text());
                $(this).next().text(parseInt(qtyawal) + parseInt(1));
                $(".qty-"+ dataid).text(parseInt(qtyawal) + parseInt(1));
                $(this).next().next().next().next().show();
            });
            $("a.minus-shopping-bag").click(function(){
                var dataid = $(this).attr("data-id");
                var qtyawal = parseInt($(this).prev().text());
                if (qtyawal > 1){
                    $(this).prev().text(parseInt(qtyawal) - parseInt(1));
                    $(this).next().next().show();
                    $(".qty-"+dataid).text(parseInt(qtyawal) - parseInt(1));
                }
                
            });
            
            $(".update_qty").click(function(){
                $(".loading").show();
                var qty = parseInt($(this).prev().prev().prev().text());
                var id = parseInt($(this).attr("data-id"));
                var id_produk = parseInt($(this).attr("data-id-produk"));
                var id_harga = parseInt($(this).attr("data-id-harga"));
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("updatecartpayment")?>/',
                    async: false,
                    dataType: 'json',
                    data: { 'qty': qty, 'id': id, 'idproduk': id_produk, 'lang': <?=$id_lang?>},
                    beforeSend: function () {
                        $('.loading').removeAttr("style");
                    },
                    complete: function () {
                        $('.loading').css("display", "none");
                        $(this).hide();
                    },
                    success: function (xml) {
                        $(this).hide();
                        //alert (".idr-"+id);
                        $(".idr-"+id_produk).text("Rp " + convertToRupiah(qty*id_harga) + ",-");
                        $(".qty_cart").text("(" + xml.total_cart + ")");
                        $(".totalall").text(xml.total_harga);
                        $(".update_qty").hide();
                        $(".shippingfee").text(xml.ongkir);
                        $(".totaltobepaid").text(xml.totaltobepaid);
                    }
                });
            });
            $(".trash").click(function(){
                $(".loading").show();
                var qty = parseInt($(this).prev().prev().prev().text());
                var id = parseInt($(this).attr("data-id"));
                var id_produk = parseInt($(this).attr("data-id-produk"));
                var id_harga = parseInt($(this).attr("data-id-harga"));
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("deletecart")?>/',
                    async: false,
                    dataType: 'json',
                    data: { 'qty': qty, 'id': id, 'idproduk': id_produk, 'lang': <?=$id_lang?>},
                    beforeSend: function () {
                        $('.loading').removeAttr("style");
                    },
                    complete: function () {
                        $('.loading').css("display", "none");
                        $(this).hide();
                    },
                    success: function (xml) {
                        if (xml.total_cart == 0){
                            $(".bank_transfer").remove();
                        }
                        $(this).hide();
                        $(".idr-"+id_produk).text("Rp " + convertToRupiah(qty*id_harga) + ",-");
                        $(".qty_cart").text("(" + xml.total_cart + ")");
                        $(".totalall").text(xml.total_harga);
                        $(".update_qty").hide();
                        $(".baris-"+id_produk).remove();
                    }
                });
            });
            $(".select_bank").change(function(){
                var id = $(this).val();
                $(".bankdescription").children("div").hide();
                $(".bankdescription_"+id).show();
                if (id != ""){
                    $(".button-place-order").show();
                }else{
                    $(".button-place-order").hide();
                }
                
            });
            $(".place_order").click(function(){
                $(".loading").show();
                
                $.ajax({
                    type: "POST",
                    url: '<?=base_url($codebahasa."savethedata")?>/',
                    async: false,
                    dataType: 'json',
                    data: { 'bank': $(".select_bank").val()},
                    beforeSend: function () {
                        $('.loading').removeAttr("style");
                    },
                    complete: function () {
                        $('.loading').css("display", "none");
                        $(this).hide();
                        $(this).remove();
                    },
                    success: function (xml) {
                        $(this).remove();
                        window.location.href = "<?=base_url($codebahasa.$next_pages)?>";
                    }
                    
                });
                return false;
            });
        });
        function convertToRupiah(angka){
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return rupiah.split('',rupiah.length-1).reverse().join('');
        }
    </script>
<?php $this->load->view('sources/footer.php')?>