<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
     
      <section class="panel">
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/contactmail/')?>">
              List Purchases</a>
            </li>
            
          </ul>
        </header>
        <div class="panel-body">
        <form role="form" class="form-inline" method="GET">
            <div class="form-group">
                <input type="hidden" name="cari" value="1" />
                <input name="keyword" type="text" placeholder="Search Reference Order" id="exampleInputEmail2" <?php if (isset($_GET['cari'])){ ?> value="<?=$_GET['keyword']?>" <?php } ?> class="form-control">
            </div>
            
            <input class="btn btn-primary" type="submit" value="Search">
            <a class="btn btn-primary" href="<?=base_url('/webadmin/'.$url_module)?>">Show All</a>
        </form>
        <br />
          <div class="adv-table">
            <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>Date Time</th>
                            <th>Reference Order</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        
                        <?php
                        foreach ($rec as $dt){
                            ?>
                            <tr>
                                <td><?=$dt["crdate"]?></td>
                                
                                <?php
                                if ($dt["status"] == 1){
                                    ?>
                                    <td><button class="btn btn-success btn-xs" type="button"><?=$dt["reference_order"]?></button>
                                    
                                    </td>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($dt["status"] == 0){
                                    ?>
                                    <td><button class="btn btn-danger btn-xs" type="button"><?=$dt["reference_order"]?></button>
                                    
                                    </td>
                                    <?php
                                }
                                ?>
                                <td>Rp <?=$controller->rupiah($dt["totalbepaid"])?></td>
                                <?php
                                if ($dt["status"] == 1){
                                    ?>
                                    <td><button class="btn btn-success btn-xs" type="button">Paid</button>
                                    
                                    <br />
                                    
                                    <?php
                                    if ($dt["confirmation_payment"] > 0){
                                        ?>
                                        <a class="seepayment" href="<?=base_url("cekconfirmationpayment?uid=".$dt["uid"])?>" data-toggle="modal" data-target="#myModal<?=$dt["uid"]?>">See Payment Confirmation</a>
                                        <?php
                                    }
                                    ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <?php
                                if ($dt["status"] == 0){
                                    ?>
                                    <td><button class="btn btn-danger btn-xs" type="button">Awaiting payment</button>
                                    <br />
                                    <?php
                                    if ($dt["confirmation_payment"] > 0){
                                        ?>
                                        <a class="seepayment" href="<?=base_url("cekconfirmationpayment?uid=".$dt["uid"])?>" data-toggle="modal" data-target="#myModal<?=$dt["uid"]?>">See Payment Confirmation</a>
                                        <?php
                                    }
                                    ?>
                                    </td>
                                    <?php
                                }
                                ?>
                                <td>
                                    <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$dt['uid'])?>" class="btn btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>              
                                </td>
                            </tr>
                            <div class="modal fade" id="myModal<?=$dt["uid"]?>" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        
                                        </div>
                                    </div>
                                </div>
                            <?php
                        }
                        ?>
                        
                       
                        </tbody>
                    </table>
                    
                    <?=$paging?>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<style>
.seepayment{
    color: red;
    text-decoration: underline;
    display: inline-table;
    font-size: 11px;
    margin-top: 14px;
    width: 100%;
}
</style>