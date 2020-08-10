<?php
date_default_timezone_set("Asia/Jakarta");
class Webadmin extends Webadmin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->library('encrypt');
    //$this->load->helper('url');publishData
    $this->segs = $this->uri->segment_array();
    $this->admin = "webadmin";
    $this->data["webadmin"] = "webadmin";
  }
  public function index(){       
    $this->_isLogin();
    //$data['menulist'] = $this->_cekAkses();<br />
    $menulist = $this->db->query('SELECT id,idmenu FROM `divisi` where id = '.$this->session->userdata('divisi').' ORDER BY `cretime` asc')->result_array();
    $menulist = str_replace(';',',',$menulist[0]['idmenu']);
    $menu = $this->db->query('SELECT id,title,link,submenu,icon FROM `menu` where id IN ('.$menulist.') and parent = 0 AND hapus = 0 AND link <> "" ORDER BY `posisi` asc')->result_array();
    $jummenu = count($menu);
    if($jummenu != 0){
      $link = $menu[0]['link'];
    }else{
      $submenu = $this->db->query('SELECT id,title,link,submenu,icon FROM `menu` where id IN ('.$menulist.') and parent <> 0 AND hapus = 0 AND link <> "" ORDER BY `posisi` asc')->result_array();
      $link = $submenu[0]['link'];
    }
    redirect('/'.$this->admin.'/'.$link, 'refresh');
  }
    public function pilihfunction(){
        $link = $this->segs[2];
        $query = $this->db->query("SELECT id,module,parent,title,link FROM `menu` WHERE link = '$link'")->result();
//        echo "<pre>";
//        print_r($query);
        if (isset($query[0]->module)){
            if ($query[0]->module == 22){
                $this->kategoriartikel2($query[0]->id,$query[0]->parent);
            }
            if ($query[0]->module == 45){
                $this->one_page_many_section($query[0]->id,$query[0]->parent,$query[0]->link);
            }
            if ($query[0]->module == 46){
                $this->one_page_many_section($query[0]->id,$query[0]->parent,$query[0]->link);
            }
            if ($query[0]->module == 23){
                $this->postlist($query[0]->id,$query[0]->parent,$query[0]->title);
            }
            if ($query[0]->module == 24){
                $this->pages($query[0]->id,$query[0]->parent,$query[0]->title,1,$query[0]->link);
            }
            if ($query[0]->module == 36){
                $this->pages($query[0]->id,$query[0]->parent,$query[0]->title,2,$query[0]->link);
            }
            if ($query[0]->module == 25){
                $this->menu();
            }
            if ($query[0]->module == 26){
                $this->language();
            }
            if ($query[0]->module == 20){
                $this->karir($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 27){
                $this->divisi();
            }
            if ($query[0]->module == 28){
                $this->user();
            }
            if ($query[0]->module == 29){
                $this->module();
            }
            if ($query[0]->module == 30){
                $this->kategorivideo($query[0]->id,$query[0]->parent,$query[0]->title);
            }
            if ($query[0]->module == 31){
                $this->video($query[0]->id,$query[0]->parent,$query[0]->title);
            }
            if ($query[0]->module == 32){
                $this->kategorifoto($query[0]->id,$query[0]->parent,$query[0]->title);
            }
            if ($query[0]->module == 33){
                $this->foto($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 71){
                $this->infographic($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 34){
                $this->produk($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 40){
                $this->banner($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 41){
                $this->banner_sidebar($query[0]->id,$query[0]->parent,$query[0]->title);
            }
            if ($query[0]->module == 44){
                $this->subscribe($query[0]->id,$query[0]->parent,$query[0]->title);
            }
            if ($query[0]->module == 61){
                $this->bank_account($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 62){
                $this->mapsoffice($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 58){
                $this->shippingorigin($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 68){
                $this->contactreceiver($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 69){
                $this->contactmail($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 67){
                $this->allpurchases($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 70){
                $this->graphic_orac($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 65){
                $this->payment_confirmation($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($query[0]->module == 73){
                $this->adsbanner($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
            }
            if ($this->segs[2] == "reorder_menu"){
                $this->reorder_menu();
            }
            if ($this->segs[2] == "reorder_pages"){
                $this->reorder_pages();
            }
            if ($this->segs[2] == "reorder_sister"){
                $this->reorder_sister();
            }
            if ($this->segs[2] == "reorder_sister_desc"){
                $this->reorder_sister_desc();
            }
            if ($this->segs[2] == "news"){
                $this->news();
            }
        }else{
            if ($this->segs[2] == "reorder_pages"){
                $this->reorder_pages();
            }
            if ($this->segs[2] == "divisi"){
                $this->divisi();
            }
            if ($this->segs[2] == "logout"){
                $this->logout();
            }
            if ($this->segs[2] == "login"){
                $this->login();
            }
            if ($this->segs[2] == "do_login"){
                $this->do_login();
            }
            if ($this->segs[2] == "reorder_menu"){
                $this->reorder_menu();
            }
            if ($this->segs[2] == "reorder_sister"){
                $this->reorder_sister();
            }
            if ($this->segs[2] == "reorder_sister_desc"){
                $this->reorder_sister_desc();
            }
            if ($this->segs[2] == "banner"){
                $this->banner();
            }
        }
    }       
  public function logout(){
    setcookie("userlogin", '', time()-1000, '/', "almazayaislamicschool.com/");
    $this->session->sess_destroy();
    redirect('/webadmin/login', 'refresh');
  }
  function _edit_ubahpass(){
    $usernameold   = $this->input->post('usernameold');
    $username      = $this->input->post('username');
    $oldpassword   = $this->input->post('oldpassword');
    $newpassword   = $this->input->post('newpassword');
    $renewpassword = $this->input->post('renewpassword');
    $fullname      = $this->input->post('fullname');
    $pic           = $this->input->post('pic');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    $pass    = TRUE;
    if($usernameold != $username){
      $cek_username = $this->db->query('SELECT count(*) as jumlah FROM `user` where username= "'.$username.'"')->result(); 
      if ($cek_username[0]->jumlah == 1) {
        $success = FALSE;
        $step1   = FALSE;
        $notice  .= "<li>Username : Someone already has that username</li>";
      }
    }
    $query = $this->db->query('SELECT id,password,pic FROM `user` WHERE id = '.$this->session->userdata('user_id'))->result();
    if($oldpassword != '' OR $newpassword != '' OR $renewpassword != ''){
      $password = sha1(MD5($oldpassword));
      $passlamadb = $query[0]->password;
      $passlama = sha1(MD5($oldpassword));
      if($passlamadb != $passlama){
        $success = FALSE;
        $step1   = FALSE;
        $pass    = FALSE;
        $notice  .= "<li>Old Password : Wrong Old Password</li>";
      }elseif($newpassword != $renewpassword){
        $success = FALSE;
        $step1   = FALSE;
        $pass    = FALSE;
        $notice  .= "<li>Password : New Password and Confirm New Password must same</li>";
      }
    }
    if(!isset($username) OR $username == ""){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Username : Must be filled</li>";
    }
    if(!isset($fullname) OR $fullname == ''){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Fullname : Must be filled</li>";
    }
    $picname = $query[0]->pic;
    if ($step1 == TRUE AND isset($_FILES['pic']['name']) AND $_FILES['pic']['name'] != '') { 
      // print_r($_FILES);
      // echo "masuk sini bro";
      // die();
      $folder       = 'user';
      $filename     = $username;
      $fieldname    = 'pic';
      $width        = 29;
      $height       = 29;
      $resizable    = TRUE;
      $create_thumb = FALSE;
      $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
      if($hasilupload['status'] == TRUE){
        $picname = $hasilupload['filename'];
      }else{
        $success = $hasilupload['success'];
        $step1   = $hasilupload['step1'];
        $notice  .= $hasilupload['notice'];
        //$picname = "";
      }
    } 
    if($step1 == TRUE AND $success == TRUE){
      $data = array();
      if($pass == TRUE AND $newpassword !=""){
        $editdata = array(            
          'username' => $username,
          'nama'     => $fullname, 
          'password' => sha1(MD5($newpassword)), 
          'pic'      => $picname,
          'modtime'  => date('Y-m-d H:i:s')
        );
      }else{
        $editdata = array(            
          'username' => $username,
          'nama'     => $fullname, 
          'pic'      => $picname,
          'modtime'  => date('Y-m-d H:i:s')
        );
      }     
      $this->db->where('id', $this->session->userdata('user_id'));
      $edit = $this->db->update('user', $editdata);
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'username' => $username,
        'fullname' => $fullname,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function tes(){
    print_r($_POST);
    die();
  }
  function ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
    $config['upload_path']   = './assets/images/'.$folder;
    $config['file_name']     = $filename;
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $config['overwrite']     = TRUE;
    //$this->load->library('upload', $config);
    $this->upload->initialize($config);
    $field_name = $fieldname;
    if ( !$this->upload->do_upload($field_name)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  = $this->upload->display_errors('<li>Picture :','</li>');
      return $arrayName = array('status' => FALSE, 'success' => $success, 'step1' => $step1, 'notice' => $notice);
    }else{
      $dataupload = $this->upload->data();
      if($resizable == TRUE){
        if($dataupload['image_width'] != $width OR $dataupload['image_height'] != $height){
          $ratio = ($dataupload['image_width'] / $dataupload['image_height']) - ($width / $height);
          $full_path = $dataupload['full_path'];
          if($ratio == 0){
            $resize = $this->resize_img($full_path,$width,$height,'auto');
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio > 0){
            $resize = $this->resize_img($full_path,$width,$height,'height');
            $size   = getimagesize($full_path);
            $y_axis = 0;
            $x_axis = ($size[0]-$width)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio < 0){
            $resize = $this->resize_img($full_path,$width,$height,'width');
            $size   = getimagesize($full_path);
            $x_axis = 0;
            $y_axis = ($size[1]-$height)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }
        }else{
          if ($create_thumb['status'] == TRUE) {
            $full_path = $dataupload['full_path'];
            $thumb = $this->awal_thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
          }
        }
      }
      return $arrayName = array('status' => TRUE, 'filename' => $dataupload['file_name'], 'thumbname' => $dataupload['raw_name'].'_small'.$dataupload['file_ext']);
    }
  }
  function ryan_img_upload2($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
    $config['upload_path']   = './assets/images/'.$folder;
    $config['file_name']     = $filename;
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $config['overwrite']     = TRUE;
    //$this->load->library('upload', $config);
    $this->upload->initialize($config);
    $field_name = $fieldname;
    if ( !$this->upload->do_upload($field_name)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  = $this->upload->display_errors('<li>Picture2 :','</li>');
      return $arrayName = array('status' => FALSE, 'success' => $success, 'step1' => $step1, 'notice' => $notice);
    }else{
      $dataupload = $this->upload->data();
      if($resizable == TRUE){
        if($dataupload['image_width'] != $width OR $dataupload['image_height'] != $height){
          $ratio = ($dataupload['image_width'] / $dataupload['image_height']) - ($width / $height);
          $full_path = $dataupload['full_path'];
          if($ratio == 0){
            $resize = $this->resize_img($full_path,$width,$height,'auto');
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio > 0){
            $resize = $this->resize_img($full_path,$width,$height,'height');
            $size   = getimagesize($full_path);
            $y_axis = 0;
            $x_axis = ($size[0]-$width)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio < 0){
            $resize = $this->resize_img($full_path,$width,$height,'width');
            $size   = getimagesize($full_path);
            $x_axis = 0;
            $y_axis = ($size[1]-$height)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }
        }else{
          if ($create_thumb['status'] == TRUE) {
            $full_path = $dataupload['full_path'];
            $thumb = $this->awal_thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
          }
        }
      }
      return $arrayName = array('status' => TRUE, 'filename' => $dataupload['file_name'], 'thumbname' => $dataupload['raw_name'].'_small'.$dataupload['file_ext']);
    }
  }
  function bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
    $config['upload_path']   = './uploads/'.$folder;
    $config['file_name']     = $filename;
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $config['overwrite']     = TRUE;
    //$this->load->library('upload', $config);
    $this->upload->initialize($config);
    $field_name = $fieldname;
    if ( !$this->upload->do_upload($field_name)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  = $this->upload->display_errors('<li>Picture :','</li>');
      return $arrayName = array('status' => FALSE, 'success' => $success, 'step1' => $step1, 'notice' => $notice);
    }else{
      $dataupload = $this->upload->data();
      if($resizable == TRUE){
        if($dataupload['image_width'] != $width OR $dataupload['image_height'] != $height){
          $ratio = ($dataupload['image_width'] / $dataupload['image_height']) - ($width / $height);
          $full_path = $dataupload['full_path'];
          if($ratio == 0){
            $resize = $this->resize_img($full_path,$width,$height,'auto');
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio > 0){
            $resize = $this->resize_img($full_path,$width,$height,'height');
            $size   = getimagesize($full_path);
            $y_axis = 0;
            $x_axis = ($size[0]-$width)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }elseif($ratio < 0){
            $resize = $this->resize_img($full_path,$width,$height,'width');
            $size   = getimagesize($full_path);
            $x_axis = 0;
            $y_axis = ($size[1]-$height)/2;
            $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
            if ($create_thumb['status'] == TRUE) {
              $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
            }
          }
        }else{
          if ($create_thumb['status'] == TRUE) {
            $full_path = $dataupload['full_path'];
            $thumb = $this->awal_thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
          }
        }
      }
      return $arrayName = array('status' => TRUE, 'filename' => $dataupload['file_name'], 'thumbname' => $dataupload['raw_name'].'_small'.$dataupload['file_ext']);
    }
  }
  function resize_img($full_path,$width,$height,$master_dim){
    $configresize['image_library']  = 'gd2';
    $configresize['source_image']   = $full_path;
    $configresize['maintain_ratio'] = TRUE;
    $configresize['width']          = $width;
    $configresize['height']         = $height;
    $configresize['master_dim']     = $master_dim;
    $this->load->library('image_lib', $configresize);
    $this->image_lib->initialize($configresize);
    $resize = $this->image_lib->resize();
    $this->image_lib->clear();
    return $resize;
  }
  function awal_thumb_img($full_path,$width,$height){
    $configthumb['image_library']  = 'gd2';
    $configthumb['source_image']   = $full_path;
    $configthumb['maintain_ratio'] = TRUE;
    $configthumb['create_thumb']   = TRUE;
    $configthumb['width']          = $width;
    $configthumb['height']         = $height;
    $configthumb['thumb_marker']   = '_small';
    $this->load->library('image_lib', $configthumb);
    //$this->image_lib->initialize($configthumb); 
    $thumb1 = $this->image_lib->resize();
    $this->image_lib->clear();
    return $thumb1;
  }
  function thumb_img($full_path,$width,$height){
    $configthumb['image_library']  = 'gd2';
    $configthumb['source_image']   = $full_path;
    $configthumb['maintain_ratio'] = TRUE;
    $configthumb['create_thumb']   = TRUE;
    $configthumb['width']          = $width;
    $configthumb['height']         = $height;
    $configthumb['thumb_marker']   = '_small';
    //$this->load->library('image_lib', $configthumb);
    $this->image_lib->initialize($configthumb); 
    $thumb1 = $this->image_lib->resize();
    $this->image_lib->clear();
    return $thumb1;
  }
  function crop_img($full_path,$width,$height,$x_axis,$y_axis){
    $configcrop['image_library']  = 'gd2';
    $configcrop['source_image']   = $full_path;
    $configcrop['maintain_ratio'] = FALSE;
    $configcrop['x_axis']         = $x_axis;
    $configcrop['y_axis']         = $y_axis;
    $configcrop['height']         = $height;
    $configcrop['width']          = $width;
    $this->image_lib->initialize($configcrop); 
    $crop = $this->image_lib->crop();
    $this->image_lib->clear();
    return $crop;
  }
  public function multiple_upload() {
    // print_r($_POST);
    // die();
    $filenameold   = strtolower($_FILES['userfile']['name']);
    $file_edit     = str_replace(" ","_",$filenameold);
    $random_digit  = rand(000,999);
    $new_file_name = $random_digit."_".$file_edit;
    $upload_path_url = base_url().'assets/images/galcom/';
    $config['upload_path']   = './assets/images/galcom';
    $config['file_name']     = $new_file_name;
    $config['allowed_types'] = 'jpeg|gif|jpg|png';
    $this->upload->initialize($config);
    //$this->load->library('upload', $config);
    $field_name = 'userfile';
    if (!$this->upload->do_upload($field_name)) {
        $error = array('error' => $this->upload->display_errors());
        //$this->load->view('upload', $error);
        //Load the list of existing files in the upload directory
        $existingFiles = get_dir_file_info($config['upload_path']);
        $foundFiles = array();
        $f=0;
        foreach ($existingFiles as $fileName => $info) {
          if($fileName!='thumbs'){//Skip over thumbs directory
            //set the data for the json array   
            $foundFiles[$f]['name'] = $fileName;
            $foundFiles[$f]['size'] = $info['size'];
            $foundFiles[$f]['url'] = $upload_path_url . $fileName;
            $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
            $foundFiles[$f]['deleteUrl'] = base_url() . 'webadmin/deleteImage/' . $fileName;
            $foundFiles[$f]['deleteType'] = 'DELETE';
            $foundFiles[$f]['error'] = null;
            $f++;
          }
        }
        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(array('files' => $foundFiles)));
    } else {
      $data = $this->upload->data();
      /*
       * Array
        (
        [file_name] => png1.jpg
        [file_type] => image/jpeg
        [file_path] => /home/ipresupu/public_html/uploads/
        [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
        [raw_name] => png1
        [orig_name] => png.jpg
        [client_name] => png.jpg
        [file_ext] => .jpg
        [file_size] => 456.93
        [is_image] => 1
        [image_width] => 1198
        [image_height] => 1166
        [image_type] => jpeg
        [image_size_str] => width="1198" height="1166"
        )
       */
      // to re-size for thumbnail images un-comment and set path here and in json array
      $configresizemul = array();
      $configresizemul['image_library'] = 'gd2';
      $configresizemul['source_image'] = $data['full_path'];
      $configresizemul['new_image'] = $data['file_path'] . 'thumbs/';
      $configresizemul['maintain_ratio'] = TRUE;
      $configresizemul['width'] = 75;
      $configresizemul['height'] = 50;
      $this->load->library('image_lib', $configresizemul);
      $tesresize = $this->image_lib->resize();
      // $this->image_lib->clear();
      // var_dump($tesresize);
      // die();
      //set the data for the json array
      $info = new StdClass;
      $info->name = $data['file_name'];
      $info->size = $data['file_size'] * 1024;
      $info->type = $data['file_type'];
      $info->url = $upload_path_url . $data['file_name'];
      // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
      $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
      $info->deleteUrl = base_url() . 'webadmin/deleteImage/' . $data['file_name'];
      $info->deleteType = 'POST';
      $info->error = null;
      $files[] = $info;
      //this is why we put this in the constants to pass only json data
      if (IS_AJAX) {
          echo json_encode(array("files" => $files));
          //this has to be the only data returned or you will get an error.
          //if you don't give this a json array it will give you a Empty file upload result error
          //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
          // so that this will still work if javascript is not enabled
      } else {
          $file_data['upload_data'] = $this->upload->data();
          //$this->load->view('upload/upload_success', $file_data);
      }
    }
  }
  public function deleteImage() {//gets the job done but you might want to add error checking and security
    $file = $this->segs[3];
    $success = unlink(FCPATH . 'assets/images/galcom/' . $file);
    $success = unlink(FCPATH . 'assets/images/galcom/thumbs/' . $file);
    //info to see if it is doing what it is supposed to
    $info = new StdClass;
    $info->sucess = $success;
    $info->path = base_url() . 'assets/images/galcom/' . $file;
    $info->file = is_file(FCPATH . 'assets/images/galcom/' . $file);
    if (IS_AJAX) {
        //I don't think it matters if this is set but good for error checking in the console/firebug
        echo json_encode(array($info));
    } else {
        //here you will need to decide what you want to show for a successful delete        
        $file_data['delete_data'] = $file;
        //$this->load->view('admin/delete_success', $file_data);
    }
  }
  public function menu(){       
    $login = $this->_isLogin();
    $permit = $this->_cekPermit(3);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){          
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_menu();
            $data['status'] = $status;
            // echo "<pre>";
            // print_r($status);
          }
          $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
          $data['controller'] = $this;
          $data['menuparent'] = $this->db->query('SELECT id,title FROM `menu` WHERE parent = 0 AND submenu = 1 ORDER BY `posisi` asc')->result_array(); 
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_menu();
              $data['status'] = $status;
              // echo "<pre>";
              // print_r($status);
            }
            $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            $data_rec = $this->db->query('SELECT id,title,parent,link,submenu,akses,icon,module FROM `menu` WHERE id = '.$this->segs[5])->result_array(); 
            $data['menuparent'] = $this->db->query('SELECT id,title FROM `menu` WHERE parent = 0 AND submenu = 1 ORDER BY `posisi` asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/menu', 'refresh');
            }
          } else {
            redirect('/webadmin/menu', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('menu',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/menu', 'refresh');
            }
          } else {
            redirect('/webadmin/menu', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('menu',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/menu', 'refresh');
            }
          } else {
            redirect('/webadmin/menu', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE menu SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/menu', 'refresh');
          }
        }else{
          redirect('/webadmin/menu', 'refresh');
        }
      }else{
        redirect('/webadmin/menu', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        $sqlwhere = 'and parent = 0 and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT id,title FROM `menu` where 1=1 '.$sqlwhere.' order by posisi asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `menu` where 1=1 '.$sqlwhere.' order by posisi asc')->result();
      if ($data['statuspage'] == 'publish') {
        $urutanchild = 0;
        foreach ($data_rec as $parent) {
          $datachild[$urutanchild] = $this->db->query('SELECT id,title FROM `menu` where parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
          $urutanchild++;
        }
        $data['child'] = $datachild;
      }    
      $data['rec']   = $data_rec;
      $data['act']   = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish'] = $this->countPublish('menu');
      $data['count_trash'] = $this->countTrash('menu');
    }
    $data['active']  = 'Settings';
    $data['page']    = 'menu';
    $data['active2'] = 'menu';
    $data['submenu'] = TRUE;
	$this->load->view('cms/main.php',$data); 
  }
  function _save_menu(){
    $title    = $this->input->post('title');
    $idparent = $this->input->post('idparent');
    $link     = $this->input->post('link');
    $submenu  = $this->input->post('submenu');
    $module  = $this->input->post('idmodule');
    $accpost  = $this->input->post('acc');
    $icon     = $this->input->post('icon');
    $acc = '';
    if (isset($accpost) and $accpost != "") {
      foreach ($accpost as $value) {
        $acc = $acc.$value.";";
      }
    }
    if($submenu == 1){
      $acc = '0;';
    }
    if($submenu == ''){
      $submenu = '0';
    }
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($idparent) AND $idparent != '' AND is_numeric($idparent)){
    }else{
      $success = false;
      $notice .= "<li>Menu Parent : Must be filled</li>";
    }
    if(!isset($submenu) or $submenu == 0){
      if(isset($link) AND $link != ''){
      }else{
        $success = false;
        $notice .= "<li>Link URL : Must be filled</li>";
      }
    }
    if(isset($icon) AND $icon != ''){
    }else{
      $success = false;
      $notice .= "<li>Icon : Must be filled</li>";
    }
    if($success == true){
      $posisi = $this->db->count_all('menu');
      $posisi = $posisi+1;
      if($idparent != '0' ){
        $submenu = 0;
      }
      if($submenu != '0'){
        $link = '';
      }
      $data = array();
      $inputdata = array(            
        'title'   => $title,
        'parent'  => $idparent, 
        'link'    => $link,
        'submenu' => $submenu,
        'akses'   => substr($acc, 0, -1),
        'posisi'  => $posisi,
        'icon'    => $icon,
        'module'    => $module,
        'cretime' => date('Y-m-d H:i:s')
      );     
      // print_r($inputdata);
      // die();
      $saved = $this->db->insert('menu', $inputdata);
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title'    => $title,
        'idparent' => $idparent,
        'link'     => $link,
        'submenu'  => $submenu,
        'acc'      => substr($acc, 0, -1),
        'icon'     => $icon
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_menu(){
    $title = $this->input->post('title');
    $idparent = $this->input->post('idparent');
    $link = $this->input->post('link');
    $submenu = $this->input->post('submenu');
    $accpost = $this->input->post('acc');
    $module  = $this->input->post('idmodule');
    $icon = $this->input->post('icon');
    $acc = '';
    if (isset($accpost) and $accpost != "") {
      foreach ($accpost as $value) {
        $acc = $acc.$value.";";
      }
    }
    if($submenu == 1){
      $acc = '0;';
    }
    if($submenu == ''){
      $submenu = '0';
    }
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($idparent) AND $idparent != '' AND is_numeric($idparent)){
    }else{
      $success = false;
      $notice .= "<li>Menu Parent : Must be filled</li>";
    }
    if(!isset($submenu) or $submenu == 0){
      if(isset($link) AND $link != ''){
      }else{
        $success = false;
        $notice .= "<li>Link URL : Must be filled</li>";
      }
    }
    if(isset($icon) AND $icon != ''){
    }else{
      $success = false;
      $notice .= "<li>Icon : Must be filled</li>";
    }
    if($success == true){
      $posisi = $this->db->count_all('menu');
      $posisi = $posisi+1;
      if($idparent != '0' ){
        $submenu = 0;
      }
      if($submenu != '0'){
        $link = '';
      }
      $data = array();
      $editdata = array(            
        'title'   => $title,
        'parent'  => $idparent, 
        'link'    => $link,
        'submenu' => $submenu,
        'akses'   => substr($acc, 0, -1),
        'icon'    => $icon,
        'module'    => $module,
        'modtime' => date('Y-m-d H:i:s')
      );     
      // print_r($inputdata);
      // die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('menu', $editdata); 
      //$saved = $this->db->insert('menu', $inputdata);
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title'    => $title,
        'idparent' => $idparent,
        'link'     => $link,
        'submenu'  => $submenu,
        'acc'      => substr($acc, 0, -1),
        'icon'     => $icon
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function divisi(){       
    $login = $this->_isLogin();
    $permit = $this->_cekPermit(2);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_divisi();
            $data['status'] = $status;
          }
          $data_rec = $this->db->query('SELECT id,title,posisi,akses FROM `menu` where parent = 0 and hapus = 0 and draft = 0 order by posisi asc')->result_array();
          $urutanchild = 0;
          foreach ($data_rec as $parent) {
            $datachild[$urutanchild] = $this->db->query('SELECT id,title,posisi,akses FROM `menu` where parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
            $urutanchild++;
          }
          $data['rec'] = $data_rec;
          $data['child'] = $datachild;
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_divisi();
              $data['status'] = $status;
            }
            $data_divisi = $this->db->query('SELECT id,title,idmenu FROM `divisi` where id = '.$this->segs[5].' order by cretime asc')->result_array();
            $listmenu = str_replace(';',',',$data_divisi[0]['idmenu']);
            $data_akses = $this->db->query('SELECT id,iddivisi,idmenu,isadd,isupdate,isdelete,ishide FROM `detail_divisi` where idmenu IN ('.$listmenu.') and iddivisi = '.$this->segs[5].' ORDER BY `cretime` asc')->result_array();
            $addid = '';
            $updateid = '';
            $deleteid = '';
            $hideid = '';
            foreach ($data_akses as $row) {
              if($row['isadd'] == 1){
                $addid = $addid.$row['idmenu'].";";
              }
              if($row['isupdate'] == 1){
                $updateid = $updateid.$row['idmenu'].";";
              }
              if($row['isdelete'] == 1){
                $deleteid = $deleteid.$row['idmenu'].";";
              }
              if($row['ishide'] == 1){
                $hideid = $hideid.$row['idmenu'].";";
              }
            }
            $data['addid']    = substr($addid, 0, -1);
            $data['updateid'] = substr($updateid, 0, -1);
            $data['deleteid'] = substr($deleteid, 0, -1);
            $data['hideid'] = substr($hideid, 0, -1);
            if ($data_divisi) {
              $data['data_divisi'] = $data_divisi[0];
            } else {
              redirect('/webadmin/divisi', 'refresh');
            }
            $data_rec = $this->db->query('SELECT id,title,posisi,akses FROM `menu` where parent = 0 and hapus = 0 and draft = 0 order by posisi asc')->result_array();
            $urutanchild = 0;
            foreach ($data_rec as $parent) {
              $datachild[$urutanchild] = $this->db->query('SELECT id,title,posisi,akses FROM `menu` where parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
              $urutanchild++;
            }
            //echo "<pre>";
            //print_r($data_rec);
            $data['rec'] = $data_rec;
            $data['child'] = $datachild;
          } else {
            redirect('/webadmin/divisi', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('divisi',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/divisi', 'refresh');
            }
          } else {
            redirect('/webadmin/divisi', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('divisi',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/divisi', 'refresh');
            }
          } else {
            redirect('/webadmin/divisi', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE divisi SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/divisi', 'refresh');
          }
        }else{
          redirect('/webadmin/divisi', 'refresh');
        }
      }else{
        redirect('/webadmin/divisi', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        $sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT id,title FROM `divisi` where 1=1 '.$sqlwhere.' order by cretime asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `divisi` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']   = $data_rec;
      $data['tipe'] = '';
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('divisi');
      $data['count_trash'] = $this->countTrash('divisi');
    }
    $data['active'] = 'Settings';
    $data['page'] = 'divisi';
    $data['tipe'] = '';
    $data['active2'] = 'divisi';
    $data['submenu'] = TRUE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_divisi(){
    $title = $this->input->post('title');
    $accview = $this->input->post('accview');
    $accadd = $this->input->post('accadd');
    $accupdate = $this->input->post('accupdate');
    $accdelete = $this->input->post('accdelete');
    $acchide = $this->input->post('acchide');
    $viewid = "";
    foreach ($accview as $key => $value) {
      $viewid = $viewid.$key.";";
    }
    $viewid = substr($viewid, 0, -1);
    $addid = "";
    if (isset($accadd) AND $accadd != '') {
      foreach ($accadd as $key => $value) {
        $addid = $addid.$key.";";
      }
      $addid = substr($addid, 0, -1);
    }
    $updateid = "";
    if (isset($accupdate) AND $accupdate != '') {
      foreach ($accupdate as $key => $value) {
        $updateid = $updateid.$key.";";
      }
      $updateid = substr($updateid, 0, -1);
    }
    $deleteid = "";
    if (isset($accdelete) AND $accdelete != '') {
      foreach ($accdelete as $key => $value) {
        $deleteid = $deleteid.$key.";";
      }
      $deleteid = substr($deleteid, 0, -1);
    }
    $hideid = "";
    if (isset($acchide) AND $acchide != '') {
      foreach ($acchide as $key => $value) {
        $hideid = $hideid.$key.";";
      }
      $hideid = substr($hideid, 0, -1);
    }
    $notice = "";
    $success = true;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($accview) AND $accview != ''){
    }else{
      $success = false;
      $notice .= "<li>Access : Must choose 1 access page</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'title'   => $title,
        'idmenu'   => $viewid,
        'cretime' => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('divisi', $inputdata);
      $iddivisi = $this->db->insert_id();
      $menu = $this->db->query('SELECT id FROM `menu` order by cretime asc')->result_array();
      foreach ($menu as $idmenu) {
        $key = $idmenu['id'];
        if (isset($accview[$key]) AND $accview[$key] != "") {
          $isview = 1;
        }else{
          $isview = 0;
        }
        if (isset($accadd[$key]) AND $accadd[$key] != "") {
          $isadd = 1;
        }else{
          $isadd = 0;
        }
        if (isset($accupdate[$key]) AND $accupdate[$key] != "") {
          $isupdate = 1;
        }else{
          $isupdate = 0;
        }
        if (isset($accdelete[$key]) AND $accdelete[$key] != "") {
          $isdelete = 1;
        }else{
          $isdelete = 0;
        }
        if (isset($acchide[$key]) AND $acchide[$key] != "") {
          $ishide = 1;
        }else{
          $ishide = 0;
        }
        $inputdata2 = array(            
          'iddivisi' => $iddivisi,
          'idmenu'   => $key,
          'isview'    => $isview,
          'isadd'    => $isadd,
          'isupdate' => $isupdate,
          'isdelete' => $isdelete,
          'ishide' => $ishide,
          'cretime'  => date('Y-m-d H:i:s')
        );     
        $saved = $this->db->insert('detail_divisi', $inputdata2);
      }
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title'  => $title,
        'view'   => $viewid,
        'add'    => $addid,
        'update' => $updateid,
        'delete' => $deleteid,
        'hide' => $hideid
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_divisi(){
    $title = $this->input->post('title');
    $accview = $this->input->post('accview');
    $accadd = $this->input->post('accadd');
    $accupdate = $this->input->post('accupdate');
    $accdelete = $this->input->post('accdelete');
    $acchide = $this->input->post('acchide');
    $viewid = "";
    if (isset($accview) AND $accview != '') {
      foreach ($accview as $key => $value) {
        $viewid = $viewid.$key.";";
      }
      $viewid = substr($viewid, 0, -1);
    }
    $addid = "";
    if (isset($accadd) AND $accadd != '') {
      foreach ($accadd as $key => $value) {
        $addid = $addid.$key.";";
      }
      $addid = substr($addid, 0, -1);
    }
    $updateid = "";
    if (isset($accupdate) AND $accupdate != '') {
      foreach ($accupdate as $key => $value) {
        $updateid = $updateid.$key.";";
      }
      $updateid = substr($updateid, 0, -1);
    }
    $deleteid = "";
    if (isset($accdelete) AND $accdelete != '') {
      foreach ($accdelete as $key => $value) {
        $deleteid = $deleteid.$key.";";
      }
      $deleteid = substr($deleteid, 0, -1);
    }
    $hideid = "";
    if (isset($acchide) AND $acchide != '') {
      foreach ($acchide as $key => $value) {
        $hideid = $hideid.$key.";";
      }
      $hideid = substr($hideid, 0, -1);
    }
    $notice = "";
    $success = true;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($accview) AND $accview != ''){
    }else{
      $success = false;
      $notice .= "<li>Access : Must choose 1 access page</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'title'   => $title,
        'idmenu'   => $viewid,
        'modtime' => date('Y-m-d H:i:s')
      );     
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('divisi', $inputdata); 
      $menu = $this->db->query('SELECT id FROM `menu` order by cretime asc')->result_array();
      foreach ($menu as $idmenu) {
        $key = $idmenu['id'];
        if (isset($accview[$key]) AND $accview[$key] != "") {
          $isview = 1;
        }else{
          $isview = 0;
        }
        if (isset($accadd[$key]) AND $accadd[$key] != "") {
          $isadd = 1;
        }else{
          $isadd = 0;
        }
        if (isset($accupdate[$key]) AND $accupdate[$key] != "") {
          $isupdate = 1;
        }else{
          $isupdate = 0;
        }
        if (isset($accdelete[$key]) AND $accdelete[$key] != "") {
          $isdelete = 1;
        }else{
          $isdelete = 0;
        }
        if (isset($acchide[$key]) AND $acchide[$key] != "") {
          $ishide = 1;
        }else{
          $ishide = 0;
        }
        $cekAksesmenu = $this->db->query('SELECT id FROM `detail_divisi` where idmenu = '.$key.' and iddivisi = '.$this->segs[5])->result();
        if (!$cekAksesmenu) {
          $inputdata2 = array(            
            'iddivisi' => $this->segs[5],
            'idmenu'   => $key,
            'isadd'    => $isadd,
            'isview'   => $isview,
            'isupdate' => $isupdate,
            'isdelete' => $isdelete,
            'ishide' => $ishide,
            'cretime'  => date('Y-m-d H:i:s')
          );     
          $edit = $this->db->insert('detail_divisi', $inputdata2);
        }else{
          $idakses = $cekAksesmenu[0]->id;
          $inputdata2 = array( 
            'isview'   => $isview,
            'isadd'    => $isadd,
            'isupdate' => $isupdate,
            'isdelete' => $isdelete,
            'ishide' => $ishide,
            'modtime'  => date('Y-m-d H:i:s')
          );     
          $this->db->where('id', $idakses);
          $edit = $this->db->update('detail_divisi', $inputdata2); 
        }
      }
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title'  => $title,
        'view'   => $viewid,
        'add'    => $addid,
        'update' => $updateid,
        'delete' => $deleteid,
        'hide' => $hideid
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function user(){ 
    $login = $this->_isLogin();
    $permit = $this->_cekPermit(1);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_user();
            $data['status'] = $status;
          }
          $data_rec = $this->db->query('SELECT id,title FROM `divisi` where hapus = 0 and draft = 0 order by cretime asc')->result_array();
          $data['rec'] = $data_rec;  
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_user();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,title FROM `divisi` where hapus = 0 and draft = 0 order by cretime asc')->result_array();
            $data['rec'] = $data_rec;
            $data_user = $this->db->query('SELECT id,iddivisi,username,nama,pic FROM `user` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_user) {
              $data['user'] = $data_user[0];
            } else {
              redirect('/webadmin/user', 'refresh');
            }
          } else {
            redirect('/webadmin/user', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('user',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/user', 'refresh');
            }
          } else {
            redirect('/webadmin/user', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('user',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/user', 'refresh');
            }
          } else {
            redirect('/webadmin/user', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE user SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/user', 'refresh');
          }
        }else{
          redirect('/webadmin/user', 'refresh');
        }
      }else{
        redirect('/webadmin/user', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and user.hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        $sqlwhere = 'and user.hapus = 0 and user.draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT user.id, user.nama, divisi.title as divisi FROM user INNER JOIN divisi ON user.iddivisi=divisi.id where 1=1 '.$sqlwhere.' order by user.cretime asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `user` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']   = $data_rec;
      $data['tipe'] = '';
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('user');
      $data['count_trash'] = $this->countTrash('user');
    }
    $data['active'] = 'Settings';
    $data['active2'] = 'user';
    $data['page'] = 'user';
    $data['tipe'] = '';
    $data['submenu'] = TRUE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_user(){
    $username   = $this->input->post('username');
    $password   = $this->input->post('password');
    $repassword = $this->input->post('repassword');
    $fullname   = $this->input->post('fullname');
    $iddivisi   = $this->input->post('iddivisi');
    $pic        = $this->input->post('pic');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    $cek_username = $this->db->query('SELECT count(*) as jumlah FROM `user` where username= "'.$username.'"')->result(); 
    if(!isset($username) OR $username == ""){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Username : Must be filled</li>";
    }elseif ($cek_username[0]->jumlah == 1) {
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Username : Someone already has that username</li>";
    }
    if(!isset($password) OR $password == ''){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Password : Must be filled</li>";
    }elseif(!isset($repassword) OR $repassword == ''){
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Re-Password : Must be filled</li>";
    }elseif($password != $repassword){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Password : Password and Re-Password must same</li>";
    }
    if(!isset($fullname) OR $fullname == ''){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Fullname : Must be filled</li>";
    }
    if(!isset($iddivisi) OR $iddivisi == '' OR !is_numeric($iddivisi)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Divisi : Must be filled</li>";
    }
    $picname = "";
    if ($step1 == TRUE AND isset($_FILES['pic']['name']) AND $_FILES['pic']['name'] != '') {
      $folder       = 'user';
      $filename     = $username;
      $fieldname    = 'pic';
      $width        = 29;
      $height       = 29;
      $create_thumb = FALSE;
      $resizable    = TRUE;
      $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
      if($hasilupload['status'] == TRUE){
        $picname = $hasilupload['filename'];
      }else{
        $success = $hasilupload['success'];
        $step1   = $hasilupload['step1'];
        $notice  .= $hasilupload['notice'];
        $picname = "";
      }
    } 
    if($step1 == TRUE AND $success == TRUE){
      $data = array();
      $inputdata = array(            
        'username' => $username,
        'nama'     => $fullname, 
        'iddivisi' => $iddivisi,
        'password' => sha1(MD5($password)),
        'pic'      => $picname,
        'cretime'  => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('user', $inputdata);
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'username' => $username,
        'fullname' => $fullname,
        'iddivisi' => $iddivisi,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_user(){
    $usernameold = $this->input->post('usernameold');
    $username    = $this->input->post('username');
    $password    = $this->input->post('password');
    $repassword  = $this->input->post('repassword');
    $fullname    = $this->input->post('fullname');
    $iddivisi    = $this->input->post('iddivisi');
    $picold      = $this->input->post('picold');
    $pic         = $this->input->post('pic');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    if($usernameold != $username){
      $cek_username = $this->db->query('SELECT count(*) as jumlah FROM `user` where username= "'.$username.'"')->result(); 
      if ($cek_username[0]->jumlah == 1) {
        $success = FALSE;
        $step1   = FALSE;
        $notice  .= "<li>Username : Someone already has that username</li>";
      }
    }
    if(!isset($username) OR $username == ""){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Username : Must be filled</li>";
    }
    if(!isset($fullname) OR $fullname == ''){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Fullname : Must be filled</li>";
    }
    if(!isset($iddivisi) OR $iddivisi == '' OR !is_numeric($iddivisi)){
      $success = FALSE;
      $step1   = FALSE;
      $notice  .= "<li>Divisi : Must be filled</li>";
    }
    $picname = $picold;
    if ($step1 == TRUE AND isset($_FILES['pic']['name']) AND $_FILES['pic']['name'] != '') { 
      $folder       = 'user';
      $filename     = $username;
      $fieldname    = 'pic';
      $width        = 29;
      $height       = 29;
      $create_thumb = FALSE;
      $resizable    = TRUE;
      $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
      if($hasilupload['status'] == TRUE){
        $picname = $hasilupload['filename'];
      }else{
        $success = $hasilupload['success'];
        $step1   = $hasilupload['step1'];
        $notice  .= $hasilupload['notice'];
        $picname = $picold;
      }
    } 
    if($step1 == TRUE AND $success == TRUE){
      $data = array();
      $editdata = array(            
        'username' => $username,
        'nama'     => $fullname, 
        'iddivisi' => $iddivisi,
        'pic'      => $picname,
        'modtime'  => date('Y-m-d H:i:s')
      );     
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('user', $editdata);
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'username' => $username,
        'fullname' => $fullname,
        'iddivisi' => $iddivisi,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function instagram(){       
    $login = $this->_isLogin();
    $idmenudb = 14;
    $permit = $this->_cekPermit($idmenudb);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'tampil'){
          $this->_ispermit($permit->isupdate);
          $hide = $this->db->query('UPDATE user SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/instagram', 'refresh');
          }
        }else{
          redirect('/webadmin/instagram', 'refresh');
        }
      }else{
        redirect('/webadmin/instagram', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $data_rec = $this->db->query('SELECT id,id_post,username,fullname,caption,thumbnail,small_picture,picture,video,type,status,created_time FROM instagram order by created_time DESC')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `instagram` order by created_time asc')->result();        
      $data['rec']   = $data_rec;
      $data['active'] = 'instagram';
      $data['active2'] = '';
      $data['tipe'] = '';
      $data['act'] = 'default';
    }
    $data['active'] = 'instagram';
    $data['page'] = 'Instagram';
    $data['tipe'] = '';
    $data['active2'] = '';
    $data['submenu'] = FALSE;
    $this->load->view('cms/main.php',$data); 
  }
  public function language(){       
    $login = $this->_isLogin();
    $idpermit = 17;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_language();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_language();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,title,lang_code,pic FROM `language` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/language', 'refresh');
            }
          } else {
            redirect('/webadmin/language', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('language',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/language', 'refresh');
            }
          } else {
            redirect('/webadmin/language', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('language',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/language', 'refresh');
            }
          } else {
            redirect('/webadmin/language', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE language SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/language', 'refresh');
          }
        }else{
          redirect('/webadmin/language', 'refresh');
        }
      }else{
        redirect('/webadmin/language', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        $sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT id,title,lang_code,use_default FROM `language` where 1=1 '.$sqlwhere.' order by use_default asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `language` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('language');
      $data['count_trash'] = $this->countTrash('language');
    }
    $data['active'] = 'Settings';
    $data['active2'] = 'language';
    $data['page'] = 'language';
    $data['tipe'] = '';
    $data['submenu'] = TRUE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_language(){
    $title    = $this->input->post('title');
    $lang     = $this->input->post('lang');
    $notice = "";
    $step1 = true;
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $step1 = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($lang) AND $lang != ''){
    }else{
      $success = false;
      $step1 = false;
      $notice .= "<li>Language Code : Must be filled</li>";
    }
    $picname = '';
    if ($step1 == TRUE AND isset($_FILES['pic']['name']) AND $_FILES['pic']['name'] != '') {
      $folder       = 'language';
      $filename     = $title;
      $fieldname    = 'pic';
      $width        = 40;
      $height       = 20;
      $create_thumb = FALSE;
      $resizable    = TRUE;
      $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
      if($hasilupload['status'] == TRUE){
        $picname = $hasilupload['filename'];
      }else{
        $success = $hasilupload['success'];
        $step1   = $hasilupload['step1'];
        $notice  .= $hasilupload['notice'];
        $picname = "";
      }
    } 
    if($step1 == TRUE AND $success == TRUE){
      $data = array();
      $inputdata = array(            
        'title'     => $title,
        'lang_code' => $lang, 
        'pic'       => $picname, 
        'cretime'   => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('language', $inputdata);
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title' => $title,
        'lang'  => $lang
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_language(){
    $title  = $this->input->post('title');
    $lang   = $this->input->post('lang');
    $picold = $this->input->post('picold');
    $notice = "";
    $step1 = true;
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $step1 = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($lang) AND $lang != ''){
    }else{
      $success = false;
      $step1 = false;
      $notice .= "<li>Language Code : Must be filled</li>";
    }
    $picname = $picold;
    if ($step1 == TRUE AND isset($_FILES['pic']['name']) AND $_FILES['pic']['name'] != '') { 
      $folder       = 'language';
      $filename     = $title;
      $fieldname    = 'pic';
      $width        = 40;
      $height       = 20;
      $create_thumb = FALSE;
      $resizable    = TRUE;
      $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
      if($hasilupload['status'] == TRUE){
        $picname = $hasilupload['filename'];
      }else{
        $success = $hasilupload['success'];
        $step1   = $hasilupload['step1'];
        $notice  .= $hasilupload['notice'];
        $picname = $picold;
      }
    } 
    if($step1 == TRUE AND $success == TRUE){
      $editdata = array(            
        'title'     => $title,
        'lang_code' => $lang, 
        'pic'       => $picname,
        'modtime'   => date('Y-m-d H:i:s')
      );     
      // print_r($inputdata);
      // die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('language', $editdata); 
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title' => $title,
        'lang'  => $lang
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function module(){       
    $login = $this->_isLogin();
    $idpermit = 18;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_module();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_module();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,title,controller,type FROM `module` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/module', 'refresh');
            }
          } else {
            redirect('/webadmin/module', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('module',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/module', 'refresh');
            }
          } else {
            redirect('/webadmin/module', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('module',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/module', 'refresh');
            }
          } else {
            redirect('/webadmin/module', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE module SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/module', 'refresh');
          }
        }else{
          redirect('/webadmin/module', 'refresh');
        }
      }else{
        redirect('/webadmin/module', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        $sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT id,title,controller,type FROM `module` where 1=1 '.$sqlwhere.' order by cretime asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `module` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('module');
      $data['count_trash'] = $this->countTrash('module');
    }
    $data['active'] = 'Settings';
    $data['active2'] = 'module';
    $data['page'] = 'module';
    $data['tipe'] = '';
    $data['submenu'] = TRUE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_module(){
    $title      = $this->input->post('title');
    $controller = $this->input->post('controller');
    $type       = $this->input->post('type');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($controller) AND $controller != ''){
    }else{
      $success = false;
      $notice .= "<li>Controller File : Must be filled</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'title'      => $title,
        'controller' => $controller, 
        'type'       => $type, 
        'cretime'    => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('module', $inputdata);
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title'      => $title,
        'controller' => $controller
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_module(){
    $title      = $this->input->post('title');
    $controller = $this->input->post('controller');
    $type       = $this->input->post('type');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($title) AND $title != ''){
    }else{
      $success = false;
      $notice .= "<li>Title : Must be filled</li>";
    }
    if(isset($controller) AND $controller != ''){
    }else{
      $success = false;
      $notice .= "<li>Controller File : Must be filled</li>";
    }
    if($success == true){
      $editdata = array(            
        'title'      => $title,
        'controller' => $controller, 
        'type'       => $type, 
        'modtime'    => date('Y-m-d H:i:s')
      );     
      // print_r($inputdata);
      // die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('module', $editdata); 
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'title'      => $title,
        'controller' => $controller
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function _getSubPagesMenu($sister,$separator){
    $submenu = $this->db->query('SELECT a.* FROM `pages` a LEFT JOIN language b ON a.idlanguage=b.id WHERE a.parent = '.$sister.' AND b.use_default=1 ORDER BY a.`posisi` asc')->result_array();
    $htmlstring = "";
    foreach ($submenu as $dt){
        $htmlstring .= "<option value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
    }
    return $htmlstring;
  }
  public function _getSubPages($sister,$separator){
    $deflang = $this->_cekDefLang();
    $submenu = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
    //echo "test";
    $htmlstring = "";
    foreach ($submenu as $dt){
        $htmlstring .= "<option value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
        //$htmlstring .= $this->_getSubPages($dt["sister"],$separator);
    }
    return $htmlstring;
  }
  public function _getSubPagesEdit($sister,$separator,$parent){
    $deflang = $this->_cekDefLang();
    $submenu = $this->db->query('SELECT id,title,sister,parent FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
    //echo "test";
    $htmlstring = "";
    foreach ($submenu as $dt){
        if ($parent == $dt["id"]){
            $htmlstring .= "<option selected=\"selected\" value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
        }else{
            $htmlstring .= "<option value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
        }
        //$htmlstring .= $this->_getSubPages($dt["sister"],$separator);
    }
    return $htmlstring;
  }
  public function getPagesChild($sister){
    $deflang = $this->_cekDefLang();
    $login = $this->_isLogin();
    $idpermit = 21;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $submenu = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
    $data["rec"] = $submenu;
    $this->load->view('cms/subPages.php',$data); 
  }
  public function pages($id, $parent, $title ,$type,$link){
    $url_module = $this->segs[2];
    $login = $this->_isLogin();
    $idpermit = $id;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $deflang = $this->_cekDefLang();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){          
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_pages($type,$id);
            $data['status'] = $status;
            // echo "<pre>";
            // print_r($status);
          }
          $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
          $data['menuparent'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE type='.$type.' AND idlanguage = '.$deflang.' AND parent = 0 AND  hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_pages($type);
              $data['status'] = $status;
              // echo "<pre>";
              // print_r($status);
            }
            $data_rec = $this->db->query('SELECT id,hide_in_menu,title,idmodule,idlanguage,parent,link,submenu,subtitle,content,pic,meta_title,meta_description FROM `pages` WHERE sister = '.$this->segs[5])->result_array(); 
            $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            $data['menuparent'] = $this->db->query('SELECT id,title,sister,parent FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = 0 AND  hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
            //echo "<pre>";
            //print_r($data['menuparent']);
            if ($data_rec) {
              $data['rec'] = $data_rec;
            } else {
              redirect('/webadmin/pages', 'refresh');
            }
          } else {
            redirect('/webadmin/pages', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteDataNew('pages',$this->segs[5]);
            if ($deleted){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/pages', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreDataNew('pages',$this->segs[5]);
            if ($restore){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/pages', 'refresh');
          }
        }elseif ($this->segs[4] == 'movetrash'){
          $this->_ispermit($permit->isdelete);
          $trash = $this->trashDataNew('pages',$this->segs[5]);
          if ($trash){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movedraft'){
          $this->_ispermit($permit->isupdate);
          $draft = $this->draftDataNew('pages',$this->segs[5]);
          if ($draft){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movepublish'){
          $this->_ispermit($permit->isupdate);
          $publish = $this->publishDataNew('pages',$this->segs[5]);
          if ($publish){
            redirect($this->agent->referrer(), 'refresh');
          }
        }else{
          redirect('/webadmin/pages', 'refresh');
        }
      }else{
        redirect('/webadmin/pages', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'pages.parent = 0 and pages.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'pages.hapus = 0 and pages.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = 'pages.parent = 0 and pages.hapus = 0 and pages.draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT pages.hide_in_menu,pages.type,pages.id,pages.title,pages.sister,module.title as module FROM `pages`  INNER JOIN module ON pages.idmodule = module.id where pages.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND pages.type='.$type.' order by pages.posisi asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `pages` where idlanguage = '.$deflang.' AND '.$sqlwhere.' order by posisi asc')->result();
      if ($data['statuspage'] == 'publish') {
        if(count($data_rec) != 0){
          $urutanchild = 0;
          foreach ($data_rec as $parent) {
            $datachild[$urutanchild] = $this->db->query('SELECT id,title,sister FROM `pages` where idlanguage = '.$deflang.' AND parent = '.$parent["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
            $urutanchild++;
          }
          $data['child'] = $datachild;
        }
      }    
      $data['rec']   = $data_rec;
      $data['deflang'] = $deflang;
      $data['act']   = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish'] = $this->countPublishNewPage('pages',$deflang,$type);
      $data['count_draft'] = $this->countDraftNewPage('pages',$deflang,$type);
      $data['count_trash'] = $this->countTrashNewPage('pages',$deflang,$type);
    }
    $data["controller"] = $this;
    $data['active']  = $id;
    $data['url_module'] = $url_module;
    $data['page']    = 'pages';
    $data['current_menu']    = $link;
    $data['active2'] = $id;
    $data['submenu'] = FALSE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_pages($type,$idmenu){
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $idmodule = $this->input->post('idmodule');
    $idparent = $this->input->post('idparent');
    $idlang   = $this->input->post('idlang');
    $title    = $this->input->post('title');
    $subtitle = $this->input->post('subtitle');
    $content  = $this->input->post('content');
    $link     = $this->input->post('link');
    $draft    = $this->input->post('draft');
    $metatitle    = $this->input->post('metatitle');
    $metadescription    = $this->input->post('metadescription');
    $hide_in_menu = $this->input->post('hide_in_menu');
    $publish  = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    if($idmodule == 6){
      $submenu = 1;
    }else{
      $submenu = 0;
    }
    $sister = $this->_nextAI('pages');
    $posisi = $this->_nextPosisiPages("pages",$idmenu,$idparent);
    $notice = "";
    $step1   = TRUE;
    $success = TRUE;
    //echo $title;
    if(isset($idmodule) AND $idmodule != ''){
    }else{
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Module : Must be filled</li>";
    }
    if(isset($idparent) AND $idparent != ''){
    }else{
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Parent Menu : Must be filled</li>";
    }
    foreach ($idlang as $lang) {
      $picname   = "";
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'pages_'.$random_digit."_".$file_edit;
        $folder       = 'pages';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 1400;
        $height       = 348;
        $create_thumb = FALSE;
        $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $data = array();
        $inputdata = array(            
          'idmodule'   => $idmodule, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'subtitle'   => $subtitle[$lang],  
          'content'    => $content[$lang],    
          'pic'        => $picname,  
          'parent'     => $idparent,
          'posisi'     => $posisi,
          'sister'     => $sister,
          'hide_in_menu' => $hide_in_menu,
          'submenu'    => $submenu, 
          'type'    => $type,
          'meta_title'        => $metatitle[$lang],
          'meta_description'        => $metadescription[$lang],
          'cretime'    => date('Y-m-d H:i:s'),
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('pages', $inputdata);
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idmodule' => $idmodule,
        'idparent' => $idparent,
        'idlang'   => $idlang,
        'title'    => $title,
        'content'  => $content,
        'link'     => $link
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_pages(){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $id       = $this->input->post('id');
    $idmodule = $this->input->post('idmodule');
    $idparent = $this->input->post('idparent');
    $idlang   = $this->input->post('idlang');
    $title    = $this->input->post('title');
    $subtitle = $this->input->post('subtitle');
    $content  = $this->input->post('content');
    $link     = $this->input->post('link');
    $draft    = $this->input->post('draft');
    $publish  = $this->input->post('publish');
    $metatitle    = $this->input->post('metatitle');
    $metadescription    = $this->input->post('metadescription');
    $hide_in_menu = $this->input->post('hide_in_menu');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    if($idmodule == 6){
      $submenu = 1;
    }else{
      $submenu = 0;
    }
    //$sister = $this->_nextAI('pages');
    $notice = "";
    $step1   = TRUE;
    $success = TRUE;
    if(isset($idmodule) AND $idmodule != ''){
    }else{
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Module : Must be filled</li>";
    }
    if(isset($idparent) AND $idparent != ''){
    }else{
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Parent Menu : Must be filled</li>";
    }
    foreach ($idlang as $lang) {
      $picname   = $this->input->post('oldpic'.$lang);
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'pages_'.$random_digit."_".$file_edit;
        $folder       = 'pages';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 1400;
        $height       = 348;
        $create_thumb = FALSE; 
        $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(            
          'idmodule'   => $idmodule, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'subtitle'   => $subtitle[$lang],  
          'content'    => $content[$lang],    
          'pic'        => $picname,  
          'parent'     => $idparent,
          'submenu'    => $submenu, 
          'hide_in_menu' => $hide_in_menu,
          'meta_title'        => $metatitle[$lang],
          'meta_description'        => $metadescription[$lang],
          'modtime'    => date('Y-m-d H:i:s'),
          'modby'      => $this->session->userdata('username')
        );     
        $this->db->where('id', $id[$lang]);
        $edit = $this->db->update('pages', $editdata); 
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
        'subtitle' => $subtitle,
        'content'  => $content,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_pages2(){
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $id       = $this->input->post('id');
    $idmodule = $this->input->post('idmodule');
    $idparent = $this->input->post('idparent');
    $idlang   = $this->input->post('idlang');
    $title    = $this->input->post('title');
    $link     = $this->input->post('link');
    $submenu  = $this->input->post('submenu');
    $notice = "";
    $success = true;
    if(isset($idmodule) AND $idmodule != ''){
    }else{
      $success = false;
      $notice .= "<li>Module : Must be filled</li>";
    }
    if(isset($idparent) AND $idparent != ''){
    }else{
      $success = false;
      $notice .= "<li>Parent Menu : Must be filled</li>";
    }
    if($success == true){
      foreach ($idlang as $lang) {
        if($submenu[$lang] == ''){
          $submenubaru = '0';
        }
        $editdata = array(            
          'idmodule'   => $idmodule, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'parent'     => $idparent,
          'submenu'    => $submenubaru, 
          'cretime'    => date('Y-m-d H:i:s')
        );     
        $this->db->where('id', $id[$lang]);
        $edit = $this->db->update('pages', $editdata); 
      }
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idmodule' => $idmodule,
        'idparent' => $idparent,
        'title'    => $title,
        'link'     => $link,
        'submenu'  => $submenu
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function banner($id,$parent,$title,$link){
    $login = $this->_isLogin();
    $idmenudb = $id;
    $permit = $this->_cekPermit($idmenudb);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $data['url_module'] = $this->segs[2];
    $deflang = $this->_cekDefLang();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_banner($id,$parent);
            $data['status'] = $status;
          }
          $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 45 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_banner($id,$parent);
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,sisterpages,title,link,pic,pic2,thumb,description FROM `banner` WHERE sister = '.$this->segs[5])->result_array(); 
            //print_r($data_rec);
            $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 45 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec;
            } else {
              redirect('/webadmin/banner', 'refresh');
            }
          } else {
            redirect('/webadmin/banner', 'refresh');
          }
        }elseif ($this->segs[4] == 'view'){
          $this->_ispermit($permit->isview);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_row) {
              $data['row'] = $data_row[0];
            } else {
              redirect('/webadmin/banner', 'refresh');
            }
          } else {
            redirect('/webadmin/banner', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('banner',$this->segs[5]);
            if ($deleted){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/banner', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('banner',$this->segs[5]);
            if ($restore){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/banner', 'refresh');
          }
        }elseif ($this->segs[4] == 'movetrash'){
          $this->_ispermit($permit->isdelete);
          $trash = $this->trashData('banner',$this->segs[5]);
          if ($trash){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movedraft'){
          $this->_ispermit($permit->isupdate);
          $draft = $this->draftData('banner',$this->segs[5]);
          if ($draft){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movepublish'){
          $this->_ispermit($permit->isupdate);
          $publish = $this->publishData('banner',$this->segs[5]);
          if ($publish){
            redirect($this->agent->referrer(), 'refresh');
          }
        }else{
          redirect('/webadmin/banner', 'refresh');
        }
      }else{
        redirect('/webadmin/banner', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $datenow = date('Y-m-d H:i:s');
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and banner.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'and banner.hapus = 0 and banner.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = "and banner.hapus = 0 and banner.draft = 0 ";
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT banner.id,banner.title,banner.sister,banner.thumb,banner.pic, pages.title as pages FROM `banner` INNER JOIN pages ON banner.sisterpages=pages.sister where banner.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.' AND banner.idmenu='.$id.' '.$sqlwhere.' order by banner.posisi asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `banner` where 1=1  AND banner.idmenu='.$id.' '.$sqlwhere.' order by posisi asc')->result();        
      $data['rec']        = $data_rec;
      $data['act']        = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish']    = $this->countPublishNew('banner',$deflang,$id);
      $data['count_draft']      = $this->countDraftNew('banner',$deflang,$id);
      $data['count_trash']      = $this->countTrashNew('banner',$deflang,$id);
    }
      $data['submenu'] = TRUE;
      $data['active']  = $parent;
      $data['active2'] = $id;
      $data['current_menu'] = $link;
      $data['page']    = 'banner';
      $data['webadmin']    = $this->admin;
      $data['url_module']    = $this->segs[2];
    $this->load->view('cms/main.php',$data); 
  }
  function _save_banner($id,$parent){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $idpages = $this->input->post('idpages');
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $link    = $this->input->post('link');
    $pic     = $this->input->post('pic');
    $description     = $this->input->post('description');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('banner');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $step1   = FALSE;
      $success = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    $picname   = "";
    $picname2  = "";
    $thumbname = "";
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id,sister FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = "";
      $thumbname = "";
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'banner_'.$random_digit."_".$file_edit;
        $folder       = 'banner';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 1400;
        $height       = 640;
        $create_thumb = array(            
          'status' => TRUE,
          'width'  => 800, 
          'height' => 480
        ); 
        $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $data = array();
        $inputdata = array(            
          'sisterpages' => $cekidpage[0]->sister, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'sister'     => $sister,
          'pic'        => $picname,
          'description' => $description[$lang],
          'idmenu'    => $id,
          'thumb'      => $thumbname, 
          'cretime'    => date('Y-m-d H:i:s'),
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('banner', $inputdata);
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_banner(){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $id      = $this->input->post('id');
    $idpages = $this->input->post('idpages');
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $link    = $this->input->post('link');
    $pic     = $this->input->post('pic');
    $description     = $this->input->post('description');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('banner');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $step1   = FALSE;
      $success = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    $s = 1;
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id,sister FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = $this->input->post('oldpic'.$lang);
      $thumbname = $this->input->post('oldthumb'.$lang);
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'banner_'.$random_digit."_".$file_edit;
        $folder       = 'banner';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 1400;
        $height       = 640;
        $create_thumb = array(            
          'status' => TRUE,
          'width'  => 800, 
          'height' => 480
        ); 
        $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(            
          'sisterpages'    => $cekidpage[0]->sister, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'pic'        => $picname,
          'description'  => $description[$lang],
          'thumb'      => $thumbname, 
          'modtime'    => date('Y-m-d H:i:s'),
          'modby'      => $this->session->userdata('username')
        );     
        $this->db->where('id', $id[$lang]);
        $edit = $this->db->update('banner', $editdata); 
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function banner_sidebar($id,$parent,$title){
    $url_module = $this->segs[2];
    $login = $this->_isLogin();
    $idmenudb = $id;
    $permit = $this->_cekPermit($idmenudb);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $deflang = $this->_cekDefLang();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_banner_sidebar();
            $data['status'] = $status;
          } 
          $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND draft = 0 AND hapus = 0 AND type=1 ORDER BY posisi asc')->result_array(); 
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_banner_sidebar();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,idpages,title,link,pic,thumb,tipe as tipenya,target FROM `banner_sidebar` WHERE sister = '.$this->segs[5])->result_array(); 
            //echo "<pre>";
            //print_r($data_rec);
            $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND draft = 0 AND hapus = 0 AND type=1 ORDER BY title asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec;
            } else {
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          } else {
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'view'){
          $this->_ispermit($permit->isview);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_row) {
              $data['row'] = $data_row[0];
            } else {
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          } else {
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('banner_sidebar',$this->segs[5]);
            if ($deleted){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('banner_sidebar',$this->segs[5]);
            if ($restore){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }elseif ($this->segs[4] == 'movetrash'){
          $this->_ispermit($permit->isdelete);
          $trash = $this->trashData('banner_sidebar',$this->segs[5]);
          if ($trash){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movedraft'){
          $this->_ispermit($permit->isupdate);
          $draft = $this->draftData('banner_sidebar',$this->segs[5]);
          if ($draft){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movepublish'){
          $this->_ispermit($permit->isupdate);
          $publish = $this->publishData('banner_sidebar',$this->segs[5]);
          if ($publish){
            redirect($this->agent->referrer(), 'refresh');
          }
        }else{
          redirect('/webadmin/'.$url_module, 'refresh');
        }
      }else{
        redirect('/webadmin/'.$url_module, 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $datenow = date('Y-m-d H:i:s');
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and banner_sidebar.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'and banner_sidebar.hapus = 0 and banner_sidebar.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = "and banner_sidebar.hapus = 0 and banner_sidebar.draft = 0 ";
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT banner_sidebar.id,banner_sidebar.title,banner_sidebar.sister,banner_sidebar.thumb,banner_sidebar.pic, pages.title as pages FROM `banner_sidebar` INNER JOIN pages ON banner_sidebar.idpages=pages.id where banner_sidebar.idlanguage = '.$deflang.' '.$sqlwhere.' order by banner_sidebar.posisi asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `banner_sidebar` where 1=1 '.$sqlwhere.' order by posisi asc')->result();        
      $data['rec']        = $data_rec;
      $data['act']        = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish']    = $this->countPublishNew('banner_sidebar',$deflang);
      $data['count_draft']      = $this->countDraftNew('banner_sidebar',$deflang);
      $data['count_trash']      = $this->countTrashNew('banner_sidebar',$deflang);
    }
    $data['url_module'] = $this->segs[2];
      $data['submenu'] = TRUE;
      $data['active']  = $parent;
          $data['active2'] = $id;
      $data['page']    = 'banner_sidebar';
    $this->load->view('cms/main.php',$data); 
  }
  function _save_banner_sidebar(){
     //echo '<pre>';
//     print_r($_POST);
//     print_r($_FILES);
//     die();
    $idpages = implode(',', $_POST['my_multi_select1']);
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $link    = $this->input->post('link');
    $pic     = $this->input->post('pic');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    $tipe = $this->input->post('tipe');
    $target = $this->input->post('target');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('banner_sidebar');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $step1   = FALSE;
      $success = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    $picname   = "";
    $picname2  = "";
    $thumbname = "";
    foreach ($idlang as $lang) {
      $picname   = "";
      $thumbname = "";
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'sidebar_'.$random_digit."_".$file_edit;
        $folder       = 'sidebar';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 334;
        $height       = 223;
        $create_thumb = array(            
          'status' => TRUE,
          'width'  => 105, 
          'height' => 39
        ); 
        $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $data = array();
        $inputdata = array(            
          'idpages'    => $idpages, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'sister'     => $sister,
          'pic'        => $picname,
          'tipe'       => $tipe,
          'target'     => $target,
          'thumb'      => $thumbname, 
          'cretime'    => date('Y-m-d H:i:s'),
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('banner_sidebar', $inputdata);
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_banner_sidebar(){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $id      = $this->input->post('id');
    $idpages = implode(',', $_POST['my_multi_select1']);
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $link    = $this->input->post('link');
    $pic     = $this->input->post('pic');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    $tipe = $this->input->post('tipe');
    $target = $this->input->post('target');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('banner_sidebar');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $step1   = FALSE;
      $success = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    $s = 1;
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = $this->input->post('oldpic'.$lang);
      $thumbname = $this->input->post('oldthumb'.$lang);
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'sidebar_'.$random_digit."_".$file_edit;
        $folder       = 'sidebar';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 334;
        $height       = 223;
        $create_thumb = array(            
          'status' => TRUE,
          'width'  => 105, 
          'height' => 39
        ); 
        $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(   
          'idpages'    => $idpages, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'sister'     => $sister,
          'pic'        => $picname,
          'tipe'        => $tipe,
          'target'        => $target,
          'thumb'      => $thumbname, 
          'modtime'    => date('Y-m-d H:i:s'),
          'modby'      => $this->session->userdata('username')
        );     
        $this->db->where('id', $id[$lang]);
        $edit = $this->db->update('banner_sidebar', $editdata); 
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
    function _save_kategoriartikel($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            if (count($_POST['pages']) > 0){
                $otherpages = implode(',', $_POST['pages']);
            }
        }
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('kategori_artikel');
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/kategori_artikel/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
          $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `kategori_artikel` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
          if($ceklink[0]->jumlah != 0){
            $newlink = $link[$lang].$ceklink[0]->jumlah;
          }else{
            $newlink = $link[$lang];
          }
            $picname   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'kategori_artikel_'.$random_digit."_".$file_edit;
            $folder       = 'kategori_artikel';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 900;
            $height       = 510;
            $create_thumb = array(            
                'status' => TRUE,
                'width'  => 298, 
                'height' => 169
            ); 
            if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/kategori_artikel/'.$new_file_name)) {//if file moved to uploads folder
                $this->resize(FCPATH.'/uploads/kategori_artikel/'.$new_file_name, FCPATH.'/uploads/kategori_artikel/thumb_'.$new_file_name, 298, 169);
                $this->resize(FCPATH.'/uploads/kategori_artikel/'.$new_file_name, FCPATH.'/uploads/kategori_artikel/'.$new_file_name, 402, 273);
            }
            $thumb_filenya = 'thumb_'.$new_file_name;
        }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(            
              'sisterpages' => $idpages,
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link_ori'    => $link[$lang], 
              'link'       => $newlink,  
              'description'    => $content[$lang],    
              'pic'        => $new_file_name,
              'thumb'      => $thumb_filenya,  
              'idmenu'      => $id,  
              'parent_menu'      => $parent,  
              'sister'     => $sister,
              'cretime'    => date('Y-m-d H:i:s'),
              'creby'      => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('kategori_artikel', $inputdata);
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_kategoriartikel(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idpages = $this->input->post('mainpages');
        $otherpages = implode(',', $_POST['pages']);
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $link    = $this->input->post('link');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Pages : Must be filled</li>";
        }
        $s = 1;
        foreach ($idlang as $lang) {
          $picname   = $this->input->post('oldpic'.$lang);
          $thumbname = $this->input->post('oldthumb'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'banner_'.$random_digit."_".$file_edit;
            $folder       = 'banner';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 944;
            $height       = 340;
            $create_thumb = array(            
              'status' => TRUE,
              'width'  => 105, 
              'height' => 70
            ); 
            $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'idpages'    => $idpages, 
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link'       => $link[$lang],  
              'pic'        => $picname,
              'thumb'      => $thumbname, 
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            //print_r($id[$lang]);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('kategori_artikel', $editdata); 
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages'  => $idpages,
            'title'    => $title,
            'link'     => $link,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function one_page_many_section($id,$parent,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 45 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
                $this->_ispermit($permit->isadd);
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                    $status = $this->_save_one_page_many_section($id,$parent);
                    $data['status'] = $status;
                }
                $data['menu_slide_banner'] = $this->db->query('SELECT id,title FROM `menu` WHERE module = 40 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_one_page_many_section($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `one_page_many_section` WHERE sister = '.$this->segs[5])->result_array(); 
                $data['menu_slide_banner'] = $this->db->query('SELECT id,title FROM `menu` WHERE module = 46 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 45 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('one_page_many_section',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('one_page_many_section',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData('one_page_many_section',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData('one_page_many_section',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('one_page_many_section',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and one_page_many_section.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and one_page_many_section.hapus = 0 and one_page_many_section.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and one_page_many_section.hapus = 0 and one_page_many_section.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT one_page_many_section.tipe_section,one_page_many_section.id,one_page_many_section.title,one_page_many_section.sister,one_page_many_section.thumb,one_page_many_section.background, pages.title as pages FROM `one_page_many_section` LEFT JOIN pages ON one_page_many_section.sisterpages=pages.sister where one_page_many_section.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND one_page_many_section.idmenu='.$id.' order by one_page_many_section.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(*) as jumlah FROM `one_page_many_section` where 1=1 '.$sqlwhere.' AND idmenu='.$id.' order by posisi asc')->result();        
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNewBase('one_page_many_section',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('one_page_many_section',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('one_page_many_section',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['current_menu'] = $link;
          $data['page']    = 'one_page_many_section';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function _save_one_page_many_section($id,$parent){
        $idlang   = $this->input->post('idlang');
        $tipe_section   = $this->input->post('tipe_section');
        $posisi = $this->_nextPosisi('one_page_many_section',$id);
        $sister = $this->_nextAI('one_page_many_section');
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        if ($tipe_section == 1){
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $source   = $this->input->post('source_data');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $inputdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'page_source'  => $source[$lang], 
                        'sisterpages'  => $sister_pages, 
                        'idlanguage'  => $lang, 
                        'idmenu'      => $id,  
                        'tipe_section' => $tipe_section,
                        'sister'      => $sister,
                        'posisi'      => $posisi,
                        'cretime'     => date('Y-m-d H:i:s'),
                        'creby'       => $this->session->userdata('username')
                    );     
                    $saved = $this->db->insert('one_page_many_section', $inputdata);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($saved){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }elseif ($tipe_section == 4){
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $inputdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'sisterpages'  => $sister_pages, 
                        'idlanguage'  => $lang, 
                        'idmenu'      => $id,  
                        'tipe_section' => $tipe_section,
                        'sister'      => $sister,
                        'posisi'      => $posisi,
                        'cretime'     => date('Y-m-d H:i:s'),
                        'creby'       => $this->session->userdata('username')
                    );     
                    $saved = $this->db->insert('one_page_many_section', $inputdata);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($saved){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }elseif ($tipe_section == 8){
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                $picname   = "";
                if ($step1 == TRUE AND isset($_FILES['background_1'.$lang]['name']) AND $_FILES['background_1'.$lang]['name'] != '') {
                    $filenameold   = strtolower($_FILES['background_1'.$lang]['name']);
                    $filename     = str_replace(" ","_",$filenameold);
                    $folder       = 'section';
                    $filename     = $lang."background_1".date("YmdHis")."_".$filename;
                    $fieldname    = 'background_1'.$lang;
                    $resizable    = FALSE;
                    $width        = 100;
                    $height       = 100;
                    $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                    if($hasilupload['status'] == TRUE){
                      $picname   = $hasilupload['filename'];
                      $thumbname = $hasilupload['thumbname'];
                    }else{
                      $success = $hasilupload['success'];
                      $step1   = $hasilupload['step1'];
                      $notice  .= $hasilupload['notice'];
                      $picname = "";
                    }
                } 
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $inputdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'sisterpages'  => $sister_pages, 
                        'idlanguage'  => $lang, 
                        'idmenu'      => $id,  
                        'tipe_section' => $tipe_section,
                        'sister'      => $sister,
                        'background'  => $picname,  
                        'posisi'      => $posisi,
                        'cretime'     => date('Y-m-d H:i:s'),
                        'creby'       => $this->session->userdata('username')
                    );     
                    $saved = $this->db->insert('one_page_many_section', $inputdata);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($saved){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }elseif ($tipe_section == 9){
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $link_youtube   = $this->input->post('link_youtube');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                $picname   = "";
                if ($step1 == TRUE AND isset($_FILES['background_1'.$lang]['name']) AND $_FILES['background_1'.$lang]['name'] != '') {
                    $filenameold   = strtolower($_FILES['background_1'.$lang]['name']);
                    $filename     = str_replace(" ","_",$filenameold);
                    $folder       = 'section';
                    $filename     = $lang."background_1".date("YmdHis")."_".$filename;
                    $fieldname    = 'background_1'.$lang;
                    $resizable    = FALSE;
                    $width        = 100;
                    $height       = 100;
                    $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                    if($hasilupload['status'] == TRUE){
                      $picname   = $hasilupload['filename'];
                      $thumbname = $hasilupload['thumbname'];
                    }else{
                      $success = $hasilupload['success'];
                      $step1   = $hasilupload['step1'];
                      $notice  .= $hasilupload['notice'];
                      $picname = "";
                    }
                } 
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $inputdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'link_youtube' => $link_youtube[$lang],
                        'sisterpages'  => $sister_pages, 
                        'idlanguage'  => $lang, 
                        'idmenu'      => $id,  
                        'background'  => $picname,  
                        'tipe_section' => $tipe_section,
                        'sister'      => $sister,
                        'posisi'      => $posisi,
                        'cretime'     => date('Y-m-d H:i:s'),
                        'creby'       => $this->session->userdata('username')
                    );     
                    $saved = $this->db->insert('one_page_many_section', $inputdata);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($saved){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }else{
            $idlang   = $this->input->post('idlang');
            $title   = $this->input->post('title');
            $hide_title   = $this->input->post('hide_title');
            $sister_pages   = $this->input->post('mainpages');
            $link   = $this->input->post('url');
            $content   = $this->input->post('content');
            $text_color   = $this->input->post('color_text');
            $grid_left   = $this->input->post('grid_left');
            $grid_right   = $this->input->post('grid_right');
            $width = 1400;
            $height = 769;
            $width_image = 581;
            $height_image = 583;
            if ($tipe_section == 2){
                $width = 1400;
                $height = 769;
                $width_image = 581;
                $height_image = 583;
            }
            if ($tipe_section == 3){
                $width = 1400;
                $height = 683;
                $width_image = 351;
                $height_image = 456;
            }
            if ($tipe_section == 5){
                $width = 1400;
                $height = 735;
                $width_image = 584;
                $height_image = 510;
            }
            if ($tipe_section == 6 || $tipe_section == 7){
                $width = 1400;
                $height = 768;
                $width_image = 476;
                $height_image = 448;
            }
            foreach ($idlang as $lang) {
                $picname   = "";
                $thumbname = "";
                $picname_image   = "";
                $thumbname_image = "";
                if ($step1 == TRUE AND isset($_FILES['background'.$lang]['name']) AND $_FILES['background'.$lang]['name'] != '') {
                    $filenameold   = strtolower($_FILES['background'.$lang]['name']);
                    $filename     = str_replace(" ","_",$filenameold);
                    $folder       = 'section';
                    $filename     = $lang."background_".date("YmdHis")."_".$filename;
                    $fieldname    = 'background'.$lang;
                    $resizable    = TRUE;
                    $width        = $width;
                    $height       = $height;
                    $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                    if($hasilupload['status'] == TRUE){
                      $picname   = $hasilupload['filename'];
                      $thumbname = $hasilupload['thumbname'];
                    }else{
                      $success = $hasilupload['success'];
                      $step1   = $hasilupload['step1'];
                      $notice  .= $hasilupload['notice'];
                      $picname = "";
                    }
                } 
                if ($step1 == TRUE AND isset($_FILES['image'.$lang]['name']) AND $_FILES['image'.$lang]['name'] != '') {
                    $filenameold_image   = strtolower($_FILES['image'.$lang]['name']);
                    $filename_image     = str_replace(" ","_",$filenameold_image);
                    $folder       = 'section';
                    $filename_image     = $lang."image".date("YmdHis")."_".$filename_image;
                    $fieldname_image    = 'image'.$lang;
                    $resizable    = TRUE;
                    $width        = $width_image;
                    $height       = $height_image;
                    $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload_image = $this->bas_img_upload($folder,$filename_image,$fieldname_image,$width,$height,$create_thumb,$resizable);
                    if($hasilupload_image['status'] == TRUE){
                      $picname_image   = $hasilupload_image['filename'];
                      $thumbname_image = $hasilupload_image['thumbname'];
                    }else{
                      $success = $hasilupload_image['success'];
                      $step1   = $hasilupload_image['step1'];
                      $notice  .= $hasilupload_image['notice'];
                      $picname_image = "";
                    }
                } 
                if($step1 == TRUE AND $success == TRUE){
                    if ($hide_title[$lang] == ""){
                        $hide_title = 0;
                    }else{
                        $hide_title = 1;
                    }
                    $data = array();
                    $inputdata = array(            
                        'title' => $title[$lang],
                        'hide_title'  => $hide_title, 
                        'sisterpages'  => $sister_pages, 
                        'link'  => $link[$lang], 
                        'description'  => $content[$lang], 
                        'idlanguage'  => $lang, 
                        'tipe_section' => $tipe_section,
                        'idmenu'      => $id,  
                        'background'  => $picname,  
                        'image'  => $picname_image,
                        'sister'      => $sister,  
                        'text_color'  => $text_color,
                        'grid_left'   => $grid_left,
                        'grid_right'  => $grid_right,
                        'posisi'      => $posisi,
                        'cretime'     => date('Y-m-d H:i:s'),
                        'creby'       => $this->session->userdata('username')
                    );     
                    $saved = $this->db->insert('one_page_many_section', $inputdata);
                    $filename = "";
                    $filename_image = "";
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($saved){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }
      }
    function _edit_one_page_many_section($id,$parent){
        $idlang   = $this->input->post('idlang');
        $tipe_section   = $this->input->post('tipe_section');
        $posisi = $this->_nextPosisi('one_page_many_section',$id);
        $sister = $this->_nextAI('one_page_many_section');
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        $id_edit = $this->input->post('id_edit');
        if ($tipe_section == 1){
            $uid   = $this->input->post('id');
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $source   = $this->input->post('source_data');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $editdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'page_source'  => $source[$lang], 
                        'sisterpages'  => $sister_pages, 
                        'idmenu'      => $id,  
                        'description'  => '', 
                        'hide_title'  => 0, 
                        'tipe_section' => $tipe_section,
                        'modtime'    => date('Y-m-d H:i:s'),
                        'modby'      => $this->session->userdata('username')
                    );   
                    //print_r($id[$lang]);  
                    $this->db->where('id', $uid[$lang]);
                    $edit = $this->db->update('one_page_many_section', $editdata); 
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($edit){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }elseif ($tipe_section == 4){
            $uid   = $this->input->post('id');
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $editdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'sisterpages'  => $sister_pages, 
                        'idmenu'      => $id,  
                        'tipe_section' => $tipe_section,
                        'modtime'    => date('Y-m-d H:i:s'),
                        'modby'      => $this->session->userdata('username')
                    );   
                    $this->db->where('id', $uid[$lang]);
                    $edit = $this->db->update('one_page_many_section', $editdata); 
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($edit){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }elseif ($tipe_section == 8){
            $uid   = $this->input->post('id');
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                $picname2   = $this->input->post('backgroundold_1'.$lang);
                if ($step1 == TRUE AND isset($_FILES['background_1'.$lang]['name']) AND $_FILES['background_1'.$lang]['name'] != '') {
                    //echo strtolower($_FILES['pic2'.$lang]['name']);
                    $filenameold2   = strtolower($_FILES['background_1'.$lang]['name']);
                    $file_edit2     = str_replace(" ","_",$filenameold2);
                    $new_file_name2 = 'bg_comparation_'.$file_edit2;
                    $folder       = 'section';
                    $filename2     = $new_file_name2;
                    $fieldname    = 'background_1'.$lang;
                    $resizable    = FALSE;
                    $width        = 693;
                    $height       = 382;
                    $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                    ); 
                        $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                        $picname2   = $hasilupload['filename'];
                        $thumbname = $hasilupload['thumbname'];
                    }else{
                        $success = $hasilupload['success'];
                        $step1   = $hasilupload['step1'];
                        $notice  .= $hasilupload['notice'];
                        $picname2 = "";
                    }
                }
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $editdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'sisterpages'  => $sister_pages,
                        'background' => $picname2,
                        'tipe_section' => $tipe_section,
                        'modtime'    => date('Y-m-d H:i:s'),
                        'modby'      => $this->session->userdata('username')
                    );   
                    //print_r($idlang_slide);
                    $this->db->where('id', $uid[$lang]);
                    $edit = $this->db->update('one_page_many_section', $editdata); 
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($edit){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idlang'  => $idlang,
                    'title'   => $title_slide_banner
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }elseif ($tipe_section == 9){
            $uid   = $this->input->post('id');
            $idlang_slide   = $this->input->post('idlang_slide');
            $title_slide_banner   = $this->input->post('title_slide_banner');
            $link_youtube   = $this->input->post('link_youtube');
            $sister_pages   = $this->input->post('mainpages');
            foreach ($idlang_slide as $lang) {
                $picname2   = $this->input->post('backgroundold_1');
                $picname2 = $picname2[$lang];
                if ($step1 == TRUE AND isset($_FILES['background_1'.$lang]['name']) AND $_FILES['background_1'.$lang]['name'] != '') {
                    //echo strtolower($_FILES['pic2'.$lang]['name']);
                    $filenameold2   = strtolower($_FILES['background_1'.$lang]['name']);
                    $file_edit2     = str_replace(" ","_",$filenameold2);
                    $new_file_name2 = 'bg_video_'.date("YmdHis").'_'.$file_edit2;
                    $folder       = 'section';
                    $filename2     = $new_file_name2;
                    $fieldname    = 'background_1'.$lang;
                    $resizable    = FALSE;
                    $width        = 693;
                    $height       = 382;
                    $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                    ); 
                        $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                        $picname2   = $hasilupload['filename'];
                        $thumbname = $hasilupload['thumbname'];
                    }else{
                        $success = $hasilupload['success'];
                        $step1   = $hasilupload['step1'];
                        $notice  .= $hasilupload['notice'];
                        $picname2 = "";
                    }
                }
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $editdata = array(            
                        'title' => $title_slide_banner[$lang],
                        'link_youtube' => $link_youtube[$lang],
                        'sisterpages'  => $sister_pages,
                        'background' => $picname2,
                        'tipe_section' => $tipe_section,
                        'modtime'    => date('Y-m-d H:i:s'),
                        'modby'      => $this->session->userdata('username')
                    );   
                    //print_r($editdata);
                    $this->db->where('id', $uid[$lang]);
                    $edit = $this->db->update('one_page_many_section', $editdata); 
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($edit){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idlang'  => $idlang,
                    'title'   => $title_slide_banner
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }else{
            $idlang   = $this->input->post('idlang');
            $title   = $this->input->post('title');
            $hide_title   = $this->input->post('hide_title');
            $sister_pages   = $this->input->post('mainpages');
            $link   = $this->input->post('url');
            $content   = $this->input->post('content');
            $picnamenya   = $this->input->post('backgroundold');
            $picname_imagenya   = $this->input->post('imageold');
            $text_color   = $this->input->post('color_text');
            $grid_left   = $this->input->post('grid_left');
            $grid_right   = $this->input->post('grid_right');
            $width = 1400;
            $height = 769;
            $width_image = 581;
            $height_image = 583;
            if ($tipe_section == 2){
                $width = 1400;
                $height = 769;
                $width_image = 581;
                $height_image = 583;
            }
            if ($tipe_section == 3){
                $width = 1400;
                $height = 683;
                $width_image = 351;
                $height_image = 456;
            }
            if ($tipe_section == 5){
                $width = 1400;
                $height = 735;
                $width_image = 584;
                $height_image = 510;
            }
            if ($tipe_section == 6 || $tipe_section == 7){
                $width = 1400;
                $height = 768;
                $width_image = 476;
                $height_image = 448;
            }
            foreach ($idlang as $lang) {
                $picname   = $picnamenya[$lang];
                $thumbname = "";
                $picname_image   = $picname_imagenya[$lang];
                $thumbname_image = "";
                if ($step1 == TRUE AND isset($_FILES['background'.$lang]['name']) AND $_FILES['background'.$lang]['name'] != '') {
                    $filenameold   = strtolower($_FILES['background'.$lang]['name']);
                    $filename     = str_replace(" ","_",$filenameold);
                    $folder       = 'section';
                    $filename     = $lang."background_".date("YmdHis")."_".$filename;
                    $fieldname    = 'background'.$lang;
                    $resizable    = TRUE;
                    $width        = $width;
                    $height       = $height;
                    $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                    if($hasilupload['status'] == TRUE){
                      $picname   = $hasilupload['filename'];
                      $thumbname = $hasilupload['thumbname'];
                    }else{
                      $success = $hasilupload['success'];
                      $step1   = $hasilupload['step1'];
                      $notice  .= $hasilupload['notice'];
                      $picname = "";
                    }
                } 
                if ($step1 == TRUE AND isset($_FILES['image'.$lang]['name']) AND $_FILES['image'.$lang]['name'] != '') {
                    $filenameold_image   = strtolower($_FILES['image'.$lang]['name']);
                    $filename_image     = str_replace(" ","_",$filenameold_image);
                    $folder       = 'section';
                    $filename_image     = $lang."image".date("YmdHis")."_".$filename_image;
                    $fieldname_image    = 'image'.$lang;
                    $resizable    = TRUE;
                    $width        = $width_image;
                    $height       = $height_image;
                    $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload_image = $this->bas_img_upload($folder,$filename_image,$fieldname_image,$width,$height,$create_thumb,$resizable);
                    if($hasilupload_image['status'] == TRUE){
                      $picname_image   = $hasilupload_image['filename'];
                      $thumbname_image = $hasilupload_image['thumbname'];
                    }else{
                      $success = $hasilupload_image['success'];
                      $step1   = $hasilupload_image['step1'];
                      $notice  .= $hasilupload_image['notice'];
                      $picname_image = "";
                    }
                } 
                if ($hide_title[$lang] == ""){
                    $hide_title = 0;
                }else{
                    $hide_title = 1;
                }
                if($step1 == TRUE AND $success == TRUE){
                    $data = array();
                    $editdata = array(            
                        'title' => $title[$lang],
                        'hide_title'  => $hide_title, 
                        'sisterpages'  => $sister_pages, 
                        'link'  => $link[$lang], 
                        'description'  => $content[$lang], 
                        'idlanguage'  => $lang, 
                        'background'  => $picname,  
                        'image'  => $picname_image,  
                        'text_color'  => $text_color,
                        'grid_left'   => $grid_left,
                        'grid_right'  => $grid_right,
                        'tipe_section' => $tipe_section,
                        'idmenu'      => $id,  
                        'modtime'    => date('Y-m-d H:i:s'),
                        'modby'      => $this->session->userdata('username')
                    ); 
                    $this->db->where('id', $id_edit[$lang]);
                    $edit = $this->db->update('one_page_many_section', $editdata); 
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                if ($edit){
                    $info = array(            
                        'notice'  => $notice,
                        'success' => $success
                    );
                    return $info;
                }else{
                    $info = array(            
                        'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                        'success' => false
                    );
                    return $info;
                }
            }else{
                $form = array(
                    'idpages' => $idpages,
                    'idlang'  => $idlang,
                    'title'   => $title,
                    'content' => $content,
                    'link'    => $link
                );
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success,
                    'form'    => $form
                );
                return $info;
            }
        }
      }
    function kategoriartikel2($id,$parent){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_kategoriartikel($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 23 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_kategoriartikel($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `kategori_artikel` WHERE sister = '.$this->segs[5])->result_array(); 
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 23 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('kategori_artikel',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('kategori_artikel',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData('kategori_artikel',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData('kategori_artikel',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('kategori_artikel',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and kategori_artikel.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and kategori_artikel.hapus = 0 and kategori_artikel.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and kategori_artikel.hapus = 0 and kategori_artikel.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT kategori_artikel.id,kategori_artikel.title,kategori_artikel.sister,kategori_artikel.thumb,kategori_artikel.pic, pages.title as pages FROM `kategori_artikel` LEFT JOIN pages ON kategori_artikel.sisterpages=pages.sister where kategori_artikel.idlanguage = '.$deflang.' AND  pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_artikel.idmenu='.$id.' order by kategori_artikel.posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(kategori_artikel.id) as jumlah,kategori_artikel.id,kategori_artikel.title,kategori_artikel.sister,kategori_artikel.thumb,kategori_artikel.pic, pages.title as pages FROM `kategori_artikel` LEFT JOIN pages ON kategori_artikel.sisterpages=pages.sister where kategori_artikel.idlanguage = '.$deflang.' AND  pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_artikel.idmenu='.$id.' order by kategori_artikel.posisi asc')->result();        
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNewBase('kategori_artikel',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('kategori_artikel',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('kategori_artikel',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'kategoriartikel';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function _save_kategorivideo($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = implode(',', $_POST['pages']);
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('kategori_video');
        $posisi = $this->_nextPosisi('kategori_video',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'uploads/kategori_video/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
          if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `kategori_video` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                $newlink = $link[$lang];
                }
          }
            $picname   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $filename     = str_replace(" ","_",$filenameold);
            $folder       = 'kategori_video';
            $filename     = $filename;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 310;
            $height       = 207;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(            
              'idpages' => $idpages,
              'otherpages'  => $otherpages, 
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'link_ori'    => $link[$lang], 
              'link'        => $newlink,  
              'description' => $content[$lang],    
              'pic'         => $filename, 
              'idmenu'      => $id,  
              'parent_menu' => $parent,  
              'sister'      => $sister,
              'posisi'      => $posisi,
              'cretime'     => date('Y-m-d H:i:s'),
              'creby'       => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('kategori_video', $inputdata);
          }
          $filename = "";
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_kategorivideo(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idpages = $this->input->post('mainpages');
        $otherpages = implode(',', $_POST['pages']);
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $link    = $this->input->post('link');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Pages : Must be filled</li>";
        }
        $s = 1;
        foreach ($idlang as $lang) {
          $picname   = $this->input->post('oldpic'.$lang);
          $thumbname = $this->input->post('oldthumb'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'kategori_video_'.$random_digit."_".$file_edit;
            $folder       = 'kategori_video';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 310;
            $height       = 207;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'idpages'    => $idpages, 
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link'       => $link[$lang],  
              'pic'        => $picname,
              'thumb'      => $thumbname, 
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            //print_r($id[$lang]);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('kategori_video', $editdata); 
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages'  => $idpages,
            'title'    => $title,
            'link'     => $link,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function mapsoffice($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        $idlang  = $this->input->post('idlang');
        $address  = $this->input->post('address');
        if (isset($_POST["latitude"])){
            $data_rec = $this->db->query('SELECT * FROM `maps_office`')->result_array();
            //print_r($data_rec);
            if (count($data_rec) == 0){
                foreach ($idlang as $lang) {
                    $inputdata = array(  
                        'idlanguage'      => $lang, 
                        'latitude'      => $_POST["latitude"], 
                        'longitude'      => $_POST["longitude"],
                        'address'      => $_POST["address".$lang]
                    );     
                    $saved = $this->db->insert('maps_office', $inputdata);
                }
            }else{
                foreach ($idlang as $lang) {
                    $editdata = array(  
                      'latitude'      => $_POST["latitude"], 
                      'longitude'      => $_POST["longitude"],
                      'address'      => $_POST["address".$lang]
                    );     
                    $this->db->where('idlanguage', $lang);
                    $edit = $this->db->update('maps_office', $editdata); 
                }
            }
            $data["status"]["success"] = TRUE;
        }
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and bank_account.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and bank_account.hapus = 0 and bank_account.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and bank_account.hapus = 0 and bank_account.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT * FROM `maps_office`')->result_array();  
          //print_r($data_rec);
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['current_menu']    = $link;
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'maps_office';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function adsbanner($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        $idlang  = $this->input->post('idlang');
        $notice  = "";
        if (isset($_POST["sidebar_ads_global"])){
            $data_rec = $this->db->query('SELECT * FROM `ads_banner_side`')->result_array();
            if (count($data_rec) == 0){
                foreach ($idlang as $lang) {
                    $picname   = $this->input->post('oldpic'.$lang);
                    if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    $inputdata = array(  
                        'idlanguage'      => $lang, 
                        'link'      => $_POST["link"][$lang],
                        'image'      => $picname
                    );     
                    $saved = $this->db->insert('ads_banner_side', $inputdata);
                }
            }else{
                foreach ($idlang as $lang) {
                    $picname   = $this->input->post('oldpic'.$lang);
                    if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    $editdata = array(  
                      'link'      => $_POST["link"][$lang],
                      'image'      => $picname
                    );     
                    $this->db->where('idlanguage', $lang);
                    $edit = $this->db->update('ads_banner_side', $editdata); 
                }
            }
            $data["status"]["success"] = TRUE;
        }
        if (isset($_POST["sidebar_ads_global_top"])){
            $data_rec = $this->db->query('SELECT * FROM `ads_banner_top`')->result_array();
            if (count($data_rec) == 0){
                foreach ($idlang as $lang) {
                    if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    if (isset($_FILES['pic_m'.$lang]['name']) AND $_FILES['pic_m'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_m'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_m_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_m'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname2   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname2 = "";
                        }
                    }
                    $inputdata = array(  
                        'idlanguage'      => $lang, 
                        'link'      => $_POST["link"][$lang],
                        'image'      => $picname,
                        'image_m'      => $picname2
                    );     
                    $saved = $this->db->insert('ads_banner_top', $inputdata);
                }
            }else{
                foreach ($idlang as $lang) {
                    $picname   = $this->input->post('oldpic'.$lang);
                    $picname2   = $this->input->post('oldpic_m'.$lang);
                    if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    if (isset($_FILES['pic_m'.$lang]['name']) AND $_FILES['pic_m'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_m'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_m_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_m'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname2   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname2 = "";
                        }
                    }
                    $editdata = array(  
                      'link'      => $_POST["link"][$lang],
                      'image'      => $picname,
                      'image_m'      => $picname2
                    );     
                    $this->db->where('idlanguage', $lang);
                    $edit = $this->db->update('ads_banner_top', $editdata); 
                }
            }
            $data["status"]["success"] = TRUE;
        }
        if (isset($_POST["sidebar_ads_global_bottom"])){
            $picname = "";
            $picname2 = "";
            $data_rec = $this->db->query('SELECT * FROM `ads_banner_bottom`')->result_array();
            if (count($data_rec) == 0){
                foreach ($idlang as $lang) {
                    if (isset($_FILES['pic_bottom'.$lang]['name']) AND $_FILES['pic_bottom'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_bottom'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_bottom_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_bottom'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    if (isset($_FILES['pic_m_bottom'.$lang]['name']) AND $_FILES['pic_m_bottom'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_m_bottom'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_m_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_m_bottom'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname2   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname2 = "";
                        }
                    }
                    $inputdata = array(  
                        'idlanguage'      => $lang, 
                        'link'      => $_POST["link"][$lang],
                        'image'      => $picname,
                        'image_m'      => $picname2
                    );     
                    $saved = $this->db->insert('ads_banner_bottom', $inputdata);
                }
            }else{
                foreach ($idlang as $lang) {
                    $picname   = $this->input->post('oldpic_bottom'.$lang);
                    $picname2   = $this->input->post('oldpic_m_bottom'.$lang);
                    if (isset($_FILES['pic_bottom'.$lang]['name']) AND $_FILES['pic_bottom'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_bottom'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_bottom_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_bottom'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    if (isset($_FILES['pic_m_bottom'.$lang]['name']) AND $_FILES['pic_m_bottom'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_m_bottom'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_bottom_m_'.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_m_bottom'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname2   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname2 = "";
                        }
                    }
                    $editdata = array(  
                      'link'      => $_POST["link"][$lang],
                      'image'      => $picname,
                      'image_m'      => $picname2
                    );     
                    $this->db->where('idlanguage', $lang);
                    $edit = $this->db->update('ads_banner_bottom', $editdata); 
                }
            }
            $data["status"]["success"] = TRUE;
        }
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and bank_account.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and bank_account.hapus = 0 and bank_account.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and bank_account.hapus = 0 and bank_account.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT * FROM `ads_banner_side`')->result_array();  
          //print_r($data_rec);
          $data['rec'] = $data_rec;
          $data['act'] = 'default';
          $data_rec_top = $this->db->query('SELECT * FROM `ads_banner_top`')->result_array();  
          $data['rec_top'] = $data_rec_top;
          $data_rec_bottom = $this->db->query('SELECT * FROM `ads_banner_bottom`')->result_array();  
          $data['rec_bottom']  = $data_rec_bottom;
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['current_menu'] = $link;
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'adsbanner';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function shippingorigin($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($_POST["province"])){
            $data_rec = $this->db->query('SELECT * FROM `shipping_origin` where uid = 1')->result_array();
            if (count($data_rec) == 0){
                $inputdata = array( 
                  'province_id'      => $_POST["province"], 
                  'city_id'      => $_POST["city"]
                );     
                $saved = $this->db->insert('shipping_origin', $inputdata);
            }else{
                $editdata = array(  
                  'province_id'      => $_POST["province"], 
                  'city_id'      => $_POST["city"]
                );     
                $this->db->where('uid', 1);
                $edit = $this->db->update('shipping_origin', $editdata); 
            }
            $data["status"]["success"] = TRUE;
        }
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and bank_account.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and bank_account.hapus = 0 and bank_account.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and bank_account.hapus = 0 and bank_account.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
            $data_rec = $this->db->query('SELECT * FROM `shipping_origin` where uid = 1')->result_array();  
            $query_prov = $this->db->query('SELECT province_id,province FROM province')->result_array();
            $data["prov"] = $query_prov;
            $data["city"] = array();
            $data["district"] = array();
            if (count($data_rec) > 0){
                $query_city = $this->db->query('SELECT * FROM city WHERE province_id = '.$data_rec[0]["province_id"])->result_array();;
                //echo "<pre>";
                //print_r($query_city);
                $data["city"] = $query_city;
            }
            $data['rec']        = $data_rec;
            $data['act']        = 'default';
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['current_menu']    = $link;
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'shippingorigin';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function bank_account($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_bank($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 23 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_bank($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `bank_account` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('bank_account',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('bank_account',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData('bank_account',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData('bank_account',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('bank_account',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and bank_account.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and bank_account.hapus = 0 and bank_account.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and bank_account.hapus = 0 and bank_account.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT * FROM `bank_account` where 1=1 '.$sqlwhere.' AND bank_account.idlanguage = '.$deflang.' order by posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(bank_account.id) as jumlah FROM `bank_account` where 1=1 '.$sqlwhere.' AND bank_account.idlanguage = '.$deflang.' order by posisi asc')->result();        
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNewBase('bank_account',"",$id);
          $data['count_draft']      = $this->countDraftNewBase('bank_account',"",$id);
          $data['count_trash']      = $this->countTrashNewBase('bank_account',"",$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['current_menu']    = $link;
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'bank_account';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function _save_bank($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            if (count($_POST['pages']) > 0){
                $otherpages = implode(',', $_POST['pages']);
            }
        }
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $bank_account_number    = $this->input->post('bank_account_number');
        $bank_account_name    = $this->input->post('bank_account_name');
        $description    = $this->input->post('content');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('bank_account');
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        if($step1 == TRUE AND $success == TRUE){
            $data = array();
            foreach ($idlang as $lang) {
                $inputdata = array(            
                  'idlanguage'  => $lang, 
                  'title'       => $title, 
                  'parent_menu' => $parent,  
                  'sister'      => $sister,
                  'cretime'     => date('Y-m-d H:i:s'),
                  'bank_account_number' => $bank_account_number,
                  'bank_account_name'   => $bank_account_name,
                  'description'  => $description[$lang],
                  'idmenu'       => $id,
                  'creby'        => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('bank_account', $inputdata);
            }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'title'   => $title,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_bank($id,$parent){
        // echo '<pre>';
//         print_r($_POST);
//         print_r($_FILES);
//         die();
        $idlang   = $this->input->post('idlang');
        $id      = $this->input->post('id');
        $title   = $this->input->post('title');
        $bank_account_number   = $this->input->post('bank_account_number');
        $content = $this->input->post('content');
        $bank_account_name    = $this->input->post('bank_account_name');
        $description    = $this->input->post('content');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($title) AND $title != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Title : Must be filled</li>";
        }
        $s = 1;
          if($step1 == TRUE AND $success == TRUE){
            foreach ($idlang as $lang) {
                $editdata = array(  
                  'title'      => $title, 
                  'bank_account_number'    => $bank_account_number, 
                  'description' => $content,
                  'bank_account_name' => $bank_account_name,
                  'description'  => $description[$lang],
                  'modtime'    => date('Y-m-d H:i:s'),
                  'modby'      => $this->session->userdata('username')
                );     
                $this->db->where('id', $_POST["id"][$lang]);
                $edit = $this->db->update('bank_account', $editdata);
                print_r($_POST["id"][$lang]); 
              }
              }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'title'    => $title,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function payment_confirmation($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_payment_confirmation($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 23 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_payment_confirmation($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `bank_account` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('bank_account',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('bank_account',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'movetrash'){
              $this->_ispermit($permit->isdelete);
              $trash = $this->trashData('bank_account',$this->segs[5]);
              if ($trash){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movedraft'){
              $this->_ispermit($permit->isupdate);
              $draft = $this->draftData('bank_account',$this->segs[5]);
              if ($draft){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'movepublish'){
              $this->_ispermit($permit->isupdate);
              $publish = $this->publishData('bank_account',$this->segs[5]);
              if ($publish){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere = 'and bank_account.hapus = 1';
            $data['statuspage'] = 'trash';
          }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere = 'and bank_account.hapus = 0 and bank_account.draft = 1';
            $data['statuspage'] = 'draft';
          }else {
            $sqlwhere = "and bank_account.hapus = 0 and bank_account.draft = 0 ";
            $data['statuspage'] = 'publish';
          }
          $data_rec = $this->db->query('SELECT * FROM `bank_account` where 1=1 '.$sqlwhere.' order by posisi asc')->result_array();  
          $data_count = $this->db->query('SELECT count(bank_account.id) as jumlah FROM `bank_account` where 1=1 '.$sqlwhere.' order by posisi asc')->result();        
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = $data_count[0]->jumlah;
          $data['count_publish']    = $this->countPublishNewBase('bank_account',"",$id);
          $data['count_draft']      = $this->countDraftNewBase('bank_account',"",$id);
          $data['count_trash']      = $this->countTrashNewBase('bank_account',"",$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['current_menu']    = $link;
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'bank_account';
          $data['url_module']    = $this->segs[2];
        $this->load->view('cms/main.php',$data); 
    }
    function _save_payment_confirmation($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            if (count($_POST['pages']) > 0){
                $otherpages = implode(',', $_POST['pages']);
            }
        }
        $title    = $this->input->post('title');
        $bank_account_number    = $this->input->post('bank_account_number');
        $bank_account_name    = $this->input->post('bank_account_name');
        $description    = $this->input->post('content');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('bank_account');
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        if($step1 == TRUE AND $success == TRUE){
        $data = array();
        $inputdata = array(            
          'title'      => $title, 
          'parent_menu'      => $parent,  
          'sister'     => $sister,
          'cretime'    => date('Y-m-d H:i:s'),
          'bank_account_number' => $bank_account_number,
          'bank_account_name' => $bank_account_name,
          'description' => $description,
          'idmenu'    => $id,
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('bank_account', $inputdata);
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'title'   => $title,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_payment_confirmation($id,$parent){
         //echo '<pre>';
         //print_r($_POST);
        // print_r($_FILES);
        // die();
        //$id      = $this->input->post('id');
        $title   = $this->input->post('title');
        $bank_account_number   = $this->input->post('bank_account_number');
        $content = $this->input->post('content');
        $bank_account_name    = $this->input->post('bank_account_name');
        $description    = $this->input->post('content');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($title) AND $title != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Title : Must be filled</li>";
        }
        $s = 1;
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(  
              'title'      => $title, 
              'bank_account_number'    => $bank_account_number, 
              'description' => $content,
              'bank_account_name' => $bank_account_name,
              'description' => $description,
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );     
            $this->db->where('id', $this->input->post('id'));
            $edit = $this->db->update('bank_account', $editdata); 
          }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'title'    => $title,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function kategorivideo($id,$parent,$title){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_kategorivideo($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 30 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_kategorivideo($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `kategori_video` WHERE sister = '.$this->segs[5])->result_array(); 
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 30 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('kategori_video',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('kategori_video',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('kategori_video',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          $table = "kategori_video";
            $sqlwhere = "and $table.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT kategori_video.id,kategori_video.title,kategori_video.hidden,kategori_video.deleted,kategori_video.sister,kategori_video.thumb,kategori_video.pic, pages.title as pages FROM `kategori_video` LEFT JOIN pages ON kategori_video.idpages=pages.id  where kategori_video.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_video.idmenu='.$id.' order by kategori_video.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT kategori_video.id,kategori_video.title,kategori_video.sister,kategori_video.thumb,kategori_video.pic, pages.title as pages FROM `kategori_video` LEFT JOIN pages ON kategori_video.idpages=pages.id where kategori_video.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_video.idmenu='.$id.' order by kategori_video.posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT kategori_video.id,kategori_video.title,kategori_video.hidden,kategori_video.deleted,kategori_video.sister,kategori_video.thumb,kategori_video.pic, pages.title as pages FROM `kategori_video` LEFT JOIN pages ON kategori_video.idpages=pages.id  where kategori_video.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_video.idmenu='.$id.' AND kategori_video.title LIKE "%'.$_GET["keyword"].'%" order by kategori_video.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT kategori_video.id,kategori_video.title,kategori_video.sister,kategori_video.thumb,kategori_video.pic, pages.title as pages FROM `kategori_video` LEFT JOIN pages ON kategori_video.idpages=pages.id where kategori_video.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_video.idmenu='.$id.' AND kategori_video.title LIKE "%'.$_GET["keyword"].'%"  order by kategori_video.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('artikel',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('artikel',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('artikel',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'kategori_video';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_kategorifoto($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = implode(',', $_POST['pages']);
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('kategori_foto');
        $posisi = $this->_nextPosisi('kategori_foto',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'uploads/kategori_foto/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
          if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `kategori_foto` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                $newlink = $link[$lang];
                }
          }
            $picname   = "";
            $thumbname = "";
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'kategori_foto_'.$random_digit."_".$file_edit;
            $folder       = 'kategori_foto';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 310;
            $height       = 207;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(            
              'idpages' => $idpages,
              'otherpages'  => $otherpages, 
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'link_ori'    => $link[$lang], 
              'link'        => $newlink,  
              'description' => $content[$lang],    
              'pic'         => $filename, 
              'idmenu'      => $id,  
              'parent_menu' => $parent,  
              'sister'      => $sister,
              'posisi'      => $posisi,
              'cretime'     => date('Y-m-d H:i:s'),
              'creby'       => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('kategori_foto', $inputdata);
          }
          $filename = "";
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_kategorifoto(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idpages = $this->input->post('mainpages');
        $otherpages = implode(',', $_POST['pages']);
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $link    = $this->input->post('link');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('kategori_foto');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Pages : Must be filled</li>";
        }
        $s = 1;
        foreach ($idlang as $lang) {
          if ($link[$lang] != ""){
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `kategori_foto` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
          }
          $picname   = $this->input->post('oldpic'.$lang);
          $thumbname = $this->input->post('oldthumb'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'kategori_foto_'.$random_digit."_".$file_edit;
            $folder       = 'kategori_foto';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 310;
            $height       = 207;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'idpages'    => $idpages, 
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link_ori'    => $link[$lang], 
              'link'        => $newlink,  
              'pic'        => $picname,
              'thumb'      => $thumbname, 
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            //print_r($id[$lang]);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('kategori_foto', $editdata); 
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages'  => $idpages,
            'title'    => $title,
            'link'     => $link,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function kategorifoto($id,$parent,$title){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_kategorifoto($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 32 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_kategorifoto($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `kategori_foto` WHERE sister = '.$this->segs[5])->result_array(); 
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 32 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `kategori_foto` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('kategori_foto',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('kategori_foto',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('kategori_foto',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          $table = "kategori_foto";
            $sqlwhere = "and $table.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT kategori_foto.id,kategori_foto.title,kategori_foto.hidden,kategori_foto.deleted,kategori_foto.sister,kategori_foto.thumb,kategori_foto.pic, pages.title as pages FROM `kategori_foto` LEFT JOIN pages ON kategori_foto.idpages=pages.id  where kategori_foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_foto.idmenu='.$id.' order by kategori_foto.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT kategori_foto.id,kategori_foto.title,kategori_foto.sister,kategori_foto.thumb,kategori_foto.pic, pages.title as pages FROM `kategori_foto` LEFT JOIN pages ON kategori_foto.idpages=pages.id where kategori_foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_foto.idmenu='.$id.' order by kategori_foto.posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT kategori_foto.id,kategori_foto.title,kategori_foto.hidden,kategori_foto.deleted,kategori_foto.sister,kategori_foto.thumb,kategori_foto.pic, pages.title as pages FROM `kategori_foto` LEFT JOIN pages ON kategori_foto.idpages=pages.id  where kategori_foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_foto.idmenu='.$id.' AND kategori_foto.title LIKE "%'.$_GET["keyword"].'%" order by kategori_foto.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT kategori_foto.id,kategori_foto.title,kategori_foto.sister,kategori_foto.thumb,kategori_foto.pic, pages.title as pages FROM `kategori_foto` LEFT JOIN pages ON kategori_foto.idpages=pages.id where kategori_foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND kategori_foto.idmenu='.$id.' AND kategori_foto.title LIKE "%'.$_GET["keyword"].'%"  order by kategori_foto.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('kategori_foto',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('kategori_foto',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('kategori_foto',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'kategori_foto';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function produk($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_produk($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 34 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_produk($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `produk` WHERE sister = '.$this->segs[5])->result_array(); 
                $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 34 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
                $data['otherpages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 75 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `produk` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('produk',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('produk',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('produk',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          $table = "produk";
            $sqlwhere = "and $table.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT produk.id,produk.title,produk.hidden,produk.deleted,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister  where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND produk.idmenu='.$id.' order by produk.posisi DESC LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT produk.id,produk.title,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.' '.$sqlwhere.' AND produk.idmenu='.$id.' order by produk.posisi DESC')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT produk.id,produk.title,produk.hidden,produk.deleted,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister  where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.'  '.$sqlwhere.' AND produk.idmenu='.$id.' AND produk.title LIKE "%'.$_GET["keyword"].'%" order by produk.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT produk.id,produk.title,produk.sister,produk.thumb,produk.pic, pages.title as pages FROM `produk` LEFT JOIN pages ON produk.sisterpages=pages.sister where produk.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.'  '.$sqlwhere.' AND produk.idmenu='.$id.' AND produk.title LIKE "%'.$_GET["keyword"].'%"  order by produk.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['current_menu']    = $link;
          $data['count_publish']    = $this->countPublishNewBase('produk',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('produk',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('produk',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'produk';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_produk($id,$parent){
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            $otherpages = implode(',', $_POST['pages']);
        }
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $short_description   = $this->input->post('short_description');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $pic2     = $this->input->post('pic2');
        $icon     = $this->input->post('icon');
        $product_detail = $this->input->post('product_detail');
        $shipping_return = $this->input->post('shipping_return');
        $price = $this->input->post('price');
        $weight = $this->input->post('weight');
        $linkyoutube = $this->input->post('linkyoutube');
        //echo "<pre>";
        //print_r($_POST);
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('produk');
        $posisi = $this->_nextPosisi('produk',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Main Pages : Must be filled</li>";
        }
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'uploads/produk/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
          if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `produk` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                $newlink = $link[$lang];
                }
          }
          $picname   = "";
          $thumbname = "";
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'produk_'.$random_digit."_".$newlink;
                $folder       = 'produk';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 289;
                $height       = 400;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                  $picname   = $hasilupload['filename'];
                  $thumbname = $hasilupload['thumbname'];
                }else{
                  $success = $hasilupload['success'];
                  $step1   = $hasilupload['step1'];
                  $notice  .= $hasilupload['notice'];
                  $picname = "";
                }
          }
          $picname2   = "";
          $thumbname2 = "";
          if ($step1 == TRUE AND isset($_FILES['picyoutube'.$lang]['name']) AND $_FILES['picyoutube'.$lang]['name'] != '') {
                $filenameold2   = strtolower($_FILES['picyoutube'.$lang]['name']);
                $file_edit2     = str_replace(" ","_",$filenameold2);
                $random_digit2  = rand(000,999);
                $new_file_name2 = 'popup_'.$random_digit2."_".$newlink;
                $folder       = 'produk';
                $filename2     = $new_file_name2;
                $fieldname    = 'picyoutube'.$lang;
                $resizable    = TRUE;
                $width        = 484;
                $height       = 337;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                  $picname2   = $hasilupload['filename'];
                  $thumbname2 = $hasilupload['thumbname'];
                }else{
                  $success = $hasilupload['success'];
                  $step1   = $hasilupload['step1'];
                  $notice  .= $hasilupload['notice'];
                  $picname2 = "";
                }
          }
          $picname3   = "";
          $thumbname3 = "";
          if ($step1 == TRUE AND isset($_FILES['icon'.$lang]['name']) AND $_FILES['icon'.$lang]['name'] != '') {
                $filenameold3   = strtolower($_FILES['icon'.$lang]['name']);
                $file_edit2     = str_replace(" ","_",$filenameold3);
                $random_digit3  = rand(000,999);
                $new_file_name3 = 'icon_'.$random_digit3."_".$newlink;
                $folder       = 'produk';
                $filename2     = $new_file_name3;
                $fieldname    = 'icon'.$lang;
                $resizable    = TRUE;
                $width        = 401;
                $height       = 400;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 401, 
                    'height' => 400
                ); 
                $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                  $picname3   = $hasilupload['filename'];
                  $thumbname3 = $hasilupload['thumbname'];
                }else{
                  $success = $hasilupload['success'];
                  $step1   = $hasilupload['step1'];
                  $notice  .= $hasilupload['notice'];
                  $picname3 = "";
                }
          }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(            
              'sisterpages' => $idpages,
              'otherpages'  => $otherpages, 
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'link_ori'    => $this->slugify($title[$lang]), 
              'link'        => $newlink,  
              'description' => $content[$lang],    
              'short_description' => $short_description[$lang],
              'product_detail' => $product_detail[$lang],
              'shipping_return' => $shipping_return[$lang],
              'linkyoutube' => $linkyoutube[$lang],
              'pic'         => $picname, 
              'price' => $price,
              'weight' => $weight,
              'pic2'         => $picname2, 
              'idmenu'      => $id,  
              'parent_menu' => $parent,  
              'sister'      => $sister,
              'posisi'      => $posisi,
              'cretime'     => date('Y-m-d H:i:s'),
              'creby'       => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('produk', $inputdata);
          }
          $filename = "";
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_produk(){
         //echo '<pre>';
         //print_r($_POST);
         //print_r($_FILES);
         //die();
        $id      = $this->input->post('id');
        $idpages = $this->input->post('mainpages');
        $otherpages = "";
        if (isset($_POST['pages'])){
            $otherpages = implode(',', $_POST['pages']);
        }
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $link    = $this->input->post('link');
        $pic     = $this->input->post('pic1');
        $pic2     = $this->input->post('pic21');
        $icon     = $this->input->post('icon');
        $linkkalbe = $this->input->post('linkkalbe');
        $draft   = $this->input->post('draft');
        $short_description   = $this->input->post('short_description');
        $content   = $this->input->post('content');
        $product_detail = $this->input->post('product_detail');
        $shipping_return = $this->input->post('shipping_return');
        $linkyoutube = $this->input->post('linkyoutube');
        $price = $this->input->post('price');
        $weight = $this->input->post('weight');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('produk');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        if(isset($idpages) AND $idpages != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Pages : Must be filled</li>";
        }
        $s = 1;
        foreach ($idlang as $lang) {
          if ($link[$lang] != ""){
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `produk` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$id[$lang])->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang]."-".$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
          }
          $picname   = $this->input->post('oldpic'.$lang);
          $picname2   = $this->input->post('oldpic2'.$lang);
          $icon   = $this->input->post('icon'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
            //echo strtolower($_FILES['pic2'.$lang]['name']);
            $filenameold2   = strtolower($_FILES['pic2'.$lang]['name']);
            $file_edit2     = str_replace(" ","_",$filenameold2);
            $new_file_name2 = 'produk_detail_'.$newlink;
            $folder       = 'produk';
            $filename2     = $new_file_name2;
            $fieldname    = 'pic2'.$lang;
            $resizable    = TRUE;
            $width        = 693;
            $height       = 382;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename2,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname2   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname2 = "";
            }
          }
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'produk_'.$newlink;
            $folder       = 'produk';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 289;
            $height       = 400;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if ($step1 == TRUE AND isset($_FILES['icon'.$lang]['name']) AND $_FILES['icon'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['icon'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'icon_produk_'.$newlink;
            $folder       = 'produk';
            $filename     = $new_file_name;
            $fieldname    = 'icon'.$lang;
            $resizable    = TRUE;
            $width        = 401;
            $height       = 400;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 401, 
                'height' => 401
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $icon   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $icon = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'sisterpages'    => $idpages, 
              'otherpages'    => $otherpages, 
              'idlanguage' => $lang, 
              'title'      => $title[$lang], 
              'link_ori'    => $this->slugify($title[$lang]), 
              'link'        => $newlink,
              'product_detail' => $product_detail[$lang],
              'shipping_return' => $shipping_return[$lang],
              'linkyoutube' => $linkyoutube[$lang],
              'pic'        => $picname,
              'pic2'        => $picname2,
              'icon'        => $icon,
              'short_description' => $short_description[$lang],
              'description' => $content[$lang],
              'price' => $price,
              'weight' => $weight,
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            //print_r($editdata);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('produk', $editdata); 
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages'  => $idpages,
            'title'    => $title,
            'link'     => $link,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function graphic_orac($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_graphic_orac($id,$parent);
                $data['status'] = $status;
              }
              $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 34 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_graphic_orac($id,$parent);
                  $data['status'] = $status;
                }  
                //echo 'SELECT * FROM `graphic_order` WHERE sister = '.$this->segs[5];
                $data_rec = $this->db->query('SELECT * FROM `graphic_orac` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `produk` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('graphic_orac',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('graphic_orac',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('graphic_orac',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          $table = "graphic_orac";
            $sqlwhere = "and $table.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            //echo 'SELECT graphic_orac.title,graphic_orac.hidden,graphic_orac.sister FROM `graphic_orac` where graphic_orac.idlanguage = '.$deflang.' '.$sqlwhere.' AND graphic_orac.idmenu='.$id.' order by graphic_orac.posisi ASC LIMIT '.$start.','.$limit;
            $data_rec = $this->db->query('SELECT graphic_orac.title,graphic_orac.hidden,graphic_orac.sister FROM `graphic_orac` where graphic_orac.idlanguage = '.$deflang.' '.$sqlwhere.' AND graphic_orac.idmenu='.$id.' order by graphic_orac.posisi ASC LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT graphic_orac.title FROM `graphic_orac`  where graphic_orac.idlanguage = '.$deflang.' '.$sqlwhere.' AND graphic_orac.idmenu='.$id.' order by graphic_orac.posisi ASC')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT graphic_orac.title, pages.title as pages FROM `graphic_orac` LEFT JOIN pages ON graphic_orac.sisterpages=pages.sister  where graphic_orac.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.'  '.$sqlwhere.' AND graphic_orac.idmenu='.$id.' AND graphic_orac.title LIKE "%'.$_GET["keyword"].'%" order by graphic_orac.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT graphic_orac.title, pages.title as pages FROM `graphic_orac` LEFT JOIN pages ON graphic_orac.sisterpages=pages.sister where graphic_orac.idlanguage = '.$deflang.' AND pages.idlanguage = '.$deflang.'  '.$sqlwhere.' AND graphic_orac.idmenu='.$id.' AND graphic_orac.title LIKE "%'.$_GET["keyword"].'%"  order by graphic_orac.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['current_menu']    = $link;
          $data['count_publish']    = $this->countPublishNewBase('graphic_orac',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('graphic_orac',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('graphic_orac',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'graphic_orac';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
          $data['current_menu'] = $link;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_graphic_orac($id,$parent){
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $orac    = $this->input->post('orac');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        //echo "<pre>";
        //print_r($_POST);
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('graphic_orac');
        $posisi = $this->_nextPosisi('graphic_orac',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        if(isset($title) AND $title != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Title : Must be filled</li>";
        }
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'uploads/graphic_orac/'; //Declaring Path for uploaded images
        $new_file_name = "";
        foreach ($idlang as $lang) {
          $picname   = "";
          $thumbname = "";
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'produk_'.$random_digit."_".$file_edit;
                $folder       = 'graphic_orac';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = TRUE;
                $width        = 122;
                $height       = 122;
                $create_thumb = array(            
                    'status' => FALSE,
                    'width'  => 298, 
                    'height' => 169
                ); 
                $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                  $picname   = $hasilupload['filename'];
                  $thumbname = $hasilupload['thumbname'];
                }else{
                  $success = $hasilupload['success'];
                  $step1   = $hasilupload['step1'];
                  $notice  .= $hasilupload['notice'];
                  $picname = "";
                }
          }
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(     
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'pic'         => $picname,
              'idmenu'      => $id,
              'orac'       => $orac[$lang],
              'sister'      => $sister,
              'posisi'      => $posisi,
              'cretime'     => date('Y-m-d H:i:s'),
              'creby'       => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('graphic_orac', $inputdata);
          }
          $filename = "";
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idlang'  => $idlang,
            'title'   => $title
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_graphic_orac(){
         //echo '<pre>';
         //print_r($_POST);
         //print_r($_FILES);
         //die();
        $id      = $this->input->post('id');
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $orac    = $this->input->post('orac');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        if(isset($title) AND $title != ''){
        }else{
          $step1   = FALSE;
          $success = FALSE;
          $notice .= "<li>Title : Must be filled</li>";
        }
        $s = 1;
        foreach ($idlang as $lang) {
          $picname   = $this->input->post('oldpic'.$lang);
          if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'graphic_orac_'.$file_edit;
            $folder       = 'graphic_orac';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 122;
            $height       = 122;
            $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
            }else{
              $success = $hasilupload['success'];
              $step1   = $hasilupload['step1'];
              $notice  .= $hasilupload['notice'];
              $picname = "";
            }
          }
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'idlanguage'  => $lang, 
              'title'       => $title[$lang], 
              'pic'         => $picname,
              'orac'       => $orac[$lang]
            );   
            //print_r($editdata);  
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('graphic_orac', $editdata); 
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'title'    => $title,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function _save_postlist($id,$parent){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $metatitle    = $this->input->post('metatitle');
        $show     = $this->input->post('show');
        $metadescription    = $this->input->post('metadescription');
        $cat     = $this->input->post('idmodule');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('artikel');
        $posisi = $this->_nextPosisi('artikel',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/artikel/'; //Declaring Path for uploaded images
        $new_file_name = "";
        $new_file_name2 = "";
        foreach ($idlang as $lang) {
            if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `artikel` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                    $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                    $newlink = $link[$lang];
                }
            }else{
                $newlink = "";
            }
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/thumb_'.$new_file_name, 78, 77);
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/'.$new_file_name, 345, 386);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if ($step1 == TRUE AND isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name2);
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                'idlanguage'  => $lang, 
                'title'       => $title[$lang], 
                'link_ori'    => $link[$lang], 
                'link'        => $newlink,  
                'description' => $content[$lang],    
                'pic'         => $new_file_name,
                'pic2'        => $new_file_name2,
                'thumb'       => $thumb_filenya,  
                'idmenu'      => $id,  
                'parent_menu' => $parent,  
                'show'        => $show[$lang],
                'sister'      => $sister,
                'posisi'      => $posisi,
                'cretime'     => date('Y-m-d H:i:s'),
                'crdate_set'  => $tgl_modif,
                'meta_title'  => $metatitle[$lang],
                'meta_description' => $metadescription[$lang],
                'creby'       => $this->session->userdata('username'),
                'cat'       => $cat
                );     
                $saved = $this->db->insert('artikel', $inputdata);
                $new_file_name = "";
                $new_file_name2 = "";
                $thumb_filenya = "";
            }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_postlist(){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $show     = $this->input->post('show');
        $cat     = $this->input->post('idmodule');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        $metatitle    = $this->input->post('metatitle');
        $metadescription    = $this->input->post('metadescription');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $idnya   = $this->input->post('id'.$lang);
            $new_file_name   = $this->input->post('oldpic'.$lang);
            $new_file_name2   = $this->input->post('oldpic2'.$lang);
            $thumb_filenya = $this->input->post('oldthumb'.$lang);
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `artikel` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$idnya)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
            if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/thumb_'.$new_file_name, 78, 77);
                    $this->resize(FCPATH.'/uploads/artikel/'.$new_file_name, FCPATH.'/uploads/artikel/'.$new_file_name, 345, 386);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if (isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/artikel/'.$new_file_name2);
            }
            if($step1 == TRUE AND $success == TRUE){
                $editdata = array(   
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,  
                    'description' => $content[$lang],    
                    'pic'         => $new_file_name,
                    'pic2'        => $new_file_name2,
                    'show'        => $show[$lang],
                    'thumb'       => $thumb_filenya, 
                    'meta_title'  => $metatitle[$lang],
                    'meta_description' => $metadescription[$lang],
                    'cretime'     => date('Y-m-d H:i:s'),
                    'crdate_set'  => $tgl_modif,
                    'creby'       => $this->session->userdata('username'),
                    'cat'         => $cat
                );   
                $this->db->where('id', $idnya);
                $edit = $this->db->update('artikel', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _adsbanner_edit(){
        $idlang   = $this->input->post('idlang');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $picname   = $this->input->post('oldpic'.$lang);
            $idnya   = $this->input->post('id'.$lang);
            if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'sidebar_global_'.$lang.date("ymdHis")."_".$file_edit;
                $folder       = 'ads_article';
                $filename     = $new_file_name;
                $fieldname    = 'pic'.$lang;
                $resizable    = FALSE;
                $width        = 310;
                $height       = 207;
                $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname   = $hasilupload['filename'];
                }else{
                    $success = $hasilupload['success'];
                    $notice  .= $hasilupload['notice'];
                    $picname = "";
                }
            }
                $editdata = array(  
                    'use_side_banner'      => $_POST["use_side_banner"], 
                    'link_ads_banner'      => $_POST["link"][$lang], 
                    'ads_side_banner'      => $picname
                );     
                $this->db->where('id', $idnya);
                $edit = $this->db->update('artikel', $editdata);
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _adsbanner_top_edit(){
        $idlang   = $this->input->post('idlang');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
                    $picname   = $this->input->post('oldpic'.$lang);
                    $picname2   = $this->input->post('oldpic_m'.$lang);
                    $idnya   = $this->input->post('id'.$lang);
                    if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_'.$lang.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads_article';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname = "";
                        }
                    }
                    if (isset($_FILES['pic_m'.$lang]['name']) AND $_FILES['pic_m'.$lang]['name'] != '') {
                        $filenameold   = strtolower($_FILES['pic_m'.$lang]['name']);
                        $file_edit     = str_replace(" ","_",$filenameold);
                        $random_digit  = rand(000,999);
                        $new_file_name = 'sidebar_global_top_m_'.$lang.date("ymdHis")."_".$file_edit;
                        $folder       = 'ads_article';
                        $filename     = $new_file_name;
                        $fieldname    = 'pic_m'.$lang;
                        $resizable    = FALSE;
                        $width        = 310;
                        $height       = 207;
                        $create_thumb = array(            
                        'status' => FALSE,
                        'width'  => 298, 
                        'height' => 169
                    ); 
                    $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                        if($hasilupload['status'] == TRUE){
                            $picname2   = $hasilupload['filename'];
                        }else{
                            $success = $hasilupload['success'];
                            $notice  .= $hasilupload['notice'];
                            $picname2 = "";
                        }
                    }
                    $editdata = array(  
                        'use_top_banner'      => $_POST["use_top_banner"], 
                        'link_ads_banner_top'      => $_POST["link"][$lang], 
                        'ads_banner_top'      => $picname,
                        'ads_banner_top_m'      => $picname2
                    );     
                    $this->db->where('id', $idnya);
                    $edit = $this->db->update('artikel', $editdata);
                }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _adsbanner_bottom_edit(){
        $idlang   = $this->input->post('idlang');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $picname   = $this->input->post('oldpic_bottom'.$lang);
            $picname2   = $this->input->post('oldpic_m_bottom'.$lang);
            $idnya   = $this->input->post('id'.$lang);
            if (isset($_FILES['pic_bottom'.$lang]['name']) AND $_FILES['pic_bottom'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic_bottom'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'sidebar_global_bottom_'.$lang.date("ymdHis")."_".$file_edit;
                $folder       = 'ads_article';
                $filename     = $new_file_name;
                $fieldname    = 'pic_bottom'.$lang;
                $resizable    = FALSE;
                $width        = 310;
                $height       = 207;
                $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname   = $hasilupload['filename'];
                }else{
                    $success = $hasilupload['success'];
                    $notice  .= $hasilupload['notice'];
                    $picname = "";
                }
            }
            if (isset($_FILES['pic_m_bottom'.$lang]['name']) AND $_FILES['pic_m_bottom'.$lang]['name'] != '') {
                $filenameold   = strtolower($_FILES['pic_m_bottom'.$lang]['name']);
                $file_edit     = str_replace(" ","_",$filenameold);
                $random_digit  = rand(000,999);
                $new_file_name = 'sidebar_global_bottom_m_'.$lang.date("ymdHis")."_".$file_edit;
                $folder       = 'ads_article';
                $filename     = $new_file_name;
                $fieldname    = 'pic_m_bottom'.$lang;
                $resizable    = FALSE;
                $width        = 310;
                $height       = 207;
                $create_thumb = array(            
                'status' => FALSE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
                if($hasilupload['status'] == TRUE){
                    $picname2   = $hasilupload['filename'];
                }else{
                    $success = $hasilupload['success'];
                    $notice  .= $hasilupload['notice'];
                    $picname2 = "";
                }
            }
            $editdata = array(  
                'use_bottom_banner'      => $_POST["use_bottom_banner"], 
                'link_ads_banner_bottom'      => $_POST["link"][$lang], 
                'ads_banner_bottom'      => $picname,
                'ads_banner_bottom_m'      => $picname2
            );     
            $this->db->where('id', $idnya);
            $edit = $this->db->update('artikel', $editdata);
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function postlist($id,$parent,$title){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_postlist($id,$parent);
                $data['status'] = $status;
              }
              $data['cat'] = $this->db->query('SELECT * FROM `kategori_artikel` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_postlist($id,$parent);
                  $data['status'] = $status;
                }
                $data['cat'] = $this->db->query('SELECT * FROM `kategori_artikel` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `artikel` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'adsbanner'){
                if ( $_POST){
                    if(isset($_POST["sidebar_ads_global"])){
                        $status = $this->_adsbanner_edit();
                        $data['status'] = $status;
                    }
                    if(isset($_POST["sidebar_ads_global_top"])){
                        $status = $this->_adsbanner_top_edit();
                        $data['status'] = $status;
                    }
                    if(isset($_POST["sidebar_ads_global_bottom"])){
                        $status = $this->_adsbanner_bottom_edit();
                        $data['status'] = $status;
                    }
                }
                if (isset($_GET["removeside"])){
                    $editdata = array(  
                        'link_ads_banner'      => '', 
                        'ads_side_banner'      => ''
                    );     
                    $this->db->where('sister', $this->segs[5]);
                    $edit = $this->db->update('artikel', $editdata);
                }
                if (isset($_GET["removetop"])){
                    $editdata = array(  
                        'link_ads_banner_top'      => '', 
                        'ads_banner_top'      => '',
                        'ads_banner_top_m' => ''
                    );     
                    $this->db->where('sister', $this->segs[5]);
                    $edit = $this->db->update('artikel', $editdata);
                }
                if (isset($_GET["removebottom"])){
                    $editdata = array(  
                        'link_ads_banner_bottom'      => '', 
                        'ads_banner_bottom'      => '',
                        'ads_banner_bottom_m' => ''
                    );     
                    $this->db->where('sister', $this->segs[5]);
                    $edit = $this->db->update('artikel', $editdata);
                }
                $data['cat'] = $this->db->query('SELECT * FROM `kategori_artikel` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND draft = 0 AND hapus = 0 ORDER BY posisi asc')->result_array();
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `artikel` WHERE sister = '.$this->segs[5])->result_array();
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `banner` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'delete'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $deleted = $this->deleteData('artikel',$this->segs[5]);
                if ($deleted){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('artikel',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('artikel',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('artikel',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('artikel',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
            $this->_ispermit($permit->isview);
            $datenow = date('Y-m-d H:i:s');
            $sqlwhere = "and artikel.deleted = 0 and artikel.hapus=0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if(isset($_GET["show"])){
                $limit = 1000000;
            }
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT artikel.id,artikel.title,artikel.hidden,artikel.deleted,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.idmenu='.$id.' order by artikel.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT artikel.id,artikel.title,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.idmenu='.$id.' order by artikel.posisi desc')->result_array();
            if (isset($_GET['cari']))
            {
                $data_rec = $this->db->query('SELECT artikel.id,artikel.title,artikel.hidden,artikel.deleted,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.title LIKE "%'.$_GET["keyword"].'%" AND artikel.idmenu='.$id.' order by artikel.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT artikel.id,artikel.title,artikel.sister,artikel.thumb,artikel.pic, pages.title as pages,kategori_artikel.title as title_cat FROM `artikel` LEFT JOIN pages ON artikel.sisterpages=pages.sister  LEFT JOIN kategori_artikel ON kategori_artikel.sister=artikel.cat AND kategori_artikel.idlanguage='.$deflang.' where artikel.idlanguage = '.$deflang.' '.$sqlwhere.' AND artikel.idmenu='.$id.' AND artikel.title LIKE "%'.$_GET["keyword"].'%" order by artikel.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }        
            if (count($query_string) > 0)
            {
                $config['suffix'] = '&' . http_build_query($query_string, '', "&");
                $config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&");
            } 
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
            $data['rec']        = $data_rec;
            $data['act']        = 'default';
            $data['jumlahdata'] = count($data_rec_count);;
            $data['count_publish']    = $this->countPublishNewBase('artikel',$deflang,$id);
            $data['count_draft']      = $this->countDraftNewBase('artikel',$deflang,$id);
            $data['count_trash']      = $this->countTrashNewBase('artikel',$deflang,$id);
        }
          if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
        $data['active']  = $parent;
        $data['active2'] = $id;
        $data['page']    = 'postlist';
        $data['url_module']    = $this->segs[2];
        $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_video($id,$parent){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $cat     = $this->input->post('idmodule');
        $youtube     = $this->input->post('youtube');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('video');
        $posisi = $this->_nextPosisi('video',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/video/'; //Declaring Path for uploaded images
        $new_file_name = "";
        $new_file_name2 = "";
        foreach ($idlang as $lang) {
            if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `video` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                    $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                    $newlink = $link[$lang];
                }
            }else{
                $newlink = "";
            }
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/video/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/video/'.$new_file_name, FCPATH.'/uploads/video/'.$new_file_name, 310, 207);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if ($step1 == TRUE AND isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/video/'.$new_file_name2)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/video/'.$new_file_name2, FCPATH.'/uploads/video/'.$new_file_name2, 790, 400);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                'idlanguage'  => $lang, 
                'title'       => $title[$lang], 
                'link_ori'    => $link[$lang], 
                'link'        => $newlink,  
                'description' => $content[$lang],    
                'pic'         => $new_file_name,
                'pic2'        => $new_file_name2,
                'thumb'       => $thumb_filenya,  
                'link_youtube'=> $youtube[$lang],  
                'idmenu'      => $id,  
                'parent_menu' => $parent,  
                'sister'      => $sister,
                'posisi'      => $posisi,
                'cretime'     => date('Y-m-d H:i:s'),
                'crdate_set'  => $tgl_modif,
                'creby'       => $this->session->userdata('username'),
                'cat'       => $cat
                );     
                $saved = $this->db->insert('video', $inputdata);
                $new_file_name = "";
                $new_file_name2 = "";
                $thumb_filenya = "";
            }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_video(){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $cat     = $this->input->post('idmodule');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        $youtube     = $this->input->post('youtube');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $idnya   = $this->input->post('id'.$lang);
            $new_file_name   = $this->input->post('oldpic'.$lang);
            $new_file_name2   = $this->input->post('oldpic2'.$lang);
            $thumb_filenya = $this->input->post('oldthumb'.$lang);
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `video` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$idnya)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
            if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/video/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/video/'.$new_file_name, FCPATH.'/uploads/video/'.$new_file_name, 310, 207);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if (isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/video/'.$new_file_name2)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/video/'.$new_file_name2, FCPATH.'/uploads/video/'.$new_file_name2, 790, 400);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                $editdata = array(   
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,  
                    'description' => $content[$lang],    
                    'pic'         => $new_file_name,
                    'pic2'        => $new_file_name2,
                    'thumb'       => $thumb_filenya, 
                    'link_youtube'=> $youtube[$lang],  
                    'cretime'     => date('Y-m-d H:i:s'),
                    'crdate_set'  => $tgl_modif,
                    'creby'       => $this->session->userdata('username'),
                    'cat'         => $cat
                );   
                $this->db->where('id', $idnya);
                $edit = $this->db->update('video', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function video($id,$parent,$title){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_video($id,$parent);
                $data['status'] = $status;
              }
              $data['cat'] = $this->db->query('SELECT * FROM `kategori_video` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND hidden = 0 AND deleted = 0 ORDER BY posisi asc')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_video($id,$parent);
                  $data['status'] = $status;
                }
                $data['cat'] = $this->db->query('SELECT * FROM `kategori_video` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND hidden = 0 AND deleted = 0 ORDER BY posisi asc')->result_array();
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `video` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `video` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('video',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('video',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('video',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('video',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
            $sqlwhere = "and video.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT video.id,video.title,video.hidden,video.deleted,video.sister,video.thumb,video.pic, pages.title as pages,kategori_video.title as title_cat FROM `video` LEFT JOIN pages ON video.idpages=pages.id  LEFT JOIN kategori_video ON kategori_video.sister=video.cat AND kategori_video.idlanguage='.$deflang.' where video.idlanguage = '.$deflang.' '.$sqlwhere.' AND video.idmenu='.$id.' order by video.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT video.id,video.title,video.sister,video.thumb,video.pic, pages.title as pages,kategori_video.title as title_cat FROM `video` LEFT JOIN pages ON video.idpages=pages.id  LEFT JOIN kategori_video ON kategori_video.sister=video.cat AND kategori_video.idlanguage='.$deflang.' where video.idlanguage = '.$deflang.' '.$sqlwhere.' AND video.idmenu='.$id.' order by video.posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT video.id,video.title,video.hidden,video.deleted,video.sister,video.thumb,video.pic, pages.title as pages,kategori_video.title as title_cat FROM `video` LEFT JOIN pages ON video.idpages=pages.id  LEFT JOIN kategori_video ON kategori_video.sister=video.cat AND kategori_video.idlanguage='.$deflang.' where video.idlanguage = '.$deflang.' '.$sqlwhere.' AND video.idmenu='.$id.' AND video.title LIKE  "%'.$_GET["keyword"].'%" order by video.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT video.id,video.title,video.sister,video.thumb,video.pic, pages.title as pages,kategori_video.title as title_cat FROM `video` LEFT JOIN pages ON video.idpages=pages.id  LEFT JOIN kategori_video ON kategori_video.sister=video.cat AND kategori_video.idlanguage='.$deflang.' where video.idlanguage = '.$deflang.' '.$sqlwhere.' AND video.idmenu='.$id.' AND video.title LIKE  "%'.$_GET["keyword"].'%" order by video.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('video',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('video',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('video',$deflang,$id);
        }
          if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'video';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_foto($id,$parent){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $cat     = $this->input->post('idmodule');
        $youtube     = $this->input->post('youtube');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('foto');
        $posisi = $this->_nextPosisi('foto',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/foto/'; //Declaring Path for uploaded images
        $new_file_name = "";
        $new_file_name2 = "";
        foreach ($idlang as $lang) {
            if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `foto` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                    $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                    $newlink = $link[$lang];
                }
            }else{
                $newlink = "";
            }
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/foto/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/foto/'.$new_file_name, FCPATH.'/uploads/foto/'.$new_file_name, 800, 631);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if ($step1 == TRUE AND isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/foto/'.$new_file_name2)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/foto/'.$new_file_name2, FCPATH.'/uploads/foto/'.$new_file_name2, 790, 400);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                'idlanguage'  => $lang, 
                'title'       => $title[$lang], 
                'link_ori'    => $link[$lang], 
                'link'        => $newlink,  
                'description' => $content[$lang],    
                'pic'         => $new_file_name,
                'pic2'        => $new_file_name2,
                'thumb'       => $thumb_filenya,  
                'link_youtube'=> $youtube[$lang],  
                'idmenu'      => $id,  
                'parent_menu' => $parent,  
                'sister'      => $sister,
                'posisi'      => $posisi,
                'cretime'     => date('Y-m-d H:i:s'),
                'crdate_set'  => $tgl_modif,
                'creby'       => $this->session->userdata('username'),
                'cat'       => $cat
                );     
                $saved = $this->db->insert('foto', $inputdata);
                $new_file_name = "";
                $new_file_name2 = "";
                $thumb_filenya = "";
            }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_foto(){
        $idlang   = $this->input->post('idlang');
        $tgl_modif   = $this->input->post('tanggal');
        $tgl_modif = explode("-",$tgl_modif);
        $tgl_modif = $tgl_modif[2]."-".$tgl_modif[1]."-".$tgl_modif[0]." ".$this->input->post('time');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $cat     = $this->input->post('idmodule');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        $youtube     = $this->input->post('youtube');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('banner');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $idnya   = $this->input->post('id'.$lang);
            $new_file_name   = $this->input->post('oldpic'.$lang);
            $new_file_name2   = $this->input->post('oldpic2'.$lang);
            $thumb_filenya = $this->input->post('oldthumb'.$lang);
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `foto` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$idnya)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
            if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/foto/'.$new_file_name)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/foto/'.$new_file_name, FCPATH.'/uploads/foto/'.$new_file_name, 800, 631);
                    $thumb_filenya = 'thumb_'.$new_file_name;
                }
            }
            if (isset($_FILES['pic2'.$lang]['name']) AND $_FILES['pic2'.$lang]['name'] != '') {
                $filename2   = strtolower($_FILES['pic2'.$lang]['name']);
                $file_name2     = str_replace(" ","_",$filename2);
                $new_file_name2 = "detail_".date("YmdHis")."_".$file_name2;
                /*THUMB = 78px x 77px */
                if (move_uploaded_file($_FILES['pic2'.$lang]['tmp_name'], FCPATH.'/uploads/foto/'.$new_file_name2)) {//if file moved to uploads folder
                    $this->resize(FCPATH.'/uploads/foto/'.$new_file_name2, FCPATH.'/uploads/foto/'.$new_file_name2, 790, 400);
                }
            }
            if($step1 == TRUE AND $success == TRUE){
                $editdata = array(   
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,  
                    'description' => $content[$lang],    
                    'pic'         => $new_file_name,
                    'pic2'        => $new_file_name2,
                    'thumb'       => $thumb_filenya, 
                    'link_youtube'=> $youtube[$lang],  
                    'cretime'     => date('Y-m-d H:i:s'),
                    'crdate_set'  => $tgl_modif,
                    'creby'       => $this->session->userdata('username'),
                    'cat'         => $cat
                );   
                $this->db->where('id', $idnya);
                $edit = $this->db->update('foto', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function foto($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_foto($id,$parent);
                $data['status'] = $status;
              }
              $data['cat'] = $this->db->query('SELECT * FROM `kategori_foto` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND hidden = 0 AND deleted = 0 ORDER BY posisi DESC')->result_array(); 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_foto($id,$parent);
                  $data['status'] = $status;
                }
                $data['cat'] = $this->db->query('SELECT * FROM `kategori_foto` WHERE idlanguage = '.$deflang.' AND parent_menu='.$parent.' AND hidden = 0 AND deleted = 0 ORDER BY posisi DESC')->result_array();
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `foto` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `foto` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('foto',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('foto',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('foto',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('foto',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
            $sqlwhere = "and foto.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT foto.id,foto.title,foto.hidden,foto.deleted,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' order by foto.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT foto.id,foto.title,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' order by foto.posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT foto.id,foto.title,foto.hidden,foto.deleted,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' AND foto.title LIKE  "%'.$_GET["keyword"].'%" order by foto.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT foto.id,foto.title,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' AND foto.title LIKE  "%'.$_GET["keyword"].'%" order by foto.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('foto',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('foto',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('foto',$deflang,$id);
        }
          if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'foto';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
          $data['current_menu']    = $link;
        $this->load->view('cms/main.php',$data); 
    }
    function infographic($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_infographic($id,$parent);
                $data['status'] = $status;
              }
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_infographic($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT *, DATE_FORMAT(crdate_set, "%d-%m-%Y") AS crdatenya, DATE_FORMAT(crdate_set, "%H:%i") AS crtime FROM `infographic` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `infographic` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'restore'){
              $this->_ispermit($permit->isdelete);
              if (isset($this->segs[5]) AND $this->segs[5] != '') {
                $restore = $this->restoreData('infographic',$this->segs[5]);
                if ($restore){
                  redirect($this->agent->referrer(), 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('infographic',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('infographic',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('infographic',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
            $sqlwhere = "and deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            $data_rec = $this->db->query('SELECT * FROM `infographic`  where idlanguage = '.$deflang.' '.$sqlwhere.' AND idmenu='.$id.' order by posisi desc LIMIT '.$start.','.$limit)->result_array();
            $data_rec_count = $this->db->query('SELECT * FROM `infographic` where idlanguage = '.$deflang.' '.$sqlwhere.' AND idmenu='.$id.' order by posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT foto.id,foto.title,foto.hidden,foto.deleted,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' AND foto.title LIKE  "%'.$_GET["keyword"].'%" order by foto.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT foto.id,foto.title,foto.sister,foto.thumb,foto.pic, pages.title as pages,kategori_foto.title as title_cat FROM `foto` LEFT JOIN pages ON foto.idpages=pages.id  LEFT JOIN kategori_foto ON kategori_foto.sister=foto.cat AND kategori_foto.idlanguage='.$deflang.' where foto.idlanguage = '.$deflang.' '.$sqlwhere.' AND foto.idmenu='.$id.' AND foto.title LIKE  "%'.$_GET["keyword"].'%" order by foto.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('infographic',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('infographic',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('infographic',$deflang,$id);
        }
          if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $id;
          $data['page']    = 'infographic';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
          $data['current_menu']    = $link;
        $this->load->view('cms/main.php',$data); 
    }
    function _save_infographic($id,$parent){
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('infographic');
        $posisi = $this->_nextPosisi('infographic',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        $filenya = "";
        $thumb_filenya = "";
        $target_path = FCPATH.'/uploads/infographic/'; //Declaring Path for uploaded images
        //print_r($_POST);
        $new_file_name = "";
        $new_file_name2 = "";
        foreach ($idlang as $lang) {
            if ($link[$lang] != ""){
                $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `infographic` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
                if($ceklink[0]->jumlah != 0){
                    $newlink = $link[$lang].$ceklink[0]->jumlah;
                }else{
                    $newlink = $link[$lang];
                }
            }else{
                $newlink = "";
            }
            if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/infographic/'.$new_file_name);
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(    
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,     
                    'pic'         => $new_file_name,
                    'idmenu'      => $id,  
                    'parent_menu' => $parent,  
                    'sister'      => $sister,
                    'posisi'      => $posisi,
                    'cretime'     => date('Y-m-d H:i:s'),
                    'creby'       => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('infographic', $inputdata);
                $new_file_name = "";
                $new_file_name2 = "";
                $thumb_filenya = "";
            }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_infographic(){
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $link     = $this->input->post('link');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        $pic     = $this->input->post('pic');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('infographic');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            $idnya   = $this->input->post('id'.$lang);
            $new_file_name   = $this->input->post('oldpic'.$lang);
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `infographic` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang.' AND id != '.$idnya)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
            if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
                $filename   = strtolower($_FILES['pic'.$lang]['name']);
                $file_name     = str_replace(" ","_",$filename);
                $new_file_name = date("YmdHis")."_".$file_name;
                /*THUMB = 78px x 77px */
                move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/infographic/'.$new_file_name);
            }
            if($step1 == TRUE AND $success == TRUE){
                $editdata = array(   
                    'idlanguage'  => $lang, 
                    'title'       => $title[$lang], 
                    'link_ori'    => $link[$lang], 
                    'link'        => $newlink,  
                    'pic'         => $new_file_name,
                    'cretime'     => date('Y-m-d H:i:s'),
                    'creby'       => $this->session->userdata('username')
                );   
                $this->db->where('id', $idnya);
                $edit = $this->db->update('infographic', $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                    'notice'  => $notice,
                    'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                    'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                    'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function actionPage($data){
        if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            switch ($this->segs[4]) {
                case 'add'  : $data = $this->actionPageAdd($data); break;
                case 'edit' : $data = $this->actionPageEdit($data); break;
                case 'movedraft' : $data = $this->actionPageMoveDraft($data); break;
                case 'movetrash' : $data = $this->actionPageMoveTrash($data); break;
                case 'movepublish' : $data = $this->actionPageMovePublish($data); break;
                case 'delete' : $data = $this->actionPageDelete($data); break;
                case 'view' : $data = $this->actionPageview($data); break;
                default     : redirect($data['selfUrl'], 'refresh'); break;
            }
        }
        else { redirect($data['selfUrl'], 'refresh'); }
        return $data;
    }
    function actionPageAdd($data){
        $this->_ispermit($data['permit']->isadd);        
        $form = $this->input->post('form');
        if (isset($form) AND $form == 1 ){        
            $status = $this->_save_();
            $data['status'] = $status;
        } 
        return $data;
    }
    function actionPageEdit($data){
        $this->_ispermit($data['permit']->isupdate);
        if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
                $status         = $this->_edit_();
                $data['status'] = $status;
            }
            //echo "<pre>";
            //print_r($data['field']);
            $tbl = isset($data['vtable']) ? $data['vtable'] : $data['table'];
            $data_rec = $this->db->query('SELECT* FROM `'.$tbl.'` WHERE sister = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
                //echo "<pre>";
                //print_r($data_rec);
                $data['rec'] = $data_rec;
            } else {
                redirect($data['selfUrl'], 'refresh');
            }
        } else {
            redirect($data['selfUrl'], 'refresh');
        }
        return $data;
    }
    function actionPageview($data){
        $this->_ispermit($data['permit']->isview);
        if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $data_row = $this->db->query('SELECT '.$data['field'].' FROM '.$data['table'].' WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_row) { $data['row'] = $data_row[0]; } 
            else { redirect($data['selfUrl'], 'refresh'); }
        } 
        else { redirect($data['selfUrl'], 'refresh'); }
    }
    function actionPageMoveDraft($data){
        $this->_ispermit($data['permit']->isupdate);
        $draft = $this->draftDataNew($data['table'],$this->segs[5]);
        if ($draft){ redirect($this->agent->referrer(), 'refresh'); }
    }
    function actionPageMoveTrash($data){
        $this->_ispermit($data['permit']->isdelete);
        $trash = $this->trashDataNew($data['table'],$this->segs[5]);
        if ($trash){redirect($this->agent->referrer(), 'refresh');}
    }
    function actionPageMovePublish($data){
        $this->_ispermit($data['permit']->isupdate);
        $publish = $this->publishDataNew($data['table'],$this->segs[5]);
        if ($publish){ redirect($this->agent->referrer(), 'refresh'); }
    }
    function actionPageDelete($data){
        $this->_ispermit($data['permit']->isdelete);
        if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteDataNew($data['table'],$this->segs[5]);
            if ($deleted){ redirect($this->agent->referrer(), 'refresh'); }
        } 
        else { redirect($data['selfUrl'], 'refresh'); }
    }
    function _save_(){
        $idlang      = $this->input->post('idlang');
        $draft       = $this->input->post('draft');
        $publish     = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI($this->table);
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        foreach ($idlang as $lang) {
            $picname   = "";
            $thumbname = "";
            $inputdata = array(
                'idlanguage'  => $lang, 
                'sister'      => $sister,
                'cretime'     => date('Y-m-d H:i:s'),
                'creby'       => $this->session->userdata('username')
            ); 
            if(isset($this->mainOption) && $this->input->post($this->mainOption['id'])){
                $inputdata[($this->mainOption['id'])] = $this->input->post($this->mainOption['id']);
            }
            if(isset($this->formfield) && isset($_FILES)){
                foreach($this->formfield as $f) { if($f['type'] == 'image' || $f['type'] == 'file') {
                    $w = 500; $h = 390;                    
                    if(isset($this->imazeSize)) { $w = $this->imazeSize['width']; $h = $this->imazeSize['height']; }                    
                    $hasilupload   = $this->excUploadFile($_FILES[($f['id'].$lang)], $f['id'].$lang, $w, $h);
                    if(isset($hasilupload['status']) && $hasilupload['status'] == TRUE){
                        $picname   = $hasilupload['filename'];
                        $thumbname = $hasilupload['thumbname'];
                        $inputdata[($f['id'])] = $picname;
                        if($thumbname) $inputdata['thumb'] = $thumbname;
                    } 
                }}
            }
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                if(isset($this->formfield)){
                    foreach($this->formfield as $f){
                        $dataPost = $this->input->post($f['id']);
                        if($dataPost) $inputdata[($f['id'])] = $dataPost[$lang];
                    }
                }
                if(isset($this->useSlug) && $this->useSlug){
                    $title      = $this->input->post($this->useSlug);
                    $cek_slug   = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,$this->table));
                    if ($cek_slug > 0) { $slugnya = $this->slugify($title[$lang]) . "-" . $cek_slug; }
                    else { $slugnya = $this->slugify($title[$lang]); }
                    $inputdata['link']      = $slugnya;
                    $inputdata['link_ori']  = $this->slugify($title[$lang]);
                }
                $saved = $this->db->insert($this->table, $inputdata);
            } 
            /*        
            if($step1 == TRUE AND $success == TRUE){
                $data = array();
                $inputdata = array(            
                    'idlanguage' => $lang, 
                    'title'      => $title[$lang], 
                    'description' => $description[$lang],
                    'draft'      => $statusdraft,     
                    'link'       => $slugnya,
                    'link_ori'   => $this->slugify($title[$lang]),
                    'sister'     => $sister,
                    'cretime'    => date('Y-m-d H:i:s'),
                    'creby'      => $this->session->userdata('username')
                );     
                $saved = $this->db->insert('hubungan_investor', $inputdata);
            }*/
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($saved){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
            return $info;
            }
        }else{
            $form = array(
                'idpages'  => $idpages,
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function _edit_(){
        $id          = $this->input->post('id');
        $idlang      = $this->input->post('idlang');
        $publish     = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
            $statusdraft = 0;
        }else{
            $statusdraft = 1;
        }
        //$sister = $this->_nextAI($this->table);
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        $s = 1;
        foreach ($idlang as $lang) {
            //$picname   = $this->input->post('oldpic'.$lang);
            //$thumbname = $this->input->post('oldthumb'.$lang);
            $editdata = array(    
                'idlanguage'  => $lang, 
                'modtime'     => date('Y-m-d H:i:s'),
                'modby'       => $this->session->userdata('username')
            );         
            if(isset($this->mainOption) && $this->input->post($this->mainOption['id'])){
                $editdata[($this->mainOption['id'])] = $this->input->post($this->mainOption['id']);
            }
            if(isset($this->formfield) && isset($_FILES)){
                foreach($this->formfield as $f) { if($f['type'] == 'image' || $f['type'] == 'file') {
                    $w = 500; $h = 390;                    
                    if(isset($this->imazeSize)) { $w = $this->imazeSize['width']; $h = $this->imazeSize['height']; }
                    $hasilupload   = $this->excUploadFile($_FILES[($f['id'].$lang)], $f['id'].$lang, $w, $h);
                    if(isset($hasilupload['status']) && $hasilupload['status'] == TRUE){
                        $picname   = $hasilupload['filename'];
                        $thumbname = $hasilupload['thumbname'];
                        $editdata[($f['id'])] = $picname;
                        if($thumbname) $editdata['thumb'] = $thumbname;
                    }
                }}
            }
            if($step1 == TRUE AND $success == TRUE){
                if(isset($this->formfield)){
                    foreach($this->formfield as $f){
                        $dataPost = $this->input->post($f['id']);
                        if($dataPost) $editdata[($f['id'])] = $dataPost[$lang];
                    }
                }
                if(isset($this->useSlug) && $this->useSlug){
                    $title       = $this->input->post($this->useSlug);
                    $link_       = $this->input->post('link'); $link = $link_[$lang];
                    $link_ori_   = $this->input->post('link_ori'); $link_ori = $link_ori_[$lang];
                    if ($this->slugify($title[$lang]) != $link_ori){
                        $cek_slug = intval($this->cekslugifydatabase($this->slugify($title[$lang]),$lang,$this->table));
                        if ($cek_slug > 0){ $rSlug = $this->slugify($title[$lang]) . "-" . $cek_slug; }
                        else{ $rSlug = $this->slugify($title[$lang]); }
                        $editdata['link'] = $rSlug;
                        $editdata['link_ori'] = $this->slugify($title[$lang]);
                    }
                }
                $this->db->where('id', $id[$lang]);
                $edit = $this->db->update($this->table, $editdata); 
            }
        }
        if($step1 == TRUE AND $success == TRUE){
            if ($edit){
                $info = array(            
                  'notice'  => $notice,
                  'success' => $success
                );
                return $info;
            }else{ 
                $info = array(            
                  'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
                  'success' => false
                );
                return $info;
            }
        }else{
            $form = array(
                'title'    => $title,
                'link'     => $link,
            );
            $info = array(            
                'notice'  => $notice,
                'success' => $success,
                'form'    => $form
            );
            return $info;
        }
    }
    function getList($data){
        $tbl = isset($data['vtable']) ? $data['vtable'] : $data['table'];
        if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
            $sqlwhere           = $tbl.'.hapus = 1';
            $data['statuspage'] = 'trash';
        }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
            $sqlwhere           = $tbl.'.hapus = 0 and '.$tbl.'.draft = 1';
            $data['statuspage'] = 'draft'; 
        }else {
            $sqlwhere           = $tbl.".hapus = 0 and ".$tbl.".draft = 0 ";
            $data['statuspage'] = 'publish';
        }
        $data_rec   = $this->db->query('SELECT '.$data['field'].' 
                                        FROM `'.$tbl.'` 
                                        where '.$tbl.'.idlanguage = '.$data['deflang'].'
                                        AND '.$tbl.'.parent=0 
                                        AND '.$sqlwhere.'
                                        order by '.$tbl.'.posisi asc')->result_array();  
        $data_count = $this->db->query('SELECT count(*) as jumlah FROM `'.$tbl.'` 
                                        where idlanguage = '.$data['deflang'].' AND '.$sqlwhere.' AND '.$tbl.'.parent=0 order by posisi asc')->result();
        if ($data['statuspage'] == 'publish') {
            if(count($data_rec) != 0){
                $urutanchild = 0;
                foreach ($data_rec as $parent) {
                    $datachild[$urutanchild] = $this->db->query('SELECT '.$data['field'].' FROM `'.$tbl.'` 
                                                                 where idlanguage = '.$data['deflang'].' AND parent = '.$parent["id"].' 
                                                                 and hapus = 0 and draft = 0 order by posisi asc')->result_array();
                    $urutanchild++;
                }
                $data['child'] = $datachild;
            }
        }    
        $data['rec']            = $data_rec;
        $data['act']            = 'default';
        $data['jumlahdata']     = $data_count[0]->jumlah;
        $data['count_publish']  = $this->countPublishNew($tbl,$data['deflang']);
        $data['count_draft']    = $this->countDraftNew($tbl,$data['deflang']);
        $data['count_trash']    = $this->countTrashNew($tbl,$data['deflang']);
        return $data;
    }
    function excUploadFile($file, $field, $_width, $_height){
        $w = $_width ? $_width : 500;
        $h = $_height ? $_height : 390;
        if($file['name']){
        $filenameold   = strtolower($file['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $new_file_name = $this->url_module.'_'.time()."_".$file_edit;
        $folder        = $this->url_module;
        $filename      = $new_file_name;
        $fieldname     = $field;
        $resizable     = TRUE;
        $width         = $w;
        $height        = $h;
        $create_thumb  = array('status' => TRUE,'width'  => 90,'height' => 70); 
        $hasilupload   = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        return $hasilupload;
        }
        else { return ''; } 
    }
  public function defaultpage(){
    $login = $this->_isLogin();
    $idmenudb = 23;
    $permit = $this->_cekPermit($idmenudb);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $deflang = $this->_cekDefLang();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_defaultpage();
            $data['status'] = $status;
          }
          $data['pages'] = $this->db->query('SELECT id,title FROM `pages` WHERE idlanguage = '.$deflang.' AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_defaultpage();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,idpages,title,link,pic,thumb FROM `defaultpage` WHERE sister = '.$this->segs[5])->result_array(); 
            $data['pages'] = $this->db->query('SELECT id,title FROM `pages` WHERE idlanguage = '.$deflang.' AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec;
            } else {
              redirect('/webadmin/defaultpage', 'refresh');
            }
          } else {
            redirect('/webadmin/defaultpage', 'refresh');
          }
        }elseif ($this->segs[4] == 'view'){
          $this->_ispermit($permit->isview);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `defaultpage` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_row) {
              $data['row'] = $data_row[0];
            } else {
              redirect('/webadmin/defaultpage', 'refresh');
            }
          } else {
            redirect('/webadmin/defaultpage', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('defaultpage',$this->segs[5]);
            if ($deleted){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/defaultpage', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('defaultpage',$this->segs[5]);
            if ($restore){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/defaultpage', 'refresh');
          }
        }elseif ($this->segs[4] == 'movetrash'){
          $this->_ispermit($permit->isdelete);
          $trash = $this->trashData('defaultpage',$this->segs[5]);
          if ($trash){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movedraft'){
          $this->_ispermit($permit->isupdate);
          $draft = $this->draftData('defaultpage',$this->segs[5]);
          if ($draft){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movepublish'){
          $this->_ispermit($permit->isupdate);
          $publish = $this->publishData('defaultpage',$this->segs[5]);
          if ($publish){
            redirect($this->agent->referrer(), 'refresh');
          }
        }else{
          redirect('/webadmin/defaultpage', 'refresh');
        }
      }else{
        redirect('/webadmin/defaultpage', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $datenow = date('Y-m-d H:i:s');
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and defaultpage.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'and defaultpage.hapus = 0 and defaultpage.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = "and defaultpage.hapus = 0 and defaultpage.draft = 0 ";
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT defaultpage.id, defaultpage.title, defaultpage.subtitle ,defaultpage.sister, pages.title as pages FROM `defaultpage` INNER JOIN pages ON defaultpage.idpages=pages.id where defaultpage.idlanguage = '.$deflang.' '.$sqlwhere.' order by defaultpage.cretime asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `defaultpage` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']        = $data_rec;
      $data['act']        = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish']    = $this->countPublishNew('defaultpage',$deflang);
      $data['count_draft']      = $this->countDraftNew('defaultpage',$deflang);
      $data['count_trash']      = $this->countTrashNew('defaultpage',$deflang);
    }
      $data['submenu'] = FALSE;
      $data['active']  = 'defaultpage';
      $data['active2'] = '';
      $data['page']    = 'defaultpage';
    $this->load->view('cms/main.php',$data); 
  }
  function _save_penghargaan(){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $idpages = $this->input->post('idpages');
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $pic     = $this->input->post('pic');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('penghargaan');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $step1   = FALSE;
      $success = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    $picname   = "";
    $picname2  = "";
    $thumbname = "";
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = "";
        $thumbname = "";
        if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'penghargaan_'.$random_digit."_".$file_edit;
            $folder       = 'penghargaan';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 820;
            $height       = 465;
            $create_thumb = array(            
                'status' => TRUE,
                'width'  => 298, 
                'height' => 169
            ); 
            if (move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/penghargaan/'.$new_file_name)) {//if file moved to uploads folder
                $this->resize2(FCPATH.'/uploads/penghargaan/'.$new_file_name, FCPATH.'/uploads/penghargaan/thumb_'.$new_file_name, 298, 169);
            }
            //$hasilupload = $this->ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            /*if($hasilupload['status'] == TRUE){
                $picname   = $hasilupload['filename'];
                $thumbname = $hasilupload['thumbname'];
            }else{
                $success = $hasilupload['success'];
                $step1   = $hasilupload['step1'];
                $notice  .= $hasilupload['notice'];
                $picname = "";
            }*/
        } 
      if($step1 == TRUE AND $success == TRUE){
        $data = array();
        $inputdata = array(            
          'idpages'    => $cekidpage[0]->id, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'sister'     => $sister,
          'pic'        => $new_file_name,
          'thumb'      => 'thumb_'.$new_file_name, 
          'cretime'    => date('Y-m-d H:i:s'),
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('penghargaan', $inputdata);
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_penghargaan(){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $id      = $this->input->post('id');
    $idpages = $this->input->post('idpages');
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $link    = $this->input->post('link');
    $pic     = $this->input->post('pic');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('banner');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $step1   = FALSE;
      $success = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    $s = 1;
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = $this->input->post('oldpic'.$lang);
      $thumbname = $this->input->post('oldthumb'.$lang);
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'penghargaan_'.$random_digit."_".$file_edit;
            $folder       = 'penghargaan';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 820;
            $height       = 465;
            $create_thumb = array(            
                'status' => TRUE,
                'width'  => 298, 
                'height' => 169
            ); 
            $hasilupload = $this->ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(            
          'idpages'    => $cekidpage[0]->id, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'pic'        => $picname,
          'thumb'      => $thumbname, 
          'modtime'    => date('Y-m-d H:i:s'),
          'modby'      => $this->session->userdata('username')
        );     
        $this->db->where('id', $id[$lang]);
        $edit = $this->db->update('penghargaan', $editdata); 
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages'  => $idpages,
        'title'    => $title,
        'link'     => $link,
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function videotestimonial(){       
    $login = $this->_isLogin();
    $idpermit = 25;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $data['lang'] = $this->_cekLanguage();
    $deflang = $this->_cekDefLang();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){          
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_videotestimonial();
            $data['status'] = $status;
            // echo "<pre>";
            // print_r($status);
          }
          $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 4 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_videotestimonial();
              $data['status'] = $status;
              // echo "<pre>";
              // print_r($status);
            }
            $data_rec = $this->db->query('SELECT id,title,idpages,idlanguage,link,tahun,pic,thumb FROM `videotestimonial` WHERE sister = '.$this->segs[5])->result_array(); 
            $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 4 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec;
            } else {
              redirect('/webadmin/videotestimonial', 'refresh');
            }
          } else {
            redirect('/webadmin/videotestimonial', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteDataNew('videotestimonial',$this->segs[5]);
            if ($deleted){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/videotestimonial', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreDataNew('videotestimonial',$this->segs[5]);
            if ($restore){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/videotestimonial', 'refresh');
          }
        }elseif ($this->segs[4] == 'movetrash'){
          $this->_ispermit($permit->isdelete);
          $trash = $this->trashDataNew('videotestimonial',$this->segs[5]);
          if ($trash){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movedraft'){
          $this->_ispermit($permit->isupdate);
          $draft = $this->draftDataNew('videotestimonial',$this->segs[5]);
          if ($draft){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movepublish'){
          $this->_ispermit($permit->isupdate);
          $publish = $this->publishDataNew('videotestimonial',$this->segs[5]);
          if ($publish){
            redirect($this->agent->referrer(), 'refresh');
          }
        }else{
          redirect('/webadmin/videotestimonial', 'refresh');
        }
      }else{
        redirect('/webadmin/videotestimonial', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'AND videotestimonial.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'AND videotestimonial.hapus = 0 and videotestimonial.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = 'AND videotestimonial.hapus = 0 and videotestimonial.draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT videotestimonial.id,videotestimonial.title,videotestimonial.sister,videotestimonial.tahun, pages.title as pages FROM `videotestimonial` INNER JOIN pages ON videotestimonial.idpages=pages.id where videotestimonial.idlanguage = '.$deflang.' '.$sqlwhere.' order by videotestimonial.cretime asc')->result_array(); 
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `videotestimonial` where idlanguage = '.$deflang.' '.$sqlwhere.' order by cretime asc')->result();    
      $data['rec']   = $data_rec;
      $data['deflang'] = $deflang;
      $data['act']   = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish'] = $this->countPublishNew('videotestimonial',$deflang);
      $data['count_draft'] = $this->countDraftNew('videotestimonial',$deflang);
      $data['count_trash'] = $this->countTrashNew('videotestimonial',$deflang);
    }
    $data['active']  = 'Videotestimonial';
    $data['page']    = 'videotestimonial';
    $data['active2'] = 'videotestimonial';
    $data['submenu'] = FALSE;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_videotestimonial(){
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $idpages = $this->input->post('idpages');
    $idlang  = $this->input->post('idlang');
    $title   = $this->input->post('title');
    $tahun   = $this->input->post('tahun');
    $link    = $this->input->post('link');
    $draft   = $this->input->post('draft');
    $publish = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('videotestimonial');
    $notice = "";
    $step1   = TRUE;
    $success = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = "";
      $thumbname   = "";
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'video_'.$random_digit."_".$file_edit;
        $folder       = 'video';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 500;
        $height       = 390;
        $create_thumb = array(            
          'status' => TRUE,
          'width'  => 90, 
          'height' => 70
        ); 
        $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $data = array();
        $inputdata = array(            
          'idpages'    => $cekidpage[0]->id, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang], 
          'tahun'      => $tahun[$lang],    
          'pic'        => $picname,
          'thumb'      => $thumbname,  
          'sister'     => $sister,
          'cretime'    => date('Y-m-d H:i:s'),
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('videotestimonial', $inputdata);
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages' => $idpages,
        'idlang'  => $idlang,
        'title'   => $title,
        'tahun'   => $tahun,
        'link'    => $link
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_videotestimonial(){
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $id      = $this->input->post('id');
    $idpages = $this->input->post('idpages');
    $idlang   = $this->input->post('idlang');
    $title    = $this->input->post('title');
    $tahun  = $this->input->post('tahun');
    $link     = $this->input->post('link');
    $draft    = $this->input->post('draft');
    $publish  = $this->input->post('publish');
    if(isset($publish) and $publish != '' and $publish == 'publish'){
      $statusdraft = 0;
    }else{
      $statusdraft = 1;
    }
    $sister = $this->_nextAI('videotestimonial');
    $notice = "";
    $step1   = TRUE;
    $success = TRUE;
    //echo $title;
    if(isset($idpages) AND $idpages != ''){
    }else{
      $success = FALSE;
      $step1   = FALSE;
      $notice .= "<li>Pages : Must be filled</li>";
    }
    foreach ($idlang as $lang) {
      $cekidpage = $this->db->query('SELECT id FROM `pages` where sister = "'.$idpages.'" AND idlanguage = '.$lang)->result();
      $picname   = $this->input->post('oldpic'.$lang);
      $thumbname = $this->input->post('oldthumb'.$lang);
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'video_'.$random_digit."_".$file_edit;
        $folder       = 'video';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 500;
        $height       = 390;
        $create_thumb = array(            
          'status' => TRUE,
          'width'  => 90, 
          'height' => 70
        ); 
        $hasilupload = $this->ryan_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
        if($hasilupload['status'] == TRUE){
          $picname   = $hasilupload['filename'];
          $thumbname = $hasilupload['thumbname'];
        }else{
          $success = $hasilupload['success'];
          $step1   = $hasilupload['step1'];
          $notice  .= $hasilupload['notice'];
          $picname = "";
        }
      }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(            
          'idpages'    => $cekidpage[0]->id, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'    => $link[$lang], 
          'tahun'    => $tahun[$lang],    
          'pic'        => $picname,
          'thumb'      => $thumbname,  
          'modtime'    => date('Y-m-d H:i:s'),
          'modby'      => $this->session->userdata('username')
        );     
        $this->db->where('id', $id[$lang]);
        $edit = $this->db->update('videotestimonial', $editdata); 
      }
    }
    if($step1 == TRUE AND $success == TRUE){
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'idpages' => $idpages,
        'idlang'  => $idlang,
        'title'   => $title,
        'tahun' => $tahun,
        'link'    => $link
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _save_karir($id,$parent){
        $idlang   = $this->input->post('idlang');
        $title    = $this->input->post('title');
        $content  = $this->input->post('content');
        $singkatan  = $this->input->post('singkatan');
        $draft    = $this->input->post('draft');
        $publish  = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('karir');
        $posisi = $this->_nextPosisi('karir',$id);
        $posisi = $posisi + 1;
        $notice = "";
        $step1   = TRUE;
        $success = TRUE;
        //echo $title;
        $j = 0; //Variable for indexing uploaded image 
        foreach ($idlang as $lang) {
          if($step1 == TRUE AND $success == TRUE){
            $data = array();
            $inputdata = array(        
              'idlanguage'  => $lang, 
              'title'       => $title[$lang],
              'description' => $content[$lang],
              'singkatan'   => $singkatan[$lang],
              'idmenu'      => $id,  
              'parent_menu' => $parent,  
              'sister'      => $sister,
              'posisi'      => $posisi,
              'cretime'     => date('Y-m-d H:i:s'),
              'creby'       => $this->session->userdata('username')
            );     
            $saved = $this->db->insert('karir', $inputdata);
          }
          $filename = "";
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($saved){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages' => $idpages,
            'idlang'  => $idlang,
            'title'   => $title,
            'content' => $content,
            'link'    => $link
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
      }
    function _edit_karir(){
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // die();
        $id      = $this->input->post('id');
        $idlang  = $this->input->post('idlang');
        $title   = $this->input->post('title');
        $content  = $this->input->post('content');
        $singkatan  = $this->input->post('singkatan');
        $draft   = $this->input->post('draft');
        $publish = $this->input->post('publish');
        if(isset($publish) and $publish != '' and $publish == 'publish'){
          $statusdraft = 0;
        }else{
          $statusdraft = 1;
        }
        $sister = $this->_nextAI('karir');
        $notice  = "";
        $success = TRUE;
        $step1   = TRUE;
        //echo $title;
        //echo "<pre>";
        //print_r($idpages);
        $s = 1;
        foreach ($idlang as $lang) {
          if($step1 == TRUE AND $success == TRUE){
            $editdata = array(            
              'idlanguage' => $lang, 
              'title'      => $title[$lang],
              'description' => $content[$lang],
              'singkatan'   => $singkatan[$lang],
              'modtime'    => date('Y-m-d H:i:s'),
              'modby'      => $this->session->userdata('username')
            );   
            $this->db->where('id', $id[$lang]);
            $edit = $this->db->update('karir', $editdata); 
          }
        }
        if($step1 == TRUE AND $success == TRUE){
          if ($edit){
            $info = array(            
              'notice'  => $notice,
              'success' => $success
            );
            return $info;
          }else{
            $info = array(            
              'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
              'success' => false
            );
            return $info;
          }
        }else{
          $form = array(
            'idpages'  => $idpages,
            'title'    => $title,
            'link'     => $link,
          );
          $info = array(            
            'notice'  => $notice,
            'success' => $success,
            'form'    => $form
          );
          return $info;
        }
    }
    function karir($id,$parent,$title,$link){
        $url_module = $this->segs[2];
        $login = $this->_isLogin();
        $idmenudb = $id;
        $permit = $this->_cekPermit($idmenudb);
        $data['permit'] = $permit;
        $data['menulist'] = $this->_cekAkses();
        $data['lang'] = $this->_cekLanguage();
        $deflang = $this->_cekDefLang();
        if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
          if (isset($this->segs[4])){
            $data['act'] = $this->segs[4];
            if ($this->segs[4] == 'add'){
              $this->_ispermit($permit->isadd);
              $form = $this->input->post('form');
              if (isset($form) AND $form == 1 ){
                $status = $this->_save_karir($id,$parent);
                $data['status'] = $status;
              } 
            }elseif ($this->segs[4] == 'edit'){
              $this->_ispermit($permit->isupdate);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $form = $this->input->post('form');
                if (isset($form) AND $form == 1 ){
                  $status = $this->_edit_karir($id,$parent);
                  $data['status'] = $status;
                }
                $data_rec = $this->db->query('SELECT * FROM `karir` WHERE sister = '.$this->segs[5])->result_array(); 
                if ($data_rec) {
                  $data['rec'] = $data_rec;
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'view'){
              $this->_ispermit($permit->isview);
              if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
                $data_row = $this->db->query('SELECT * FROM `karir` WHERE id = '.$this->segs[5])->result_array(); 
                if ($data_row) {
                  $data['row'] = $data_row[0];
                } else {
                  redirect('/webadmin/'.$url_module, 'refresh');
                }
              } else {
                redirect('/webadmin/'.$url_module, 'refresh');
              }
            }elseif ($this->segs[4] == 'deleted'){
              $this->_ispermit($permit->isdelete);
              $deleted = $this->deleted('karir',$this->segs[5]);
              if ($deleted){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'hide'){
              $this->_ispermit($permit->ishide);
              $hide = $this->hide('karir',$this->segs[5]);
              if ($hide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }elseif ($this->segs[4] == 'unhide'){
              $this->_ispermit($permit->ishide);
              $unhide = $this->unhide('karir',$this->segs[5]);
              if ($unhide){
                redirect($this->agent->referrer(), 'refresh');
              }
            }else{
              redirect('/webadmin/'.$url_module, 'refresh');
            }
          }else{
            redirect('/webadmin/'.$url_module, 'refresh');
          }
        }else{
          $this->_ispermit($permit->isview);
          $datenow = date('Y-m-d H:i:s');
          $table = "karir";
            $sqlwhere = "and $table.deleted = 0";
            $data['statuspage'] = 'publish';
            $limit = 10;
            if (isset($_GET["page"])){
                $start = ($_GET["page"]*$limit) - $limit;
                $page = $_GET["page"];
                $no = (($_GET["page"]*$limit) - $limit) + 1;
            }else{
                $start = 0;
                $no = 1;
                $page = 1;
            }
            //echo 'SELECT karir.id,karir.title,karir.hidden,karir.deleted,karir.sister,karir.thumb,karir.pic, pages.title as pages FROM `karir` LEFT JOIN pages ON karir.idpages=pages.id  where karir.idlanguage = '.$deflang.' '.$sqlwhere.' AND karir.idmenu='.$id.' order by karir.posisi desc LIMIT '.$start.','.$limit;
//            die();
            $data_rec = $this->db->query('SELECT karir.id,karir.title,karir.hidden,karir.deleted,karir.sister,karir.thumb,karir.pic, pages.title as pages FROM `karir` LEFT JOIN pages ON karir.idpages=pages.id  where karir.idlanguage = '.$deflang.' '.$sqlwhere.' AND karir.idmenu='.$id.' order by karir.posisi desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT karir.id,karir.title,karir.sister,karir.thumb,karir.pic, pages.title as pages FROM `karir` LEFT JOIN pages ON karir.idpages=pages.id where karir.idlanguage = '.$deflang.' '.$sqlwhere.' AND karir.idmenu='.$id.' order by karir.posisi desc')->result_array();
            if (isset($_GET["cari"])){
                $data_rec = $this->db->query('SELECT karir.id,karir.title,karir.hidden,karir.deleted,karir.sister,karir.thumb,karir.pic, pages.title as pages FROM `karir` LEFT JOIN pages ON karir.idpages=pages.id  where karir.idlanguage = '.$deflang.' '.$sqlwhere.' AND karir.idmenu='.$id.' AND karir.title LIKE "%'.$_GET["keyword"].'%" order by karir.posisi desc LIMIT '.$start.','.$limit)->result_array();  
                $data_rec_count = $this->db->query('SELECT karir.id,karir.title,karir.sister,karir.thumb,karir.pic, pages.title as pages FROM `karir` LEFT JOIN pages ON karir.idpages=pages.id where karir.idlanguage = '.$deflang.' '.$sqlwhere.' AND karir.idmenu='.$id.' AND karir.title LIKE "%'.$_GET["keyword"].'%"  order by karir.posisi desc')->result_array();
            }
            $pengurangan = ($page - 1);
            $urut = count($data_rec_count) - $pengurangan;
            $query_string = $_GET;
            if (isset($query_string['page']))
            {
                unset($query_string['page']);
            }
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
            $config['first_link'] = 'First';
            $config['last_link'] = 'Last';       
            $config['uri_segment'] = 4;
            $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
            $config['total_rows'] = count($data_rec_count);
            $config['per_page'] = $limit;        
            $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_link'] = '&laquo; First';
            $config['first_tag_open'] = '<li class="prev page">';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = 'Last &raquo;';
            $config['last_tag_open'] = '<li class="next page">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'Next &rarr;';
            $config['next_tag_open'] = '<li class="next page">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&larr; Previous';
            $config['prev_tag_open'] = '<li class="prev page">';
            $config['prev_tag_close'] = '</li>';
            //$config['suffix'] = '' . http_build_query($query_string, '', "&");
            //$config['first_url'] = $url_module.'/?page=1';
            //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config['use_page_numbers'] = true;
            $config['page_query_string'] = true;
            $config['query_string_segment'] = "page";
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();    
            $data['urutan']        = $urut;
            $data['limit']       = $limit;
          $data['rec']        = $data_rec;
          $data['act']        = 'default';
          $data['jumlahdata'] = count($data_rec_count);;
          $data['count_publish']    = $this->countPublishNewBase('kategori_foto',$deflang,$id);
          $data['count_draft']      = $this->countDraftNewBase('kategori_foto',$deflang,$id);
          $data['count_trash']      = $this->countTrashNewBase('kategori_foto',$deflang,$id);
        }
        if ($parent > 0){
            $data['submenu'] = TRUE;
        }else{
            $data['submenu'] = FALSE;
        }
          $data['active']  = $parent;
          $data['active2'] = $title;
          $data['current_menu']    = $link;
          $data['page']    = 'karir';
          $data['url_module']    = $this->segs[2];
          $data['title']    = $title;
        $this->load->view('cms/main.php',$data); 
    }
  public function contactreceiver($id,$parent,$title,$link){       
    $login = $this->_isLogin();
    $idpermit = $id;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_contactreceiver();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_contactreceiver();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,name,email FROM `contactreceiver` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/contactreceiver', 'refresh');
            }
          } else {
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('contactreceiver',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/contactreceiver', 'refresh');
            }
          } else {
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('contactreceiver',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/contactreceiver', 'refresh');
            }
          } else {
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE contactreceiver SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/contactreceiver', 'refresh');
          }
        }else{
          redirect('/webadmin/contactreceiver', 'refresh');
        }
      }else{
        redirect('/webadmin/contactreceiver', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        $sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT id,name,email FROM `contactreceiver` where 1=1 '.$sqlwhere.' order by name asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `contactreceiver` where 1=1 '.$sqlwhere.' order by cretime asc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      $data['count_publish'] = $this->countPublish('contactreceiver');
      $data['count_trash'] = $this->countTrash('contactreceiver');
    }
    $data['page'] = 'contactreceiver';
    $data['active']  = $parent;
    $data['active2'] = $id;
    $data['tipe'] = '';
    $data['parent'] = $parent;
    $data['submenu'] = TRUE;
    $url_module = $this->segs[2];
    $data['url_module'] = $url_module;
    $data['title'] = $title;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_contactreceiver(){
    $name  = $this->input->post('name');
    $email = $this->input->post('email');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($name) AND $name != ''){
    }else{
      $success = false;
      $notice .= "<li>Name : Must be filled</li>";
    }
    if(isset($email) AND $email != ''){
    }else{
      $success = false;
      $notice .= "<li>Email : Must be filled</li>";
    }
    if($success == true){
      $data = array();
      $inputdata = array(            
        'name'    => $name,
        'email'   => $email, 
        'cretime' => date('Y-m-d H:i:s')
      );     
      $saved = $this->db->insert('contactreceiver', $inputdata);
      if ($saved){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'name'  => $name,
        'email' => $email
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  function _edit_contactreceiver(){
    $name  = $this->input->post('name');
    $email = $this->input->post('email');
    $notice = "";
    $success = true;
    //echo $title;
    if(isset($name) AND $name != ''){
    }else{
      $success = false;
      $notice .= "<li>Name : Must be filled</li>";
    }
    if(isset($email) AND $email != ''){
    }else{
      $success = false;
      $notice .= "<li>Email : Must be filled</li>";
    }
    if($success == true){
      $editdata = array(            
        'name'     => $name,
        'email' => $email, 
        'modtime'   => date('Y-m-d H:i:s')
      );     
      // print_r($inputdata);
      // die();
      $this->db->where('id', $this->segs[5]);
      $edit = $this->db->update('contactreceiver', $editdata); 
      if ($edit){
        $info = array(            
          'notice'  => $notice,
          'success' => $success
        );
        return $info;
      }else{
        $info = array(            
          'notice'  => "<li>Terjadi kesalahan sistem silahkan coba lagi</li>",
          'success' => false
        );
        return $info;
      }
    }else{
      $form = array(
        'name' => $name,
        'email'  => $email
      );
      $info = array(            
        'notice'  => $notice,
        'success' => $success,
        'form'    => $form
      );
      return $info;
    }
  }
  public function allpurchases($id,$parent,$title,$link){       
    $login = $this->_isLogin();
    $idpermit = $id;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    $url_module = $this->segs[2];
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_contactmail();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
                $editdata = array(  
                  'status'      => $_POST["status"], 
                  'no_resi'      => $_POST["resi"]
                );     
                $this->db->where('uid', $this->segs[5]);
                $edit = $this->db->update('cart', $editdata);  
                $data["status"]["success"] = TRUE;
            }
            $data_rec = $this->db->query('SELECT * FROM `cart` WHERE uid = '.$this->segs[5])->result_array(); 
            $data['produk'] = array();
            if (count($data_rec) > 0){
                $dataproduk = $this->db->query('SELECT a.*,b.title,b.pic FROM cart_detail a LEFT JOIN produk b ON a.uid_produk=b.sister WHERE a.uid_cart = '.$this->segs[5].' AND b.idlanguage = 1')->result_array();
                $data['produk'] = $dataproduk;
                $dataaddress = $this->db->query('SELECT a.*,b.province,c.type_city,c.city_name,d.subdistrict_name FROM address a LEFT JOIN province b ON a.uid_province=b.province_id LEFT JOIN city c ON a.uid_city=c.city_id LEFT JOIN subdistrict d ON a.uid_subdistrict=d.subdistrict_id WHERE a.uid = '.$data_rec[0]["uid_shipping"])->result_array();
                $data['address'] = $dataaddress;
                $dataaccount = $this->db->query('SELECT * FROM account WHERE uid = '.$data_rec[0]["uid_user"])->result_array();
                $data['account'] = $dataaccount;
                //echo "<pre>";
                //print_r($dataaccount);
            }
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('contactmail',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('contactmail',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE contactmail SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/contactmail', 'refresh');
          }
        }else{
          redirect('/webadmin/contactmail', 'refresh');
        }
      }else{
        redirect('/webadmin/contactmail', 'refresh');
      }
    }else{
      /*$this->_ispermit($permit->isview);
      $sqlwhere = "";
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        //$sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        //$sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT a.* FROM cart a LEFT JOIN confirmation_payment b ON a.uid=b.uid_cart order by  a.crdate desc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `cart` order by crdate desc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';*/
        $this->_ispermit($permit->isview);
        $datenow = date('Y-m-d H:i:s');
        $sqlwhere = "and artikel.deleted = 0";
        $data['statuspage'] = 'publish';
        $limit = 10;
        if (isset($_GET["page"])){
            $start = ($_GET["page"]*$limit) - $limit;
            $page = $_GET["page"];
            $no = (($_GET["page"]*$limit) - $limit) + 1;
        }else{
            $start = 0;
            $no = 1;
            $page = 1;
        }
        $data_rec = $this->db->query('SELECT *, (select count(*) from confirmation_payment WHERE uid_cart = cart.uid) as confirmation_payment FROM `cart` order by crdate desc LIMIT '.$start.','.$limit)->result_array();  
        $data_rec_count = $this->db->query('SELECT * FROM `cart` order by crdate desc ')->result_array();
        if (isset($_GET['cari']))
        {
            $data_rec = $this->db->query('SELECT *, (select count(*) from confirmation_payment WHERE uid_cart = cart.uid) as confirmation_payment FROM `cart` where reference_order LIKE "%'.$_GET["keyword"].'%" order by crdate desc LIMIT '.$start.','.$limit)->result_array();  
            $data_rec_count = $this->db->query('SELECT * FROM `cart` where reference_order LIKE "%'.$_GET["keyword"].'%" order by crdate desc ')->result_array();
        }
        $pengurangan = ($page - 1);
        $urut = count($data_rec_count) - $pengurangan;
        $query_string = $_GET;
        if (isset($query_string['page']))
        {
            unset($query_string['page']);
        }
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';       
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url($this->admin.'/'.$url_module.'/page');
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';       
        $config['uri_segment'] = 4;
        $config['base_url'] = base_url($this->admin.'/'.$url_module.'');
        $config['total_rows'] = count($data_rec_count);
        $config['per_page'] = $limit;        
        $config['full_tag_open'] = '<div class="dataTables_paginate paging_bootstrap pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['cur_tag_open'] = '<li><a href=# style="color:#ffffff; background-color:#258BB5;">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = 'Next &rarr;';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&larr; Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';
        $query_string = $_GET;
        if (isset($query_string['page']))
        {
            unset($query_string['page']);
        }        
        if (count($query_string) > 0)
        {
            $config['suffix'] = '&' . http_build_query($query_string, '', "&");
            $config['first_url'] = $config['base_url'] . '?' . http_build_query($query_string, '', "&");
        } 
        //$config['suffix'] = '' . http_build_query($query_string, '', "&");
        //$config['first_url'] = $url_module.'/?page=1';
        //$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $config['use_page_numbers'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = "page";
        $this->pagination->initialize($config);
        $data['paging'] = $this->pagination->create_links();    
        $data['urutan']        = $urut;
        $data['limit']       = $limit;
        $data['rec']        = $data_rec;
        $data['act']        = 'default';
        $data['jumlahdata'] = count($data_rec_count);;
    }
    $data['controller'] = $this;
    $data['active']  = $parent;
    $data['active2'] = $id;
    $data['parent'] = $parent;
    $data['submenu'] = TRUE;
    $url_module = $this->segs[2];
    $data['url_module'] = $url_module;
    $data['title'] = $title;
    $data['page'] = 'cart';
    $data['tipe'] = '';
    $this->load->view('cms/main.php',$data); 
  }
  public function contactmail($id,$parent,$title,$link){       
    $login = $this->_isLogin();
    $idpermit = $id;
    $permit = $this->_cekPermit($idpermit);
    $data['permit'] = $permit;
    $data['menulist'] = $this->_cekAkses();
    if (isset($this->segs[3]) AND $this->segs[3] == 'act'){           
      if (isset($this->segs[4])){
        $data['act'] = $this->segs[4];
        if ($this->segs[4] == 'add'){
          $this->_ispermit($permit->isadd);
          $form = $this->input->post('form');
          if (isset($form) AND $form == 1 ){
            $status = $this->_save_contactmail();
            $data['status'] = $status;
          }
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_contactmail();
              $data['status'] = $status;
            }
            $data_rec = $this->db->query('SELECT id,name,email FROM `contactmail` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('contactmail',$this->segs[5]);
            if ($deleted){
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('contactmail',$this->segs[5]);
            if ($restore){
              redirect('/webadmin/contactmail', 'refresh');
            }
          } else {
            redirect('/webadmin/contactmail', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE contactmail SET hapus = 1 WHERE id = "'.$this->segs[5].'"'); 
          if ($hide){
            redirect('/webadmin/contactmail', 'refresh');
          }
        }else{
          redirect('/webadmin/contactmail', 'refresh');
        }
      }else{
        redirect('/webadmin/contactmail', 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $sqlwhere = "";
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        //$sqlwhere = 'and hapus = 1';
        $data['statuspage'] = 'trash';
      } else {
        //$sqlwhere = 'and hapus = 0 and draft = 0';
        $data['statuspage'] = 'publish';
      }
      $data_rec = $this->db->query('SELECT crdate,uid,name,email,message FROM `contact_data` where 1=1 '.$sqlwhere.' order by  uid desc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `contact_data` where 1=1 '.$sqlwhere.' order by uid desc')->result();        
      $data['rec']   = $data_rec;
      $data['act'] = 'default';
      //echo "<pre>";
      //print_r($data_rec);
    }
    $data['active']  = $parent;
    $data['active2'] = $id;
    $data['parent'] = $parent;
    $data['submenu'] = TRUE;
    $url_module = $this->segs[2];
    $data['url_module'] = $url_module;
    $data['title'] = $title;
    $data['page'] = 'contactmail';
    $data['tipe'] = '';
    $this->load->view('cms/main.php',$data); 
  }
  function ryan_bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable){
        $config['upload_path']   = FCPATH.'/uploads/'.$folder;
        $config['file_name']     = $filename;
        $config['allowed_types'] = 'jpeg|gif|jpg|png';
        $config['overwrite']     = TRUE;
        //$this->load->library('upload', $config);
        $this->upload->initialize($config);
        $field_name = $fieldname;
        if ( !$this->upload->do_upload($field_name)){
          $success = FALSE;
          $step1   = FALSE;
          $notice  = $this->upload->display_errors('<li>Picture :','</li>');
          return $arrayName = array('status' => FALSE, 'success' => $success, 'step1' => $step1, 'notice' => $notice);
        }else{
          $dataupload = $this->upload->data();
          if($resizable == TRUE){
            if($dataupload['image_width'] != $width OR $dataupload['image_height'] != $height){
              $ratio = ($dataupload['image_width'] / $dataupload['image_height']) - ($width / $height);
              $full_path = $dataupload['full_path'];
              if($ratio == 0){
                $resize = $this->resize_img($full_path,$width,$height,'auto');
                if ($create_thumb['status'] == TRUE) {
                  $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
                }
              }elseif($ratio > 0){
                $resize = $this->resize_img($full_path,$width,$height,'height');
                $size   = getimagesize($full_path);
                $y_axis = 0;
                $x_axis = ($size[0]-$width)/2;
                $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
                if ($create_thumb['status'] == TRUE) {
                  $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
                }
              }elseif($ratio < 0){
                $resize = $this->resize_img($full_path,$width,$height,'width');
                $size   = getimagesize($full_path);
                $x_axis = 0;
                $y_axis = ($size[1]-$height)/2;
                $crop   = $this->crop_img($full_path,$width,$height,$x_axis,$y_axis);
                if ($create_thumb['status'] == TRUE) {
                  $thumb = $this->thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
                }
              }
            }else{
              if ($create_thumb['status'] == TRUE) {
                $full_path = $dataupload['full_path'];
                $thumb = $this->awal_thumb_img($full_path,$create_thumb['width'],$create_thumb['height']);
              }
            }
          }
          return $arrayName = array('status' => TRUE, 'filename' => $dataupload['file_name'], 'thumbname' => $dataupload['raw_name'].'_small'.$dataupload['file_ext']);
        }
      }
}
?>