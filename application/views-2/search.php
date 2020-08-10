<?php $this->load->view('sources/header.php')?>
<section class="section-content container" >

    
    
    <div class="row">
            <div class="title-page search_result">
                <div class="col-sm-8">
                    <h2>SEARCH RESULT</h2>
                    <div class="results">
                        <p>There are <?=$jumlahdata?> result for "<?php if (isset($_GET["q"])){echo $_GET["q"];} ?>"</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="image_banner">
                        <img src="<?=base_url("assets/img/search-banner.png")?>" />
                    </div>
                </div>
            </div>
            <div class="result-query">
                
                <ul>
                <?php
                foreach ($rec as $pl){
                    $descriptionnya = strip_tags($pl["description"]);
                    if (strlen($descriptionnya) > 200){
                        $descriptionnya = substr($descriptionnya,0,200)."...";
                    }
                    ?>
                    
                    <li>
                        <div class="image-list-produk">
                        <?php
                        if ($pl["kode"] == "produk"){
                        ?>
                        <img src="<?=base_url("uploads/produk/".$pl["pic"])?>" />
                        <?php
                        }else{
                        ?>
                        <img src="<?=base_url("uploads/artikel/".$pl["pic"])?>" />
                        <?php
                        }
                        ?>
                            
                        </div>
                        <div class="produk-deskripsi-mobile">
                            <h3><?=$pl["title"]?></h3>
                            <p><?=$descriptionnya?></p>
                            <div class="seedetail">
                                <a href="<?=base_url($codebahasa.$pl["linkpages"].'/'.$pl["link_detail"])?>">See More ></a> 
                            </div>
                        </div>
                    </li> 
                    <?php
                }
                ?>
                                  
                </ul>
                <?=$paging?>
            </div>
            
            </div>
            
            
		</div>
    
    
	</section>
   
<?php $this->load->view('sources/footer.php')?>