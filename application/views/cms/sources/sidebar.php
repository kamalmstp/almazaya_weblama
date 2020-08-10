<div class="left-side sticky-left-side">

        <!--logo and iconic logo start-->
  <div class="logo" style="display: none;">
    <a href="index.html"><img src="<?=base_url('assets/backend/images/logo-backend.png')?>" style="width: 78%;" alt=""></a>
  </div>

  <div class="logo-icon text-center" style="display: none;">
    <a href="index.html" style="display: none;"><img src="<?=base_url('assets/backend/images/logo_icon.png')?>" alt=""></a>
  </div>
    <!--logo and iconic logo end-->


  <div class="left-side-inner">

      <!-- visible to small devices only -->
    <div class="visible-xs hidden-sm hidden-md hidden-lg">
      <div class="media logged-user">
          <img alt="" src="<?=base_url('assets/backend/images/photos/user-avatar.png')?>" class="media-object">
          <div class="media-body">
              <h4><a href="#">John Doe</a></h4>
              <span>"Hello There..."</span>
          </div>
      </div>

      <h5 class="left-nav-title">Account Information</h5>
      <ul class="nav nav-pills nav-stacked custom-nav">
          <li><a href="#"><i class="fa fa-user"></i> <span>Profile</span></a></li>
          <li><a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
          <li><a href="#"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
      </ul>
    </div>

      <!--sidebar nav start-->
    <ul class="nav nav-pills nav-stacked custom-nav">
      <?php
      $r = 0;
      //print_r($menulist);
      foreach ($menulist[0] as $rowmenu) {

        if($submenu == TRUE){
          if ($active == $rowmenu['id']){
            $classaktif = 'nav-active';
            $spanaktif = '<span class="selected"></span>';
            $classarrow = 'open';
          } else {
            $classaktif = '';
            $spanaktif = '';
            $classarrow = '';
          }
        }else{
          if ($current_menu == $rowmenu['link']) {
            $classaktif = 'active';
            $spanaktif = '<span class="selected"></span>';
            $classarrow = '';
          } else {
            $classaktif = '';
            $spanaktif = '';
            $classarrow = '';
          }
        }
      if ($rowmenu['submenu'] == 0) {
      ?>
      <li class="<?=$classaktif?>">
        <a href="<?=base_url('webadmin/'.$rowmenu['link'])?>">
          <i class="fa <?=$rowmenu['icon']?>"></i> <span><?=$rowmenu['title']?></span>
        </a>
      </li>
      <?php
      } else {
      ?>
      <li class="menu-list <?=$classaktif?>">
        <a href="">
          <i class="fa <?=$rowmenu['icon']?>"></i> <span><?=$rowmenu['title']?></span>
        </a>
        <ul class="sub-menu-list">
      <?php
        if (isset($menulist[1][$r][0])) {
            //print_r($menulist[1][$r]);
          foreach ($menulist[1][$r] as $rowsubmenu) {
          if ($active2 == $rowsubmenu['title']) {
            $classsubaktif = 'active';
          } else {
            $classsubaktif = '';
          }
      ?>
          <li class="<?=$classsubaktif?>">
            <a href="<?=base_url('webadmin/'.$rowsubmenu['link'])?>"><i class="fa  <?=$rowsubmenu['icon']?>"></i> <span> <?=$rowsubmenu['title']?></span></a>
          </li>
      <?php
          }
        }
      ?>
        </ul>
      </li>
      <?php
      }
      $r++;
      }
      ?>
        <!--multi level menu start-->
        <!--<li class="menu-list">-->
            <!--<a href="#"><i class="fa fa-map-marker"></i> <span>Multilavel</span></a>-->
            <!--<ul class="sub-menu-list">-->
                <!--<li class="menu-list"><a href="#"> menu1</a>-->
                    <!--<ul class="sub-menu-list">-->
                        <!--<li class="menu-list"><a href="#"><i class="fa fa-map-marker"></i> <span>menu2</span></a>-->
                            <!--<ul class="sub-menu-list">-->
                                <!--<li><a href="#"> menu2 sub</a></li>-->
                                <!--<li><a href="#"> menu2 sub2</a></li>-->
                            <!--</ul>-->
                        <!--</li>-->
                    <!--</ul>-->
                <!--</li>-->
            <!--</ul>-->
        <!--</li>-->
        <!--multi level menu end-->

    </ul>
      <!--sidebar nav end-->

  </div>
</div>