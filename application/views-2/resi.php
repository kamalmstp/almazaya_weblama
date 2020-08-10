<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Expedisi JNE</h4>
</div>
<div class="modal-body">
<style>
    td{
        padding: 1px !important; 
        border-bottom: 1px solid #ccc !important;
    }
</style>
<h4>I. Informasi Pengiriman</h4>
    <table class="mobile-hide" class="table_top" style="border-collapse:collapse;margin-bottom: 25px; width:100%;">
        <tbody><tr>
        <td width="130">No Resi</td>
        <td>:</td>
        <td><b><?=$resi["rajaongkir"]["result"]["summary"]["waybill_number"]?></b></td>
        </tr>
        <tr>
        <td>Status</td>
        <td>:</td>
        <td><b><?=$resi["rajaongkir"]["result"]["summary"]["status"]?></b></td>
        </tr>
        <tr>
        <td>Service</td>
        <td>:</td>
        <td><?=$resi["rajaongkir"]["result"]["summary"]["service_code"]?></td>
        </tr>
        <tr>
        <td>Dikirim tanggal</td>
        <td>:</td>
        <td><?=$resi["rajaongkir"]["result"]["summary"]["waybill_date"]?></td>
        </tr>
        <tr>
        <td valign="top">Dikirim oleh</td>
        <td valign="top">:</td>
        <td valign="top"><?=$resi["rajaongkir"]["result"]["summary"]["shipper_name"]?><br><?=$resi["rajaongkir"]["result"]["summary"]["origin"]?></td>
        </tr>
        <tr>
        <td valign="top">Dikirim ke</td>
        <td valign="top">:</td>
        <td valign="top"><?=$resi["rajaongkir"]["result"]["summary"]["receiver_name"]?><br><?=$resi["rajaongkir"]["result"]["summary"]["destination"]?></td>
        </tr>
        <tr>
        <td>JNE Status</td>
        <td>:</td>
        <td><?=$resi["rajaongkir"]["result"]["summary"]["status"]?></td>
        </tr>
        </tbody>
    </table>
        
        
    <table class="mobile_table_shop" class="table_top" style="border-collapse:collapse;margin-left:15px;">
        <tbody>
            <tr>
                <td>No Resi : <b><?=$resi["rajaongkir"]["result"]["summary"]["waybill_number"]?></b></td>
            </tr>
            <tr>
                <td>Status : <b><?=$resi["rajaongkir"]["result"]["summary"]["status"]?></b></td>
            </tr>
            <tr>
                <td>Service : <b><?=$resi["rajaongkir"]["result"]["summary"]["service_code"]?></b></td>
            </tr>
            <tr>
                <td>Dikirim tanggal : <b><?=$resi["rajaongkir"]["result"]["summary"]["waybill_date"]?></b></td>
            </tr>
            <tr>
                <td valign="top">Dikirim oleh : <b><?=$resi["rajaongkir"]["result"]["summary"]["shipper_name"]?><br><?=$resi["rajaongkir"]["result"]["summary"]["origin"]?></b></td>
            </tr>
            <tr>
                <td valign="top">Dikirim ke : <b><?=$resi["rajaongkir"]["result"]["summary"]["receiver_name"]?><br><?=$resi["rajaongkir"]["result"]["summary"]["destination"]?></b></td>
            </tr>
            <tr>
            <td>JNE Status : <b><?=$resi["rajaongkir"]["result"]["summary"]["status"]?></b></td>
            </tr>
        </tbody>
    </table>
    
    
<h4>II. Status Pengiriman</h4>
    <div style="margin-left:15px;margin-top:5px;">
        <b>Outbond</b>
    </div>
    <table  class="table_std" style="width:100%">
    <tbody><tr style="text-align: left">
    <th width="30%">Tanggal</th>
    <th width="30%">Lokasi</th>
    <th width="40%">Keterangan</th>
    </tr>
        <?php
        if (count($manifest) > 0){
            foreach ($manifest as $datnya){
                ?>
                <tr>
                <td><?=$datnya["manifest_date"]?> <?=$datnya["manifest_time"]?></td>
                <td><?=$datnya["city_name"]?></td>
                <td><?=$datnya["manifest_description"]?></td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
    </table>
    
    <div style="margin-left:15px;margin-top:5px;">
        <b>POD Detail</b>
    </div>
    <table  class="table_std" style="width:100%">
    <tbody><tr style="text-align: left">
    <th width="30%">Tanggal</th>
    <th width="30%">Lokasi</th>
    <th width="40%">Keterangan</th>
    </tr>
        <?php
        if (isset($summary)){
            
                ?>
                <tr>
                <td><?=$summary["waybill_date"]?></td>
                <td><?=$summary["destination"]?></td>
                <td><?=$summary["status"]?></td>
                </tr>
                <?php
        }
        ?>
    </tbody>
    </table>
    </div>                  
</form>