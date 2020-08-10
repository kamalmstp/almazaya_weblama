<div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title"><?php if(isset($_GET["lang"])){echo "Ubah Akun";}else{echo "Edit Account";}?></h4>
                                </div>
                                <div class="modal-body">
                                <div class="error-form">
                                    
                                </div>
                                  <form class="form-horizontal account" role="form" action="" method="POST">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3"><?php if(isset($_GET["lang"])){echo "Nama Lengkap";}else{echo "FullName";}?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="fullname" class="form-control fullname" required="" value="<?php if (isset($rec[0]["fullname"])){ echo $rec[0]["fullname"]; }?>" id="inputPassword3" placeholder="Fullname"/>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3"><?php if(isset($_GET["lang"])){echo "Tanggal Lahir";}else{echo "Date Of Birth";}?></label>
                                    <div class="col-sm-10">
                                        <select name="day" class="form-control day"  required="">
                                            <option value="">-- <?=$this->lang->line('Day');?> --</option>
                                            <option value="01" <?php if($rec[0]["tgl_lahir"] == "1" OR $rec[0]["tgl_lahir"] == "01"){ echo "selected=\"selected\"";} ?>>01</option>
                                            <option value="02" <?php if($rec[0]["tgl_lahir"] == "2" OR $rec[0]["tgl_lahir"] == "02"){ echo "selected=\"selected\"";} ?>>02</option>
                                            <option value="03" <?php if($rec[0]["tgl_lahir"] == "3" OR $rec[0]["tgl_lahir"] == "03"){ echo "selected=\"selected\"";} ?>>03</option>
                                            <option value="04" <?php if($rec[0]["tgl_lahir"] == "4" OR $rec[0]["tgl_lahir"] == "04"){ echo "selected=\"selected\"";} ?>>04</option>
                                            <option value="05" <?php if($rec[0]["tgl_lahir"] == "5" OR $rec[0]["tgl_lahir"] == "05"){ echo "selected=\"selected\"";} ?>>05</option>
                                            <option value="06" <?php if($rec[0]["tgl_lahir"] == "6" OR $rec[0]["tgl_lahir"] == "06"){ echo "selected=\"selected\"";} ?>>06</option>
                                            <option value="07" <?php if($rec[0]["tgl_lahir"] == "7" OR $rec[0]["tgl_lahir"] == "07"){ echo "selected=\"selected\"";} ?>>07</option>
                                            <option value="08" <?php if($rec[0]["tgl_lahir"] == "8" OR $rec[0]["tgl_lahir"] == "08"){ echo "selected=\"selected\"";} ?>>08</option>
                                            <option value="09" <?php if($rec[0]["tgl_lahir"] == "9" OR $rec[0]["tgl_lahir"] == "09"){ echo "selected=\"selected\"";} ?>>09</option>
                                            <option value="10" <?php if($rec[0]["tgl_lahir"] == "10" OR $rec[0]["tgl_lahir"] == "10"){ echo "selected=\"selected\"";} ?>>10</option>
                                            <option value="11" <?php if($rec[0]["tgl_lahir"] == "11" OR $rec[0]["tgl_lahir"] == "11"){ echo "selected=\"selected\"";} ?>>11</option>
                                            <option value="12" <?php if($rec[0]["tgl_lahir"] == "12" OR $rec[0]["tgl_lahir"] == "12"){ echo "selected=\"selected\"";} ?>>12</option>
                                            <option value="13" <?php if($rec[0]["tgl_lahir"] == "13" OR $rec[0]["tgl_lahir"] == "13"){ echo "selected=\"selected\"";} ?>>13</option>
                                            <option value="14" <?php if($rec[0]["tgl_lahir"] == "14" OR $rec[0]["tgl_lahir"] == "14"){ echo "selected=\"selected\"";} ?>>14</option>
                                            <option value="15" <?php if($rec[0]["tgl_lahir"] == "15" OR $rec[0]["tgl_lahir"] == "15"){ echo "selected=\"selected\"";} ?>>15</option>
                                            <option value="16" <?php if($rec[0]["tgl_lahir"] == "16" OR $rec[0]["tgl_lahir"] == "16"){ echo "selected=\"selected\"";} ?>>16</option>
                                            <option value="17" <?php if($rec[0]["tgl_lahir"] == "17" OR $rec[0]["tgl_lahir"] == "17"){ echo "selected=\"selected\"";} ?>>17</option>
                                            <option value="18" <?php if($rec[0]["tgl_lahir"] == "18" OR $rec[0]["tgl_lahir"] == "18"){ echo "selected=\"selected\"";} ?>>18</option>
                                            <option value="19" <?php if($rec[0]["tgl_lahir"] == "19" OR $rec[0]["tgl_lahir"] == "19"){ echo "selected=\"selected\"";} ?>>19</option>
                                            <option value="20" <?php if($rec[0]["tgl_lahir"] == "20" OR $rec[0]["tgl_lahir"] == "20"){ echo "selected=\"selected\"";} ?>>20</option>
                                            <option value="21" <?php if($rec[0]["tgl_lahir"] == "21" OR $rec[0]["tgl_lahir"] == "21"){ echo "selected=\"selected\"";} ?>>21</option>
                                            <option value="22" <?php if($rec[0]["tgl_lahir"] == "22" OR $rec[0]["tgl_lahir"] == "22"){ echo "selected=\"selected\"";} ?>>22</option>
                                            <option value="23" <?php if($rec[0]["tgl_lahir"] == "23" OR $rec[0]["tgl_lahir"] == "23"){ echo "selected=\"selected\"";} ?>>23</option>
                                            <option value="24" <?php if($rec[0]["tgl_lahir"] == "24" OR $rec[0]["tgl_lahir"] == "24"){ echo "selected=\"selected\"";} ?>>24</option>
                                            <option value="25" <?php if($rec[0]["tgl_lahir"] == "25" OR $rec[0]["tgl_lahir"] == "25"){ echo "selected=\"selected\"";} ?>>25</option>
                                            <option value="26" <?php if($rec[0]["tgl_lahir"] == "26" OR $rec[0]["tgl_lahir"] == "26"){ echo "selected=\"selected\"";} ?>>26</option>
                                            <option value="27" <?php if($rec[0]["tgl_lahir"] == "27" OR $rec[0]["tgl_lahir"] == "27"){ echo "selected=\"selected\"";} ?>>27</option>
                                            <option value="28" <?php if($rec[0]["tgl_lahir"] == "28" OR $rec[0]["tgl_lahir"] == "28"){ echo "selected=\"selected\"";} ?>>28</option>
                                            <option value="29" <?php if($rec[0]["tgl_lahir"] == "29" OR $rec[0]["tgl_lahir"] == "29"){ echo "selected=\"selected\"";} ?>>29</option>
                                            <option value="30" <?php if($rec[0]["tgl_lahir"] == "30" OR $rec[0]["tgl_lahir"] == "30"){ echo "selected=\"selected\"";} ?>>30</option>
                                            <option value="31" <?php if($rec[0]["tgl_lahir"] == "31" OR $rec[0]["tgl_lahir"] == "31"){ echo "selected=\"selected\"";} ?>>31</option>
                                        </select>
                                        <select name="month" class="form-control month"  required="">
                                            <option value="">-- <?=$this->lang->line('Month');?> --</option>
                                            <option value="01" <?php if($rec[0]["bulan_lahir"] == "1" OR $rec[0]["bulan_lahir"] == "01"){ echo "selected=\"selected\"";} ?>>January</option>
                                            <option value="02" <?php if($rec[0]["bulan_lahir"] == "2" OR $rec[0]["bulan_lahir"] == "02"){ echo "selected=\"selected\"";} ?>>February</option>
                                            <option value="03" <?php if($rec[0]["bulan_lahir"] == "3" OR $rec[0]["bulan_lahir"] == "03"){ echo "selected=\"selected\"";} ?>>March</option>
                                            <option value="04" <?php if($rec[0]["bulan_lahir"] == "4" OR $rec[0]["bulan_lahir"] == "04"){ echo "selected=\"selected\"";} ?>>April</option>
                                            <option value="05" <?php if($rec[0]["bulan_lahir"] == "5" OR $rec[0]["bulan_lahir"] == "05"){ echo "selected=\"selected\"";} ?>>May</option>
                                            <option value="06" <?php if($rec[0]["bulan_lahir"] == "6" OR $rec[0]["bulan_lahir"] == "06"){ echo "selected=\"selected\"";} ?>>June</option>
                                            <option value="07" <?php if($rec[0]["bulan_lahir"] == "7" OR $rec[0]["bulan_lahir"] == "07"){ echo "selected=\"selected\"";} ?>>July</option>
                                            <option value="08" <?php if($rec[0]["bulan_lahir"] == "8" OR $rec[0]["bulan_lahir"] == "08"){ echo "selected=\"selected\"";} ?>>August</option>
                                            <option value="09" <?php if($rec[0]["bulan_lahir"] == "9" OR $rec[0]["bulan_lahir"] == "09"){ echo "selected=\"selected\"";} ?>>September</option>
                                            <option value="10" <?php if($rec[0]["bulan_lahir"] == "10"){ echo "selected=\"selected\"";} ?>>October</option>
                                            <option value="11" <?php if($rec[0]["bulan_lahir"] == "11"){ echo "selected=\"selected\"";} ?>>November</option>
                                            <option value="12" <?php if($rec[0]["bulan_lahir"] == "12"){ echo "selected=\"selected\"";} ?>>December</option>
                                        </select>
                                        <select name="year" class="form-control year"  required="">
                                            <option value="">-- <?=$this->lang->line('Year');?> --</option>
                                            <?php
                                            for ($a = date("Y") - 10; $a > date("Y") - 90; $a--){
                                            ?>
                                            <option value="<?=$a?>" <?php if($rec[0]["thn_lahir"] == $a){ echo "selected=\"selected\"";} ?>><?=$a?></option>
                                            
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control email" required="" value="<?php if (isset($rec[0]["email"])){ echo $rec[0]["email"]; }?>" id="inputPassword3" placeholder="Fullname"/>
                                    </div>
                                  </div>
                                 <div class="form-group">
                                    <label class="col-sm-2 control-label" for="inputPassword3"><?php if(isset($_GET["lang"])){echo "Telepon";}else{echo "Phone";}?></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="telepon" class="form-control telepon" required="" value="<?php if (isset($rec[0]["telepon"])){ echo $rec[0]["telepon"]; }?>" id="inputPassword3" placeholder="Fullname"/>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <input type="submit" value="<?php if(isset($_GET["lang"])){echo "Kirim";}else{echo "Submit";}?>" class="submit">
                                  </div>
                                </div>
                                
                                  
                                
                                </form>