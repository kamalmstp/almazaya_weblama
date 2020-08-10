<?php
date_default_timezone_set("Asia/Jakarta");

class BE_User extends Webadmin_Controller {
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
        $this->user($query[0]->id,$query[0]->parent,$query[0]->title);
        //redirect('/'.$this->admin.'/'.$link, 'refresh');
    }
  public function user($id,$parent,$title){ 
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
    $data['active'] = $parent;
    $data['active2'] = $title;
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
    
}
?>