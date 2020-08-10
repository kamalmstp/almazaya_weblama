<?php
$data = array();
if ($aksi == "detail"){
    
    
    if (isset($cat_title)){
        $title = $cat_title;
        if ($title == ""){
            //header('Location: '.base_url());
        }
        $data["title"] = $title;
    }
    
    
    if (isset($detail[0]["description"])){
        $description = substr($detail[0]["description"], 0, 100);
        $data["description"] = $description;
    }
    
}else{
    $title = "Artikel";
    $description = "Cara enak turunkan kolesterol";
    $data["title"] = $title;
    $data["description"] = $description;
}
?>
<?php $this->load->view('sources/header.php',$data)?>
<!--<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>-->
<div class="content-banner">
            <div class="image_banner">
            
            <?php
            if ($banner != ""){
            ?>
            <img src="<?=base_url("assets/images/pages/".$banner)?>" />
            <?php
            }else{
            ?>
            <img src="<?=base_url("assets/frontend/images/news-banner.jpg")?>" />
            <?php
            }
            ?>
                
            </div>
            <div class="title-banner"><?=$title_page?></div>
        </div>
        <div class="breadcrumb-row">
            <div class="breadcrumbs">
                <a href="<?=base_url()?>">Home</a><a href="<?=base_url($current_link_page)?>"><?=$current_page?></a> 
                <?php
                if (isset($cat_title)){
                    $title = $cat_title;
                    if ($title == ""){
                        //header('Location: '.base_url());
                    }
                    $data["title"] = $title;
                
                ?>
                <a href=""><?=$cat_title?></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="content-row">
        <div class="content-left contact">
            <div class="subtitle">
                <?=$content?>
                </div>
                
                <div class="article">
                    
                    <?php
                    if (isset($_GET["status"])){
                    ?>
                    <div class="row">
                    <div class="notification" style="color: #ffffff; background: #ff0000; margin-bottom: 20px; border-radius:10px;padding: 10px"><?=$_GET["status"]?></div>
                    </div>
                    <?php
                    }
                    ?>
                    <form data-abide method="POST" class="contact">
                    
                    
                    
                    <?php
                    if ($codebahasa == ""){
                    ?>
                    <div class="row">
                        <div class="large-6 columns no-padding-left">
                          <label>Nama
                            <input type="text" name="nama" class="name" required="" />
                          </label>
                          <small class="error">Nama harus diisi</small>
                        </div>
                        <div class="large-6 columns no-padding-left">
                          <label>Email
                            <input type="email" name="email" class="email" required="" />
                          </label>
                          <small class="error">Email harus diisi dan format email harus benar</small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="large-12 columns no-padding-left">
                          <label>Pesan
                            <textarea name="pesan" class="pesan" required=""></textarea>
                          </label>
                          <small class="error">Pesan harus diisi</small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="large-6 columns no-padding-left">
                          <label>Captcha
                            <input type="text" name="captcha" class="captcha" required="" /><img src="<?=base_url("captcha.php")?>" style="position: absolute; top: -8px; left: 67px;">
                          </label>
                          <small class="error  error-captcha">Captcha harus diisi dan valid</small>
                        </div>
                       
                      </div>
                      <div class="row">
                        <div class="large-2 columns no-padding-left" style="margin-top: 10px;">
                          
                          <label>
                            <input type="submit" name="submit" class="submit" value="Kirim" />
                          </label>
                        </div>
                      </div>
                    <?php
                    }else{
                    ?>
                    <div class="row">
                        <div class="large-6 columns no-padding-left">
                          <label>Name
                            <input type="text" name="nama" class="name" required="" />
                          </label>
                          <small class="error">Name is required and must be a string.</small>
                        </div>
                        <div class="large-6 columns no-padding-left">
                          <label>Email
                            <input type="email" name="email" class="email" required="" />
                          </label>
                          <small class="error">An email address is required and must be a valid.</small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="large-12 columns no-padding-left">
                          <label>Message
                            <textarea name="pesan" class="pesan" required=""></textarea>
                          </label>
                          <small class="error">Message is required.</small>
                        </div>
                      </div>
                      <div class="row">
                        <div class="large-6 columns no-padding-left">
                          <label>Captcha
                            <input type="text" name="captcha" class="captcha" required="" /><img src="<?=base_url("captcha.php")?>" style="position: absolute; top: -8px; left: 67px;">
                          </label>
                          <small class="error error-captcha">Captcha is required  and must be a valid.</small>
                        </div>
                       
                      </div>
                      <div class="row">
                        <div class="large-2 columns no-padding-left" style="margin-top: 10px;">
                          
                          <label>
                            <input type="submit" name="submit" class="submit" value="Send" />
                          </label>
                        </div>
                      </div>
                    <?php
                    }
                    ?>
                    
                    
                    
                    
                      
                    </form>
                </div>
                
                
            
        </div> 
        
        
        <div class="content-right" id="content-right">
            <div class="sidebanner" id="sidebanner">
            <div class="article-right alamat">
            <div class="ribbon-atas">ALAMAT</div>
            <p><span>PT Sanghiang Perkasa ( Kalbe Nutritionals )</span></p>
            <p><span>Gedung Graha Kirana Lt. 5, Suite 501</span></p>
            <p><span>Jl. Yos Sudarso Kavling 88 - Jakarta Utara </span></p>
            <p><span>Jakarta 14350</span></p>
            <p><span><br></span></p>
            <p><span style="display: block; margin: auto; width: 74%;"><img width="100%" alt="" src="<?=base_url('assets/frontend/images/Kalbe-cs.jpg')?>"></span></p>
            </div>
            
              
            </div>
        </div>
        
    </div>
    <div id="batas-sticky">&nbsp;</div> 
</div>

<script>

    $(document).ready(function(){

        $(".contact").submit(function(){
            var email = $(".email").val();
            if ($(".captcha").val() != "" && $(".name").val() != "" && (email != '' && validateEmail(email) == 1) && $(".pesan").val() != ""){
                $.ajax({
                    type: "POST",
                    url: "<?=base_url("ajax/cek_captcha")?>",
                    //data: { 'a': 1, 'b': 2, 'c': 3 },
                    dataType: 'html',
                    data: { 'nama':$(".name").val(),'email':$(".email").val(),'pesan':$(".pesan").val(),'captcha': $(".captcha").val()},
                    beforeSend: function () {
                        
                        $(".submit").val("Loading...");
                    },
                    complete: function () {
                        <?php
                        if ($codebahasa == ""){
                        ?>
                        $(".submit").val("Kirim");
                        <?php
                        }else{
                        ?>
                        $(".submit").val("Send");
                        <?php
                        }
                        ?>
                        
                    },
                    success: function (data) {
                        if(data > 0){
                            <?php
                            if ($codebahasa == ""){
                            ?>
                            window.location.href = "<?=base_url($codebahasa.$current_link_page."/?status=Data berhasil dikirim")?>"
                            <?php
                            }else{
                            ?>
                            window.location.href = "<?=base_url($codebahasa.$current_link_page."/?status=Data has been successfully sent")?>"
                            <?php
                            }
                            ?>
                            
                        }else{
                            $(".error-captcha").css("display","block");
                            $(".error-captcha").css("margin-top", "-16px");
                        }
                    }
                });
            }
            return false;
    });
    });
    function validateEmail(email) { 
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (re.test(email)){
            return 1;
        }else{
            return 0;
        }
    } 
</script>
<?php $this->load->view('sources/footer.php')?>
