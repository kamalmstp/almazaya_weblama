<div class="header-section">

  <!--toggle button start-->
  <a class="toggle-btn"><i class="fa fa-bars"></i></a>
  <!--toggle button end-->

  <!--search start-->
  <!-- <form class="searchform" action="index.html" method="post">
      <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
  </form> -->
  <!--search end-->

  <!--notification menu start -->
  <div class="menu-right">
      <ul class="notification-menu">
        <li>
          <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url('assets/images/user/'.$this->session->userdata('pic'))?>" alt="" />
              <?=ucwords($this->session->userdata('nama'));?>
              <span class="caret"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
              <li><a href="<?=base_url('webadmin/profile')?>"><i class="fa fa-user"></i>  Edit Profile</a></li>
              <li><a target="_blank" href="<?=base_url()?>"><i class="fa fa-desktop"></i>  Visit Site</a></li>
              <li><a href="<?=base_url('webadmin/logout')?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
          </ul>
        </li>

      </ul>
  </div>
  <!--notification menu end -->

</div>