<?php $this->load->view('sources/header.php')?>
    <section class="section-content shippment shopping_bag container" >
        
        <h1><?=$title_page?></h1>
        <div class="top-section">
            <div class="col-sm-12 no-padding">
                <h4><?=$this->lang->line('thankyou');?></h4>
                <div class="content-orderconfirmation">
                    <h3><?=$this->lang->line('thankyou');?></h3>
                    <p><?=$this->lang->line('Wewillnotifyyouonceyourpaymentisconfirmed');?>. </p>
                    <p><?=$this->lang->line('ORDERREFERENCENUMBER');?> : <strong><?=$reference_order?></strong></p>
                    <p><?=$this->lang->line('TOTALAMOUNT');?> : <strong>Rp. <?=$controller->rupiah($totalbepaid)?></strong></p>
                    <br />
                    <p><?=$this->lang->line('TRANSFERTO');?></p>
                    <p><?=$bank_name?></p>
                    <p><strong>A.N. <?=$bank_account_name?></strong></p>
                    <p><strong>AC#<?=$bank_account_number?></strong></p>
                    
                    <br />
                    <?=$this->lang->line('DESC');?>
                    
                </div>
                <p style="text-align: center; margin-bottom: 51px;"><a class="continueshopping" href="<?=base_url($codebahasa.$menu_to_product)?>"><?=$this->lang->line('BACKTO');?> <?=$title_product?></a></p>
            </div>
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
                
            })
        });
        function convertToRupiah(angka){
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return rupiah.split('',rupiah.length-1).reverse().join('');
        }
    </script>
<?php $this->load->view('sources/footer.php')?>