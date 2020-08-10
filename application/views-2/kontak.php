<?php $this->load->view('sources/header-content.php')?>
<!-- Banner Slider -->
	<div class="section-padding overlay-gray" data-enllax-ratio="-.3" style="background: url(<?=base_url("assets/images/inner-banner.jpg")?>) 40% 0% no-repeat fixed;">
		<div class="container p-relative">

			<!-- Page heading -->
			<div class="page-heading">
				<h2><?=$current_page?></h2>
			</div>
			<!-- Page heading -->

			<!-- Bredrcum -->
			<div class="tc-bredcrum">
				<ul>
                   
					<li><a href="<?=base_url()?>">Home</a></li><li> <a href="javascript:;"><?=$title_page?></a></li>
				</ul>
			</div>
			<!-- Bredrcum -->

		</div>
	</div>
	<!-- Banner Slider -->
<!-- Main Content -->
	<main class="main-content section-padding white-bg">
		<div class="container">

			<!-- Blog Full Width -->
			<div class="Blog-full-width">			

				<!-- Blogs Img Post -->
				<div class="full-width-post-holder">
					<div class="row">

					

						<div class="row">
            <div class="title-page">
            </div>
           
            <div class="contact-us content">
                <div class="col-sm-6">
                    <h4>Terimakasih atas kunjungan Anda ke Website SDIT AL UMAR NGARGOSOKA. Apabila Ibu dan Bapak memiliki pertanyaan lebih lanjut, silahkan isi data diri di bawah ini:</h4>
                    
                    <br />
                    
                    <div class="form-contact">
                    <?php
                        if (isset($_GET["success"])){
                            ?>
                    <div class="form-contact-success alert-success" style="padding: 10px;">
                        
                            <?=$this->lang->line('success_kontak');?>
                            
                    </div>
                    <?php
                        }
                        ?>
                    <div class="form-contact-error">
                        
                    </div>
                        <form role="form" class="form-contact-submit" method="POST" action="">
                            <div class="form-group">
                              <label for="usr">Nama</label>
                              <input type="text" required="" name="nama" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                              <label for="pwd">Email</label>
                              <input type="email" required="" name="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                              <label for="pwd"><?=$this->lang->line('message');?></label>
                              <textarea name="message"  required="" class="form-control"></textarea>
                            </div>
                            
                            <div class="form-group" style="position: relative;">
                              <label for="pwd">Captcha</label>
                              <input type="text" required="" name="captcha" class="form-control captcha" id="captcha">&nbsp; <img class="captcha_image" src="<?=base_url("captcha_contact")?>/">
                            </div>
                            <input type="submit" name="submit" class="submit" value="<?=$this->lang->line('send');?>" />
                          </form>
                    </div>
                </div>
                
                
                <div class="col-sm-6"style="padding-left: 0px; padding-right: 0px;">
                
                    <div class="maps">
                        <style>
      
      #map {
        height: 300px;
      }
    </style>
    
    <div id="map"></div>
    <script>
      function initMap() {
        <?php
        if (count($rec)){
            ?>
            var myLatlng = {lat: <?=$rec[0]["latitude"]?>, lng: <?=$rec[0]["longitude"]?>};
            <?php
            }else{
            ?>
            var myLatlng = {lat: -6.718949013518152, lng: 106.73472783671878};
            <?php    
                
            
        }
        ?>
        

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: myLatlng
        });

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          label: 'Office'
        });
        google.maps.event.addListener(marker, 'click', function() {
           infowindow.setContent("<div><p>PT. TRINITY PRATAMA</p><p>ITC Permata Hijau Blok Diamond No. 8<br />Jakarta Selatan 12210</p></div>");
           infowindow.open(map,marker);
        });
        
        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        

      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw8ngFj0aTnAgDBI0CihTXpQorjXFwBGE&callback=initMap"
    async defer></script>
    </div>
    <br />
                    </div>
                    
                    <div class="contact-detail">
                        <?=$rec[0]["address"]?>
                    </div>
                </div>
            </div>

					</div>
				</div>
				<!-- Blogs Img Post -->

			</div>
			<!-- Blog Full Width -->

		</div>
	</main>
	<!-- Main Content -->
<?php $this->load->view('sources/footer.php')?>