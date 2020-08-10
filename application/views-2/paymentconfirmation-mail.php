<?php
foreach ($cart as $dt){
?>
<table>

    <tr><td>Date</td><td>:</td><td><?=$dt["crdate"]?></td></tr>
        <tr><td>Reference Order</td><td>:</td><td><?=$dt["reference_order"]?></td></tr>
        <tr><td>Title</td><td>:</td><td><?=$dt["title"]?></td></tr>
        <tr><td>Message</td><td>:</td><td><?=$dt["message"]?></td></tr>
        <tr><td>File</td><td>:</td><td><a href="<?=base_url("uploads/confirmation_payment/".$dt["file"])?>" target="_blank"><img style="max-width: 200px;" src="<?=base_url("uploads/confirmation_payment/".$dt["file"])?>" /></a></td></tr>
</table>
<?php
}
?>