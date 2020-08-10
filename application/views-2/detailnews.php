<?php $this->load->view('sources/header-content.php')?>
 <section class="section-content container detailnews-top" >
	
		<div class="row">
          <!-- Blog Detail -->
				<div class="col-lg-8 col-md-8 col-sm-7">
					<div class="blog-detail">
					
						<!-- Blog Post -->
						<div class="single-blog-post">

						
							<!-- Post Detail -->
							<div class="blog-post-detail">
								<div class="center-detail-inner">
                                    <div class="detailimage">
								<?php
                                if ($detail[0]["pic"] != ""){
                                ?>
                                <img src="<?=base_url("uploads/aktifitas/".$detail[0]["pic"])?>" style="width: 100%;" />
                                <?php
                                }
                                ?>
                                </div>
									<h3><?=$detail[0]["title"]?></h3>
									<div>
										<ul class="meta-post">
											<li><i class="fa fa-user"></i>My Admin</li>
											<li><i class="fa fa-clock-o"></i>6 days ago</li>
											<li><i class="fa fa-comment"></i>10 Comments</li>
										</ul>
									</div>
									<div>
										<?=$detail[0]["description"]?>
									</div>
								</div>
							</div>
							<!-- Post Detail -->

						</div>
						<!-- Blog Post -->

					</div>
				</div>
				<!-- Blog Detail -->

				<!-- Aside -->
				<aside class="col-lg-4 col-md-4 col-sm-5">
					
					<!-- Aside Search Bar -->
					<div class="search-bar-holder">
						<div class="search-bar">
		                    <input type="text" class="form-control"  placeholder="Search">
	                        <button type="submit">
	                            <span class="fa fa-paper-plane"></span>
	                        </button>  
						</div>
					</div>
					<!-- Aside Search Bar -->

					<!-- Admin Info -->
					<div class="aside-widget">
						<h3>About</h3>
						<div class="aside-admin-detail">
							<span class="admin-img"><img src="images/admin-img/img-01.jpg" alt="img-01"></span>
							<p>Donec semper, ex et sollicitudin dignissim, massa quam hendrerit magna, a consequat urna lectus posuere nisl. Vivamus tincidunt sagittis massa, quis consectetur ex eleifend vitae.</p>
							<span class="arthor-name">Vantan Shon</span>
							<span class="arthor-signature">Jhone Smithson</span>
						</div>
					</div>
					<!-- Admin Info -->

					<!-- Categories -->
					<div class="aside-widget">
						<h3>Categories</h3>
						<div class="categories-list">
							<ul>
								<li><a href="#">Western Wear</a></li>
								<li><a href="#">Women's Clothing</a></li>
								<li><a href="#">Top Brands </a></li>
								<li><a href="#">Women's Sports Wear</a></li>
								<li><a href="#">Women's Clothing</a></li>
								<li><a href="#">Women's Sports Wear</a></li>
							</ul>
						</div>
					</div>
					<!-- Categories -->

					<!-- Recent Post -->
					<div class="aside-widget">
						<h3>Recent Post</h3>
						<div class="recent-post">
							<ul>
								<li>
									<span class="recent-post-img"><img src="images/aside-recent-post/img-01.jpg" alt="img-01"></span>
									<div class="recent-post-detail">
										<h5><a href="#">Static image post</a></h5>
										<span class="recent-post-date"><i class="fa fa-clock-o"></i>6 days ago</span>
										<p>Neque porro quisquam est, qui em ipsum quia dolor sit amet.</p>
									</div>
								</li>
								<li>
									<span class="recent-post-img"><img src="images/aside-recent-post/img-02.jpg" alt="img-02"></span>
									<div class="recent-post-detail">
										<h5><a href="#">Static image post</a></h5>
										<span class="recent-post-date"><i class="fa fa-clock-o"></i>6 days ago</span>
										<p>Neque porro quisquam est, qui em ipsum quia dolor sit amet.</p>
									</div>
								</li>
								<li>
									<span class="recent-post-img"><img src="images/aside-recent-post/img-03.jpg" alt="img-03"></span>
									<div class="recent-post-detail">
										<h5><a href="#">Static image post</a></h5>
										<span class="recent-post-date"><i class="fa fa-clock-o"></i>6 days ago</span>
										<p>Neque porro quisquam est, qui em ipsum quia dolor sit amet.</p>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- Recent Post -->

					<!-- Text Widget -->
					<div class="aside-widget">
						<h3>Text Widget</h3>
						<div class="text-widget">
							<ul>
								<li>
									<p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, <a href="#">consectetur, adipisci</a> lit, sed quia non numquam eius modi mpora.</p>
								</li>
								<li>
									<p>Incidunt ut labore et dolore magnam aliquam quaerat pt tem. <a class="read-more" href="#"> Read more</a></p>
								</li>
							</ul>
						</div>
					</div>
					<!-- Text Widget -->

					<!-- Twitter Feed -->
					<div class="aside-widget">
						<h3>Twitter Feed</h3>
						<div class="twitter-feed">
							<ul>
								<li>
									<div class="twitter-brand-name">
										<span class="other-brands-logo"><img src="images/twitter-post-logos/img-01.jpg" alt="img-01"></span>
										<h6><a href="#">Envato Studio</a><span>@EnvatoStudio</span></h6>
									</div>
									<div class="brand-name">
										<p>A community of handpicked developers and designers, available just for you.</p>
										<span class="site-link"><a href="#">#envatostudio</a>6 hour ago</span>
									</div>
								</li>
								<li>
									<div class="twitter-brand-name">
										<span class="other-brands-logo"><img src="images/twitter-post-logos/img-02.jpg" alt="img-02"></span>
										<h6><a href="#">Adobe Customer Care</a><span>@AdobeCare</span></h6>
									</div>
									<div class="brand-name">
										<p>Official Customer Support account for Adobe | Need additional.</p>
										<span class="site-link"><a href="#">http://forums.adobe.com</a>6 hour ago</span>
									</div>
								</li>
								<li>
									<div class="twitter-brand-name">
										<span class="other-brands-logo"><img src="images/twitter-post-logos/img-03.jpg" alt="img-03"></span>
										<h6><a href="#">Adobe Photoshop</a><span>@Photoshop</span></h6>
									</div>
									<div class="brand-name">
										<p>The industry standard in digital imaging and used by profession.</p>
										<span class="site-link"><a href="#">#photoshop</a>6 hour ago</span>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<!-- Twitter Feed -->

					<!-- Instagram -->
					<div class="aside-widget">
						<h3>Instagram</h3>
						<div class="instagram">
							<ul>
								<li><a href="#"><img src="images/instagram/img-01.jpg" alt="img-01"></a></li>		
								<li><a href="#"><img src="images/instagram/img-02.jpg" alt="img-02"></a></li>		
								<li><a href="#"><img src="images/instagram/img-03.jpg" alt="img-03"></a></li>		
								<li><a href="#"><img src="images/instagram/img-04.jpg" alt="img-04"></a></li>		
								<li><a href="#"><img src="images/instagram/img-05.jpg" alt="img-05"></a></li>		
								<li><a href="#"><img src="images/instagram/img-06.jpg" alt="img-06"></a></li>		
								<li><a href="#"><img src="images/instagram/img-07.jpg" alt="img-07"></a></li>		
								<li><a href="#"><img src="images/instagram/img-08.jpg" alt="img-08"></a></li>		
							</ul>
						</div>
					</div>
					<!-- Instagram -->

					<!-- Tags -->
					<div class="aside-widget">
						<h3>Tags</h3>
						<div class="tags-list">
							<ul>
								<li><a href="#">Sports</a></li>
								<li><a href="#">School Exams</a></li>
								<li><a href="#">MusicBirthdays</a></li>
								<li><a href="#">Incentive</a></li>
								<li><a href="#">Seminars</a></li>
							</ul>
						</div>
					</div>
					<!-- Tags -->

				</aside>
				<!-- Aside -->
            
            
		</div>
	</section>
    <?php
    if (count($other_post)> 0){
    ?>
    <section id="news" class="related-article">
        <div class="container news-container">
            
            <div class="row">
                
            </div>
            
            <div class="row">
                <div class="col-md-9 col-md-offset-3 no-padding">
                <div class="text-center">
                    <h4>- <?=$other_article;?> -</h4>
                </div>
                <?php
                foreach($other_post as $op){
                    
                    
                    
                    $descriptionnya = strip_tags($op["description"]);
                    if (strlen($descriptionnya) > 36){
                        $descriptionnya = substr($descriptionnya,0,36)."...";
                    }
                    $titlenya = strip_tags($op["title"]);
                    if (strlen($titlenya) > 25){
                        $titlenya = substr($titlenya,0,25)."...";
                    }
                ?>
                <div class="col-sm-3 padding-4px">
                    <div class="news-item">
                    <div class="list-news-item">
                        <div class="image-list-news">
                            <?php
                            if ($op["pic"] != ""){
                            ?>
                            <img src="<?=base_url("uploads/artikel/".$op["pic"])?>" />
                            <?php
                            }
                            ?>
                        </div>
                        <h3><a title="<?=$op["title"]?>" href="<?=base_url($codebahasa.$op["link_detail"].'/'.$op["link_news"])?>"><?=$titlenya?></a></h3>
                        <div class="descnews">
                        <?=$descriptionnya?>
                        </div>
                    </div>
                    </div>
                </div>
                
                <?php
                }
                ?>
                </div>
            </div>
            
        </div>
    </section>
    <?php
    }
    ?>
    <style>
    .single-blog-post .blog-post-detail {
        padding: 0px 0 0;
    }
    .detailimage img{
        margin-bottom:15px;
    }
    </style>
<?php $this->load->view('sources/footer.php')?>