<?php $this->load->view('sources/head.php')?>

<body class="post">
<section class="mast-wrap">

<?php
$data = array();
$data["description"] = "";
//$data = array();
?>
<?php $this->load->view('sources/header.php',$data)?>




<section class="container page-head about-head silver-bg" style="background-image:url(<?=base_url('assets/images/pages/'.$rec[0]->pic)?>);">
  <div class="row">
    <article class="col-md-12 text-center">
          <div class="inner-pad trans-dark-low">
            <h1 class="white"><span class="javascript:;"><?=$rec[0]->title?></span></h1>
            <p class="white"><?=$rec[0]->subtitle?></p>
          </div>
    </article>
</div>
</section>



<div id="">
    
  <section class="container contact-container text-center">

                <div class="row">
                      <article class="contact-content-inner inner-pad trans-dark-low col-md-6 text-center">
                        <div class="valign">
                            <a href="index.html"><img alt="" title="" src="<?=base_url('assets/images/logo.png')?>" class="main-logo"></a>
                            <h3 class="sub-heading white add-top-quarter">Virtual Company Indonesia<br/> Jakarta<br/>
                            Indonesia</h3>
                            <h6 class="white"></h6>
                            <p><a class="white" href="#">hello@virtualcoindonesia.org</a></p>  
                        </div>
                      </article>
                      <article class="contact-content-inner inner-pad col-md-6 white-bg text-left">

                      <div class="valign">
                          <h3 class="sub-heading">Send a message</h3>
<div id="contact-form-wrap" class="container">
          <div class="contact-item pad-common ">
            <div class="alert alert-error error " id="fname">
              <p>Name must not be empty</p>
            </div>
            <div class="alert alert-error  error" id="fmail">
              <p>Please provide a valid email</p>
            </div>
             <div class="alert alert-error  error" id="fmsg">
               <p>Message should not be empty</p>
             </div>
              <form name="myform" id="contactForm" action="javascript:;" onsubmit="javascript:;" enctype="multipart/form-data" method="post"> 
                <article>
                  <input type="text" placeholder="Your Name" id="name" name="name" size="100" class="border-form input-contact">
                </article>
                <article>
                   <input type="text" placeholder="Valid email ID" name="email" id="email" size="30" class="border-form input-contact">
                 </article>
                 <article>
                  <textarea placeholder="Your Message" name="message" cols="40" rows="3" id="msg" class="border-form text-contact"></textarea>
                  <div class="btn-wrap  text-left">
                    <button class="btn btn-reflex btn-reflex-dark" id="submit" name="submit" type="submit">Send Message</button>
                  </div>
                </article>
             </form>
          </div>
    </div>
                    </div>


                      </article>
                </div>
  
</section>
  <!-- about-container ends -->

</div>
<!-- end content -->



<?php

?>
<?php $this->load->view('sources/footer.php')?>



</div>
<!-- end wrap -->


</section>
<!-- end mast-wrap -->

<?php $this->load->view('sources/foot.php')?>
<script src="<?=base_url('assets/frontend/javascripts/equalheights-init.js')?>" ></script> 
<script src="<?=base_url('assets/frontend/javascripts/hiding-nav.js')?>"></script>  
<script src="<?=base_url('assets/frontend/javascripts/parallax-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/services-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/form-validation.js')?>" ></script>
<script src="<?=base_url('assets/frontend/javascripts/pace.min.js')?>" ></script>  
<script src="<?=base_url('assets/frontend/javascripts/main.js')?>" ></script> 
<script>
  $(function() {
    $('form#contactForm').submit(function(){
      //alert('berhasil');
      var uri = "<?=base_url('savedata/save_contact')?>";
      var formData = $("#contactForm").serialize();
    
      $.ajax({
        url:uri,
        type: 'POST',
        data: formData,
        async: false, 
        success : function(){
          alert('Your message has been send');
          $('input').val('');
          $('textarea').val('');
        }            
      });
      return false;
    });
  });
</script>
</body>
</html>