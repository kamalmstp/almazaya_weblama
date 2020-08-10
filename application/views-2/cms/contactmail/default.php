<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <?php if ($permit->isadd == 1): ?>
      <div class="wrap-btn-add">
        <a class="btn btn-primary" href="<?=base_url('webadmin/contactmail/act/add')?>">
          <i class="fa fa-plus"></i>&nbsp Add New
        </a>
      </div>
      <?php endif ?>
      <section class="panel">
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/contactmail/')?>">
              List Contact Mail</a>
            </li>
            
          </ul>
        </header>
        <div class="panel-body">
          <div class="adv-table">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
            <tr>
                <th>Date</th>
              <th>Name</th>
              <th>Email</th>
              <th>Message</th>
             
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
              
              <tr>
                <td><?=$row['crdate']?></td>
                <td><?=$row['name']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['message']?></td>
               
              </tr>
            <?php
            }
            ?>
            </tbody>
            <tfoot>
            
            </tfoot>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>