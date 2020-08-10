<?php $this->load->view('sources/header.php')?>
<section id="about">
      <div class="container">
        <h2 class="text-center"><img src="<?=base_url("assets/img/careerlogo.png")?>" /> <?=$title?></h2>
        
        <div class="result">
                        
                        <div class="list-results">
                        
                        <?php
                        if (isset($rec)){
                           if (count($rec) == 0){
                            ?>
                                <h6 style="text-align: center;">Maaf untuk saat ini lowongan yang anda cari belum tersedia</h6>
                            <?php
                           }
                        foreach ($rec as $rec_news){
                            $titlenya = strip_tags($rec_news["title"]);
                            if (strlen($titlenya) > 40){
                                $titlenya = substr($titlenya,0,40)."...";
                            }
                            $descnya = strip_tags($rec_news["description"]);
                            if (strlen($descnya) > 80){
                                $descnya = substr($descnya,0,80)."...";
                            }
                        ?>
                        <div class="col-sm-3">
                            <div class="karir-list">
                                <div class="singkatan" style="display: none;">
                                    <div class="singkatan_in">
                                        <?=$rec_news["singkatan"]?>
                                    </div>
                                </div>
                                <div class="karir-title">
                                    <p><a href="javascript:;" data-toggle="modal" data-target="#myModal<?=$rec_news["id"]?>">- <?=$rec_news["title"]?></a></p>
                                </div>
                                <div class="karir-detail" style="display: none;">
                                    <a href="javascript:;" data-toggle="modal" data-target="#myModal<?=$rec_news["id"]?>">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div id="myModal<?=$rec_news["id"]?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                        
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><?=$rec_news["title"]?></h4>
                              </div>
                              <div class="modal-body">
                                <?=$rec_news["description"]?>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                        
                          </div>
                        </div>
                        <?php
                        }}
                        ?>
                    </div>
                    <?php
                        if (isset($rec)){
                            echo $paging;
                        }
                    ?>
                    </div>
        
      </div>
    </section>
    <script>
         $(document).ready(function(){

            $(document).on('change', '.province', function (evt) {
                $(".city").attr("disabled","disabled");
                $.ajax({
                    
                    type: "POST",
                    url: '<?=base_url("get_city")?>/',
                    dataType: 'json',
                    data: { 'province_id': $(this).val()},
                    
                    complete: function () {
                        $(".city").removeAttr("disabled");
                    },
                    success: function (data) {
                        $(".city option").remove();
                        $('<option>').val("").text("-- Pilih Kota / Kabupaten --").appendTo('.city');
                        $.each(data, function(k, v) {
                            $('<option>').val(v.city_id).text(v.type_city + " " + v.city_name).appendTo('.city');
                        });
                    }
                });
            });
        });
    </script>
    <script>
    $(".form-contact-submit").submit(function(){
        $(this).submit();
    });
    /*$(".form-contact-submit").submit(function(){
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
    });*/
    </script>
<?php $this->load->view('sources/footer.php')?>