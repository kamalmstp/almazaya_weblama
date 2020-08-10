<link href="<?=base_url('assets/backend/js/iCheck/skins/flat/green.css')?>" rel="stylesheet">
<style>
.body{
    width: 100% !important;
}
#map {width: 800px;height: 600px;}
#dragStatus { padding-top: 10px;}
.controls {
margin-top: 10px;
border: 1px solid transparent;
border-radius: 2px 0 0 2px;
box-sizing: border-box;
-moz-box-sizing: border-box;
height: 32px;
outline: none;
box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
background-color: #fff;
font-family: Roboto;
font-size: 15px;
font-weight: 300;
margin-left: 12px;
padding: 0 11px 0 13px;
text-overflow: ellipsis;
width: 300px;
}

#pac-input:focus {
border-color: #4d90fe;
}

.pac-container {
font-family: Roboto;
}

#type-selector {
color: #fff;
background-color: #4d90fe;
padding: 5px 11px 0px 11px;
}

#type-selector label {
font-family: Roboto;
font-size: 13px;
font-weight: 300;
}
#target {
width: 345px;
}

</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&.js"></script>

<div class="wrapper">
  <div class="row">
    <div class="col-lg-12">
        <?php
        if (isset($status)) {
            if ($status['success'] == true) {
            ?>
                <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Success!</strong> Data has been saved!
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> Data not saved. Please check field.
                <ul>
                  <?=$status['notice']?>
                </ul>
                </div>
                <?php
            }
        }
        ?>
        
    
      <form role="form" class="cmxform" id="commentForm" method="POST" action=""  enctype="multipart/form-data">
        
            
        <input name="form" type="hidden" value="1">
        <section class="panel">
          <header class="panel-heading">
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header>
         
          <div class="panel-body">
            
            <div class="row">
                
              <div class="form-group col-md-12">
              <label for="exampleInputEmail1">Tentukan lokasi dalam peta</label>
              <input id="pac-input" class="controls" type="text" placeholder="Search Box">

                <div id="map"></div>
                <div id="dragStatus"></div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Latitude</label>
                <input class="input-title-key form-control latitude" name="latitude" value="<?php if(count($rec) > 0){ echo $rec[0]["latitude"]; }?>"  type="text" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Longitude</label>
                <input class="input-title-key form-control longitude" name="longitude" type="text" value="<?php if(count($rec) > 0){ echo $rec[0]["longitude"]; }?>"/>
              </div>
            </div>
            <?php 
            $r = 0;
            foreach ($lang as $rowlang): 
                $required = "";
                if ($r == 0){
                $required = "required='required'";
            }
            ?>
            <input name="idlang[<?=$r?>]" type="hidden" value="<?=$rowlang['id']?>">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Address <?=$rowlang["title"]?></label>
                    <textarea class="texttiny" name="address<?=$rowlang['id']?>" rows="6"><?php if(count($rec) > 0){ echo $rec[$r]["address"]; }?></textarea>
                  </div>
                </div>
            <?php
            $r++;
            endforeach 
            ?>
          </div>
        </section>
        <section class="panel">
          <!-- <header class="panel-heading">
            Buttons
            <span class="tools pull-right">
              <a class="fa fa-chevron-down" href="javascript:;"></a>
            </span>
          </header> -->
          <div class="panel-body">
            <div class="row">
              <div class="form-group col-lg-12">
                
                <button class="btn btn-success" name='publish' value="publish">Publish</button>
                <a href="<?=base_url('webadmin/'.$url_module)?>" class="btn btn-default" type="button">Cancel</a>
              </div>
            </div>
          </div>
        </section>
      </form>
      
      
    </div>
  </div>
</div>

<!--icheck -->
<script src="<?=base_url('assets/backend/js/iCheck/jquery.icheck.js')?>"></script>
<script src="<?=base_url('assets/backend/js/icheck-init.js')?>"></script>
<script src="<?=base_url('assets/backend/js/tinymce/tinymce.min.js')?>"></script>

<script>

$('#commentForm').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
</script>
<script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        
        
        <?php if(count($rec) > 0){ 
            if ($rec[0]["latitude"] != ""){
            ?>
            var lat = <?=$rec[0]["latitude"]?>;
            <?php
            }else{
            ?>
            var lat = "-6.4160794";
            <?php
            } 
            
        }?>
        
        <?php if(count($rec) > 0){ 
            if ($rec[0]["longitude"] != ""){
            ?>
            var longitude = <?=$rec[0]["longitude"]?>;
            <?php
            }else{
            ?>
            var longitude = "106.8473377";
            <?php
            } 
            
        }?>
        var center = new google.maps.LatLng(lat, longitude);
        
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        var myMarker = new google.maps.Marker({
            position: center,
            draggable: true,
            map: map
        });
        
        google.maps.event.addListener(myMarker, 'dragend', function () {
            map.setCenter(this.getPosition()); // Set map center to marker position
            $(".latitude").val(this.getPosition().lat());
            $(".longitude").val(this.getPosition().lng());
            updatePosition(this.getPosition().lat(), this.getPosition().lng()); // update position display
        });
        
        google.maps.event.addListener(map, 'dragend', function () {
            myMarker.setPosition(this.getCenter()); // set marker position to map center
            updatePosition(this.getCenter().lat(), this.getCenter().lng()); // update position display
        });
        
        function updatePosition(lat, lng) {
            document.getElementById('dragStatus').innerHTML = '<p> Current Lat: ' + lat.toFixed(4) + ' Current Lng: ' + lng.toFixed(4) + '</p>';
        }
        
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            var icon = {
              url: place.icon,
              size: new google.maps.Size(91, 91),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              title: place.name,
              draggable: true,
              position: place.geometry.location
            }));
            
            
            google.maps.event.addListener(markers[markers.length - 1], 'dragend', function() {
                map.setCenter(this.getPosition()); // Set map center to marker position
                $(".latitude").val(this.getPosition().lat());
            $(".longitude").val(this.getPosition().lng());
                updatePosition(this.getPosition().lat(), this.getPosition().lng()); // update position display
                
            });
            google.maps.event.addListener(map, 'dragend', function () {
                markers[markers.length - 1].setPosition(this.getCenter()); // set marker position to map center
                myMarker.setMap(null);
                updatePosition(this.getCenter().lat(), this.getCenter().lng()); // update position display
            });
            
            
            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
              
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
          
        });
       
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw8ngFj0aTnAgDBI0CihTXpQorjXFwBGE&libraries=places&callback=initAutocomplete"
         async defer></script>



<script type="text/javascript">
  tinymce.init({
    selector: ".texttiny",
    force_p_newlines : true,
    force_br_newlines : true,
    convert_newlines_to_brs : false,
    remove_linebreaks : true,    
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
    ],
    relative_urls: false,
    remove_script_host: false,
    content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic underline | blockquote hr | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor fontsizeselect | pastetext removeformat charmap | table | code"
  });
</script>