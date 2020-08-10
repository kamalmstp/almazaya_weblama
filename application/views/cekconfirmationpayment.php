<div class="modal-header">
    <button class="close" data-dismiss="modal" type="button">&times;</button>
    <h4 class="modal-title">Payment Confirmation</h4>
</div>
<div class="modal-body">

<table>

    <tr><td>Date</td><td>:</td><td><?=$cart[0]["crdate"]?></td></tr>
        <tr><td>Reference Order</td><td>:</td><td><?=$cart[0]["reference_order"]?></td></tr>
        <tr><td>Title</td><td>:</td><td><?=$cart[0]["title"]?></td></tr>
        <tr><td>Message</td><td>:</td><td><?=$cart[0]["message"]?></td></tr>
        <tr><td>File</td><td>:</td><td><a href="<?=base_url("uploads/confirmation_payment/".$cart[0]["file"])?>" target="_blank"><img style="max-width: 200px;" src="<?=base_url("uploads/confirmation_payment/".$cart[0]["file"])?>" /></a></td></tr>
</table>

</div>