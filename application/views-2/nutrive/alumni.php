<?php $this->load->view('sources/head.php')?>

<body class="post">
<section class="mast-wrap">


<?php $this->load->view('sources/header.php')?>




<section class="container page-head about-head silver-bg" style="background-image:url(<?=base_url('assets/images/pages/'.$rec[0]->pic)?>);">
  <div class="row">
    <article class="col-md-12 text-center">
          <div class="inner-pad trans-dark-low">
            <h1 class="white"><span class=""><?=$rec[0]->title?></span></h1>
          </div>
    </article>
</div>
</section>



<div id="content">
    
  <section class="single-project-container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 sub-alumni">
        <?=$rec[0]->subtitle?>
      </div>
    </div>
    <div class="row">
      <div id="wrap-form" class="col-md-6 col-md-offset-3">
        <form name="myform" id="form-alumni" action="javascript:;" onsubmit="javascript:;" enctype="multipart/form-data" method="post"> 
          <div class="input-alumni col-md-12">
            <label for="name">Fullname <span>*</span></label>
            <input type="text" placeholder="Your Fullname" id="name" name="name" size="100" class="border-form">
          </div>
          <div class="input-alumni col-md-12">
            <label for="email">Email <span>*</span></label>
            <input type="text" placeholder="Valid email ID" name="email" id="email" size="30" class="border-form">
          </div>
          <div class="input-alumni col-md-12">
            <label for="address">Address <span>*</span></label>
            <textarea placeholder="Your Personal Address" name="address" cols="40" rows="3" id="address" class="border-form"></textarea>
          </div>
          <div class="input-alumni col-md-6">
            <label for="city">City <span>*</span></label>
            <input type="text" id="city" name="city" size="100" class="border-form">
          </div>
          <div class="input-alumni col-md-6">
            <label for="province">State / Province <span>*</span></label>
            <input type="text" name="province" id="province" size="30" class="border-form">
          </div>
          <div class="input-alumni col-md-12">
            <div class="col-md-6" style="padding-left:0!important">
              <label for="postal">Postal / Zip Code <span>*</span></label>
              <input type="text" name="postal" id="postal" size="30" class="border-form">
            </div>
          </div>
          <div class="input-alumni col-md-6">
            <label>When did you have VCI?</label>
          </div>
          <div class="input-alumni col-md-6">
            <div class="baris-radio">
              <input type="radio" class="radio" name="whendid" value="High School" id="high" />
              <label for="high">High School</label>
            </div>
            <div class="baris-radio">
              <input type="radio" class="radio" name="whendid" value="College" id="college" />
              <label for="college">College</label>
            </div>
            <div class="baris-radio">
              <input type="radio" class="radio" name="whendid" value="Both" id="both" />
              <label for="both">Both</label>
            </div>
          </div>
          <div class="input-alumni col-md-6">
            <label for="namehs">Name of High School <span>*</span></label>
            <input type="text" id="namehs" name="namehs" size="100" class="border-form">
          </div>
          <div class="input-alumni col-md-6">
            <label for="hsgraduation">Year of High School Graduation <span>*</span></label>
            <input type="text" placeholder="Ex: 2014" name="graduation" id="graduation" size="30" class="border-form">
          </div>
          <div class="input-alumni col-md-6">
            <label for="namecol">Name of College</label>
            <input type="text" id="namecol" name="namecol" size="100" class="border-form">
          </div>
          <div class="input-alumni col-md-6">
            <label for="colgraduation">Year of College Graduation (expected or actual)</label>
            <input type="text" id="colgraduation" name="colgraduation" size="100" class="border-form">
          </div>
          <div class="input-alumni col-md-6">
            <label id='alert-occupation' class="txt-alert">Select your current occupation(s): <span>*</span></label>
          </div>
          <div class="input-alumni col-md-6">
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="College Student (Undergraduate level)" id="colundergrad" />
              <label for="colundergrad">College Student (Undergraduate level)</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="College Student (Graduate level)" id="colgrad" />
              <label for="colgrad">College Student (Graduate level)</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="Medical School Student" id="medical" />
              <label for="medical">Medical School Student</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="Law School Student" id="law" />
              <label for="law">Law School Student</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="Trade School Student" id="trade" />
              <label for="trade">Trade School Student</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="Full-Time Employment" id="fullemp" />
              <label for="fullemp">Full-Time Employment</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="Part-Time Employment" id="partemp" />
              <label for="partemp">Part-Time Employment</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="occupation" value="Military Service" id="military" />
              <label for="military">Military Service</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio other-occupation" name="occupation" value="" id="others" />
              <label for="others">
                <input placeholder="Others" type="text" name="otherstxt" id="otherstxt" size="30" class="field-others">
              </label>
            </div>
          </div>
          <div class="input-alumni col-md-12">
            <label for="currentlydo">Please explain what you currently do: <span>*</span></label>
            <textarea name="currentlydo" cols="40" rows="3" id="currentlydo" class="border-form"></textarea>
          </div>
          <div class="input-alumni col-md-12">
            <label for="experience">Tell us about your VCI experience: <span>*</span></label>
            <textarea name="experience" cols="40" rows="3" id="experience" class="border-form"></textarea>
          </div>

          <div class="input-alumni col-md-6">
            <label>How would you like to re-engage with VCI? (select all that apply):</label>
          </div>
          <div class="input-alumni col-md-6">
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Act as an ambassador for the program" id="ambassador" />
              <label for="ambassador">Act as an ambassador for the program</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Judge a VCI-related competition" id="judge" />
              <label for="judge">Judge a VCI-related competition</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Mentor one or more students" id="mentor" />
              <label for="mentor">Mentor one or more students</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Receive VCI News and Updates" id="receive" />
              <label for="receive">Receive VCI News and Updates</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Serve as a VCI Firm Business Partner" id="serve" />
              <label for="serve">Serve as a VCI Firm Business Partner</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Volunteer for a VCI-related event" id="volevent" />
              <label for="volevent">Volunteer for a VCI-related event</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio" name="reengage" value="Part-Time Employment" id="voloff" />
              <label for="voloff">Volunteer at a VCI office</label>
            </div>
            <div class="baris-radio">
              <input type="checkbox" class="radio other-engage" name="reengage" value="Others" id="othersengage" />
              <label for="others">
                <input placeholder="Others" type="text" name="otherstxt" id="otherstxtengage" size="30" class="field-others">
              </label>
            </div>
          </div>
          <div id="alert-hasil" class="col-md-12" style="text-align:center;">
          </div>
           <article class="col-md-12">
            <div class="btn-wrap" style="text-align:center;margin-top:30px!important">
              <div class="btn btn-reflex btn-reflex-dark" id="btn-alumni" name="submit" type="submit">Submit</div>
            </div>
          </article>
        </form>
      </div>
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
<script>
  var uri = "<?=base_url('savedata/')?>";
</script>
<script src="<?=base_url('assets/frontend/javascripts/equalheights-init.js')?>" ></script> 
<script src="<?=base_url('assets/frontend/javascripts/hiding-nav.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/parallax-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/services-init.js')?>"></script> 
<script src="<?=base_url('assets/frontend/javascripts/pace.min.js')?>" ></script>  
<script src="<?=base_url('assets/frontend/javascripts/main.js')?>" ></script> 
<script src="<?=base_url('assets/frontend/javascripts/alumni.js')?>" ></script> 

</body>
</html>