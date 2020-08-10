<?php $this->load->view('sources/header.php')?>
<section class="section-content container" style="margin-bottom: 0px;" >
	
		<div class="row">
            
           <div class="col-md-12">
                <div class="formregistrasi" style="margin-top: 30px;">
                <?php
                if (isset($_GET["error"])){
                ?>
                <div class="error-login">
                    <p><?=$this->lang->line('error_login')?></p>
                </div>
                <?php
                }
                ?>
                <h2 style=""><?=$this->lang->line('haveaneternaleafaccount');?></h2>
                <h6 style="text-transform: capitalize; margin-bottom: 20px;"><?=$this->lang->line('loginhere');?></h6>
                <form method="POST" action="" class="form-login">
                    <div class="form-group">
                      <label for="usr"email>Email</label>
                      <input type="text" name="email" required="" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                      <label for="pwd"><?=$this->lang->line('password');?></label>
                      <input type="password" required=""  name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group" style="text-align: center;">
                      <a class="forgot" href="<?=base_url($codebahasa.$menu_forgot)?>"><?=$this->lang->line('forgotpassword');?></a>
                    </div>
                    <div class="form-group" style="text-align: center;">
                    <input type="submit" name="submit" class="submit" value="<?=$this->lang->line('loginbutton');?>" />
                    &nbsp;&nbsp;<a class="create_account" href="<?=base_url($codebahasa.$menu_registration)?>"><?=$this->lang->line('createaccount');?></a>
                    </div>
                </form>
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