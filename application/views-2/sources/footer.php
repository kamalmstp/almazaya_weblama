<!-- Footer -->
	<footer id="footer" class="footer overlay-dark">
		<div class="container">
			
			<!-- Footer Logo Section -->
			<div class="footer-logo-sec">
				<div class="footer-logo-inner">
					<a class="footer-logo" href="#"><img src="<?=base_url("assets/images/logo.png")?>" alt="logo"></a>
					
                    <?php
                    if (count($title_footer) > 0){
                        ?>
                        <?=$title_footer[0]["description"]?>
                        <?php
                    }
                    ?>
                    
					<ul class="social-icons">
                        <?php
                            foreach ($socialmedia as $dt_socmed){
                                ?>
                                    <li><a href="<?=$dt_socmed["facebook"]?>"><i class="fa fa-facebook"></i></a></li>
            						<li><a href="<?=$dt_socmed["twitter"]?>"><i class="fa fa-twitter"></i></a></li>
            						<li><a href="<?=$dt_socmed["googleplus"]?>"><i class="fa fa-google-plus"></i></a></li>
                                <?php
                            }
                        ?>
						
					</ul>
				</div>
			</div>
			<!-- Footer Logo Section -->

			<!-- Footer Columns -->
			<div class="row">
				<div class="footer-columns">
					
					<!-- Footer Column -->
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 r-full-width">
						<div class="footer-column">
							
                            <?php
                            if (count($alamat_sekolah) > 0){
                                ?>
                                <h4><?=$alamat_sekolah[0]["title"]?> :</h4>
                                <div class="contact-widget">
    								<div class="location">
    									<div>
    										<p><?=$alamat_sekolah[0]["description"]?></p>
    									</div>
    								</div>
    							</div>
                                <?php
                            }
                            ?>
							
							
						</div>
					</div>
					<!-- Footer Column -->

					<!-- Footer Column -->
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 r-full-width">
						<div class="footer-column">
							<h4>Galeri :</h4>
							<ul class="gallery-footer">
                                <?php
                                foreach ($gallery as $gl){
                                    ?>
                                    
                                        <li><a href="<?=base_url("uploads/infographic/".$gl["pic"])?>" rel="prettyPhoto[pp_gal]"><img src="<?=base_url("uploads/infographic/resize/".$gl["pic"])?>" alt="<?=$gl["title"]?>"></a></li>
                                        
                                    <?php
                                }
                                ?>
								
							</ul>
						</div>
					</div>
					<!-- Footer Column -->

					<!-- Footer Column -->
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 r-full-width">
						<div class="footer-column">
							<?php
                            if (count($jam_sekolah) > 0){
                                ?>
                                <h4><?=$jam_sekolah[0]["title"]?> :</h4>
                                <div class="contact-widget">
    								<div class="location">
    									<div>
    										<p><?=$jam_sekolah[0]["description"]?></p>
    									</div>
    								</div>
    							</div>
                                <?php
                            }
                            ?>
						</div>
					</div>
					<!-- Footer Column -->

					<!-- Footer Column -->
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 r-full-width">
						<div class="footer-column">
							<h4>Location :</h4>
							<div id="location-map" class="location-map"></div>
						</div>
					</div>
					<!-- Footer Column -->

				</div>
			</div>
			<!-- Footer Columns -->

			<!-- Copy Rights -->
			<div class="copy-rights">
				<p>Copyright &copy; 2016 SDIT ISLAM AL UMAR</p>
			</div>
			<!-- Copy Rights -->

		</div>
	</footer>
	<!-- Footer -->

</div>
<!-- Wrapper -->

<!-- back To Button -->
<span id="scrollup" class="scrollup"><i class="fa fa-angle-up"></i></span>
<!-- back To Button -->

<!-- Form Modal Box -->
<div class="modal fade bs-example-modal-sm">
  	<div class="modal-dialog modal-sm">
	    <div class="modal-body enquiry-form style-2 white-heading">
	    	<h3>Enquiry Form</h3>
	       <form class="enquiry-form">
				<div class="enquiry-form-input">
					<input type="text" class="form-control" placeholder="full name">
				</div>
				<div class="enquiry-form-input">
					<input type="text" class="form-control" placeholder="email id">
				</div>
				<div class="enquiry-form-input">
					<input type="text" class="form-control" placeholder="class">
				</div>
				<div class="enquiry-form-input">
					<input type="text" class="form-control" placeholder="subject">
				</div>
				<div class="enquiry-form-input">
					<button class="white-btn" type="submit">submit</button>
				</div>
			</form>
			 <div class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
	    </div>
  	</div>
</div>
<!-- Form Modal Box -->

<!-- Java Script -->
<script src="<?=base_url("assets/js/vendor/jquery.js")?>"></script>        		
<script src="<?=base_url("assets/js/vendor/bootstrap.js")?>"></script> 	
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?=base_url("assets/js/gmap3.min.js")?>"></script>				
<script src="<?=base_url("assets/js/parallax.js")?>"></script>			   	 
<script src="<?=base_url("assets/js/contact-form.js")?>"></script>			   	 
<script src="<?=base_url("assets/js/tabulous.html")?>"></script>
<script src="<?=base_url("assets/js/owl-carousel.js")?>"></script>
<script src="<?=base_url("assets/js/nstslider.js")?>"></script>			   	 
<script src="<?=base_url("assets/js/countdown.js")?>"></script>	
<script src="<?=base_url("assets/js/odometer.js")?>"></script>					
<script src="<?=base_url("assets/js/classie.js")?>"></script>			
<script src="<?=base_url("assets/js/bootstrap-select.js")?>"></script>				
<script src="<?=base_url("assets/js/colorpicker.js")?>"></script>					
<script src="<?=base_url("assets/js/appear.js")?>"></script>		
<script src="<?=base_url("assets/js/prettyPhoto.js")?>"></script>			
<script src="<?=base_url("assets/js/isotope.pkgd.js")?>"></script>						
<script src="<?=base_url("assets/js/sticky.js")?>"></script>						
<script src="<?=base_url("assets/js/wow-min.js")?>"></script>									
<script src="<?=base_url("assets/js/main.js")?>"></script>	


<script>
    $(document).ready(function(){
        $("a[rel^='prettyPhoto[pp_gal]']").prettyPhoto();
      });
      // ------- Google Map ------- // 
	$("#location-map").gmap3({
	    marker: {
	       <?php
           if (count($lokasi_footer) > 0){
            ?>
            address: "<?=$lokasi_footer[0]["address"]?>"
            <?php
           }else{
            ?>
            address: "Jl. Kemang Timur Raya No.90, RT.1/RW.3, Bangka, Mampang Prpt., Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12730"
            <?php
           }
           ?>
	        
	    },
	    map: {
	        options: {
	            zoom: 16,
			    scrollwheel: false,
	        }
	    },
	});
    // ------- Google Map ------- //
      
</script>	
<style>   
.grid-item {
    width: 25%;
}
ul.gallery-footer li{
    float: left;
    width:33.33%;
    padding:5px;
}
@media (max-width: 768px) {
    .grid-item {
        width: 50%;
    }
}
@media (max-width: 480px) {
    .grid-item {
        width: 100%;
    }
}
</style>
<!-- Java Script -->						
</body>


</html>