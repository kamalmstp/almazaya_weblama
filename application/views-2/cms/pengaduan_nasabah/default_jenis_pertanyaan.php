<!--nestable css-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/backend/js/nestable/jquery.nestable.css')?>" />
<style>
.wrap-title-nestable{
    display: inline-table;
    padding-right: 50px;
    width: calc(100% - 575px);
}
.link-menu a {
    margin-right: 3px;
}
</style>
<div class="page-heading">
    <h3>
        Pengaduan Nasabah &raquo; Jenis Pertanyaan
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="#">Root</a>
        </li>
        <li class="active">
            <a href="<?=base_url("webadmin/".$url_module)?>">Pengaduan Nasabah &raquo; Jenis Pertanyaan </a>
        </li>
    </ul>
  </div>
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
        <div class="dd" <?=($statuspage == 'publish' and $permit->isupdate == 1) ? 'id="nestable_list_3"' : '' ;?> lang="hubungan_investor">
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
                  
                </div>
                <div class="link-menu">
                  <?php
                  if ($statuspage == 'trash') {
                  ?>
                  <div class="link-menu">
                  <?php if ($permit->isdelete == 1): ?>
                  <a data-toggle="modal" class="btn-info link-table red btn btn-xs default" href="#draft<?=$row['sister']?>">Restore to Publish</a>
                  <a class="btn-info link-table red btn btn-xs default" href="<?=base_url('webadmin/hubungan_investor/act/movedraft/'.$row['sister'])?>">Restore to Draft</a>
                  <a data-toggle="modal" class="btn-danger link-table red btn btn-xs default" href="#draggable<?=$row['sister']?>"><i class="fa fa-trash-o"></i> Delete Permanently</a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row['id'])?>" class="link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  </div>
                  <?php
                  } elseif ($statuspage == 'draft'){
                  ?>
                  <?php if ($permit->isupdate == 1): ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row['id'])?>" class="btn-primary link-table green btn btn-xs default">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a href="#draft<?=$row['id']?>" data-toggle="modal" class="btn-info link-table blue btn btn-xs default">
                    <i class="fa fa-file-text"></i> Move to Publish
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row['id'])?>" class="btn-info link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a href="#draggable<?=$row['id']?>" data-toggle="modal" class="btn-danger link-table red btn btn-xs default">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php endif ?>
                  <?php
                  } else {
                  ?>
                 
                  <?php if ($permit->isupdate == 1): ?>
                  <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row['id'])?>" class="btn-primary link-table green btn btn-xs default">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a href="#draft<?=$row['id']?>" data-toggle="modal" class="btn-info link-table blue btn btn-xs default">
                    <i class="fa fa-file-text-o"></i> Move to Draft
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/hubungan_investor/act/view/'.$row['id'])?>" class="btn-info link-table green btn btn-xs default">
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a href="#draggable<?=$row['id']?>" data-toggle="modal" class="btn-danger link-table red btn btn-xs default">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php endif ?>
                  <?php }?>
                </div>
              </div>
              <?php
              if(isset($child[$urut][0])){
              echo '<ol class="dd-list">';

                foreach ($child[$urut] as $row2) { ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <div class="modal fade draggable-modal" id="draggable<?=$row2['id']?>" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title">Information !!!</h4>
                        </div>
                        <div class="modal-body">
                           Are you sure want <?=$pesandelete.$page?> item "<b style="font-style: italic;"><?=$row2['title']?> ?</b>"
                        </div>
                        <div class="modal-footer">
                          <a href="<?=base_url('webadmin/'.$url_module.'/act/'.$fungsidelete.'/'.$row2['id'])?>" class="btn btn-danger">Yes</a>
                          <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <?php endif ?>
                  <?php if ($permit->isupdate == 1): ?>
                  <div class="modal fade draggable-modal" id="draft<?=$row2['id']?>" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title">Information !!!</h4>
                        </div>
                        <div class="modal-body">
                           Are you sure want <?=$pesanupdate.$page?> item "<b style="font-style: italic;"><?=$row2['title']?> ?</b>"
                        </div>
                        <div class="modal-footer">
                          <a href="<?=base_url('webadmin/'.$url_module.'/act/'.$fungsiupdate.'/'.$row2['id'])?>" class="btn btn-danger">Yes</a>
                          <button type="button" class="btn default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <?php endif ?>
                  <li class="dd-item dd3-item" data-id="<?=$row2['id']?>">
                    <div class="dd-handle dd3-handle">
                    </div>
                    <div class="dd3-content">
                      <div style="position: absolute; line-height: 14px; width: 337px; top: 7px;">
                      <?php
                      echo $row2['title'];
                      /*if(strlen($row2['title'])<= 55){
                        echo $row2['title'];
                      }else{
                        echo substr($row2['title'], 0, 55)."...";
                      }*/
                      ?>
                      </div>
                      <div class="link-menu">
                        <?php
                        if ($statuspage == 'trash') {
                        ?>
                        <div class="link-menu">
                        <?php if ($permit->isdelete == 1): ?>
                        <a data-toggle="modal" href="#draft<?=$row2['id']?>">Restore to Publish</a>
                        <a href="<?=base_url('webadmin/'.$url_module.'/act/movedraft/'.$row2['id'])?>">Restore to Draft</a>
                        <a data-toggle="modal" style="color:red" href="#draggable<?=$row2['id']?>">Delete Permanently</a>
                        <?php else: ?>
                        <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row2['id'])?>" class="link-table green btn btn-xs default">
                          <i class="fa fa-eye"></i> View
                        </a>
                        <?php endif ?>
                        </div>
                        
                        <?php
                        } elseif ($statuspage == 'draft'){
                        ?>
                        <?php if ($permit->isupdate == 1): ?>
                        <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row2['id'])?>" class="btn-primary link-table green btn btn-xs default">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="#draft<?=$row2['id']?>" data-toggle="modal" class="btn-info link-table blue btn btn-xs default">
                          <i class="fa fa-file-text"></i> Move to Publish
                        </a>
                        <?php else: ?>
                        <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row2['id'])?>" class="btn-info link-table green btn btn-xs default">
                          <i class="fa fa-eye"></i> View
                        </a>
                        <?php endif ?>
                        <?php if ($permit->isdelete == 1): ?>
                        <a href="#draggable<?=$row2['id']?>" data-toggle="modal" class="btn-danger link-table red btn btn-xs default">
                          <i class="fa fa-trash-o"></i> Move to Trash
                        </a>
                        <?php endif ?>
                        <?php
                        } else {
                        ?>
                       
                        <?php if ($permit->isupdate == 1): ?>
                        <a href="<?=base_url('webadmin/'.$url_module.'/act/edit/'.$row2['id'])?>" class="btn-primary link-table green btn btn-xs default">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="#draft<?=$row2['id']?>" data-toggle="modal" class="btn-info link-table blue btn btn-xs default">
                          <i class="fa fa-file-text-o"></i> Move to Draft
                        </a>
                        <?php else: ?>
                        <a href="<?=base_url('webadmin/'.$url_module.'/act/view/'.$row2['id'])?>" class="btn-info link-table green btn btn-xs default">
                          <i class="fa fa-eye"></i> View
                        </a>
                        <?php endif ?>
                        <?php if ($permit->isdelete == 1): ?>
                        <a href="#draggable<?=$row2['id']?>" data-toggle="modal" class="btn-danger link-table red btn btn-xs default">
                          <i class="fa fa-trash-o"></i> Move to Trash
                        </a>
                        <?php endif ?>
                        <?php }?>
                      </div>
                    </div>
                  </li>
                <?php
                }
                
              echo '</ol>';
                
              }
              ?>
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
  var uri = '<?=base_url('webadmin/reorder_pages')?>'
</script>
<script src="<?=base_url('assets/backend/js/nestable/jquery.nestable.js')?>"></script>
<script src="<?=base_url('assets/backend/js/nestable-init.js')?>"></script>