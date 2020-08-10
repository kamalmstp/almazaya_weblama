<?php $this->load->view('sources/header.php')?>
<section class="section-content container" id="about" style="padding-top: 20px;" >
    <div class="row">
            <div class="title-page search_result">
                <div class="results">
                    <p><?=$jumlahdata?> result found for "<?php if (isset($_GET["q"])){echo $_GET["q"];} ?>"</p>
                    
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
                      
                        <div class="produk-deskripsi-mobile">
                            <h3><?=$pl["title"]?></h3>
                            <p><?=$descriptionnya?>
                            <?php
                            if ($pl["kode"] == "pages" ){
                                ?>
                                <a href="<?=base_url($codebahasa.$pl["linkpages"])?>/">Read More</a> 
                                <?php
                            }else{
                                ?>
                                <a href="<?=base_url($codebahasa.$pl["linkpages"].'/'.$pl["link_detail"])?>/">Read More</a> 
                                <?php
                            }
                            ?>
                            
                            </p>
                            <div class="seedetail">
                                
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