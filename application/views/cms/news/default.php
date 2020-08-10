<div class="wrapper">
  <div class="row">
    <div class="col-sm-12">
      <?php if ($permit->isadd == 1): ?>
      <div class="wrap-btn-add">
        <a class="btn btn-primary" href="<?=base_url('webadmin/news/act/add')?>">
          <i class="fa fa-plus"></i>&nbsp Add New
        </a>
      </div>
      <?php endif ?>
      <section class="panel">
        <header class="panel-heading custom-tab dark-tab">
          <ul class="nav nav-tabs">
            <li <?=($statuspage == 'publish') ? 'class="active"' : '' ;?>>
            <?php
            if (isset($_GET["pages"])){
            ?>
            <a href="<?=base_url('/webadmin/news/?pages='.$_GET["pages"])?>">
            <?php
            }else{
            ?>
            <a href="<?=base_url('/webadmin/news/')?>">
            <?php
            }
            ?>
              
              Publish (<?=$count_publish?>) </a>
            </li>
            <li <?=($statuspage == 'draft') ? 'class="active"' : '' ;?>>
            <?php
            if (isset($_GET["pages"])){
            ?>
            <a href="<?=base_url('/webadmin/news/draft?pages='.$_GET["pages"])?>">
            <?php
            }else{
            ?>
            <a href="<?=base_url('/webadmin/news/draft')?>">
            <?php
            }
            ?>
              
              Draft (<?=$count_draft?>) </a>
            </li>
            <li <?=($statuspage == 'trash') ? 'class="active"' : '' ;?>>
            <?php
            if (isset($_GET["pages"])){
            ?>
            <a href="<?=base_url('/webadmin/news/trash?pages='.$_GET["pages"])?>">
            <?php
            }else{
            ?>
            <a href="<?=base_url('/webadmin/news/trash')?>">
            <?php
            }
            ?>
              
              Trash (<?=$count_trash?>) </a>
            </li>
          </ul>
        </header>
        <div class="panel-body">
             <div class="bypages span6 col-lg-3 col-sm-3 control-label" style="padding-left: 0px;">
                <form action="" method="GET">
                <select name="pages" class="form-control"  onchange="this.form.submit()">
                    <option value=''>Choose Pages</option>
                      <?php
                      foreach ($pages as $row) {
                        if ($row['sister'] == $_GET["pages"]) {
                          $select = "selected";
                        } else {
                          $select = "";
                        }
                      ?>
                      <option <?=$select?> value="<?=$row['id']?>"><?=$row['title']?></option>
                      <?php
                      }
                      ?>
                </select>
                </form>
            </div>
          <div class="adv-table">
           
            <table  class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
            <tr>
              <th>Title</th>
              <th>Pages</th>
              <th class="hidden-phone">Action</th>
            </tr>
            </thead>
            <tbody>
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
                    
                        <?php
                        if (isset($_GET["pages"])){
                        ?>
                        <a href="<?=base_url('webadmin/news/act/'.$fungsidelete.'/'.$row['sister'].'?pages='.$_GET["pages"])?>" class="btn btn-danger">Yes</a>
                        <?php
                        }else{
                        ?>
                        <a href="<?=base_url('webadmin/news/act/'.$fungsidelete.'/'.$row['sister'])?>" class="btn btn-danger">Yes</a>
                        <?php
                        }
                        ?>
                      
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
                        <?php
                        if (isset($_GET["pages"])){
                        ?>
                        <a href="<?=base_url('webadmin/news/act/'.$fungsiupdate.'/'.$row['sister'].'?pages='.$_GET["pages"])?>" class="btn btn-danger">Yes</a>
                        <?php
                        }else{
                        ?>
                        <a href="<?=base_url('webadmin/news/act/'.$fungsiupdate.'/'.$row['sister'])?>" class="btn btn-danger">Yes</a>
                        <?php
                        }
                        ?>
                      
                      <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <?php endif ?>
              <tr>
               
                <td><?=$row['title']?></td>
                <td><?=$row['pages']?></td>
                <td align="right">
                  <?php
                  if ($statuspage == 'trash') {
                  ?>
                  <div class="link-menu">
                  <?php if ($permit->isdelete == 1): ?>
                  <a class="btn btn-success" data-toggle="modal" href="#draft<?=$row['sister']?>">Restore to Publish</a>
                  <a class="btn btn-warning" href="<?=base_url('webadmin/news/act/movedraft/'.$row['sister'])?>">Restore to Draft</a>
                  <a class="btn btn-danger" data-toggle="modal" href="#draggable<?=$row['sister']?>">Delete Permanently</a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/news/act/view/'.$row['sister'])?>" >
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  </div>
                  <?php
                  } elseif ($statuspage == 'draft'){
                  ?>
                  <?php if ($permit->isupdate == 1): ?>
                  
                  
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a class="btn btn-success" href="#draft<?=$row['sister']?>" data-toggle="modal" >
                    <i class="fa fa-file-text"></i> Move to Publish
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/news/act/view/'.$row['sister'])?>" >
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a class="btn btn-danger" href="#draggable<?=$row['sister']?>" data-toggle="modal">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php endif ?>
                  <?php
                  } else {
                  ?>
                  <?php if ($permit->isupdate == 1): ?>
                  <?php
                    if (isset($_GET["pages"])){
                    ?>
                    <a class="btn btn-info" href="<?=base_url('webadmin/news/act/edit/'.$row['sister'].'?pages='.$_GET["pages"])?>" >
                    <?php
                    }else{
                    ?>
                    <a class="btn btn-info" href="<?=base_url('webadmin/news/act/edit/'.$row['sister'])?>" >
                    <?php
                    }
                  ?>
                  
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a class="btn btn-warning" href="#draft<?=$row['sister']?>" data-toggle="modal" >
                    <i class="fa fa-file-text-o"></i> Move to Draft
                  </a>
                  <?php else: ?>
                  <a href="<?=base_url('webadmin/news/act/view/'.$row['sister'])?>" >
                    <i class="fa fa-eye"></i> View
                  </a>
                  <?php endif ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <a  class="btn btn-danger" href="#draggable<?=$row['sister']?>" data-toggle="modal">
                    <i class="fa fa-trash-o"></i> Move to Trash
                  </a>
                  <?php endif ?>
                  <?php }?>
                </td>
              </tr>
            <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
              <th>Title</th>
              <th>Code</th>
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