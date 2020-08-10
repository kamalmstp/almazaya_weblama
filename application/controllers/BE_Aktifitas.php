<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Aktifitas extends Webadmin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->library('encrypt');
    $this->segs = $this->uri->segment_array();
    $this->admin = "webadmin";
    $this->data['webadmin'] = $this->admin;
    $this->data['controller'] = $this;
  }
    public function index(){      
        $link = $this->segs[2];
        $query = $this->db->query("SELECT id,module,parent,title,link FROM menu WHERE link = '$link'")->result();
        $this->banner($query[0]->id,$query[0]->parent,$query[0]->title,$query[0]->link);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
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
    if (isset($_POST["editheadline"])){
        $cekheadline = $this->db->query("SELECT count(*) as total FROM headline WHERE idmenu = ?", array($id))->result_array();
        if ($cekheadline[0]["total"] == 0){
            $datanya = array(
                'title' => $_POST["h1"],
                'description' => $_POST["h1"],
                'idmenu' => $id
            );
            $this->db->insert('headline', $datanya);
        }else{
            $editdata = array(        
                'title' => $_POST["h1"],
                'description' => $_POST["h2"]
            );     
            $this->db->where('idmenu', $id);
            $edit = $this->db->update('headline', $editdata); 
        }
    }
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
            $data_rec = $this->db->query('SELECT id,sisterpages,title,link,pic,pic2,thumb,description FROM `aktifitas` WHERE sister = '.$this->segs[5])->result_array(); 
            //print_r($data_rec);
            $data['pages'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND idmodule = 45 AND draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec;
            } else {
              redirect('/webadmin/'.$this->segs[2], 'refresh');
            }
          } else {
            redirect('/webadmin/'.$this->segs[2], 'refresh');
          }
        }elseif ($this->segs[4] == 'view'){
          $this->_ispermit($permit->isview);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $data_row = $this->db->query('SELECT id,title,link,pic,thumb,datestart,dateend,draft FROM `aktifitas` WHERE id = '.$this->segs[5])->result_array(); 
            if ($data_row) {
              $data['row'] = $data_row[0];
            } else {
              redirect('/webadmin/'.$this->segs[2], 'refresh');
            }
          } else {
            redirect('/webadmin/'.$this->segs[2], 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('aktifitas',$this->segs[5]);
            if ($deleted){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/'.$this->segs[2], 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('aktifitas',$this->segs[5]);
            if ($restore){
              redirect($this->agent->referrer(), 'refresh');
            }
          } else {
            redirect('/webadmin/'.$this->segs[2], 'refresh');
          }
        }elseif ($this->segs[4] == 'movetrash'){
          $this->_ispermit($permit->isdelete);
          $trash = $this->trashData('aktifitas',$this->segs[5]);
          if ($trash){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movedraft'){
          $this->_ispermit($permit->isupdate);
          $draft = $this->draftData('aktifitas',$this->segs[5]);
          if ($draft){
            redirect($this->agent->referrer(), 'refresh');
          }
        }elseif ($this->segs[4] == 'movepublish'){
          $this->_ispermit($permit->isupdate);
          $publish = $this->publishData('aktifitas',$this->segs[5]);
          if ($publish){
            redirect($this->agent->referrer(), 'refresh');
          }
        }else{
          redirect('/webadmin/'.$this->segs[2], 'refresh');
        }
      }else{
        redirect('/webadmin/'.$this->segs[2], 'refresh');
      }
    }else{
      $this->_ispermit($permit->isview);
      $datenow = date('Y-m-d H:i:s');
      if (isset($this->segs[3]) AND $this->segs[3] == 'trash') {
        $sqlwhere = 'and aktifitas.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'and aktifitas.hapus = 0 and aktifitas.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = "and aktifitas.hapus = 0 and aktifitas.draft = 0 ";
        $data['statuspage'] = 'publish';
      }
      $query = 'SELECT aktifitas.id,aktifitas.title,aktifitas.sister,aktifitas.thumb,aktifitas.pic FROM `aktifitas`  where aktifitas.idlanguage = '.$deflang.'  AND aktifitas.idmenu='.$id.' '.$sqlwhere.' order by aktifitas.posisi asc';
      $data_rec = $this->db->query($query)->result_array();  
      $dbResult = $this->db->query("SELECT title,description FROM headline WHERE idmenu = ?", array($id))->result_array();
      $data['headline']    = $dbResult;
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `aktifitas` where 1=1  AND aktifitas.idmenu='.$id.' '.$sqlwhere.' order by posisi asc')->result();        
      $data['rec']        = $data_rec;
      $data['act']        = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data['count_publish']    = $this->countPublishNew('aktifitas',$deflang,$id);
      $data['count_draft']      = $this->countDraftNew('aktifitas',$deflang,$id);
      $data['count_trash']      = $this->countTrashNew('aktifitas',$deflang,$id);
    }
    if ($parent > 0){
        $data['submenu'] = TRUE;
    }else{
        $data['submenu'] = FALSE;
    }   
    $data['active']  = $parent;
    $data['active2'] = $id;
    $data['current_menu']    = $link;
    $data['page']    = "aktifitas";
    $data['webadmin']    = $this->admin;
    $data['url_module']    = $this->segs[2];
    $this->load->view('cms/main.php',$data); 
  }
  function _save_banner($id,$parent){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
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
    $sister = $this->_nextAI('aktifitas');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    $picname   = "";
    $picname2  = "";
    $thumbname = "";
    foreach ($idlang as $lang) {
      $picname   = "";
      $thumbname = "";
        if ($link[$lang] != ""){
            $ceklink = $this->db->query('SELECT count(*) as jumlah FROM `aktifitas` where link_ori = "'.$link[$lang].'" AND idlanguage = '.$lang)->result();
            if($ceklink[0]->jumlah != 0){
                $newlink = $link[$lang].$ceklink[0]->jumlah;
            }else{
                $newlink = $link[$lang];
            }
        }else{
            $newlink = "";
        }
        if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        
            $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
            $file_edit     = str_replace(" ","_",$filenameold);
            $random_digit  = rand(000,999);
            $new_file_name = 'aktifitas_'.$random_digit."_".$file_edit;
            $folder       = 'aktifitas';
            $filename     = $new_file_name;
            $fieldname    = 'pic'.$lang;
            $resizable    = TRUE;
            $width        = 900;
            $height       = 655;
            $create_thumb = array(            
              'status' => TRUE,
              'width'  => 800, 
              'height' => 480
            ); 
            $hasilupload = $this->bas_img_upload($folder,$filename,$fieldname,$width,$height,$create_thumb,$resizable);
            if($hasilupload['status'] == TRUE){
              $picname   = $hasilupload['filename'];
              $thumbname = $hasilupload['thumbname'];
              $this->resize_crop_image(400,300,FCPATH.'/uploads/aktifitas/'.$picname,FCPATH.'/uploads/aktifitas/thumb_'.$picname,80);
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
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link_ori'    => $this->slugify($title[$lang]), 
          'link'        => $newlink,  
          'sister'     => $sister,
          'pic'        => $picname,
          'description' => $description[$lang],
          'idmenu'    => $id,
          'thumb'      => $thumbname, 
          'cretime'    => date('Y-m-d H:i:s'),
          'creby'      => $this->session->userdata('username')
        );     
        $saved = $this->db->insert('aktifitas', $inputdata);
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
    $sister = $this->_nextAI('aktifitas');
    $notice  = "";
    $success = TRUE;
    $step1   = TRUE;
    //echo $title;
    $s = 1;
    foreach ($idlang as $lang) {
      $picname   = $this->input->post('oldpic'.$lang);
      $thumbname = $this->input->post('oldthumb'.$lang);
      if ($step1 == TRUE AND isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filenameold   = strtolower($_FILES['pic'.$lang]['name']);
        $file_edit     = str_replace(" ","_",$filenameold);
        $random_digit  = rand(000,999);
        $new_file_name = 'aktifitas_'.$random_digit."_".$file_edit;
        $folder       = 'aktifitas';
        $filename     = $new_file_name;
        $fieldname    = 'pic'.$lang;
        $resizable    = TRUE;
        $width        = 900;
        $height       = 655;
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
        $this->resize_crop_image(400,300,FCPATH.'/uploads/aktifitas/'.$picname,FCPATH.'/uploads/aktifitas/thumb_'.$picname,80);
      }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(        
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
        $edit = $this->db->update('aktifitas', $editdata); 
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
  function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
    	$imgsize = getimagesize($source_file);
    	$width = $imgsize[0];
    	$height = $imgsize[1];
    	$mime = $imgsize['mime'];
    	switch($mime){
    		case 'image/gif':
    			$image_create = "imagecreatefromgif";
    			$image = "imagegif";
    			break;
    		case 'image/png':
    			$image_create = "imagecreatefrompng";
    			$image = "imagepng";
    			$quality = 7;
    			break;
    		case 'image/jpeg':
    			$image_create = "imagecreatefromjpeg";
    			$image = "imagejpeg";
    			$quality = 80;
    			break;
    		default:
    			return false;
    			break;
    	}
    	$dst_img = imagecreatetruecolor($max_width, $max_height);
    	$src_img = $image_create($source_file);
    	$width_new = $height * $max_width / $max_height;
    	$height_new = $width * $max_height / $max_width;
    	//if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
    	if($width_new > $width){
    		//cut point by height
    		$h_point = (($height - $height_new) / 2);
    		//copy image
    		imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
    	}else{
    		//cut point by width
    		$w_point = (($width - $width_new) / 2);
    		imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
    	}
    	$image($dst_img, $dst_dir, $quality);
    	if($dst_img)imagedestroy($dst_img);
    	if($src_img)imagedestroy($src_img);
    }
}
?>