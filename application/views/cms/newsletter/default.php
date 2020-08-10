<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <?php if ($permit->isadd == 1): ?>
  
      <div class="wrap-btn-add">
        <a class="btn btn-primary" href="<?=base_url('webadmin/'.$url_module.'/act/add')?>">
          <i class="fa fa-plus"></i>&nbsp Export to excel
        </a>
      </div>
      <?php endif ?>
      <section class="panel">
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/contactmail/')?>">
              Publish (<?=$count_publish?>) </a>
            </li>
            <!-- <li <?=($statuspage == 'trash') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/contactmail/trash')?>">
              Trash (<?=$count_trash?>) </a>
            </li> -->
          </ul>
        </header>
        <div class="panel-body">
          <div class="adv-table">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
            <tr>
              <th>Email</th>
            </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rec as $row) {
                if ($statuspage == 'trash') {
                  $pesan = "Delete Permanently ";
                  $fungsi = "delete";
                } else {
                  $pesan = "Move to Trash ";
                  $fungsi = "trash";
                }
              ?>
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="konfirmasi<?=$row['id']?>" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                      <h4 class="modal-title">Information !!!</h4>
                    </div>
                    <div class="modal-body">
                      Are you sure want <?=$pesan.$page?> item "<b style="font-style: italic;"><?=$row['name']?> ?</b>"
                    </div>
                    <div class="modal-footer">
                      <a type="button" class="btn btn-warning" href="<?=base_url('webadmin/contactmail/act/'.$fungsi.'/'.$row['id'])?>"> Confirm</a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <tr>
                <td><?=$row['email']?></td>
              </tr>
            <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Email</th>
            </tr>
            </tfoot>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>