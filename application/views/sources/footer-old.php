<!-- </.page_content_wrap> -->
			<footer class="footer_wrap widget_area scheme_dark">
				<div class="footer_wrap_inner widget_area_inner">
					<div class="content_wrap">
						<div class="columns_wrap">
							<div class="column-1_2">
								<div class="contacts_wrap">
									<div class="contacts_wrap_inner">
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
									<!-- /.contacts_wrap_inner -->
								</div>
								<!-- /.contacts_wrap -->
							</div>
							<div class="column-1_2 width_right">
								<div class="columns_wrap">
									
									<aside id="text-3" class="widget_number_2 widget widget_text">
										<h5 class="widget_title">newslettter sign-up</h5>
										<div class="textwidget">
											<form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-532" method="post" data-id="532" data-name="form">
												<div class="mc4wp-form-fields"><input type="email" name="EMAIL" placeholder="Email" required /><input type="submit" value="Subcribe" />
													<div class="hidden"><input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" /></div>
													<input type="hidden" name="_mc4wp_timestamp" value="1481283227" />
													<input type="hidden" name="_mc4wp_form_id" value="532" />
													<input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" />
												</div>
												<div class="mc4wp-response"></div>
											</form>
											<!-- / MailChimp for WordPress Plugin -->
										</div>
									</aside>
									<aside id="charity_is_hope_widget_socials-3" class="widget_number_3 widget widget_socials">
										<h5 class="widget_title">SOCIAL MEDIA</h5>
										<div class="widget_inner">
											<div class="sc_socials sc_socials_type_icons sc_socials_shape_square sc_socials_size_small">
												<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_twitter"><span class="icon-twitter"></span></a></div>
												<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_facebook"><span class="icon-facebook"></span></a></div>
												<div class="sc_socials_item"><a href="#" target="_blank" class="social_icons social_gplus"><span class="icon-gplus"></span></a></div>
											</div>
										</div>
									</aside>
								</div>
							</div>
						</div>
						<!-- /.columns_wrap -->
					</div>
					<!-- /.content_wrap -->
				</div>
				<!-- /.footer_wrap_inner -->
			</footer>
			<!-- /.footer_wrap -->
			<div class="copyright_wrap copyright_style_text  scheme_original">
				<div class="copyright_wrap_inner">
					<div class="content_wrap">
						<div class="copyright_text">
							<p> &copy; 2016 Yayasan Al Umar Tirto Sudarmo. All Rights Reserved.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.page_wrap -->
	</div>
	<!-- /.body_wrap -->
	<a href="#" class="scroll_to_top icon-up" title="Scroll to top"></a>
	<div class="custom_html_section"></div>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/jquery.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/jquery-migrate.min.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/fw/js/superfish.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/fw/js/core.utils.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/fw/js/core.init.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/fw/js/swiper/swiper.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/shortcodes/theme.shortcodes.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/plugins/revslider/public/assets/js/jquery.themepunch.revolution.min.js")?>'></script>
	<script type="text/javascript" src="<?=base_url("assets/js/vendor/plugins/revslider/public/assets/js/extensions/revolution.extension.video.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("assets/js/vendor/plugins/revslider/public/assets/js/extensions/revolution.extension.slideanims.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("assets/js/vendor/plugins/revslider/public/assets/js/extensions/revolution.extension.layeranimation.min.js")?>"></script>
	<script type="text/javascript" src="<?=base_url("assets/js/vendor/plugins/revslider/public/assets/js/extensions/revolution.extension.navigation.min.js")?>"></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/plugins/isotope/dist/isotope.pkgd.min.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/plugins/essential-grid/public/assets/js/jquery.themepunch.tools.min.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/vendor/jquery-migrate.min.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/custom/global.js")?>'></script>
	<script type='text/javascript' src='<?=base_url("assets/js/custom/rev_slider_1_1.js")?>'></script>
    <script src="<?=base_url("assets/js/jquery.fancybox.min.js")?>"></script>
    <script type="text/javascript">
	$("[data-fancybox]").fancybox({
		// Options will go here
	});
</script>
</body>
</html>




