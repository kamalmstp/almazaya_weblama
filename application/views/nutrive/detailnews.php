<?php $this->load->view('sources/head.php')?>

<body class="post">
<section class="mast-wrap">


<?php $this->load->view('sources/header.php')?>




<section class="container page-head about-head" style="background-image:url(<?=base_url('assets/images/news/'.$rec[0]->pic)?>);">
  <div class="row">
    <article class="col-md-12 text-center">
          <div class="inner-pad trans-dark-low">
            <h1 class="white"><span class=""><?=$rec[0]->title?></span></h1>

            <?php
            $tanggal = explode(' ',$rec[0]->cretime);
            $newDate = date("d-m-Y", strtotime($tanggal[0]));
            ?>
            <p class="white"><?=$newDate?></p>
          </div>
    </article>
</div>
</section>

<div id="content">
    
  <section class="single-project-container">

    <div class="row">
      <article class="col-md-8 col-md-offset-2 single-project-content">
         

        <div class="row">
          <article class="single-project-content-inner col-md-12 white-bg">
            <?=$rec[0]->content?> 
          </article>
        </div>

      </article>
    </div>


  </section>
  <!-- about-container ends -->

</div>
<!-- end content -->




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
<script src="<?=base_url('assets/frontend/javascripts/pace.min.js')?>" ></script>  
<script src="<?=base_url('assets/frontend/javascripts/main.js')?>" ></script> 


</body>
</html>