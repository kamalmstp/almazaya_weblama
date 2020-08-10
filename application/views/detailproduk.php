<?php $this->load->view('sources/header-produk.php')?>

<script>
$(window).ready(function(){
    $(".pay").click( function() {
        ga('send', 'event', 'Clicks', 'Pay', 'Proses ke checkout');
    }); 
});
</script>
<section class="section container-fluid" id="section1">
	</section>
    <section class="produk-detail">
    
    <?php
    if ($codebahasa == ""){
        ?>
        
        <a class="cartclick" style="display: none;" href="<?=base_url("cart")?>/" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">&nbsp;</a>
        <?php
    }else{
        ?>
        <a class="cartclick" style="display: none;" href="<?=base_url("cart/?lang=".$codebahasa)?>" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#myModal">&nbsp;</a>
        <?php
    }
    ?>
    
    <!-- Modal HTML -->
    <div id="myModal" class="modal fade modal_cart">
        <div class="modal-dialog">
            <div class="modal-header" style="background: #EF4C27; border-top-left-radius: 5px;border-top-right-radius: 5px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #fff;">
                
                <?php
                if ($codebahasa == ""){
                    ?>
                    
                    Cart
                    <?php
                }else{
                    ?>
                    Keranjang
                    <?php
                }
                ?>
                 <b class="qty_cart"><?=$controller->getcart_qty()?></b></h4>
            </div>
            <div class="modal-content" style="border-radius:0px; box-shadow: none; border: none;">
                <!-- Content will be loaded here from "remote.php" file -->
            </div>
            <div class="modal-footer" style="background: #EF4C27;">
            <div class="col-xs-6" style="text-align:left;">
                <?php
                if ($codebahasa == ""){
                    ?>
                    
                    <a class="pay " data-dismiss="modal" href="javascript:;"> Continue Shopping</a>
                    <?php
                }else{
                    ?>
                    <a class="pay " data-dismiss="modal" href="javascript:;"> Lanjutkan Belanja</a>
                    <?php
                }
                ?>
                
            </div>
            <div class="col-xs-6" style="text-align:right;">
                        <?php
                        if ($codebahasa == ""){
                        ?>
                        <a class="pay" href="<?=base_url($codebahasa."your-shopping-bag")?>">Proceed to checkout</a>
                        <?php
                        }else{
                        ?>
                        <a class="pay" href="<?=base_url($codebahasa."belanjaan-saya")?>">Proses ke checkout</a>
                        <?php
                        }
                        ?>
                        
                        
                
            </div>
            </div>
        </div>
    </div>
    
    
	   <?php
       if (count($detail) > 0){
       ?>
		<div class="container">
           
            <div class="row" style="padding-bottom: 100px; padding-top: 22px;">
                <div class="breadcrumb" style="padding-bottom: 20px;">
                    <a href="<?=base_url()?>">Home</a><?=$parent_breadcrumb?><a href="<?=base_url($codebahasa."/".$link)?>"><?=$current_page?></a><a href="<?=base_url($codebahasa."/".$link."/".$detail[0]["link"])?>"><?=$detail[0]["title"]?></a>
                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="image-produk">
                        <img src="<?=base_url("uploads/produk/".$detail[0]["pic"])?>" />
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="">
                        <h1><?=$detail[0]["title"]?></h1>
                        <div class="box-top">
                            <div class="idrnya">
                                Rp <?=$controller->rupiah($detail[0]["price"])?>
                            </div>
                            <div class="quantity">
                                <h4><?=$this->lang->line('qty');?></h4>
                            </div>
                            <div class="qty">
                                <div class="minus">-</div>
                                <div class="qtynya">1</div>
                                <div class="plus">+</div>
                            </div>
                            <div class="moreinfo">
                                <a href="javascript:void(0);" data-id="<?=$detail[0]["sister"]?>" class="buybutton add-to-cart"><?=$this->lang->line('buy');?></a>
                            </div>
                        </div>
                        <div class="description-produk-detail">
                            <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a class="actives" data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?=$this->lang->line('description');?></a>
                                </h4>
                              </div>
                              <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body"><?=$detail[0]["description"]?></div>
                              </div>
                            </div>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><?=$this->lang->line('productdetail');?></a>
                                </h4>
                              </div>
                              <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body"><?=$detail[0]["product_detail"]?></div>
                              </div>
                            </div>
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"><?=$this->lang->line('shippingreturn');?></a>
                                </h4>
                              </div>
                              <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body"><?=$detail[0]["shipping_return"]?></div>
                              </div>
                            </div>
                          </div> 
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="row" style="padding-bottom: 100px;">
                <?php
                if ($detail[0]["linkyoutube"] != ""){
                    
                    preg_match_all("#(?<=v=|v\/|vi=|vi\/|youtu.be\/)[a-zA-Z0-9_-]{11}#", $detail[0]["linkyoutube"], $matches);
                    
                    //echo "<pre>";
//                    print_r($matches[0][0]);
                ?>
                <div class="col-sm-5 col-sm-offset-1">
                    <a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="https://www.youtube.com/embed/<?=$matches[0][0]?>">
                        <img style="text-align: center; margin: -37px auto auto -37px; position: absolute; width: 54px; left: 50%; top: 50%;" src="<?=base_url('assets/img/play.png')?>" />
                        <?php
                        if ($detail[0]["pic2"] != ""){
                        ?>
                        <img src="<?=base_url('uploads/produk/'.$detail[0]["pic2"])?>" style="width: 100%;">
                        <?php
                        }else{
                        ?>
                        <img src="http://img.youtube.com/vi/<?=$matches[0][0]?>/0.jpg" style="width: 100%;">
                        <?php
                        }
                        ?>
                    </a>
                    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: relative; z-index: 9999; color: white; opacity: 1; font-size: 45px; margin-right: -52px; margin-top: -35px;">&times;</button>
                                    <div>
                                        <iframe width="100%" height="100%" style="border:none;position: absolute; left:0px;top:0px;" src="" style="border: none;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    
                    
                    <div class="others-product">
                        <div class="title-widget">
                            <h3><?=$this->lang->line('othersproduct');?></h3>
                            <hr style="border: 1px solid #EF4C27;" />
                        </div>
                        <ul>
                            <?php
                            foreach ($other_produk as $op){
                                ?>
                                <li>
                                    <a href="<?=base_url($codebahasa.$op["link_detail"].'/'.$op["link_produk"])?>"><img src="<?=base_url("uploads/produk/".$op["pic"])?>" /></a>
                                </li>
                                <?php
                            }
                            ?>
                           
                        </ul>
                    </div>
                </div>
                
                <?php
                }else{
                ?>
                <div class="col-sm-12">
                    
                    
                    <div class="others-product">
                        <div class="title-widget">
                            <h3><?=$this->lang->line('othersproduct');?></h3>
                            <hr style="border: 1px solid #EF4C27;" />
                        </div>
                        <ul>
                            <?php
                            foreach ($other_produk as $op){
                                ?>
                                <li>
                                    <a href="<?=base_url($codebahasa.$op["link_detail"].'/'.$op["link_produk"])?>"><img src="<?=base_url("uploads/produk/".$op["pic"])?>" /></a>
                                </li>
                                <?php
                            }
                            ?>
                           
                        </ul>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            
            
        </div>
        
        <?php
        }else{
        ?>
        <h4 style="text-align: center;">Product Not Available</h4>
        <br />
        <br />
        <?php
        }
        ?>
	</section>
    
    
        <?php $this->load->view('sources/footer-produk.php')?>