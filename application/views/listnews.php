<?php $this->load->view('sources/header.php')?>
<section class="section-content container" >
	
		<div class="row">
            <div class="title-page">
            </div>
            <div class="breadcrumb">
                <a href="<?=base_url()?>">Home</a><?=$parent_breadcrumb?><a href="javascript:;"><?=$current_page?></a>
            </div>
            
            <div class="news-content">
                <div class="menu-utama">
                <?php
                if (count($topnews) > 0){
                ?>
                <div class="col-sm-8 kontent-news">
                    
                        <div class="title-news"><h2><a href="<?=base_url($codebahasa.$topnews[0]["link_detail"].'/'.$topnews[0]["link_news"])?>"><?=$topnews[0]["title"]?></a></h2></div>
                        <div class="date-news"><?=$topnews[0]["datenya"]?></div>
                        <div class="desc-news">
                            <?php
                            $descriptionnya = strip_tags($topnews[0]["description"]);
                            if (strlen($descriptionnya) > 200){
                                $descriptionnya = substr($descriptionnya,0,200)."...";
                            }
                            ?>
                            <p><?=$descriptionnya?></p>
                        </div>
                        <div class="seemore-news">
                            <a href="<?=base_url($codebahasa.$topnews[0]["link_detail"].'/'.$topnews[0]["link_news"])?>">See More &raquo;</a>
                        </div>
                
                    </div>
                    <div class="col-sm-4 image-news">
                    <?php
                    if ($topnews[0]["pic"] != ""){
                    ?>
                        <a href="<?=base_url($codebahasa.$topnews[0]["link_detail"].'/'.$topnews[0]["link_news"])?>"><img alt="<?=$topnews[0]["title"]?>" src="<?=base_url("uploads/artikel/".$topnews[0]["pic"])?>" /></a>
                        
                    <?php
                    }else{
                    ?>
                        <a href="<?=base_url($codebahasa.$topnews[0]["link_detail"].'/'.$topnews[0]["link_news"])?>"><img src="<?=base_url("assets/img/no-image-news.png")?>" /></a>
                    <?php
                    }
                    ?>
                    </div>
                <?php
                }else{
                ?>
                <div class="col-sm-12 ">
                    <h4>Content not available</h4>
                </div>
                <?php
                }
                ?>
                </div>
                <div class="news-others">
                    <div class="list-news-others">
                        <?php
                        if (isset($rec)){
                        foreach ($rec as $rec_news){
                            $titlenya = strip_tags($rec_news["title"]);
                            if (strlen($titlenya) > 20){
                                $titlenya = substr($titlenya,0,20)."...";
                            }
                        ?>
                        <div class="col-sm-3 news-list-item">
                            <?php
                            if ($rec_news["pic"] != ""){
                            ?>
                                <div class="news-list-image"><img alt="<?=$rec_news["title"]?>" src="<?=base_url("uploads/artikel/".$rec_news["pic"])?>" /></div>
                                
                            <?php
                            }else{
                            ?>
                                <div class="news-list-image"><img alt="<?=$rec_news["title"]?>" src="<?=base_url("assets/img/no-image-news.png")?>" /></div>
                            <?php
                            }
                            ?>
                            
                            <div class="news-list-content">
                                <div class="news-list-title"><h2><a title="<?=$rec_news["title"]?>" href="<?=base_url($codebahasa.$rec_news["link_detail"].'/'.$rec_news["link_news"])?>"><?=$titlenya?></a></h2></div>
                                <div class="news-list-date"><?=$rec_news["datenya"]?></div>
                                <div class="news-list-readmore"><a href="<?=base_url($codebahasa.$rec_news["link_detail"].'/'.$rec_news["link_news"])?>">See More &raquo;</a></div>
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
            
            
		</div>
	</section>
    <style>
        .news-list-title h2{
            min-height: 42px;
        }
    </style>
    <?php $this->load->view('sources/footer.php')?>