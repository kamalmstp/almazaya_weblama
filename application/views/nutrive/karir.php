<?php $this->load->view('sources/header.php')?>
<style>
.overlay{
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  z-index: 10;
  background-color: rgba(255,255,255,0.6);
}
.modal {
    /* some styles to position the modal at the center of the page */
    position: fixed;
    top: 10%;
    left: 50%;
    width: 80%;
    line-height: 200px;
    height: 80%;
    margin-left: -40%;
    background-color: #6A0081;
    text-align: center;
  
    /* needed styles for the overlay */
    z-index: 10; /* keep on top of other elements on the page */
    border-radius: 5px;
}
a.close_popup{
    color: hsl(0, 0%, 100%);
    font-size: 45px;
    line-height: 33px;
    position: absolute;
    right: 6px;
    top: 0;
}
</style>
          <div class="wrap-content row">
            <div class="search_job">
                <input type="text" name="searchnya" class="searchnya" placeholder="Search by job position or job field" />
                <a href="" class="search_btn"><img src="<?=base_url("assets/frontend/images/search.png")?>" /></a>
            </div>
            <div id="wrap-profil-person" class="large-12 columns no-padding-left no-padding-right">
                <div class="pengaduan_nasabah content karir"> 
                <div class="nav_karir">
                    <ul>
                        <li><a href="">Overview</a></li>
                        <li><a href="">Why Muamalat?</a></li>
                    </ul>
                </div>
                <div class="overview">
                    <div class="banner">
                        <img src="<?=base_url("assets/frontend/images/banner-karir.jpg")?>" />
                        <div class="title_banner_karir">
                            <div class="tanda">
                                <img src="<?=base_url("assets/frontend/images/panah-pojok.png")?>" />
                            </div>
                            <div class="titlenya">Apakah anda generasi muda yang memiliki wawasan luas, penuh dengan energi dan memiliki semangat yang tak terpatahkan untuk menjadi bagian dari sebuah kesuksesan</div>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="title-overview" style="background: rgba(100,100,100,.6)">
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    
                    
                </div>
                
                <div class="programs">
                    <h3>Programs</h3>
                    <div class="title-programs" style="background: rgba(100,100,100,.6)">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    </div>
                    <div class="list-programs">
                        <div class="large-6 columns">
                            <div class="imagenya">
                                <img src="<?=base_url("assets/frontend/images/program1.jpg")?>" />
                            </div>
                            <div class="title_programs">
                                FRESH GRADUATE PROGRAMS
                            </div>
                            <div class="description_programs">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </div>
                        </div>
                        
                        <div class="large-6 columns">
                            <div class="imagenya">
                                        <img src="<?=base_url("assets/frontend/images/program2.jpg")?>" />
                                    </div>
                                    <div class="title_programs">
                                        EXPERIENCE HIRED PROGRAM
                                    </div>
                                    <div class="description_programs">
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="announcement">
                    <h3>Announcement</h3>
                    
                    <div id="owl-demo">
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                      <div class="item">
                        <h2>Pengumuman Tes Kesehatan</h2>
                        <div class="description">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </div>
                        <div class="seemore">
                            <a href="seemore">See More</a>
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="job-list">
                    <h3>JOB LIST</h3>
                    <div class="title-programs" style="background: rgba(100,100,100,.6)">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    </div>
                    <div class="job-list-item">
                        <table>
                            <tr><th style="width: 35%;">LOWONGAN KERJA</th><th>BATAS AKHIR</th></tr>
                            <?php
                            foreach ($joblist as $dt){
                            ?>
                            <tr><td><a href="javascript:;" rel="<?=$dt["id"]?>" class="popup_joblist" ><?=$dt["title"]?></a></td><td><?=$dt["batas_akhir"]?></td></tr>
                            
                            <?php
                            }
                            ?>
                            
                        </table>
                    </div>
                </div>
                <div class="content">
                    <?=$current_content?>
                </div>
            </div>
          </div>
          </div>
          
          <style>
            #owl-demo .item{
                margin: 5px;
            }
          </style>
          <script>
          
            $(document).ready(function() {
            
                $("#owl-demo").owlCarousel({
             
                  autoPlay: 3000, //Set AutoPlay to 3 seconds
                  navigation : true,
                  items : 4,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3]
             
              });
               $(".owl-dot span").each(function(i) {
                //$(this).addClass("item" + (i+1));
                $(this).html((i+1));
                });
                $(".owl-dot").click(function(){
                    $(".owl-dot").removeClass("active");
                    $(".owl-dot").addClass("notactive");
                    $(this).addClass("active");
                    $(this).click();
                });
                $(".owl-dot > span").click(function(){
                    //alert("test"); 
                    $(this).click();
                    
                });
                $(".popup_joblist").click(function(){
                    $(".overlay").show();
                    $(".modal").show();
                });
                $(".overlay").click(function(){
                    $(this).hide(); 
                    $(".modal").hide();
                });
                $("a.close_popup").click(function(){
                    $(".overlay").hide(); 
                    $(".modal").hide();
                });
                $(".popup_joblist").click(function(){
                    $.ajax({
                        type: "POST",
                        url: '<?=base_url("get_karir_desc")?>',
                        dataType: 'html',
                        data: { 'id': $(this).attr("rel")},
                        
                        complete: function () {
                            $('.loader').css("display", "none");
                        },
                        success: function (xml) {
                            $(".isipopup").html(xml);
                        }
                    });
                })
            })
          </script>
          
          <div class="overlay" style="display: none;"></div>
          <div class="modal" style="display: none;">
          
          <div class="loader">
            <img src="<?=base_url("assets/images/495.gif")?>" />
          </div>
            <a class="close_popup" href="javascript:;" style="position: absolute; right: 0px; top: 0px; color:#fff;">&times;</a>
            <div class="isipopup"></div>
          </div>
<?php $this->load->view('sources/footer.php')?>
