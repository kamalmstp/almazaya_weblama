<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <?php if ($permit->isadd == 1): ?>
      
      <div class="wrap-btn-add">
        <a class="btn btn-primary" href="<?=base_url('webadmin/register/?export=1')?>">
          <i class="fa fa-plus"></i>&nbsp export
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
          <div class="adv-table" style="overflow-x: scroll;">
            <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Th Ajaran</th>
              <th>Nama</th>
              <th>Tempat Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Kelurahan</th>
              <th>Kecamatan</th>
              <th>Kota</th>
              <th>Jenis Kelamin</th>
              <th>Asal Sekolah</th>
              <th>Tahun Kelulusan</th>
              <th>Telepon</th>
              <th>Orang Tua</th>
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
                <td><?=$row['awal']?> / <?=$row['akhir']?> </td>
                <td><?=$row['nama']?></td>
                <td><?=$row['tempatlahir']?>, <?=$row['tanggallahir']?></td>
                <td><?=$row['alamat']?></td>
                <td><?=$row['kelurahan']?></td>
                <td><?=$row['kecamatan']?></td>
                <td><?=$row['kota']?></td>
                <td><?=$row['jeniskelamin']?></td>
                <td><?=$row['asalsekolah']?></td>
                <td><?=$row['tahunkelulusan']?></td>
                <td><?=$row['telp']?></td>
                <td>
                    Bapak : <?=$row['nama_bapak']?>, Pekerjaan : <?=$row['pekerjaan_bapak']?><br />
                    Ibu : <?=$row['nama_ibu']?>, Pekerjaan : <?=$row['pekerjaan_ibu']?><br />
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