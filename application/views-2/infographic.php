<?php $this->load->view('sources/header.php')?>
<section class="section-content container" >
	
		<div class="row">
            <div class="title-page">
            </div>
            <div class="breadcrumb">
                <a href="<?=base_url()?>">Home</a><?=$parent_breadcrumb?><a href="javascript:;"><?=$current_page?></a>
            </div>
            
            <div class="news-content">
            
                <div class="news-others">
                
                <section id="blog-landing">
                    <?php
                    if (isset($rec)){
                    foreach ($rec as $rec_news){
                        $titlenya = strip_tags($rec_news["title"]);
                        if (strlen($titlenya) > 20){
                            $titlenya = substr($titlenya,0,20)."...";
                        }
                    ?>
                    <article class="white-panel"><a title="<?=$rec_news["title"]?>" href="<?=base_url($codebahasa.$rec_news["link_detail"].'/'.$rec_news["link"])?>"><img alt="<?=$rec_news["title"]?>" src="<?=base_url("uploads/infographic/".$rec_news["pic"])?>" /></a>
                        <h6><?=$rec_news["datenya"]?></h6>
                        <h2><a title="<?=$rec_news["title"]?>" href="<?=base_url($codebahasa.$rec_news["link_detail"].'/'.$rec_news["link"])?>"><?=$titlenya?></a></h2>
                    </article>
                    <?php
                    }}
                    ?>
                </section>
                
                
                    <?php
                        if (isset($rec)){
                            echo $paging;
                        }
                    ?>
                </div>
                
            </div>
            
            
		</div>
	</section>
    <style>
        .news-list-title h2{
            min-height: 42px;
        }
        #blog-landing {
        margin-top: 20px;
        position: relative;
        max-width: 100%;
        width: 100%;
        }
        #blog-landing img {
        width: 100%;
        max-width: 100%;
        height: auto;
        }
        #blog-landing .white-panel {
        position: absolute;
        background: white;
        box-shadow: 0px 1px 2px rgba(0,0,0,0.3);
        padding: 10px;
        }
        #blog-landing .white-panel h1 {
        font-size: 1em;
        }
        #blog-landing .white-panel h1 a {
        color: #A92733;
        }
        #blog-landing .white-panel:hover {
        box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
        margin-top: -5px;
        -webkit-transition: all 0.3s ease-in-out;
        -moz-transition: all 0.3s ease-in-out;
        -o-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        }
        #blog-landing article h2{
            margin-top:0px;
            margin-bottom: 0px;
            font-size: 20px;
            text-transform: capitalize !important;
        }
        #blog-landing article h6{
            text-transform: capitalize !important;
        }
        #blog-landing article h2 a{
            color: #000;
            font-size:20px;
        }
    </style>
    <script src="<?=base_url("assets/js/pinterest_grid.js")?>"></script>
    <script>
        $(document).ready(function(){
            $('#blog-landing').pinterest_grid({
                no_columns: 4,
                padding_x: 10,
                padding_y: 10,
                margin_bottom: 50,
                single_column_breakpoint: 600
            });
        })
    </script>
    <?php $this->load->view('sources/footer.php')?>