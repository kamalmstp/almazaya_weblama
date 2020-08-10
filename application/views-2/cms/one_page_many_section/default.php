<!--nestable css-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/js/nestable/jquery.nestable.css')?>" />
<style>
.wrap-title-nestable{
    width: auto;
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
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
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
          </ul>
        </header>
        <div class="panel-body wrap-menu-nestable">
        <?php
        if ($jumlahdata != 0) {
        ?>
        <div class="dd" <?=($statuspage == 'publish' and $permit->isupdate == 1) ? 'id="nestable_list_3"' : '' ;?> lang="banner">
          <ol class="dd-list">
          <?php
            $urut = 0;
            foreach ($rec as $row) {
              if ($statuspage == 'trash') {
                $pesandelete  = "Delete Permanently ";
                $pesanupdate  = "Move to Publish ";
                $fungsidelete = "delete";
                $fungsiupdate = "movepublish";
                $cssclass     = "wrap-title-nestable-trash";
              }elseif ($statuspage == 'draft') {
                $pesandelete  = "Move to Trash ";
                $pesanupdate  = "Move to Publish ";
                $fungsidelete = "movetrash";
                $fungsiupdate = "movepublish";
                $cssclass     = "wrap-title-nestable";
              } else {
                $pesandelete  = "Move to Trash ";
                $pesanupdate  = "Move to Draft ";
                $fungsidelete = "movetrash";
                $fungsiupdate = "movedraft";
                $cssclass     = "wrap-title-nestable";
              }
              
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
                   Are you sure want <?=$pesandelete?> item "<b style="font-style: italic;"><?=$row['title']?> ?</b>"
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
                   Are you sure want <?=$pesanupdate?> item "<b style="font-style: italic;"><?=$row['title']?> ?</b>"
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
            <li class="dd-item dd3-item" data-id="<?=$row['sister']?>">
              <div class="dd-handle dd3-handle ">
              </div>
              <div class="dd3-content">
                <div class="<?=$cssclass?>">
                  <?php

                  //echo $row['title'];
                  if(strlen($row['title'])<= 55){
                    echo $row['title'];
                  }else{
                    echo substr($row['title'], 0, 55)."...";
                  }
                  
                  ?>
                   |
                   
                   <?php
                   if ($row['tipe_section'] == 1){
                    ?>
                    <b>Tipe : Slide Banner</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 2){
                    ?>
                    <b>Tipe : Proudly Papua</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 3){
                    ?>
                    <b>Tipe : Buah Merah Papua</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 4){
                    ?>
                    <b>Tipe : Latest News</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 8){
                    ?>
                    <b>Tipe : Graphic Orac</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 5){
                    ?>
                    <b>Tipe : Why Red - Proudly Papua</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 6){
                    ?>
                    <b>Tipe : Left Text, Right Image (Default)</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 7){
                    ?>
                    <b>Tipe : Left Image, Right Text (Default)</b>
                    <?php
                   }
                   if ($row['tipe_section'] == 9){
                    ?>
                    <b>Tipe : Video Youtube</b>
                    <?php
                   }
                   ?>
                  |
                  <b>Page : <?=$row['pages']?></b>
                  <div class="wrap-img-nestable">
                   
                  </div>
                </div>
                <div class="link-menu">
                  <?php
                  if ($statuspage == 'trash') {
                  ?>
                  <div class="link-menu">
                  <?php if ($permit->isdelete == 1): ?>
                  <a data-toggle="modal" href="#draft<?=$row['sister']?>">Restore to Publish</a>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/movedraft/'.$row['sister'])?>">Restore to Draft</a>
                  <a data-toggle="modal" style="color:red" href="#draggable<?=$row['sister']?>">Delete Permanently</a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  </div>
                  <?php
                  } elseif ($statuspage == 'draft'){
                  ?>
                  <?php if ($permit->isupdate == 1): ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a href="#draft<?=$row['sister']?>" data-toggle="modal" class="link-table blue btn btn-xs default">
                    <i class="fa fa-file-text"></i> Move to Publish
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a href="#draggable<?=$row['sister']?>" data-toggle="modal" class="link-table red btn btn-xs default">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php endif ?>
                  <?php
                  } else {
                  ?>
                  <?php if ($permit->isupdate == 1): ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a href="#draft<?=$row['sister']?>" data-toggle="modal" class="link-table blue btn btn-xs default">
                    <i class="fa fa-file-text-o"></i> Move to Draft
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row['sister'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a href="#draggable<?=$row['sister']?>" data-toggle="modal" class="link-table red btn btn-xs default">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php endif ?>
                  <?php }?>
                </div>
              </div>
            </li>
          <?php
            $urut++;
            }
          ?>
          </ol>
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
  var uri = '<?=base_url('webadmin/reorder_sister')?>';
  var table = 'one_page_many_section';
</script>
<script src="<?=base_url('assets/backend/js/nestable/jquery.nestable.js')?>"></script>
<script src="<?=base_url('assets/backend/js/nestable-init-base.js')?>"></script>