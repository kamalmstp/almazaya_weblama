<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <?php if ($permit->isadd == 1): ?>
      <div class="wrap-btn-add">
        <a class="btn btn-primary" href="<?=base_url('webadmin/contactreceiver/act/add')?>">
          <i class="fa fa-plus"></i>&nbsp Add New
        </a>
      </div>
      <?php endif ?>
      <section class="panel">
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/contactreceiver/')?>">
              Publish (<?=$count_publish?>) </a>
            </li>
            <li <?=($statuspage == 'trash') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/contactreceiver/trash')?>">
              Trash (<?=$count_trash?>) </a>
            </li>
          </ul>
        </header>
        <div class="panel-body">
          <div class="adv-table">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th class="hidden-phone">Action</th>
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
                      <a type="button" class="btn btn-warning" href="<?=base_url('webadmin/contactreceiver/act/'.$fungsi.'/'.$row['id'])?>"> Confirm</a>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              <tr>
                <td><?=$row['name']?></td>
                <td><?=$row['email']?></td>
                <td align="right">
                  <?php
                  if ($statuspage == 'trash') {
                  ?>
                  <a class="btn btn-info" href="<?=base_url('webadmin/contactreceiver/act/restore/'.$row['id'])?>">Restore</a>

                  <a class="btn btn-danger" data-toggle="modal" href="#konfirmasi<?=$row['id']?>">Delete Permanently</a>
                  <?php
                  } else {
                  ?>
                  <a href="<?=base_url('webadmin/contactreceiver/act/edit/'.$row['id'])?>" class="btn btn-warning">
                    <i class="fa fa-edit"></i> Edit
                  </a>              
                  <a href="#konfirmasi<?=$row['id']?>" data-toggle="modal" class="btn btn-danger">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php }?>
                </td>
              </tr>
            <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th class="hidden-phone">Action</th>
            </tr>
            </tfoot>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>