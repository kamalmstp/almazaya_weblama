<?php $this->load->view('cms/sources/head.php')?>
<body class="sticky-header">

  <section>
      <!-- left side start-->
      <?php $this->load->view('cms/sources/sidebar.php')?>
      <!-- left side end-->
      
      <!-- main content start-->
    <div class="main-content" >

      <!-- header section start-->
      <?php $this->load->view('cms/sources/header.php')?>
      <!-- header section end-->

      <!-- page heading start-->
      
      <!-- page heading end-->

      <!--body wrapper start-->
      <?php
        if ($act == 'add'){
            $this->load->view('cms/'.$page.'/add.php');
        }elseif ($act == 'edit'){
            $this->load->view('cms/'.$page.'/edit.php');
        }elseif ($act == 'adsbanner'){
            $this->load->view('cms/'.$page.'/adsbanner.php');
        }elseif ($act == 'view'){
            $this->load->view('cms/'.$page.'/view.php');
        }else{
            $this->load->view('cms/'.$page.'/default.php');
        }
      ?>
      <!--body wrapper end-->

      <!--footer section start-->
      <?php $this->load->view('cms/sources/footer.php')?>