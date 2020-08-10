<?php $this->load->view('sources/header.php')?>

<section id="about" class="detailnews">

    <div class="container">

        <div class="row">

            <div class="col-sm-9">

                <h1 class="post_title entry-title"><?=$detail[0]["title"]?></h1>

                <div class="image-detail" style="margin-bottom: 20px;">

                    <img src="<?=base_url("uploads/artikel/".$detail[0]["pic"])?>" style="width: 100%;" />

                </div>

                <div class="desc-detail">

                    <?=$detail[0]["description"]?>

                </div>

            </div>

            <div class="col-sm-3 related_article">

                <h4>Related Article :</h4>

                <ul class="related">

                <?php

                foreach($related as $listrelated){

                    ?>

                        <li>

                            <div class="imagerelated"><a href="<?=base_url($codebahasa.$listrelated["link_pages"]."/".$listrelated["link"])?>"><img src="<?=base_url("uploads/artikel/thumb_".$listrelated["pic"])?>" /></a></div>

                            <div class="titlerelated"><a href="<?=base_url($codebahasa.$listrelated["link_pages"]."/".$listrelated["link"])?>"><?=$listrelated["title"]?></a></div>

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