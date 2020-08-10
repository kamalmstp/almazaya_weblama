<div class="footer" id="footer">
    <div class="menu-bottom">
        <ul class="sf-menu" id="footer-menu">
            <?php
            foreach ($footer as $dt){
                ?>
                <li>
				<a href=""><?=$dt["title"]?></a>
                
                
                <?php
                    if ($dt["hasubmenu"] > 0){
                ?>        
                <?=$controller->submenu($dt["id"])?>
                <?php
                }
                ?>    
                </li>
                <?php
                
            }
            ?>
		<!--	<li class="current">
				<a href="followed.html">Tentang Kami</a>
				<ul>
					<li>
						<a href="followed.html">Sejarah</a>
					</li>
					<li>
						<a href="followed.html">Produk</a>
					</li>
					<li>
						<a href="followed.html">Karir</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="followed.html">Website Kalbe</a>
                <ul>
					<li>
						<a href="followed.html">Diva</a>
					</li>
					<li>
						<a href="followed.html">Morinaga</a>
					</li>
					<li>
						<a href="followed.html">Milna</a>
					</li>
                    <li>
						<a href="followed.html">Diabetasol</a>
					</li>
                    <li>
						<a href="followed.html">Nutrieve Benecol</a>
					</li>
                    <li>
						<a href="followed.html">Entrasol</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="followed.html">Facebook Kalbe</a>
				<ul>
					
					<li><a href="followed.html">Prenagen</a></li>
					<li><a href="followed.html">Diva</a></li>
					<li><a href="followed.html">Morinaga</a></li>
					<li><a href="followed.html">Milna</a></li>
					<li><a href="followed.html">Diabetasol</a></li>
				
				
				</ul>
			</li>
			<li>
				<a href="followed.html">Twitter Kalbe</a>
			</li>
            <li>
				<a href="followed.html">Lain-lain</a>
			</li>	-->
            
		</ul>
    
    </div>
    <div class="link-soc-media">
        Follow Us : <a target="_blank" href="https://www.facebook.com/NutriveBenecolIndonesia" target="_blank"><img src="<?=base_url('assets/frontend/images/link-fb.png')?>"></a>&nbsp;<a href="https://twitter.com/NutriveBenecol" target="_blank"><img src="<?=base_url('assets/frontend/images/link-tw.png')?>"></a>
        &nbsp;<a target="_blank" href="https://www.instagram.com/nutrivebenecol_id/" ><img src="<?=base_url('assets/frontend/images/Insta_logo.png')?>"></a>
        &nbsp;<a target="_blank" href="https://www.youtube.com/user/NutriveBenecol/videos" ><img src="<?=base_url('assets/frontend/images/link-youtube.png')?>"></a>
    </div>
    <div class="logokalbe"><a href="http://www.kalbe.co.id/"  target="_blank"><img src="<?=base_url('assets/frontend/images/logokalbe.png')?>" /></a></div>
    <div class="copyright">Copyright 2016 Nutrieve Benecol, All Rights Reserved</div>
    
</div>
</body>
<style>
#owl-demo .item img{
    display: block;
    width: 100%;
    height: auto;
}
</style>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/foundation.min.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/foundation/foundation.abide.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/owl-carousel/owl.carousel.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/jquery.sticky-kit.min.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/base.js')?>"></script> 
<script>
    $(document).foundation();
    $(document).ready(function(){
        $(".content-right").stick_in_parent();
        $('.bahasa').change(function() {
            window.location.href = $(this).val();
        });
        $(".current").click(function(){
            $(".select_bahasa").show(); 
        });
        var example = $('#example').superfish({
			//add options here if required
		});
        var example = $('#footer-menu').superfish({
			//add options here if required
		});
        $("#owl-demo").owlCarousel({

          navigation : true,
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem : true
    
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
    
          });
          
            
    });
   
</script>
</html>