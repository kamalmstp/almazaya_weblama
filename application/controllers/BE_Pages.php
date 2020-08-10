<?php
date_default_timezone_set("Asia/Jakarta");
class BE_Pages extends Webadmin_Controller {
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
        $this->pages($query[0]->id,$query[0]->parent,$query[0]->title,1,$query[0]->link);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
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
            $data_rec = $this->db->query('SELECT record,id,hide_in_menu,title,idmodule,idlanguage,parent,link,submenu,subtitle,content,pic,meta_title,meta_description FROM `pages` WHERE sister = '.$this->segs[5])->result_array(); 
            $data['module'] = $this->db->query('SELECT id,title FROM `module` WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array(); 
            $data['menuparent'] = $this->db->query('SELECT id,title,sister,parent FROM `pages` WHERE idlanguage = '.$deflang.' AND parent = 0 AND  hapus=0 AND draft=0 ORDER BY `posisi` asc')->result_array();
            $data['menu_record'] = $this->db->query('SELECT id,title FROM `menu` WHERE draft = 0 AND hapus = 0 AND module='.$data_rec[0]["idmodule"].' ORDER BY title asc')->result_array();
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
    $data['url_module'] = $url_module;
    $data['page']    = 'pages';
    $data['current_menu']    = $link;
    $data['submenu'] = FALSE;
    $data['active'] = $parent;
    $data['active2'] = $title;
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
}
?>