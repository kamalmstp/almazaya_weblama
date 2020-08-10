<?php $this->load->view('sources/head.php')?>
<link href="<?=base_url('assets/frontend/stylesheets/isotope.css')?>" rel="stylesheet" type="text/css"/>
<link href="<?=base_url('assets/frontend/stylesheets/venobox.css')?>" rel="stylesheet" />
<!-- CSS files for plugins -->
<body class="post">
<section class="mast-wrap">


<div class="mobile-nav hidden-lg">
  <ul class="slimmenu">
    
    <?php foreach ($menu as $rowmenu): ?>
      <li><a href="<?=base_url($codebahasa.$rowmenu['link'])?>"><?=$rowmenu['title']?></a></li>
    <?php endforeach ?>
     
  
  </ul>
</div>



<div id="wrap">

  <?php $this->load->view('sources/header.php')?>
  <section class="container page-head awards-head">
    <div class="row">
      <article class="col-md-12 text-center">
        <div class="inner-pad trans-dark-low" style="background:url(<?=base_url('assets/images/pages/'.$page[0]->pic)?>);">
          <h1 class="white"><span class=""><?=$page[0]->title?></span></h1>
          <p class="white"><?=$page[0]->subtitle?></p>
        </div>
      </article>      
    </div>
  </section>
</div>
<!-- end wrap -->

<div id="content">
    
<div id="works-container" class="works-container white-bg container" style="margin:40px 0">

  <?php foreach ($rec as $rowvideo): ?>
    <div class="works-item works-item-one-third">
            <img alt="" title="" class="img-responsive" src="<?=base_url('assets/images/video/'.$rowvideo['pic'])?>"/>
            <a  class="venobox" data-type="youtube" href="<?=$rowvideo['link']?>">
                <div class="works-item-inner valign">
                  <h3 class="black">Alumni <?=$rowvideo['tahun']?></h3>
                  <p class="white"><span class="black-bg"><?=$rowvideo['title']?></span></p>
                </div>
            </a>
    </div>
  <?php endforeach ?>

    <!-- start : works-item -->
    
    <!-- end : works-item -->



  </div>
<?php $this->load->view('sources/footer.php')?>



</div>
<!-- end wrap -->


</section>
<!-- end mast-wrap -->
<?php $this->load->view('sources/foot.php')?>
<!-- Core JS Libraries -->
<script src="<?=base_url('assets/frontend/javascripts/isotope.js')?>"></script>
<script src="<?=base_url('assets/frontend/javascripts/venobox.min.js')?>"></script>
<script src="<?=base_url('assets/frontend/javascripts/pace.min.js')?>" ></script> 
<!-- JS Custom Codes --> 
<script src="<?=base_url('assets/frontend/javascripts/equalheights-init.js')?>" ></script> 
<script src="<?=base_url('assets/frontend/javascripts/hiding-nav.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/isotope-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/parallax-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/venobox-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/main.js')?>" ></script> 

</body>
</html>