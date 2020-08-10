<?php $this->load->view('sources/header.php')?>
<section class="section-content shopping_bag container" >
	   <h1><?=$title_page?></h1>
		<div class="row">
            
           <div class="col-md-12">
               <div class="col-md-12">
                <div class="error-form">
                    
                </div>
                </div>
                <?php
                if (isset($_GET["success"])){
                    ?>
                    <h3 style="text-align: center;"><?=$this->lang->line('SuccessfullyRegistered');?></h3>
                    <p style="text-align: center;"><?=$this->lang->line('Wehavesentyouanemail');?></p>
                    <p style="text-align: center;"><?=$this->lang->line('Dontreceive');?></p>
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <?php
                    }else{                   
                ?>
                <form method="POST" action="" class="form-registration">
                <div class="col-md-12" style="margin-bottom: 30px;">
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="usr"><?=$this->lang->line('Fullname');?></label>
                          <input type="text" name="fullname" required="" class="form-control" id="fullname">
                        </div>
                        <div class="form-group" style="overflow: hidden;" >
                            <label for="pwd"><?=$this->lang->line('Birthdate');?></label>
                            <select name="day" class="form-control day"  required="">
                                <option value="">-- <?=$this->lang->line('Day');?> --</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <select name="month" class="form-control month"  required="">
                                <option value="">-- <?=$this->lang->line('Month');?> --</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select name="year" class="form-control year"  required="">
                                <option value="">-- <?=$this->lang->line('Year');?> --</option>
                                <?php
                                for ($a = date("Y") - 10; $a > date("Y") - 90; $a--){
                                ?>
                                <option value="<?=$a?>"><?=$a?></option>
                                
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label for="usr">Telepon</label>
                          <input type="text"  required="" name="telepon" class="form-control justnumber" id="telepon">
                        </div>
                        <div class="form-group">
                            <img src="<?=base_url("captcha")?>" style="position: absolute; left: 88px;" />
                          <label for="usr">Captcha </label>
                          <input type="text" required="" name="captcha" class="form-control" id="captcha" style="position: relative;">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                          <label for="usr">Email</label>
                          <input type="email" required="" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                          <label for="usr"><?=$this->lang->line('password');?></label>
                          <input type="password" required="" name="password" class="form-control" id="password">
                        </div>
                        <input type="hidden" name="bahasa" value="<?=$codebahasa?>" />
                        <div class="form-group">
                          <label for="usr"><?=$this->lang->line('Confirm_password');?></label>
                          <input type="password" required="" name="confirm" class="form-control" id="confirm">
                        </div>
                        <div class="form-group">
                          <label for="usr"></label>
                          <input type="checkbox" name="agree" value="1" /> <sup><?=$this->lang->line('Agree');?></sup>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-12" style="margin-bottom: 30px;">
                        <div class="col-sm-6 formcancel" >
                            <input type="reset" name="reset" class="cancelreg" value="CANCEL" />
                            
                        </div>
                        
                        <div class="col-sm-6 formsubmit" >
                            <input type="submit" name="submit" class="submitreg" value="SUBMIT" />
                        </div>
                    </div>
                </form>
                <?php
                }
                ?>                
               
            </div>
            
            
		</div>
	</section>
    
    
    
    
    <section class="top-footer" style="display: none;">
        &nbsp;
    </section>
    
    <script>
        $(document).ready(function() {
            $(".justnumber").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl+A, Command+A
                    (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                     // Allow: home, end, left, right, down, up
                    (e.keyCode >= 35 && e.keyCode <= 40)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
            $(".form-registration").submit(function(){
                var form=$(this);
                $.ajax({
                    type: "POST",
                    data:form.serialize(),
                    url: '<?=base_url($codebahasa."saveregistration")?>/',
                    async: false,
                    dataType: 'json',
                    //data: { 'qty': qty, 'id': id},
                    beforeSend: function () {
                        $('.loading').removeAttr("style");
                    },
                    complete: function () {
                        $('.loading').css("display", "none");
                    },
                    success: function (xml) {
                        $(".qty_cart").text("(" + xml.total_cart + ")");
                        $(".cartclick").click();
                        if (xml.error != ""){
                            $(".error-form").html("<ul>" + xml.error + "</ul>");
                        }else{
                            $(".error-form").html("");
                            if (xml.insert > 0){
                                window.location.href = "<?=base_url($codebahasa.$link."/?success=1")?>";
                            }
                        }
                        
                        
                    }
                });
                return false; 
            });
        });
    </script>
    <?php $this->load->view('sources/footer.php')?>