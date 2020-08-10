<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <?php if ($permit->isadd == 1): ?>
      
      <div class="wrap-btn-add">
        <a class="btn btn-primary" href="#import"  data-toggle="modal">
          <i class="fa fa-plus"></i>&nbsp Import
        </a>
        <div class="modal fade draggable-modal" id="import" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Import !</h4>
                </div>
                <form method="POST" action=""  enctype="multipart/form-data">
                <div class="modal-body">
                   <div class="form-group">

                    <label for="exampleInputEmail1" style="width:100%;">File Excel</label>
    <input type="file" name="importnya" class="form-control" accept=".xls,.xlsx" />
    
                    </div>
                    <input type="hidden" name="importn" value="1" />
                </div>
                <div class="modal-footer">
                  
                  <button type="submit" class="btn default">Submit</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        <a class="btn btn-primary" href="<?=base_url('siswa/register/?export=1')?>">
          <i class="fa fa-plus"></i>&nbsp Export
        </a>
      </div>
      <?php endif ?>
      <section class="panel">
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/siswa/')?>">
              List Contact Mail</a>
            </li>
          </ul>
        </header>
        <div class="panel-body">
          <div class="adv-table" style="overflow-x: scroll;">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
            <tr>
                <th>NIS</th>
                <th>User ID</th>
              <th>Nama Lengkap</th>
              <th>LP</th>
              <th>Kelas</th>
              <th>No. HP</th>
              <th>NISN</th>
              <th>Tempat Lahir</th>
              <th>Tanggal Lahir</th>
              <th>Nama Wali</th>
              <th>Email</th>
              <th>RFID</th>
              <th>Alamat</th>
              <th>ID Fingerprint</th>
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
                <td><?=$row['nis']?></td>
                <td><?=$row['userid']?></td>
                <td><?=$row['nama_lengkap']?></td>
                <td><?=$row['jenis_kelamin']?></td>
                <td><?=$row['kelas']?></td>
                <td><?=$row['no_hp']?></td>
                <td><?=$row['nisn']?></td>
                <td><?=$row['tempat_lahir']?></td>
                <td><?=$row['nama_wali']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['rfid']?></td>
                <td><?=$row['alamat']?></td>
                <td>
                    <?=$row['fingerprint']?>
                </td>
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