<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Eternaleaf</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div>
   
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hey <?php echo $userName;?>,</p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('WelcometoEternaleafOnlineShopping1');?> <a href="<?=base_url("activate/".$parameter)?>"><?=$this->lang->line('clickhere');?></a> <?=$this->lang->line('WelcometoEternaleafOnlineShopping2');?></p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Email : <?php echo $email;?><br /><?=$this->lang->line('password');?> : <?php echo $password;?></p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('Beforeyoustartonlineshopping');?></p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><a href="<?=base_url("activate/".$parameter)?>"><?=base_url("activate/".$parameter)?></a></p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?=$this->lang->line('thankyou');?>,<br />Eternaleaf</p>
</div>
</body>
</html>