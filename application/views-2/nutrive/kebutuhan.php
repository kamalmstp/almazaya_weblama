<?php $this->load->view('sources/header-kebutuhan.php')?>

<style>
    .column, .columns{
        padding-left: 0.3375rem;
        padding-right: 0.2375rem;
    }
    /* Absolute Center Spinner */
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
  background-color: rgba(0,0,0,0.3);
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


section {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: #6A0081;
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: cover !important;
    display: inline-block;
    height: 100vh;
    left: 0;
    padding-top: 90px;
    position: absolute;
    top: 0;
    width: 100%;
}.wrap-result {
    margin-bottom: 0;
    margin-left: auto;
    margin-right: auto;
    margin-top: 9%;
    width: 100%;
    text-align: center;
}
.subtxt-thank {
    color: #fff;
    font-family: "FSLola-Regular";
    font-size: 17px;
    font-weight: bold;
    max-width:400px;
    margin: auto;
}
#form-submit {
    color: hsl(0, 0%, 42%);
    font-family: "FSLola-Regular";
    font-size: 12px;
    font-weight: bold;
    margin-top: 40px;
    max-width: 400px;
    margin-left:  auto;
    margin-right: auto;
}
.txt-thank {
    color: #fff;
    font-family: "FSLola-Regular";
    font-size: 68.5px;
    font-weight: bold;
    line-height: 1.3;
}
#form-submit #btn-result {
    color: #fff;
    cursor: pointer;
    font-family: "Roboto";
    font-size: 17px;
    font-weight: bold;
    line-height: 1.6;
    margin-top: 10px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

#form-submit input {
    background-attachment: scroll;
    background-clip: border-box;
    background-color: hsla(0, 0%, 0%, 0);
    background-image: none;
    background-origin: padding-box;
    background-position: 0 0;
    background-repeat: repeat;
    background-size: auto auto;
    border-bottom-color: hsl(31, 91%, 63%);
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    border-bottom-style: solid;
    border-bottom-width: 3px;
    border-left-color: -moz-use-text-color;
    border-left-style: none;
    border-left-width: medium;
    border-right-color: -moz-use-text-color;
    border-right-style: none;
    border-right-width: medium;
    border-top-color: -moz-use-text-color;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    border-top-style: none;
    border-top-width: medium;
    box-shadow: none;
    transition-delay: 0s;
    transition-duration: 0.5s;
    transition-property: all;
    transition-timing-function: ease;
}
#btn-back a{
    color: #fff;
    font-family: "FSLola-Regular";
    font-size: 20px;
    font-weight: bold;
    line-height: 1.3;
    margin-top: 18px;
    text-decoration: underline;
    display: block;
}
</style>

<div class="kenali_kebutuhan" style="overflow-y: hidden;">
    <div class="small-12 large-6 columns side_left">
        <div class="header">
            <div class="logo1"><img src="<?=base_url("assets/frontend/images/logo1.png")?>" /></div>
            <div class="logo2"><img src="<?=base_url("assets/frontend/images/logo2.png")?>" /></div>
            <div class="home"><a href="<?=base_url($codebahasa)?>"><img src="<?=base_url("assets/frontend/images/gohome.png")?>" /></a></div>
        </div>
        <div class="pertanyaan">
            <p>Ketika Anda melakukan transaksi finansial, kebutuhan tersebut ditujukan untuk siapa? </p>
        </div>
        <div class="wrap-dot">
        <ul>
          <li class="bg-done active"></li>
          <li class="bg-done"></li>
          <li class="bg-done"></li>
          <li class="bg-done"></li>
          <li class="bg-done"></li>
        </ul>
      </div>
        <div class="ribbon">
            <img src="<?=base_url("assets/frontend/images/ribbon.png")?>" />
        </div>
        
    </div>
    <div class="small-12 large-6 columns jawaban_kebutuhan" style="display: none;">
        <ul>
            <li dir="a" lang="1">
                <!--<img src="<?=base_url("assets/frontend/images/rupiah.png")?>" />-->
                <div class="jawabannya">
                    <strong>a.</strong> Consumer Banking 
                </div>
                

            </li>
            <li dir="b" lang="1">
                
                <div class="jawabannya">
                    <strong>b.</strong> Retail Banking
                </div>

            </li>
            <li dir="c" lang="1">
                <div class="jawabannya">
                    <strong>c.</strong> Corporate Banking
                </div>

            </li>
           
            
        </ul>
    </div>
</div>
<section id="result" class="container side_left" style="display: none;">
    <div class="header" style=" margin-top: -63px">
            <div class="logo1"><img src="<?=base_url("assets/frontend/images/logo1.png")?>" /></div>
            <div class="logo2"><img src="<?=base_url("assets/frontend/images/logo2.png")?>" /></div>
            <div class="home" style="right: 10px;"><a href="<?=base_url($codebahasa)?>"><img src="<?=base_url("assets/frontend/images/gohome.png")?>" /></a></div>
        </div>
    <div class="wrap-result">
      <div class="txt-thank">THANK YOU!</div>
      <div class="subtxt-thank">Kindly write your name down below:</div>
      <form id="form-submit" action="">
        <input type="text" placeholder="NAME" id="name-user" name="name-user" style="color:#fff;border-bottom: 3px solid rgb(255, 255, 255); box-shadow: 0px -6px 5px -6px rgb(169, 12, 51) inset;">
        <input type="text" placeholder="E-MAIL" id="email-user" name="email-user" style="color:#fff;border-bottom: 3px solid rgb(255, 255, 255); box-shadow: 0px -6px 5px -6px rgb(169, 12, 51) inset;">
        <input type="hidden" id="hasil-option" name="hasil" value="a,a,b,a,a,a,b,a,a,a" style="color:#fff;border-bottom: 3px solid rgb(247, 164, 75); box-shadow: none;">
        <div id="btn-result">CHECK THE RESULT<br><img alt="" src="<?=base_url("assets/images/panah-submit.png")?>"></div>
      </form>
    </div>
  </section>
<div class="loading" style="display: none;">Loading&#8230;</div>
<script>
    $(window).ready(function(){
        var totalli = $(".jawaban_kebutuhan > ul > li").length;
        //alert(totalli);
        var pembagi;
        if (totalli <= 3){
            pembagi = 1;
        }
        if (totalli <= 6 && totalli > 3){
            pembagi = 2;
        }
        if (totalli > 6){
            pembagi = 3;
        }
        var height_right = $(".side_left").height();
        
        var heightnya = (parseInt(height_right) / pembagi);
        $(".jawaban_kebutuhan > ul > li").css("height",heightnya);
        $(".jawaban_kebutuhan").removeAttr("style");
               
        
        
    });
    $('body').on('click','#btn-result',function(){
        
        if ($("#name-user").val() == ''){
            $("#name-user").css("border-bottom","2px solid red");
        }
        if ($("#email-user").val() == ''){
            $("#email-user").css("border-bottom","2px solid red");
        }
        if ($("#name-user").val() == '' || $("#email-user").val() == ''){
            return false;
        }
        $.ajax({
            type: "POST",
            url: '<?=base_url("get_kenali")?>',
            dataType: 'json',
            data: { 'pertanyaan': "result", 'nama':$("#name-user").val(), 'email': $("#email-user").val()},
            beforeSend: function () {
                $('.loading').removeAttr("style");
            },
            complete: function () {
                $('.loading').css("display", "none");
            },
            success: function (data) {
                
                var htmlstring = "<div class='txt-thank'>Hi "+data.nama+"!</div>";
                htmlstring += "<div class='subtxt-thank'>"+data.result+"</div>";
                htmlstring += "<div id='btn-back'><a href=''>&laquo; Back</a></div>";
                $(".wrap-result").html(htmlstring);
                
            }
        });
    });
    $('body').on('click','.jawaban_kebutuhan li',function(){
         var height_right = $(".side_left").height();
        $.ajax({
                type: "POST",
                url: '<?=base_url("get_kenali")?>',
                dataType: 'json',
                data: { 'pertanyaan': $(this).attr("lang"), 'jawaban':$(this).attr("dir")},
                beforeSend: function () {
                    $('.loading').removeAttr("style");
                },
                complete: function () {
                    $('.loading').css("display", "none");
                },
                success: function (data) {
                     
                    if (data.pertanyaan == "selesai"){
                        
                        $("#result").show();
                        $('.loading').css("display", "none");
                    }
                    $(".pertanyaan").html(data.pertanyaan);
                    $(".jawaban_kebutuhan > ul").html(data.jawaban);
                    
                    var pembagi;
                    if (data.totaljawaban <= 3){
                        pembagi = 1;
                    }
                    if (data.totaljawaban <= 6 && data.totaljawaban > 3){
                        pembagi = 2;
                    }
                    if (data.totaljawaban > 6){
                        pembagi = 3;
                    }
                    
                    var lebar;
                    if (data.totaljawaban == 1){
                        lebar = "100%";
                    }
                    if (data.totaljawaban == 1){
                        lebar = "49%";
                    }
                    if (data.totaljawaban == 4){
                        lebar = "50%";
                    }
                    
                    var heightnya = (parseInt(height_right) / pembagi);
                    $(".jawaban_kebutuhan > ul > li").css("height",heightnya);
                    $(".jawaban_kebutuhan > ul > li").css("width",lebar);
                    //$(".jawaban_kebutuhan > ul > li").css("margin-right","4px");
                    $(".jawaban_kebutuhan").removeAttr("style");
                    $(".wrap-dot > ul > li").removeClass("active");
                    $(".wrap-dot > ul > li:nth-child("+data.ke+")").addClass("active");
                    
                }
            });
    });
</script>
<?php $this->load->view('sources/footer-kebutuhan.php')?>
