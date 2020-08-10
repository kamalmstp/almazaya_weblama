<?php $this->load->view('sources/header.php')?>

		</div>
	</header>
	<!-- Header -->

	<!-- Banner & Enquiry Form -->
	<div class="banner">
		
		<!-- Banner slider -->
		<div id="banner-slider" class="banner-slider">
				
			<!-- item -->
            
            
            <?php
            foreach ($rec_banner as $banner){
                ?>
                <div class="slide overlay-dark fullscreen" style="background: url(<?=base_url("uploads/banner/".$banner["pic"])?>); background-size: cover;">
    				<div class="caption-holder">
    					<div class="tc-display-table">
    						<div class="tc-display-table-cell">
    							<div class="banner-text animate fadeInUp" data-wow-delay="0.4s">
    								<h1><?=$banner["title"]?></h1>
                                    <p><?=strip_tags($banner["description"])?></p>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
                <?php
            }
            ?>

		</div>
		<!-- Banner slider -->

		<!-- Enquiry Form -->
		<div class="enquiry-form-holder">
			<div class="container">
				<div class="form-btn-holder">
					<div class="bars-icon hide-md"><span>Enquiry</span></div>
					<span class="bars-icon appear-lg" data-toggle="modal" data-target=".bs-example-modal-sm"></span>
				</div>
				<form class="enquiry-form hide-md">
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
			</div>
		</div>
		<!-- Enquiry Form -->

	</div>
	<!-- Banner & Enquiry Form -->

	<!-- Main Content -->
	<main class="main-content">

		<!-- About The School -->
		<section class="about-school about-school-v2  white-bg">
			<div class="container">
				<div class="row">

					<!-- About To School -->
                    
                    <?php
                    if (count($profile) > 0){
                    ?>
					<div class="col-sm-6">
						<div class="about-sec section-padding">
							<h2><?=$profile[0]["title"]?> </h2>
							<p><?=strip_tags($profile[0]["description"])?></p>
                            
                            <?php
                            if ($profile[0]["link"] != ""){
                                ?>
                                <a class="pink-btn" href="<?=$profile[0]["link"]?>">Selengkapnya</a>
                                <?php
                            }
                            ?>
							
						</div>
					</div>
                    <div class="col-sm-6">
                        <?php
                        if ($profile[0]["pic"] != ""){
                            ?>
                            <img class="animate fadeInRight" data-wow-delay="0.4s" src="<?=base_url("uploads/content/".$profile[0]["pic"])?>" alt="about-sec-img2">
                            <?php
                        }
                        ?>
					</div>
                    
                    <?php
                    }
                    ?>
					<!-- About To School -->


				</div>
			</div>
		</section>
		<!-- About The School -->

		<!-- Services Section -->
		<section class="parallax-window section-padding overlay-pink" data-image-src="<?=base_url("assets/images/service-bg-v2.jpg")?>" data-parallax="scroll">
			<div class="container">
					
				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading white-heading">
						<h2><?=$headline[0]["title"]?><span><?=$headline[0]["description"]?></span></h2>
					</div>
				</div>
				<!-- Main Heading -->

				<!-- Services -->
				<div class="service-v2-slider">
                    <?php
                    foreach($prestasi as $ps){
                        $desc = strip_tags($ps["description"]);
                        if(strlen(strlen($desc) > 100)){
                            $desc = substr($desc,0,100)."...";
                        }
                        ?>
                        <!-- Service Figure -->
    					<div class="service-figure-v2 animate fadeInUp" data-wow-delay="0.2s">
    						<div class="service-icon"><img src="<?=base_url("uploads/prestasi/".$ps["pic"])?>" /></div>
    						<h3><a href="#"><?=$ps["title"]?></a></h3>
    						<p><?=$desc?></p>
    					</div>
    					<!-- Service Figure -->
                        <?php
                    }
                    ?>
					

				</div>
				<!-- Services -->

			</div>
		</section>
		<!-- Team Section -->
        <!-- Our Blog -->
		<section class="section-padding white-bg">
			<div class="container">
					
				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading">
						<h2><?=$headline_aktifitas[0]["title"]?></h2>
						<p><?=$headline_aktifitas[0]["description"]?></p>
					</div>
				</div>
				<!-- Main Heading -->

				<!-- Our Blogs -->
				<div class="our-blogs our-blog-v2">
                    <?php
                    foreach($aktifitas as $ak){
                        $descriptionnya = strip_tags($ak["description"]);
                        if (strlen($descriptionnya) > 200){
                            $descriptionnya = substr($descriptionnya,0,200)."...";
                        }
                        ?>
                        <div class="blog-post-holder">
    						<div class="row no-gutters">
    							
    							<!-- Post Img -->
    							<div class="col-lg-6 col-md-6 col-sm-12">
    								<figure class="post-img">
    									<a href="<?=base_url($codebahasa.$ak["link_pages"].'/'.$ak["link"])?>" title="<?=$ak["title"]?>"><img src="<?=base_url("uploads/aktifitas/".$ak["pic"])?>" alt="<?=$ak["title"]?>"></a>
    									<strong class="title-batch-left"><i class="fa fa-image"></i></strong>
    								</figure>
    							</div>
    							<!-- Post Img -->
    
    							<!-- Post Detail -->
    							<div class="col-lg-6 col-md-6 col-sm-12">
    								<div class="blog-post-detail">
    									<h3><a href="<?=base_url($codebahasa.$ak["link_pages"].'/'.$ak["link"])?>" title="<?=$ak["title"]?>"><?=$ak["title"]?></a></h3>
    									<ul class="meta-post">
    										
    										<li><i class="fa fa-clock-o"></i><?=$ak["datenya"]?></li>
    									</ul>
    									<p><?=$descriptionnya?></p>
    									<a class="pink-btn" href="<?=base_url($codebahasa.$ak["link_pages"].'/'.$ak["link"])?>">Selengkapnya &gt;</a>
    								</div>
    							</div>
    							<!-- Post Detail -->
    
    						</div>
    					</div>
                        <?php
                    }
                    ?>

				</div>
				<!-- Our Blogs -->

			</div>
		</section>
		<!-- Our Blog -->

        
        <!-- Testimonial Section -->
		<section class="testimonial-holder section-padding white-bg">
			<div class="container">

				<!-- Main Heading -->
				<div class="main-heading-holder">
					<div class="main-heading">
						<h2><?=$headline_pengumuman[0]["title"]?></h2>
						<p><?=$headline_pengumuman[0]["description"]?></p>
					
					</div>
				</div>
				<!-- Main Heading -->

				<!-- Testimonial Slider -->
				<div id="testimonial-slider" class="testimonial-slider">
					<?php
                    foreach($pengumuman as $pe){
                        $descriptionnya = strip_tags($pe["description"]);
                        if (strlen($descriptionnya) > 200){
                            $descriptionnya = substr($descriptionnya,0,200)."...";
                        }
                        ?>
                        <!-- Testimonial column -->
    					<div class="item animate">
    						<div class="testimonial-column">
    							<div class="testimonial-blockquote-holder">
                                    <div class="heading1"><?=$pe["title"]?></div>
    								<blockquote class="testimonial-blockquote">
    									<p><?=$descriptionnya?></p>
    								</blockquote>
    								<span class="client-name"> - <?=$pe["oleh"]?> - </span>
    							</div>
    						</div>
    					</div>
    					<!-- Testimonial column -->
                        <?php
                    }
                    ?>
					

				</div>
				<!-- Testimonial Slider -->

			</div>
		</section>
		<!-- Testimonial Section -->
        
        
        
		<section class="team-holder section-padding-top  white-bg">

			<!-- Main Heading -->
			<div class="container">
				<div class="main-heading-holder">
					<div class="main-heading">
						<h2><?=$headline_siswa[0]["title"]?></h2>
						<p><?=$headline_siswa[0]["description"]?></p>
					</div>
				</div>
			</div>
			<!-- Main Heading -->

			<!-- Team Width Detail -->
			<div class="team-slider-v2">
				
				<!-- Slider -->
				<div class="team-big-slider">
					<div id="product-thumnail" class="carousel slide" data-ride="carousel">
						<div class="row">

						    <!-- Slider Img -->
					      	<div class="carousel-inner">
                                <?php
                                $no=0;
                                foreach ($siswa as $sw){
                                    $class = "";
                                    if ($no == 0){
                                        $class = "active";
                                    }
                                ?>
					      		<!-- Slide Item -->
						        <div class="item <?=$class?>">
						        	<div class="row no-gutters">

										<!-- Employee Img -->
										<div class="col-sm-6">
											<figure class="employee-img">
												<a target="_blank" href="<?=base_url($codebahasa.$sw["link_pages"].'/'.$sw["link"])?>"><img src="<?=base_url("uploads/siswa/resize/".$sw["pic"])?>" alt="img-01"></a>
											</figure>
										</div>
										<!-- Employee Img -->

										<!-- Employee Detail -->
										<div class="col-sm-6 team-detail-v2">
											<div class="tc-display-table">
												<div class="tc-display-table-cell">
													<div class="team-detail-inner-v2">
														<h2><a target="_blank" href="<?=base_url($codebahasa.$sw["link_pages"].'/'.$sw["link"])?>"><?=$sw["title"]?></a></h2>
													
														<p><?=strip_tags($sw["description"])?></p>
														<a class="pink-btn" target="_blank" href="<?=base_url($codebahasa.$sw["link_pages"].'/'.$sw["link"])?>">Selengkapnya &gt;</a>
													</div>
												</div>
											</div>
										</div>
										<!-- Employee Detail -->

									</div>
						        </div>
						        <!-- Slide Item -->
                                <?php
                                $no++;
                                }
                                ?>
						        
					      	</div>
					      	<!-- Slider Img -->

							<!-- Thubmanil -->
							<div class="team-detail-thumnail">
								<div class="container">
									<ul id="team-slider-thumnail" class="team-slider-thumnail">
                                        <?php
                                        $no=0;
                                        foreach ($siswa as $sw){
                                            $class = "";
                                            if ($no == 0){
                                                $class = " class=\"active\"";
                                            }
                                        ?>
							          	<li data-target="#product-thumnail" data-slide-to="<?=$no?>" <?=$class?>>
							          		<h5><?=$sw["title"]?></h5>
							          	</li>
							          	<?php
                                        $no++;
                                        }
                                        ?>
							        </ul>
						        </div>
					        </div>
						    <!-- Thubmanil -->

				      	</div>
					</div>
				</div>
				<!-- Slider -->

			</div>
			<!-- Team Width Detail -->

		</section>
		<!-- Team Section -->


		<!-- Gallery Section -->
		<section class="gallery-holder white-bg">

			<!-- Main Heading -->
			<div class="main-heading-holder section-padding-top" style="background: transparent !important">
				<div class="main-heading">
					<h2>Galeri</h2>
				</div>
			</div>
			<!-- Main Heading -->

			<!-- Gallery Grid -->
			<div class="container">	
				<div class="row">
                    <?php
                    foreach ($gallery as $gl){
                        ?>
                        <div class="col-sm-4">
                            <img src="<?=base_url("uploads/infographic/resize/".$gl["pic"])?>" alt="<?=$gl["title"]?>">
                        </div>
                        <?php
                    }
                    ?>
				    
					
				</div>
                <div class="view-all-btn">
						<a class="pink-btn" href="#">view all</a>
					</div>
			</div>	
			<!-- Gallery Grid -->
			
		</section>
		<!-- Gallery Section -->

	</main>
	<!-- Main Content -->
<?php $this->load->view('sources/footer.php')?>