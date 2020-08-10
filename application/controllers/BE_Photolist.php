<?php
date_default_timezone_set("Asia/Jakarta");

class BE_Photolist extends Webadmin_Controller {
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
        $query = $this->db->query("SELECT id,module,parent,title FROM menu WHERE link = '$link'")->result();
        $this->menu($query[0]->id,$query[0]->parent,$query[0]->title);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  public function menu($id,$parent,$title){   
    $login = $this->_isLogin();
    $permit = $this->_cekPermit($id);
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
          $data['module'] = $this->db->query('SELECT id,title FROM module WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
          
          $data['controller'] = $this;
          $data['menuparent'] = $this->db->query('SELECT id,title FROM menu WHERE parent = 0 AND submenu = 1 ORDER BY posisi asc')->result_array(); 
            
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
            $data['module'] = $this->db->query('SELECT id,title FROM module WHERE draft = 0 AND hapus = 0 ORDER BY title asc')->result_array();
            $data_rec = $this->db->query('SELECT id,title,parent,link,submenu,akses,icon,module FROM menu WHERE id = '.$this->segs[5])->result_array(); 
            $data['menuparent'] = $this->db->query('SELECT id,title FROM menu WHERE parent = 0 AND submenu = 1 ORDER BY posisi asc')->result_array(); 
            if ($data_rec) {
              $data['rec'] = $data_rec[0];
            } else {
              redirect('/'.$this->admin.'/menu', 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/menu', 'refresh');
          }
        }elseif ($this->segs[4] == 'delete'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $deleted = $this->deleteData('menu',$this->segs[5]);
            if ($deleted){
              redirect('/'.$this->admin.'/menu', 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/menu', 'refresh');
          }
        }elseif ($this->segs[4] == 'restore'){
          $this->_ispermit($permit->isdelete);
          if (isset($this->segs[5]) AND $this->segs[5] != '') {
            $restore = $this->restoreData('menu',$this->segs[5]);
            if ($restore){
              redirect('/'.$this->admin.'/menu', 'refresh');
            }
          } else {
            redirect('/'.$this->admin.'/menu', 'refresh');
          }
        }elseif ($this->segs[4] == 'trash'){
          $this->_ispermit($permit->isdelete);
          $hide = $this->db->query('UPDATE menu SET hapus = 1 WHERE id = '.$this->segs[5]); 
          if ($hide){
            redirect('/'.$this->admin.'/menu', 'refresh');
          }
        }else{
          redirect('/'.$this->admin.'/menu', 'refresh');
        }
      }else{
        redirect('/'.$this->admin.'/menu', 'refresh');
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
      $data_rec = $this->db->query('SELECT id,title FROM menu where 1=1 '.$sqlwhere.' order by posisi asc')->result_array();  
      $data_count = $this->db->query('SELECT count(*) as jumlah FROM menu where 1=1 '.$sqlwhere.'')->result();
      if ($data['statuspage'] == 'publish') {
        $urutanchild = 0;
        foreach ($data_rec as $parentnya) {
          $datachild[$urutanchild] = $this->db->query('SELECT id,title FROM menu where parent = '.$parentnya["id"].' and hapus = 0 and draft = 0 order by posisi asc')->result_array();
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
    $data['active']  = $parent;
    $data['page']    = 'menu';
    $data['active2'] = $title;
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
    $icon = $this->input->post('icon');
    $module  = $this->input->post('idmodule');
    
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
        'module'  => $module,
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
    
}
?>