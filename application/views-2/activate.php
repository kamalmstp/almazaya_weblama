<?php $this->load->view('sources/header.php')?>
<section class="section-content shopping_bag container" >
	   <h1><?=$title_page?></h1>
		<div class="row">
            
           <div class="col-md-12">
               <div class="col-md-12">
                    <h4 style="text-align: center;"><?=$this->lang->line('ThankYouForActivatingYourAccount');?></h4>
                    <div class="nav-shop">
                        <div class="col-sm-12" style="text-align:center;">
                            <a class="continueshopping" href="<?=base_url($codebahasa.$menu_login)?>"><?=$this->lang->line('continuelogin');?></a>
                        </div>
                       
                    </div>
                </div>
                
            </div>
            
            
		</div>
	</section>
    
    
    
    
    <section class="top-footer" style="display: none;">
        &nbsp;
    </section>
    
    <?php $this->load->view('sources/footer.php')?>