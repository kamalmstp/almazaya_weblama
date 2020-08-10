    <!-- Footer -->
    <footer class="text-center">
      <div class="footer-above">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-12 lefting">
                <ul>
                    <li>Copyright <?=date("Y")?> Al-Mazaya Islamic School</li>
                    <li><a href="<?=base_url("terms-and-conditions")?>/">Terms &amp; Conditions</a></li>
                    <li><a href="<?=base_url("career")?>/">Career</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-12 righting">
                <ul>
                    <li><a href="<?=$socialmedia[0]["facebook"]?>" target="_blank"><img src="<?=base_url("assets/img/fb-icon.png")?>" /></a></li>
                    <li><a href="<?=$socialmedia[0]["twitter"]?>" target="_blank"><img src="<?=base_url("assets/img/tw-icon.png")?>" /></a></li>
                    <li><a href="<?=$socialmedia[0]["googleplus"]?>" target="_blank"><img src="<?=base_url("assets/img/ig-icon.png")?>" /></a></li>
                </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top d-lg-none">
      <a class="btn btn-primary js-scroll-trigger" href="javascript:;">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>
    <!-- Plugin JavaScript -->
    <script src="<?=base_url("assets/vendor/jquery-easing/jquery.easing.min.js")?>"></script>
    <script src="<?=base_url("assets/js/owl.carousel.js")?>"></script>
    <script src="<?=base_url("assets/js/base.js")?>"></script>
    <script src="<?=base_url("assets/js/jquery.fancybox.min.js")?>"></script>
        <script type="text/javascript">
    	$("a[rel=magnific]").fancybox({
    		// Options will go here
    	});
    </script>
  </body>
</html>