<?php $this->load->view('sources/header.php')?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
    $( document ).ready(function() {
        function initClickModal(){
        $(".modal").on('click', function(){
            var idBox = $(this).attr('data-target');
            var dataTitle = $(this).attr('data-title');
            var dataContent = $(this).attr('data-content');
            $("#"+idBox).dialog(
            {
                //autoOpen: false, 
                modal: true, 
                resizable: false,
                minWidth: 350,
                minHeight: 400,
                maxWidth: $(window).width(),
                draggable: false,
                show: {
                    effect: "fade",
                    duration: 500
                },
                open : function() {
                    $('.ui-widget-overlay').addClass('custom-overlay');
                    $("#"+idBox).parent().addClass('modal-promo');
                    $("#"+idBox).html($('<textarea />').html($('.'+dataContent).html()).text());
                    $(".ui-dialog-title").html(dataTitle);
                    
                },
                close: function() {
                    $('.ui-widget-overlay').removeClass('custom-overlay');
                }            
            });
        })
        }
        initClickModal();
        
        $("#btn-loadmore").click(function(){
           var page = $(this).attr('page');
           var next = parseInt(page)+1;
           $.ajax({
              url: "<?=$_SERVER['REQUEST_URI'].'?data=json&p='?>"+next,
              dataType: "json",
          }).done(function(res) {
              if(res.length) {
                $("#btn-loadmore").attr('page', next);  
                var htmlPromo = "";
                res.forEach(function(r){
                  console.log(r);  
                  var encodedStr = r.description.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
                  return '&#'+i.charCodeAt(0)+';';
                  });
                  htmlPromo += '<li><a href="javascript:;" class="modal" data-target="box-dialog-c" data-title="'+r.title+'" data-content="data-content-n'+r.id+'">';
                  htmlPromo += '<img src="<?=base_url('assets/images/promotion')?>/'+r.pic+'">';
                  htmlPromo += '<h3 class="text-center">'+r.title+'</h3>'; 
                  htmlPromo += '<p class="text-center">'+r.sub_title+'</p>'; 
                  htmlPromo += '<span style="display: none;" class="data-content-n'+r.id+'">'+encodedStr+'</span>';
                  htmlPromo += '</a></li>';
                });
                $("#list-promo").append(htmlPromo); 
                initClickModal();
              }
              else {
                $("#btn-loadmore").html('No more data');  
              }
              
          }); 
        });
    });  
</script>
<div class="wrap-judul-page">
    <div class="panah-judul"><img src="<?=base_url("assets/frontend/images/panah-pojok.png")?>" alt=""></div>
    <div class="row judul-page"><?=$current_parent_page?></div>
</div>
<div class="row wrap-feature-home">

  <div id="wrap-menu-page-kiri" class="large-3 columns">
    <ul class="accordion" class="bg-corp" data-accordion role="tablist">            
    <?php foreach ($sidemenu as $sm){ ?>
      <li class="accordion-item">
        <?php if ($controller->getChild($sm->id) > 0){ ?>
        <a href="#panel1d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel1d"><?=$sm->title?></a>
        <?php } else { ?>
        <a href="<?=base_url($sm->link)?>" class="<?=$sm->link == $link ? 'active' : ''?>"><?=$sm->title?></a>
        <?php } ?>
      </li>
    <?php } ?>
    </ul>   
  </div>
  <div id="wrap-profil-person" class="large-9 columns">
    
     <div class="pengaduan_nasabah promotion large-12">
       <h1><?=$current_page?></h1>
       
       <div class="wrap-banner bg-corp">
        <div class="flexslider">
          <ul class="slides">
            <?php foreach($promoBanner as $banner):?>
            <li><img src="<?=base_url('assets/images/promotion_banner/'.$banner['pic'])?>" /></li>
            <?php endforeach?>
          </ul>
        </div>
      </div>
       
       <ul class="list-category">
         <?php foreach($promoCategory as $k => $cat) :?>
         <li class="large-1 item-category <?=$cat['link'] == $catActive ? 'active' : ''?>">
            <a class="link-category" href="<?=base_url($codebahasa.$link.'/'.$cat['link'])?>"><?=$cat['title']?></a>
         </li>
         <?php endforeach?>
       </ul>
       <div>
          <?php if(!count($promo)) { ?><div class="not-found">Tidak ada promo</div><?php } else { ?>  
          <ul class="rig columns-4" id="list-promo">
             <?php foreach($promo as $p) :?>
             <li>
                <a href="javascript:;" class="modal" data-target="box-dialog-c" data-title="<?=$p['title']?>" data-content="data-content-<?=$p['id']?>">
                <img src="<?=base_url('assets/images/promotion/'.($p['pic'] ? $p['pic'] : 'no-pic.jpg'))?>">
                <h3 class="text-center"><?=$p['title']?></h3>
                <p class="text-center"><?=$p['sub_title']?></p> 
                <span style="display: none;" class="data-content-<?=$p['id']?>"><?=htmlentities($p['description'])?></span>
                </a>
             </li>
             <?php endforeach?>
          </ul>  
       </div>
       <div class="load-more">
          <div>  
            <button id="btn-loadmore" page="<?=$page?>">Load More</button>
          </div>
       </div>
       <?php } ?>
    </div>
  </div>
  
</div>
<div id="box-dialog-c" title="Dialog" class="modal-promo" style="display: none;">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>
<?php $this->load->view('sources/footer.php')?>