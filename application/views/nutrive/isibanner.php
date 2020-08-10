<div id="owl-demo" class="owl-carousel owl-theme">
<?php
    foreach($rec_banner as $banner){
        ?>
            <div class="item">
            <?php
            if ($banner["link"] != ""){
                ?>
                <a href="<?=$banner["link"]?>"><img src="<?=base_url('assets/images/banner/'.$banner["pic"])?>" alt="<?=$banner["title"]?>"></a>
                <?php                                
            }else{
                ?>
                <img src="<?=base_url('assets/images/banner/'.$banner["pic"])?>" alt="<?=$banner["title"]?>">
                <?php
            }
            ?>
                <img class="lookup-bawah" src="<?=base_url('assets/frontend/images/lookup-bawah.png')?>" />  
            </div>
        <?php
    }
?>
</div>