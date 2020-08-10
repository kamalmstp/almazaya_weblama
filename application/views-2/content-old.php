
<?php $this->load->view('sources/header.php')?>
<section class="section-content thecontent container" >
	
        <div class="title-page">
            
            <h2><?=$current_page?></h2>
            <hr />
            
        </div>
       
            <div class="contentpage">
                <?=$description?>
            </div>
            
	</section>
    <style>
    .aktif img{
        width:150px !important
    }
    </style>
    <?php $this->load->view('sources/footer-produk.php')?>