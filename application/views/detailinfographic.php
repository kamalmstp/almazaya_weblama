<?php $this->load->view('sources/header.php')?>
 <section class="section-content container" >
	
		<div class="row">
            <div class="title-page">
            </div>
            
            <div class="event-detail content">
                
                
                
                <div class="col-sm-9 border-left col-sm-push-3" style="overflow: hidden; margin-bottom: 40px;">
                    <div class="event-detail-title">
                    <?php
                    $title = "";
                    if (isset($detail[0]["title"])){
                        $title = $detail[0]["title"];
                    }
                    $datenya = "";
                    if (isset($detail[0]["datenya"])){
                        $datenya = $detail[0]["datenya"];
                    }
                    $description = "";
                    if (isset($detail[0]["description"])){
                        $description = $detail[0]["description"];
                    }
                    ?>
                        <h1><?=$title?></h1>
                    </div>
                    <div class="event-detail-date">
                        <span class="date"><?=$datenya?></span>
                    </div>
                    <div class="event-detail-image">
                        <?php
                        if ($detail[0]["pic"] != ""){
                        ?>
                        <img src="<?=base_url("uploads/infographic/".$detail[0]["pic"])?>" style="width: 100%;" />
                        <?php
                        }
                        ?>
                    </div>
                    <div class="event-detail-description">
                        <?=$description?>
                    </div>
                    <div class="navigate">
                        <div class="col-xs-6 no-padding-left">
                            <?php
                            if (count($prev) > 0){
                            ?>
                            <div class="previous">
                                <a href="<?=base_url($codebahasa.$prev[0]["link_detail"].'/'.$prev[0]["link_next"])?>">< Previous</a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-6 no-padding-right">
                            <?php
                            if (count($next) > 0){
                            ?>
                            <div class="next">
                                <a href="<?=base_url($codebahasa.$next[0]["link_detail"].'/'.$next[0]["link_next"])?>"> Next ></a>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3  col-sm-pull-9">
                    <div class="sidebar-title">
                        <h2>RECENT POST</h2>
                    </div>
                    <div class="list-recent-post">
                        <ul>
                            <?php
                            foreach ($recent_post as $dt){
                            ?>
                            <li>
                                <div class="list-recent-post-date"><?=$dt["datenya"]?></div>
                                <div class="list-recent-post-title"><h3><a href="<?=base_url($codebahasa.$dt["link_detail"].'/'.$dt["link"])?>"><?=$dt["title"]?></a></h3></div>
                            </li>
                            <?php
                            }
                            ?>
                          
                        </ul>
                    </div>
                   
            </div>
		</div>
	</section>
    
    
<?php $this->load->view('sources/footer.php')?>