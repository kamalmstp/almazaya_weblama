
                                        
                                        
                                        
<?php
              if(isset($rec)){
              echo '<ol class="dd-list">';

                foreach ($rec as $row2) { ?>
                  <?php if ($permit->isdelete == 1): ?>
                  <div class="modal fade draggable-modal" id="draggable<?=$row2['id']?>" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                          <h4 class="modal-title">Information !!!</h4>
                        </div>
                        <div class="modal-body">
                           Are you sure want Move to Trash <?=$page?> item "<b style="font-style: italic;"><?=$row2['title']?> ?</b>"
                        </div>
                        <div class="modal-footer">
                          <a href="<?=base_url('webadmin/pages/act/movetrash/'.$row2['id'])?>" class="btn btn-danger">Yes</a>
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
                           Are you sure want Move to Draft pages item <?=$page?> item "<b style="font-style: italic;"><?=$row2['title']?> ?</b>"
                        </div>
                        <div class="modal-footer">
                          <a href="<?=base_url('webadmin/pages/act/movedraft/'.$row2['id'])?>" class="btn btn-danger">Yes</a>
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
                      <?=$row2['title']?>
                      <div class="link-menu">
                        <?php
                        if ($statuspage == 'trash') {
                        ?>
                        <div class="link-menu">
                        <?php if ($permit->isdelete == 1): ?>
                        <a data-toggle="modal" href="#draft<?=$row2['id']?>">Restore to Publish</a>
                        <a href="<?=base_url('webadmin/pages/act/movedraft/'.$row2['id'])?>">Restore to Draft</a>
                        <a data-toggle="modal" style="color:red" href="#draggable<?=$row2['id']?>">Delete Permanently</a>
                        <?php else: ?>
                        <a href="<?=base_url('webadmin/pages/act/view/'.$row2['id'])?>" class="link-table green btn btn-xs default">
                          <i class="fa fa-eye"></i> View
                        </a>
                        <?php endif ?>
                        </div>
                        <?php
                        } elseif ($statuspage == 'draft'){
                        ?>
                        <?php if ($permit->isupdate == 1): ?>
                        <a href="<?=base_url('webadmin/pages/act/edit/'.$row2['id'])?>" class="link-table green btn btn-xs default">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="#draft<?=$row2['id']?>" data-toggle="modal" class="link-table blue btn btn-xs default">
                          <i class="fa fa-file-text"></i> Move to Publish
                        </a>
                        <?php else: ?>
                        <a href="<?=base_url('webadmin/pages/act/view/'.$row2['id'])?>" class="link-table green btn btn-xs default">
                          <i class="fa fa-eye"></i> View
                        </a>
                        <?php endif ?>
                        <?php if ($permit->isdelete == 1): ?>
                        <a href="#draggable<?=$row2['id']?>" data-toggle="modal" class="link-table red btn btn-xs default">
                          <i class="fa fa-trash-o"></i> Move to Trash
                        </a>
                        <?php endif ?>
                        <?php
                        } else {
                        ?>
                        <?php if ($permit->isupdate == 1): ?>
                        <a href="<?=base_url('webadmin/pages/act/edit/'.$row2['id'])?>" class="link-table green btn btn-xs default">
                          <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="#draft<?=$row2['id']?>" data-toggle="modal" class="link-table blue btn btn-xs default">
                          <i class="fa fa-file-text-o"></i> Move to Draft
                        </a>
                        <?php else: ?>
                        <a href="<?=base_url('webadmin/pages/act/view/'.$row2['id'])?>" class="link-table green btn btn-xs default">
                          <i class="fa fa-eye"></i> View
                        </a>
                        <?php endif ?>
                        <?php if ($permit->isdelete == 1): ?>
                        <a href="#draggable<?=$row2['id']?>" data-toggle="modal" class="link-table red btn btn-xs default">
                          <i class="fa fa-trash-o"></i> Move to Trash
                        </a>
                        <?php endif ?>
                        <?php }?>
                      </div>
                    </div>
                    
                    
                    <?=$controller->getPagesChild($row2["sister"])?>
                    
                    
                    <!-- DISINI ANAK KE 3-->
                  </li>
                <?php
                }
              echo '</ol>';
                
              }
              ?>