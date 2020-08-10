<div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Edit Address</h4>
                                </div>
                                <div class="modal-body">
                                <div class="error-form">
                                    
                                </div>
                                  <form class="form-horizontal address_edit_new" role="form" action="" method="POST">
                                  <input type="hidden" name="uid" class="form-control " value="<?php if (isset($alamat[0]["uid"])){ echo $this->encrypt->encodeUrl($alamat[0]["uid"],$key); }?>" id="inputPassword3"/>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3">Address Label</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="label_address" class="form-control label_address" disabled="" required="" value="<?php if (isset($alamat[0]["label_address"])){ if ($alamat[0]["label_address"] == ""){echo $fullname; }else{echo $alamat[0]["label_address"]; }}?>" id="inputPassword3" placeholder="Address Label"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-2 control-label" for="inputEmail3">Province</label>
                                    <div class="col-sm-10">
                                        <select name="province" class="form-control province" required="">
                                            <option value="">-- Select Province --</option>
                                            <?php
                                            foreach ($rec as $dt){
                                                $selected = "";
                                                if ($dt["province_id"] == $alamat[0]["uid_province"]){
                                                    $selected = "selected=\"selected\"";
                                                }else{
                                                    $selected = "";
                                                }
                                                ?>
                                                <option <?=$selected?> value="<?=$dt["province_id"]?>"><?=$dt["province"]?></option>
                                                
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-2 control-label" for="inputEmail3">City</label>
                                    <div class="col-sm-10">
                                        <select name="city" class="form-control city"  required="">
                                            <option value="">-- Select City --</option>
                                            <?php
                                            foreach ($city as $dt){
                                                $selected = "";
                                                if ($dt["city_id"] == $alamat[0]["uid_city"]){
                                                    $selected = "selected=\"selected\"";
                                                }else{
                                                    $selected = "";
                                                }
                                                ?>
                                                <option <?=$selected?> value="<?=$dt["city_id"]?>"><?=$dt["type_city"]?> <?=$dt["city_name"]?></option>
                                                
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-2 control-label" for="inputEmail3">Sub District</label>
                                    <div class="col-sm-10">
                                        <select name="subdistrict" class="form-control subdistrict"  required="">
                                            <option value="">-- Select Sub District --</option>
                                            <?php
                                            foreach ($district as $dt){
                                                $selected = "";
                                                if ($dt["subdistrict_id"] == $alamat[0]["uid_subdistrict"]){
                                                    $selected = "selected=\"selected\"";
                                                }else{
                                                    $selected = "";
                                                }
                                                ?>
                                                <option <?=$selected?> value="<?=$dt["subdistrict_id"]?>"><?=$dt["subdistrict_name"]?></option>
                                                
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label  class="col-sm-2 control-label" for="inputEmail3">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control address_value"  required=""><?php if (isset($alamat[0]["address_value"])){ echo $alamat[0]["address_value"]; }?></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3">Postal Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="postal_code" class="form-control justnumber postal_code" required="" value="<?php if (isset($alamat[0]["postal_code"])){ echo $alamat[0]["postal_code"]; }?>" id="inputPassword3" placeholder="Postal Code"/>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3">Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="telepon" class="form-control telepon justnumber" required="" value="<?php if (isset($alamat[0]["telepon"])){if ($alamat[0]["telepon"] == ""){echo $acountnya[0]["telepon"]; }else{ echo $alamat[0]["telepon"]; }}?>" id="Telepon" placeholder="Telepon"/>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="submit" value="Submit" class="btn btn-default">
                                  </div>
                                </div>
                                
                                  
                                
                                </form>