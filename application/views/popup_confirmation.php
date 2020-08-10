<div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><?=$this->lang->line('addconfirmation');?></h4>
                                </div>
                                <div class="modal-body">
                                <div class="error-form">
                                    
                                </div>
                                  <form  enctype="multipart/form-data" class="form-horizontal addconfirmation" role="form" action="" method="POST">
                                  <input type="hidden" name="uid" class="form-control " value="<?php if (isset($alamat[0]["uid"])){ echo $this->encrypt->encodeUrl($alamat[0]["uid"],$key); }?>" id="inputPassword3"/>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3"><?=$this->lang->line('referenceorder');?></label>
                                    <div class="col-sm-10">
                                        <select name="cart" class="form-control" required="">
                                        <option value="">-- Select <?=$this->lang->line('referenceorder');?> --</option>
                                        <?php
                                        foreach ($cart as $dts){
                                        ?>
                                        <option value="<?=$dts["uid"]?>"><?=$dts["reference_order"]?></option>
                                        <?php
                                        }
                                        ?>
                                            
                                        </select>
                                        
                                    </div>
                                  </div>
                                    <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3"><?=$this->lang->line('createpaymentconfirmation_title');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" required="" id="title" placeholder="Title"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-2 control-label" for="inputEmail3"><?=$this->lang->line('createpaymentconfirmation_message');?></label>
                                    <div class="col-sm-10">
                                        <textarea name="message" class="form-control Message"  required=""></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3">File</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="file"/>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="submit" id="file" value="Submit" class="submit">
                                  </div>
                                </div>
                                
                                  
                                
                                </form>