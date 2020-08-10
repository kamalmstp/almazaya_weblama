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
                   
					<li><a href="<?=base_url()?>">Home</a></li><li> <a href="javascript:;"><?=$current_page?></a></li>
				</ul>
			</div>
			<!-- Bredrcum -->

		</div>
	</div>
	<!-- Banner Slider -->
<!-- Main Content -->
	<main class="main-content section-padding white-bg">
		<div class="container">

			<!-- Blog List -->
			<div class="Blog-detail-holder">
			 <?php
             foreach ($rec as $dt){
                ?>
                <!-- Img Post -->
				<div class="blog-list-widget">
					<div class="row no-gutters">
						
						<!-- Post Img -->
						<div class="col-lg-6 col-md-6 col-sm-12">
							<figure class="post-img">
								<a href="<?=base_url($codebahasa.$dt["link_pages"].'/'.$dt["link"])?>" title="<?=$dt["title"]?>"><img src="<?=base_url("uploads/aktifitas/".$dt["pic"])?>" alt="<?=$dt["title"]?>"></a>
                                <strong class="title-batch-left"><i class="fa fa-image"></i></strong>							
							</figure>
						</div>
						<!-- Post Img -->

						<!-- Post Detail -->
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="blog-post-detail">
								<h3><?=$dt["title"]?></h3>
                                <?php
                                $descriptionnya = strip_tags($dt["description"]);
                                if (strlen($descriptionnya) > 200){
                                    $descriptionnya = substr($descriptionnya,0,200)."...";
                                }
                                
                                ?>
                                <ul class="meta-post">
    										
    										<li><i class="fa fa-clock-o"></i><?=$dt["datenya"]?></li>
    									</ul>
								<p><?=$descriptionnya?></p>
                                <a class="pink-btn" href="<?=base_url($codebahasa.$dt["link_pages"].'/'.$dt["link"])?>">Selengkapnya &gt;</a>
							</div>
						</div>
						<!-- Post Detail -->

					</div>
				</div>
                <?php
             }
             ?>
				<?php
                        if (isset($rec)){
                            echo $paging;
                        }
                    ?>
            </div>

		</div>
	</main>
	<!-- Main Content -->
<?php $this->load->view('sources/footer.php')?>