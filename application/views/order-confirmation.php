<div class="cart">
    <table style="width: 100%;">
        <tr><td style="text-transform: capitalize;"><strong>HI <?=$name?>, </strong></td></tr>
        <tr><td style="border-bottom: 1px solid #ccc; padding-bottom: 10px;" ><?=$this->lang->line('thanksforshopping');?>!</td></tr>
    </table>
    <br />
    <table style="width:100%">
	<tbody><tr>

		<td bgcolor="#f8f8f8" style="padding:10px; border: 1px solid #d6d4d4">
			<font size="2" face="Open-sans, sans-serif" color="#555454">
				<p style="border-bottom:1px solid #d6d4d4;margin:3px 0 7px;text-transform:uppercase;font-weight:500;font-size:18px;padding-bottom:10px">
					Order details						</p>
				<span style="color:#777">
					<span style="color:#333"><strong>Order:</strong></span> <strong><?=$reference_number?></strong> Placed on <?=date("d/m/Y H:i")?><br><br>
					
				</span>
			</font>
		</td>
		
	</tr>
</tbody></table>
<br />
    <table cellspacing="1" cellpadding="1" style="width: 100%;border-collapse:collapse" >
    <tr><th bgcolor="#f8f8f8" style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px"><?=$this->lang->line('product');?></th><th bgcolor="#f8f8f8" style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px"><?=$this->lang->line('UnitPrice');?></th><th bgcolor="#f8f8f8" style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px"><?=$this->lang->line('quantity');?></th><th bgcolor="#f8f8f8" style="border:1px solid #d6d4d4;background-color:#fbfbfb;color:#333;font-family:Arial;font-size:13px;padding:10px"><?=$this->lang->line('totalprice');?></th></tr>
        <?php
        foreach($cart as $dt){
            $total_price = $dt["price"] * $dt["totalnya"];
            $total_paid = (int)$shipping +  (int)$totalhargaall;
        ?>
        <tr>
            <td style="border:1px solid #d6d4d4; text-align: center;padding-top:10px;padding-bottom:10px;"><img style="width: 30px;" src="<?=base_url("uploads/produk/".$dt["pic"])?>" /><br /><strong><?=$dt["title"]?></strong></td>
            <td style="border:1px solid #d6d4d4; text-align: center"><b class="idr">Rp <?=$controller->rupiah($dt["price"])?></b></td>
            
            <td style="border:1px solid #d6d4d4; text-align: center"><?=$dt["totalnya"]?></td>
            <td style="border:1px solid #d6d4d4; text-align: center">Rp <?=$controller->rupiah($total_price)?></td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td style="padding-top:10px;padding-bottom:10px;border:1px solid #d6d4d4; text-align: center"  colspan="4">&nbsp;</td>
           
        </tr>
        <tr>
            <td bgcolor="#f8f8f8" style="padding-top:10px;padding-bottom:10px;border:1px solid #d6d4d4; text-align: center"  colspan="3">Total</td>
            <td bgcolor="#f8f8f8" style="border:1px solid #d6d4d4; text-align: center">
                Rp <?=$controller->rupiah($totalhargaall)?>
            </td>
        </tr>
        
        <tr>
            <td bgcolor="#f8f8f8" style="padding-top:10px;padding-bottom:10px;border:1px solid #d6d4d4; text-align: center"  colspan="3"><?=$this->lang->line('shipping');?></td>
            <td bgcolor="#f8f8f8" style="border:1px solid #d6d4d4; text-align: center">
                Rp <?=$controller->rupiah($shipping)?>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f8f8f8" style="padding-top:10px;padding-bottom:10px;border:1px solid #d6d4d4;font-size:25px; text-align: center"  colspan="3"><?=$this->lang->line('totalpaid');?></td>
            <td bgcolor="#f8f8f8" style="border:1px solid #d6d4d4; text-align: center;font-size:25px;">
                Rp <?=$controller->rupiah($total_paid)?>
            </td>
        </tr>
    </table>
</div>