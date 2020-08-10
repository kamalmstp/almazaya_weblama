<footer class="text-center">
        
        <div class="footer-below">
            <div class="container ">
                <div class="row">
                    <div class="col-lg-4">
                        Copyright &copy; 2016 Eternaleaf. All Rights Reserved.
                    </div>
                    <div class="col-lg-4">
                        <div class="nav-footer">
                            <ul>
                                <?php
                                foreach ($footer as $dt){
                                    if($dt["idmodule"] == 1){
                                        ?>
                                        <li><a href="<?=base_url($dt["link"])?>"><?=$dt["title"]?></a></li>
                                        <?php
                                    }else{
                                    ?>
                                        <li><a href="<?=$dt["link"]?>"><?=$dt["title"]?></a></li>
                                    <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="nav-footer-socmed">
                            <ul>
                                <li>Find Us On</li>
                                <li><a target="_blank" href="https://www.facebook.com/Eternaleaf/"><img src="<?=base_url("assets/img/fb.png")?>"></a></li>
                                <li><a target="_blank" href="https://twitter.com/eternaleaf"><img src="<?=base_url("assets/img/tw.png")?>"></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/eternaleaf/"><img src="<?=base_url("assets/img/ig.png")?>"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <div class="loading" style="display: none;">Loading&#8230;</div>
    <div class="loading_produk" style="display: none;"></div>
    <!-- jQuery -->
    
    
    <script src="<?=base_url("assets/js/jquery.touchSwipe.min.js")?>"></script>
    <script src="<?=base_url("assets/js/jasny-bootstrap.min.js")?>"></script>
    <!-- Plugin JavaScript -->
    <script src="<?=base_url("assets/js/jquery.easing.min.js")?>"></script>
    <script src="<?=base_url("assets/js/classie.js")?>"></script>
    <script src="<?=base_url("assets/js/cbpAnimatedHeader.js")?>"></script>
    <!-- Contact Form JavaScript -->
    <script src="<?=base_url("assets/js/jqBootstrapValidation.js")?>"></script>
    <script src="<?=base_url("assets/js/contact_me.js")?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url("assets/js/freelancer.js")?>"></script>
    <script src="<?=base_url("assets/js/owl.carousel.min.js")?>"></script>
    <script src="<?=base_url("assets/js/jquery.nav.min.js")?>"></script>  
    <script src="<?=base_url("assets/js/base2.js")?>"></script>
    <script type='text/javascript' src="<?=base_url("assets/js/codex-fly.js")?>"></script>
    <script>
        
        $(function() {   
            $(".keluar a").click(function(){
                $(".navbar-toggle").trigger( "click" );
            });
            $(".owl-produk").swipe({
                //Generic swipe handler for all directions
                swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
                  //alert("You swiped " + direction );  
                  if (direction != null){
                    //$(".image-produk img").width(120);
                    //$(".produk-deskripsi").hide();
                  }
                  
                },
                //Default is 75px, set to 0 for demo so any distance triggers swipe
                 threshold:0
            }); 
            $('.s').keypress(function (e) {
          if (e.which == 13) {
            $('.submitsearch').click();
            return false;    //<---- Add this line
          }
        }); 
        });
        $(window).load(function(){
            $('.owl-item:nth-child(2)').click();
        });
        $(document).ready(function(){
            
            $(".dropdown-custom select").prev().hide();
            $(".search_btn").click(function(){
                $(".input").toggle( "slow", function() {
                    // Animation complete.
                  });
            });
            var owl = $("#owl-demo");
            owl.owlCarousel({
              items : 3, //10 items above 1000px browser width
              loop:false,
              itemsDesktop : [1000,5], //5 items between 1000px and 901px
              itemsDesktopSmall : [900,3], // betweem 900px and 601px
              itemsTablet: [600,2], //2 items between 600 and 0
              addClassActive :true,
              itemsMobile : false,
              nav: true,
              navText: ["<img src='<?=base_url("assets/img/prev.png")?>'>","<img src='<?=base_url("assets/img/next.png")?>'>"],
              afterAction: function(){
                    alert("bye");
                  if ( this.itemsAmount > this.visibleItems.length ) {
                    $('.next').show();
                    $('.prev').show();
                
                    $('.next').removeClass('disabled');
                    $('.prev').removeClass('disabled');
                    if ( this.currentItem == 0 ) {
                      $('.prev').addClass('disabled');
                    }
                    if ( this.currentItem == this.maximumItem ) {
                      $('.next').addClass('disabled');
                    }
                
                  } else {
                    $('.next').hide();
                    $('.prev').hide();
                  }
                }
            });
            $('#owl-demo').on('change.owl.carousel', function(e) {
            if (e.namespace && e.property.name === 'position' 
            && e.relatedTarget.relative(e.property.value) === e.relatedTarget.items().length - 1) {
            // put your stuff here ...
            console.log('last slide')
            }
            });
            var flag = true;
            /*$('#owl-demo .item').dblclick(function(e){
                e.preventDefault();
              });*/
              var timeout=null;
            /*$('#owl-demo .item').on( "click", function() {
                $(".image-produk img").css("margin-left", "");
                clearTimeout(timeout);
                $(".loading_produk").show();
                if ($(this).hasClass("aktif")){
                    
                }else{
                    $(".item").removeClass("aktif");
                    if ($(this).find("img").width() == 350){
                        $(this).find("img").animate({width: "120px"});
                        $(this).find("img").css("margin-left", "0px");
                        $(this).find( ".produk-deskripsi" ).hide();
                    }else{
                        
                        $('#owl-demo .item').not(this).find("img").animate({width: "120px"});
                        $('#owl-demo .item').not(this).find( ".produk-deskripsi" ).hide();
                        $(this).find("img").animate({width: "350px"});
                        $(this).find("img").css("margin-left", "-60px");
                        $(this).find( ".produk-deskripsi" ).show();
                    }
                }
                timeout=setTimeout(function(){$(".loading_produk").hide();}, 1000);
                
            });*/
         
            function moved() {
                    alert("babase");
                var owl = $("#owl-demo").data('owlCarousel');
                console.log(owl.currentItem)
                console.log(owl.itemsAmount)
                if (owl.currentItem + 1 === owl.itemsAmount) {
                    alert('THE END');
                }
            }
            function callback(event) {
                $('#owl-demo .owl-stage .active').click(function(){
                    if ($(this).closest('.owl-stage').find('.active').index(this) == 2){  
                        owl.trigger('next.owl.carousel');
                    }
                    if ($(this).closest('.owl-stage').find('.active').index(this) == 0 ){
                        
                        owl.trigger('prev.owl.carousel');
                        if ($(this).prev().hasClass("cloned") == true){
                            $('.owl-stage').find('.cloned').eq(3).find('.item').find("img").animate({
                                width: "350px"
                            }, 500, function() {
                            $('.owl-stage').find('.cloned').eq(3).find('.item').find( ".produk-deskripsi" ).show();
                          });
                        }
                    }
                    if ($(this).closest('.owl-stage').find('.cloned').index(this) == 4){  
                        $('.owl-stage').find('.owl-item').eq(4).find('.item').find("img").animate({
                                width: "350px"
                            }, 500, function() {
                            $('.owl-stage').find('.owl-item').eq(4).find('.item').find( ".produk-deskripsi" ).show();
                        });
                    }
                });
            }  
            
            
            $(".owl-stage").on("swipe",function(){
                $(".image-produk img").width(120);
                $(".produk-deskripsi").hide();
            });
        });
        
    </script>
    <script type='text/javascript'>//<![CDATA[
$(window).on('load', function() {
 $('.navmenu-fixed-left').offcanvas({
     placement: 'left',
     autohide: 'true',
     recalc: 'true'
 });
});//]]> 
</script>
<script type="text/javascript">

$(document).ready(function(){
    $('#myModal').on('hide.bs.modal', function(e) {
		$(this).removeData('bs.modal');
	});
	$('.add-to-cart').on('click',function(){
	   $(".loading").show();
		//Scroll to top if cart icon is hidden on top
        $(this).prop('disabled', true);
        var idp = $(this).attr("data-id");
		/*$('html, body').animate({
			'scrollTop' : $(".cart").position().top
		});*/
		//Select item image and pass to the function
		var itemImg = $('.image-produk').find('img').eq(0);
		flyToElement($(itemImg), $('.cart'), idp);
	});
});
function flyToElement(flyer, flyingTo, id) {
	var $func = $(this);
	var divider = 3;
	var flyerClone = $(flyer).clone();
	$(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 100000});
	$('body').append($(flyerClone));
	var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
	var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;
	 
	$(flyerClone).animate({
		opacity: 0.4,
		left: gotoX,
		top: gotoY,
		width: $(flyer).width()/divider,
		height: $(flyer).height()/divider
	}, 700,
	function () {
		$(flyingTo).fadeOut('fast', function () {
			$(flyingTo).fadeIn('fast', function () {
				$(flyerClone).fadeOut('fast', function () {
					$(flyerClone).remove();
                    var qty = $(".qtynya").text();
                    
                    $.ajax({
                        type: "POST",
                        url: '<?=base_url("addcart")?>/',
                        async: false,
                        dataType: 'json',
                        data: { 'qty': qty, 'id': id},
                        beforeSend: function () {
                            $('.loading').removeAttr("style");
                        },
                        complete: function () {
                            $('.loading').css("display", "none");
                        },
                        success: function (xml) {
                            $(".qty_cart").text("(" + xml.total_cart + ")");
                            $(".cartclick").click();
                        }
                    });
            
                    
                    
				});
			});
		});
	});
}
</script>

<style type="text/css">

.caption {height: 130px;overflow: hidden;}
.caption h4 {white-space: nowrap;font-size: 16px;}
.thumbnail img {width: 100%;}
.ratings {padding-right: 10px;padding-left: 10px;color: #d17581;}
.thumbnail {padding: 0;}
.thumbnail .caption-full {padding: 9px;color: #333;}
.thumbnail .btn{margin: 0px 30% 10px 30%;}
.cart_anchor{ float:right; vertical-align:top; background: url('images/cart-icon.png') no-repeat center center / 100% auto;width: 50px;height: 50px; margin-bottom: 50px;}

.ui-btn span{display: none;}

#owl-demo .item{padding-top: 20px 0px;margin: 20px; color: #FFF; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; text-align: center;
  }

.loading_produk {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}   
.loading_produk:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0);
}
.loading_produk:not(:required) {
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}
.loading_produk:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
}
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: show;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.1);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

</style>
  
<script type='text/javascript'>//<![CDATA[
$(window).load(function(){
  autoPlayYouTubeModal();

  //FUNCTION TO GET AND AUTO PLAY YOUTUBE VIDEO FROM DATATAG
  function autoPlayYouTubeModal() {
      var trigger = $("body").find('[data-toggle="modal"]');
      trigger.click(function () {
          var theModal = $(this).data("target"),
              videoSRC = $(this).attr("data-theVideo"),
              videoSRCauto = videoSRC + "?autoplay=1";
          $(theModal + ' iframe').attr('src', videoSRCauto);
          $(theModal + ' button.close').click(function () {
              $(theModal + ' iframe').attr('src', videoSRC);
          });
      });
  }
});//]]> 

</script>
<script>    
    $(document).ready(function(){
      
        $(".plus").click(function(){
           var qtyawal = $(".qtynya").text();
           $(".qtynya").text(parseInt(qtyawal) + 1);
        });
        $(".minus").click(function(){
           var qtyawal = $(".qtynya").text();
           if (qtyawal > 1){
                $(".qtynya").text(parseInt(qtyawal) - 1);
           }
        });
    });
        
        
    </script>
</body>
</html>