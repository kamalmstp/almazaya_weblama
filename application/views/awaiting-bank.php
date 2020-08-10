

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Eternaleaf</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
   
<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;">Hey <?php echo $name;?>,</p>
<p style="margin-top: -20px;color: #565656;font-family: Arial;font-size: 16px;line-height: 10px;Margin-bottom: 35px"><?=$this->lang->line('thanksforshopping');?> </p>
<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('order');?> <strong><?=$reference_order?></strong> - <?=$this->lang->line('Awaitingbankwirepayment');?> </p>
<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('Yourorderwiththereference');?> <strong><?=$reference_order?></strong> <?=$this->lang->line('hasbeenplaced');?></p>

<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('youhavetoselected');?></p>
<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;"><?=$this->lang->line('ammount');?>: Rp. <?=$total_price?></p>
<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;"><?=$this->lang->line('AccountName');?>: <?=$bank_account_name?></p>
<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;"><?=$bank_name?> - <?=$this->lang->line('Account');?>: <?=$bank_number?></p>

<p style="Margin-top: 0;color: #565656;font-family: Arial;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('Pleasesendyourpayment');?></p>


</div>
</body>
</html>