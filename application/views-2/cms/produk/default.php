<!--nestable css-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/js/nestable/jquery.nestable-1level.css')?>" />
<style>
.wrap-title-nestable{
    width: auto;
}
.wrap-title-nestable{
    padding-right: 0px;
}
.link-menu a {
    margin-right: 2px;
}
</style>
<div class="wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="text-right" id="nestable_list_menu" style="margin-bottom:20px;display:inline-block;">
        <?php if ($permit->isadd == 1): ?>  
        <a style="float:left;" class="btn btn-primary" href="<?=base_url('webadmin/'.$url_module.'/act/add')?>">
          <i class="fa fa-plus"></i>&nbsp Add New
        </a>
        <?php endif ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <section class="panel">
        <header  class="panel-heading">
            <?=$title?>
          <!--<ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/'.$url_module.'/')?>">
              Publish (<?=$count_publish?>) </a>
            </li>
            <li <?=($statuspage == 'draft') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/'.$url_module.'/draft')?>">
              Draft (<?=$count_draft?>) </a>
            </li>
            <li <?=($statuspage == 'trash') ? 'class="active"' : '' ;?>>
              <a href="<?=base_url('/webadmin/'.$url_module.'/trash')?>">
              Trash (<?=$count_trash?>) </a>
            </li>
          </ul>-->
        </header>
        <div class="panel-body wrap-menu-nestable">
        <form role="form" class="form-inline" method="GET">
            <div class="form-group">
                <input type="hidden" name="cari" value="1" />
                <input name="keyword" type="text" placeholder="Search Title" id="exampleInputEmail2" class="form-control">
            </div>
            <input class="btn btn-primary" type="submit" value="Search">
            <a class="btn btn-primary" href="<?=base_url('/webadmin/'.$url_module)?>">Show All</a>
        </form>
        <br />
        <?php
        if ($jumlahdata != 0) {
        ?>
        Total Rows : <?=$jumlahdata?>
        <div class="dd" <?=($statuspage == 'publish' and $permit->isupdate == 1) ? 'id="nestable_list_3"' : '' ;?> lang="banner">
          <ol class="dd-list">
          <?php
            $urut = 0;
            $sorting = 1;
            foreach ($rec as $row) {
                $pesandelete  = "Delete ";
                $pesanupdate  = "Update ";
                $pesanhide  = "Hide ";
                $fungsidelete = "deleted";
                if ($row["hidden"] == 0){
                    $fungsiupdate = "hide";
                }else{
                    $fungsiupdate = "unhide";
                }
                $cssclass     = "wrap-title-nestable";
          ?>
          <?php if ($permit->isdelete == 1): ?>
          <div class="modal fade draggable-modal" id="draggable<?=$row['sister']?>" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Information !!!</h4>
                </div>
                <div class="modal-body">
                   Are you sure want <?=$pesandelete.$page?> item "<b style="font-style: italic;"><?=$row['title']?> ?</b>"
                </div>
                <div class="modal-footer">
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/'.$fungsidelete.'/'.$row['sister'])?>" class="btn btn-danger">Yes</a>
                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <?php endif ?>
          <?php if ($permit->isupdate == 1): ?>
          <div class="modal fade draggable-modal" id="draft<?=$row['sister']?>" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Information !!!</h4>
                </div>
                <div class="modal-body">
                   Are you sure want <?=$pesanupdate.$page?> item "<b style="font-style: italic;"><?=$row['title']?> ?</b>"
                </div>
                <div class="modal-footer">
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/'.$fungsiupdate.'/'.$row['sister'])?>" class="btn btn-danger">Yes</a>
                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <?php endif ?>
          <?php if ($permit->ishide == 1): ?>
          <div class="modal fade draggable-modal" id="hide<?=$row['sister']?>" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                  <h4 class="modal-title">Information !!!</h4>
                </div>
                <div class="modal-body">
                   Are you sure want <?=$pesanhide.$page?> item "<b style="font-style: italic;"><?=$row['title']?> ?</b>"
                </div>
                <div class="modal-footer">
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/'.$fungsiupdate.'/'.$row['sister'])?>" class="btn btn-danger">Yes</a>
                  <button type="button" class="btn default" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <?php endif ?>
            <li class="dd-item dd3-item" data-id="<?=$row['sister']?>" data-pos="<?=$sorting?>" data-urut="<?=$urutan?>" data-limit="<?=$limit?>">
              <div class="dd-handle dd3-handle ">
              </div>
              <div class="dd3-content">
                <div class="<?=$cssclass?>">
                  <?php
                  echo $row['title'];
                  /*if(strlen($row['title'])<= 55){
                    echo $row['title'];
                  }else{
                    echo substr($row['title'], 0, 55)."...";
                  }*/
                  ?>
                |
                  <b  class="btn-warning link-table green btn btn-xs default">Page : <?=$row['pages']?></b>
                  <?php
                    if ($row["hidden"] == 1){
                        ?>
                        <b  class="btn-danger link-table green btn btn-xs default"><i class="fa fa-eye-slash"></i> hidden</b>
                        <?php
                    }
                  ?>
                </div>
                <div class="link-menu">
                  <?php if ($permit->isupdate == 1): ?>
                  <a class="btn-primary link-table green btn btn-xs default" href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->ishide == 1): ?>
                  <?php
                    if ($row["hidden"] == 0){
                        ?>
                        <a class="btn-info link-table blue btn btn-xs default" href="#hide<?=$row['sister']?>" data-toggle="modal" class="link-table blue btn btn-xs default">
                            <i class="fa fa-file-text-o"></i> Hide
                        </a>
                        <?php
                    }else{
                        ?>
                        <a class="btn-info link-table blue btn btn-xs default" href="#hide<?=$row['sister']?>" data-toggle="modal" class="link-table blue btn btn-xs default">
                            <i class="fa fa-file-text-o"></i> Unhide
                        </a>
                        <?php
                    }
                  ?>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a class="btn-danger link-table red btn btn-xs default" href="#draggable<?=$row['sister']?>" data-toggle="modal" class="link-table red btn btn-xs default">
                    <i class="fa fa-trash-o"></i> Delete
                  </a>
                  <?php endif ?>
                </div>
              </div>
            </li>
          <?php
          $sorting++;
            $urut++;
            }
          ?>
          </ol>
          <?=$paging?>
        </div>
        <?php
        } else {
        echo "No Data Found";
        }
        ?>
      </div>
      </section>
    </div>
  </div>
</div>
<script>
  var uri = '<?=base_url('webadmin/reorder_sister_desc')?>';
  var table = 'produk';
</script>
<script src="<?=base_url('assets/backend/js/nestable/jquery.nestable.js')?>"></script>
<?php
    if (!isset($_GET["cari"])){
    ?>
    <script src="<?=base_url('assets/backend/js/nestable-init-base.js')?>"></script>
    <?php
}
?>