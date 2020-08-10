<div class="footer" id="footer">
    <div class="menu-bottom">
        <ul class="sf-menu" id="footer-menu">
            <?php
            foreach ($footer as $dt){
                ?>
                <li>
                <?php
                    if ($dt["hasubmenu"] == 1){
                ?>   
                <a href="javascript:;"><?=$dt["title"]?></a>
                <?php
                }else{
                ?>
                <a href="<?=base_url().$codebahasa.$dt["link"]?>"><?=$dt["title"]?></a>
                <?php
                }
                ?>
                
				
                
                
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
    <div class="logokalbe"><a href="http://www.kalbe.co.id/" target="_blank"><img src="<?=base_url('assets/frontend/images/logokalbe.png')?>" /></a></div>
    <div class="copyright">Copyright 2016 Nutrieve Benecol, All Rights Reserved</div>
    
</div>


<div class="hide" data-pop="pop-in" id="popup">
    <div class="popupcontrols">
        <span id="popupclose">&nbsp;</span>
    </div>
    <div class="popupcontent">
        <div class="videoWrapper">
            <!-- Copy & Pasted from YouTube -->
            <iframe width="560"  id="clearmySound" height="349" src="" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="hide" id="overlay"></div>
<a class="cd-top" href="#0"><img src="<?=base_url('assets/frontend/images/backtotop.png')?>"></a>

</div>
</div>
</div>
</section>

<a class="exit-off-canvas"></a>
    </div><!--/innerWrapp-->
</div><!--/offCanvasWrap--> 
<style>
#owl-demo .item img{
    display: block;
    width: 100%;
    height: auto;
}
</style>
<style>
    .videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

</style>

<script  type="text/javascript" src="<?=base_url('assets/frontend/js/foundation.min.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/foundation/foundation.abide.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/owl-carousel/owl.carousel.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/jquery.sticky-kit.min.js')?>"></script>
<script  type="text/javascript" src="https://codyhouse.co/demo/back-to-top/js/main.js"></script>
<script src="<?=base_url('assets/frontend/js/foundation/foundation.offcanvas.js')?>"></script>
<script  type="text/javascript" src="<?=base_url('assets/frontend/js/base.js')?>"></script>    
<script>
    $(document).foundation();
    $(document).ready(function(){
        $(".show_video").click(function(){
            
            var id_youtube = $(".show_video").attr("data-id");
            $("#popup").removeClass("hide");
            $("#popup").addClass("show");
            $("#clearmySound").attr('src','http://www.youtube.com/embed/'+id_youtube+'?autoplay=1');      
            $("#overlay").removeClass("hide");
            $("#overlay").addClass("show");
        });
        $("#popupclose").click(function(){
            $("#popup").removeClass("show");
             $("#popup").addClass("hide");
             $("#clearmySound").attr('src','');      
             
             $("#overlay").removeClass("show");
            $("#overlay").addClass("hide");
        });
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
          autoPlay: 25000,
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
          $( "#footer-menu li > a" ).hover(
              function() {
                $('html, body').animate({scrollTop:$('.footer').position().top}, 'fast');
                //return false;
              }, function() {
               //$('html, body').animate({scrollTop:$('.rowfull').position().top}, 'slow');
              }
            );
            
    });
    
</script>
</body>

</html>