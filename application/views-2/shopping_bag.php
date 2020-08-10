<?php $this->load->view('sources/header.php')?>
    <section class="section-content shopping_bag container" >
        
        <h1><?=$title_page?></h1>
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
                    <td><img style="width: 62px;" src="<?=base_url("uploads/produk/".$dt["pic"])?>" /></td>
                    <td>
                        <h3><?=$dt["title"]?></h3>
                        <div class="mobile_table_shop">
                            <b class="idr" style="display: block; margin-bottom: 5px;"><?=$this->lang->line('price');?> : Rp <?=$controller->rupiah($dt["price"])?></b>
                            
                            <a href="javascript:;" data-id="<?=$dt["sisterproduk"]?>" class="plus-shopping-bag"><img src="<?=base_url("assets/img/plus-shopping-bag.png")?>" /></a>&nbsp;<b class="qty-<?=$dt["sisterproduk"]?>"><?=$dt["totalnya"]?></b>&nbsp;<a href="javascript:;" data-id="<?=$dt["sisterproduk"]?>" class="minus-shopping-bag"><img src="<?=base_url("assets/img/minus-shopping-bag.png")?>" /></a>
                            <br />
                            <a style="display: none;" class="update_qty" data-id="<?=$dt["id_detail"]?>" data-id-harga="<?=$dt["price"]?>" data-id-produk="<?=$dt["sisterproduk"]?>" href="javascript:;">Update</a>
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
                    <td   style="width: 15%; font-family: Avenir-Medium; font-size: 24px;">Total</td>
                    <td   style="font-family: Avenir-Medium; font-size:24px;">
                        <b class="totalall">Rp <?=$controller->rupiah($totalhargaall)?></b>
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
            <h4 style="text-align: center;"><?=$this->lang->line('cartempty');?></h4>
            <div class="nav-shop">
                <div class="col-sm-12" style="text-align:center;">
                <?php
                if ($codebahasa == ""){
                    ?>
                    
                    <a class="continueshopping" href="<?=base_url($codebahasa."products")?>"><?=$this->lang->line('continueshopping');?></a>
                    <?php
                }else{
                    ?>
                    <a class="continueshopping" href="<?=base_url($codebahasa."produk")?>"><?=$this->lang->line('continueshopping');?></a>
                    <?php
                }
                ?>
                    
                </div>
               
            </div>
            <?php
            }
            ?>
        </div>
        <?php
        if (isset($cart)){
        ?>
        <div class="nav-shop">
            <div class="col-xs-6" style="text-align:left; padding-left:0px; padding-right:0px;">
                <a class="continueshopping" href="<?=base_url($codebahasa."products")?>"><?=$this->lang->line('continueshopping');?></a>
            </div>
            <div class="col-xs-6" style="text-align:right;padding-left:0px; padding-right:0px;">
                <a class="continueshopping" href="<?=base_url($codebahasa.$next_pages)?>"><?=$this->lang->line('checkout');?></a>
            </div>
        </div>
        <?php
            }
            ?>
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
                    url: '<?=base_url("updatecart")?>/',
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
                        $(this).hide();
                        $(".idr-"+id_produk).text("Rp " + convertToRupiah(qty*id_harga) + ",-");
                        $(".qty_cart").text("(" + xml.total_cart + ")");
                        $(".totalall").text(xml.total_harga);
                        $(".update_qty").hide();
                        $(".baris-"+id_produk).remove();
                    }
                });
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