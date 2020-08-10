<?php $this->load->view('sources/header.php')?>
<section class="section-content container" >
	
		<div class="row">
            
           <div class="col-md-12">
                <div class="formregistrasi forgot_password">
                <?php
                if (isset($_GET["error"])){
                ?>
                <div class="error-login">
                    <p><?=$_GET["error"]?></p>
                </div>
                <?php
                }
                ?>
                <h2><?=$this->lang->line('forgotyourpassword');?></h2>
                <?php
                if (isset($submit)){
                    if ($submit == 1){
                        ?>
                        <p>Your password has been changed and you can now login with new password. We've also sent your new password to you via email</p>
                        <div class="col-sm-12" style="text-align:center;">
                            <a class="continueshopping" href="<?=base_url($codebahasa."login")?>">Continue Login</a>
                        </div>
                    <?php
                    }else{
                    ?>
                        <p><?=$this->lang->line('Pleaseentertheemailaddress');?><br/><?=$this->lang->line('Wewillthensendyou');?></p>
                        <form method="POST" action="" class="form-login">
                            <div class="form-group">
                              <label for="usr"email>Email</label>
                              <input type="text" name="email" required="" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                              <label for="usr"email>Captcha  <img class="captcha_image_forgot" src="<?=base_url("captcha_forgot")?>/"></label>
                              <input type="text" name="captcha" required="" class="form-control" id="captcha">
                            </div>
                            
                            <input type="submit" name="submit" class="submit" value="SUBMIT" />
                            
                        </form>
                    <?php
                    }
                }else{
                    ?>
                    
                    <p><?=$this->lang->line('Pleaseentertheemailaddress');?><br/><?=$this->lang->line('Wewillthensendyou');?></p>
                    <form method="POST" action="" class="form-login">
                        <div class="form-group">
                          <label for="usr"email>Email</label>
                          <input type="text" name="email" required="" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                          <label for="usr"email>Captcha  <img class="captcha_image_forgot" src="<?=base_url("captcha_forgot")?>/"></label>
                          <input type="text" name="captcha" required="" class="form-control" id="captcha">
                        </div>
                        
                        <input type="submit" name="submit" class="submit" value="SUBMIT" />
                        
                    </form>
                    <?php
                    
                }
                
                ?>
                
                
               </div>
            </div>
            
            
		</div>
	</section>
    
    
    
    
    <section class="top-footer" style="display: none;">
        &nbsp;
    </section>
    
    <script type="text/javascript">
        $(".form-login").submit(function(){
             $(".loading").show();
        });
    </script>
    <?php $this->load->view('sources/footer.php')?>