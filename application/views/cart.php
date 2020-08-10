
<div class="cart">
    <table cellspacing="1" cellpadding="1" >
        <?php
        foreach($cart as $dt){
        ?>
        <tr>
            <td style="width: 15%;"><img style="width: 62px;" src="<?=base_url("uploads/produk/".$dt["pic"])?>" /></td>
            <td>
                <?=$dt["title"]?>
                <br />
                <b class="idr">Rp <?=$controller->rupiah($dt["price"])?></b>
                <br />
                <?php
                if ($codebahasa == ""){
                    ?>
                    Ammount
                    <?php
                }else{
                    ?>
                    Jumlah
                    <?php
                }
                ?>: <?=$dt["totalnya"]?>
            </td>
        </tr>
        <?php
        }
        ?>
        
        <tr>
            <td  style="width: 15%; font-family: Avenir-Black; font-size:18px;">Total</td>
            <td style="text-align: right; font-family: Avenir-Black; font-size:18px;">
                Rp <?=$controller->rupiah($totalhargaall)?>
            </td>
        </tr>
    </table>
</div>