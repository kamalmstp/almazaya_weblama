<?php
date_default_timezone_set("Asia/Jakarta");
class Be_kategori_galeri extends Webadmin_Controller {
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
        $this->cat_skinpedia($query[0]->id,$query[0]->parent,$query[0]->title,3,$query[0]->link,$query[0]->module);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  public function cat_skinpedia($id, $parenttop, $title ,$type,$link,$module){
       
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
            $status = $this->_save_pages($type,$id,$module);
            $data['status'] = $status;
            // echo "<pre>";
            // print_r($status);
          }
          $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
          $data['menuparent'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE  idmodule=87 AND idlanguage = '.$deflang.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
         
            //echo "<pre>";
            //print_r($data['module']);
            //die();
        }elseif ($this->segs[4] == 'edit'){
          $this->_ispermit($permit->isupdate);
          if (isset($this->segs[5]) AND $this->segs[5] != '' AND is_numeric($this->segs[5])) {
            $form = $this->input->post('form');
            if (isset($form) AND $form == 1 ){
              $status = $this->_edit_pages($type,$module);
              $data['status'] = $status;
              // echo "<pre>";
              // print_r($status);
            }
            $data_rec = $this->db->query('SELECT id,hide_in_menu,title,idmodule,idlanguage,parent,link,submenu,subtitle,content,pic,meta_title,meta_description FROM `pages` WHERE sister = '.$this->segs[5])->result_array(); 
            $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
          $data['menuparent'] = $this->db->query('SELECT id,title,sister FROM `pages` WHERE  idmodule=87 AND idlanguage = '.$deflang.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
         
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
        $sqlwhere = 'pages.hapus = 1';
        $data['statuspage'] = 'trash';
      }elseif (isset($this->segs[3]) AND $this->segs[3] == 'draft') {
        $sqlwhere = 'pages.hapus = 0 and pages.draft = 1';
        $data['statuspage'] = 'draft';
      }else {
        $sqlwhere = 'pages.hapus = 0 and pages.draft = 0';
        $data['statuspage'] = 'publish';
      }
      
      
      
      $data_rec = $this->db->query('SELECT pages.hide_in_menu,pages.type,pages.id,pages.title,pages.sister,module.title as module FROM `pages`  INNER JOIN module ON pages.idmodule = module.id where pages.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND pages.idmodule='.$module.' order by pages.posisi asc')->result_array();
      //print_r($data_rec);
      
      //print_r('SELECT pages.hide_in_menu,pages.type,pages.id,pages.title,pages.sister,module.title as module FROM `pages`  INNER JOIN module ON pages.idmodule = module.id where pages.idlanguage = '.$deflang.' AND '.$sqlwhere.' AND pages.idmodule=85 order by pages.posisi asc');
      //die("test");
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `pages` where idlanguage = '.$deflang.' AND '.$sqlwhere.'  AND pages.idmodule='.$module.' order by posisi asc')->result();
      if ($data['statuspage'] == 'publish') {
        if(count($data_rec) != 0){
          $urutanchild = 0;
          $datachild = array();
          foreach ($data_rec as $parent) {
            $datanya = $this->db->query('SELECT id,title,sister FROM `pages` where idlanguage = '.$deflang.' AND parent = '.$parent["id"].' and hapus = 0 and draft = 0 AND type='.$type.' AND idlanguage = '.$deflang.' order by posisi asc')->result_array();
            if (count($datanya) > 0){
                $datachild[$urutanchild] = $datanya;
                $urutanchild++;
            }
            
          }
          
          //echo "<pre>";
//          print_r($datachild);
          $data['child'] = $datachild;
        }
      }   
      $data['rec']   = $data_rec;
      $data['deflang'] = $deflang;
      $data['act']   = 'default';
      $data['jumlahdata'] = $data_count[0]->jumlah;
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM `pages` where idlanguage = '.$deflang.' AND '.$sqlwhere.'  AND pages.idmodule='.$module.' order by posisi asc')->result();
      
      $data['count_publish'] = $data_count[0]->jumlah;
      $data['count_draft'] = $this->countDraftNewPage('pages',$deflang,$type);
      $data['count_trash'] = $this->countTrashNewPage('pages',$deflang,$type);
    }
    $data["controller"] = $this;
   
    $data['url_module'] = $url_module;
    $data['page']    = 'kategori_skinpedia';
    $data['current_menu']    = $link;
    $data['submenu'] = TRUE;
    
    
    $data['active']  = $parenttop;
    $data['active2'] = $id;
    $data['tipe'] = '';
    $data['parent'] = $parenttop;
    $data['submenu'] = TRUE;
    
    
    
    
    
    $data['url_module'] = $this->segs[2];
    
    
    $data['title'] = $title;
    $this->load->view('cms/main.php',$data); 
  }
  function _save_pages($type,$idmenu,$module){
    // echo '<pre>';
    // print_r($_POST);
    // die();
    $idmodule = $module;
    $idparent = $this->input->post('idparent');
    $idlang   = $this->input->post('idlang');
    $title    = $this->input->post('title');
    $subtitle = $this->input->post('subtitle');
    $record = $this->input->post('record');
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
      $new_file_name   = "";
     if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filename   = strtolower($_FILES['pic'.$lang]['name']);
        $file_name     = str_replace(" ","_",$filename);
        $new_file_name = date("YmdHis")."_".$file_name;
        /*THUMB = 78px x 77px */
        move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/pages/'.$new_file_name);
        $this->resize_crop_image(1140,445,FCPATH.'/uploads/pages/'.$new_file_name,FCPATH.'/uploads/pages/resize/'.$new_file_name,80);
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
          'pic'        => $new_file_name,  
          'record'     => $record,  
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
  function _edit_pages($type,$module){
    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // die();
    $id       = $this->input->post('id');
    $idmodule = $module;
    $idparent = $this->input->post('idparent');
    $idlang   = $this->input->post('idlang');
    $title    = $this->input->post('title');
    $subtitle = $this->input->post('subtitle');
    $content  = $this->input->post('content');
    $record = $this->input->post('record');
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
     $new_file_name   = $this->input->post('oldpic'.$lang);
     if (isset($_FILES['pic'.$lang]['name']) AND $_FILES['pic'.$lang]['name'] != '') {
        $filename   = strtolower($_FILES['pic'.$lang]['name']);
        $file_name     = str_replace(" ","_",$filename);
        $new_file_name = date("YmdHis")."_".$file_name;
        /*THUMB = 78px x 77px */
        move_uploaded_file($_FILES['pic'.$lang]['tmp_name'], FCPATH.'/uploads/pages/'.$new_file_name);
        $this->resize_crop_image(1140,445,FCPATH.'/uploads/pages/'.$new_file_name,FCPATH.'/uploads/pages/resize/'.$new_file_name,80);
    }
      if($step1 == TRUE AND $success == TRUE){
        $editdata = array(            
          'idmodule'   => $idmodule, 
          'idlanguage' => $lang, 
          'title'      => $title[$lang], 
          'link'       => $link[$lang],  
          'subtitle'   => $subtitle[$lang],  
          'content'    => $content[$lang],    
          'pic'        => $new_file_name,  
          'record'     => $record,  
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
    public function _getSubPages($sister,$separator){
    $deflang = $this->_cekDefLang();
    $submenu = $this->db->query('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
    //echo 'SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc';
    $htmlstring = "";
    foreach ($submenu as $dt){
        $htmlstring .= "<option value=\"".$dt["sister"]."\">$separator ".$dt["title"]."</option>";
        //$htmlstring .= $this->_getSubPages($dt["sister"],$separator);
    }
    //die('SELECT id,title,sister FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = '.$sister.' AND hapus=0 AND draft=0 ORDER BY `posisi` asc');
    return $htmlstring;
  }
}
?>