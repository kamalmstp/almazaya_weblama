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

			<!-- Blog Full Width -->
			<div class="Blog-full-width">			

				<!-- Blogs Img Post -->
				<div class="full-width-post-holder">
					<div class="row">

						<!-- Post Img -->
						<div class="col-sm-12">
							<figure class="post-img">
								<img src="<?=base_url("uploads/pages/resize/".$pic)?>" alt="img-01">
								<strong class="title-batch-left"><i class="fa fa-image"></i></strong>
							</figure>
						</div>
						<!-- Post Img -->

						<!-- Post Detail -->
						<div class="col-sm-12">
							<div class="blog-post-detail">
								<div class="center-detail-inner">
									<h3><?=$current_page?></h3>
									
									<?=$isicontent?>
									
								</div>
							</div>
						</div>
						<!-- Post Detail -->

					</div>
				</div>
				<!-- Blogs Img Post -->

			</div>
			<!-- Blog Full Width -->

		</div>
	</main>
	<!-- Main Content -->
<?php $this->load->view('sources/footer.php')?>