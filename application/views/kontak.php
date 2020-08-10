<?php $this->load->view('sources/header.php')?>
<section id="about" class="contact">
   <div class="container">
     <div class="row">
        <div class="col-sm-12"><h2 style="text-align: center;"><img src="<?=base_url("assets/img/home-icon.png")?>" /> CONTACT US</h2></div>
     </div>
      <div class="row">
         <div class="col-sm-6 ">
         <div class="form-contact">
            <?php
            if (isset($_GET["success"])){
                ?>
                    <div class="form-contact-success alert-success" style="padding: 10px;">
                    <?=$this->lang->line('success_kontak');?>
                    </div>
                <?php
            }
            ?>
            <div class="form-contact-error"></div>
            <form role="form" class="form-contact-submit" method="POST" action="">
               <div class="form-group">
                  <label for="usr">Nama</label>
                  <input type="text" required="" name="nama" class="form-control" id="nama">
               </div>
               <div class="form-group">
                  <label for="pwd">Email</label>
                  <input type="email" required="" name="email" class="form-control" id="email">
               </div>
               <div class="form-group">
                  <label for="subject">Subject</label>
                  <input type="text" required="" name="subject" class="form-control" id="subject">
               </div>
               <div class="form-group">
                  <label for="pwd"><?=$this->lang->line('message');?></label>
                  <textarea name="message"  required="" class="form-control"></textarea>
               </div>
               <div class="form-group" style="position: relative;">
                  <label for="pwd">Captcha</label>
                  <input type="text" required="" name="captcha" class="form-control captcha" id="captcha">&nbsp; <img class="captcha_image" src="<?=base_url("captcha_contact")?>/">
               </div>
                <a class="triger_submit"><img src="<?=base_url("assets/img/send.png")?>" /></a>
               <input style="display: none;" type="submit" name="submit" class="submit" value="Kirim Pesan" />
            </form>
         </div>
         
         </div>
         <div class="col-sm-6 ">
            <?=$rec[0]["address"]?>
            
            <div class="maps">
                        <style>
      
      #map {
        height: 300px;
      }
    </style>
    
    <div id="map"></div>
    <script>
      function initMap() {
        <?php
        if (count($rec)){
            ?>
            var myLatlng = {lat: <?=$rec[0]["latitude"]?>, lng: <?=$rec[0]["longitude"]?>};
            <?php
            }else{
            ?>
            var myLatlng = {lat: -6.718949013518152, lng: 106.73472783671878};
            <?php    
                
            
        }
        ?>
        

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: myLatlng
        });

        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          label: 'Al Mazaya Islamic School'
        });
        google.maps.event.addListener(marker, 'click', function() {
           infowindow.setContent('<div><?=ltrim(str_replace("</p>","",str_replace("<p>","",preg_replace("/<img[^>]+\>/i", "", $rec[0]["address"]))))?></div>');
           infowindow.open(map,marker);
        });
        
        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        

      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw8ngFj0aTnAgDBI0CihTXpQorjXFwBGE&callback=initMap"
    async defer></script>
    </div>
         </div>
      </div>
   </div>
</section>
<style>
    .form-contact-success{
        margin-bottom:20px;
    }
    h2{
        padding-top:0px;
        margin-top:0px;
    }
    .form-group{
        margin-bottom:10px;
    }
    .form-group label{
        width:100%;
        display: block;
    }
    .form-group input,.form-group textarea{
        width:100%;
        display: block;
    }
    .form-group textarea{
        height:200px;
    }
    #captcha{
        float: left;
        width:50%;
    }
    .form-control{
        background: #ebebeb;
        border: 1px solid #e1e1e1;
        border-radius: 3px;
        box-shadow: none;
    }
    .form-contact-error ul{
        padding-left:0px;
    }
    .form-contact-error ul li{
        color: red
    }
</style>

<script>
    $(document).ready(function(){
        $(".jeniskelamin").change(function(){
            if ($(this).val() != ""){
                $(this).css("color","#000");
            }else{
                $(this).css("color","#bbb");
            }
        });
        
        
    $(".form-contact-submit").submit(function(){
        var form=$(this);
        $.ajax({
            type: "POST",
            data:form.serialize(),
            url: '<?=base_url("savekontak")?>/',
            async: false,
            dataType: 'json',
            //data: { 'qty': qty, 'id': id},
            beforeSend: function () {
                $('.loading').removeAttr("style");
            },
            complete: function () {
                $('.loading').css("display", "none");
            },
            success: function (xml) {
                
                
                if (xml.error != ""){
                    $(".form-contact-error").html("<ul>" + xml.error + "</ul>");
                }else{
                    $(".error-form").html("");
                    if (xml.insert > 0){
                        window.location.href = "<?=base_url($codebahasa."$current_link_page/?success=1")?>";
                    }
                }
                
                
            }
        });
        return false; 
    });
    })
    
    </script>
<?php $this->load->view('sources/footer.php')?>

